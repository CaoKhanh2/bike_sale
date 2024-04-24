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
        Schema::create('thongsokythuatxedapdien', function (Blueprint $table) {
            $table->string('matsxedapdien',10);
            $table->float('trongluong',4,2)->nullable();
            $table->string('acquy',25)->nullable();
            $table->string('dongcodien',25)->nullable();
            $table->string('thoigiansacdien',15)->nullable();
            $table->string('phamvisudung',35)->nullable();

            $table->primary('matsxedapdien');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongsokythuatxedapdien');
    }
};
