<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')->update([
            'long_description' => null,
            'product_video_code' => null,
            'product_video' => null,
        ]);

        DB::table('products')
            ->select('id', 'base_price', 'discounted_price')
            ->orderBy('id')
            ->chunkById(100, function ($products): void {
                foreach ($products as $product) {
                    DB::table('product_variations')
                        ->where('product_id', $product->id)
                        ->update([
                            'price' => $product->base_price,
                            'discounted_price' => $product->discounted_price,
                        ]);
                }
            });
    }

    public function down(): void
    {
        // Removed content and former size-specific prices cannot be reconstructed.
    }
};
