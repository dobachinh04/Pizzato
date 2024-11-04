<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CartSeeder::class,
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Test User',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('user'),
        //     'role_id' => '1',
        // ]);
    }
}
