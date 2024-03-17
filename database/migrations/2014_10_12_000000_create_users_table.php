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
        Schema::create('users', function (Blueprint $table) {
            $table->string('matk',25);
            $table->string('nhanvien_id',10);
            $table->string('khachhang_id',25);
            $table->string('tentk',50);
            $table->string('password');
            $table->string('email',35);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('phanquyen',['Quản trị viên','Nhân viên', 'Khách hàng', 'Quản lý']);
            $table->tinyInteger('trangthai');
            $table->timestamp('ngaytao')->nullable();
            $table->rememberToken();

            $table->primary('MaTK');
            $table->foreign('nhanvien_id')->references('manv')->on('nhanvien')->onDelete('cascade');
            $table->foreign('khachhang_id')->references('makh')->on('khachhang')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
