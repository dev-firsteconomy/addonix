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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_type');
            $table->string('ticket_source');
            $table->integer('support_mode');
            $table->string('sr_spr')->nullable();
            $table->string('sr_spr_no')->nullable();
            $table->integer('lead_id');
            $table->integer('poc_id');
            $table->integer('mobile');
            $table->string('email');
            $table->string('license');
            $table->integer('product_id');
            $table->date('subscription_end_date');
            $table->string('contract_type');
            $table->string('contract_sub_type');
            $table->text('problem_observed');
            $table->text('solution_provided');
            $table->string('status')->default('New');
            $table->integer('assigned_to');
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
        Schema::dropIfExists('supports');
    }
};
