<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfielController extends Controller
{
    public function index()
    {
        $gebruikers = User::get();
        $result = compact('gebruikers');
        \Json::dump($result);
        return view('profiel', $result);
    }
}
