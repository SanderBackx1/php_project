@extends('layouts.template')

@section('title', 'Nieuwe gebruiker')

@section('main')

    <h1>voeg een gebruiker toe</h1>
    <form action="/admin/gebruikers" method="post">
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

