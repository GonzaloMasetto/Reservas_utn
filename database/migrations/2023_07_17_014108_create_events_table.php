<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->string('contenido');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->unsignedBigInteger('place_id')->nullable(); 
            $table->unsignedBigInteger('type_event_id')->nullable(); 
            $table->timestamps();
        
            $table->foreign('place_id')->references('id')->on('places')->onDelete('set null'); 
            $table->foreign('type_event_id')->references('id')->on('places')->onDelete('set null'); 
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
