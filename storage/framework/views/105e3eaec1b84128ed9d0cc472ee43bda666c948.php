<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szlazak - Tableau de Bord</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Leaflet pour la carte (optionnel) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
            --formspree-color: #4c63d2;
            /* Couleurs météo */
            --sunny: #FFD700;
            --cloudy: #A9A9A9;
            --rainy: #1E90FF;
            --stormy: #483D8B;
            --snowy: #E0FFFF;
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

        /* Carte météo */
        .weather-card {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
            border: none;
            position: relative;
            overflow: hidden;
            min-height: 180px;
        }

        .weather-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .weather-content {
            position: relative;
            z-index: 2;
        }

        .weather-location {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .weather-location i {
            margin-right: 8px;
            font-size: 1.2rem;
        }

        .weather-temp {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .weather-desc {
            font-size: 1.1rem;
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        .weather-details {
            display: flex;
            gap: 20px;
            font-size: 0.9rem;
        }

        .weather-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 4rem;
            opacity: 0.8;
        }

        .weather-sunny { color: var(--sunny); }
        .weather-cloudy { color: var(--cloudy); }
        .weather-rainy { color: var(--rainy); }
        .weather-stormy { color: var(--stormy); }
        .weather-snowy { color: var(--snowy); }

        /* Dashboard Cards */
        .dashboard-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px var(--shadow-color);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--bleu-marine);
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .card-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Quick Access */
        .quick-access {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .quick-access-btn {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
            display: block;
            text-align: center;
            margin-bottom: 10px;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .quick-access-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(22, 32, 72, 0.3);
        }

        .quick-access-btn i {
            margin-right: 8px;
        }

        /* List Styles */
        .list-item {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: flex-start;
        }

        /* Animation */
        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes  fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }

        /* Responsive */
        @media (max-width: 768px) {
            .weather-card {
                min-height: 160px;
            }

            .weather-temp {
                font-size: 2rem;
            }

            .weather-icon {
                font-size: 3rem;
            }
        }

        /* Section Quick Access + Devis */
        .quick-access-section {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .quick-access-container {
            flex: 1;
        }

        .devis-btn-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Bouton de déconnexion */
        .logout-form {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .logout-btn {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 8px 16px;
            color: #dc3545;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background-color: rgba(220, 53, 69, 0.1);
            color: #c82333;
        }

        /* Badges */
        .badge-custom {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-en-cours {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .badge-termine {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-a-venir {
            background-color: #fff3cd;
            color: #856404;
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
                        <a class="nav-link" href="<?php echo e(route('evenements.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('timesheets.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Fiches d'heures
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?php echo e(Auth::user()->nom ?? 'Szlazak Nicolas'); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <!-- Formulaire de déconnexion -->
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <h1 class="mb-0">Tableau de Bord</h1>
            <div>
                <span class="me-3"><i class="fas fa-calendar-alt me-1"></i><?php echo e(date('d/m/Y')); ?></span>
                <span><i class="fas fa-clock me-1"></i><span id="current-time"><?php echo e(date('H:i')); ?></span></span>
            </div>
        </div>

        <!-- Météo -->
        <div class="row mb-4">
            <div class="col-12 animate__animated animate__fadeIn">
                <div class="row g-3">
                    <!-- Météo actuelle -->
                    <div class="col-lg-8">
                        <div class="weather-card">
                            <div class="weather-content">
                                <div class="weather-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span id="weather-location">Chargement de la localisation...</span>
                                </div>
                                <div class="weather-temp" id="weather-temp">--°C</div>
                                <div class="weather-desc" id="weather-description">Chargement...</div>
                                <div class="weather-details">
                                    <div>
                                        <i class="fas fa-wind me-1"></i>
                                        <span id="weather-wind">-- km/h</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-tint me-1"></i>
                                        <span id="weather-humidity">--%</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-temperature-high me-1"></i>
                                        <span id="weather-feels-like">--°C</span>
                                    </div>
                                </div>
                                <div id="weather-icon" class="weather-icon">
                                    <i class="fas fa-sun"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <!-- Chantiers en cours -->
            <div class="col-md-6 col-lg-3 animate__animated animate__fadeIn animate__delay-1s">
                <div class="dashboard-card h-100">
                    <div class="card-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h5 class="card-title">Chantiers en cours</h5>
                    <div class="card-value"><?php echo e($chantiersEnCours ?? '0'); ?></div>
                    <p class="card-description">Projets actifs actuellement</p>
                </div>
            </div>

            <!-- Équipements disponibles -->
            <div class="col-md-6 col-lg-3 animate__animated animate__fadeIn animate__delay-1s">
                <div class="dashboard-card h-100">
                    <div class="card-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h5 class="card-title">Équipements</h5>
                    <div class="card-value"><?php echo e($equipementsDisponibles ?? '0'); ?></div>
                    <p class="card-description">Matériel disponible</p>
                </div>
            </div>

            <!-- Prochains événements -->
            <div class="col-md-6 col-lg-3 animate__animated animate__fadeIn animate__delay-2s">
                <div class="dashboard-card h-100">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h5 class="card-title">Prochains événements</h5>
                    <div class="card-value"><?php echo e($prochainsEvenements ?? '0'); ?></div>
                    <p class="card-description">Dans les 7 prochains jours</p>
                </div>
            </div>

        <div class="quick-access-section row g-4 mb-5 animate__animated animate__fadeIn animate__delay-3s">
            <!-- Quick Access -->
            <div class="col-lg-4 quick-access-container">
                <div class="quick-access h-100">
                    <h4 class="text-center mb-4" style="color: var(--bleu-marine);">Accès Rapide</h4>
                    <a href="<?php echo e(route('chantiers.create')); ?>" class="quick-access-btn">
                        <i class="fas fa-plus"></i>Nouveau Chantier
                    </a>
                    <a href="<?php echo e(route('equipements.create')); ?>" class="quick-access-btn">
                        <i class="fas fa-plus"></i>Nouvel Équipement
                    </a>
                    <a href="<?php echo e(route('users.create')); ?>" class="quick-access-btn">
                        <i class="fas fa-user-plus"></i>Nouvel Employé
                    </a>
                    <a href="<?php echo e(route('evenements.create')); ?>" class="quick-access-btn">
                        <i class="fas fa-calendar-plus"></i>Nouvel Événement
                    </a>
                </div>
            </div>

            <!-- Bouton Voir les Devis -->
            <div class="col-lg-2 devis-btn-container">
                <a href="https://outlook.live.com/mail/AQMkADAwATYwMAItY2QyYy0xOTU3LTAwAi0wMAoALgAAA1BB2QahD05HtZM3%2FJ5cV6cBACC4Q86sLwdPqrZyfuqWYHoACNbEXwAAAQ%3D%3D" 
                   target="_blank" 
                   class="quick-access-btn">
                    <i class="fas fa-file-invoice-dollar"></i>Voir les Devis
                </a>
            </div>
        </div>

        <!-- Derniers Chantiers et Événements -->
        <div class="row g-4 mb-5">
            <!-- Derniers Chantiers -->
            <div class="col-lg-6 animate__animated animate__fadeIn animate__delay-4s">
                <div class="dashboard-card h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="card-icon" style="width: 40px; height: 40px; margin-right: 15px;">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h5 class="card-title mb-0">Derniers Chantiers</h5>
                    </div>

                    <?php if(isset($derniersChantiers) && !$derniersChantiers->isEmpty()): ?>
                        <?php $__currentLoopData = $derniersChantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-item">
                            <div class="list-icon">
                                <i class="fas fa-project-diagram" style="color: var(--bleu-marine);"></i>
                            </div>
                            <div class="list-content">
                                <div class="list-title"><?php echo e($chantier->nom); ?></div>
                                <div class="list-description"><?php echo e(Str::limit($chantier->adresse, 50)); ?></div>
                                <div class="list-meta">
                                    <span><i class="fas fa-user me-1"></i><?php echo e($chantier->responsable->nom ?? 'Non assigné'); ?></span>
                                    <span>
                                        <span class="badge-custom
                                            <?php if($chantier->statut == 'En cours'): ?> badge-en-cours
                                            <?php elseif($chantier->statut == 'Terminé'): ?> badge-termine
                                            <?php else: ?> badge-a-venir <?php endif; ?>">
                                            <?php echo e($chantier->statut); ?>

                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="list-time">
                                <?php echo e($chantier->created_at ? \Carbon\Carbon::parse($chantier->created_at)->format('d/m/Y') : '--'); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-center text-muted">Aucun chantier récent.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Derniers Événements -->
            <div class="col-lg-6 animate__animated animate__fadeIn animate__delay-4s">
                <div class="dashboard-card h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="card-icon" style="width: 40px; height: 40px; margin-right: 15px;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h5 class="card-title mb-0">Prochains Événements</h5>
                    </div>

                    <?php if(isset($derniersEvenements) && !$derniersEvenements->isEmpty()): ?>
                        <?php $__currentLoopData = $derniersEvenements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evenement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-item">
                            <div class="list-icon">
                                <i class="fas fa-calendar-check" style="color: var(--bleu-marine);"></i>
                            </div>
                            <div class="list-content">
                                <div class="list-title"><?php echo e($evenement->titre); ?></div>
                                <div class="list-description"><?php echo e(Str::limit($evenement->description, 50)); ?></div>
                                <div class="list-meta">
                                    <span><i class="fas fa-user me-1"></i><?php echo e($evenement->user->nom ?? 'Non assigné'); ?></span>
                                    <?php if($evenement->chantier_id): ?>
                                        <span><i class="fas fa-project-diagram me-1"></i>
                                            <?php echo e($evenement->chantier->nom ?? 'Chantier inconnu'); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="list-time">
                                <?php echo e($evenement->date_debut ? \Carbon\Carbon::parse($evenement->date_debut)->format('d/m/Y H:i') : '--'); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-center text-muted">Aucun événement à venir.</p>
                    <?php endif; ?>
                </div>
            </div>
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
    <!-- Leaflet JS (optionnel) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Clé API OpenWeatherMap (gratuite - à obtenir sur openweathermap.org)
            const API_KEY = '1c07c7c65f64a4db0d696c4b495b6c06';

            // Ville par défaut (peut être modifiée)
            const DEFAULT_CITY = 'Paris';

            // Éléments DOM
            const weatherLocation = document.getElementById('weather-location');
            const weatherTemp = document.getElementById('weather-temp');
            const weatherDescription = document.getElementById('weather-description');
            const weatherWind = document.getElementById('weather-wind');
            const weatherHumidity = document.getElementById('weather-humidity');
            const weatherFeelsLike = document.getElementById('weather-feels-like');
            const weatherIcon = document.getElementById('weather-icon');
            const currentTime = document.getElementById('current-time');

            // Icônes météo
            const weatherIcons = {
                '01d': 'fas fa-sun', // soleil
                '01n': 'fas fa-moon', // lune
                '02d': 'fas fa-cloud-sun', // peu nuageux jour
                '02n': 'fas fa-cloud-moon', // peu nuageux nuit
                '03d': 'fas fa-cloud', // nuageux
                '03n': 'fas fa-cloud',
                '04d': 'fas fa-cloud', // très nuageux
                '04n': 'fas fa-cloud',
                '09d': 'fas fa-cloud-rain', // pluie
                '09n': 'fas fa-cloud-rain',
                '10d': 'fas fa-cloud-sun-rain', // pluie avec soleil
                '10n': 'fas fa-cloud-moon-rain',
                '11d': 'fas fa-bolt', // orage
                '11n': 'fas fa-bolt',
                '13d': 'fas fa-snowflake', // neige
                '13n': 'fas fa-snowflake',
                '50d': 'fas fa-smog', // brouillard
                '50n': 'fas fa-smog'
            };

            // Couleurs pour les conditions météo
            const weatherColors = {
                'clear': 'weather-sunny',
                'clouds': 'weather-cloudy',
                'rain': 'weather-rainy',
                'drizzle': 'weather-rainy',
                'thunderstorm': 'weather-stormy',
                'snow': 'weather-snowy',
                'mist': 'weather-cloudy',
                'smoke': 'weather-cloudy',
                'haze': 'weather-cloudy',
                'fog': 'weather-cloudy'
            };

            // Récupérer la météo actuelle
            async function getCurrentWeather(city = DEFAULT_CITY) {
                try {
                    // D'abord essayer la géolocalisation
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            async (position) => {
                                const { latitude, longitude } = position.coords;
                                await fetchWeatherByCoords(latitude, longitude);
                            },
                            async (error) => {
                                console.warn('Géolocalisation échouée:', error);
                                // Utiliser la ville par défaut
                                await fetchWeatherByCity(city);
                            }
                        );
                    } else {
                        // Navigateur sans géolocalisation
                        await fetchWeatherByCity(city);
                    }
                } catch (error) {
                    console.error('Erreur météo:', error);
                    showWeatherError();
                }
            }

            // Récupérer la météo par coordonnées
            async function fetchWeatherByCoords(lat, lon) {
                const currentUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${API_KEY}&units=metric&lang=fr`;

                await fetchWeatherData(currentUrl, true);
            }

            // Récupérer la météo par ville
            async function fetchWeatherByCity(city) {
                const currentUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric&lang=fr`;

                await fetchWeatherData(currentUrl, true);
            }

            // Récupérer les données météo
            async function fetchWeatherData(url, isCurrent) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Erreur API');

                    const data = await response.json();

                    if (isCurrent) {
                        updateCurrentWeather(data);
                    }
                } catch (error) {
                    console.error('Erreur fetch:', error);
                    if (isCurrent) showWeatherError();
                }
            }

            // Mettre à jour la météo actuelle
            function updateCurrentWeather(data) {
                weatherLocation.textContent = `${data.name}, ${data.sys.country}`;
                weatherTemp.textContent = `${Math.round(data.main.temp)}°C`;
                weatherDescription.textContent = data.weather[0].description;
                weatherWind.textContent = `${Math.round(data.wind.speed * 3.6)} km/h`;
                weatherHumidity.textContent = `${data.main.humidity}%`;
                weatherFeelsLike.textContent = `${Math.round(data.main.feels_like)}°C`;

                // Mettre à jour l'icône
                const iconCode = data.weather[0].icon;
                const iconClass = weatherIcons[iconCode] || 'fas fa-cloud';
                const condition = data.weather[0].main.toLowerCase();
                const colorClass = weatherColors[condition] || 'weather-cloudy';

                weatherIcon.innerHTML = `<i class="${iconClass} ${colorClass}"></i>`;
            }

            // Afficher une erreur
            function showWeatherError() {
                weatherLocation.textContent = 'Erreur de connexion';
                weatherTemp.textContent = '--°C';
                weatherDescription.textContent = 'Impossible de charger les données météo';
                weatherIcon.innerHTML = '<i class="fas fa-exclamation-triangle weather-cloudy"></i>';
            }

            // Mettre à jour l'heure en temps réel
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('fr-FR', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                currentTime.textContent = timeString;
            }

            // Initialiser
            getCurrentWeather();
            updateTime();
            setInterval(updateTime, 60000);

            // Option: Bouton pour actualiser la météo manuellement
            weatherLocation.style.cursor = 'pointer';
            weatherLocation.title = 'Cliquer pour actualiser la météo';
            weatherLocation.addEventListener('click', () => {
                weatherLocation.innerHTML = '<i class="fas fa-sync-alt fa-spin me-2"></i>Actualisation...';
                getCurrentWeather();
            });

            // Animation des éléments
            const animateElements = document.querySelectorAll('.animate-fade-in');
            animateElements.forEach(element => {
                element.style.animationPlayState = 'running';
            });

            // Confirmation de déconnexion
            const logoutForm = document.querySelector('.logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/dashboard.blade.php ENDPATH**/ ?>