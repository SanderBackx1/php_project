<?php

namespace App\Http\Controllers;

use App\Evenement;
use Illuminate\Http\Request;

class FormulierOpslaan extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $evenement = Evenement::find($id);
        $evenement->formulier = true;
        $evenement->save();
        return redirect('avonden/'.$evenement->id);
    }
}
