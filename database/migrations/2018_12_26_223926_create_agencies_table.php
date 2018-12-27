<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('d_b_num')->nullable();
            $table->string('phone_num')->nullable();
            $table->unsignedInteger('year_business')->nullable();
            $table->string('travel_permit_filename')->nullable();
            $table->binary('travel_permit_file')->nullable();
            $table->string('iata_num')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('title')->nullable();
            $table->string('anual_sales_volume')->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
