<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('unique_appt_id');
            $table->string('lead_name')->nullable();
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('outcome')->nullable();
            $table->string('start');
            $table->string('end');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('appointments');
    }
}
