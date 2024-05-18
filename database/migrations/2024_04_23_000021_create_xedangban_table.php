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
        Schema::create('xedangban', function (Blueprint $table) {
            $table->string('maxedangban',20);
            $table->string('maxe',15);
            $table->string('makhuyenmai',5)->nullable();
            $table->string('manv',10)->nullable();
            $table->dateTime('ngayban');
            $table->year('namsx');
            $table->decimal('giaban',10,2);
            $table->text('mota');
            $table->enum('trangthai',['Đã bán xe','Còn xe']);


            $table->primary('maxedangban');
            $table->foreign('manv')->references('manv')->on('nhanvien')->onDelete('cascade');
            $table->foreign('maxe')->references('maxe')->on('thongtinxe')->onDelete('cascade');
            $table->foreign('makhuyenmai')->references('makhuyenmai')->on('khuyenmai')->onDelete('cascade');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xedangban');
    }
};
