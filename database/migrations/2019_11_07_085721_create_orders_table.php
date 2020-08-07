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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shipping_address_id');
            $table->unsignedBigInteger('order_status_id');
            $table->string('payment_option')->nullable();
            $table->string('tracking_id')->nullable();
            $table->decimal('grand_total', 10, 2);
            $table->decimal('delivery_charge', 10, 2);
            $table->timestamps();
            $table->index('user_id');
            $table->index('shipping_address_id');
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
