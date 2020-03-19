<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trip_id');
            $table->bigInteger('client_id');
            $table->string('item_name',125);
            $table->double('item_quantity');
            $table->double('item_price');
            $table->double('item_total_aed');
            $table->double('item_total_usd');
            $table->boolean('item_paid')->default(false);
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
        Schema::dropIfExists('shipping_items');
    }
}
