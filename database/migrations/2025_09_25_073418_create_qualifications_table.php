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
        Schema::create('qualifications', function (Blueprint $table) {
             $table->id(); 
    $table->unsignedBigInteger('applicant_id'); 

    $table->string('pendidikan_terakhir');
    $table->string('jurusan');
    $table->integer('tahun_lulus');

    $table->text('pengalaman_kerja')->nullable();
    $table->text('skill_teknis')->nullable();
    $table->text('skill_non_teknis')->nullable();

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
        Schema::dropIfExists('qualifications');
    }
};
