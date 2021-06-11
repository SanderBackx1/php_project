@extends('layouts.template')

@section('title', 'Gebruiker bewerken')

@section('main')

    <h1>Edit gebruiker: {{ $user->naam }}</h1>
    <form action="/admin/gebruikers/{{ $user->id }}"  method="post">
        @method('put')
        @include('admin.gebruikers.gform')
    </form>


@endsection
@section('script_after')

    <script>
        $(function(){
            Alumni.footer(3,1)
            // Alumni.summary()
        })
    </script>
@endsection
@section('css_after')

@endsection
