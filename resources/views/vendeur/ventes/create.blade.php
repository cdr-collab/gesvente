@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white">
            <h3>Nouvelle vente</h3>
        </div>
        <div class="card-body">
            {{-- Affichage des erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('vendeur.ventes.store') }}" method="POST">
                @csrf

                {{-- Sélection du client --}}
                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-select" required>
                        <option value="">-- Sélectionner un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom_client }}</option>
                        @endforeach
                    </select>
                </div>

                <h5 class="mt-4">Produits</h5>
                <div id="produits-container">
                    <div class="row g-2 produit-row mb-2">
                        <div class="col-md-6">
                            <select name="produits[0][id]" class="form-select" required>
                                <option value="">-- Choisir un produit --</option>
                                @foreach($produits as $produit)
                                    <option value="{{ $produit->id }}">
                                        {{ $produit->nom_produit }} (Stock: {{ $produit->quantite_stock }}, Prix: {{ number_format($produit->prix_unitaire, 2) }} )
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="produits[0][quantite]" class="form-control" min="1" placeholder="Quantité" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="supprimerProduit(this)">X</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-success btn-sm mt-2" onclick="ajouterProduit()">+ Ajouter un produit</button>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Enregistrer la vente</button>
                    <a href="{{ route('vendeur.ventes.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let index = 1;
    function ajouterProduit() {
        let container = document.getElementById('produits-container');
        let row = document.createElement('div');
        row.classList.add('row', 'g-2', 'produit-row', 'mb-2');
        row.innerHTML = `
            <div class="col-md-6">
                <select name="produits[${index}][id]" class="form-select" required>
                    <option value="">-- Choisir un produit --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">
                            {{ $produit->nom_produit }} (Stock: {{ $produit->quantite_stock }}, Prix: {{ number_format($produit->prix_unitaire, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="produits[${index}][quantite]" class="form-control" min="1" placeholder="Quantité" required>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="supprimerProduit(this)">X</button>
            </div>
        `;
        container.appendChild(row);
        index++;
    }

    function supprimerProduit(btn) {
        let row = btn.closest('.produit-row');
        if (document.querySelectorAll('.produit-row').length > 1) {
            row.remove();
        }
    }
</script>
@endsection
