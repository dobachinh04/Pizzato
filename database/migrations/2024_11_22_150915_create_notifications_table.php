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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Loại thông báo (e.g., order_overdue)
            $table->unsignedBigInteger('reference_id'); // ID liên kết (e.g., order_id)
            $table->text('message'); // Nội dung thông báo
            $table->boolean('is_read')->default(false); // Đã đọc hay chưa
            $table->timestamp('read_at')->nullable();
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->softDeletes(); // Thêm trường deleted_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
