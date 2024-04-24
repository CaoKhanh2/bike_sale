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
            $table->string('mand',10);
            $table->string('mavanchuyen',10);
            $table->string('mathanhtoan',15);
            $table->datetime('ngaytao');
            $table->decimal('tonggiatien',12,2);
            $table->text('ghichu')->nullable();

            $table->primary('magh');
            $table->foreign('mand')->references('mand')->on('nguoidung')->onDelete('cascade');
            $table->foreign('mavanchuyen')->references('mavanchuyen')->on('vanchuyen')->onDelete('cascade');
            $table->foreign('mathanhtoan')->references('mathanhtoan')->on('thanhtoan')->onDelete('cascade');
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
