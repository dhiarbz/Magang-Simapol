<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('ttg');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->text('alamat_ktp');
            $table->text('alamat_domisili');
            $table->string('nomor_hp');
            $table->text('isi_laporan');
            $table->string('bukti_1')->nullable();
            $table->string('bukti_2')->nullable();
            $table->string('bukti_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
