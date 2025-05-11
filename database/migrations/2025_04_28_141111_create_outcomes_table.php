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
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('askep_case_id')->constrained('askep_cases')->onDelete('cascade');
            
            $table->string('name');
            $table->integer('initial_value');
            $table->integer('target_value');
            $table->timestamps();
        });
    }

    /**
     */
    public function down()
    {
        Schema::dropIfExists('outcomes');
    }
};
