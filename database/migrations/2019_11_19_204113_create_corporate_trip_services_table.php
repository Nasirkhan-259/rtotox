<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateTripServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_trip_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('corporate_trip_master_id');
            $table->char('service_type', 27)->comment("hotel or flight");
            $table->char('office_id', 27)->comment("api office id");
            $table->integer('total_adults');
            $table->integer('total_children')->nullable()->default(0);
            $table->integer('total_infants')->nullable()->default(0);
            $table->char('cabin_class', 25);
            $table->text('booking_segments')->nullable();
            $table->string('booking_pnr')->nullable();
            $table->string('currency_code');
            $table->integer('total_base_fare');
            $table->integer('total_taxes')->nullable()->default(0);
            $table->integer('total_ipp')->nullable()->default(0);
            $table->integer('total_markups')->nullable()->default(0);
            $table->integer('total_service_fee')->nullable()->default(0);
            $table->unsignedInteger('private_fare_master_id')->nullable()->default(0)->comment("foreign key belongs to private_fare_master table");
            $table->integer('private_fare_discount')->nullable()->default(0);
            $table->integer('private_fare_manipulate')->nullable()->default(0)->comment("markup to apply after passing private fare");
            $table->string('hotel_name')->nullable();
            $table->string('hotel_room_type')->nullable();
            $table->string('hotel_rate_per_night')->nullable();
            $table->string('hotel_total_net')->nullable();
            $table->string('hotel_total_markup')->nullable();
            $table->string('flight_eticket_number')->nullable();
            $table->string('hotel_confirmation_number')->nullable();
            $table->char('status', 17)->nullable()->default("none");
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
        Schema::dropIfExists('corporate_trip_services');
    }
}
