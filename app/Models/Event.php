<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeEvent;
use App\Models\TicComponent;
use App\Models\EventTicComponent;
use App\Models\State;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['event', 'contenido', 'place_id','type_event_id','state_id','start_date', 'end_date','otro',
    'video_conferencia',
    'difusion_redes',
    'transmision_youtube',
    'catering',
    'cant_personas',
    'adicional',];

    //Relacion uno a muchos (inversa)
    public function place(){
        return $this->belongsTo('App\Models\Place');
    }

    public function type_event()
    {
        return $this->belongsTo('App\Models\TypeEvent');
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
    
    public function ticComponents()
    {
        return $this->belongsToMany(TicComponent::class, 'event_tic_components', 'event_id', 'tic_component_id');
    }
    
}
