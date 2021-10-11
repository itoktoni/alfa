<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemLinenDetailMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_linen_detail', function(Blueprint $table){

            $table->increments('item_linen_detail_id');
            $table->integer('item_linen_detail_rfid');
            $table->tinyInteger('item_linen_detail_status');
            $table->string('item_linen_detail_description');
            $table->dateTime('item_linen_detail_created_at');
            $table->dateTime('item_linen_detail_updated_at');
            $table->dateTime('item_linen_detail_deleted_at');
            $table->integer('item_linen_detail_updated_by');
            $table->integer('item_linen_detail_created_by');
            $table->integer('item_linen_detail_deleted_by');
            $table->string('item_linen_detail_created_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
