<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Equipement;
use App\Models\Evenement;
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
        // Récupération des données depuis la base de données
        $chantiersEnCours = Chantier::where('statut', 'En cours')->count();
        $chantiersTermines = Chantier::where('statut', 'Terminé')->count();
        $chantiersAVenir = Chantier::where('statut', 'À venir')->count();

        $equipementsDisponibles = Equipement::sum('quantite');
        $equipementsMaintenance = Equipement::where('etat', 'En maintenance')->count();
        $equipementsUtilisation = Equipement::where('etat', 'En utilisation')->count();

        $prochainsEvenements = Evenement::where('date_debut', '>=', now())
            ->where('date_debut', '<=', now()->addDays(7))
            ->count();

        // Récupération des 5 derniers événements
        $derniersEvenements = Evenement::orderBy('date_debut', 'desc')->take(5)->get();

        // Récupération des 5 derniers chantiers
        $derniersChantiers = Chantier::orderBy('created_at', 'desc')->take(5)->get();

        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        return view('dashboard', compact(
            'chantiersEnCours',
            'chantiersTermines',
            'chantiersAVenir',
            'equipementsDisponibles',
            'equipementsUtilisation',
            'prochainsEvenements',
            'derniersEvenements',
            'derniersChantiers',
            'user'
        ));
    }
}