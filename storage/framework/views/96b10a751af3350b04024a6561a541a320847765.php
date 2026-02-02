<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Événement - Szlazak Gestion</title>
    
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

        .type-selector {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .type-option {
            flex: 1;
            min-width: 120px;
        }

        .type-option input[type="radio"] {
            display: none;
        }

        .type-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            text-align: center;
            height: 100%;
        }

        .type-option label:hover {
            border-color: var(--bleu-clair);
            background-color: var(--highlight-color);
        }

        .type-option input[type="radio"]:checked + label {
            border-color: var(--bleu-marine);
            background-color: rgba(22, 32, 72, 0.05);
            color: var(--bleu-marine);
            font-weight: 500;
        }

        .type-option label i {
            font-size: 1.5rem;
            margin-bottom: 8px;
            color: var(--text-secondary);
        }

        .type-option input[type="radio"]:checked + label i {
            color: var(--bleu-marine);
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

        @keyframes  fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('dashboard')); ?>">
                <i class="fas fa-hard-hat me-2"></i>
                <span>Szlazak</span>
                <small class="text-muted ms-1">Gestion</small>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                            <i class="fas fa-home me-1"></i>Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('chantiers.index')); ?>">
                            <i class="fas fa-project-diagram me-1"></i>Chantiers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('equipements.index')); ?>">
                            <i class="fas fa-tools me-1"></i>Équipements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('users.index')); ?>">
                            <i class="fas fa-users me-1"></i>Équipe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('evenements.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Agenda
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?php echo e(Auth::user()->nom ?? 'Szlazak Nicolas'); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Messages d'erreur -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-calendar-plus me-3"></i>Nouvel Événement</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Planifiez un nouvel événement dans votre agenda</p>
                </div>
                <a href="<?php echo e(route('evenements.index')); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'agenda
                </a>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="form-container animate__animated animate__fadeIn animate__delay-1s">
            <form action="<?php echo e(route('evenements.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
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
                               value="<?php echo e(old('titre')); ?>" required 
                               placeholder="Ex: Réunion chantier, Inspection, Livraison matériel...">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-tag"></i>Type d'événement
                        </label>
                        <div class="type-selector">
                            <div class="type-option">
                                <input type="radio" id="type-chantier" name="type" value="chantier" <?php echo e(old('type') == 'chantier' ? 'checked' : 'checked'); ?>>
                                <label for="type-chantier">
                                    <i class="fas fa-project-diagram"></i>
                                    <span>Chantier</span>
                                </label>
                            </div>
                            <div class="type-option">
                                <input type="radio" id="type-reunion" name="type" value="reunion" <?php echo e(old('type') == 'reunion' ? 'checked' : ''); ?>>
                                <label for="type-reunion">
                                    <i class="fas fa-users"></i>
                                    <span>Réunion</span>
                                </label>
                            </div>
                            <div class="type-option">
                                <input type="radio" id="type-maintenance" name="type" value="maintenance" <?php echo e(old('type') == 'maintenance' ? 'checked' : ''); ?>>
                                <label for="type-maintenance">
                                    <i class="fas fa-tools"></i>
                                    <span>Maintenance</span>
                                </label>
                            </div>
                            <div class="type-option">
                                <input type="radio" id="type-livraison" name="type" value="livraison" <?php echo e(old('type') == 'livraison' ? 'checked' : ''); ?>>
                                <label for="type-livraison">
                                    <i class="fas fa-truck"></i>
                                    <span>Livraison</span>
                                </label>
                            </div>
                            <div class="type-option">
                                <input type="radio" id="type-inspection" name="type" value="inspection" <?php echo e(old('type') == 'inspection' ? 'checked' : ''); ?>>
                                <label for="type-inspection">
                                    <i class="fas fa-search"></i>
                                    <span>Inspection</span>
                                </label>
                            </div>
                            <div class="type-option">
                                <input type="radio" id="type-autre" name="type" value="autre" <?php echo e(old('type') == 'autre' ? 'checked' : ''); ?>>
                                <label for="type-autre">
                                    <i class="fas fa-calendar"></i>
                                    <span>Autre</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left"></i>Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="4" 
                                  placeholder="Décrivez l'événement, les objectifs, les points importants..."><?php echo e(old('description')); ?></textarea>
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
                                   name="date_debut" value="<?php echo e(old('date_debut', now()->format('Y-m-d\TH:i'))); ?>" required>
                        </div>

                        <div class="mb-3" style="flex: 1;">
                            <label for="date_fin" class="form-label">
                                <i class="fas fa-stop-circle"></i>Date et heure de fin
                            </label>
                            <input type="datetime-local" class="form-control" id="date_fin" 
                                   name="date_fin" value="<?php echo e(old('date_fin')); ?>">
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
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id') == $user->id ? 'selected' : ''); ?>>
                                        <?php echo e($user->nom); ?>

                                        <?php if($user->role): ?>
                                            <small class="text-muted">(<?php echo e($user->role); ?>)</small>
                                        <?php endif; ?>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="chantier_id" class="form-label">
                                <i class="fas fa-map-marker-alt"></i>Chantier associé
                            </label>
                            <select class="form-select" id="chantier_id" name="chantier_id">
                                <option value="">Aucun chantier</option>
                                <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($chantier->id); ?>" <?php echo e(old('chantier_id') == $chantier->id ? 'selected' : ''); ?>>
                                        <?php echo e($chantier->nom); ?> - <?php echo e($chantier->adresse); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <option value="À venir" <?php echo e(old('statut', 'À venir') == 'À venir' ? 'selected' : ''); ?>>À venir</option>
                            <option value="En cours" <?php echo e(old('statut') == 'En cours' ? 'selected' : ''); ?>>En cours</option>
                            <option value="Terminé" <?php echo e(old('statut') == 'Terminé' ? 'selected' : ''); ?>>Terminé</option>
                            <option value="Annulé" <?php echo e(old('statut') == 'Annulé' ? 'selected' : ''); ?>>Annulé</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="action-buttons">
                    <a href="<?php echo e(route('evenements.index')); ?>" class="btn btn-secondary btn-lg">
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
    <footer class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">EURL SZLAZAK</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">© <?php echo e(date('Y')); ?> - Tous droits réservés</p>
                </div>
            </div>
        </div>
    </footer>

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
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/evenements/create.blade.php ENDPATH**/ ?>