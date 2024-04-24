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
        Schema::create('thanhtoan', function (Blueprint $table) {
            $table->string('mathanhtoan');
            $table->string('phuongthucthanhtoan',20);
            $table->enum('trangthai',['Đã thanh toán', 'Chưa thanh toán']);
            $table->dateTime('ngaythanhtoan');
            $table->string('sotaikhoan',15);
            $table->string('tennguoigui',50);
            $table->text('ghichu')->nullable();

            $table->primary('mathanhtoan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thanhtoan');
    }
};
