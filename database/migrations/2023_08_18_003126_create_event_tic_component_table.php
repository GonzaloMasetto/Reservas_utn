<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_tic_component', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('tic_component_id');
            $table->date('fecha_relacion');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('tic_component_id')->references('id')->on('tic_components');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_tic_component');
    }
}
