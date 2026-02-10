<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'role_id',
        'date_embauche',
        'telephone',
        'adresse',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_embauche' => 'date',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function getNameAttribute()
    {
        return $this->nom;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        if ($this->role_id === 1) {
            return true;
        }

        $roleName = $this->role ? trim((string) $this->role->nom) : '';
        return strcasecmp($roleName, 'Administrateur') === 0 || strcasecmp($roleName, 'Admin') === 0;
    }

    // Relation avec les fiches d'heures
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    // Relation avec les chantiers (si responsable)
    public function chantiers()
    {
        return $this->hasMany(Chantier::class, 'responsable_id');
    }

    // Chantiers attribués par l'administrateur (web)
    public function chantiersAttribues()
    {
        return $this->belongsToMany(Chantier::class)
            ->withPivot(['assigned_by', 'assigned_at'])
            ->withTimestamps();
    }

    // Emprunts d'équipements
    public function empruntEquipements()
    {
        return $this->hasMany(EmpruntEquipement::class);
    }

    // Relation avec les événements
    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }
}
