
    @extends('layouts.main')

@section('content')
<form method="POST" action="/login" class="form-signin">
    @csrf
    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
    <p>Retrouvez tous vos contacts</p>

    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Votre adresse e-mail: email@test.com">
    @error('email')
    <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Votre mot de passe : ********">
    @error('password')
    <small class="text-danger">{{ $message }}</small>
    @enderror

    <div class="checkbox mb-3">
        <label>
        <input type="checkbox" id="remember" name="remember"> Se souvenir de moi ?
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
</form>
@endsection