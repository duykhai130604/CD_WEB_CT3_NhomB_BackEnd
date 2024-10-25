<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up(): void
    {
        // Schema::create('media', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->morphs('medially'); // This creates both 'medially_type' and 'medially_id'
        //     $table->text('file_url');
        //     $table->string('file_name');
        //     $table->string('file_type')->nullable();
        //     $table->unsignedBigInteger('size');
        //     $table->timestamps();
        
        //     // Limit the length of the 'medially_type' index to avoid exceeding the key length
        //     $table->index(['medially_type', 'medially_id'], 'media_medially_type_medially_id_index', 'medially_type(191)');
        // });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
}
