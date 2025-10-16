<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('applicants')->onDelete('cascade');
            $table->foreignId('vacancy_id')->nullable()->constrained('vacancies')->onDelete('cascade');
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('jurusan')->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('skill_teknis')->nullable();
            $table->text('skill_non_teknis')->nullable();
            $table->string('status_vaksinasi', 50)->nullable();
            $table->string('status_pernikahan', 50)->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('usia')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
};
