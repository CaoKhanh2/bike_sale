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
        Schema::create('xedangkyban', function (Blueprint $table) {
            $table->string('madkbanxe',30);
            $table->string('ttxemay_id',15)->nullable();
            $table->string('ttxedapdien_id',15)->nullable();
            $table->string('khachhang_id',10);
            $table->date('namdk');
            $table->string('dungtichxe',10);
            $table->string('xuatxu',25);
            $table->float('sokmdadi',6,2);
            $table->decimal('giaban',10,2);
            $table->text('motachitiet')->nullable();
            $table->tinyInteger('trangthai');

            $table->primary('madkbanxe');
            $table->foreign('khachhang_id')->references('makh')->on('khachhang')->onDelete('cascade');
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
        Schema::dropIfExists('xedangkyban');
    }
};
