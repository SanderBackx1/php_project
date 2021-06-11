<?php

namespace App\Http\Controllers;

use App\Docenttaak;
use App\Taak;
use Illuminate\Http\Request;

class Docenttaak2Controller extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //docent aanwijzen

        $taak = Taak::find($request->taakid);


            $dk = new Docenttaak();
            $dk->taak_id =$taak->id;
            $dk->user_id = $request->docentnaam;
            $dk->aangewezen = true;
            $dk->save();

        return redirect('avonden/'.$taak->evenement_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docenttaak  $docenttaak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //docent verwijderen als aangewezen
        $docenttaak = Docenttaak::find($id);

        $taak = Taak::find($docenttaak->taak_id);
        $docenttaak->aangewezen = false;
        $docenttaak->save();
        return redirect('avonden/'.$taak->evenement_id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docenttaak  $docenttaak
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //naar docenten aanwijzen scherm
        $taak = Taak::find($id);
        $result = compact('taak');
        return view('verantwoordelijke.taken.aanwijzen', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docenttaak  $docenttaak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docenttaak $docenttaak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docenttaak  $docenttaak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docenttaak $docenttaak)
    {
        //
    }
}
