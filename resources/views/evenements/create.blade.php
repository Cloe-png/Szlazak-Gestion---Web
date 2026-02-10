<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Événement - Szlazak Gestion</title>
    @include('partials.app-head')
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flatpickr (pour de meilleurs sélecteurs de date) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
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
            --transition-speed: 0.3s;
            --highlight-color: rgba(22, 32, 72, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
            background-color: var(--bg-primary);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--bleu-marine);
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

        .nav-link {
            color: var(--bleu-marine) !important;
            font-weight: 500;
            margin: 0 5px;
        }

        .nav-link:hover {
            color: var(--bleu-clair) !important;
        }

        .nav-link.active {
            color: var(--bleu-clair) !important;
            font-weight: 600;
            border-bottom: 2px solid var(--bleu-clair);
        }

        .page-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        .page-header h1 {
            color: white;
            margin-bottom: 0;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(22, 32, 72, 0.3);
            color: white;
        }

        .btn-secondary-custom {
            background-color: white;
            color: var(--bleu-marine);
            border: 2px solid var(--bleu-marine);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-secondary-custom:hover {
            background-color: var(--bleu-marine);
            color: white;
            transform: translateY(-2px);
        }

        .form-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 0.25rem rgba(22, 32, 72, 0.15);
        }

        .form-check-input:checked {
            background-color: var(--bleu-marine);
            border-color: var(--bleu-marine);
        }

        .datetime-group {
            display: flex;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .datetime-group {
                flex-direction: column;
                gap: 15px;
            }
        }

        .form-section {
            background-color: var(--bg-primary);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid var(--bleu-clair);
        }

        .form-section-title {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 15px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        footer {
            background-color: var(--bg-secondary);
            padding: 20px 0;
            margin-top: 40px;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
                    <h1><i class="fas fa-calendar-plus me-3"></i>Nouvel Événement</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Planifiez un nouvel événement dans votre agenda</p>
                </div>
                <a href="{{ route('evenements.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'agenda
                </a>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="form-container animate__animated animate__fadeIn animate__delay-1s">
            <form action="{{ route('evenements.store') }}" method="POST">
                @csrf
                
                <!-- Section Informations Générales -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-info-circle"></i>Informations Générales
                    </div>
                    
                    <div class="mb-4">
                        <label for="titre" class="form-label">
                            <i class="fas fa-heading"></i>Titre de l'événement
                        </label>
                        <input type="text" class="form-control" id="titre" name="titre" 
                               value="{{ old('titre') }}" required 
                               placeholder="Ex: Réunion chantier, Inspection, Livraison matériel...">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left"></i>Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="4" 
                                  placeholder="Décrivez l'événement, les objectifs, les points importants...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Section Dates et Horaires -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-clock"></i>Dates et Horaires
                    </div>
                    
                    <div class="datetime-group">
                        <div class="mb-3" style="flex: 1;">
                            <label for="date_debut" class="form-label">
                                <i class="fas fa-play-circle"></i>Date et heure de début
                            </label>
                            <input type="datetime-local" class="form-control" id="date_debut" 
                                   name="date_debut" value="{{ old('date_debut', now()->format('Y-m-d\TH:i')) }}" required>
                        </div>

                        <div class="mb-3" style="flex: 1;">
                            <label for="date_fin" class="form-label">
                                <i class="fas fa-stop-circle"></i>Date et heure de fin
                            </label>
                            <input type="datetime-local" class="form-control" id="date_fin" 
                                   name="date_fin" value="{{ old('date_fin') }}">
                            <div class="form-text">Facultatif</div>
                        </div>
                    </div>
                </div>

                <!-- Section Participants et Localisation -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-users"></i>Participants et Localisation
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">
                                <i class="fas fa-user-tie"></i>Responsable
                            </label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option value="">Sélectionnez un responsable</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->nom }}
                                        @if($user->role)
                                            <small class="text-muted">({{ $user->role }})</small>
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="chantier_id" class="form-label">
                                <i class="fas fa-map-marker-alt"></i>Chantier associé
                            </label>
                            <select class="form-select" id="chantier_id" name="chantier_id">
                                <option value="">Aucun chantier</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{ $chantier->id }}" {{ old('chantier_id') == $chantier->id ? 'selected' : '' }}>
                                        {{ $chantier->nom }} - {{ $chantier->adresse }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Facultatif - Liez l'événement à un chantier spécifique</div>
                        </div>
                    </div>
                </div>

                <!-- Section Statut -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-tasks"></i>Statut de l'événement
                    </div>
                    
                    <div class="mb-3">
                        <label for="statut" class="form-label">
                            <i class="fas fa-flag"></i>Statut
                        </label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="À venir" {{ old('statut', 'À venir') == 'À venir' ? 'selected' : '' }}>À venir</option>
                            <option value="En cours" {{ old('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                            <option value="Terminé" {{ old('statut') == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                            <option value="Annulé" {{ old('statut') == 'Annulé' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="action-buttons">
                    <a href="{{ route('evenements.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>Créer l'événement
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration Flatpickr pour les dates
            const frenchLocale = flatpickr.l10ns.fr;
            
            // Configuration pour date_debut
            flatpickr("#date_debut", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                locale: frenchLocale,
                time_24hr: true,
                minuteIncrement: 15,
                defaultDate: "today",
                minDate: "today",
                onChange: function(selectedDates) {
                    // Mettre à jour la date de fin minimum
                    const dateFinPicker = document.getElementById('date_fin')._flatpickr;
                    if (dateFinPicker) {
                        dateFinPicker.set('minDate', selectedDates[0]);
                    }
                }
            });

            // Configuration pour date_fin
            flatpickr("#date_fin", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                locale: frenchLocale,
                time_24hr: true,
                minuteIncrement: 15,
                minDate: "today"
            });

            // Validation du formulaire
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const dateDebut = document.getElementById('date_debut').value;
                const dateFin = document.getElementById('date_fin').value;
                
                if (dateFin && new Date(dateFin) < new Date(dateDebut)) {
                    e.preventDefault();
                    alert('La date de fin doit être postérieure à la date de début.');
                    return false;
                }
            });

            // Animation des éléments
            const elements = document.querySelectorAll('.animate-fade-in');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


