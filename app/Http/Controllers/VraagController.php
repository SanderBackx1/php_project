<?php

namespace App\Http\Controllers;

use App\Antwoord;
use App\Evenement;
use App\Typevraag;
use App\Vraag;
use Illuminate\Http\Request;

class VraagController extends Controller
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
    public function create(request $request)
    {
        $avond = Evenement::find($request->avond);


        $result = compact('avond');

        return view('verantwoordelijke.vragen.create',$result);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request->typevraagid == 1){
            $this->validate($request,[
                'vraagnaam' => 'required',

            ]);

            $vraag = new Vraag();
            $vraag->evenement_id = $request->evenementid;
            $vraag->typevraag_id = $request->typevraagid;
            $vraag->inhoud = $request->vraagnaam;
            $vraag->verplicht = true;

            $vraag->save();
            session()->flash('gelukt ', "De taak <b>$vraag->inhoud</b> is toegevoegd");
            return redirect('/vragen/create?avond='.$vraag->evenement_id);

        }
        elseif($request->typevraagid == 2){



            $vraag = new Vraag();
            $vraag->evenement_id = $request->evenementid;
            $vraag->typevraag_id = $request->typevraagid;
            $vraag->inhoud = $request->vraagnaam;
            $vraag->verplicht = true;
            $vraag->save();

            $teller = $request->teller;
            for($i=1; $i<=$teller; $i++){
                if($request->$i != null){
                    $antwoord = new Antwoord();

                    $antwoord->vraag_id = $vraag->id;
                    $antwoord->inhoud = $request->$i;
                    $antwoord->save();
                }
            }
            session()->flash('gelukt ', "De taak <b>$vraag->inhoud</b> is toegevoegd");
            return redirect('/vragen/create?avond='.$vraag->evenement_id);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vraag  $vraag
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        //nieuwe vraag toevoegen
        $vraagtype = $request->vraagtype;


        $avond = Evenement::find($id);
        $typevraag = Typevraag::find($vraagtype);

        $result = compact('avond');
        $result2 = compact('typevraag');


        return view('verantwoordelijke.vragen.createvraag',$result,$result2);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vraag  $vraag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vraag = Vraag::find($id);
        $result = compact('vraag');

        return view('verantwoordelijke.vragen.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vraag  $vraag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

     $vraag = Vraag::find($id);
     $vraag->inhoud = $request->vraagnaam;
     $vraag->save();
     foreach($vraag->antwoorden as $antwoord){

         $tekst = $antwoord->id;
         $antwoord->inhoud = $request->$tekst;
         $antwoord->save();

     }
        return redirect('/vragen/create?avond='.$vraag->evenement_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vraag  $vraag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vraag = Vraag::find($id);
        $evenementid = $vraag->evenement_id;



        $vraag->delete();
        session()->flash('gelukt', "de vraag <b>$vraag->inhoud</b> is verwijdert.");
        return redirect('/vragen/create?avond='.$vraag->evenement_id);
    }

}
