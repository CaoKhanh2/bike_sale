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
        Schema::create('vanchuyen', function (Blueprint $table) {
            $table->string('mavanchuyen',10);
            $table->string('mand',10);
            $table->enum('trangthaivanchuyen',['Đã giao','Đang giao','Chưa được giao']);
            $table->date('ngaygui');
            $table->date('ngaynhan');
            $table->string('diachigiaohang',100);
            $table->text('ghichu')->nullable();

            $table->primary('mavanchuyen');
            $table->foreign('mand')->references('mand')->on('nguoidung')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vanchuyen');
    }
};
