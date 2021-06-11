<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnusaanwezigheid extends Model
{
//    public function antwoord(){
//        return $this->belongsToMany('App\Antwoord');
//    }

    public function antwoord()
    {
        return $this->belongsToMany('App\Antwoord', 'alumnusantwoords', 'alumnusaanwezigheid_id', 'antwoord_id');
    }




}
