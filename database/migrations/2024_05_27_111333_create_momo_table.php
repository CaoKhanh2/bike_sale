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
        Schema::create('momo', function (Blueprint $table) {
            $table->id();
            $table->string('partnerCode',50);
            $table->string('orderId',50);
            $table->string('requestId',50);
            $table->string('amount',50);
            $table->string('orderInfo',50);
            $table->string('orderType',50);
            $table->string('transId',50);
            $table->string('payType',50);
            $table->string('signature',191);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('momo');
    }
};
