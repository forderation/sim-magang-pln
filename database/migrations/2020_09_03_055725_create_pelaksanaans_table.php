<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaksanaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksanaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_pelaksanaan_id');
            $table->unsignedBigInteger('magang_id');
            $table->unsignedBigInteger('admin_id');
            $table->enum('status_magang', ['aktif', 'non_aktif'])->default('aktif');
            $table->foreign('surat_pelaksanaan_id')->references('id')->on('surat_terbits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('magang_id')->references('id')->on('magangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelaksanaans');
    }
}
