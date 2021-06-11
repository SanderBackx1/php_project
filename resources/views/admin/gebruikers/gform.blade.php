@csrf
<div class="form-group">
    <label for="naam">Naam</label>
    <input type="text" name="name" id="name"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="Naam"

           required
           value="{{ old('name', $user->name) }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <label for="email">E-mailadres</label>
    <input type="email" name="email" id="email"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="E-mail"

           required
           value="{{ old('email', $user->email) }}">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <p>Admin</p>
    <input type="radio" id="Ja" name="admin" value="1" @if($user->admin) checked
    @endif>
    <label for="Ja">Ja</label>
    <input type="radio" id="Nee" name="admin" value="0" @if(!$user->admin) checked
        @endif>
    <label for="Nee">Nee</label>
    <p>Alumniverantwoordelijke</p>
    <input type="radio" id="Verantwoordelijk" name="verantwoordelijke" value="1" @if($user->verantwoordelijke) checked
        @endif>
    <label for="Verantwoordelijk">Ja</label>
    <input type="radio" id="Onverantwoordelijk" name="verantwoordelijke" value="0" @if(!$user->verantwoordelijke) checked
        @endif>
    <label for="Onverantwoordelijk">Nee</label>
</div>
<button data-toggle="tooltip" title="Bewaar gebruiker" type="submit" class="btn btn-success">Bewaar gebruiker</button>
