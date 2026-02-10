<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $evenement->titre }} - Szlazak Gestion</title>
    @include('partials.app-head')
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
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

        /* Carte de détails */
        .detail-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-a-venir { background-color: rgba(52, 152, 219, 0.1); color: #3498db; }
        .status-en-cours { background-color: rgba(46, 204, 113, 0.1); color: #2ecc71; }
        .status-termine { background-color: rgba(149, 165, 166, 0.1); color: #95a5a6; }
        .status-annule { background-color: rgba(231, 76, 60, 0.1); color: #e74c3c; }

        .info-grid {
            display: grid;
            gap: 20px;
            margin-top: 25px;
        }

        .info-item {
            padding: 15px;
            background-color: var(--bg-primary);
            border-radius: 8px;
            border-left: 4px solid var(--bleu-clair);
        }

        .info-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-value {
            color: var(--text-primary);
            font-size: 1rem;
            line-height: 1.5;
        }

        .info-value.empty {
            color: var(--text-secondary);
            font-style: italic;
        }

        .description-box {
            background-color: var(--bg-primary);
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid var(--bleu-clair);
        }

        .timeline-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-top: 30px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: var(--border-color);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
            padding-left: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--bleu-clair);
            border: 3px solid white;
            box-shadow: 0 0 0 3px var(--border-color);
        }

        .timeline-date {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .timeline-content {
            background-color: var(--bg-secondary);
            padding: 12px 15px;
            border-radius: 8px;
            border-left: 3px solid var(--bleu-clair);
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
                    <h1><i class="fas fa-calendar-alt me-3"></i>{{ $evenement->titre }}</h1>
                    <div class="d-flex align-items-center mt-2" style="opacity: 0.9;">
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $evenement->statut)) }}">
                            {{ $evenement->statut }}
                        </span>
                        <span class="ms-3"><i class="fas fa-hashtag me-1"></i>#EV{{ str_pad($evenement->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
                <a href="{{ route('evenements.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'agenda
                </a>
            </div>
        </div>

        <!-- Détails de l'événement -->
        <div class="detail-card animate__animated animate__fadeIn animate__delay-1s">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-clock"></i>
                        Date et heure
                    </div>
                    <div class="info-value">
                        <strong>Début:</strong> {{ \Carbon\Carbon::parse($evenement->date_debut)->format('d/m/Y H:i') }}<br>
                        @if($evenement->date_fin)
                            <strong>Fin:</strong> {{ \Carbon\Carbon::parse($evenement->date_fin)->format('d/m/Y H:i') }}<br>
                            @php
                                $debut = \Carbon\Carbon::parse($evenement->date_debut);
                                $fin = \Carbon\Carbon::parse($evenement->date_fin);
                                $duree = $debut->diff($fin);
                            @endphp
                            <strong>Durée:</strong> 
                            @if($duree->days > 0)
                                {{ $duree->days }} jour{{ $duree->days > 1 ? 's' : '' }}
                            @endif
                            {{ $duree->h > 0 ? $duree->h . ' heure' . ($duree->h > 1 ? 's' : '') : '' }}
                            {{ $duree->i > 0 ? $duree->i . ' minute' . ($duree->i > 1 ? 's' : '') : '' }}
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-user-tie"></i>
                                Responsable
                            </div>
                            <div class="info-value">
                                {{ $evenement->user->nom ?? 'Non assigné' }}
                                @if($evenement->user && $evenement->user->email)
                                    <small class="d-block text-muted">{{ $evenement->user->email }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-project-diagram"></i>
                                Chantier associé
                            </div>
                            <div class="info-value">
                                @if($evenement->chantier)
                                    {{ $evenement->chantier->nom }}
                                    <small class="d-block text-muted">{{ $evenement->chantier->adresse }}</small>
                                @else
                                    <span class="empty">Aucun chantier associé</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($evenement->description)
                <div class="description-box">
                    <div class="info-label">
                        <i class="fas fa-align-left"></i>
                        Description
                    </div>
                    <div class="info-value" style="white-space: pre-line;">
                        {{ $evenement->description }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Métadonnées -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-plus"></i>
                            Date de création
                        </div>
                        <div class="info-value">
                            {{ $evenement->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-check"></i>
                            Dernière mise à jour
                        </div>
                        <div class="info-value">
                            {{ $evenement->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline de l'événement -->
        <div class="timeline-container animate__animated animate__fadeIn animate__delay-2s">
            <h5 class="mb-4" style="color: var(--bleu-marine);">
                <i class="fas fa-history me-2"></i>Historique de l'événement
            </h5>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ $evenement->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Événement créé</strong>
                        <p class="mb-0">Par {{ $evenement->user->nom ?? 'système' }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ $evenement->date_debut->format('d/m/Y H:i') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Début prévu</strong>
                        <p class="mb-0">Date de début planifiée</p>
                    </div>
                </div>
                @if($evenement->date_fin)
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ $evenement->date_fin->format('d/m/Y H:i') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Fin prévue</strong>
                        <p class="mb-0">Date de fin planifiée</p>
                    </div>
                </div>
                @endif
                @if($evenement->statut == 'Terminé')
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ $evenement->updated_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Événement terminé</strong>
                        <p class="mb-0">Statut modifié à "Terminé"</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Bouton de retour -->
        <div class="action-buttons animate__animated animate__fadeIn animate__delay-3s">
            <a href="{{ route('evenements.index') }}" class="btn-primary-custom">
                <i class="fas fa-arrow-left me-2"></i>Retour à l'agenda
            </a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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


