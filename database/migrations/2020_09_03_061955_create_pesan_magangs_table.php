<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->boolean('read_user')->default(false);
            $table->unsignedBigInteger('magang_id');
            $table->unsignedBigInteger('admin_id');
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
        Schema::dropIfExists('pesan_magangs');
    }
}
