<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnusantwoord extends Model
{
    public function alumnusaanwezigheid()
    {
        return $this->belongsTo('App\Alumnusaanwezigheid', 'alumnusaanwezigheid_id');
    }
    public function antwoord()
    {
        return $this->belongsTo('App\Antwoord', 'antwoord_id');
    }
}
