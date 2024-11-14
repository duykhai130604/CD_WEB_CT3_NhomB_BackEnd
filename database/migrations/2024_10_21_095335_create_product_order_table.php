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
        Schema::create('product_order', function (Blueprint $table) {
            $table->id()->unsigned();  
            $table->integer('product_variant_id');
            $table->integer('order_id');
            $table->integer('quantity');
            $table->integer('total');
            $table->integer('rate')->default(0);
            $table->integer('status')->default(3);
            $table->text('reason')->nullable()->collation('utf8mb4_unicode_ci');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_order');
    }
};
