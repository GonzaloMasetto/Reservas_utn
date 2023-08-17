<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'contenido'];

    //Relacion uno a muchos
    public function events(){
        return $this->hasMany('App\Models\Event');
    }
}
