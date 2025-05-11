
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
        Schema::table('outcome_standards', function (Blueprint $table) {
            if (!Schema::hasColumn('outcome_standards', 'order')) {
                $table->integer('order')->default(0)->after('name');
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
        Schema::table('outcome_standards', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
