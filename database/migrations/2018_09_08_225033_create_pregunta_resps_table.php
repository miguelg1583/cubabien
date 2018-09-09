<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntaRespsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_resps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categoria_faq_id');
            $table->string('pregunta');
            $table->string('pregunta_trad');
            $table->text('respuesta');
            $table->string('respuesta_trad');
            $table->unsignedInteger('visitas')->nullable();
            $table->timestamps();

            $table->foreign('categoria_faq_id')->references('id')->on('categoria_faqs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta_resps');
    }
}
