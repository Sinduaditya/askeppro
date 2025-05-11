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
        Schema::create('case_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('askep_case_id')->constrained('askep_cases')->onDelete('cascade');
            $table->foreignId('diagnosis_id')->constrained('diagnosis')->onDelete('cascade');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->unique(['askep_case_id', 'diagnosis_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_diagnoses');
    }
};
