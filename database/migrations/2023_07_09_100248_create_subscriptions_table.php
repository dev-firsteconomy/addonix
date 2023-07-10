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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->integer('opportunity_id');
            $table->string('product_type');
            $table->date('subscription_start_date');
            $table->date('subscription_end_date');
            $table->string('contract_value');
            $table->string('contract_terms');
            $table->string('contract_sub_type')->nullable();
            $table->integer('parent')->default(0);
            $table->integer('is_renew')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
};
