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
        // Tạo 20 người dùng ngẫu nhiên
        User::factory(28)->create();

        // Tạo tài khoản admin cụ thể
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'), // Mật khẩu 123456
            'role_id' => 2,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'), // Mật khẩu 123456
            'role_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'flux.cql@gmail.com',
            'password' => bcrypt('123456'), // Mật khẩu 123456
            'role_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);


    }
}
