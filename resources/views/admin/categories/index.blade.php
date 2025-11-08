@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Liste des catégories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Ajouter une catégorie</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categories as $categorie)
            <tr>
                <td>{{ $categorie->nom_categorie }}</td>
                <td>{{ $categorie->description }}</td>
                <td>
                    <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Aucune catégorie trouvée.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
