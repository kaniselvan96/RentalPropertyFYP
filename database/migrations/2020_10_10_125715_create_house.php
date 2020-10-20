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
            $table->string('title')->nullable();
            $table->string('property_type')->nullable();
            $table->string('property_name')->nullable();
            $table->string('floor')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('parking')->nullable();
            $table->string('furnishing')->nullable();
            $table->string('rental')->nullable();
            $table->string('deposit')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('preference_id')->nullable();
            $table->string('facilities')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
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
