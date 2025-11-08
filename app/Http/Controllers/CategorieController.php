<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Afficher la liste
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.categories.create');
    }

    // Enregistrer une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom_categorie' => 'required|unique:categories,nom_categorie',
            'description'   => 'nullable|string',
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie ajoutée avec succès.');
    }

    // Formulaire d’édition
    public function edit(Categorie $categorie)
    {
        return view('admin.categories.edit', compact('categorie'));
    }

    // Mettre à jour
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom_categorie' => 'required|unique:categories,nom_categorie,' . $categorie->id,
            'description'   => 'nullable|string',
        ]);

        $categorie->update($request->all());

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Supprimer
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie supprimée avec succès.');
    }
}
