<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurasiDitambahToRiwayatPinjamTable extends Migration
{
    public function up()
    {
        Schema::table('riwayat_pinjam', function (Blueprint $table) {
            $table->boolean('durasi_ditambah')->default(false);
        });
    }

    public function down()
    {
        Schema::table('riwayat_pinjam', function (Blueprint $table) {
            $table->dropColumn('durasi_ditambah');
        });
    }
}
