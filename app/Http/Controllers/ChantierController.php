<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\User;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChantierController extends Controller
{
    public function index()
    {
        // Utiliser les scopes du modèle
        $chantiersActifs = Chantier::actifs()->with('responsable')->get();
        $chantiersTermines = Chantier::termines()->with('responsable')->get();
        $chantiersAVenir = Chantier::aVenir()->with('responsable')->get();
        
        // Chantiers en retard
        $chantiersEnRetard = Chantier::actifs()
            ->where('date_fin', '<', now())
            ->with('responsable')
            ->get();
        
        // Statistiques générales
        $stats = [
            'total' => Chantier::count(),
            'actifs' => Chantier::actifs()->count(),
            'termines' => Chantier::termines()->count(),
            'a_venir' => Chantier::aVenir()->count(),
            'en_retard' => $chantiersEnRetard->count(),
        ];
        
        return view('chantiers.index', compact(
            'chantiersActifs',
            'chantiersTermines',
            'chantiersAVenir',
            'chantiersEnRetard',
            'stats'
        ));
    }

    public function create()
    {
        $users = User::whereIn('role_id', [1, 2]) // Admins et chefs de chantier
                    ->get();
        return view('chantiers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'responsable_id' => 'required|exists:users,id',
            'statut' => 'required|in:À venir,En cours,Terminé,En pause,Annulé',
            'tarif' => 'nullable|numeric|min:0', // Nouveau champ
        ]);

        $data = $request->all();
        // Formatage du tarif si présent
        if (isset($data['tarif'])) {
            $data['tarif'] = str_replace(',', '.', $data['tarif']);
        }

        Chantier::create($data);

        return redirect()->route('chantiers.index')->with('success', 'Chantier créé avec succès.');
    }

    public function show(Chantier $chantier)
    {
        // Charger toutes les relations nécessaires
        $chantier->load([
            'responsable',
            'timesheets' => function($query) {
                $query->orderBy('date_travail', 'desc');
            },
            'timesheets.user',        ]);
        
        // Calculer les statistiques détaillées
        $stats = [
            'total_heures' => $chantier->total_heures,
            'cout_total' => $chantier->cout_total,
            'jours_restants' => $chantier->jours_restants,
            'duree_jours' => $chantier->duree_jours,
            'progression' => $chantier->progression,
            'est_en_retard' => $chantier->est_en_retard,
        ];
        
        // Heures par mois
        $heuresParMois = $chantier->timesheets()
            ->selectRaw('mois, 
                COUNT(DISTINCT date_travail) as jours_travailles,
                SUM(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0)) as heures_normales,
                SUM(heures_supp) as heures_supplementaires,
                SUM(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0) + heures_supp) as total_heures')
            ->groupBy('mois')
            ->orderByRaw("STR_TO_DATE(CONCAT('01 ', mois), '%d %M %Y') DESC")
            ->get();
        
        // Heures par travailleur
        $heuresParTravailleur = $chantier->timesheets()
            ->selectRaw('user_id, 
                COUNT(DISTINCT date_travail) as jours,
                SUM(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0)) as heures,
                SUM(heures_supp) as heures_supp')
            ->groupBy('user_id')
            ->with('user')
            ->get();
        
        // Dernières fiches d'heures (10 dernières)
        $dernieresFiches = $chantier->timesheets()
            ->with('user')
            ->orderBy('date_travail', 'desc')
            ->take(10)
            ->get();
        
        // Événements associés
        $evenements = $chantier->evenements()
            ->orderBy('date_debut', 'desc')
            ->get();
        
        return view('chantiers.show', compact(
            'chantier',
            'stats',
            'heuresParMois',
            'heuresParTravailleur',
            'dernieresFiches',
            'evenements'
        ));
    }

    public function edit(Chantier $chantier)
    {
        $users = User::whereIn('role_id', [1, 2])->get();
        return view('chantiers.edit', compact('chantier', 'users'));
    }

    public function update(Request $request, Chantier $chantier)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'responsable_id' => 'required|exists:users,id',
            'statut' => 'required|in:À venir,En cours,Terminé,En pause,Annulé',
            'tarif' => 'nullable|numeric|min:0', // Nouveau champ
        ]);

        $data = $request->all();
        // Formatage du tarif si présent
        if (isset($data['tarif'])) {
            $data['tarif'] = str_replace(',', '.', $data['tarif']);
        }

        $chantier->update($data);

        return redirect()->route('chantiers.index')->with('success', 'Chantier mis à jour avec succès.');
    }

    public function destroy(Chantier $chantier)
    {
        // Vérifier s'il y a des fiches d'heures associées
        if ($chantier->timesheets()->count() > 0) {
            return redirect()->route('chantiers.index')
                ->with('error', 'Impossible de supprimer ce chantier car il a des fiches d\'heures associées.');
        }
        
        // Vérifier s'il y a des événements associés
        if ($chantier->evenements()->count() > 0) {
            return redirect()->route('chantiers.index')
                ->with('error', 'Impossible de supprimer ce chantier car il a des événements associés.');
        }
        
        $chantier->delete();
        return redirect()->route('chantiers.index')->with('success', 'Chantier supprimé avec succès.');
    }

    // NOUVELLES MÉTHODES POUR LES FICHES D'HEURES
    
    public function showFichesHeures(Chantier $chantier)
    {
        $fiches = $chantier->timesheets()
            ->with('user')
            ->orderBy('date_travail', 'desc')
            ->paginate(20);
        
        $users = User::where('role_id', '!=', 1) // Tous sauf admin
                    ->orderBy('nom')
                    ->get();
        
        return view('chantiers.fiches-heures', compact('chantier', 'fiches', 'users'));
    }

    public function addFicheHeure(Request $request, Chantier $chantier)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date_travail' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'pause' => 'boolean',
            'heures_supp' => 'nullable|numeric|min:0',
        ]);

        // Calculer le mois et le jour
        $date = \Carbon\Carbon::parse($request->date_travail);
        $mois = $date->translatedFormat('F Y');
        $jour = $date->translatedFormat('l');

        Timesheet::create([
            'user_id' => $request->user_id,
            'chantier_id' => $chantier->id,
            'date_travail' => $request->date_travail,
            'mois' => $mois,
            'jour' => $jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'pause' => $request->pause ?? false,
            'heures_supp' => $request->heures_supp ?? 0,
        ]);

        return redirect()->route('chantiers.fiches-heures', $chantier)
            ->with('success', 'Fiche d\'heures ajoutée avec succès.');
    }

    // MÉTHODES POUR LES STATISTIQUES
    
    public function statistiques(Chantier $chantier)
    {
        // Statistiques détaillées
        $statsDetaillees = $chantier->timesheets()
            ->selectRaw('
                COUNT(DISTINCT date_travail) as nb_jours_travailles,
                SUM(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0)) as heures_normales,
                SUM(heures_supp) as heures_supplementaires,
                AVG(heures_supp) as moyenne_heures_supp,
                COUNT(CASE WHEN pause = 1 THEN 1 END) as nb_pauses
            ')
            ->first();
        
        // Distribution des heures par jour de la semaine
        $heuresParJour = $chantier->timesheets()
            ->selectRaw('jour, 
                COUNT(*) as nb_jours,
                AVG(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin)) as moyenne_heures')
            ->groupBy('jour')
            ->orderByRaw("FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')")
            ->get();
        
        // Coût par travailleur
        $coutParTravailleur = [];
        if ($chantier->tarif) {
            $coutParTravailleur = $chantier->timesheets()
                ->selectRaw('user_id, 
                    SUM(TIMESTAMPDIFF(HOUR, heure_debut, heure_fin) - IF(pause = 1, 1, 0) + heures_supp) * ? as cout_total',
                    [$chantier->tarif])
                ->groupBy('user_id')
                ->with('user')
                ->get();
        }
        
        return view('chantiers.statistiques', compact(
            'chantier',
            'statsDetaillees',
            'heuresParJour',
            'coutParTravailleur'
        ));
    }

    // MÉTHODE POUR EXPORTER LES DONNÉES
    
    public function exportFichesHeures(Chantier $chantier)
    {
        $fiches = $chantier->timesheets()
            ->with('user')
            ->orderBy('date_travail')
            ->get();
        
        $data = [];
        $totalHeures = 0;
        $totalHeuresSupp = 0;
        
        foreach ($fiches as $fiche) {
            $heuresTravaillees = $fiche->heures_travaillees;
            $totalHeures += $heuresTravaillees;
            $totalHeuresSupp += $fiche->heures_supp;
            
            $data[] = [
                'Date' => $fiche->date_formatee,
                'Jour' => $fiche->jour,
                'Travailleur' => $fiche->user->nom,
                'Heure début' => \Carbon\Carbon::parse($fiche->heure_debut)->format('H:i'),
                'Heure fin' => \Carbon\Carbon::parse($fiche->heure_fin)->format('H:i'),
                'Pause' => $fiche->pause ? 'Oui' : 'Non',
                'Heures travaillées' => $heuresTravaillees,
                'Heures supplémentaires' => $fiche->heures_supp,
                'Total heures' => $fiche->total_heures,
            ];
        }
        
        // Ajouter les totaux
        $data[] = [
            'Date' => 'TOTAUX',
            'Jour' => '',
            'Travailleur' => '',
            'Heure début' => '',
            'Heure fin' => '',
            'Pause' => '',
            'Heures travaillées' => $totalHeures,
            'Heures supplémentaires' => $totalHeuresSupp,
            'Total heures' => $totalHeures + $totalHeuresSupp,
        ];
        
        // Ici, vous pourriez exporter en CSV, Excel, etc.
        // Pour cet exemple, on retourne une vue d'export
        return view('chantiers.export-fiches', compact('chantier', 'data'));
    }

    // MÉTHODE POUR MODIFIER LE TARIF
    
    public function updateTarif(Request $request, Chantier $chantier)
    {
        $request->validate([
            'tarif' => 'required|numeric|min:0',
        ]);
        
        $chantier->update([
            'tarif' => str_replace(',', '.', $request->tarif)
        ]);
        
        return redirect()->route('chantiers.show', $chantier)
            ->with('success', 'Tarif mis à jour avec succès.');
    }
}