<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::all();
        return view('equipements.index', compact('equipements'));
    }

    public function create()
    {
        return view('equipements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'date_achat' => 'nullable|date',
            'etat' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
        ]);

        Equipement::create($request->all());

        return redirect()->route('equipements.index')->with('success', 'Équipement ajouté avec succès.');
    }

    public function show(Equipement $equipement)
    {
        return view('equipements.show', compact('equipement'));
    }

    public function edit(Equipement $equipement)
    {
        return view('equipements.edit', compact('equipement'));
    }

    public function update(Request $request, Equipement $equipement)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'date_achat' => 'nullable|date',
            'etat' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
        ]);

        $equipement->update($request->all());

        return redirect()->route('equipements.index')->with('success', 'Équipement mis à jour avec succès.');
    }

    public function destroy(Equipement $equipement)
    {
        $equipement->delete();
        return redirect()->route('equipements.index')->with('success', 'Équipement supprimé avec succès.');
    }
}
