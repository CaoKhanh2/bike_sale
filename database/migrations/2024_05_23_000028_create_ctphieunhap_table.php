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
        Schema::create('ctphieunhap', function (Blueprint $table) {
            $table->string('machitietphieunhap',15);
            $table->string('machitietkho',10);
            $table->string('maphieunhap',10);
            $table->tinyInteger('soluong',false,false)->nullable();
            $table->decimal('dongia',10,2)->nullable();

            $table->primary('machitietphieunhap');
            $table->foreign('machitietkho')->references('machitietkho')->on('ctkhohang')->onDelete('cascade');
            $table->foreign('maphieunhap')->references('maphieunhap')->on('phieunhap')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctphieunhap');
    }
};
