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
        Schema::create('khachhang', function (Blueprint $table) {
            $table->string('makh',10);
            $table->string('hovaten',50);
            $table->date('ngaysinh')->nullable();
            $table->enum('gioitinh',['Nam','Nữ','Other']);
            $table->string('sodienthoai',11);
            $table->string('email',35);
            $table->string('diachi',100)->nullable();
            $table->string('tentk',20);
            $table->string('password',20);
            $table->tinyInteger('tinhtrang')->default(0);
            
            $table->primary('makh');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khachhang');
    }
};
