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
        Schema::create('taikhoan', function (Blueprint $table) {
            $table->string('matk',12);
            $table->string('manv',10)->nullable();
            $table->string('tentaikhoan',20);
            $table->string('password',255);
            $table->string('email',35);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('phanquyen',['Quản trị viên','Nhân viên', 'Quản lý']);
            $table->tinyInteger('trangthai');
            // $table->timestamp('ngaytao')->current_timestamp();
            // $table->timestamp('ngaycapnhat');
            $table->timestamps();
            $table->rememberToken();

            $table->primary('matk');
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
        Schema::dropIfExists('taikhoan');
    }
};
