@extends('layouts.template')

@section('title', 'Inschrijving aanmaken')

@section('main')
@include('shared.summary', ['title'=>'Avonden', 'msg'=>"Op deze pagina kan u een nieuwe alumnus aanmaken"])
<div class="container">
    <div class='form-group'>

        <h1>Inschrijving aanmaken voor {{$avond->evenementnaam}}</h1>
        <form action="/alumnusantwoorden" method="post">
            @method('post')
            @csrf
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name"
                    class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Naam" required
                    value="{{ old('name') }}">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
            <div class="form-group">
                <label for="name">Voornaam</label>
                <input type="text" name="surname" id="surname"
                    class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Voornaam"
                    required value="{{ old('surname') }}">
                <div class="invalid-feedback">{{ $errors->first('surname') }}</div>
            </div>

            <div class="form-group">
                <label for="email">E-mailadres</label>
                <input type="email" name="email" id="email"
                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" placeholder="Email" required
                    value="{{ old('email') }}">
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            </div>

            <input style='display:none' name='avondID' value={{$avond->id}}>
            @foreach ($avond->vragen as $vraag)
                @if($vraag->typevraag->type == "Text")
            <div class="form-group">
                <label for="{{$vraag->id}}">{{$vraag->inhoud}}</label>
                <input class="form-control" type='text' name='{{$vraag->id}}' id='vraag{{$vraag->id}}'>
            </div>
                    @elseif($vraag->typevraag->type == "Selecteer")
                    <label for="{{$vraag->id}}" >{{$vraag->inhoud}} </label>
                    <select id="vraag{{$vraag->id}}" name="{{$vraag->id}}" class="form-control @error('select_antwoord') is-invalid @enderror"  required>
                        @foreach($vraag->antwoorden as $vraagantwoord)
                            <option value="{{$vraagantwoord->id}}"> {{ $vraagantwoord->inhoud }}</option>

                        @endforeach
                    </select>
                @endif
            @endforeach

            <button data-toggle="tooltip" title="Alumnus opslaan" type="submit" class="btn btn-success">Alumnus
                opslaan</button>

        </form>
    </div>
</div>
@endsection
@section('script_after')
    <script>
        $(function(){
            Alumni.footer(0,3);
        // Alumni.summary();
    </script>
@endsection
@section('css_after')


@endsection
