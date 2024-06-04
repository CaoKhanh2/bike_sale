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
            $table->string('mahoadon',10);
            $table->string('manv',10)->nullable();
            $table->string('mand',10);
            $table->string('madh',12);
            $table->dateTime('ngaytaohoadon')->useCurrent();
            $table->decimal('thuegt',10,2)->nullable();
            $table->decimal('tonggiatrihoadon',12,2)->nullable();
            $table->text('ghichu')->nullable();

            $table->primary('mahoadon');
            $table->foreign('manv')->references('manv')->on('nhanvien')->onDelete('cascade');
            $table->foreign('mand')->references('mand')->on('nguoidung')->onDelete('cascade');
            $table->foreign('madh')->references('madh')->on('donhang')->onDelete('cascade');
    
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
