<?php

namespace App\Http\Controllers;

use App\Docenttaak;
use App\Evenement;
use App\Taak;
use Illuminate\Http\Request;
use App\Http\Controllers\AvondController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $evenementen = Evenement::orderBy('evenementnaam')->get();
        $resultaat = compact('evenementen');


        $docenttaken = Docenttaak::orderBy('taak_id')->get();

        $result = compact('docenttaken');
        return view('home', $resultaat,$result);

    }
    public function show()
    {

    }
}
