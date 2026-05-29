<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BlogModuleSeeder extends Seeder
{
    private string $assetRoot = 'C:/Users/user/Downloads/bulk-download/assets/images/blog';

    private array $summary = [
        'tables_created' => 0,
        'categories' => 0,
        'blogs' => 0,
        'images_copied' => 0,
    ];

    public function run(): void
    {
        $this->createTablesIfMissing();
        $this->seedBlogs();

        $this->command?->info('Blog module seed complete: '.json_encode($this->summary));
    }

    private function createTablesIfMissing(): void
    {
        if (! Schema::hasTable('blog_categories')) {
            Schema::create('blog_categories', function (Blueprint $table): void {
                $table->increments('id');
                $table->string('name', 250)->nullable();
                $table->string('slug', 250)->nullable()->index();
                $table->longText('description')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });

            $this->summary['tables_created']++;
        }

        if (! Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table): void {
                $table->increments('id');
                $table->unsignedInteger('blog_category_id')->default(0)->index();
                $table->string('title', 250)->nullable();
                $table->string('slug', 250)->nullable()->index();
                $table->string('blog_image', 250)->nullable();
                $table->longText('short_description')->nullable();
                $table->longText('long_description')->nullable();
                $table->date('publish_date')->nullable();
                $table->longText('meta_title')->nullable();
                $table->longText('meta_description')->nullable();
                $table->longText('meta_keywords')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });

            $this->summary['tables_created']++;
        }
    }

    private function seedBlogs(): void
    {
        $targetDir = public_path('uploads/blog');

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $items = [
            [
                'category' => 'Women',
                'title' => 'Hot Summer Fashion for Women new collections arrives',
                'image' => 'blog-01.jpg',
                'filename' => 'frontend-blog-01.jpg',
            ],
            [
                'category' => 'Fashion',
                'title' => 'Hot Summer Fashion for Women new collections arrives',
                'image' => 'blog-02.jpg',
                'filename' => 'frontend-blog-02.jpg',
            ],
            [
                'category' => 'Men',
                'title' => 'Hot Summer Fashion for Women new collections arrives',
                'image' => 'blog-03.jpg',
                'filename' => 'frontend-blog-03.jpg',
            ],
        ];

        foreach ($items as $item) {
            $categoryId = $this->upsertRow('blog_categories', ['slug' => $this->slug($item['category'])], [
                'name' => $item['category'],
                'description' => $item['category'].' blog posts',
                'status' => 1,
            ]);

            $this->summary['categories']++;
            $this->copyAsset($this->assetRoot.'/'.$item['image'], $targetDir.'/'.$item['filename']);

            $slug = $this->slug($item['title'].' '.$item['category']);
            $description = $item['title'].' from the Saniruddh homepage blog section.';

            $this->upsertRow('blogs', ['slug' => $slug], [
                'blog_category_id' => $categoryId,
                'title' => $item['title'],
                'blog_image' => $item['filename'],
                'short_description' => $description,
                'long_description' => $description,
                'publish_date' => '2020-10-14',
                'meta_title' => $item['title'],
                'meta_description' => $description,
                'meta_keywords' => $item['category'].', blog, fashion, Saniruddh',
                'status' => 1,
            ]);

            $this->summary['blogs']++;
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

    private function slug(string $value): string
    {
        $slug = strtolower((string) preg_replace('/[^A-Za-z0-9]+/', '-', trim($value)));

        return trim((string) preg_replace('/-+/', '-', $slug), '-');
    }
}
