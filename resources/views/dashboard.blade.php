@extends('layouts.main')

@section('content')

<h1 class="h3 mb-3 font-weight-normal">Vous êtes connecté</h1>


<form method="POST" action="/logout">
    @csrf
    <button class="btn btn-link" type="submit">Se déconnecter</button>
</form>

@endsection