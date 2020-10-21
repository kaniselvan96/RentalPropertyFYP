<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigincrements('invoice_id');
            
            $table->unsignedBigInteger('renter_id');
            $table->foreign('renter_id')->references('id')->on('users');

            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('house_id')->on('houses');

            $table->unsignedBigInteger('landlord_id');
            $table->foreign('landlord_id')->references('id')->on('users');
             
            $table->bigInteger('total')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('reminder')->nullable();
            $table->string('pay_date')->nullable();
            $table->string('status')->nullable();
            $table->string('pay_status')->nullable();
            $table->string('paid_date')->nullable();
            

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
        Schema::dropIfExists('invoices');
    }
}
