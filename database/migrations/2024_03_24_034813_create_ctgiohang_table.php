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
        Schema::create('ctgiohang', function (Blueprint $table) {
            $table->string('mactgh',15);
            $table->string('giohang_id',10);
            $table->string('ttxemay_id',15)->nullable();
            $table->string('ttxedapdien_id',15)->nullable();
            $table->string('khuyenmai_id',5);
            $table->integer('soluong');
            $table->decimal('dongia',10,2);

            $table->primary('mactgh');
            $table->foreign('giohang_id')->references('magh')->on('giohang')->onDelete('cascade');
            $table->foreign('ttxemay_id')->references('maxemay')->on('thongtinxemay')->onDelete('cascade');
            $table->foreign('ttxedapdien_id')->references('maxedapdien')->on('thongtinxedapdien')->onDelete('cascade');
            $table->foreign('khuyenmai_id')->references('makhuyenmai')->on('khuyenmai')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctgiohang');
    }
};
