<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Afficher la liste des fournisseurs
     */
    public function index()
    {
        $fournisseurs = Fournisseur::with('produits')->get();
        return view('admin.fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Formulaire d’ajout
     */
    public function create()
    {
        $produits = Produit::all();
        return view('admin.fournisseurs.create', compact('produits'));
    }

    /**
     * Enregistrer un fournisseur
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_fournisseur' => 'required|string|max:255',
            'adresse'         => 'nullable|string|max:255',
            'telephone'       => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
        ]);

        $fournisseur = Fournisseur::create($request->only(['nom_fournisseur', 'adresse', 'telephone', 'email']));

        // Associer les produits sélectionnés
        $fournisseur->produits()->sync($request->input('produits', []));

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès.');
    }

    /**
     * Formulaire de modification
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::with('produits')->findOrFail($id);
        $produits = Produit::all();
        return view('admin.fournisseurs.edit', compact('fournisseur', 'produits'));
    }

    /**
     * Mise à jour du fournisseur
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_fournisseur' => 'required|string|max:255',
            'adresse'         => 'nullable|string|max:255',
            'telephone'       => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
        ]);

        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->update($request->only(['nom_fournisseur', 'adresse', 'telephone', 'email']));

        // Mettre à jour les produits associés
        $fournisseur->produits()->sync($request->input('produits', []));

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès.');
    }

    /**
     * Supprimer un fournisseur
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        // Détacher les relations avant suppression
        $fournisseur->produits()->detach();

        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }
}
