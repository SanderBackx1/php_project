<?php

namespace App\Http\Controllers;

use App\Evenement;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(){
        return view('mail.index');
    }

    public function qryFilters(){
        // $vraag = Vraag::with('antwoorden.alumnusantwoord.alumnusaanwezigheid')->get();
        $evenement = Evenement::with('vragen.antwoorden.alumnusantwoord.alumnusaanwezigheid')->get();
        // $vraag = Vraag::with('evenement', 'antwoorden.alumnusantwoord.alumnusaanwezigheid')->get();
        return $evenement;
    }

    public function sendEmail($request){

    }

    public function show($mail)
    {
        if($mail == 'help'){
            return view('mail.help');
        }
        return redirect('mail');

    }
}
