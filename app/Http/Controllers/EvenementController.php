<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\User;
use App\Models\Chantier;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::with(['user', 'chantier'])
            ->orderBy('date_debut', 'desc')
            ->paginate(20);
        
        $users = User::all();
        return view('evenements.index', compact('evenements', 'users'));
    }

    public function create()
    {
        $users = User::all();
        $chantiers = Chantier::all();
        return view('evenements.create', compact('users', 'chantiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:chantier,reunion,maintenance,livraison,inspection,autre', // AJOUTÉ
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'nullable|exists:chantiers,id',
            'statut' => 'required|in:À venir,En cours,Terminé,Annulé', // MODIFIÉ
        ]);

        Evenement::create($request->all());

        return redirect()->route('evenements.index')->with('success', 'Événement créé avec succès.');
    }

    public function show(Evenement $evenement)
    {
        $evenement->load(['user', 'chantier']);
        return view('evenements.show', compact('evenement'));
    }

    public function edit(Evenement $evenement)
    {
        $users = User::all();
        $chantiers = Chantier::all();
        return view('evenements.edit', compact('evenement', 'users', 'chantiers'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:chantier,reunion,maintenance,livraison,inspection,autre', // AJOUTÉ
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'nullable|exists:chantiers,id',
            'statut' => 'required|in:À venir,En cours,Terminé,Annulé', // MODIFIÉ
        ]);

        $evenement->update($request->all());

        return redirect()->route('evenements.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès.');
    }
}