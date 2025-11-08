<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Afficher la liste des produits
     */
    public function index()
    {
        // On charge les produits avec leur catégorie
        $produits = Produit::with('categorie')->get();

        return view('admin.produits.index', compact('produits'));
    }

   public function indexVendeur(Request $request)
{
    $query = Produit::with('categorie');

    // Filtrer par nom
    if ($request->filled('search')) {
        $query->where('nom_produit', 'like', '%' . $request->search . '%');
    }

    // Filtrer par catégorie
    if ($request->filled('categorie_id')) {
        $query->where('categorie_id', $request->categorie_id);
    }

    $produits = $query->get();
    $categories = \App\Models\Categorie::all();

    return view('vendeur.produits.index', compact('produits', 'categories'));
}

    

    /**
     * Formulaire de création
     */
    public function create()
    {
        // Récupérer toutes les catégories pour le select
        $categories = Categorie::all();

        return view('admin.produits.create', compact('categories'));
    }

    /**
     * Enregistrer un produit
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_produit'   => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'quantite_stock' => 'nullable|integer',
            'categorie_id'  => 'required|exists:categories,id',
            'description'   => 'nullable|string',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')
                         ->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Formulaire d’édition
     */
    public function edit(Produit $produit)
    {
        $categories = Categorie::all();

        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom_produit'   => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'quantite_stock' => 'nullable|integer',
            'categorie_id'  => 'required|exists:categories,id',
            'description'   => 'nullable|string',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')
                         ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index')
                         ->with('success', 'Produit supprimé avec succès.');
    }
}
