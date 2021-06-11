@extends('layouts.template')

@section('title', 'Nieuwe opleiding')

@section('main')
    <h1>Voeg een nieuwe opleiding toe</h1>
    <form action="/admin/opleidingen" method="post">
        @include('admin.opleidingen.form')
    </form>
@endsection
@section('script_after')
    <script>
        Alumni.footer(1,0)
        // Alumni.summary()
    </script>
@endsection
