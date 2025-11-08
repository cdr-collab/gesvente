<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Afficher la liste
    public function index()
    {
        $clients = Client::all();
        return view('vendeur.clients.index', compact('clients'));
    }

    // Formulaire de création
    public function create()
    {
        return view('vendeur.clients.create');
    }

    // Enregistrer une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'adresse'   => 'required|string|max:191',
            'telephone'   => 'nullable|string',
            'email'   => 'required|email|max:255',
        ]);
        

        Client::create($request->all());

        return redirect()->route('vendeur.clients.index')
                         ->with('success', 'Client ajouté avec succès.');
    }

    // Formulaire d’édition
    public function edit(Client $client)
    {
        return view('vendeur.clients.edit', compact('client'));
    }

    // Mettre à jour
    public function update(Request $request, Client $client)
    {

         $request->validate([
            'nom_client' => 'required|string|max:255',
            'adresse'   => 'required|string|max:191',
            'telephone'   => 'nullable|string',
            'email'   => 'required|email|max:255',
        ]);

        $client->update($request->all());

        return redirect()->route('vendeur.clients.index')
                         ->with('success', 'Client mis à jour avec succès.');
    }

    // Supprimer
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('vendeur.clients.index')
                         ->with('success', 'Client supprimé avec succès.');
    }
}
