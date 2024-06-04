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
        Schema::create('vnpay', function (Blueprint $table) {
            $table->id();
            $table->string('vnp_Amount',50);
            $table->string('vnp_BankCode',50);
            $table->string('vnp_BankTranNo',50)->nullable();
            $table->string('vnp_CardType',50);
            $table->string('vnp_OrderInfo',50);
            $table->string('vnp_PayDate',50);
            $table->string('vnp_ResponseCode',50);
            $table->string('vnp_TmnCode',50);
            $table->string('vnp_TransactionNo',50);
            $table->string('vnp_TransactionStatus',50);
            $table->string('vnp_TxnRef',12);
            $table->string('vnp_SecureHash',191);
            $table->timestamps();

            $table->foreign('vnp_TxnRef')->references('madh')->on('donhang')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vnpay');
    }
};
