<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antwoord extends Model
{
    public function vraag()
    {
        return $this->belongsTo('App\Vraag')->withDefault();
    }
    public function alumnusantwoord(){
        return $this->hasMany('App\Alumnusantwoord');
    }
}
