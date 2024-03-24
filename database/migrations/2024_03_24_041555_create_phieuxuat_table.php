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
        Schema::create('phieuxuat', function (Blueprint $table) {
            $table->string('maphieuxuat',20);
            $table->string('khohang_id',10);
            $table->string('nhanvien_id',10);
            $table->date('ngayxuat');
            $table->string('dvt',10)->nullable();
            $table->integer('soluong');
            $table->decimal('thanhtien',12,2);

            $table->primary('maphieuxuat');
            $table->foreign('khohang_id')->references('makho')->on('khohang')->onDelete('cascade');
            $table->foreign('nhanvien_id')->references('manv')->on('nhanvien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieuxuat');
    }
};
