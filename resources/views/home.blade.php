@extends('layouts.template')

@section('title', 'Home')

@section('main')
    <div>
        <h1>Welkom!</h1>
        <p>Dit is de homepagina van Alumnapp. <br> Op de andere pagina's vindt u allerlei informatie en toepassingen over de alumni-avond.</p>
        <h3>Mijn taken</h3>
        <div>
            @foreach($docenttaken as $docenttaak)
                @if (auth()->user()->id == $docenttaak->user_id)
                    @if($docenttaak->aangewezen == true)
                    <ul>
                        <li>
                            {{$docenttaak->taken->naam }} | {{$docenttaak->taken->evenement->evenementnaam}}
                        </li>
                    </ul>
                    @endif
                @endif
            @endforeach

        </div>

        <h3>Opkomende evenementen</h3>
        <div class='table-responsive'>
            <table class='table table-hover'>
                <tbody>
                @foreach ($evenementen as $evenement)
                    <td>
                        <p>{{$evenement->evenementnaam }}</p>
                        <p>Datum: {{$evenement->datum }}</p>
                        <p>Start: {{$evenement->tijdstip }}</p>
                    </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script_after')
    <script>

        $(function(){
            Alumni.footer(1,0);
            Alumni.summary();
        });

    </script>
@endsection
