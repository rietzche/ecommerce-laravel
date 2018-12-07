<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code');
            $table->unsignedInteger('id_user');
            $table->string('proof');
            $table->string('sender_name');
            $table->string('bank_from');
            $table->string('bank_for');
            $table->string('method');
            $table->integer('price_total');
            $table->date('transfer_date');
            $table->timestamps();
        });

        Schema::table('transactions', function(Blueprint $kolom) {
            $kolom->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
