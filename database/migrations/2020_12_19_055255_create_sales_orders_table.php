<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('salesorder_id');
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->integer('quote')->default(0);
            $table->integer('opportunity')->default(0);
            $table->integer('status')->default(0);
            $table->integer('account')->default(0);
            $table->float('amount')->default(0.00);
            $table->date('date_quoted');
            $table->integer('quote_number')->default(0);
            $table->text('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            $table->integer('billing_postalcode')->default(0);
            $table->text('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->integer('shipping_postalcode')->default(0);
            $table->integer('billing_contact')->default(0);
            $table->integer('shipping_contact')->default(0);
            $table->string('tax')->default(0);
            $table->string('shipping_provider');
            $table->string('description')->nullable();
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('sales_orders');
    }
}
