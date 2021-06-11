<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docenttaak extends Model
{
    public function taken()
    {
        return $this->belongsTo('App\Taak', 'taak_id');
    }
    public function docent()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
