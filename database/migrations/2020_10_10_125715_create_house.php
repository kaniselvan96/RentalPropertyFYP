<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->bigincrements('house_id');
            $table->unsignedBigInteger('landlord_id');
            $table->foreign('landlord_id')->references('id')->on('users');
            $table->string('title');
            $table->string('property_type');
            $table->string('property_name');
            $table->string('floor');
            $table->string('bedroom');
            $table->string('bathroom');
            $table->string('parking');
            $table->string('furnishing');
            $table->string('rental');
            $table->string('deposit');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('postcode');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('preference_id');
            $table->string('facilities');
            $table->string('description');
            $table->string('status');
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
        Schema::dropIfExists('house');
    }
}
