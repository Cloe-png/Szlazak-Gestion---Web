<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'date_debut',
        'date_fin',
        'responsable_id',
        'statut',
        'tarif',
        'commentaire',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'tarif' => 'decimal:2',
    ];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }

    // Nouvelle relation avec les fiches d'heures
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    // Utilisateurs attribuÃ©s Ã  ce chantier (web)
    public function utilisateurs()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['assigned_by', 'assigned_at'])
            ->withTimestamps();
    }

    // Accesseur pour le tarif formaté
    public function getTarifFormateAttribute()
    {
        if ($this->tarif) {
            return number_format($this->tarif, 2, ',', ' ') . ' €';
        }
        return 'Non défini';
    }

    // Accesseur pour le statut avec badge
    public function getStatutBadgeAttribute()
    {
        $badges = [
            'À venir' => 'warning',
            'En cours' => 'success',
            'Terminé' => 'secondary',
            'En pause' => 'info',
            'Annulé' => 'danger'
        ];

        $color = $badges[$this->statut] ?? 'light';
        
        return '<span class="badge bg-' . $color . '">' . $this->statut . '</span>';
    }

    // Scope pour les chantiers actifs
    public function scopeActifs($query)
    {
        return $query->where('statut', 'En cours');
    }

    // Scope pour les chantiers terminÃ©s
    public function scopeTermines($query)
    {
        return $query->where('statut', 'Terminé');
    }

    // Scope pour les chantiers à venir
    public function scopeAVenir($query)
    {
        return $query->where('statut', 'À venir');
    }
}

