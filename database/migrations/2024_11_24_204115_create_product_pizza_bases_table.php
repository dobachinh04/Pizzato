<?php

use App\Models\PizzeBase;
use App\Models\Product;
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
        Schema::create('product_pizza_bases', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(PizzeBase::class)->constrained();

            $table->primary(['product_id', 'pizze_base_id']);

            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pizza_bases');
    }
};
