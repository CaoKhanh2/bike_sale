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
            $table->string('makho',10);
            $table->string('maxe',15)->nullable();
            $table->string('manv',10);
            $table->dateTime('ngaynhap');
            $table->decimal('thanhtien',12,2);

            $table->primary('maphieunhap');
            $table->foreign('makho')->references('makho')->on('khohang')->onDelete('cascade');
            $table->foreign('maxe')->references('maxe')->on('thongtinxe')->onDelete('cascade');
            $table->foreign('manv')->references('manv')->on('nhanvien')->onDelete('cascade');
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
