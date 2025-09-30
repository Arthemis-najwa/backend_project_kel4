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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id(); 
    $table->string('nama_lengkap');
    $table->date('tanggal_lahir');
    $table->integer('usia'); 
    $table->char('jenis_kelamin', 1); // L / P
    $table->string('status_pernikahan');
    $table->string('alamat');
    $table->string('no_telp');
    $table->string('email')->unique();

    $table->string('pendidikan_terakhir');
    $table->string('jurusan');
    $table->integer('tahun_lulus');

    $table->text('pengalaman_kerja')->nullable();
    $table->text('skill_teknis')->nullable();
    $table->text('skill_non_teknis')->nullable();
    $table->string('status_vaksinasi')->nullable();
    $table->string('perusahaan_tujuan')->nullable();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
