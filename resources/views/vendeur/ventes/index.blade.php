@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Liste des ventes</h2>



    <div class="mb-3">
    <a href="{{ route('vendeur.ventes.create') }}" class="btn btn-success">
        Enregistrer une nouvelle vente
    </a>
</div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire de recherche --}}
    <form action="{{ route('vendeur.ventes.index') }}" method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="client" class="form-control" placeholder="Nom du client" value="{{ request('client') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('vendeur.ventes.index') }}" class="btn btn-secondary w-100">Réinitialiser</a>
        </div>
    </form>

    {{-- Montant total des ventes filtrées par date --}}
    @if(request('date') && $ventes->count() > 0)
        @php
            $montantTotal = $ventes->sum('montant_total');
        @endphp
        <div class="mb-3">
            <h4>Montant total des ventes du {{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }} : 
                {{ number_format($montantTotal, 2) }} €
            </h4>
        </div>
    @endif

    {{-- Tableau des ventes --}}
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Client</th>
                <th>Date & Heure</th>
                <th>Produits</th>
                <th>Montant total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventes as $vente)
                <tr>
                    <td>{{ $vente->client->nom_client ?? 'Client inconnu' }}</td>
                    <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @foreach($vente->produits as $produit)
                            {{ $produit->nom_produit }} ({{ $produit->pivot->quantite }})<br>
                        @endforeach
                    </td>
                    <td>{{ number_format($vente->montant_total, 2) }} €</td>
                    <td>
                        <a href="{{ route('vendeur.ventes.show', $vente->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('vendeur.ventes.edit', $vente->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('vendeur.ventes.destroy', $vente->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette vente ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('ventes.pdf', $vente->id) }}" class="btn btn-secondary btn-sm">PDF</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune vente trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
