@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center" style="padding-top: 10vh; padding-bottom: 5vh;">
    <div class="card shadow p-4" style="width: 400px; max-width: 90%;">
        <h3 class="text-center mb-4">Connexion</h3>

        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email">Adresse Email</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>

        <!-- Lien vers l'inscription 
        <div class="text-center">
            <p>Pas encore de compte ? 
                <a href="{{ route('register') }}">Inscrivez-vous ici</a>
            </p>
        </div>
        -->
    </div>
</div>
@endsection
