<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateTripMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_trip_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('corporateid');
            $table->string('tripno')->comment("trip should be corporate_alias followed by running number example FSD001");
            $table->string('tripname')->comment("just a label for user to give a name at time_of search");
            $table->string('triptype')->comment("business, business-family, personal, rotation or annual leave");
            $table->integer('tripcreatedby')->comment("session corporate_employee_id");
            $table->integer('costcentreid')->comment("corporate cost center id");
            $table->integer('trip_pax_employeeid')->comment("the employee that is travelling. The travel policy of this employee to be applied");
            $table->integer('approvers_sequence1')->default(0)->comment("can be multiple approval in same sequence");
            $table->integer('approvers_sequence2')->default(0)->comment("only if sequence1 approval complete sequence2 will receive email notification and so on");
            $table->integer('approvers_sequence3')->default(0);
            $table->integer('approvers_sequence4')->default(0);
            $table->integer('approvers_sequence5')->default(0)->comment("maximum 5 approval level");
            $table->integer('tripreason')->nullable()->comment("this will come from trip reason master");
            $table->boolean('isSentforApproval')->default(0)->comment("to check if trip already sent to approval");
            $table->boolean('isApproved')->default(0)->comment("this will become 1 if all approval has approved");
            $table->boolean('isRejected')->default(0);
            $table->string('triprejectedreason')->nullable();
            $table->string('IsRejected_comment')->nullable();
            $table->boolean('isExpired')->default(0)->comment("trip that is NOT sent for approval can should in 24 hour");
            $table->boolean('isConfirmed')->default(0)->comment("only Agency_TravelDesk users can confirm");
            $table->boolean('isCancelled')->default(0)->comment("only Agency_TravelDesk users can cancel");
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
        Schema::dropIfExists('corporate_trip_masters');
    }
}
