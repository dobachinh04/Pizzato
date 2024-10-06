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
        // Bảng bình luận blog
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade'); // ID blog
            $table->foreignId('user_id'); // ID người dùng
            $table->text('comment'); // Bình luận
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
