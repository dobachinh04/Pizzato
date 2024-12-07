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
            // [
            //     'name' => 'Chưa phân loại',
            //     'slug' => Str::slug('pizza'),
            //     'image' => 'https://t3.ftcdn.net/jpg/07/70/75/16/360_F_770751689_FZdxDkfXHjeKTK4C49yapEIkiuafVJEY.jpg',
            //     'status' => 1,
            //     'show_at_home' => 1
            // ],
            [
                'name' => 'Pizza',
                'slug' => Str::slug('pizza'),
                'image' => 'https://t3.ftcdn.net/jpg/07/70/75/16/360_F_770751689_FZdxDkfXHjeKTK4C49yapEIkiuafVJEY.jpg',
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Nước uống',
                'slug' => Str::slug('drink'),
                'image' => 'https://t3.ftcdn.net/jpg/07/70/75/16/360_F_770751689_FZdxDkfXHjeKTK4C49yapEIkiuafVJEY.jpg',
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Món khai vị',
                'slug' => Str::slug('appetizer'),
                'image' => 'https://t3.ftcdn.net/jpg/07/70/75/16/360_F_770751689_FZdxDkfXHjeKTK4C49yapEIkiuafVJEY.jpg',
                'status' => 1,
                'show_at_home' => 1
            ],
            [
                'name' => 'Món tráng miệng',
                'slug' => Str::slug('dessert'),
                'image' => 'https://t3.ftcdn.net/jpg/07/70/75/16/360_F_770751689_FZdxDkfXHjeKTK4C49yapEIkiuafVJEY.jpg',
                'status' => 1,
                'show_at_home' => 1
            ],
            // [
            //     'name' => 'Combo',
            //     'slug' => Str::slug('Combo'),
            //     'image' => 'https://t3.ftcdn.net/jpg/07/70/75/16/360_F_770751689_FZdxDkfXHjeKTK4C49yapEIkiuafVJEY.jpg',
            //     'status' => 1,
            //     'show_at_home' => 1
            // ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
