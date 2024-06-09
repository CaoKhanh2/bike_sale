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
        Schema::create('hangxe', function (Blueprint $table) {
            $table->string('mahx',5);
            $table->string('tenhang',50);
            $table->string('logo')->nullable();
            $table->string('xuatxu',20)->nullable();

            $table->primary('mahx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hangxe');
    }
};
