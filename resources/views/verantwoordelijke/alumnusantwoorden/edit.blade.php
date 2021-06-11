@extends('layouts.template')

@section('title', 'Inschrijving bewerken')

@section('main')
@include('shared.summary', ['title'=>'Avonden', 'msg'=>"Op deze pagina kan u de inschrijving van een alumnus wijzigen"])
    <div class="container">
        <div class='form-group'>
            <h1>Inschrijving bewerken </h1>
            <form action="/alumnusantwoorden/{{ $alumnus->id }}"  method="post">
                @method('put')
                @include('verantwoordelijke.alumnusantwoorden.form')
            </form>
        </div>
    </div>
@endsection
@section('script_after')
    <script>
        $(function(){
            Alumni.footer(3,0);
        // Alumni.summary();
    </script>
@endsection
@section('css_after')

@endsection
