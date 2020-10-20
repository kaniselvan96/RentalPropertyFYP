<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigincrements('tenant_id');
            
            $table->unsignedBigInteger('renter_id');
            $table->foreign('renter_id')->references('id')->on('users');

            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('house_id')->on('houses');

            $table->unsignedBigInteger('landlord_id');
            $table->foreign('landlord_id')->references('id')->on('users');
             
            $table->string('professional')->nullable();
            $table->string('rental')->nullable();
            $table->string('deposit')->nullable();
            $table->string('due_on')->nullable();
            $table->string('lease_start_date')->nullable();
            $table->string('lease_expiration_date')->nullable();
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
        Schema::dropIfExists('tenant');
    }
}
