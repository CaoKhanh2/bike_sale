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
            $table->string('magh',10);
            $table->string('maxe',15)->nullable();
            $table->string('makhuyenmai',5);
            $table->integer('soluong');
            $table->decimal('dongia',10,2);

            $table->primary('mactgh');
            $table->foreign('magh')->references('magh')->on('giohang')->onDelete('cascade');
            $table->foreign('maxe')->references('maxe')->on('thongtinxe')->onDelete('cascade');
            $table->foreign('makhuyenmai')->references('makhuyenmai')->on('khuyenmai')->onDelete('cascade');


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
