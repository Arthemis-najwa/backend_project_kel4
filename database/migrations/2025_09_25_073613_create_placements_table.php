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
        Schema::create('placements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('applicant_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('admin_id');

            $table->foreign('applicant_id')
                ->references('id')->on('applicants')
                ->onDelete('cascade');

            $table->foreign('vacancy_id')
                ->references('id')->on('vacancies')
                ->onDelete('cascade');

            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');

            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placements');
    }
};
