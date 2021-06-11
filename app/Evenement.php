<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    public function activiteiten()
    {
        return $this->hasMany('App\Activiteit');
    }
    public function vragen()
    {
        return $this->hasMany('App\Vraag');
    }
    public function taken()
    {
        return $this->hasMany('App\Taak');
    }
    public function opleiding()
    {
        return $this->belongsTo('App\Opleiding')->withDefault();   // a record belongs to a genre
    }
    public function antwoordenOpAvond(){
        return $this->hasManyThrough('App\Antwoord', 'App\Vraag');
    }
}
