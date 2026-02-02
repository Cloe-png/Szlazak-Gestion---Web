<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(12);
        $roles = Role::all();
        
        // Calcul des statistiques globales
        $totalUsers = $users->total();
        $admins = User::where('role_id', 1)->count();
        $chefs = User::where('role_id', 2)->count();
        $ouvriers = User::where('role_id', 3)->count();
        $apprentis = User::where('role_id', 4)->count();
        $interimaires = User::where('role_id', 5)->count();
        
        return view('users.index', compact('users', 'roles', 'totalUsers', 'admins', 'chefs', 'ouvriers', 'apprentis', 'interimaires'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'date_embauche' => 'nullable|date',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:500',
        ]);

        User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'date_embauche' => $request->date_embauche,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function show(User $user)
    {
        // Charger les relations
        $user->load(['role', 'timesheets' => function($query) {
            $query->orderBy('date_travail', 'desc')->take(10);
        }, 'chantiers' => function($query) {
            $query->where('statut', '!=', 'Terminé');
        }]);
        
        // Calculer les statistiques
        $stats = [
            'chantiers_count' => $user->chantiers()->count(),
            'total_heures' => $user->timesheets()->sum(
                DB::raw('TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0)')
            ),
            'jours_travailles' => $user->timesheets()->distinct('date_travail')->count('date_travail'),
            'heures_supp_total' => $user->timesheets()->sum('heures_supp'),
        ];
        
        // Dernières fiches d'heures
        $timesheets = $user->timesheets()->with('chantier')
            ->orderBy('date_travail', 'desc')
            ->take(5)
            ->get();
        
        // Statistiques par mois
        $statsParMois = $user->timesheets()
            ->selectRaw('mois, 
                COUNT(*) as jours, 
                SUM(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0)) as heures, 
                SUM(heures_supp) as heures_supp')
            ->groupBy('mois')
            ->orderByRaw("STR_TO_DATE(CONCAT('01 ', mois), '%d %M %Y') DESC")
            ->get();
        
        return view('users.show', compact('user', 'timesheets', 'statsParMois', 'stats'));
    }

    public function edit(User $user)
{
    $roles = Role::all(); // Récupère tous les rôles
    return view('users.edit', compact('user', 'roles'));
}

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'date_embauche' => 'nullable|date',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:500',
        ]);

        $updateData = [
            'nom' => $request->nom,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'date_embauche' => $request->date_embauche,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ];

        if ($request->password) {
            $updateData['mot_de_passe'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        // Vérifier s'il y a des dépendances
        if ($user->timesheets()->count() > 0) {
            return redirect()->route('users.index')->with('error', 'Impossible de supprimer cet utilisateur car il a des fiches d\'heures associées.');
        }
        
        if ($user->chantiers()->count() > 0) {
            return redirect()->route('users.index')->with('error', 'Impossible de supprimer cet utilisateur car il est responsable de chantiers.');
        }
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}