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
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            // $table->foreignId("store_id")->constrained("stores")->cascadeOnDelete();
            // $table->foreignId("brand_id")->constrained("brands")->cascadeOnDelete();
            $table->foreignId("currency_id")->constrained("currencies");
            $table->string('name');
            $table->decimal('price_per_unit', 8, 2);
            $table->float("discount")->nullable();
            $table->string('basic_unit'); // e.g, fibre, kg, litre, etc //
            $table->integer('quantity');
            $table->string('size');
            $table->string('color');
            $table->text('description'); // product spec and details
            $table->string('active_for_sale'); //  numbers of available items
            $table->string('status')->default('active');
            $table->softDeletes();
            $table->timestamps();
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
