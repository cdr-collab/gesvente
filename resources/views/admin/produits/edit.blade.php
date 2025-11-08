@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Modifier un produit</h2>

    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_produit" class="form-label">Nom du produit</label>
            <input type="text" name="nom_produit" class="form-control" value="{{ $produit->nom_produit }}" required>
        </div>

        <div class="mb-3">
            <label for="prix_unitaire" class="form-label">Prix unitaire</label>
            <input type="number" step="0.01" name="prix_unitaire" class="form-control" value="{{ $produit->prix_unitaire }}" required>
        </div>

        <div class="mb-3">
         <label for="quantite_stock" class="form-label">Quantité en stock</label>
          <input type="number" name="quantite_stock" id="quantite_stock" class="form-control" 
           value="{{ old('quantite_stock', $produit->quantite_stock) }}">
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-control" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom_categorie }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $produit->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
