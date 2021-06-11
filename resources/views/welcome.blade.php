@extends('layouts.template')

@section('title', 'Welkom')

@section('main')
    @include('shared.summary', ['title'=>'Welkom', 'msg'=>"Welkom op de app!"])
    <div>
        <p>Dit is de startpagina van Alumnapp.</p>
        <p>
            Het doel van deze webapplicatie is om de alumni-avonden en al de zaken daaromheen makkelijker te kunnen organiseren.
        </p>
        <p>
            Je kan in deze applicatie volgende dingen doen:
        </p>
        <ul>
            <li>Mezelf inschrijven voor een evenement (als alumni)</li>
            <li>Alumni beheren</li>
            <li>Evenementen organiseren (en beheren)</li>
            <li>Activiteiten beheren</li>
            <li>Taken beheren (je kan ook docenten aanwijzen voor taken en eigen voorkeuren voor die geven)</li>
            <li>De verschillende soorten gebruikers beheren</li>
            <li>Alle opleidingen die er zijn beheren</li>
        </ul>
        <p>Dit is een proefproject, deze app zal dus niet als echte versie gebruikt worden.</p>
    </div>
@endsection
@section('script_after')
    <script>
        $(function(){
            (function summary(){
                setTimeout(()=>{
                    $('.summary').addClass('fade');
                    setTimeout(()=>{
                        $('.summary').css('display', 'none');
                    },1000)
                }, 5000);
            }())
        });

        (function(){
            //Sander: 0
            //Brent: 1
            //Jens: 2
            //Brecht: 3
            $('.footerItem')[1].append(' (O) ')
            $('.footerItem')[3].append(' (T) ')
        }());
    </script>
@endsection
