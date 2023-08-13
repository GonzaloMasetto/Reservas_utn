<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['event', 'contenido', 'blog_id','start_date', 'end_date'];

    //Relacion uno a muchos (inversa)
    public function blog(){
        return $this->belongsTo('App\Models\Blog');
    }
    
}
