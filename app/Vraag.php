<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vraag extends Model
{
    public function evenement()
    {
        return $this->belongsTo('App\Evenement')->withDefault();
    }
    public function antwoorden()
    {
        return $this->hasMany('App\Antwoord');
    }

    public function typevraag()
    {
        return $this->belongsTo('App\Typevraag')->withDefault();
    }
}
