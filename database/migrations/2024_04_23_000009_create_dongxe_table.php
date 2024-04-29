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
        Schema::create('dongxe', function (Blueprint $table) {
            $table->string('madx',15);
            $table->string('mahx',5);
            $table->string('loaixe',15);
            $table->string('tendongxe',50);
            $table->string('mota',50)->nullable();

            $table->primary('madx');
            $table->foreign('mahx')->references('mahx')->on('hangxe')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dongxe');
    }
};
