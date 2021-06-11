@csrf
<div class="form-group">
    <div class="row">
        <div class="col col-sm-6">
            <label for="taaknaam">Naam </label>

            <input type="text" name="taaknaam" id="taaknaam"
                   class="form-control @error('taaknaam') is-invalid @enderror"
                   placeholder="Taak naam"

                   required
                   value="{{ old('taaknaam', $taak->naam) }}">
            @error('taaknaam')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col col-sm-6">
            <label for="taakaantal">Maximum aantal docenten </label>

            <input type="number" min="0" name="taakaantal" id="taakaantal"
                   class="form-control @error('taakaantal') is-invalid @enderror"



                   value="{{ old('taakaantal', $taak->aantal) }}">
            @error('taakaantal')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror</div>
        </div>
    </div>
<div class="row">
    <div class="col col-sm-12">
        <label for="taakbeschrijving">Beschrijving </label>
        <textarea rows="4" cols="50" name="taakbeschrijving" id="taakbeschrijving" class="form-control @error('taakbeschrijving') is-invalid @enderror"
                  placeholder="Taak beschrijving" form="taakform">{{ old('taaknaam', $taak->beschrijving) }}</textarea>

        @error('taakbeschrijving')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <input type="text" name="taakevenement" id="taakevenement"
           class="form-control @error('taaknaam') is-invalid @enderror"
           placeholder="Taak naam"  value="{{ old('taaknaam', $taak->evenement_id) }}" hidden>

</div>

<div class="row">
    <div class="col col-sm-12">
        <br>
        <button type="submit" class="btn btn-success">Wijzigingen opslaan</button>

    </div>
</div>

