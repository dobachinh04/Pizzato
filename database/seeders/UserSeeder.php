<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();

        // $users = [];

        // // Tạo 3 user cho mỗi role
        // for ($i = 0; $i < 5; $i++) {
        //     // User cho admin
        //     $users[] = [
        //         'name' => $faker->name,
        //         'image' => $faker->imageUrl(640, 480, 'people'),
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'), // Mật khẩu giả
        //         'role_id' => 2, // ID cho admin
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];

        //     // User cho regular user
        //     $users[] = [
        //         'name' => $faker->name,
        //         'image' => $faker->imageUrl(640, 480, 'people'),
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'), // Mật khẩu giả
        //         'role_id' => 1, // ID cho user
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];

        //     // User cho employee
        //     $users[] = [
        //         'name' => $faker->name,
        //         'image' => $faker->imageUrl(640, 480, 'people'),
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'), // Mật khẩu giả
        //         'role_id' => 3, // ID cho employee
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // Tạo 10 người dùng
        $users = User::factory()->count(10)->create();

        // Tạo địa chỉ cho mỗi người dùng
        $users->each(function ($user) {
            \App\Models\Address::factory()->create([
                'user_id' => $user->id,  // Gán địa chỉ cho người dùng đã tạo
            ]);
        });
    }
}
