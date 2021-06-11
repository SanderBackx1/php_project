@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <div class="container">
        <div class='form-group'>
            <h1>Avond toevoegen</h1>
            <form action="/avonden"  method="post">

@if(count($ongekozen) != 0)

                <label for="opleiding">Kies een opleiding waarvoor je een evenement wilt maken: </label>

                <select id="opleiding" name="evenementopleiding">
                    @foreach($ongekozen as $opleiding)
                        <option value="{{$opleiding->id}}">{{$opleiding->opleidingnaam}}</option>
                    @endforeach


                </select>
                @include('avonden.form')
            </form>
            @else
                <H5>Voor elke opleiding is al reeds een evenement aangemaakt, voeg eerst een nieuwe opleiding toe vooraleer je een nieuw evenement wilt maken.</H5>
            @endif

        </div>
    </div>
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
