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
        // Schema::table('taikhoan', function (Blueprint $table) {
        //     // $table->integer('matk')->change();
        //     Schema::table('taikhoan', function (Blueprint $table) {
        //         $table->renameColumn('created_at', 'ngaytao');
        //     });
        // });

        // Schema::table('taikhoan', function (Blueprint $table) {
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('taikhoan', function (Blueprint $table) {
        //     // $table->string('matk', 12)->change();
        //     Schema::table('taikhoan', function (Blueprint $table) {
        //         $table->renameColumn('created_at', 'ngaytao');
        //     });
        // });

        // Schema::table('taikhoan', function (Blueprint $table) {
        //     $table->dropTimestamps();
        // });
    }
};
