@extends('layouts.template')

@section('title', 'Nieuwe taken')

@section('main')
    <div class="container">
        <div class='form-group'>
            <h1>Nieuwe taak toevoegen</h1>
            <form action="/taken" method="post" id="taakform">
                @include('verantwoordelijke.taken.form')
            </form>

        </div>
    </div>
@endsection
@section('script_after')
    <script>
        $(function(){
            Alumni.footer(3,0);
        // Alumni.summary();
        })
    </script>
@endsection
@section('css_after')

@endsection
