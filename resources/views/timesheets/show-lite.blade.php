<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Fiche d'Heures - Szlazak Gestion</title>
    @include('partials.app-head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-file-invoice me-3"></i>Fiche d'Heures #{{ $timesheet->id }}</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Détails de la fiche d'heures</p>
                </div>
                <div>
                    <a href="{{ route('timesheets.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux fiches
                    </a>
                </div>
            </div>
        </div>

        <div class="info-card">
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

            <div class="row mt-4 pt-4 border-top">
                <div class="col-md-4 text-center">
                    <div class="info-label">Heures normales</div>
                    <div class="display-6 text-primary">{{ $timesheet->heures_travaillees }}h</div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="info-label">Heures supplémentaires</div>
                    <div class="display-6 text-warning">{{ $timesheet->heures_supp }}h</div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="info-label">Total heures</div>
                    <div class="display-6 text-success">{{ $timesheet->total_heures }}h</div>
                </div>
            </div>
        </div>
    </main>

    @include('partials.app-footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>
