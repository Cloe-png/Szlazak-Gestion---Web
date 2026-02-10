<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'quantite',
        'date_achat',
        'etat',
        'localisation',
    ];

    public function emprunts()
    {
        return $this->hasMany(EmpruntEquipement::class);
    }
}
