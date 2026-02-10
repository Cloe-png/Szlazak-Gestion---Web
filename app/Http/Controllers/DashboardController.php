<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Equipement;
use App\Models\Evenement;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Constructeur pour appliquer le middleware d'authentification
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $missingTimesheetToday = false;

        if ($user && !$user->isAdmin()) {
            $chantiersEnCours = $user->chantiersAttribues()->where('statut', 'En cours')->count();
            $chantiersTermines = $user->chantiersAttribues()->where('statut', 'Terminé')->count();
            $chantiersAVenir = $user->chantiersAttribues()->where('statut', 'À venir')->count();

            $equipementsDisponibles = Equipement::sum('quantite');
            $equipementsMaintenance = Equipement::where('etat', 'En maintenance')->count();
            $equipementsUtilisation = Equipement::where('etat', 'En utilisation')->count();

            $prochainsEvenements = Evenement::where('user_id', $user->id)
                ->where('date_debut', '>=', now())
                ->where('date_debut', '<=', now()->addDays(7))
                ->count();

            $derniersEvenements = Evenement::where('user_id', $user->id)
                ->where('date_debut', '>=', now())
                ->orderBy('date_debut', 'asc')
                ->take(5)
                ->get();

            $derniersChantiers = $user->chantiersAttribues()
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $missingTimesheetToday = !Timesheet::where('user_id', $user->id)
                ->whereDate('date_travail', now()->toDateString())
                ->exists();
        } else {
            $chantiersEnCours = Chantier::where('statut', 'En cours')->count();
            $chantiersTermines = Chantier::where('statut', 'Terminé')->count();
            $chantiersAVenir = Chantier::where('statut', 'À venir')->count();

            $equipementsDisponibles = Equipement::sum('quantite');
            $equipementsMaintenance = Equipement::where('etat', 'En maintenance')->count();
            $equipementsUtilisation = Equipement::where('etat', 'En utilisation')->count();

            $prochainsEvenements = Evenement::where('date_debut', '>=', now())
                ->where('date_debut', '<=', now()->addDays(7))
                ->count();

            $derniersEvenements = Evenement::where('date_debut', '>=', now())
                ->orderBy('date_debut', 'asc')
                ->take(5)
                ->get();

            $derniersChantiers = Chantier::orderBy('created_at', 'desc')->take(5)->get();
        }

        return view('dashboard', compact(
            'chantiersEnCours',
            'chantiersTermines',
            'chantiersAVenir',
            'equipementsDisponibles',
            'equipementsUtilisation',
            'prochainsEvenements',
            'derniersEvenements',
            'derniersChantiers',
            'missingTimesheetToday',
            'user'
        ));
    }
}

