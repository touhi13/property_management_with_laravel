<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentCollectionDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_collection_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rent_id')->unsigned()->nullable();
            $table->foreign('rent_id')->references('id')->on('rents')->onDelete('cascade');
            $table->date('date');
            $table->string('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_collection_dates');
    }
}
