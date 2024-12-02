<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('sender_id'); // ID của người gửi (admin/client)
        $table->unsignedBigInteger('receiver_id'); // ID của người nhận
        $table->text('message'); // Nội dung tin nhắn
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
