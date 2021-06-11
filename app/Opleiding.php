<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opleiding extends Model
{
    public function evenement()
    {
        return $this->hasMany('App\Evenement');   // a genre has many records
    }
}
