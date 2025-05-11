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
        Schema::table('outcomes', function (Blueprint $table) {
            if (!Schema::hasColumn('outcomes', 'final_value')) {
                $table->integer('final_value')->nullable()->after('target_value');
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
        Schema::table('outcomes', function (Blueprint $table) {
            if (Schema::hasColumn('outcomes', 'final_value')) {
                $table->dropColumn('final_value');
            }
        });
    }
};
