@csrf
<div class="form-group">
    <label for="opleidingnaam">Opleidingnaam</label>
    <input type="text" name="opleidingnaam" id="opleidingnaam"
           class="form-control {{ $errors->first('opleidingnaam') ? 'is-invalid' : '' }}"
           placeholder="{{$opleiding->opleidingnaam}}"
           required
           value="{{ old('opleidingnaam', $opleiding->opleidingnaam) }}">
    <div class="invalid-feedback">{{ $errors->first('opleidingnaam') }}</div>
</div>
<p>Actief</p>
<input type="radio" id="Ja" name="actief" value="1" @if($opleiding->actief) checked
    @endif>
<label for="Ja">Ja</label>
<input type="radio" id="Nee" name="actief" value="0" @if(!$opleiding->actief) checked
    @endif>
<label for="Nee">Nee</label>
<br>
<button type="submit" class="btn btn-success">Opleiding opslaan</button>
