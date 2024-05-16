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
            $table->string('manv',10);
            $table->string('mand',10);
            $table->string('maxe',15)->nullable();
            $table->dateTime('ngaytaohoadon');
            $table->decimal('dongia',10,2);
            $table->decimal('thuegt',10,2)->nullable();
            $table->decimal('tonggiatrihoadon',12,2);
            $table->text('ghichu')->nullable();

            $table->primary('mahoadon');
            $table->foreign('manv')->references('manv')->on('nhanvien')->onDelete('cascade');
            $table->foreign('mand')->references('mand')->on('nguoidung')->onDelete('cascade');
            $table->foreign('maxe')->references('maxe')->on('thongtinxe')->onDelete('cascade');
    
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
