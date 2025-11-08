@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Liste des fournisseurs</h1>

    <a href="{{ route('fournisseurs.create') }}" class="btn btn-success mb-3">Ajouter un fournisseur</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Produits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($fournisseurs as $fournisseur)
            <tr>
                <td>{{ $fournisseur->nom_fournisseur }}</td>
                <td>{{ $fournisseur->adresse }}</td>
                <td>{{ $fournisseur->telephone }}</td>
                <td>{{ $fournisseur->email }}</td>
                <td>
                    @if($fournisseur->produits->isNotEmpty())
                        <ul class="mb-0">
                            @foreach($fournisseur->produits as $produit)
                                <li>{{ $produit->nom_produit }}</li>
                            @endforeach
                        </ul>
                    @else
                        <em>Aucun produit</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-primary btn-sm">Modifier</a>

                    <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Voulez-vous vraiment supprimer ce fournisseur ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Aucun fournisseur trouvé</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
