@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 style="Color: blue; Text-align:center; font-size:25px; margin-top:20px;">Modifier une catégorie</h2>

    <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_categorie" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom_categorie" class="form-control" value="{{ $categorie->nom_categorie }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $categorie->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
