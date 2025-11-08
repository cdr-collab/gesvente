@extends('layouts.vendeur')

@section('content')
<div class="container">
    <h1 style="color: blue; text-align:center; font-size:25px; margin-top:20px;">
        Modifier la Vente #{{ $vente->id }}
    </h1>

    <form action="{{ route('vendeur.ventes.update', $vente) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        {{-- Sélection du client --}}
        <div class="mb-3">
            <label class="form-label">Client</label>
            <select name="client_id" class="form-select" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $vente->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->nom_client }}
                    </option>
                @endforeach
            </select>
            @error('client_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        {{-- Produits --}}
        <h4>Produits</h4>
        <div id="produits-container">
            @foreach($vente->produits as $index => $prod)
                <div class="row mb-3 produit-row">
                    <div class="col-md-6">
                        <label class="form-label">Produit</label>
                        <select name="produits[{{ $index }}][id]" class="form-select" required>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" 
                                    {{ $prod->id == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->nom_produit }} (Stock: {{ $produit->quantite_stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantité</label>
                        <input type="number" name="produits[{{ $index }}][quantite]" 
                               value="{{ $prod->pivot->quantite }}" 
                               min="1" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-produit">X</button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bouton pour ajouter un produit --}}
        <button type="button" id="add-produit" class="btn btn-success mb-3">+ Ajouter un produit</button>

        {{-- Boutons --}}
        <div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('vendeur.ventes.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

{{-- Template caché pour une nouvelle ligne produit --}}
<template id="produit-template">
    <div class="row mb-3 produit-row">
        <div class="col-md-6">
            <label class="form-label">Produit</label>
            <select name="produits[__INDEX__][id]" class="form-select" required>
                <option value="">-- Sélectionner un produit --</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">
                        {{ $produit->nom_produit }} (Stock: {{ $produit->quantite_stock }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Quantité</label>
            <input type="number" name="produits[__INDEX__][quantite]" value="1" min="1" class="form-control" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger remove-produit">X</button>
        </div>
    </div>
</template>

{{-- Script JS --}}
<script>
    let produitIndex = {{ $vente->produits->count() }};
    document.getElementById('add-produit').addEventListener('click', function () {
        let template = document.getElementById('produit-template').innerHTML;
        template = template.replace(/__INDEX__/g, produitIndex);
        document.getElementById('produits-container').insertAdjacentHTML('beforeend', template);
        produitIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-produit')) {
            e.target.closest('.produit-row').remove();
        }
    });
</script>
@endsection
