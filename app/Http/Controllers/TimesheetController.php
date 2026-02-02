<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\User;
use App\Models\Chantier;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        $timesheets = Timesheet::with(['user', 'chantier'])
            ->orderBy('date_travail', 'desc')
            ->paginate(20);
        
        return view('timesheets.index', compact('timesheets'));
    }

    public function create(Request $request)
    {
        $users = User::all();
        $chantiers = Chantier::where('statut', '!=', 'Terminé')->get();
        
        $selectedUser = $request->get('user_id');
        
        return view('timesheets.create', compact('users', 'chantiers', 'selectedUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'required|exists:chantiers,id',
            'date_travail' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'pause' => 'boolean',
            'heures_supp' => 'nullable|numeric|min:0',
            'zone' => 'nullable|integer|min:1|max:4',
        ]);

        // Calculer le mois et le jour
        $date = \Carbon\Carbon::parse($request->date_travail);
        $mois = $date->translatedFormat('F Y');
        $jour = $date->translatedFormat('l');

        Timesheet::create([
            'user_id' => $request->user_id,
            'chantier_id' => $request->chantier_id,
            'date_travail' => $request->date_travail,
            'mois' => $mois,
            'jour' => $jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'pause' => $request->pause ?? false,
            'heures_supp' => $request->heures_supp ?? 0,
            'zone' => $request->zone,
        ]);

        return redirect()->route('users.show', $request->user_id)
            ->with('success', 'Fiche d\'heures créée avec succès.');
    }

    public function show(Timesheet $timesheet)
    {
        $timesheet->load(['user', 'chantier']);
        return view('timesheets.show', compact('timesheet'));
    }

    public function edit(Timesheet $timesheet)
    {
        $users = User::all();
        $chantiers = Chantier::all();
        
        return view('timesheets.edit', compact('timesheet', 'users', 'chantiers'));
    }

    public function update(Request $request, Timesheet $timesheet)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'required|exists:chantiers,id',
            'date_travail' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'pause' => 'boolean',
            'heures_supp' => 'nullable|numeric|min:0',
            'zone' => 'nullable|integer|min:1|max:4',
        ]);

        // Recalculer mois et jour si date changée
        $date = \Carbon\Carbon::parse($request->date_travail);
        $mois = $date->translatedFormat('F Y');
        $jour = $date->translatedFormat('l');

        $timesheet->update([
            'user_id' => $request->user_id,
            'chantier_id' => $request->chantier_id,
            'date_travail' => $request->date_travail,
            'mois' => $mois,
            'jour' => $jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'pause' => $request->pause ?? false,
            'heures_supp' => $request->heures_supp ?? 0,
            'zone' => $request->zone,
        ]);

        return redirect()->route('users.show', $request->user_id)
            ->with('success', 'Fiche d\'heures mise à jour avec succès.');
    }

    public function destroy(Timesheet $timesheet)
    {
        $userId = $timesheet->user_id;
        $timesheet->delete();
        
        return redirect()->route('users.show', $userId)
            ->with('success', 'Fiche d\'heures supprimée avec succès.');
    }
}