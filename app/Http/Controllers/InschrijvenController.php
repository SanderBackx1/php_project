<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumni;
use App\Alumnusaanwezigheid;
use App\Evenement;
use App\Antwoord;
use App\Alumnusantwoord;

class InschrijvenController extends Controller
{

    //In order for this to work we need cryptographic secure ID's for our alumni
    //See function below for possible solution:
    //reccomended length = 15.
    //See picture: https://i.stack.imgur.com/g5MsZ.png for lengths.
    //Source: https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string/13733588#13733588

    function getToken($length)
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
    public function approve(Request $request)
    {


        if ($request->id == null && $request->avond == null) {

            $evenementen = Evenement::with('vragen')->get();
            $evenementen = compact('evenementen');
            return view('inschrijven.create', $evenementen);
            //New user
            return view('inschrijven.create');
        } else if ($request->id != null) {
            //Get user from database
            $alumnus = Alumnusaanwezigheid::with('antwoord')->where('token', '=', $request->id)->get();
            if (sizeof($alumnus) <= 0) {
                session()->flash('danger', 'Alumnus niet gevonden');

                $evenementen = Evenement::get();
                $evenementen = compact('evenementen');
                return view('inschrijven.create', $evenementen);
            }
            $alumnus = compact('alumnus');
            //Temp redirect
            return view('inschrijven.edit', $alumnus);
        } else if ($request->avond != null) {

            $avond = Evenement::with('vragen')->find($request->avond);
            $avond = compact('avond');
            return view('inschrijven.create', $avond);
        }
    }


    public function post(Request $request)
    {
        //TODO:
        //VALIDATION --Not final
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);

        $alumnus = new Alumnusaanwezigheid();
        $evenement = Evenement::find($request->avondID);
        //2. ADD TO DB IF VALIDATED
        if (strlen($request->token) > 0) {
            $alumnus = Alumnusaanwezigheid::where('token', '=', $request->token)->first();

            if (!isset($alumnus)) {
                $request->flash();
                session()->flash('danger', 'Alumnus niet gevonden');
                //redirect to view
                return redirect('inschrijven');
            }
            foreach ($alumnus->antwoord as $antwoord) {
                if ($antwoord->vraag->typevraag->type == "Text") {


                    $tekst = $antwoord->id;

                    if ($request->$tekst == null) {

                        $antwoord->inhoud = "/";
                    } else {
                        $antwoord->inhoud = $request->$tekst;
                    }

                    $antwoord->save();
                } else if ($antwoord->vraag->typevraag->type == "Selecteer") {
                    $ans = Alumnusantwoord::where('alumnusaanwezigheid_id', '=', $alumnus->id )->get();
                    foreach($ans as $antw){
                        if($antw->antwoord_id == $antwoord->id){
                            $tekst = $antwoord->id;
                            $antw->antwoord_id = $request->$tekst;
                            $antw->save();
                        }

                    }
                }
                $alumnus->voornaam = $request->surname;
                $alumnus->achternaam = $request->name;
                $alumnus->mail = $request->email;

                $alumnus->save();
                //flash input to view
                $request->flash();
                session()->flash('success', 'Uw inschrijving is gewijzigd!');
            }
        } else {

            $exists = Alumnusaanwezigheid::where('mail', '=', $request->email)->first();
            if (isset($exists)) {
                $request->flash();
                session()->flash('danger', 'alumnus met deze email bestaat al');
                //redirect to view
                return redirect('inschrijven');
            }

            $alumnus->token = InschrijvenController::getToken(10);
            $alumnus->voornaam = $request->surname;
            $alumnus->achternaam = $request->name;
            $alumnus->mail = $request->email;

            $alumnus->save();
            foreach ($evenement->vragen as $vraag) {
                if ($vraag->typevraag->type == "Text") {
                    $id = $vraag->id;
                    $antwoord = new Antwoord();
                    $alumnusantwoord = new Alumnusantwoord();

                    $antwoord->vraag_id = $vraag->id;

                    if ($request->$id == null) {
                        $antwoord->inhoud = "/";
                    } else {
                        $antwoord->inhoud = $request->$id;
                    }

                    $antwoord->save();
                    $alumnusantwoord->alumnusaanwezigheid_id = $alumnus->id;
                    $alumnusantwoord->antwoord_id = $antwoord->id;
                    $alumnusantwoord->save();
                } elseif ($vraag->typevraag->type == "Selecteer") {
                    $id = $vraag->id;
                    $tekst = $request->$id;
                    $int = (int) $tekst;
                    $alumnusantwoord = new Alumnusantwoord();
                    $alumnusantwoord->alumnusaanwezigheid_id = $alumnus->id;
                    $alumnusantwoord->antwoord_id = $int;
                    $alumnusantwoord->save();
                }
            }

            //flash input to view
            $request->flash();
            session()->flash('success', 'Bedankt voor uw inschrijving! Als u uw inschrijving wil wijzigen dan kan u dat doen met volgende token: ' . $alumnus->token);
        }






        //redirect to view
        return redirect('inschrijven');
    }
}
