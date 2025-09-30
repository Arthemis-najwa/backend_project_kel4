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
        Schema::create('vacancies', function (Blueprint $table) {
             $table->id(); 

    $table->unsignedBigInteger('company_id');
    $table->unsignedBigInteger('qualification_id');

    $table->string('posisi');

    $table->foreign('company_id')
          ->references('id')->on('companies')
          ->onDelete('cascade');

    $table->foreign('qualification_id')
          ->references('id')->on('qualifications')
          ->onDelete('cascade');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
