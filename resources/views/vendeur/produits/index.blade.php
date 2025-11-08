@extends('layouts.vendeur')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des produits</h1>

    <!-- Formulaire de recherche et filtre -->
    <form method="GET" action="{{ route('vendeur.produits.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="categorie_id" class="form-select">
                <option value="">-- Toutes les catégories --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" 
                        {{ request('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom_categorie }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filtrer</button>
            <a href="{{ route('vendeur.produits.index') }}" class="btn btn-secondary">Réinitialiser</a>
        </div>
    </form>

    <!-- Tableau -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom du produit</th>
                <th>Prix unitaire</th>
                <th>Quantité en stock</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produits as $produit)
                <tr>
                    <td>{{ $produit->id }}</td>
                    <td>{{ $produit->nom_produit }}</td>
                    <td>{{ number_format($produit->prix_unitaire, 2, ',', ' ') }} €</td>
                    <td>{{ $produit->quantite_stock ?? '—' }}</td>
                    <td>{{ $produit->categorie->nom_categorie ?? 'Non défini' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun produit trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
