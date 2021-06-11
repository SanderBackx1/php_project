@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <div class="container">
        <div class='form-group'>

            <form action="/vragen" method="post" >

                @csrf
                <div class="row">
                    <div class="col col-sm-12">


                    <label for="vraagnaam">Naam vraag </label>

                    <input type="text" name="vraagnaam" id="vraagnaam"
                           class="form-control @error('vraagnaam') is-invalid @enderror"
                           placeholder="Vraag naam"

                           required
                    >
                    @error('vraagnaam')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>

                </div>

                <input type="text" name="typevraagid" id="typevraagid"
                       class="form-control @error('typevraagid') is-invalid @enderror"
                       placeholder="Taak naam"  value="{{$typevraag->id}}" hidden>
                <input type="text" name="evenementid" id="evenementid"
                       class="form-control @error('evenementid') is-invalid @enderror"
                       placeholder="evenement id"  value="{{$avond->id}}" hidden>





                @if($typevraag->type == "Selecteer")

                <div class="row">
                    <div class="col col-sm12">
                    <label for="aantalantwoorden">Aantal antwoorden: </label>
                    <input type="number" id="aantalantwoorden" onchange="gekozen()" min="1">
                    </div>
                </div>

<div class="row">
    <div class="col col-sm12">
        <div id="antwoorden"></div>
    </div>
</div>




            @endif

                <button type="submit" class="btn btn-success">Opslaan</button>

            </form>
        </div>







    </div>
@endsection
@section('script_after')
    <script>

        function gekozen() {
            var e = document.getElementById("aantalantwoorden").value;

            var node= document.getElementById("antwoorden");
            node.innerHTML = "";
            var teller =0;
            for (let step = 1; step <= e; step+=1) {
                teller+=1;
                var label = document.createElement("label");
                label.setAttribute("for", step);
                label.innerText = "Antwoord "+step+": ";
                document.getElementById("antwoorden").appendChild(label);
                var x = document.createElement("INPUT");
                x.setAttribute("type", "text");
                x.setAttribute("name",step);
                x.setAttribute("id",step);
                document.getElementById("antwoorden").appendChild(x);
                var br = document.createElement("br");
                document.getElementById("antwoorden").appendChild(br);

            }
            var y = document.createElement("INPUT");
            y.setAttribute("type", "text");
            y.setAttribute("id","teller");
            y.setAttribute("name","teller");
            y.setAttribute("value",teller);
            y.setAttribute("hidden", true);
            document.getElementById("antwoorden").appendChild(y);






        }
        Alumni.footer(3,0);
        // Alumni.summary();
    </script>
@endsection
@section('css_after')

@endsection
