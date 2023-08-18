<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class TicComponent extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'contenido'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_tic_component')
            ->withPivot('fecha_relacion', 'cantidad')
            ->withTimestamps();
    }
}
