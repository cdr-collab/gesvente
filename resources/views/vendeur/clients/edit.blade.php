@extends('layouts.vendeur')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Modifier un client</h2>

    <form action="{{ route('vendeur.clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_client" class="form-label">Nom client</label>
            <input type="text" name="nom_client" class="form-control" value="{{ $client->nom_client }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="{{ $client->adresse}}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ $client->telephone}}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email}}" required>
        </div>

        

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('vendeur.clients.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
