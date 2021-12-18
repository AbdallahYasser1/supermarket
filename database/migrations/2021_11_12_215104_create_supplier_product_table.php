<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_product', function (Blueprint $table) {
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->foreign('product_id')->references('id')->on('product');
            $table->primary(['supplier_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_product');
    }
}
