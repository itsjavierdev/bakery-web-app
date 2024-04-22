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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('delivery_date');
            $table->decimal('total', 7, 1);
            $table->decimal('paid_amount', 7, 1)->nullable();
            $table->boolean('paid')->default(false);
            $table->string('notes')->nullable();

            $table->foreignId('customer_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('address_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict');

            $table->foreignId('delivery_time_id')
                ->constrained()
                ->onDelete('restrict')
                ->after('address_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
