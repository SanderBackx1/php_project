@extends('layouts.template')

@section('title', 'Opleidingen bewerken')

@section('main')
    <h1>Opleiding bewerken: {{ $opleiding->opleidingnaam }}</h1>
    <form action="/admin/opleidingen/{{ $opleiding->id }}" method="post">
        @method('put')
        @include('admin.opleidingen.form')
    </form>
@endsection
@section('script_after')
    <script>
        Alumni.footer(1,0)
        // Alumni.summary()
    </script>
@endsection
