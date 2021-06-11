@extends('layouts.template')

@section('title', 'Taken bewerken')

@section('main')
    <div class="container">
        <div class='form-group'>
            <h1>Taak bewerken </h1>
            <form action="/taken/{{ $taak->id }}"  method="post" id="taakform">
                @method('put')
                @include('Verantwoordelijke.taken.form')
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
