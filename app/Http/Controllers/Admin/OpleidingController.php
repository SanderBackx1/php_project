<?php

namespace App\Http\Controllers\Admin;

use App\Docenttaak;
use App\Evenement;
use App\Opleiding;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpleidingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opleidingen = Opleiding::orderBy('opleidingnaam')->get();

        $result = compact('opleidingen');
        \Json::dump($result);
        return view('admin.opleidingen.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opleiding = new Opleiding();
        $result = compact('opleiding');
        return view('admin.opleidingen.create', $result);
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
            'opleidingnaam' => 'required|unique:opleidings,opleidingnaam'
        ]);

        $opleiding = new Opleiding();
        $opleiding->opleidingnaam = $request->opleidingnaam;
        $opleiding->actief = $request->actief;
        $opleiding->save();
        session()->flash('success', "<b>$opleiding->opleidingnaam</b> is toegevoegd!");
        return redirect('/admin/opleidingen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect('/admin/opleidingen');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opleiding = Opleiding::find($id);
        return view('admin.opleidingen.edit', ['opleiding'=> $opleiding ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $opleiding = Opleiding::find($id);
        $this->validate($request,[
            'opleidingnaam' => 'required'
        ]);
        $opleiding->opleidingnaam = $request->opleidingnaam;
        $opleiding->actief = $request->actief;
        $opleiding->save();
        session()->flash('success', 'De opleiding is bewerkt!');
        return redirect('/admin/opleidingen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opleiding = Opleiding::find($id);
        $teller = 0;
        $evenement = Evenement::get();
        foreach($evenement as $ev){
            if($ev->opleiding_id == $id){
                $teller +=1;
            }
        }
        if($teller == 0){
            $opleiding->delete();
            session()->flash('danger', "De opleiding <b>$opleiding->opleidingnaam</b> is verwijdert!");
            return redirect('/admin/opleidingen');
        }
        else{
            echo "<script>window.location.href='/admin/opleidingen';
                 alert('Je kan de opleiding niet verwijderen want deze heeft een evenement!');
                 </script>";
        }
    }
}
