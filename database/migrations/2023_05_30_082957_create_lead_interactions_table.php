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
        Schema::create('lead_interactions', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('interaction_activity_type');
            $table->date('interaction_subject');
            $table->string('interaction_status');
            $table->date('interaction_date');
            $table->string('interaction_feedback');
            $table->date('interaction_followup_date');
            $table->string('company_name')->nullable();
            $table->date('demo_date')->nullable();
            $table->string('contact_person')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('demo_status')->nullable();
            $table->string('oft_unique_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('assign_user_id')->nullable();
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
        Schema::dropIfExists('lead_interactions');
    }
};
