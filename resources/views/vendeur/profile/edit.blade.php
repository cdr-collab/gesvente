@extends('layouts.vendeur')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Modifier mes informations</h2>

    <form action="{{ route('vendeur.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe (optionnel)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('vendeur.dashboard') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
