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
        Schema::create('cthoadon', function (Blueprint $table) {
            $table->string('macthoadon', 15);
            $table->string('mahoadon', 10);
            $table->string('maxe',15)->nullable();
            $table->tinyInteger('soluong',false,false)->nullable();
            $table->decimal('dongia',10,2);
            
            $table->primary('macthoadon');
            $table->foreign('mahoadon')->references('mahoadon')->on('hoadon')->onDelete('cascade');
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
        Schema::dropIfExists('cthoadon');
    }
};
