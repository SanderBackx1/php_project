<?php

namespace App\Http\Controllers\Admin;

use App\Activiteit;
use App\Evenement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiviteitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.activiteiten.index');
    }
    public function qryActiviteiten(){

        $evenementen = Evenement::with('activiteiten')->get();
        $activiteiten = Activiteit::with('evenement')->get();

        return $evenementen;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return redirect('admin/activiteiten');
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
            'naam'=>'required',
            'startuur'=>'required',
            'einduur'=>'required',
            'lokaal' => 'required'
        ],
        [
            'naam.required' => 'Naam is een verplicht veld.',
            'startuur.required' => 'startuur is een verplicht veld.',
            'einduur.required' => 'einduur is een verplicht veld.',
            'lokaal.required' => 'lokaal is een verplicht veld.',
            'startuur.numeric'=>'Gelieve een getal in te geven als startuur.',
            'einduur.numeric'=>'Gelieve een getal in te geven als startuur.',
        ]);

        $activiteit = new Activiteit();
        $activiteit->activiteitnaam = $request->naam;
        $activiteit->startuur = $request->startuur;
        $activiteit->einduur = $request->einduur;
        $activiteit->lokaal =$request->lokaal;
        $activiteit->evenement_id=$request->evenement;
        $activiteit->save();

        return response()->json([
            'type' => 'success',
            'text' => "Activiteit <b>$activiteit->activiteitnaam</b> is aangemaakt!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activiteit  $activiteit
     * @return \Illuminate\Http\Response
     */
    public function show(Activiteit $activiteit)
    {
        return redirect('admin/activiteiten');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activiteit  $activiteit
     * @return \Illuminate\Http\Response
     */
    public function edit(Activiteit $activiteit)
    {
        return redirect('admin/activiteiten');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activiteit  $activiteit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //Validation required?
        $this->validate($request,[
            'naam'=>'required',
            'startuur'=>'required|numeric',
            'einduur'=>'required|numeric',
            'lokaal' => 'required'
        ],
        [
            'naam.required' => 'Naam is een verplicht veld.',
            'startuur.required' => 'startuur is een verplicht veld.',
            'einduur.required' => 'einduur is een verplicht veld.',
            'lokaal.required' => 'lokaal is een verplicht veld.',
            'startuur.numeric'=>'Gelieve een getal in te geven als startuur.',
            'einduur.numeric'=>'Gelieve een getal in te geven als startuur.',
        ]);

        $activiteit = Activiteit::find($id);
        $activiteit->activiteitnaam = $request->naam;
        $activiteit->startuur = $request->startuur;
        $activiteit->einduur = $request->einduur;
        $activiteit->lokaal =$request->lokaal;
        $activiteit->evenement_id = $request->evenement;

        $activiteit->save();
        return response()->json([
            'type' => 'success',
            'text' => "U heeft $activiteit->activiteitnaam gewijzigd!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activiteit  $activiteit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activiteit = Activiteit::find($id);
        $activiteit->delete();

        return response()->json([
            'type' => 'success',
            'text' => "Het activiteit $activiteit->activiteitnaam is verwijderd!"
        ]);
    }
}
