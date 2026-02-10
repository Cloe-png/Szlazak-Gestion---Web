<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Routes d'authentification (Laravel)
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
| Routes Protégées (nécéssitent authentification)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Accès communs
    Route::resource('chantiers', ChantierController::class)
        ->only(['index', 'show'])
        ->whereNumber('chantier');
    Route::resource('equipements', EquipementController::class)
        ->only(['index', 'show'])
        ->whereNumber('equipement');
    Route::get('equipements/emprunts', [EquipementController::class, 'loans'])
        ->name('equipements.loans');
    Route::get('equipements/emprunts/creer', [EquipementController::class, 'createLoan'])
        ->name('equipements.loans.create');
    Route::post('equipements/emprunts', [EquipementController::class, 'storeLoan'])
        ->name('equipements.loans.store');
    Route::post('equipements/emprunts/{loan}/return', [EquipementController::class, 'returnLoan'])
        ->name('equipements.loans.return');
    Route::resource('evenements', EvenementController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('timesheets', TimesheetController::class)
        ->only(['index', 'create', 'store', 'show'])
        ->whereNumber('timesheet');

    Route::get('/parametres', [SettingsController::class, 'edit'])
        ->name('settings.edit');
    Route::post('/parametres/mot-de-passe', [SettingsController::class, 'updatePassword'])
        ->name('settings.password');
});

Route::middleware(['auth', 'admin.only'])->group(function () {
    // Routes pour les chantiers (admin)
    Route::resource('chantiers', ChantierController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::post('chantiers/{chantier}/assign-users', [ChantierController::class, 'assignUsers'])
        ->name('chantiers.assign-users');
    Route::delete('chantiers/{chantier}/assignees/{user}', [ChantierController::class, 'unassignUser'])
        ->name('chantiers.unassign-user');

    // Routes pour les Equipements (admin)
    Route::resource('equipements', EquipementController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);

    // Routes pour les utilisateurs (admin)
    Route::resource('users', UserController::class);
    Route::get('users/{user}/timesheets/export-weekly', [TimesheetController::class, 'exportWeekly'])
        ->name('users.timesheets.export-weekly');

    // Routes pour les rôles (admin)
    Route::resource('roles', RoleController::class);

    // Routes pour les événements (admin)
    Route::resource('evenements', EvenementController::class)->except(['index', 'show', 'create', 'store']);

    // Routes pour les fiches d'heures (admin)
    Route::get('timesheets/export', [TimesheetController::class, 'exportGlobal'])
        ->name('timesheets.export');
    Route::resource('timesheets', TimesheetController::class)
        ->except(['index', 'create', 'store', 'show'])
        ->whereNumber('timesheet');
});
