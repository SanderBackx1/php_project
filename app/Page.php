<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static function insertData($data){

        $value=DB::table('alumnis')->where('mail', $data['mail'])->get();
        if($value->count() == 0){
            DB::table('alumnis')->insert($data);
        }
    }
}
