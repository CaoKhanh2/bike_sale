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
        Schema::create('giohang', function (Blueprint $table) {
            $table->string('magh',10);
            $table->string('khachhang_id',10);
            $table->string('vanchuyen_id',10);
            $table->string('thanhtoan_id',15);
            $table->datetime('ngaytao');
            $table->decimal('tonggiatien',12,2);
            $table->text('ghichu')->nullable();

            $table->primary('magh');
            $table->foreign('khachhang_id')->references('makh')->on('khachhang')->onDelete('cascade');
            $table->foreign('vanchuyen_id')->references('mavanchuyen')->on('vanchuyen')->onDelete('cascade');
            $table->foreign('thanhtoan_id')->references('mathanhtoan')->on('thanhtoan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giohang');
    }
};
