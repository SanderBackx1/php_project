<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taak extends Model
{
    public function evenement()
    {
        return $this->belongsTo('App\Evenement')->withDefault();
    }
    public function docenttaak(){
        return $this->hasMany('App\Docenttaak');
    }
}
