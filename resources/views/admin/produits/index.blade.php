@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Liste des produits</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('produits.create') }}" class="btn btn-success mb-3">Ajouter un produit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix unitaire</th>
                  <th>Quantité en stock</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($produits as $produit)
            <tr>
                <td>{{ $produit->nom_produit }}</td>
                <td>{{ number_format($produit->prix_unitaire, 2, ',', ' ') }} €</td>
                 <td>
                    @if(is_null($produit->quantite_stock))
                        <span class="text-muted">Non défini</span>
                    @else
                        {{ $produit->quantite_stock }}
                    @endif
                </td>
                <td>{{ $produit->description }}</td>
                <td>{{ $produit->categorie->nom_categorie }}</td>
                <td>
                    <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun produit trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
