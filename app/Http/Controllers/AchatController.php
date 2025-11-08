<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    public function index()
    {
        $achats = Achat::with(['produit', 'fournisseur'])->latest()->get();
        return view('admin.achats.index', compact('achats'));
    }

    public function create()
    {
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('admin.achats.create', compact('produits', 'fournisseurs'));
    }

    public function store(Request $request)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'quantite_achat' => 'required|integer|min:1',
    ]);

    // Création de l'achat
    $achat = Achat::create($request->all());

    // Mise à jour du stock du produit
    $produit = Produit::find($request->produit_id);
    $produit->quantite_stock = ($produit->quantite_stock ?? 0) + $request->quantite_achat;
    $produit->save();

    return redirect()->route('achats.index')->with('success', 'Achat ajouté avec succès et stock mis à jour.');
}


    public function edit(Achat $achat)
    {
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('admin.achats.edit', compact('achat', 'produits', 'fournisseurs'));
    }

    public function update(Request $request, Achat $achat)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'quantite_achat' => 'required|integer|min:1',
    ]);

    // Restaurer l'ancienne quantité dans le stock
    $ancienProduit = Produit::find($achat->produit_id);
    if ($ancienProduit) {
        $ancienProduit->quantite_stock -= $achat->quantite_achat;
        $ancienProduit->save();
    }

    // Mise à jour de l'achat
    $achat->update($request->all());

    // Ajouter la nouvelle quantité dans le stock
    $nouveauProduit = Produit::find($request->produit_id);
    $nouveauProduit->quantite_stock = ($nouveauProduit->quantite_stock ?? 0) + $request->quantite_achat;
    $nouveauProduit->save();

    return redirect()->route('admin.achats.index')->with('success', 'Achat modifié avec succès et stock mis à jour.');
}


   public function destroy(Achat $achat)
{
    // Récupérer le produit concerné
    $produit = Produit::find($achat->produit_id);

    if ($produit) {
        // Soustraire la quantité de l'achat du stock
        $produit->quantite_stock -= $achat->quantite_achat;

        // Éviter d’avoir une valeur négative
        if ($produit->quantite_stock < 0) {
            $produit->quantite_stock = 0;
        }

        $produit->save();
    }

    // Supprimer l'achat
    $achat->delete();

    return redirect()->route('achats.index')
        ->with('success', 'Achat supprimé avec succès et stock mis à jour.');
}

}
