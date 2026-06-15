<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontendProductSeeder extends Seeder
{
    private array $categoryIds = [];
    private array $attributeMap = [];
    private array $summary = [
        'parents' => 0,
        'subcategories' => 0,
        'attributes' => 0,
        'attribute_values' => 0,
        'products' => 0,
        'product_attributes' => 0,
        'product_variations' => 0,
        'variation_attributes' => 0,
        'images_copied' => 0,
    ];

    public function run(): void
    {
        $parents = [
            'Men' => ['Men Sub-Category 1', 'Men Sub-Category 2', 'Men Sub-Category 3', 'Men Sub-Category 4'],
            'Unisex' => ['Unisex Sub-Category 1', 'Unisex Sub-Category 2'],
            'Women' => ['Women Sub-Category 1', 'Women Sub-Category 2', 'Women Sub-Category 3', 'Women Sub-Category 4'],
        ];

        $sizes = ['Free', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '38', '40', '42', '44', '46'];
        $colors = [
            'Red' => '#ef5619',
            'Black' => '#171d3d',
            'Green' => '#61c58d',
            'Blue' => '#4b59a3',
            'Yellow' => '#f3c623',
        ];

        $products = [
            ['name' => 'Solid Colour Cotton Kurta', 'parent' => 'Unisex', 'sub' => 'Unisex Sub-Category 1', 'base' => 1200, 'sale' => 960, 'image' => 'product-1.jpg', 'feature' => 1],
            ['name' => 'Printed Cotton Kurta', 'parent' => 'Unisex', 'sub' => 'Unisex Sub-Category 1', 'base' => 1200, 'sale' => 960, 'image' => 'product-5.jpg', 'feature' => 0],
            ['name' => 'Partywear Punjabi', 'parent' => 'Men', 'sub' => 'Men Sub-Category 1', 'base' => 1800, 'sale' => 1440, 'image' => 'product-2.jpg', 'feature' => 1],
            ['name' => 'Shaadi Sherwani', 'parent' => 'Men', 'sub' => 'Men Sub-Category 1', 'base' => 3000, 'sale' => 2400, 'image' => 'product-3.jpg', 'feature' => 1],
            ['name' => 'Cotton Printed Shirt', 'parent' => 'Men', 'sub' => 'Men Sub-Category 1', 'base' => 1000, 'sale' => 800, 'image' => 'product-4.jpg', 'feature' => 0],
            ['name' => 'Cotton Shirt', 'parent' => 'Men', 'sub' => 'Men Sub-Category 1', 'base' => 1000, 'sale' => 800, 'image' => 'product-6.jpg', 'feature' => 0],
        ];

        $sourceImageDir = 'C:/Users/user/Downloads/bulk-download/assets/images/products';
        $targetImageDir = public_path('uploads/product');

        if (! is_dir($targetImageDir)) {
            mkdir($targetImageDir, 0775, true);
        }

        DB::transaction(function () use ($parents, $sizes, $colors, $products, $sourceImageDir, $targetImageDir): void {
            $this->seedCategoriesAndAttributes($parents, $sizes, $colors);
            $this->seedProducts($products, array_keys($colors), $sourceImageDir, $targetImageDir);
        });

        $this->command?->info('Frontend product seed complete: '.json_encode($this->summary));
    }

    private function seedCategoriesAndAttributes(array $parents, array $sizes, array $colors): void
    {
        foreach ($parents as $parentName => $subNames) {
            $parentId = $this->upsertRow('categories', ['slug' => $this->slug($parentName)], [
                'parent_id' => 0,
                'category_name' => $parentName,
                'short_description' => $parentName.' apparel collection',
                'description' => $parentName.' apparel collection',
                'meta_title' => $parentName,
                'meta_description' => $parentName.' boutique apparels',
                'meta_keywords' => $parentName.', apparels, boutique',
                'status' => 1,
            ]);

            $this->categoryIds[$parentName] = $parentId;
            $this->summary['parents']++;

            foreach ($subNames as $subName) {
                $subId = $this->upsertRow('categories', ['slug' => $this->slug($subName)], [
                    'parent_id' => $parentId,
                    'category_name' => $subName,
                    'short_description' => $subName.' collection',
                    'description' => $subName.' collection',
                    'meta_title' => $subName,
                    'meta_description' => $subName.' boutique apparels',
                    'meta_keywords' => $subName.', apparels, boutique',
                    'status' => 1,
                ]);

                $this->categoryIds[$subName] = $subId;
                $this->summary['subcategories']++;

                $sizeAttrId = $this->upsertRow('attributes', [
                    'parent_category' => $parentId,
                    'sub_category_id' => $subId,
                    'slug' => 'size',
                ], [
                    'name' => 'Size',
                    'is_price_effect' => 0,
                    'status' => 1,
                ]);

                $colorAttrId = $this->upsertRow('attributes', [
                    'parent_category' => $parentId,
                    'sub_category_id' => $subId,
                    'slug' => 'color',
                ], [
                    'name' => 'Color',
                    'is_price_effect' => 0,
                    'status' => 1,
                ]);

                $this->summary['attributes'] += 2;
                $this->attributeMap[$subId] = [
                    'Size' => ['id' => $sizeAttrId, 'values' => []],
                    'Color' => ['id' => $colorAttrId, 'values' => []],
                ];

                foreach ($sizes as $size) {
                    $valueId = $this->upsertRow('attribute_values', [
                        'parent_category' => $parentId,
                        'sub_category_id' => $subId,
                        'attr_id' => $sizeAttrId,
                        'attr_value' => $size,
                    ], [
                        'price_type' => 'FLAT',
                        'price_val' => 0,
                        'ref_val' => $size,
                        'status' => 1,
                    ]);

                    $this->attributeMap[$subId]['Size']['values'][$size] = $valueId;
                    $this->summary['attribute_values']++;
                }

                foreach ($colors as $color => $hex) {
                    $valueId = $this->upsertRow('attribute_values', [
                        'parent_category' => $parentId,
                        'sub_category_id' => $subId,
                        'attr_id' => $colorAttrId,
                        'attr_value' => $color,
                    ], [
                        'price_type' => 'FLAT',
                        'price_val' => 0,
                        'ref_val' => $hex,
                        'status' => 1,
                    ]);

                    $this->attributeMap[$subId]['Color']['values'][$color] = $valueId;
                    $this->summary['attribute_values']++;
                }
            }
        }
    }

    private function seedProducts(array $products, array $colors, string $sourceImageDir, string $targetImageDir): void
    {
        $referenceData = $this->productReferenceData();

        foreach ($products as $product) {
            $parentId = $this->categoryIds[$product['parent']];
            $subId = $this->categoryIds[$product['sub']];
            $copiedImage = 'frontend-'.$product['image'];
            $source = $sourceImageDir.'/'.$product['image'];
            $target = $targetImageDir.'/'.$copiedImage;

            if (is_file($source)) {
                copy($source, $target);
                $this->summary['images_copied']++;
            }

            foreach ($colors as $colorIndex => $color) {
                $baseSku = $this->skuFromName($product['name']);
                $sku = $colorIndex === 0 ? $baseSku : $baseSku.'-'.strtoupper($this->slug($color));
                $slug = $colorIndex === 0
                    ? $this->slug($product['name'])
                    : $this->slug($product['name'].'-'.$color);
                $productId = $this->upsertRow('products', ['slug' => $slug], [
                'product_nature' => 'Physical',
                'who_made_it' => 'SANIRUDDH',
                'what_is_it' => 'Finished product',
                'manufacture_year' => (int) date('Y'),
                'shop_produce_item' => $referenceData['shop_produce_item'],
                'tools_used' => json_encode($referenceData['tools_used']),
                'main_category' => $parentId,
                'sub_category' => $subId,
                'name' => $product['name'],
                'color' => $color,
                'base_price' => $product['base'],
                'price_percentage' => 'PERCENTAGE',
                'markup_price' => $product['base'],
                'discount_amount' => $this->discountPercent($product['base'], $product['sale']),
                'discounted_price' => $product['sale'],
                'cover_image' => is_file($target) ? $copiedImage : '',
                'short_description' => $product['name'].' from the Saniruddh boutique apparel collection.',
                'long_description' => null,
                'is_personalization' => 0,
                'personalization_instruction' => '',
                'product_sku' => $sku,
                'product_qty' => 0,
                'product_weight_lb' => '0',
                'product_weight_oz' => '0',
                'product_length' => '',
                'product_width' => '',
                'product_height' => '',
                'related_products' => '[]',
                'is_feature' => $product['feature'],
                'manufacturer' => 'SANIRUDDH',
                'product_video_code' => null,
                'product_video' => null,
                'tags' => implode(',', [$product['parent'], $product['sub'], 'Size', $color]),
                'materials' => json_encode($referenceData['materials']),
                'shipping_policy_id' => 0,
                'shipping_info' => 'Standard shipping available.',
                'shipping_type' => 'FREE',
                'shipping_rate' => 0,
                'return_policy_id' => $referenceData['return_policy_id'],
                'meta_title' => $product['name'],
                'meta_description' => $product['name'].' - Saniruddh boutique apparel.',
                'meta_keywords' => $product['name'].', '.$product['parent'].', '.$product['sub'],
                'is_new' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]);

                $this->summary['products']++;
                $this->resetProductRelations($productId);
                $this->seedProductImage($productId, $copiedImage, $target);
                $this->seedProductAttributes($productId, $subId, $color);
                $this->seedProductVariations($productId, $subId, $sku, $product['base'], $product['sale']);
            }
        }
    }

    private function productReferenceData(): array
    {
        return [
            'shop_produce_item' => (int) (DB::table('shop_produce_items')->where('status', 1)->value('id') ?? 0),
            'tools_used' => DB::table('tools_useds')->where('status', 1)->limit(3)->pluck('id')->map(fn ($id) => (int) $id)->all(),
            'materials' => DB::table('materials')->where('status', 1)->limit(4)->pluck('id')->map(fn ($id) => (int) $id)->all(),
            'return_policy_id' => (int) (DB::table('return_policies')->where('status', 1)->value('id') ?? 0),
        ];
    }

    private function resetProductRelations(int $productId): void
    {
        DB::table('product_attributes')->where('product_id', $productId)->delete();
        DB::table('variation_attributes')->where('product_id', $productId)->delete();
        DB::table('product_variations')->where('product_id', $productId)->delete();
        DB::table('product_images')->where('product_id', $productId)->delete();
    }

    private function seedProductImage(int $productId, string $copiedImage, string $target): void
    {
        if (! is_file($target)) {
            return;
        }

        DB::table('product_images')->insert([
            'product_id' => $productId,
            'image' => $copiedImage,
            'is_cover_image' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);
    }

    private function seedProductAttributes(int $productId, int $subId, string $color): void
    {
        $attributeValues = $this->attributeMap[$subId]['Size']['values'];
        $attributeValues[$color] = $this->attributeMap[$subId]['Color']['values'][$color];

        foreach ($attributeValues as $value => $valueId) {
            $attributeId = $value === $color
                ? $this->attributeMap[$subId]['Color']['id']
                : $this->attributeMap[$subId]['Size']['id'];
            DB::table('product_attributes')->insert([
                'product_id' => $productId,
                'product_attribute_id' => $attributeId,
                'product_attribute_value_id' => $valueId,
                'markup_price' => 0,
                'actual_price' => 0,
                'unit_price' => 0,
                'is_base_price' => 0,
                'status' => 1,
                'created_at' => now(),
            ]);

            $this->summary['product_attributes']++;
        }
    }

    private function seedProductVariations(int $productId, int $subId, string $sku, float $basePrice, float $salePrice): void
    {
        $totalQty = 0;

        foreach ($this->attributeMap[$subId]['Size']['values'] as $size => $sizeId) {
            $qty = 5;
            $variationId = DB::table('product_variations')->insertGetId([
                'product_id' => $productId,
                'price' => $basePrice,
                'discounted_price' => $salePrice,
                'sku' => $sku.'-'.strtoupper($this->slug((string) $size)),
                'qty' => $qty,
                'status' => 1,
                'created_at' => now(),
            ]);

            $this->summary['product_variations']++;
            $totalQty += $qty;

            $this->insertVariationAttribute($variationId, $productId, $this->attributeMap[$subId]['Size']['id'], $sizeId, (string) $size);
        }

        DB::table('products')->where('id', $productId)->update([
            'product_qty' => $totalQty,
            'updated_at' => now(),
        ]);
    }

    private function insertVariationAttribute(int $variationId, int $productId, int $parentAttrId, int $attributeId, string $value): void
    {
        DB::table('variation_attributes')->insert([
            'product_variation_id' => $variationId,
            'product_id' => $productId,
            'parent_attr_id' => $parentAttrId,
            'attribute_id' => $attributeId,
            'value' => $value,
            'status' => 1,
            'created_at' => now(),
        ]);

        $this->summary['variation_attributes']++;
    }

    private function upsertRow(string $table, array $where, array $values): int
    {
        $row = DB::table($table)->where($where)->first();

        if ($row) {
            DB::table($table)->where('id', $row->id)->update(array_merge($values, [
                'updated_at' => now(),
            ]));

            return (int) $row->id;
        }

        return (int) DB::table($table)->insertGetId(array_merge($where, $values, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));
    }

    private function slug(string $value): string
    {
        $slug = strtolower((string) preg_replace('/[^A-Za-z0-9]+/', '-', trim($value)));

        return trim((string) preg_replace('/-+/', '-', $slug), '-');
    }

    private function skuFromName(string $name): string
    {
        $sku = '';

        foreach (preg_split('/\s+/', trim($name)) as $part) {
            if ($part !== '') {
                $sku .= strtoupper(substr($part, 0, 1));
            }
        }

        return 'SAN-'.$sku;
    }

    private function discountPercent(float $basePrice, float $salePrice): float
    {
        if ($basePrice <= 0) {
            return 0;
        }

        return round((($basePrice - $salePrice) / $basePrice) * 100, 2);
    }
}
