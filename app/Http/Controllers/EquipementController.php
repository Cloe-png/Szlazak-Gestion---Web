<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\EmpruntEquipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::all();
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            return view('equipements.index-lite', compact('equipements'));
        }
        return view('equipements.index', compact('equipements'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        return view('equipements.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'date_achat' => 'nullable|date',
            'etat' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
        ]);

        Equipement::create($request->all());

        return redirect()->route('equipements.index')->with('success', 'Ã‰quipement ajoutÃ© avec succÃ¨s.');
    }

    public function show(Equipement $equipement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            return view('equipements.show-lite', compact('equipement'));
        }
        return view('equipements.show', compact('equipement'));
    }

    public function edit(Equipement $equipement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        return view('equipements.edit', compact('equipement'));
    }

    public function update(Request $request, Equipement $equipement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer',
            'date_achat' => 'nullable|date',
            'etat' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
        ]);

        $equipement->update($request->all());

        return redirect()->route('equipements.index')->with('success', 'Ã‰quipement mis Ã  jour avec succÃ¨s.');
    }

    public function destroy(Equipement $equipement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $equipement->delete();
        return redirect()->route('equipements.index')->with('success', 'Ã‰quipement supprimÃ© avec succÃ¨s.');
    }

    public function loans()
    {
        $user = auth()->user();

        $query = EmpruntEquipement::with([
                'equipement:id,nom,etat,localisation',
                'user:id,nom,email',
                'chantier:id,nom'
            ])
            ->orderBy('date_emprunt', 'desc');

        if ($user && !$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $loans = $query->get();

        return view('equipements.loans', compact('loans'));
    }

    public function createLoan(Request $request)
    {
        $user = auth()->user();
        $equipements = Equipement::orderBy('nom')->get();
        $chantiers = $user && !$user->isAdmin()
            ? $user->chantiersAttribues()->orderBy('nom')->get()
            : \App\Models\Chantier::orderBy('nom')->get();
        $selectedEquipement = $request->get('equipement_id');

        return view('equipements.borrow', compact('equipements', 'chantiers', 'selectedEquipement'));
    }

    public function storeLoan(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'equipement_id' => 'required|exists:equipements,id',
            'chantier_id' => 'nullable|exists:chantiers,id',
            'quantite' => 'required|integer|min:1',
        ]);

        if ($user && !$user->isAdmin() && $request->filled('chantier_id')) {
            $isAssigned = $user->chantiersAttribues()
                ->where('chantiers.id', $request->chantier_id)
                ->exists();
            if (!$isAssigned) {
                abort(403);
            }
        }

        $equipement = Equipement::findOrFail($request->equipement_id);
        if ($request->quantite > $equipement->quantite) {
            return back()->withErrors(['quantite' => 'Quantité demandée supérieure au stock disponible.'])->withInput();
        }

        EmpruntEquipement::create([
            'equipement_id' => $equipement->id,
            'user_id' => $user->id,
            'chantier_id' => $request->chantier_id,
            'quantite' => $request->quantite,
            'date_emprunt' => now(),
            'statut' => 'En cours',
        ]);

        return redirect()->route('equipements.loans')
            ->with('success', 'Emprunt enregistré avec succès.');
    }
}
