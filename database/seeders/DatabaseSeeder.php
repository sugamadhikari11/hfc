<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserTableSeeder::class,
            SettingTableSeeder::class,
            MemberTypeTableSeeder::class,
            TestimonialTableSeeder::class,
            BlogCategoryTableSeeder::class,
            PageTableSeeder::class,
            SocialMediaTableSeeder::class,
        ]);
    }
}
