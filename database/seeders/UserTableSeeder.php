<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin002'),
                'email_verified_at' => now(),

            ],

        ];

        foreach ($userData as $user) {
            $total = User::where('email', $user['email'])->count();
            if ($total == 0) {
                User::create($user);
            }
        }


    }
}
