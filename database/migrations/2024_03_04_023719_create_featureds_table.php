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
        Schema::create('featureds', function (Blueprint $table) {
            $table->id();
            $table->string('title', 40)->nullable();
            $table->string('image');
            $table->integer('position');
            $table->boolean('is_active')->default(true);
            $table->boolean('has_filter')->default(true);

            $table->foreignId('product_id')
                ->nullable()
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
        Schema::dropIfExists('featureds');
    }
};
