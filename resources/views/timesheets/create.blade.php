<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Fiche d'Heures - Szlazak Gestion</title>
    @include('partials.app-head')
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bleu-marine: #162048;
            --bleu-clair: #1e2a66;
            --bg-primary: #f8f9fa;
            --bg-secondary: #e9ecef;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --border-color: #dee2e6;
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        .header {
            background-color: white;
            box-shadow: 0 2px 10px var(--shadow-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--bleu-marine) !important;
        }

        .page-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        .form-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 3px rgba(22, 32, 72, 0.1);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(22, 32, 72, 0.3);
        }

        footer {
            background-color: var(--bg-secondary);
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.app-navbar')

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Page Header -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-clock me-3"></i>Nouvelle Fiche d'Heures</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Enregistrez les heures travaillées</p>
                </div>
                @if(request('user_id'))
                    <a href="{{ route('users.show', request('user_id')) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour au profil
                    </a>
                @else
                    <a href="{{ route('timesheets.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux fiches
                    </a>
                @endif
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card animate__animated animate__fadeIn animate__delay-1s">
            <form action="{{ route('timesheets.store') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <!-- Utilisateur -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-user me-2"></i>Travailleur *
                        </label>
                        <select name="user_id" class="form-select" required>
                            <option value="">Sélectionnez un travailleur</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" 
                                    {{ old('user_id', $selectedUser) == $user->id ? 'selected' : '' }}>
                                    {{ $user->nom }} - {{ $user->role->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Chantier -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-hard-hat me-2"></i>Chantier *
                        </label>
                        <select name="chantier_id" class="form-select" required>
                            <option value="">Sélectionnez un chantier</option>
                            @foreach($chantiers as $chantier)
                                <option value="{{ $chantier->id }}" {{ old('chantier_id') == $chantier->id ? 'selected' : '' }}>
                                    {{ $chantier->nom }} ({{ $chantier->statut }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Date de travail -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>Date de travail *
                        </label>
                        <input type="date" name="date_travail" class="form-control" 
                               value="{{ old('date_travail', date('Y-m-d')) }}" required>
                    </div>

                    <!-- Heure de début -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="fas fa-clock me-2"></i>Heure de début *
                        </label>
                        <input type="time" name="heure_debut" class="form-control" 
                               value="{{ old('heure_debut', '08:00') }}" required>
                    </div>

                    <!-- Heure de fin -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="fas fa-clock me-2"></i>Heure de fin *
                        </label>
                        <input type="time" name="heure_fin" class="form-control" 
                               value="{{ old('heure_fin', '17:00') }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Pause -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">
                            <i class="fas fa-utensils me-2"></i>Pause déjeuner
                        </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pause" id="pause_oui" 
                                   value="1" {{ old('pause') == '1' ? 'checked' : 'checked' }}>
                            <label class="form-check-label" for="pause_oui">Oui (1h)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pause" id="pause_non" 
                                   value="0" {{ old('pause') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pause_non">Non</label>
                        </div>

                        <label class="form-label d-block mt-3">
                            <i class="fas fa-basket-shopping me-2"></i>Panier
                        </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="panier" id="panier_oui" 
                                   value="1" {{ old('panier') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="panier_oui">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="panier" id="panier_non" 
                                   value="0" {{ old('panier', '0') == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="panier_non">Non</label>
                        </div>
                    </div>

                    <!-- Heures supplémentaires -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-plus-circle me-2"></i>Heures supplémentaires
                        </label>
                        <input type="number" name="heures_supp" class="form-control" 
                               step="0.5" min="0" value="{{ old('heures_supp', 0) }}"
                               placeholder="Ex: 1.5 pour 1 heure 30">
                        <small class="text-muted">En heures (ex: 0.5 pour 30 minutes)</small>
                    </div>
                </div>

                <!-- Zone de travail -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt me-2"></i>Zone de travail
                        </label>
                        <select name="zone" class="form-select">
                            <option value="">Sélectionnez une zone</option>
                            <option value="1" {{ old('zone') == '1' ? 'selected' : '' }}>Zone 1</option>
                            <option value="2" {{ old('zone') == '2' ? 'selected' : '' }}>Zone 2</option>
                            <option value="3" {{ old('zone') == '3' ? 'selected' : '' }}>Zone 3</option>
                            <option value="4" {{ old('zone') == '4' ? 'selected' : '' }}>Zone 4</option>
                        </select>
                        <small class="text-muted">Zones 1 à 4 (optionnel)</small>
                    </div>
                </div>

                <!-- Calcul automatique -->
                <div class="alert alert-info mb-4">
                    <i class="fas fa-calculator me-2"></i>
                    <strong>Calcul automatique :</strong>
                    <span id="calcul_heures">Heures normales: 8h | Total avec supp: 8h</span>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Réinitialiser
                    </button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer la fiche
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcul automatique des heures
            function calculerHeures() {
                const heureDebut = document.querySelector('input[name="heure_debut"]').value;
                const heureFin = document.querySelector('input[name="heure_fin"]').value;
                const pause = document.querySelector('input[name="pause"]:checked')?.value;
                const heuresSupp = parseFloat(document.querySelector('input[name="heures_supp"]').value) || 0;
                
                if (heureDebut && heureFin) {
                    const debut = new Date(`2000-01-01T${heureDebut}`);
                    const fin = new Date(`2000-01-01T${heureFin}`);
                    
                    // Différence en heures
                    let diffHeures = (fin - debut) / (1000 * 60 * 60);
                    
                    // Soustraire la pause si présente
                    if (pause === '1') {
                        diffHeures -= 1;
                    }
                    
                    // Formatage
                    const heuresNormales = diffHeures.toFixed(1);
                    const totalHeures = (diffHeures + heuresSupp).toFixed(1);
                    
                    // Mise à jour de l'affichage
                    document.getElementById('calcul_heures').textContent = 
                        `Heures normales: ${heuresNormales}h | Total avec supp: ${totalHeures}h`;
                }
            }
            
            // Écouteurs d'événements
            document.querySelectorAll('input[name="heure_debut"], input[name="heure_fin"], input[name="pause"], input[name="heures_supp"]')
                .forEach(input => {
                    input.addEventListener('input', calculerHeures);
                    input.addEventListener('change', calculerHeures);
                });
            
            // Calcul initial
            calculerHeures();
            
            // Validation de l'heure de fin > heure de début
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const heureDebut = document.querySelector('input[name="heure_debut"]').value;
                const heureFin = document.querySelector('input[name="heure_fin"]').value;
                
                if (heureDebut && heureFin && heureFin <= heureDebut) {
                    e.preventDefault();
                    alert('L\'heure de fin doit être postérieure à l\'heure de début.');
                    document.querySelector('input[name="heure_fin"]').focus();
                }
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


