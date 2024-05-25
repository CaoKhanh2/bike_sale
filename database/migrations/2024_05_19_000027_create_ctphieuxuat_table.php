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
        Schema::create('ctphieuxuat', function (Blueprint $table) {
            $table->string('machitietphieuxuat',15);
            $table->string('machitietkho',10);
            $table->string('maphieuxuat',10);
            $table->tinyInteger('soluong',false,false)->nullable();
            $table->decimal('dongia',10,2)->nullable();

            $table->primary('machitietphieuxuat');
            $table->foreign('machitietkho')->references('machitietkho')->on('ctkhohang')->onDelete('cascade');
            $table->foreign('maphieuxuat')->references('maphieuxuat')->on('phieuxuat')->onDelete('cascade');
            // $table->foreign('maxe')->references('maxe')->on('thongtinxe')->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctphieuxuat');
    }
};
