<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontendHomeContentSeeder extends Seeder
{
    private string $assetRoot = 'C:/Users/user/Downloads/bulk-download/assets/images';

    private array $summary = [
        'shop_produce_items' => 0,
        'tools_useds' => 0,
        'materials' => 0,
        'return_policies' => 0,
        'banners' => 0,
        'home_page_sections' => 0,
        'products_updated' => 0,
        'images_copied' => 0,
    ];

    public function run(): void
    {
        $bannerTarget = public_path('uploads/banner');
        $homeTarget = public_path('uploads/home_page');

        if (! is_dir($bannerTarget)) {
            mkdir($bannerTarget, 0775, true);
        }

        if (! is_dir($homeTarget)) {
            mkdir($homeTarget, 0775, true);
        }

        DB::transaction(function () use ($bannerTarget, $homeTarget): void {
            $referenceIds = $this->seedProductReferences();
            $this->updateFrontendProducts($referenceIds);
            $this->seedBanners($bannerTarget);
            $this->seedHomePage($homeTarget);
        });

        $this->command?->info('Frontend home content seed complete: '.json_encode($this->summary));
    }

    private function seedProductReferences(): array
    {
        $shopProduceId = $this->upsertRow('shop_produce_items', ['name' => 'SANIRUDDH Studio'], [
            'description' => 'Designed and produced by the Saniruddh boutique team.',
            'status' => 1,
        ]);
        $this->summary['shop_produce_items']++;

        $toolIds = [];
        foreach ([
            'Tailoring' => 'Pattern cutting, stitching and finishing for apparel.',
            'Hand Finishing' => 'Final hand work and boutique quality checks.',
            'Boutique Pressing' => 'Pressing and presentation before dispatch.',
        ] as $name => $description) {
            $toolIds[] = $this->upsertRow('tools_useds', ['name' => $name], [
                'description' => $description,
                'status' => 1,
            ]);
            $this->summary['tools_useds']++;
        }

        $materialIds = [];
        foreach (['Cotton', 'Silk Blend', 'Premium Fabric', 'Threadwork'] as $name) {
            $materialIds[] = $this->upsertRow('materials', ['name' => $name], [
                'status' => 1,
            ]);
            $this->summary['materials']++;
        }

        $returnPolicyId = $this->upsertRow('return_policies', ['name' => 'Standard 7 Day Exchange'], [
            'type' => 'EXCHANGE',
            'timeframe' => 7,
            'description' => 'Exchange available within 7 days for unused products in original condition.',
            'status' => 1,
        ]);
        $this->summary['return_policies']++;

        return [
            'shop_produce_id' => $shopProduceId,
            'tool_ids' => $toolIds,
            'material_ids' => $materialIds,
            'return_policy_id' => $returnPolicyId,
        ];
    }

    private function updateFrontendProducts(array $referenceIds): void
    {
        $slugs = [
            'solid-colour-cotton-kurta',
            'printed-cotton-kurta',
            'partywear-punjabi',
            'shaadi-sherwani',
            'cotton-printed-shirt',
            'cotton-shirt',
        ];

        $updated = DB::table('products')->whereIn('slug', $slugs)->update([
            'price_percentage' => 'PERCENTAGE',
            'shop_produce_item' => $referenceIds['shop_produce_id'],
            'tools_used' => json_encode($referenceIds['tool_ids']),
            'materials' => json_encode($referenceIds['material_ids']),
            'return_policy_id' => $referenceIds['return_policy_id'],
            'updated_at' => now(),
        ]);

        $this->summary['products_updated'] += $updated;
    }

    private function seedBanners(string $targetDir): void
    {
        $banners = [
            [
                'section' => 1,
                'title' => 'Casual Cotton Shirt',
                'description' => 'Upto 20%',
                'image' => 'slider/slider-image-02.png',
                'filename' => 'frontend-slider-image-02.png',
            ],
            [
                'section' => 1,
                'title' => 'Unisex Cotton Kurta',
                'description' => 'Upto 20%',
                'image' => 'slider/slider-image-01.png',
                'filename' => 'frontend-slider-image-01.png',
            ],
            [
                'section' => 2,
                'title' => "Men's Fashion",
                'description' => 'Upto 20%',
                'image' => 'banner/banner-1.jpg',
                'filename' => 'frontend-banner-1.jpg',
            ],
            [
                'section' => 2,
                'title' => "Women's Style",
                'description' => 'Upto 20%',
                'image' => 'banner/banner-2.jpg',
                'filename' => 'frontend-banner-2.jpg',
            ],
            [
                'section' => 2,
                'title' => 'Unisex Pick',
                'description' => 'Upto 20%',
                'image' => 'banner/banner-3.jpg',
                'filename' => 'frontend-banner-3.jpg',
            ],
            [
                'section' => 2,
                'title' => 'Exclusive Showroom',
                'description' => '@ Kasba - Kolkata',
                'image' => 'banner/banner-4.jpg',
                'filename' => 'frontend-banner-4.jpg',
            ],
        ];

        foreach ($banners as $banner) {
            $this->copyAsset($this->assetRoot.'/'.$banner['image'], $targetDir.'/'.$banner['filename']);

            $this->upsertRow('banners', ['banner_image' => $banner['filename']], [
                'section' => $banner['section'],
                'banner_text' => $banner['title'],
                'banner_text2' => $banner['description'],
                'banner_link' => '#',
                'status' => 1,
            ]);

            $this->summary['banners']++;
        }
    }

    private function seedHomePage(string $targetDir): void
    {
        $sec3Image = 'frontend-menu-banner.jpg';
        $this->copyAsset($this->assetRoot.'/menu-banner.jpg', $targetDir.'/'.$sec3Image);

        DB::table('home_pages')->updateOrInsert(['id' => 1], [
            'sec2_title' => "Saniruddh's Pick",
            'sec2_description' => 'Featured boutique selections from the frontend home page.',
            'sec3_title' => 'New Arrivals',
            'sec3_description' => 'Fresh kurta, Punjabi, sherwani and cotton shirt styles.',
            'sec3_image' => $sec3Image,
            'sec4_title' => 'Exclusive Boutique Apparels for All',
            'sec4_description' => "Men's fashion, women's style, unisex picks and showroom highlights from Kasba, Kolkata.",
            'sec5_title' => 'Blog Post',
            'sec5_description' => 'Fashion updates and collection stories from the Saniruddh storefront.',
            'sec6_title' => 'Store Location',
            'sec6_description' => 'BB-94, Sarat Park, Kasba, Kolkata - 700107',
            'sec7_title' => 'Store Info',
            'sec7_description' => 'SANIRUDDH boutique apparel showroom and online storefront.',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ([
            [
                'section' => 3,
                'size' => 'NORMAL',
                'name' => "Men's Fashion",
                'description' => 'Upto 20% on selected men apparel.',
                'image' => 'banner/banner-1.jpg',
                'filename' => 'frontend-home-men-fashion.jpg',
            ],
            [
                'section' => 3,
                'size' => 'NORMAL',
                'name' => "Women's Style",
                'description' => 'Boutique apparel styles from the frontend collection.',
                'image' => 'banner/banner-2.jpg',
                'filename' => 'frontend-home-women-style.jpg',
            ],
            [
                'section' => 3,
                'size' => 'SMALL',
                'name' => 'Unisex Pick',
                'description' => 'Easy unisex cotton styles.',
                'image' => 'banner/banner-3.jpg',
                'filename' => 'frontend-home-unisex-pick.jpg',
            ],
            [
                'section' => 5,
                'size' => 'NORMAL',
                'name' => 'Hot Summer Fashion for Women',
                'description' => 'New collections arrive from the frontend blog section.',
                'image' => 'blog/blog-01.jpg',
                'filename' => 'frontend-blog-01.jpg',
            ],
            [
                'section' => 5,
                'size' => 'NORMAL',
                'name' => 'New Collection Stories',
                'description' => 'Style updates from Saniruddh.',
                'image' => 'blog/blog-02.jpg',
                'filename' => 'frontend-blog-02.jpg',
            ],
            [
                'section' => 5,
                'size' => 'NORMAL',
                'name' => 'Boutique Fashion Notes',
                'description' => 'Fresh editorial content for the storefront.',
                'image' => 'blog/blog-03.jpg',
                'filename' => 'frontend-blog-03.jpg',
            ],
        ] as $section) {
            $this->copyAsset($this->assetRoot.'/'.$section['image'], $targetDir.'/'.$section['filename']);

            $this->upsertRow('home_page2_sections', [
                'section' => $section['section'],
                'name' => $section['name'],
            ], [
                'icon' => $section['filename'],
                'short_description' => $section['description'],
                'section2_link' => '#',
                'size' => $section['size'],
                'status' => 1,
            ]);

            $this->summary['home_page_sections']++;
        }
    }

    private function copyAsset(string $source, string $target): void
    {
        if (! is_file($source)) {
            return;
        }

        copy($source, $target);
        $this->summary['images_copied']++;
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
}
