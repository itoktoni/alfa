<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LinenStockDetailMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linen_stock_detail', function(Blueprint $table){
            $table->string('linen_stock_detail_rfid');
            $table->integer('linen_stock_detail_location_id');
            $table->string('linen_stock_detail_location_name');
            $table->integer('linen_stock_detail_company_id');
            $table->string('linen_stock_detail_company_name');
            $table->integer('linen_stock_detail_product_id');
            $table->string('linen_stock_detail_product_name');
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
