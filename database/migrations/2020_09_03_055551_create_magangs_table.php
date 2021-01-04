<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('divisi_id');
            $table->string('surat_pemohon');
            $table->string('proposal');
            $table->integer('jangka_waktu');
            $table->enum('status_pengajuan', ['diterima', 'ditolak', 'proses'])->default('proses');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
            $table->foreign('lead_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magangs');
    }
}
