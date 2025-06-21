<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial\Testimonial;

class TestimonialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonialData = [
            [
                'name' => 'Ramesh Adhikari',
                'designation' => 'CEO, Tech Innovations',
                'description' => "I had an urgent power outage late at night, and New Super Electrician Service Nepal responded immediately. Their emergency service was quick, professional, and budget-friendly. Truly a lifesaver!",
                'image' => '',
                'status' => 1
            ],
            [
                'name' => 'Sita Sharma',
                'designation' => 'Manager, Green Valley Resort',
                'description' => "New Super Electrician Service Nepal provided exceptional service during our recent electrical upgrade. Their team was knowledgeable, efficient, and respectful of our property. Highly recommend!",
                'image' => '',
                'status' => 1
            ],
            [
                'name' => 'Rajesh Thapa',
                'designation' => 'Owner, Thapa Enterprises',
                'description' => "I was impressed with the professionalism and expertise of New Super Electrician Service Nepal. They handled our commercial project with precision and care. Will definitely hire them again!",
                'image' => '',
                'status' => 1
            ],

        ];

        foreach ($testimonialData as $data) {
            $totalTestimonial = Testimonial::where('name', $data['name'])->count();
            if ($totalTestimonial === 0) {
                Testimonial::create($data);
            }
        }


    }
}
