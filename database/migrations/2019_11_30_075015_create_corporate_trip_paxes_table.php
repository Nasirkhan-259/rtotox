<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateTripPaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_trip_paxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('corporate_trip_master_id');
            $table->unsignedInteger('corporate_trip_service_id');
            $table->string('corporate_pax_first_name');
            $table->string('corporate_pax_last_name');
            $table->string('corporate_pax_dob');
            $table->string('relationship_to_employee')->comment("mother, father, daughter, son, wife or husband");
            $table->string('passport_number')->nullable();
            $table->string('passport_expiry')->nullable();
            $table->string('frequent_flyer_airline')->nullable();
            $table->string('frequent_flyer_number')->nullable();
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
        Schema::dropIfExists('corporate_trip_paxes');
    }
}
