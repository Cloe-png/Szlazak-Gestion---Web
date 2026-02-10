<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'user_id',
        'chantier_id',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chantier()
    {
        return $this->belongsTo(Chantier::class);
    }
}
