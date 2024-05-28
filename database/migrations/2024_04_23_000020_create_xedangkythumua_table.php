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
        Schema::create('xedangkythumua', function (Blueprint $table) {
            $table->string('madkthumua',20);
            $table->string('mand',10)->nullable();
            $table->string('manv',10)->nullable();
            $table->datetime('ngaydk');
            $table->text('hinhanh');
            $table->decimal('giaban',10,2);
            $table->text('mota')->nullable();
            $table->enum('trangthaipheduyet',['Duyệt','Chờ duyệt','Không duyệt','Đang kiểm tra'])->default('Chờ duyệt');

            $table->primary('madkthumua');
            $table->foreign('mand')->references('mand')->on('nguoidung')->onDelete('cascade');
            $table->foreign('manv')->references('manv')->on('nhanvien')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xedangkythumua');
    }
};
