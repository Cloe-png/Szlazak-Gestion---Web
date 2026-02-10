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
        $user = auth()->user();

        if ($user && !$user->isAdmin()) {
            $evenements = Evenement::with(['user', 'chantier'])
                ->where('user_id', $user->id)
                ->orderBy('date_debut', 'desc')
                ->paginate(20);
            $users = User::whereKey($user->id)->get();
            return view('evenements.index-lite', compact('evenements', 'users'));
        } else {
            $evenements = Evenement::with(['user', 'chantier'])
                ->orderBy('date_debut', 'desc')
                ->paginate(20);
            $users = User::all();
        }

        return view('evenements.index', compact('evenements', 'users'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            $users = User::whereKey($user->id)->get();
            $chantiers = $user->chantiersAttribues()->orderBy('nom')->get();
        } else {
            $users = User::all();
            $chantiers = Chantier::all();
        }

        return view('evenements.create', compact('users', 'chantiers'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'nullable|exists:chantiers,id',
            'statut' => 'required|in:À venir,En cours,Terminé,Annulé',
        ]);

        if ($user && !$user->isAdmin()) {
            $validated['user_id'] = $user->id;
            if (!empty($validated['chantier_id'])) {
                $isAssigned = $user->chantiersAttribues()
                    ->where('chantiers.id', $validated['chantier_id'])
                    ->exists();
                if (!$isAssigned) {
                    abort(403);
                }
            }
        }

        Evenement::create($validated);

        return redirect()->route('evenements.index')->with('success', 'Événement créé avec succès.');
    }

    public function show(Evenement $evenement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin() && $evenement->user_id !== $user->id) {
            abort(403);
        }

        $evenement->load(['user', 'chantier']);
        if ($user && !$user->isAdmin()) {
            return view('evenements.show-lite', compact('evenement'));
        }
        return view('evenements.show', compact('evenement'));
    }

    public function edit(Evenement $evenement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $users = User::all();
        $chantiers = Chantier::all();
        return view('evenements.edit', compact('evenement', 'users', 'chantiers'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'nullable|exists:chantiers,id',
            'statut' => 'required|in:À venir,En cours,Terminé,Annulé',
        ]);

        $evenement->update($validated);

        return redirect()->route('evenements.index')->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Evenement $evenement)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $evenement->delete();
        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès.');
    }
}
