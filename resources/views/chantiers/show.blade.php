<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Chantier - Szlazak Gestion</title>
    @include('partials.app-head')
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Leaflet CSS pour la carte -->
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
            --progress-completed: #28a745;
            --progress-in-progress: #007bff;
            --progress-pending: #ffc107;
        }

        body {
            background-color: var(--bg-primary);
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
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
            z-index: 1000;
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
            padding: 25px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        .page-header h1 {
            color: white;
            margin-bottom: 0;
        }

        .container-custom {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            margin-bottom: 30px;
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Boutons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
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

        .btn-primary-custom i {
            margin-right: 8px;
        }

        .btn-outline-custom {
            background-color: white;
            color: var(--bleu-marine);
            border: 2px solid var(--bleu-marine);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--bleu-marine);
            color: white;
            transform: translateY(-2px);
        }

        /* Cartes d'information */
        .info-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px var(--shadow-color);
            border: 1px solid var(--border-color);
            height: 100%;
            transition: transform var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px var(--shadow-color);
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 15px;
        }

        /* Badges */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .badge-en-cours { background-color: rgba(0, 123, 255, 0.1); color: #007bff; border: 1px solid rgba(0, 123, 255, 0.2); }
        .badge-termine { background-color: rgba(40, 167, 69, 0.1); color: #28a745; border: 1px solid rgba(40, 167, 69, 0.2); }
        .badge-a-venir { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.2); }
        .badge-annule { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; border: 1px solid rgba(220, 53, 69, 0.2); }

        /* Carte Leaflet */
        #map {
            height: 300px;
            border-radius: 8px;
            margin-top: 15px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .leaflet-popup-content {
            font-family: 'Roboto', sans-serif;
        }

        /* Liste des informations */
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-icon {
            width: 24px;
            color: var(--bleu-marine);
            margin-right: 10px;
            text-align: center;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-weight: 500;
            color: var(--bleu-marine);
            font-size: 0.9rem;
            margin-bottom: 3px;
        }

        .info-value {
            color: var(--text-primary);
            font-size: 1rem;
        }

        .table-custom th {
            background-color: var(--bg-secondary);
            color: var(--bleu-marine);
            font-weight: 600;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid var(--border-color);
        }

        .table-custom td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-custom tr:hover {
            background-color: var(--highlight-color);
        }

        /* Actions */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn-action {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-view { background-color: rgba(22, 32, 72, 0.1); color: var(--bleu-marine); }
        .btn-view:hover { background-color: var(--bleu-marine); color: white; }

        .btn-edit { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .btn-edit:hover { background-color: #ffc107; color: white; }

        .btn-delete { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .btn-delete:hover { background-color: #dc3545; color: white; }

        .btn-add { background-color: rgba(40, 167, 69, 0.1); color: #28a745; }
        .btn-add:hover { background-color: #28a745; color: white; }

        /* Responsive */
        @media (max-width: 768px) {
            .container-custom {
                padding: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            #map {
                height: 250px;
            }
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

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.app-navbar')

    <!-- Main Content -->
    <main class="container py-5">
        <!-- En-tête avec navigation -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <a href="{{ route('chantiers.index') }}" class="text-white me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="mb-0">Détails du Chantier</h1>
                    </div>
                    <p class="mb-0" style="opacity: 0.9;">#CH{{ str_pad($chantier->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <span class="badge-custom 
                        @if($chantier->statut == 'En cours') badge-en-cours
                        @elseif($chantier->statut == 'Terminé') badge-termine
                        @elseif($chantier->statut == 'À venir') badge-a-venir
                        @else badge-annule @endif">
                        {{ $chantier->statut }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="action-buttons animate__animated animate__fadeIn animate__delay-1s">
            <a href="{{ route('chantiers.edit', $chantier->id) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <form action="{{ route('chantiers.destroy', $chantier->id) }}" method="POST" class="d-inline" id="deleteForm">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-action btn-delete" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </form>
        </div>

        <!-- Grille principale -->
        <div class="row g-4 mb-4">
            <!-- Informations principales -->
            <div class="col-lg-8">
                <div class="container-custom animate__animated animate__fadeIn animate__delay-2s">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3>{{ $chantier->nom }}</h3>
                            <p class="text-muted mb-0">{{ $chantier->description ?? 'Aucune description' }}</p>
                        </div>
                    </div>

                    <!-- Détails en grille -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="card-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h6 class="card-title">Dates</h6>
                                <ul class="info-list">
                                    <li class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Date de début</div>
                                            <div class="info-value">
                                                {{ $chantier->date_debut ? \Carbon\Carbon::parse($chantier->date_debut)->format('d/m/Y') : 'Non définie' }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-flag-checkered"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Date de fin prévue</div>
                                            <div class="info-value">
                                                {{ $chantier->date_fin ? \Carbon\Carbon::parse($chantier->date_fin)->format('d/m/Y') : 'Non définie' }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Durée estimée</div>
                                            <div class="info-value">
                                                @if($chantier->date_debut && $chantier->date_fin)
                                                    {{ \Carbon\Carbon::parse($chantier->date_debut)->diffInDays($chantier->date_fin) }} jours
                                                @else
                                                    Non définie
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if(auth()->user() && auth()->user()->isAdmin())
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="card-icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <h6 class="card-title">Attribué à</h6>
                                @if(!empty($assignees) && count($assignees) > 0)
                                    <div class="table-responsive">
                                        <table class="table-custom">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($assignees as $assignee)
                                                    <tr>
                                                        <td>{{ $assignee->id }}</td>
                                                        <td>{{ $assignee->nom }}</td>
                                                        <td>{{ $assignee->email }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted mb-0">Aucun employé attribué.</p>
                                @endif
                            </div>
                        </div>                        @endif


                    </div>

                    <!-- Tarif -->
                        <div class="info-card mt-4">
                        <div class="card-icon">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                        <h6 class="card-title">Tarif</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center p-3">
                                    <div class="h5 mb-1" style="color: var(--bleu-marine);">
                                        {{ $chantier->tarif ? number_format($chantier->tarif, 2, ',', ' ') . ' €' : 'Non défini' }}
                                    </div>
                                    <div class="text-muted">Tarif total</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Commentaire admin -->
                    <div class="info-card mt-4">
                        <div class="card-icon">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <h6 class="card-title">Commentaire admin</h6>
                        <div class="text-muted" style="white-space: pre-line;">
                            {{ $chantier->commentaire ?: 'Aucun commentaire' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte et informations complémentaires -->
            <div class="col-lg-4">
                <!-- Carte de localisation -->
                <div class="container-custom animate__animated animate__fadeIn animate__delay-2s">
                    <h5 class="mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>Localisation
                    </h5>
                    <div id="map"></div>
                    <div class="mt-3">
                        <p class="mb-2"><strong>Adresse :</strong></p>
                        <p class="text-muted">{{ $chantier->adresse ?? 'Adresse non renseignée' }}</p>
                        @if($chantier->code_postal || $chantier->ville)
                        <p class="text-muted mb-0">
                            {{ $chantier->code_postal ?? '' }} {{ $chantier->ville ?? '' }}
                        </p>
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
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser la carte
            const map = L.map('map').setView([48.8566, 2.3522], 6); // France par défaut

            // Ajouter la couche OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            // Géocoder l'adresse pour obtenir les coordonnées
            function geocodeAddress(address) {
                if (!address || address.trim() === '') {
                    console.log('Aucune adresse à géocoder');
                    return;
                }
                
                const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`;
                
                console.log('Géocodage de l\'adresse:', address);
                
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const lat = parseFloat(data[0].lat);
                            const lon = parseFloat(data[0].lon);
                            
                            console.log('Coordonnées trouvées:', lat, lon);
                            
                            // Centrer la carte sur l'adresse
                            map.setView([lat, lon], 15);
                            
                            // Ajouter un marqueur
                            const marker = L.marker([lat, lon]).addTo(map);
                            marker.bindPopup(`
                                <strong>{{ $chantier->nom }}</strong><br>
                                {{ $chantier->adresse }}
                            `).openPopup();
                            
                            // Ajouter un cercle autour du marqueur
                            L.circle([lat, lon], {
                                color: '#162048',
                                fillColor: '#1e2a66',
                                fillOpacity: 0.1,
                                radius: 200
                            }).addTo(map);
                        } else {
                            console.log('Aucune coordonnée trouvée pour cette adresse');
                            showDefaultMap();
                        }
                    })
                    .catch(error => {
                        console.error('Erreur de géocodage:', error);
                        showDefaultMap();
                    });
            }

            // Fonction pour afficher la carte par défaut
            function showDefaultMap() {
                map.setView([48.8566, 2.3522], 5);
                L.marker([48.8566, 2.3522]).addTo(map)
                    .bindPopup('Impossible de localiser cette adresse')
                    .openPopup();
            }

            // Géocoder l'adresse du chantier au chargement
            const address = "{{ $chantier->adresse ?? '' }}";
            if (address) {
                geocodeAddress(address);
            } else {
                showDefaultMap();
            }

            // Animation des éléments
            const animateElements = document.querySelectorAll('.animate-fade-in');
            animateElements.forEach(element => {
                element.style.animationPlayState = 'running';
            });

            // Confirmation de suppression
            window.confirmDelete = function() {
                if (confirm('Êtes-vous sûr de vouloir supprimer ce chantier ? Cette action est irréversible.')) {
                    document.getElementById('deleteForm').submit();
                }
            };

            // Météo pour l'adresse du chantier (optionnel)
            function getWeatherForAddress() {
                const apiKey = '1c07c7c65f64a4db0d696c4b495b6c06';
                const city = "{{ $chantier->ville ?? 'Paris' }}";
                
                if (!city) return;
                
                const url = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)}&appid=${apiKey}&units=metric&lang=fr`;
                
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.main) {
                            console.log('Météo chargée:', data);
                        }
                    })
                    .catch(error => console.error('Erreur météo:', error));
            }

        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


