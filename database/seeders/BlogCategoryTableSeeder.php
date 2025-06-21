<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog\BlogCategory;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            ['name' => 'Electrical Tips', 'slug' => 'electrical-tips', 'user_id' => 1],
            ['name' => 'Home Wiring', 'slug' => 'home-wiring', 'user_id' => 1],
            ['name' => 'Commercial Services', 'slug' => 'commercial-services', 'user_id' => 1],
            ['name' => 'Energy Efficiency', 'slug' => 'energy-efficiency', 'user_id' => 1],
            ['name' => 'Safety Tips', 'slug' => 'safety-tips', 'user_id' => 1],
            ['name' => 'Smart Home', 'slug' => 'smart-home', 'user_id' => 1],
            ['name' => 'Product Reviews', 'slug' => 'product-reviews', 'user_id' => 1],
            ['name' => 'Industry News', 'slug' => 'industry-news', 'user_id' => 1],
        ];

        foreach ($categoryData as $data) {
            $total = BlogCategory::where('slug', $data['slug'])->count();
            if ($total == 0) {
                BlogCategory::create($data);
            }
        }
    }
}
