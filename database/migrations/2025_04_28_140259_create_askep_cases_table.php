<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('askep_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            // Tambahkan kolom diagnosis_id tanpa foreign key constraint
            $table->unsignedBigInteger('diagnosis_id')->nullable();
            // Tambahkan kolom etiology_id
            $table->unsignedBigInteger('etiology_id')->nullable();
            // Tambahkan kolom cause
            $table->string('cause')->nullable();
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('askep_cases');
    }
};
