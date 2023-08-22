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
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('otro')->nullable();
            $table->boolean('video_conferencia')->default(false);
            $table->boolean('difusion_redes')->default(false);
            $table->boolean('transmision_youtube')->default(false);
            $table->boolean('catering')->default(false);
            $table->integer('cant_personas');
            $table->string('adicional')->nullable();

            $table->timestamps();  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); 
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null'); 
            $table->foreign('place_id')->references('id')->on('places')->onDelete('set null'); 
            $table->foreign('type_event_id')->references('id')->on('type_events')->onDelete('set null'); 

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

