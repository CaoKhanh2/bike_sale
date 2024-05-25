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
        Schema::create('ctkhohang', function (Blueprint $table) {
            $table->string('machitietkho',10);
            $table->string('makho',5);
            $table->string('maxe',15)->nullable();
            $table->tinyInteger('soluong',3)->nullable();
            $table->decimal('gianhapkho',12,2)->nullable();
            $table->date('ngaynhapkho');
            $table->enum('trangthai', ['Đang xử lý','Đã xuất kho', 'Còng trong kho'])->nullable();

            $table->primary('machitietkho');
            $table->foreign('makho')->references('makho')->on('khohang')->onDelete('cascade');
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
        Schema::dropIfExists('ctkhohang');
    }
};
