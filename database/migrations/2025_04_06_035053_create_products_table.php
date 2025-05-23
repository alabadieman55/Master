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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('description');
            $table->decimal('regular_price', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->string('SKU');
            $table->enum('stock_status', ['instock', 'outofstock']);
            $table->boolean('featarured')->default(false);
            $table->unsignedInteger('quantity')->default(1);
            $table->string('image');
            $table->text('images');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
