<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpruntEquipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipement_id',
        'user_id',
        'chantier_id',
        'quantite',
        'date_emprunt',
        'date_retour',
        'etat_apres_retour',
        'statut',
    ];

    protected $casts = [
        'date_emprunt' => 'datetime',
        'date_retour' => 'datetime',
    ];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chantier()
    {
        return $this->belongsTo(Chantier::class);
    }
}
