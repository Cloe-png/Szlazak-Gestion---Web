<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chantier_id',
        'mois',
        'jour',
        'date_travail',
        'heure_debut',
        'heure_fin',
        'pause',
        'panier',
        'heures_supp',
        'zone', // Ajouter cette ligne
    ];

    protected $casts = [
        'date_travail' => 'date',
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'pause' => 'boolean',
        'panier' => 'boolean',
        'heures_supp' => 'decimal:2',
        'zone' => 'integer', // Ajouter cette ligne
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le chantier
    public function chantier()
    {
        return $this->belongsTo(Chantier::class);
    }

    // Accessor pour calculer les heures travaillées
    public function getHeuresTravailleesAttribute()
    {
        if (!$this->heure_debut || !$this->heure_fin) {
            return 0;
        }
        
        $debut = \Carbon\Carbon::parse($this->heure_debut);
        $fin = \Carbon\Carbon::parse($this->heure_fin);
        
        $heures = $debut->diffInHours($fin);
        
        // Soustraire la pause si elle existe (typiquement 1 heure)
        if ($this->pause) {
            $heures -= 1;
        }
        
        return $heures;
    }

    // Accessor pour le total heures + supp
    public function getTotalHeuresAttribute()
    {
        $heures = $this->heures_travaillees;
        $supp = $this->heures_supp ?? 0;
        
        return $heures + $supp;
    }

    // Méthode pour formater la date
    public function getDateFormateeAttribute()
    {
        if ($this->date_travail) {
            try {
                return \Carbon\Carbon::parse($this->date_travail)->format('d/m/Y');
            } catch (\Exception $e) {
                return 'Date invalide';
            }
        }
        return 'N/A';
    }

    // Accessor pour formater l'heure de début
    public function getHeureDebutFormateeAttribute()
    {
        if ($this->heure_debut) {
            try {
                return \Carbon\Carbon::parse($this->heure_debut)->format('H:i');
            } catch (\Exception $e) {
                return 'Heure invalide';
            }
        }
        return 'N/A';
    }

    // Accessor pour formater l'heure de fin
    public function getHeureFinFormateeAttribute()
    {
        if ($this->heure_fin) {
            try {
                return \Carbon\Carbon::parse($this->heure_fin)->format('H:i');
            } catch (\Exception $e) {
                return 'Heure invalide';
            }
        }
        return 'N/A';
    }

    // Accessor pour le jour
    public function getJourAttribute($value)
    {
        return $value ?? 'N/A';
    }

    // Accessor pour les heures supplémentaires
    public function getHeuresSuppAttribute($value)
    {
        return $value ?? 0;
    }

    // Accessor pour la zone (nouveau)
    public function getZoneFormateeAttribute()
    {
        if ($this->zone) {
            return "Zone {$this->zone}";
        }
        return 'Non définie';
    }
}
