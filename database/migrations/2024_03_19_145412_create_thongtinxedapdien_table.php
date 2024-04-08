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
        Schema::create('thongtinxedapdien', function (Blueprint $table) {
            $table->string('maxedapdien',15);
            $table->string('loaixe_id',15);
            $table->string('hangxe_id',5);
            $table->string('dongxe',15)->nullable();
            $table->float('trongluong',3,2)->nullable();
            $table->string('acquy',10)->nullable();
            $table->string('sacdien',10)->nullable();
            $table->float('phamvisudung',3,2)->nullable();
            $table->string('hinhanh');
            $table->decimal('giaban',10,2);
            $table->tinyInteger('tinhtrang');

            $table->primary('maxedapdien');
            $table->foreign('loaixe_id')->references('malx')->on('loaixe')->onDelete('cascade');
            $table->foreign('hangxe_id')->references('mahx')->on('hangxe')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongtinxedapdien');
    }
};
