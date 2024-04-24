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
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->string('makhuyenmai',5);
            $table->string('tenkhuyenmai',35);
            $table->string('thoigiankhuyenmai',50);
            $table->string('dieukienapdung')->nullable();
            $table->string('motakhuyenmai')->nullable();
            $table->dateTime('thoigianbatdau');
            $table->dateTime('thoigianketthuc');

            $table->primary('makhuyenmai');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khuyenmai');
    }
};
