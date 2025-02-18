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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 8, 2);
            $table->boolean('paid')->default(false);
            $table->integer('total_quantity');
            $table->decimal('paid_amount', 8, 2)->nullable();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->foreignId('staff_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
