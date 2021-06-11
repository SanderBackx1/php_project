@csrf
<div class="form-group">
    <?php  use App\Evenement;?>
<div class="row">
    <div class="col col-sm-6">


        <label for="alumnusvoornaam">Voornaam: </label>

            <input type="text" name="alumnusvoornaam" id="alumnusvoornaam"
                   class="form-control @error('alumnusvoornaam') is-invalid @enderror"
                   placeholder="Alumnusvoornaam"

                   required
                   value="{{ old('alumnusnaam', $alumnus->voornaam) }}">
            @error('alumnusvoornaam')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>
    <div class="col col-sm-6">
        <label for="alumnusachternaam">Achternaam: </label>

            <input type="text" name="alumnusachternaam" id="alumnusachternaam"
                   class="form-control @error('alumnusachternaam') is-invalid @enderror"
                   placeholder="Alumnusachternaam"

                   required
                   value="{{ old('alumnusachternaam', $alumnus->achternaam) }}">
            @error('alumnusachternaam')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

</div>
    <div class="row">
        <div class="col col-sm-12">
            <label for="mail">E-mailadres:</label>
            <input type="email" name="mail" id="mail"
                   class="form-control @error('mail') is-invalid @enderror"
                   placeholder="E-mail"

                   required
                   value="{{ old('mail', $alumnus->mail) }}">
            @error('mail')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col col-sm-12">
            @foreach($alumnus->antwoord as $antwoord)
                <?php


                $avond = Evenement::find($antwoord->vraag->evenement_id);

                ?>
                    @foreach($avond->vragen as $alumnusantwoord)
                        <?php

                        $alumnusantwoordid = $alumnusantwoord->id ?>
                    @endforeach
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
                    <select id="{{$antwoord->id}}" class="form-control @error('select_antwoord') is-invalid @enderror"

                            name="{{$antwoord->id}}"  required>

                        @foreach($antwoord->vraag->antwoorden as $vraagantwoord)
                            <option value="{{$vraagantwoord->id}}" @if($antwoord->inhoud == $vraagantwoord->inhoud)
                              selected
                                @endif
                            > {{ $vraagantwoord->inhoud }}</option>

                        @endforeach

                        @error('{{$antwoord->id}}')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>


            @endif

            @endforeach
        </div>

    </div>

<div class="row">
    <div class="col col-sm-12">
        <br>
    <button data-toggle="tooltip" title="Wijzigingen opslaan" type="submit" class="btn btn-success">Wijzigingen opslaan</button>
    </div>
</div>





</div>
