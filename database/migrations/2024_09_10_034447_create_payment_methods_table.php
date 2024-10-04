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
        // Bảng phương thức thanh toán
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // ID đơn hàng
            $table->string('method'); // 'cash', 'online' 'dư nợ'
            // $table->decimal('amount', 10, 2); // Số tiền đã thanh toán
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
