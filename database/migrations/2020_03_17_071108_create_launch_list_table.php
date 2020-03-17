<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaunchListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('launch_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('launch_id');
            $table->string('trip_name',75);
            $table->string('loading_port',45);
            $table->string('destination_port',45);
            $table->string('karani_id');
            $table->string('is_active')->default(true);
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
        Schema::dropIfExists('launch_list');
    }
}
