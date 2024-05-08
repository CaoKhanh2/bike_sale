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
        Schema::create('donhang', function (Blueprint $table) {
            $table->string('madh',10);
            $table->string('magh',10);
            $table->string('mavanchuyen',10);
            $table->string('mathanhtoan',15);
            $table->string('makhuyenmai',5)->nullable();
            $table->dateTime('ngaytaodon')->nullable();
            $table->decimal('tongtien',12,2)->nullable();

            $table->primary('madh');
            $table->foreign('magh')->references('magh')->on('giohang')->onDelete('cascade');
            $table->foreign('mavanchuyen')->references('mavanchuyen')->on('vanchuyen')->onDelete('cascade');
            $table->foreign('mathanhtoan')->references('mathanhtoan')->on('thanhtoan')->onDelete('cascade');
            $table->foreign('makhuyenmai')->references('makhuyenmai')->on('khuyenmai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhang');
    }
};
