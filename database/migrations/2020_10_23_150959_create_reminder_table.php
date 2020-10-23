<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder', function (Blueprint $table) {
            $table->bigincrements('reminder_id');
            
            $table->unsignedBigInteger('renter_id');
            $table->foreign('renter_id')->references('id')->on('users')->nullable();

            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id')->references('house_id')->on('houses')->nullable();

            $table->unsignedBigInteger('landlord_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
             
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
        Schema::dropIfExists('reminder');
    }
}
