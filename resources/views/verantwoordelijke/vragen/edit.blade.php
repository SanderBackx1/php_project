@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <div class="container">
        <form action="/vragen/{{ $vraag->id }}"  method="post">
            @method('put')
            @csrf

        <div class="form-group">
            <div class="row">
                <div class="col col-sm-12">
                    <label for="vraagnaam">Vraagnaam </label>

                    <input type="text" name="vraagnaam" id="vraagnaam"
                           class="form-control @error('vraagnaam') is-invalid @enderror"
                           placeholder="Vraag naam"

                           required
                           value="{{ old('vraagnaam', $vraag->inhoud) }}">
                    @error('vraagnaam')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            @if($vraag->typevraag_id == 2)
            <div class="row">
                <div class="col col-sm-12">
                    @foreach($vraag->antwoorden as $antwoord)
                        <label for="antwoord{{$antwoord->id}}">Antwoord </label>
                        <input type="text" name="{{$antwoord->id}}" id="{{$antwoord->id}}"
                               class="form-control @error('antwoord') is-invalid @enderror"
                               placeholder="Antwoord"

                               required
                               value="{{ old('antwoord', $antwoord->inhoud) }}">
                        @error('antwoord')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @endforeach
                </div>
            </div>
                @endif
            <div class="row">
                <div class="col col-sm-12">
                    <button type="submit" class="btn btn-success">Wijzigingen opslaan</button>
                </div>
            </div>
        </div>





        </form>

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
