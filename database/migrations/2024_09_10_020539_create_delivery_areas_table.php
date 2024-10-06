<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bảng địa chỉ giao hàng
        Schema::create('delivery_areas', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('area_name'); // Tên khu vực
            $table->string('min_delivery_time'); // Thời gian giao hàng tối thiểu
            $table->string('max_delivery_time'); // Thời gian giao hàng tối đa
            $table->double('delivery_fee'); // Phí giao hàng
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_areas');
    }
};
