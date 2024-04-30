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
        Schema::create('thongsokythuatxemay', function (Blueprint $table) {
            $table->string('matsxemay',10);
            $table->float('khoiluong',4,2)->nullable();
            $table->string('dungtichxe',10)->nullable();
            $table->string('muctieuthunhienlieu',35)->nullable();
            $table->string('dungtichbinhxang',15)->nullable();

            $table->primary('matsxemay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongsokythuatxemay');
    }
};
