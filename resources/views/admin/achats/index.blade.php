@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Liste des Produits ajoutés dans le stock</h1>
    <a href="{{ route('achats.create') }}" class="btn btn-primary mb-3">Enregistrer une entrée de produit</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Fournisseur</th>
                <th>Quantité</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($achats as $achat)
                <tr>
                    <td>{{ $achat->id }}</td>
                    <td>{{ $achat->produit->nom_produit }}</td>
                    <td>{{ $achat->fournisseur->nom_fournisseur }}</td>
                    <td>{{ $achat->quantite_achat }}</td>
                    <td>{{ $achat->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('achats.edit', $achat) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('achats.destroy', $achat) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet achat ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
