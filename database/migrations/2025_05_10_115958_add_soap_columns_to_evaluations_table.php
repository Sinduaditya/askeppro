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
        Schema::table('evaluations', function (Blueprint $table) {
            $table->string('evaluation_time')->nullable()->after('notes');
            $table->text('subjective')->nullable()->after('evaluation_time');
            $table->text('objective')->nullable()->after('subjective');
            $table->text('assessment')->nullable()->after('objective');
            $table->text('plan')->nullable()->after('assessment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn([
                'evaluation_time',
                'subjective',
                'objective',
                'assessment',
                'plan'
            ]);
        });
    }
};
