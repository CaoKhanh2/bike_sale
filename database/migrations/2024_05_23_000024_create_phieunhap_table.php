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
            $table->string('maphieunhap',10);
            $table->string('manv',10);
            $table->dateTime('ngaynhap');
            $table->decimal('thanhtien',12,2)->nullable();

            $table->primary('maphieunhap');
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
