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
        Schema::table('interventions', function (Blueprint $table) {
            if (!Schema::hasColumn('interventions', 'order')) {
                $table->integer('order')->default(0)->after('category');
            }

            if (!Schema::hasColumn('interventions', 'diagnosis_id')) {
                $table->foreignId('diagnosis_id')->nullable()->after('id')->constrained('diagnosis')->onDelete('set null');
            }

            if (!Schema::hasColumn('interventions', 'description')) {
                $table->text('description')->nullable()->after('name');
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
        Schema::table('interventions', function (Blueprint $table) {
            if (Schema::hasColumn('interventions', 'order')) {
                $table->dropColumn('order');
            }

            if (Schema::hasColumn('interventions', 'diagnosis_id')) {
                $table->dropForeign(['diagnosis_id']);
                $table->dropColumn('diagnosis_id');
            }

            if (Schema::hasColumn('interventions', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
