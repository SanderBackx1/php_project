<?php

namespace App\Http\Controllers;

use App\Taak;
use Illuminate\Http\Request;

class TaakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'taaknaam' => 'required',

        ]);
        $taak = new Taak();
        $taak->naam = $request->taaknaam;
        $taak->aantal = $request->taakaantal;
        $taak->beschrijving = $request->taakbeschrijving;
        $taak->evenement_id = $request->taakevenement;
        $taak->save();
        session()->flash('gelukt ', "De taak <b>$taak->taaknaam</b> is toegevoegd");
        return redirect('avonden/'.$taak->evenement_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taak  $taak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   /**dit is de create functie met parameter
   */
        $taak = new taak();
        $taak->naam = "Nieuwe taak";
        $taak->evenement_id = $id;

        $result = compact('taak');
        return view('verantwoordelijke.taken.create',$result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taak  $taak
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $taak = Taak::find($id);
        $result = compact('taak');
        return view('verantwoordelijke.taken.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taak  $taak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taak = Taak::find($id);

        $taak->naam = $request->taaknaam;
        $taak->aantal = $request->taakaantal;
        $taak->beschrijving = $request->taakbeschrijving;
        $taak->save();
        return redirect('/avonden/'.$taak->evenement_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taak  $taak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taak = Taak::find($id);
        $evenementid = $taak->evenement_id;


        $taak->delete();
        session()->flash('gelukt', "de Taak <b>$taak->naam</b> is verwijdert.");
        return redirect('avonden/'.$evenementid);
    }

}
