<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('outcomes', function (Blueprint $table) {
            // Add the missing column
            $table->foreignId('outcome_standard_id')->nullable()->after('askep_case_id')
                  ->constrained('outcome_standards')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('outcomes', function (Blueprint $table) {
            $table->dropForeign(['outcome_standard_id']);
            $table->dropColumn('outcome_standard_id');
        });
    }
};
