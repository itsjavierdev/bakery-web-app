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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 8, 2);

            $table->foreignId('sale_id')
                ->constrained()
                ->onDelete('restrict');

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
        Schema::dropIfExists('payments');
    }
};
