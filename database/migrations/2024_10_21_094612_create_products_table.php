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
            $table->id()->unsigned(); 
            $table->string('name', 255)->collation('utf8mb4_unicode_ci');
            $table->text('desc')->collation('utf8mb4_unicode_ci'); 
            $table->integer('price'); 
            $table->integer('discount'); 
            $table->integer('status'); 
            $table->timestamp('created_at')->nullable()->useCurrent(); 
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
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
