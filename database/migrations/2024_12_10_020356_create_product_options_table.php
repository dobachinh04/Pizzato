<?php

use App\Models\PizzaBase;
use App\Models\PizzaEdge;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            // $table->foreignIdFor(Product::class)->constrained();
            // $table->foreignId('size_id')->nullable()->constrained('product_sizes'); // Rõ ràng tên cột
            // $table->foreignId('edge_id')->nullable()->constrained('pizza_edges'); // Rõ ràng tên cột
            // $table->foreignId('base_id')->nullable()->constrained('pizza_bases'); // Rõ ràng tên cột

            // $table->double('price');
            // $table->timestamps();

            // // Đảm bảo tên cột trong unique chính xác
            // $table->unique(['product_id', 'size_id', 'edge_id', 'base_id'], 'unique_product_options')
            //     ->whereNotNull('size_id')
            //     ->whereNotNull('edge_id')
            //     ->whereNotNull('base_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_options');
    }
};
