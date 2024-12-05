<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 10 địa chỉ ngẫu nhiên cho người dùng
        Address::factory()->count(100)->create();
    }
}
