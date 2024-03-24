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
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->string('maphieunhap',20);
            $table->string('khohang_id',10);
            $table->string('ttxemay_id',15)->nullable();
            $table->string('ttxedapdien_id',15)->nullable();
            $table->string('nhanvien_id',10);
            $table->dateTime('ngaynhap');
            $table->string('dvt',10)->nullable();
            $table->integer('soluong');
            $table->decimal('thanhtien',12,2);

            $table->primary('maphieunhap');
            $table->foreign('khohang_id')->references('makho')->on('khohang')->onDelete('cascade');
            $table->foreign('ttxemay_id')->references('maxemay')->on('thongtinxemay')->onDelete('cascade');
            $table->foreign('ttxedapdien_id')->references('maxedapdien')->on('thongtinxedapdien')->onDelete('cascade');
            $table->foreign('nhanvien_id')->references('manv')->on('nhanvien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieunhap');
    }
};
