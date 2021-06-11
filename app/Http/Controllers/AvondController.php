<?php

namespace App\Http\Controllers;

use App\Antwoord;
use App\Evenement;
use App\Opleiding;
use App\Taak;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Helpers\Json;
class AvondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evenementen = Evenement::orderBy('evenementnaam')->get();


        $result = compact('evenementen');
        return view('avonden.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evenement = new Evenement();
        $evenementen = Evenement::get();
        $opleidingen = Opleiding::get();
        $gekozen = array();
        $ongekozen = array();

        foreach($evenementen as $ev){
            array_push($gekozen,$ev->opleiding_id);


        }
        foreach($opleidingen as $opleiding){
            if(in_array($opleiding->id,$gekozen)){

            }
            else{
                if($opleiding->actief){
                    array_push($ongekozen,$opleiding);
                }

            }
        }


        $result = compact('evenement');
        $result2 = compact('ongekozen');
        $result3 = compact('evenementen');


        return view('avonden.create',$result,$result2,$result3);
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
            'evenementnaam' => 'required',
            'datum' =>'required',
            'tijdstip' => 'required',
            'evenementopleiding' => 'required'

        ]);
        $exists = Evenement::where('opleiding_id', '=', $request->evenementopleiding)->get();


        if(sizeof($exists) > 0){
            return redirect('avonden');
        }
        else{



        $evenement = new Evenement();
        $evenement->evenementnaam = $request->evenementnaam;
        $evenement->beschrijving = $request->beschrijving;
        $evenement->datum = $request->datum;
        $evenement->tijdstip = $request->tijdstip;
        $evenement->opleiding_id = $request->evenementopleiding;
       $evenement->save();

        session()->flash('gelukt ', "De avond <b>$evenement->evenementnaam</b> is aangemaakt");
        return redirect('avonden/'.$evenement->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opleidingen = Opleiding::get();
        $result2 = compact('opleidingen');
        $evenement = Evenement::with('activiteiten', 'taken.docenttaak.docent', 'vragen.antwoorden.alumnusantwoord.alumnusaanwezigheid')->findOrFail($id);

        $result = compact('evenement');
        \Facades\App\Helpers\Json::dump($evenement);
        return view('avonden.show', $result,$result2);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evenement = Evenement::find($id);
        return view('avonden.edit', ['evenement'=> $evenement ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $evenement = Evenement::find($id);
        $this->validate($request,[
            'evenementnaam' => 'required',
            'datum' =>'required',
            'tijdstip' => 'required'

        ]);

        $evenement->evenementnaam = $request->evenementnaam;
        $evenement->beschrijving = $request->beschrijving;
        $evenement->datum = $request->datum;
        $evenement->tijdstip = $request->tijdstip;

        $evenement->save();
        session()->flash('success', 'The evenement has been updated');
        return redirect('avonden/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $avond = Evenement::find($id);
        $avond->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De avond $avond->evenementnaam is verwijderd!"
        ]);
    }
}
