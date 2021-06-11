<?php

namespace App\Http\Controllers;

use App\Alumnusaanwezigheid;
use App\Alumnusantwoord;
use App\Alumni;
use App\Evenement;
use App\Antwoord;
use Illuminate\Http\Request;

class AlumnusantwoordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getToken($length)
    {
        //Token that will be used
        $token = "";

        //Allow uppercase letters in our token
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        //Allow lowercase letters in our token
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";

        //Allow numbers in our token
        $codeAlphabet .= "0123456789";

        //Get the max length of our token: Reccomended length = 15
        $max = strlen($codeAlphabet);

        //Generate token
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $avond = Evenement::with('vragen')->find($request->avond);
        $avond = compact('avond');

        return view('verantwoordelijke.alumnusantwoorden.create', $avond);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);


        $exists = Alumnusaanwezigheid::where('mail', '=', $request->email)->get();
        $evenement = Evenement::find($request->avondID);

        if (sizeof($exists) > 0) {


            $evenement = compact('evenement');
            session()->flash('danger', 'Alumnus met deze email bestaat al!');
            return redirect('avonden/' . $request->avondID);
        }



        $alumnusaanwezigheid = new Alumnusaanwezigheid();




        $alumnusaanwezigheid->voornaam = $request->surname;
        $alumnusaanwezigheid->achternaam = $request->name;
        $alumnusaanwezigheid->mail = $request->email;
        $alumnusaanwezigheid->token = AlumnusantwoordController::getToken(10);
        $alumnusaanwezigheid->save();



        foreach ($evenement->vragen as $vraag) {
            if($vraag->typevraag->type == "Text"){
                $id = $vraag->id;
                $antwoord = new Antwoord();
                $alumnusantwoord = new Alumnusantwoord();

                $antwoord->vraag_id = $vraag->id;

                if($request->$id == null){
                    $antwoord->inhoud = "/";
                }
                else{
                    $antwoord->inhoud = $request->$id;
                }

                $antwoord->save();

                $alumnusantwoord->alumnusaanwezigheid_id = $alumnusaanwezigheid->id;
                $alumnusantwoord->antwoord_id = $antwoord->id;
                $alumnusantwoord->save();
            }
            elseif($vraag->typevraag->type == "Selecteer"){
                $id = $vraag->id;
                $tekst = $request->$id;
                $int = (int)$tekst;





                $alumnusantwoord = new Alumnusantwoord();
                $alumnusantwoord->alumnusaanwezigheid_id = $alumnusaanwezigheid->id;
                $alumnusantwoord->antwoord_id =$int;


                $alumnusantwoord->save();
            }

        }





        session()->flash('success', 'Alumnus toegevoegd!');
        return redirect('avonden/' . $request->avondID);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumnusantwoord  $alumnusantwoord
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnusantwoord $alumnusantwoord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumnusantwoord  $alumnusantwoord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $alumnus = Alumnusaanwezigheid::find($id);
        $result = compact('alumnus');
        return view('verantwoordelijke.alumnusantwoorden.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumnusantwoord  $alumnusantwoord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $alumnus = Alumnusaanwezigheid::find($id);
        $this->validate($request, [
            'alumnusvoornaam' => 'required',
            'alumnusachternaam' => 'required',
            'mail' => 'required'
        ]);

        $alumnus->voornaam = $request->alumnusvoornaam;
        $alumnus->achternaam = $request->alumnusachternaam;
        $alumnus->mail = $request->mail;

        foreach ($alumnus->antwoord as $antwoord) {
            $evenementid = $antwoord->vraag->evenement_id;
            if ($antwoord->vraag->typevraag->type == "Text") {


                $tekst = $antwoord->id;

                if($request->$tekst == null){

                    $antwoord->inhoud = "/";
                }
                else{
                    $antwoord->inhoud = $request->$tekst;
                }

                $antwoord->save();
            } else if ($antwoord->vraag->typevraag->type == "Selecteer") {

                $ans = Alumnusantwoord::where('alumnusaanwezigheid_id', '=', $id )->get();
                foreach($ans as $antw){
                    if($antw->antwoord_id == $antwoord->id){
                        $tekst = $antwoord->id;
                       $antw->antwoord_id = $request->$tekst;
                       $antw->save();
                    }
                }






            }
        }




        $alumnus->save();
        return redirect('avonden/' . $evenementid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumnusantwoord  $alumnusantwoord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumnus = Alumnusaanwezigheid::find($id);

        foreach ($alumnus->antwoord as $antwoord) {
            $evenementid = $antwoord->vraag->evenement_id;
        }
        $alumnus->delete();
        session()->flash('gelukt', "De alumnus inschrijving van <b>$alumnus->voornaam $alumnus->achternaam</b> is verwijdert.");
        return redirect('avonden/' . $evenementid);
    }
}
