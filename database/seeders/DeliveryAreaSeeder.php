<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'area_name' => 'Hà Nội',
                'min_delivery_time' => '30 phút',
                'max_delivery_time' => '60 phút',
                'delivery_fee' => 20000,
                'status' => 1,
            ],
            [
                'area_name' => 'Hồ Chí Minh',
                'min_delivery_time' => '45 phút',
                'max_delivery_time' => '90 phút',
                'delivery_fee' => 25000,
                'status' => 1,
            ],
        ];

        // Thêm dữ liệu vào bảng
        DB::table('delivery_areas')->insert($areas);
    }
}
