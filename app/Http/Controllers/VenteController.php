<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VenteController extends Controller
{
    // Liste des ventes
   public function index(Request $request)
{
    $query = Vente::with(['produits', 'client'])->latest();

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    if ($request->filled('client')) {
        $query->whereHas('client', function($q) use ($request) {
            $q->where('nom_client', 'like', '%' . $request->client . '%');
        });
    }

    $ventes = $query->get();

    return view('vendeur.ventes.index', compact('ventes'));
}



    // Formulaire de création
    public function create()
    {
        $produits = Produit::all();
        $clients = Client::all();
        return view('vendeur.ventes.create', compact('produits', 'clients'));
    }

    // Enregistrer une vente
public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'produits'  => 'required|array',
        'produits.*.id' => 'required|exists:produits,id',
        'produits.*.quantite' => 'required|integer|min:1',
    ]);

    // Créer la vente
    $vente = Vente::create([
        'client_id' => $request->client_id,
        'montant_total' => 0,
    ]);

    $montantTotal = 0;

    foreach ($request->produits as $p) {
        $produit = Produit::findOrFail($p['id']);

        if ($produit->quantite_stock < $p['quantite']) {
            return back()->withErrors(['produits' => "Stock insuffisant pour le produit {$produit->nom_produit}."]);
        }

        $sousTotal = $produit->prix_unitaire * $p['quantite'];

        // Ajouter dans la table pivot
        $vente->produits()->attach($produit->id, [
            'quantite' => $p['quantite'],
            'prix_unitaire' => $produit->prix_unitaire,
            'sous_total' => $sousTotal,
        ]);

        // Décrémenter le stock
        $produit->decrement('quantite_stock', $p['quantite']);

        $montantTotal += $sousTotal;
    }

    // Mettre à jour le total
    $vente->update(['montant_total' => $montantTotal]);

    return redirect()->route('vendeur.ventes.index')->with('success', 'Vente enregistrée avec plusieurs produits.');
}


    // Détails d’une vente
    public function show(Vente $vente)
{
    // Charge les relations client et produits
    $vente->load('client', 'produits');
    return view('vendeur.ventes.show', compact('vente'));
}

    // Formulaire d’édition
    public function edit(Vente $vente)
    {
        $produits = Produit::all();
        $clients = Client::all();
        return view('vendeur.ventes.edit', compact('vente', 'produits', 'clients'));
    }

    // Mettre à jour
   public function update(Request $request, Vente $vente)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'produits' => 'required|array',
        'produits.*.id' => 'required|exists:produits,id',
        'produits.*.quantite' => 'required|integer|min:1',
    ]);

    // Réinjecter le stock des anciens produits
    foreach ($vente->produits as $prod) {
        $prod->increment('quantite_stock', $prod->pivot->quantite);
    }

    $vente->produits()->detach();

    $montantTotal = 0;
    $dataAttach = [];

    foreach ($request->produits as $p) {
        $produit = Produit::findOrFail($p['id']);
        $quantite = $p['quantite'];

        if ($produit->quantite_stock < $quantite) {
            return back()->withErrors(['stock' => "Stock insuffisant pour {$produit->nom_produit}"]);
        }

        $sousTotal = $produit->prix_unitaire * $quantite;
        $montantTotal += $sousTotal;

        $dataAttach[$produit->id] = [
            'quantite' => $quantite,
            'prix_unitaire' => $produit->prix_unitaire,
            'sous_total' => $sousTotal,
        ];

        $produit->decrement('quantite_stock', $quantite);
    }

    $vente->update([
        'client_id' => $request->client_id,
        'montant_total' => $montantTotal,
    ]);

    $vente->produits()->attach($dataAttach);

    return redirect()->route('vendeur.ventes.show', $vente->id)
                     ->with('success', 'Vente mise à jour avec succès.');
}

   // Supprimer
public function destroy(Vente $vente)
{
    // Charger les produits liés à la vente
    $vente->load('produits');

    foreach ($vente->produits as $produit) {
        // Réajouter la quantité vendue au stock
        $produit->increment('quantite_stock', $produit->pivot->quantite);
    }

    // Supprimer la vente et ses relations pivot
    $vente->delete();

    return redirect()->route('vendeur.ventes.index')
                     ->with('success', 'Vente supprimée et stock réajouté avec succès.');
}

public function exportPdf($id)
{
    $vente = Vente::with(['produits', 'client'])->findOrFail($id);
    $pdf = Pdf::loadView('vendeur.ventes.pdf', compact('vente'));
    return $pdf->download('vente_'.$vente->id.'.pdf');
}

public function ventesParDate(Request $request)
{
    $produits = collect(); // Vide par défaut

    if ($request->filled('date')) {
        $date = $request->date;

        // Récupérer les produits vendus ce jour
       $produits = \DB::table('vente_produit')
    ->join('produits', 'vente_produit.produit_id', '=', 'produits.id')
    ->join('ventes', 'vente_produit.vente_id', '=', 'ventes.id')
    ->select(
        'produits.nom_produit',
        \DB::raw('MAX(vente_produit.prix_unitaire) as prix_unitaire'),
        \DB::raw('SUM(vente_produit.quantite) as total_quantite'),
        \DB::raw('SUM(vente_produit.sous_total) as total_montant')
    )
    ->whereDate('ventes.created_at', $date)
    ->groupBy('produits.nom_produit')
    ->get();
    }

    return view('vendeur.ventes.par_date', compact('produits'));
}

public function ventesParDatePdf(Request $request)
{
    if (!$request->filled('date')) {
        return back()->with('error', 'Veuillez sélectionner une date.');
    }

    $date = $request->date;

    $produits = \DB::table('vente_produit')
        ->join('produits', 'vente_produit.produit_id', '=', 'produits.id')
        ->join('ventes', 'vente_produit.vente_id', '=', 'ventes.id')
        ->select(
            'produits.nom_produit',
            \DB::raw('MAX(vente_produit.prix_unitaire) as prix_unitaire'),
            \DB::raw('SUM(vente_produit.quantite) as total_quantite'),
            \DB::raw('SUM(vente_produit.sous_total) as total_montant')
        )
        ->whereDate('ventes.created_at', $date)
        ->groupBy('produits.nom_produit')
        ->get();

    $montantGlobal = $produits->sum('total_montant');

    // Générer le PDF
    $pdf = Pdf::loadView('vendeur.ventes.par_date_pdf', compact('produits', 'date', 'montantGlobal'));

    return $pdf->download('produits_vendus_'.$date.'.pdf');
}



}

