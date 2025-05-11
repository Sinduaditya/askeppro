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
        Schema::table('case_implementations', function (Blueprint $table) {
            // Tambahkan kolom waktu jika belum ada
            if (!Schema::hasColumn('case_implementations', 'waktu')) {
                $table->string('waktu')->nullable()->after('performed');
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
        Schema::table('case_implementations', function (Blueprint $table) {
            if (Schema::hasColumn('case_implementations', 'waktu')) {
                $table->dropColumn('waktu');
            }
        });
    }
};
