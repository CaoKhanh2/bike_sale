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
        Schema::create('danhmucxe', function (Blueprint $table) {
            $table->id();
            $table->string('maloai', 10);
            $table->string('tenxe', 10);
            $table->string('hinhanh', 255);
            $table->string('hangxe_id',10);

            $table->foreign('maloai')->references('maloai')->on('loaixe')->onDelete('cascade');
            $table->foreign('hangxe_id')->references('id')->on('hangxe')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danhmucxe');
    }
};
