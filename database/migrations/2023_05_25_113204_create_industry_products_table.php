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
        Schema::create('industry_products', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('product_name');
            $table->integer('serial_number');
            $table->date('sub_start_date');
            $table->date('sub_end_date');
            $table->string('price');
            $table->date('sale_date');
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industry_products');
    }
};
