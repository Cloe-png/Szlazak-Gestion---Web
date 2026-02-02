<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\TimesheetController;

/*
|--------------------------------------------------------------------------
| Routes d'authentification (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil = Login (welcome.blade.php)
Route::get('/', function () {
    // Si déjà connecté, rediriger vers le dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Routes Protégées (nécessitent authentification)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Routes pour les chantiers
    Route::resource('chantiers', ChantierController::class);
    
    // Routes pour les équipements
    Route::resource('equipements', EquipementController::class);
    
    // Routes pour les utilisateurs
    Route::resource('users', UserController::class);
    
    // Routes pour les événements (agenda)
    Route::resource('evenements', EvenementController::class);
    
    // Routes pour les fiches d'heures
    Route::resource('timesheets', TimesheetController::class);
    
    // Route supplémentaire pour créer une fiche avec un utilisateur spécifique
    Route::get('timesheets/create', [TimesheetController::class, 'create'])
        ->name('timesheets.create');
});