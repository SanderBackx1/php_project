<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('inschrijven', 'InschrijvenController@approve');
Route::post('inschrijven', 'InschrijvenController@post');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');




Route::get('activiteiten/qryActiviteiten', 'Admin\ActiviteitController@qryActiviteiten');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('/activiteiten', 'Admin\ActiviteitController');
    Route::resource('/gebruikers','Admin\GebruikerController');
    Route::resource('/opleidingen', 'Admin\OpleidingController');
});
Route::middleware(['auth', 'verantwoordelijke'])->group(function(){
    Route::resource('alumni', 'AlumniController');
});
Route::middleware(['auth'])->group(function(){

    Route::resource('avonden', 'AvondController');
    Route::resource('taken','TaakController');
    Route::resource('vragen','VraagController');
    Route::get('opslaan/{id}', 'FormulierOpslaan');
    Route::resource('docenttaken', 'DocenttaakController');
    Route::resource('docenttaken2', 'Docenttaak2Controller');
    Route::resource('profiel', 'ProfielController');
    Route::post('/uploadFile', 'PagesController@uploadFile');
    Route::resource('alumnusantwoorden','AlumnusantwoordController');


    Route::get('mail/qryFilters', 'MailController@qryFilters');
    Route::resource('mail', 'MailController');
});



