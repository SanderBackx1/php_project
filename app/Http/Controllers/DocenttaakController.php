<?php

namespace App\Http\Controllers;

use App\Docenttaak;
use App\Taak;
use Illuminate\Http\Request;

class DocenttaakController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docenttaak  $docenttaak
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**
         * Voorkeur opgeven
         */
        $taak = Taak::find($id);
        $docenttaak = new Docenttaak();
        $docenttaak->taak_id =$id;
        $docenttaak->user_id = auth()->user()->id;
        $docenttaak->voorkeur = true;
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
    public function destroy($id)
    {
        $taak = Taak::find($id);
        $docenttaken = Docenttaak::get();
        foreach($docenttaken as $docenttaak){
            if($docenttaak->taak_id == $id){
                if($docenttaak->user_id == auth()->user()->id ){
                    if($docenttaak->voorkeur){
                        $docenttaak->delete();
                    }

                }
            }
        }
        return redirect('avonden/'.$taak->evenement_id);
    }
}
