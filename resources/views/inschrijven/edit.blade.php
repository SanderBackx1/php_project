@extends('layouts.templatenonav')

@section('title', 'Inschrijven')

@section('main')

@include('shared.alert')
<h1>Inschrijven</h1>
<?php  use App\Evenement;?>
@if(!session()->has('success'))
@if(isset($alumnus))
<form action="/inschrijven" method="post" novalidate>
    @csrf
    <div class="form-group">
        <input type='text' name='token' id='token' style="display:none" value="{{isset($alumnus)?$alumnus[0]->token:""}}">
        <label for="name">Naam</label>
        <input type="text" name="name" id="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
            placeholder="Naam" required value="{{isset($alumnus)?$alumnus[0]->achternaam:''}}">
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    </div>
    <div class="form-group">
        <label for="name">Voornaam</label>
        <input type="text" name="surname" id="surname"
            class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Voornaam" required
            value="{{isset($alumnus)?$alumnus[0]->voornaam:''}}">
        <div class="invalid-feedback">{{ $errors->first('surname') }}</div>
    </div>

    <div class="form-group">
        <label for="email">E-mailadres</label>
        <input type="email" name="email" id="email"
            class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Email" required
            value="{{isset($alumnus)?$alumnus[0]->mail:''}}">
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            @foreach($alumnus[0]->antwoord as $antwoord)
                <?php


                $avond = Evenement::find($antwoord->vraag->evenement_id);

                ?>
                @if($antwoord->vraag->typevraag->type == "Text")
                <label for="{{$antwoord->id}}" >{{$antwoord->vraag->inhoud}}</label>
                <input type="text" name="{{$antwoord->id}}" id="{{$antwoord->id}}"
                       class="form-control @error('{{$antwoord->id}}') is-invalid @enderror"


                       required
                       value="{{ old('alumnusantwoord', $antwoord->inhoud) }}">
                @error('{{$antwoord->id}}')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                    @elseif($antwoord->vraag->typevraag->type == "Selecteer")




                    <label for="{{$antwoord->id}}" >{{$antwoord->vraag->inhoud}} </label>
                    <select id="{{$antwoord->id}}" class="form-control @error('select_antwoord') is-invalid @enderror" name="{{$antwoord->id}}" required>
                        @foreach($antwoord->vraag->antwoorden as $vraagantwoord)
                            <option value="{{$vraagantwoord->id}}" @if($antwoord->inhoud == $vraagantwoord->inhoud)
                            selected
                                @endif> {{ $vraagantwoord->inhoud }}</option>

                        @endforeach

                        @error('{{$antwoord->id}}')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>

            @endif

            @endforeach
        </div>

    </div>
    <input type="number" id="avondID" name="avondID" value={{$avond->id}} style="display:none">
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@endif

@endif
@endsection
@section('script_after')
<script defer>
    $(function(){
     $("#tokenbtn").on('click', function(){
         console.log('hey')
        const token = $('#tokentxt').val()
        $(this).attr('href', `/inschrijven?id=${token}`);
     })
 }())
</script>

@endsection
