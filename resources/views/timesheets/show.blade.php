<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Fiche d'Heures - Szlazak Gestion</title>
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

        .info-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .info-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-value {
            color: var(--text-primary);
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .info-value:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .badge-zone-detail {
            background: linear-gradient(135deg, #6f42c1 0%, #8e44ad 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
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
                    <h1><i class="fas fa-file-invoice me-3"></i>Fiche d'Heures #{{ $timesheet->id }}</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Détails de la fiche d'heures</p>
                </div>
                <div>
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('timesheets.edit', $timesheet) }}" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('users.show', $timesheet->user_id) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour au profil
                    </a>
                    @else
                    <a href="{{ route('timesheets.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux fiches
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="info-card animate__animated animate__fadeIn animate__delay-1s">
            <div class="row">
                <div class="col-md-6">
                    <div class="info-label">
                        <i class="fas fa-calendar-alt"></i>
                        Date de travail
                    </div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($timesheet->date_travail)->format('d/m/Y') }}
                        <small class="text-muted ms-2">({{ $timesheet->jour }})</small>
                    </div>

                    <div class="info-label">
                        <i class="fas fa-clock"></i>
                        Horaires
                    </div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($timesheet->heure_debut)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($timesheet->heure_fin)->format('H:i') }}
                    </div>

                    <div class="info-label">
                        <i class="fas fa-utensils"></i>
                        Pause déjeuner
                    </div>
                    <div class="info-value">
                        @if($timesheet->pause)
                            <span class="badge bg-success">Oui (1h)</span>
                        @else
                            <span class="badge bg-secondary">Non</span>
                        @endif
                    </div>

                    <div class="info-label">
                        <i class="fas fa-basket-shopping"></i>
                        Panier
                    </div>
                    <div class="info-value">
                        @if($timesheet->panier)
                            <span class="badge bg-success">Oui</span>
                        @else
                            <span class="badge bg-secondary">Non</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-label">
                        <i class="fas fa-user"></i>
                        Travailleur
                    </div>
                    <div class="info-value">
                        {{ $timesheet->user->nom }}
                        <small class="text-muted ms-2">({{ $timesheet->user->role->nom }})</small>
                    </div>

                    <div class="info-label">
                        <i class="fas fa-hard-hat"></i>
                        Chantier
                    </div>
                    <div class="info-value">
                        {{ $timesheet->chantier->nom }}
                        <small class="text-muted ms-2">({{ $timesheet->chantier->statut }})</small>
                    </div>

                    <div class="info-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Zone de travail
                    </div>
                    <div class="info-value">
                        @if($timesheet->zone)
                            <span class="badge badge-zone-detail">Zone {{ $timesheet->zone }}</span>
                        @else
                            <span class="text-muted">Non définie</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Calcul des heures -->
            <div class="row mt-4 pt-4 border-top">
                <div class="col-md-3 text-center">
                    <div class="info-label">Heures normales</div>
                    <div class="display-6 text-primary">{{ $timesheet->heures_travaillees }}h</div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="info-label">Heures supplémentaires</div>
                    <div class="display-6 text-warning">{{ $timesheet->heures_supp }}h</div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="info-label">Total heures</div>
                    <div class="display-6 text-success">{{ $timesheet->total_heures }}h</div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="info-label">Coût estimé</div>
                    <div class="display-6 text-info">
                        @if($timesheet->chantier->tarif)
                            {{ number_format($timesheet->chantier->tarif * $timesheet->total_heures, 2, ',', ' ') }} ‚¬
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="row mt-4 pt-4 border-top">
                <div class="col-md-6">
                    <div class="info-label">
                        <i class="fas fa-calendar-plus"></i>
                        Créé le
                    </div>
                    <div class="info-value">
                        {{ $timesheet->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">
                        <i class="fas fa-calendar-check"></i>
                        Dernière modification
                    </div>
                    <div class="info-value">
                        {{ $timesheet->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user() && auth()->user()->isAdmin())
        <!-- Actions -->
        <div class="d-flex justify-content-between">
            <form action="{{ route('timesheets.destroy', $timesheet) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" 
                        onclick="return confirm('Supprimer définitivement cette fiche d\'heures ?')">
                    <i class="fas fa-trash me-2"></i>Supprimer
                </button>
            </form>
            
            <div>
                <a href="{{ route('timesheets.edit', $timesheet) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <a href="{{ route('timesheets.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-2"></i>Toutes les fiches
                </a>
            </div>
        </div>
        @endif
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>


