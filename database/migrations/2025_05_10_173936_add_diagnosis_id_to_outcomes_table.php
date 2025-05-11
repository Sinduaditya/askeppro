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
            // Tambahkan kolom diagnosis_id jika belum ada
            if (!Schema::hasColumn('outcomes', 'diagnosis_id')) {
                $table->unsignedBigInteger('diagnosis_id')->nullable()->after('id');
                $table->foreign('diagnosis_id')->references('id')->on('diagnosis')
                      ->onDelete('cascade')->onUpdate('cascade');
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
            // Hapus kolom dan foreign key jika ada
            if (Schema::hasColumn('outcomes', 'diagnosis_id')) {
                $table->dropForeign(['diagnosis_id']);
                $table->dropColumn('diagnosis_id');
            }
        });
    }
};
