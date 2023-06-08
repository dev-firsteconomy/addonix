<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table){
            $table->id();
            $table->string('source')->nullable();
            $table->string('company_name')->unique();
            $table->string('parent_company_name')->nullable();
            $table->text('lead_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('existing_customer')->nullable();
            $table->string('type')->default('Lead');
            $table->string('cbi_identified')->nullable();
            $table->string('met_or_spoke')->nullable();
            $table->string('is_mnc')->nullable();
            $table->string('industry_vertical')->nullable();
            $table->string('sales_stage')->nullable();
            $table->date('create_date')->nullable();
            $table->date('estimated_close_date')->nullable();
            $table->integer('assign_user_id')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->boolean('mail_sent')->default(0);
            $table->boolean('quotation_sent')->default(0);
            $table->string('status', 20)->default('Lead');
            $table->integer('created_by');
            $table->timestamps();
            $table->string('lead_city')->nullable();
            $table->string('lead_state')->nullable();
            $table->string('lead_country')->nullable();
            $table->integer('lead_postalcode')->default(0);
            $table->integer('account')->default(0);
            $table->float('opportunity_amount');
            $table->integer('campaign')->default(0);
            $table->string('industry')->nullable();
            $table->string('is_converted')->default(0);
            $table->string('title')->nullable();
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
