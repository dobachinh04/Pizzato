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
        // Bảng mã giảm giá
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            // $table->integer('qty');
            $table->integer('qty')->default(0);
            $table->integer('min_purchase_amount')->default(0);
            $table->timestamps();
            $table->dateTime('expire_date');
            $table->enum('discount_type', ['percent', 'amount']);
            $table->double('discount');
            $table->double('max_discount_amount')->nullable()->comment('Giới hạn số tiền giảm tối đa nếu loại giảm giá là percent');
            $table->boolean('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
