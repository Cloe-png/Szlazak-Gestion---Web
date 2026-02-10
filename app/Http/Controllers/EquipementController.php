<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\EmpruntEquipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return redirect()->route('equipements.index')->with('success', 'Équipement ajouté avec succès.');
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

        return redirect()->route('equipements.index')->with('success', 'Équipement mis à jour avec succès.');
    }

    public function destroy(Equipement $equipement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $equipement->delete();
        return redirect()->route('equipements.index')->with('success', 'Équipement supprimé avec succès.');
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
            'chantier_id' => 'required|exists:chantiers,id',
            'quantite' => 'required|integer|min:1',
        ]);

        if ($user && !$user->isAdmin()) {
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

        DB::transaction(function () use ($equipement, $request, $user) {
            EmpruntEquipement::create([
                'equipement_id' => $equipement->id,
                'user_id' => $user->id,
                'chantier_id' => $request->chantier_id,
                'quantite' => $request->quantite,
                'date_emprunt' => now(),
                'statut' => 'En cours',
            ]);

            $equipement->decrement('quantite', (int) $request->quantite);
        });

        return redirect()->route('equipements.loans')
            ->with('success', 'Emprunt enregistré avec succès.');
    }

    public function returnLoan(Request $request, EmpruntEquipement $loan)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin() && $loan->user_id !== $user->id) {
            abort(403);
        }

        if ($loan->date_retour) {
            return redirect()->route('equipements.loans')
                ->with('error', 'Cet emprunt a déjà été retourné.');
        }

        $validated = $request->validate([
            'etat_apres_retour' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($loan, $validated) {
            $loan->update([
                'date_retour' => now(),
                'statut' => 'Retourné',
                'etat_apres_retour' => $validated['etat_apres_retour'],
            ]);

            if ($loan->equipement) {
                $loan->equipement->increment('quantite', (int) $loan->quantite);
            }
        });

        return redirect()->route('equipements.loans')
            ->with('success', 'Matériel retourné et stock mis à jour.');
    }
}
