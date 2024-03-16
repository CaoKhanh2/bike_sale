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
            $table->id();
            $table->string('tenhang',50);
            $table->string('logo');
            $table->string('mota');
            $table->enum('tinhtrang',["hoạt động", "tạm ngừng", "ngừng kinh doanh"]);
            $table->string('thongtinlienhe');
            
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
