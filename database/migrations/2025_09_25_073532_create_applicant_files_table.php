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
        Schema::create('applicant_files', function (Blueprint $table) {
            $table->id();
    $table->unsignedBigInteger('applicant_id'); 

    $table->string('file_path');     
    $table->string('link_dokumen');  

    $table->foreign('applicant_id')
          ->references('id')->on('applicants')
          ->onDelete('cascade');
          $table->timestamps();
        });
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_files');
    }
};
