<?php

namespace App\Http\Controllers\Admin;

use App\Docenttaak;
use App\Helpers\Json;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Exception;

class GebruikerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gebruikers = user::get();
        $result = compact('gebruikers');
        \Facades\App\Helpers\Json::dump($result);
        return view('admin.gebruikers.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $user->admin = 0;
        $user->verantwoordelijke = 0;
        $result = compact('user');
        return view('admin.gebruikers.gcreate',$result);
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
            'name' => 'required',
            'email' => 'required|unique:users,email'



        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;
        $user->verantwoordelijke = $request->verantwoordelijke;
        $user->password = Hash::make('user1234');
        $user->save();
        session()->flash('gelukt ', "De gebruiker <b>$user->name</b> is toegevoegd");
        return redirect('admin/gebruikers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect('admin/gebruikers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);


        return view('admin.gebruikers.gedit', ['user'=> $user ]);
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
        $user = User::find($id);
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;
        $user->verantwoordelijke = $request->verantwoordelijke;
        $user->save();
        session()->flash('success', 'The user has been updated');
        return redirect('admin/gebruikers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);
        $teller = 0;
        $docenttaak = Docenttaak::get();
        foreach($docenttaak as $docent){
            if($docent->user_id == $id){
                $teller +=1;
            }
        }
       if($teller == 0){
           $user->delete();
           return redirect('admin/gebruikers');
       }
       else{
           echo "<script>window.location.href='/admin/gebruikers';
                 alert('Je kan de gebruiker  niet verwijderen want deze heeft nog taken toegewezen');
                 </script>";
       }










        session()->flash('gelukt', "De gebruiker <b>$user->name</b> is verwijdert.");

    }
}
