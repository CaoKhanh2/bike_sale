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
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->string('manv',10);
            $table->string('macv',10);
            $table->string('tennv',100);
            $table->date('ngaysinh');
            $table->enum('gioitinh', ['Nam', 'Nữ', 'Other'])->nullable();
            $table->string('sodienthoai',10);
            $table->string('diachi',255);

            $table->primary('manv');
            $table->foreign('macv')->references('macv')->on('chucvu')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhanvien');
    }
};
