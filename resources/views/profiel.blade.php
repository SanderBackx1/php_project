@extends('layouts.template')

@section('title', 'Profiel')

@section('main')
    @include('shared.summary', ['title'=>'Profiel', 'msg'=>"Op deze pagina ziet u informatie over uw profiel."])
    <div class="container">
        <h1>Profiel</h1>
        <div class='table-responsive'>
            <table class='table table-hover'>
                <tr>
                    <p>Naam: <b>{{ auth()->user()->name }}</b> </p>
                </tr>
                <tr>
                    <p>E-mailadres: <b>{{ auth()->user()->email }}</b> </p>
                </tr>
                <tr>
                    @if(auth()->user()->verantwoordelijke)
                        <p>Verantwoordelijke: <b>Ja</b> </p>
                    @else
                        <p>Verantwoordelijke: <b>Nee</b> </p>
                    @endif
                </tr>
                <tr>
                    @if(auth()->user()->admin)
                        <p>Admin: <b>Ja</b> </p>
                    @else
                        <p>Admin: <b>Nee</b> </p>
                    @endif
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('script_after')
    <script>
        $(function(){
            Alumni.footer(1,2);
            Alumni.summary();
        });
    </script>
@endsection
