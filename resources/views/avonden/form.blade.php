@csrf
<div class="form-group">
<label for="evenementnaam">Evenementnaam: </label>
<input type="text" name="evenementnaam" id="evenementnaam"
       class="form-control @error('evenementnaam') is-invalid @enderror"
       placeholder="Evenementnaam"

       required
       value="{{ old('evenementnaam', $evenement->evenementnaam) }}">
@error('evenementnaam')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
    <label for="beschrijving">Beschrijving: </label>
    <input type="text" name="beschrijving" id="beschrijving"
           class="form-control @error('beschrijving') is-invalid @enderror"
           placeholder="Beschrijving"

           required
           value="{{ old('beschrijving', $evenement->beschrijving) }}">
    @error('beschrijving')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <label for="datum">Datum </label>
    <input type="date" name="datum" id="datum"
           class="form-control @error('datum') is-invalid @enderror"
           placeholder="Datum"

           required
           value="{{ old('datum', $evenement->datum) }}">
    @error('datum')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <label for="tijdstip">Tijdstip </label>
    <input type="time"  name="tijdstip" id="tijdstip"
           class="form-control @error('tijdstip') is-invalid @enderror"
           placeholder="tijdstip"

           required
           value="{{ old('tijdstip', $evenement->tijdstip) }}">
    @error('tijdstip')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <br>
    <button data-toggle="tooltip" title="avond bewaren" type="submit" class="btn btn-success">Bewaar avond</button>




</div>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }

    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datum").setAttribute("min", today);
</script>
