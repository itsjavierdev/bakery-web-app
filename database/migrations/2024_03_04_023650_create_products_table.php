<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25)->unique();
            $table->string('description')->nullable();
            $table->decimal('price', 5, 2);
            $table->decimal('price_by_bag', 5, 2);
            $table->integer('bag_quantity')->default(1);
            $table->boolean('discontinued')->default(false);
            $table->string('slug', 30)->unique();

            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('restrict');

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
