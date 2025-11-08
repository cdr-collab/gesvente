@extends('layouts.vendeur')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Liste des clients</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('vendeur.clients.create') }}" class="btn btn-success mb-3">Ajouter un client</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom Client</th>
                <th>Adresse</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr>
                <td>{{ $client->nom_client }}</td>
                <td>{{ $client->adresse }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a href="{{ route('vendeur.clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('vendeur.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun client trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
