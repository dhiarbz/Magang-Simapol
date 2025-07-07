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
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('hari');
            $table->date('tanggal');
            $table->string('jam');
            $table->enum('gender',['Laki-laki','Perempuan']);
            $table->string('nama');
            $table->string('ttg');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->text('domisili');
            $table->string('no_hp');
            $table->string('nik');
            $table->text('tujuan');
            $table->string('tempat_kejadian');
            $table->date('tanggal_kejadian');
            $table->text('kerugian');
            $table->text('teradu');
            $table->string('korban');
            $table->text('modus');
            $table->enum('keterangan',['belum','sudah pernah dilaporkan'])->default('belum');
            $table->string('penerima');
            $table->string('jabatan');
            $table->string('nrp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
