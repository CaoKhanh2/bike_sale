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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->string('mahoadon',25);
            $table->string('nhanvien_id',10);
            $table->string('khachhang_id',10);
            $table->string('ttxemay_id',15)->nullable();
            $table->string('ttxedapdien_id',15)->nullable();
            $table->dateTime('ngaytaohoadon');
            $table->decimal('dongia',10,2);
            $table->decimal('thuegt',10,2)->nullable();
            $table->decimal('tonggiatrihoadon',12,2);
            $table->text('ghichu')->nullable();

            $table->primary('mahoadon');
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
        Schema::dropIfExists('hoadon');
    }
};
