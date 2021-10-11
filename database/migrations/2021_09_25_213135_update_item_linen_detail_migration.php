<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemLinenDetailMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_linen_detail', function(Blueprint $table){

            $table->integer('item_linen_detail_rfid')->nullable()->change();
            $table->integer('item_linen_detail_status')->nullable()->change();
            $table->string('item_linen_detail_description')->nullable()->change();
            $table->dateTime('item_linen_detail_created_at')->nullable()->change();
            $table->dateTime('item_linen_detail_updated_at')->nullable()->change();
            $table->dateTime('item_linen_detail_deleted_at')->nullable()->change();
            $table->integer('item_linen_detail_updated_by')->nullable()->change();
            $table->integer('item_linen_detail_created_by')->nullable()->change();
            $table->integer('item_linen_detail_deleted_by')->nullable()->change();
            $table->string('item_linen_detail_created_name')->nullable()->change();

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
