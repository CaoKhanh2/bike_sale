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
            $table->string('manv',10);
            $table->string('maxe',15)->nullable();
            $table->string('mand',20);
            $table->dateTime('ngaynhan');
            $table->dateTime('ngaygiaiquyet');
            $table->string('thongtinruiro',100);
            $table->tinyInteger('trangthaigiaiquyet');
            $table->string('phanhoinguoidung')->nullable();

            $table->primary('id');
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
        Schema::dropIfExists('ruiro');
    }
};
