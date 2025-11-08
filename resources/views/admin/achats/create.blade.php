@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Enregistrer un achat</h1>

    <form action="{{ route('achats.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="produit_id">Produit</label>
            <select name="produit_id" class="form-control" required>
                <option value="">-- Sélectionner --</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fournisseur_id">Fournisseur</label>
            <select name="fournisseur_id" class="form-control" required>
                <option value="">-- Sélectionner --</option>
                @foreach($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom_fournisseur }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite_achat">Quantité</label>
            <input type="number" name="quantite_achat" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('achats.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
