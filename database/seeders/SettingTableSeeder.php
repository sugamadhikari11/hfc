<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settingData = [
            'name' => 'New Super Electrician Service Nepal',
            'slug' => 'new-super-electrician-service-nepal',
            'sub_name' => 'New Super Electrician Service Nepal',
            'slogan' => 'Fast, Reliable & Affordable Electrical and Plumbing Solutions',
            'email' => 'info@humanrightpjcf.org',
            'address' => 'Putalisadak, Kathmandu, Nepal',
            'phone' => '9863482559',
            'mobile' => '9863482559',
            'logo' => '',
            'favicon' => '',
            'description' => "New Super Electrician Service Nepal, also known as Electrician Service Nepal 24, delivers professional electrical and plumbing services throughout Kathmandu Valley. From installations to emergency repairs, our expert technicians guarantee safety, speed, and satisfaction at competitive prices. We're available 24/7 to keep your home or office running smoothly.",
            'meta_title' => 'New Super Electrician & Plumbing Services in Kathmandu | Nepal 24/7',
            'meta_description' => 'New Super Electrician Service Nepal offers top-rated electrical and plumbing services in Kathmandu. Fast, reliable, and affordable – available 24/7.',
            'meta_keywords' => 'New Super Electrician Nepal, Electrician in Kathmandu, Electrical Services Nepal, Plumbing Kathmandu, 24 hour electrician, Emergency plumber Kathmandu, Electrical repair Nepal',
        ];
        $total = Setting::count();
        if ($total == 0) {
            Setting::create($settingData);
        }

    }
}
