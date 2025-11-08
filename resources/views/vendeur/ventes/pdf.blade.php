<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Vente #{{ $vente->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
        .total { text-align: right; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Facture de Vente</h2>
        <p>Vente #{{ $vente->id }} | Date : {{ $vente->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <p><strong>Client :</strong> {{ $vente->client->nom_client ?? 'Client inconnu' }}</p>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @php $calculatedTotal = 0; @endphp
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

    <p class="total">
        Total : {{ number_format($vente->montant_total ?? $calculatedTotal, 2, ',', ' ') }} €
    </p>
</body>
</html>
