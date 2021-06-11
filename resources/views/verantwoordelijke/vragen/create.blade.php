@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <div class="container">
        <div class="row">
<div class="col col-sm-10">



    <div class='form-group'>

            <label for="voornaam">Voornaam</label>
            <input class="form-control"  type='text' name='voornaam' id="voornaam" >
            <br>
            <label for="achternaam">Achternaam</label>
            <input class="form-control" type='text' name='achternaam' >
            <br>
            <label for="mail">E-mailadres</label>
            <input class="form-control"  type='text' name='mail' >
            <br>
    </div>
        </div>
</div>
        <div class='form-group'>
            <div class="row">


            @foreach ($avond->vragen as $vraag)
                @if($vraag->typevraag->type == "Text")
                            <div class="col col-sm-10">
                                <label for="{{$vraag->id}}" id='vraag{{$vraag->id}}'>{{$vraag->inhoud}}</label>
                                <input class="form-control" type='text' name='{{$vraag->id}}' >

                            </div>
                    <div class="col col-sm-2">
                        <form action="/vragen/{{ $vraag->id }}" onsubmit="return confirm('Vraag {{$vraag->inhoud}} verwijderen? ');" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/vragen/{{$vraag->id}}/edit" class="btn btn-outline-success"  data-toggle="tooltip"
                                   title="Bewerk {{$vraag->inhoud}} "><i class="fas fa-edit"></i></a>

                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Verwijder {{$vraag->inhoud}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </div>

                        </form>
                    </div>


                @elseif($vraag->typevraag->type == "Selecteer")
                        <div class="col col-sm-10">
                            <label for="{{$vraag->id}}" >{{$vraag->inhoud}} </label>
                            <select id="vraag{{$vraag->id}}" name="{{$vraag->id}}" class="form-control @error('select_antwoord') is-invalid @enderror"  required>
                                @foreach($vraag->antwoorden as $vraagantwoord)
                                    <option value="{{$vraagantwoord->id}}"> {{ $vraagantwoord->inhoud }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col col-sm-2">
                            <form action="/vragen/{{ $vraag->id }}" onsubmit="return confirm('Vraag {{$vraag->inhoud}} verwijderen? ');" method="post">
                                @method('delete')
                                @csrf
                                <div class="btn-group btn-group-sm">
                                    <a href="/vragen/{{$vraag->id}}/edit" class="btn btn-outline-success"  data-toggle="tooltip"
                                       title="Bewerk {{$vraag->inhoud}} "><i class="fas fa-edit"></i></a>

                                    <button type="submit" class="btn btn-outline-danger"
                                            data-toggle="tooltip"
                                            title="Verwijder {{$vraag->inhoud}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </div>

                            </form>
                        </div>

                @endif
            @endforeach
            </div>

        </div>
        <p><a href="/vragen/{{$avond->id}}?vraagtype=1"> <i class="fas fa-plus"> </i> Nieuwe text vraag</a></p>
        <p><a href="/vragen/{{$avond->id}}?vraagtype=2"> <i class="fas fa-plus"> </i> Nieuwe selecteer vraag</a></p>
        <button onclick="window.location.href='/opslaan/{{$avond->id}}'" class="btn btn-success">Klaar met inschrijvingsformulier te maken</button>

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
