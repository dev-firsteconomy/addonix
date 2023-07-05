<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->date('date_created');
            $table->string('product_type');
            $table->integer('poc_id');
            $table->string('sales_stage');
            $table->date('close_date');
            $table->integer('assigned_to')->nullable();
            $table->string('status');
            $table->string('cbi_identified')->nullable();
            $table->text('feedback');
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
        Schema::dropIfExists('opportunities');
    }
}
