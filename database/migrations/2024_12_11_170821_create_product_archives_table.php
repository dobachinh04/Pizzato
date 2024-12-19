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
        Schema::create('product_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumb_image')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->double('price');
            $table->double('offer_price')->nullable()->default(0);
            $table->integer('qty')->default(0);
            $table->string('sku')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_archives');
    }
};
