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
        Schema::create('ruiro', function (Blueprint $table) {
            $table->string('id',10);
            $table->string('nhanvien_id',10);
            $table->string('ttxemay_id',15)->nullable();
            $table->string('ttxedapdien_id',15)->nullable();
            $table->string('khachhang_id',20);
            $table->dateTime('ngaynhan');
            $table->dateTime('ngaygiaiquyet');
            $table->string('thongtinruiro',100);
            $table->tinyInteger('trangthaigiaiquyet');
            $table->string('phanhoinguoidung')->nullable();

            $table->primary('id');
            $table->foreign('nhanvien_id')->references('manv')->on('nhanvien')->onDelete('cascade');
            $table->foreign('khachhang_id')->references('makh')->on('khachhang')->onDelete('cascade');
            $table->foreign('ttxemay_id')->references('maxemay')->on('thongtinxemay')->onDelete('cascade');
            $table->foreign('ttxedapdien_id')->references('maxedapdien')->on('thongtinxedapdien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruiro');
    }
};
