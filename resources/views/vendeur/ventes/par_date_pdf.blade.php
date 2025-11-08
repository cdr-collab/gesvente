<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Produits vendus le {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Produits vendus le {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h2>

    <div class="total">
        Montant total des ventes : {{ number_format($montantGlobal, 2, ',', ' ') }} €
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom du produit</th>
                <th>Prix unitaire</th>
                <th>Quantité vendue</th>
                <th>Montant total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $p)
                <tr>
                    <td>{{ $p->nom_produit }}</td>
                    <td>{{ rtrim(rtrim(str_replace('.', ',', $p->prix_unitaire), '0'), ',') }} €</td>
                    <td>{{ $p->total_quantite }}</td>
                    <td>{{ number_format($p->total_montant, 2, ',', ' ') }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
