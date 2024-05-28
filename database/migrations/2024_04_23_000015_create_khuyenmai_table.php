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
            $table->string('dieukienapdung')->nullable();
            $table->double('tilegiamgia',3,2);
            $table->string('motakhuyenmai')->nullable();
            $table->dateTime('thoigianbatdau');
            $table->dateTime('thoigianketthuc');
            $table->enum('hieuluc',['Còn hiệu lực','Hết hạn']);    
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
