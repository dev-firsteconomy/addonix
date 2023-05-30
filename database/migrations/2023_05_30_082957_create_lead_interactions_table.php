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
            $table->date('interaction_date')->nullable();
            $table->string('interaction_activity_type')->nullable();
            $table->string('interaction_feedback')->nullable();
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
