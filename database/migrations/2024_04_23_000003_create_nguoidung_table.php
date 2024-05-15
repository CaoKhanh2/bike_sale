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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->string('mand',10);
            $table->string('hovaten',50);
            $table->date('ngaysinh')->nullable();
            $table->string('cccd', 12)->nullable();
            $table->enum('gioitinh',['Nam','Nữ']);
            $table->string('sodienthoai',11);
            $table->string('email',35);
            $table->string('diachi',100)->nullable();
            $table->string('tentk',20)->nullable();
            $table->string('password',255);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->tinyInteger('tinhtrang')->default(1);
            
            $table->primary('mand');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguoidung');
    }
};
