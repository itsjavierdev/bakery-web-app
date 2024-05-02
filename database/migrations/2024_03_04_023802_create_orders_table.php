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
            $table->decimal('total', 8, 2);
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->boolean('paid')->default(false);
            $table->integer('total_quantity');
            $table->boolean('delivered')->default(false);
            $table->string('notes')->nullable();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

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
