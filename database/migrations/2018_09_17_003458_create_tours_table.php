<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nb');
            $table->string('nb_trad')->nullable();
            $table->text('introd');
            $table->string('introd_trad')->nullable();
            $table->unsignedInteger('num_dias')->nullable();
            $table->unsignedInteger('num_noches')->nullable();
            $table->string('salida_dia_trad')->nullable();
            $table->string('llegada_dia_trad')->nullable();
            $table->boolean('activo')->default(1);
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
        Schema::dropIfExists('tours');
    }
}
