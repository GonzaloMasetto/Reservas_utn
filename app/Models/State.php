<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    //Relacion uno a muchos
    public function events(){
        return $this->hasMany('App\Models\Event');
    }

}
