<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_implementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('askep_case_id')->constrained('askep_cases')->onDelete('cascade');
            $table->foreignId('intervention_id')->constrained('interventions')->onDelete('cascade');
            $table->boolean('performed')->default(false);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('case_implementations');
    }
};
