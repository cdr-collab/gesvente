@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h4>Produits vendus par date</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('vendeur.ventes.parDate') }}" class="row g-3" id="form-date">
                <div class="col-md-4">
                    <label for="date" class="form-label">Choisir une date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control">
                </div>
            </form>
        </div>
    </div>

    @if(request('date'))
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5>Produits vendus le {{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }}</h5>
            </div>
            <div class="card-body">
                @if($produits->isEmpty())
                    <div class="alert alert-warning">Aucun produit vendu à cette date.</div>
                @else
                    {{-- ✅ Montant total de la journée --}}
                    <div class="alert alert-success fw-bold">
                        Montant total des ventes : 
                        {{ number_format($produits->sum('total_montant'), 2, ',', ' ') }} €
                    </div>

                    <a href="{{ route('vendeur.ventes.parDate.pdf', ['date' => request('date')]) }}" class="btn btn-danger mb-3" target="_blank">
                     Exporter en PDF
                    </a>

                    <table class="table table-bordered table-striped">
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
                @endif
            </div>
        </div>
    @endif
</div>

{{-- ✅ Script pour auto-submit --}}
<script>
    document.getElementById('date').addEventListener('change', function() {
        document.getElementById('form-date').submit();
    });
</script>
@endsection
