<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateProductsToSizeOnly extends Command
{
    protected $signature = 'products:migrate-size-only';

    protected $description = 'Split color variations into separate products and keep size as the only variation';

    public function handle(): int
    {
        if (! Schema::hasColumn('products', 'color')) {
            Schema::table('products', function ($table): void {
                $table->string('color', 100)->nullable()->after('name');
            });
        }

        $products = DB::table('products')
            ->where(function (Builder $query): void {
                $query->whereNull('color')->orWhere('color', '');
            })
            ->orderBy('id')
            ->get();

        $migratedProducts = 0;
        $createdProducts = 0;

        foreach ($products as $product) {
            $colorGroups = $this->colorGroups((int) $product->id);
            if ($colorGroups->isEmpty()) {
                continue;
            }

            DB::transaction(function () use ($product, $colorGroups, &$migratedProducts, &$createdProducts): void {
                $sourceImages = DB::table('product_images')->where('product_id', $product->id)->get();
                $sourceAttributes = DB::table('product_attributes')->where('product_id', $product->id)->get();
                $sourceProduct = (array) $product;

                foreach ($colorGroups->values() as $index => $colorGroup) {
                    $targetProductId = (int) $product->id;
                    if ($index > 0) {
                        $targetProductId = $this->cloneProduct($sourceProduct, $colorGroup->color);
                        $this->cloneImages($sourceImages, $targetProductId);
                        $createdProducts++;
                    }

                    $variationIds = $colorGroup->variation_ids
                        ->map(fn ($id) => (int) $id)
                        ->all();

                    DB::table('product_variations')
                        ->whereIn('id', $variationIds)
                        ->update(['product_id' => $targetProductId]);

                    DB::table('variation_attributes')
                        ->whereIn('product_variation_id', $variationIds)
                        ->update(['product_id' => $targetProductId]);

                    DB::table('variation_attributes')
                        ->whereIn('product_variation_id', $variationIds)
                        ->where('parent_attr_id', $colorGroup->color_attr_id)
                        ->delete();

                    $this->syncProductAttributes(
                        $sourceAttributes,
                        $targetProductId,
                        (int) $colorGroup->color_attr_id,
                        (int) $colorGroup->color_value_id
                    );
                    $this->syncOrderDetails($variationIds, $targetProductId);

                    $quantity = (int) DB::table('product_variations')
                        ->where('product_id', $targetProductId)
                        ->sum('qty');

                    DB::table('products')->where('id', $targetProductId)->update([
                        'color' => $colorGroup->color,
                        'product_qty' => $quantity,
                        'updated_at' => now(),
                    ]);
                }

                $migratedProducts++;
            });
        }

        $this->syncProductQuantities();
        $this->info("Migrated {$migratedProducts} products and created {$createdProducts} color products.");

        return self::SUCCESS;
    }

    private function colorGroups(int $productId)
    {
        return DB::table('product_variations as pv')
            ->join('variation_attributes as va', 'va.product_variation_id', '=', 'pv.id')
            ->join('attributes as a', 'a.id', '=', 'va.parent_attr_id')
            ->join('attribute_values as av', 'av.id', '=', 'va.attribute_id')
            ->where('pv.product_id', $productId)
            ->whereRaw('LOWER(a.name) = ?', ['color'])
            ->select(
                'va.parent_attr_id as color_attr_id',
                'va.attribute_id as color_value_id',
                'av.attr_value as color',
                'pv.id as variation_id'
            )
            ->orderBy('pv.id')
            ->get()
            ->groupBy('color_value_id')
            ->map(function ($rows) {
                $first = $rows->first();
                $first->variation_ids = $rows->pluck('variation_id');

                return $first;
            })
            ->values();
    }

    private function cloneProduct(array $sourceProduct, string $color): int
    {
        unset($sourceProduct['id']);

        $sourceProduct['color'] = $color;
        $sourceProduct['product_sku'] = $this->uniqueSku(
            trim((string) ($sourceProduct['product_sku'] ?? '')).'-'.$this->slug($color)
        );
        $sourceProduct['slug'] = $this->uniqueSlug(
            trim((string) ($sourceProduct['slug'] ?? '')).'-'.$this->slug($color)
        );
        $sourceProduct['created_at'] = now();
        $sourceProduct['updated_at'] = now();

        return (int) DB::table('products')->insertGetId($sourceProduct);
    }

    private function cloneImages($sourceImages, int $targetProductId): void
    {
        foreach ($sourceImages as $image) {
            $row = (array) $image;
            unset($row['id']);
            $row['product_id'] = $targetProductId;
            $row['created_at'] = now();
            $row['updated_at'] = now();
            DB::table('product_images')->insert($row);
        }
    }

    private function syncProductAttributes(
        $sourceAttributes,
        int $targetProductId,
        int $colorAttributeId,
        int $colorValueId
    ): void {
        DB::table('product_attributes')->where('product_id', $targetProductId)->delete();

        foreach ($sourceAttributes as $attribute) {
            $isColor = (int) $attribute->product_attribute_id === $colorAttributeId;
            if ($isColor && (int) $attribute->product_attribute_value_id !== $colorValueId) {
                continue;
            }

            $row = (array) $attribute;
            unset($row['id']);
            $row['product_id'] = $targetProductId;
            $row['created_at'] = now();
            $row['updated_at'] = now();
            DB::table('product_attributes')->insert($row);
        }
    }

    private function syncOrderDetails(array $variationIds, int $targetProductId): void
    {
        $sizeValues = DB::table('variation_attributes as va')
            ->join('attributes as a', 'a.id', '=', 'va.parent_attr_id')
            ->join('attribute_values as av', 'av.id', '=', 'va.attribute_id')
            ->whereIn('va.product_variation_id', $variationIds)
            ->whereRaw('LOWER(a.name) = ?', ['size'])
            ->select(
                'va.product_variation_id',
                'va.parent_attr_id',
                'va.attribute_id',
                'av.attr_value'
            )
            ->get()
            ->keyBy('product_variation_id');

        foreach ($sizeValues as $variationId => $size) {
            DB::table('order_details')
                ->where('variation_id', $variationId)
                ->update([
                    'product_id' => $targetProductId,
                    'parent_id' => json_encode([(int) $size->parent_attr_id]),
                    'parent_id_val' => json_encode(['Size']),
                    'child_id' => json_encode([(int) $size->attribute_id]),
                    'child_id_val' => json_encode([$size->attr_value]),
                    'variation_name' => $size->attr_value,
                    'updated_at' => now(),
                ]);
        }
    }

    private function syncProductQuantities(): void
    {
        DB::table('products')
            ->whereNotNull('color')
            ->where('color', '<>', '')
            ->pluck('id')
            ->each(function ($productId): void {
                $variationQuery = DB::table('product_variations')->where('product_id', $productId);
                if (! $variationQuery->exists()) {
                    return;
                }

                DB::table('products')->where('id', $productId)->update([
                    'product_qty' => (int) $variationQuery->sum('qty'),
                    'updated_at' => now(),
                ]);
            });
    }

    private function uniqueSku(string $base): string
    {
        $candidate = strtoupper(trim($base, '-'));
        $suffix = 2;

        while (DB::table('products')->where('product_sku', $candidate)->exists()) {
            $candidate = strtoupper(trim($base, '-')).'-'.$suffix++;
        }

        return $candidate;
    }

    private function uniqueSlug(string $base): string
    {
        $candidate = trim($base, '-');
        $suffix = 2;

        while (DB::table('products')->where('slug', $candidate)->exists()) {
            $candidate = trim($base, '-').'-'.$suffix++;
        }

        return $candidate;
    }

    private function slug(string $value): string
    {
        return trim(strtolower((string) preg_replace('/[^A-Za-z0-9]+/', '-', $value)), '-');
    }
}
