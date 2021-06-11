<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activiteit extends Model
{
    public function evenement()
    {
        return $this->belongsTo('App\Evenement')->withDefault();
    }
}
