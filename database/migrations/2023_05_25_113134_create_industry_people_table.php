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
        Schema::create('industry_people', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('name');
            $table->integer('designation');
            $table->bigInteger('contact_number');
            $table->string('email_id');
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
        Schema::dropIfExists('industry_people');
    }
};
