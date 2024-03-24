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
            $table->string('id',10);
            $table->string('khohang_id',5);
            $table->string('ttxemay_id',15)->nullable();
            $table->string('ttxedapdien_id',15)->nullable();
            $table->string('tinhtrangxe',25);
            $table->decimal('gianhapkho',12,2)->nullable();
            $table->date('ngaynhapkho');
            $table->integer('soluong');

            $table->primary('id');
            $table->foreign('khohang_id')->references('makho')->on('khohang')->onDelete('cascade');
            $table->foreign('ttxemay_id')->references('maxemay')->on('thongtinxemay')->onDelete('cascade');
            $table->foreign('ttxedapdien_id')->references('maxedapdien')->on('thongtinxedapdien')->onDelete('cascade');
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
