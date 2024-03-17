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
            $table->string('chucvu_id',5);
            $table->string('hovaten',50);
            $table->date('ngaysinh');
            $table->enum('gioitinh', ['Nam', 'Nữ', 'Other'])->nullable();
            $table->char('sodienthoai',11);
            $table->string('email',35);
            $table->string('diachi',255);
            $table->text('ghichu');

            $table->primary('manv');
            $table->foreign('chucvu_id')->references('macv')->on('chucvu')->onDelete('cascade');

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
