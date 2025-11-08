@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <div>
                <h4>Vente #{{ $vente->id }}</h4>
                <small>Le {{ $vente->created_at->format('d/m/Y H:i') }}</small>
            </div>
            <div>
                <a href="{{ route('vendeur.ventes.index') }}" class="btn btn-light btn-sm">Retour</a>
            </div>
        </div>

        <div class="card-body">
            <p><strong>Client :</strong> {{ $vente->client->nom_client ?? 'Client inconnu' }}</p>

            <h5 class="mt-3">Produits</h5>

            @if($vente->produits->isEmpty())
                <p>Aucun produit pour cette vente.</p>
            @else
                @php $calculatedTotal = 0; @endphp

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vente->produits as $produit)
                            @php
                                $prixUnitaire = $produit->pivot->prix_unitaire ?? $produit->prix_unitaire;
                                $quantite = $produit->pivot->quantite ?? 0;
                                $sousTotal = $produit->pivot->sous_total ?? ($prixUnitaire * $quantite);
                                $calculatedTotal += $sousTotal;
                            @endphp
                            <tr>
                                <td>{{ $produit->nom_produit }}</td>
                                <td>{{ number_format($prixUnitaire, 2, ',', ' ') }} €</td>
                                <td>{{ $quantite }}</td>
                                <td>{{ number_format($sousTotal, 2, ',', ' ') }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <h5>Total : <strong>{{ number_format($vente->montant_total ?? $calculatedTotal, 2, ',', ' ') }} €</strong></h5>
                </div>
            @endif
        </div>

        <div class="card-footer d-flex gap-2">
            <a href="{{ route('vendeur.ventes.edit', $vente->id) }}" class="btn btn-warning btn-sm">Modifier</a>

            <form action="{{ route('vendeur.ventes.destroy', $vente->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Supprimer cette vente ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Supprimer</button>
            </form>

            <a href="{{ route('ventes.pdf', $vente->id) }}" class="btn btn-secondary btn-sm">Télécharger PDF</a>
        </div>
    </div>
</div>
@endsection
