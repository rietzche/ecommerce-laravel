<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_product');
            $table->integer('id_address')->index();
            $table->integer('bank');
            $table->string('courier');
            $table->string('msg')->nullable(true);
            $table->integer('quantity');
            $table->integer('status');
            $table->integer('price_total');
            $table->integer('ongkir');
            $table->timestamps();
        });

        Schema::table('orders', function(Blueprint $kolom) {
            $kolom->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $kolom->foreign('id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            // $kolom->foreign('id_address')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
