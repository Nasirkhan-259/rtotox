<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripApproverSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_approver_sequences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('corporate_trip_master_id');
            $table->integer('sequence_number');
            $table->string('corporate_employee_id')->comment("comma separated employees that belongs to approver group of a corporate");
            $table->string('is_approved')->comment("is the specified level is approved or not");
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
        Schema::dropIfExists('trip_approver_sequences');
    }
}
