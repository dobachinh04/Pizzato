<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delay_notifications', function (Blueprint $table) {
            $table->id(); // ID chính
            $table->string('invoice_id')->unique(); // Mã đơn hàng
            $table->text('reason'); // Lý do chậm trễ
            $table->text('solution')->nullable(); // Giải pháp đề xuất
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delay_notifications');
    }
};