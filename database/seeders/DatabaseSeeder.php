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
            ProductSizeSeeder::class,
            PizzaBaseSeeder::class,
            PizzaEdgeSeeder::class,

            DeliveryAreaSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,

            CouponSeeder::class,

            OrderSeeder::class,
            ProductReviewSeeder::class,
        ]);
    }
}
