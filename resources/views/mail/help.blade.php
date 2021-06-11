@extends('layouts.template')

@section('title', 'Handleiding mails')

@section('main')
<h1>Mail - Help</h1>

<h3><a href="#!" data-toggle="collapse" data-target="#hoeVoegIkFiltersToe">Hoe voeg ik filters toe?</a></h3>
<div class="collapse multi-collapse" id="hoeVoegIkFiltersToe">
    <div class="card card-body">
        U bent op het hoofdscherm van de mailpagina.
        <ol>
            <li>
                U klikt op de knop <span class='bold'>Wijzig filters</span>.
                <ul>
                    <li>Hier opent een venster waar u filters kan selecteren. U kan hiervoor kiezen enkel filters te
                        zien van bepaalde avonden met de selectbox bovenaan.<br>Standaard toont dit alle filters.</li>
                </ul>
            </li>
            <li>
                Selecteer de filter die u wenst en klik op de <span class='bold'>&gt;</span> knop.
                <ul>
                    <li>
                        U kan ook alle filters toevoegen door op de <span class="bold">&gt;&gt;</span> knop te klikken.
                    </li>
                </ul>
            </li>
            <li>
                Sluit het venster door op <span class='bold'>x</span> of uit het venster te klikken.
            </li>
        </ol>
        U kan nu de geselecteerde filters toepassen.
    </div>
</div>

<h3><a href="#!" data-toggle="collapse" data-target="#hoeVerwijderIkFilters">Hoe verwijder ik filters?</a></h3>
<div class="collapse multi-collapse" id="hoeVerwijderIkFilters">
    <div class="card card-body">
        U bent op het hoofdscherm van de mailpagina.
        <ol>
            <li>
                U klikt op de knop <span class='bold'>Wijzig filters</span>.
                <ul>
                    <li>Hier opent een venster waar u filters kan selecteren. U kan hiervoor kiezen enkel filters te
                        zien van bepaalde avonden met de selectbox bovenaan.<br>Standaard toont dit alle filters.</li>
                </ul>
            </li>
            <li>
                Selecteer de filter die u wenst te verwijderen en klik op de <span class='bold'>&lt;</span> knop.
                <ul>
                    <li>
                        U kan ook alle filters verwijderen door op de <span class="bold">&lt;&lt;</span> knop te
                        klikken.
                    </li>
                </ul>
            </li>
            <li>
                Sluit het venster door op <span class='bold'>x</span> of uit het venster te klikken.
            </li>
        </ol>
        De gewenste filters zijn verwijderd.
    </div>
</div>

<h3><a href="#!" data-toggle="collapse" data-target="#hoeVerwijderIkAlleFilters">Hoe verwijder ik alle filters?</a></h3>
<div class="collapse multi-collapse" id="hoeVerwijderIkAlleFilters">
    <div class="card card-body">
        U bent op het hoofdscherm van de mailpagina.
        <ol>
            <li>
                U klikt op de knop <span class='bold'>Verwijder alle filters</span>.
            </li>
        </ol>
        Alle filters zijn verwijderd.
    </div>
</div>

<h3><a href="#!" data-toggle="collapse" data-target="#hoeVoegIkMailadressenToe">Hoe voeg ik e-mailadressen toe?</a></h3>
<div class="collapse multi-collapse" id="hoeVoegIkMailadressenToe">
    <div class="card card-body">
        U bent op het hoofdscherm van de mailpagina.
        <ol>
            <li>
                U selecteert de gewenste alumni en u klikt op de <span class='bold'>&gt;</span> knop.
                <ul>
                    <li>
                        U kan ook alle alumni toevoegen door op de <span class="bold">&gt;&gt;</span> knop te klikken.
                    </li>
                </ul>
            </li>
        </ol>
        De gewenste e-mailadressen worden in het adresveld ingevuld.
    </div>
</div>

<h3><a href="#!" data-toggle="collapse" data-target="#hoeVerwijderIkMailadressen">Hoe verwijder ik e-mailadressen?</a>
</h3>
<div class="collapse multi-collapse" id="hoeVerwijderIkMailadressen">
    <div class="card card-body">
        U bent op het hoofdscherm van de mailpagina.
        <ol>
            <li>
                U selecteert de gewenste alumni en u klikt op de <span class='bold'>&lt;</span> knop.
                <ul>
                    <li>
                        U kan ook alle alumni verwijderen door op de <span class="bold">&lt;&lt;</span> knop te klikken.
                    </li>
                </ul>
            </li>
        </ol>
        De verwijderde e-mailadressen verdwijnen uit het adresveld.
    </div>
</div>

<h3><a href="#!" data-toggle="collapse" data-target="#kanIkManueelMailadressenToevoegen">Kan ik manueel e-mailadressen
        toevoegen?</a></h3>
<div class="collapse multi-collapse" id="kanIkManueelMailadressenToevoegen">
    <div class="card card-body">
        U kan manueel e-mailadressen toevoegen.
        Echter worden uw manueel ingevulde e-mailadressen verwijderd wanneer u via de selectiemogelijkheid e-mailadressen
        toevoegt of verwijderd.
        <ol>
            <li>
                Voeg uw gewenste e-mailadres toe in de adresbalk.
                <ul>
                    <li>
                        Indien u meer als één e-mailadres wilt toevoegen, zet dan tussen de e-mailadressen een ';' en een
                        spatie.
                    </li>
                </ul>
            </li>
        </ol>
    </div>
</div>

<h3><a href="#!" data-toggle="collapse" data-target="#WaaromOpentMijnMailprogramma">Waarom opent mijn mailprogramma als ik op "Bericht verzenden" klik?</a></h3>
<div class="collapse multi-collapse" id="WaaromOpentMijnMailprogramma">
    <div class="card card-body">
        Omdat wij geen toegang hebben tot een mailserver hebben wij ervoor gekozen de ingevulde velden te verzenden naar uw mailprogramma.<br>
        Voor uw bericht te verzenden moet u dus in uw mailprogramma op verzenden klikken.
    </div>
</div>

@endsection
@section('script_after')
    <script>
        Alumni.footer(0,3)
    </script>

@endsection
@section('css_after')
<style>
    .bold {
        font-weight: bold;
    }
</style>
@endsection
