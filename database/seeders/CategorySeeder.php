<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pizza',
                'slug' => Str::slug('pizza'),
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Nước uống',
                'slug' => Str::slug('drink'),
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Món khai vị',
                'slug' => Str::slug('appetizer'),
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Món tráng miệng',
                'slug' => Str::slug('dessert'),
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Combo',
                'slug' => Str::slug('Combo'),
                'status' => 1,
                'show_at_home' => 1
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
