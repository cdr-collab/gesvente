@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-4" style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Ajouter un nouveau fournisseur</h1>

            <form action="{{ route('fournisseurs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom du fournisseur</label>
                    <input type="text" name="nom_fournisseur" class="form-control"
                           value="{{ old('nom_fournisseur') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Produits associés</label>
                    <select name="produits[]" class="form-select" multiple>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Maintenez CTRL (ou CMD sur Mac) pour sélectionner plusieurs produits.</small>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Annuler</a>
            </form>

        </div>
    </div>
</div>
@endsection
