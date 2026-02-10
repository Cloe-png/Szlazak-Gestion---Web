<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szlazak - Tableau de Bord</title>
    @include('partials.app-head')
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
            background-image: radial-gradient(circle at 15% 15%, rgba(22, 32, 72, 0.08), transparent 45%),
                              radial-gradient(circle at 85% 5%, rgba(30, 42, 102, 0.08), transparent 40%),
                              linear-gradient(180deg, rgba(248, 249, 250, 0.9), rgba(248, 249, 250, 0.9));
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

        .dashboard-hero {
            background: linear-gradient(135deg, rgba(22, 32, 72, 0.95) 0%, rgba(30, 42, 102, 0.9) 100%);
            border-radius: 18px;
            padding: 26px 28px;
            color: white;
            box-shadow: 0 16px 35px rgba(22, 32, 72, 0.2);
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .dashboard-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 45%);
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .hero-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
            font-size: 0.95rem;
        }

        .hero-actions {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .date-time-card {
            background: #ffffff;
            border: 1px solid rgba(22, 32, 72, 0.2);
            border-radius: 12px;
            padding: 10px 14px;
            display: inline-flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 10px 22px rgba(22, 32, 72, 0.18);
            backdrop-filter: blur(6px);
        }

        .date-time-block {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #0f1a3a;
            font-weight: 700;
        }

        .date-time-divider {
            width: 1px;
            height: 22px;
            background-color: rgba(22, 32, 72, 0.35);
        }

        .date-time-value {
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }

        .dashboard-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title span {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .weather-row {
            justify-content: center;
        }

        .weather-col {
            max-width: none;
            width: 100%;
        }

        .key-metrics {
            justify-content: center;
        }

        .key-metrics .dashboard-card {
            text-align: center;
        }

        .key-metrics .card-icon {
            margin-left: auto;
            margin-right: auto;
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
            flex-wrap: wrap;
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

        .dashboard-card::after {
            content: '';
            display: block;
            height: 4px;
            margin-top: 16px;
            border-radius: 99px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            opacity: 0.15;
        }

        .devis-btn {
            background: white;
            color: var(--bleu-marine);
            border: 1px solid rgba(22, 32, 72, 0.2);
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 6px 16px rgba(22, 32, 72, 0.12);
            text-decoration: none;
        }

        .devis-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(22, 32, 72, 0.18);
            color: var(--bleu-marine);
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

        .weather-updated {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.75);
            margin-top: 10px;
        }

        /* List Styles */
        .list-item {
            padding: 14px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: flex-start;
            border-radius: 12px;
            background: white;
            margin-bottom: 10px;
            box-shadow: 0 6px 14px rgba(22, 32, 72, 0.06);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        }

        .list-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(22, 32, 72, 0.12);
        }

        /* Animation */
        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
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

            .quick-access-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-hero {
                padding: 22px;
            }

            .hero-title {
                font-size: 1.6rem;
            }
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
    @include('partials.app-navbar')

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Page Header -->
        <div class="dashboard-hero animate__animated animate__fadeIn">
            <div class="hero-content">
                <div>
                    <h1 class="hero-title">Tableau de Bord</h1>
                    <p class="hero-subtitle">Vue d'ensemble des chantiers, équipes et équipements.</p>
                </div>
                <div class="hero-actions">
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="https://outlook.live.com/mail/AQMkADAwATYwMAItY2QyYy0xOTU3LTAwAi0wMAoALgAAA1BB2QahD05HtZM3%2FJ5cV6cBACC4Q86sLwdPqrZyfuqWYHoACNbEXwAAAQ%3D%3D" 
                       target="_blank"
                       class="devis-btn">
                        <i class="fas fa-file-invoice-dollar me-2"></i>Voir les Devis
                    </a>
                    @endif
                    <div class="date-time-card">
                        <div class="date-time-block">
                            <i class="fas fa-calendar-alt"></i>
                            <span id="current-date" class="date-time-value">{{ date('d/m/Y') }}</span>
                        </div>
                        <span class="date-time-divider"></span>
                        <div class="date-time-block">
                            <i class="fas fa-clock"></i>
                            <span id="current-time" class="date-time-value">{{ date('H:i:s') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Météo -->
        <div class="dashboard-section">
            <div class="section-title">
                <i class="fas fa-cloud-sun"></i>Météo du jour
                <span>Locale</span>
            </div>
            <div class="row mb-4 weather-row">
            <div class="col-12 weather-col animate__animated animate__fadeIn">
                <div class="row g-3">
                    <!-- Météo actuelle -->
                    <div class="col-lg-12">
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
                                <div class="weather-updated" id="weather-updated">Mise à jour : --:--</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Stats Cards -->
        @if(auth()->user() && auth()->user()->isAdmin())
        <div class="dashboard-section">
            <div class="section-title">
                <i class="fas fa-chart-line"></i>Indicateurs clés
                <span>Cette semaine</span>
            </div>
            <div class="row g-4 mb-5 key-metrics">
            <!-- Chantiers en cours -->
            <div class="col-md-6 col-lg-3 animate__animated animate__fadeIn animate__delay-1s">
                <div class="dashboard-card h-100">
                    <div class="card-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h5 class="card-title">Chantiers en cours</h5>
                    <div class="card-value">{{ $chantiersEnCours ?? '0' }}</div>
                    <p class="card-description">Projets actifs actuellement</p>
                </div>
            </div>

            <!-- Stockage disponible -->
            <div class="col-md-6 col-lg-3 animate__animated animate__fadeIn animate__delay-1s">
                <div class="dashboard-card h-100">
                    <div class="card-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h5 class="card-title">Stockage</h5>
                    <div class="card-value">{{ $equipementsDisponibles ?? '0' }}</div>
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
                    <div class="card-value">{{ $prochainsEvenements ?? '0' }}</div>
                    <p class="card-description">Dans les 7 prochains jours</p>
                </div>
            </div>

            </div>
        </div>
        @endif

        <!-- Derniers Chantiers et Événements -->
        <div class="dashboard-section">
            <div class="section-title">
                <i class="fas fa-layer-group"></i>Activités récentes
                <span>Dernières mises à jour</span>
            </div>
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

                    @if(isset($derniersChantiers) && !$derniersChantiers->isEmpty())
                        @foreach($derniersChantiers as $chantier)
                        <div class="list-item">
                            <div class="list-icon">
                                <i class="fas fa-project-diagram" style="color: var(--bleu-marine);"></i>
                            </div>
                            <div class="list-content">
                                <div class="list-title">{{ $chantier->nom }}</div>
                                <div class="list-description">{{ Str::limit($chantier->adresse, 50) }}</div>
                                <div class="list-meta">
                                    <span><i class="fas fa-user me-1"></i>{{ $chantier->responsable->nom ?? 'Non assigné' }}</span>
                                    <span>
                                        <span class="badge-custom
                                            @if($chantier->statut == 'En cours') badge-en-cours
                                            @elseif($chantier->statut == 'Terminé') badge-termine
                                            @else badge-a-venir @endif">
                                            {{ $chantier->statut }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="list-time">
                                {{ $chantier->created_at ? \Carbon\Carbon::parse($chantier->created_at)->format('d/m/Y') : '--' }}
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">Aucun chantier récent.</p>
                    @endif
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

                    @if(isset($derniersEvenements) && !$derniersEvenements->isEmpty())
                        @foreach($derniersEvenements as $evenement)
                        <div class="list-item">
                            <div class="list-icon">
                                <i class="fas fa-calendar-check" style="color: var(--bleu-marine);"></i>
                            </div>
                            <div class="list-content">
                                <div class="list-title">{{ $evenement->titre }}</div>
                                <div class="list-description">{{ Str::limit($evenement->description, 50) }}</div>
                                <div class="list-meta">
                                    <span><i class="fas fa-user me-1"></i>{{ $evenement->user->nom ?? 'Non assigné' }}</span>
                                    @if($evenement->chantier_id)
                                        <span><i class="fas fa-project-diagram me-1"></i>
                                            {{ $evenement->chantier->nom ?? 'Chantier inconnu' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="list-time">
                                {{ $evenement->date_debut ? \Carbon\Carbon::parse($evenement->date_debut)->format('d/m/Y H:i') : '--' }}
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">Aucun événement à venir.</p>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

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
            const weatherUpdated = document.getElementById('weather-updated');
            const currentTime = document.getElementById('current-time');
            const currentDate = document.getElementById('current-date');

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

                const ok = await fetchWeatherData(currentUrl, true);
                if (!ok) {
                    await fetchOpenMeteo(lat, lon, 'Position actuelle');
                }
            }

            // Récupérer la météo par ville
            async function fetchWeatherByCity(city) {
                const currentUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric&lang=fr`;

                const ok = await fetchWeatherData(currentUrl, true);
                if (!ok) {
                    const fallback = { lat: 48.8566, lon: 2.3522, label: city };
                    await fetchOpenMeteo(fallback.lat, fallback.lon, fallback.label);
                }
            }

            // Récupérer les données météo
            async function fetchWithTimeout(url, timeoutMs = 8000) {
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), timeoutMs);
                try {
                    const response = await fetch(url, { signal: controller.signal });
                    return response;
                } finally {
                    clearTimeout(timeoutId);
                }
            }

            async function fetchWeatherData(url, isCurrent) {
                try {
                    const response = await fetchWithTimeout(url);
                    if (!response.ok) throw new Error('Erreur API');

                    const data = await response.json();

                    if (isCurrent) {
                        updateCurrentWeather(data);
                    }
                    return true;
                } catch (error) {
                    console.error('Erreur fetch:', error);
                    if (isCurrent) return false;
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
                if (weatherUpdated) {
                    const now = new Date();
                    weatherUpdated.textContent = `Mise à jour : ${now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}`;
                }
            }

            function mapOpenMeteo(code) {
                const map = {
                    0: { text: 'ciel dégagé', icon: 'fas fa-sun', color: 'weather-sunny' },
                    1: { text: 'peu nuageux', icon: 'fas fa-cloud-sun', color: 'weather-cloudy' },
                    2: { text: 'partiellement nuageux', icon: 'fas fa-cloud', color: 'weather-cloudy' },
                    3: { text: 'couvert', icon: 'fas fa-cloud', color: 'weather-cloudy' },
                    45: { text: 'brouillard', icon: 'fas fa-smog', color: 'weather-cloudy' },
                    48: { text: 'brouillard givrant', icon: 'fas fa-smog', color: 'weather-cloudy' },
                    51: { text: 'bruine', icon: 'fas fa-cloud-rain', color: 'weather-rainy' },
                    53: { text: 'bruine modérée', icon: 'fas fa-cloud-rain', color: 'weather-rainy' },
                    55: { text: 'bruine dense', icon: 'fas fa-cloud-rain', color: 'weather-rainy' },
                    61: { text: 'pluie faible', icon: 'fas fa-cloud-rain', color: 'weather-rainy' },
                    63: { text: 'pluie modérée', icon: 'fas fa-cloud-showers-heavy', color: 'weather-rainy' },
                    65: { text: 'pluie forte', icon: 'fas fa-cloud-showers-heavy', color: 'weather-rainy' },
                    71: { text: 'neige faible', icon: 'fas fa-snowflake', color: 'weather-snowy' },
                    73: { text: 'neige modérée', icon: 'fas fa-snowflake', color: 'weather-snowy' },
                    75: { text: 'neige forte', icon: 'fas fa-snowflake', color: 'weather-snowy' },
                    80: { text: 'averses faibles', icon: 'fas fa-cloud-rain', color: 'weather-rainy' },
                    81: { text: 'averses modérées', icon: 'fas fa-cloud-showers-heavy', color: 'weather-rainy' },
                    82: { text: 'averses fortes', icon: 'fas fa-cloud-showers-heavy', color: 'weather-rainy' },
                    95: { text: 'orage', icon: 'fas fa-bolt', color: 'weather-stormy' },
                    96: { text: 'orage avec grêle', icon: 'fas fa-bolt', color: 'weather-stormy' },
                    99: { text: 'orage violent', icon: 'fas fa-bolt', color: 'weather-stormy' }
                };
                return map[code] || { text: 'météo inconnue', icon: 'fas fa-cloud', color: 'weather-cloudy' };
            }

            async function fetchOpenMeteo(lat, lon, label) {
                try {
                    const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`;
                    const response = await fetchWithTimeout(url);
                    if (!response.ok) throw new Error('Erreur Open-Meteo');
                    const data = await response.json();
                    if (!data.current_weather) throw new Error('Données météo manquantes');

                    const info = mapOpenMeteo(data.current_weather.weathercode);
                    weatherLocation.textContent = label;
                    weatherTemp.textContent = `${Math.round(data.current_weather.temperature)}°C`;
                    weatherDescription.textContent = info.text;
                    weatherWind.textContent = `${Math.round(data.current_weather.windspeed)} km/h`;
                    weatherHumidity.textContent = '--%';
                    weatherFeelsLike.textContent = '--°C';
                    weatherIcon.innerHTML = `<i class="${info.icon} ${info.color}"></i>`;
                    if (weatherUpdated) {
                        const now = new Date();
                        weatherUpdated.textContent = `Mise à jour : ${now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}`;
                    }
                    return true;
                } catch (error) {
                    console.error('Erreur Open-Meteo:', error);
                    return false;
                }
            }

            // Afficher une erreur
            function showWeatherError(message = 'Impossible de charger les données météo') {
                weatherLocation.textContent = 'Erreur de connexion';
                weatherTemp.textContent = '--°C';
                weatherDescription.textContent = message;
                weatherIcon.innerHTML = '<i class="fas fa-exclamation-triangle weather-cloudy"></i>';
            }

            // Mettre à jour la date et l'heure en temps réel
            function updateDateTime() {
                const now = new Date();
                if (currentTime) {
                    const timeString = now.toLocaleTimeString('fr-FR', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });
                    currentTime.textContent = timeString;
                }
                if (currentDate) {
                    const dateString = now.toLocaleDateString('fr-FR', {
                        weekday: 'long',
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    currentDate.textContent = dateString;
                }
            }

            // Initialiser
            if (!API_KEY || API_KEY.trim().length < 10) {
                const fallback = { lat: 48.8566, lon: 2.3522, label: DEFAULT_CITY };
                fetchOpenMeteo(fallback.lat, fallback.lon, fallback.label).then((ok) => {
                    if (!ok) showWeatherError('Clé météo manquante');
                });
            } else {
                getCurrentWeather();
            }
            updateDateTime();
            setInterval(updateDateTime, 1000);
            setInterval(() => {
                if (API_KEY && API_KEY.trim().length >= 10) {
                    getCurrentWeather();
                } else {
                    const fallback = { lat: 48.8566, lon: 2.3522, label: DEFAULT_CITY };
                    fetchOpenMeteo(fallback.lat, fallback.lon, fallback.label);
                }
            }, 600000);
            setInterval(() => {
                if (API_KEY && API_KEY.trim().length >= 10) {
                    getCurrentWeather();
                }
            }, 600000);

            // Option: Bouton pour actualiser la météo manuellement
            if (weatherLocation) {
                weatherLocation.style.cursor = 'pointer';
                weatherLocation.title = 'Cliquer pour actualiser la météo';
                weatherLocation.addEventListener('click', () => {
                    weatherLocation.innerHTML = '<i class="fas fa-sync-alt fa-spin me-2"></i>Actualisation...';
                    getCurrentWeather();
                });
            }

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
    @include('partials.app-scripts')
</body>
</html>


