<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateFaresMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_fares_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('private_fare')->comment("just a label");
            $table->dateTime('validity');
            $table->dateTime('last_updated');
            $table->unsignedInteger('last_updated_by')->comment("super admin id");
            $table->boolean('is_corporate_deals')->default(0)->comment("flag 1 or 0 can be used only_by specific corporates");
            $table->boolean("is_itx")->default(0)->comment("IT fare, passenger type private fare");
            $table->boolean("is_active")->default(0);
            $table->unsignedInteger('api')->comment("api master table");
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
        Schema::dropIfExists('private_fares_masters');
    }
}