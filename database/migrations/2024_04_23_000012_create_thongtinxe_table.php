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
        Schema::create('thongtinxe', function (Blueprint $table) {
            $table->string('maxe', 15);
            $table->string('madx',10)->nullable();
            $table->string('matsxemay',10)->nullable();
            $table->string('matsxedapdien',10)->nullable();
            $table->string('tenxe', 50);
            $table->dateTime('ngaynhap')->useCurrent();
            $table->string('thoigiandasudung',25);
            $table->string('tinhtrangxe',50);
            $table->string('sokmdadi',25);
            $table->text('hinhanh')->nullable();
            $table->string('biensoxe',15)->nullable();
            $table->text('ghichu')->nullable();

            $table->primary('maxe');
            $table->foreign('madx')->references('madx')->on('dongxe')->onDelete('cascade');
            $table->foreign('matsxemay')->references('matsxemay')->on('thongsokythuatxemay')->onDelete('cascade');
            $table->foreign('matsxedapdien')->references('matsxedapdien')->on('thongsokythuatxedapdien')->onDelete('cascade');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongtinxe');
    }
};