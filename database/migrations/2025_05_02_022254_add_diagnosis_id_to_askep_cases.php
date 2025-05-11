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
        Schema::table('askep_cases', function (Blueprint $table) {
            // Tambahkan kolom diagnosis_id jika belum ada
            if (!Schema::hasColumn('askep_cases', 'diagnosis_id')) {
                $table->foreignId('diagnosis_id')->nullable()->after('patient_id')->constrained('diagnosis')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('askep_cases', function (Blueprint $table) {
            $table->dropForeign(['diagnosis_id']);
            $table->dropColumn('diagnosis_id');
        });
    }
};
