<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Stockage - Szlazak Gestion</title>
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
            --etat-bon: #28a745;
            --etat-moyen: #ffc107;
            --etat-mauvais: #dc3545;
            --etat-maintenance: #6c757d;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
            background-color: var(--bg-primary);
        }

        .detail-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .equipment-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .detail-label {
            min-width: 160px;
            font-weight: 600;
            color: var(--bleu-marine);
        }

        .badge-etat {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .etat-bon { background-color: rgba(40, 167, 69, 0.1); color: var(--etat-bon); }
        .etat-moyen { background-color: rgba(255, 193, 7, 0.1); color: var(--etat-moyen); }
        .etat-mauvais { background-color: rgba(220, 53, 69, 0.1); color: var(--etat-mauvais); }
        .etat-maintenance { background-color: rgba(108, 117, 125, 0.1); color: var(--etat-maintenance); }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1><i class="fas fa-info-circle me-3"></i>Détails du Stockage</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Consultez les informations détaillées</p>
                </div>
                <div class="d-flex gap-2">
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('equipements.edit', $equipement->id) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                    @endif
                    @if(auth()->user() && !auth()->user()->isAdmin())
                    <a href="{{ route('equipements.loans.create', ['equipement_id' => $equipement->id]) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-hand-holding me-2"></i>Emprunter
                    </a>
                    @endif
                    <a href="{{ route('equipements.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </div>
        </div>

        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="equipment-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div>
                    <h2 class="mb-1">{{ $equipement->nom }}</h2>
                    <div class="text-muted">#EQ{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-boxes me-2"></i>Quantité</div>
                <div>{{ $equipement->quantite }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-map-marker-alt me-2"></i>Localisation</div>
                <div>{{ $equipement->localisation ?? 'Non spécifiée' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-info-circle me-2"></i>État</div>
                <div>
                    <span class="badge-etat 
                        @if($equipement->etat == 'Bon état' || $equipement->etat == 'Neuf') etat-bon
                        @elseif($equipement->etat == 'Usé') etat-moyen
                        @elseif($equipement->etat == 'En maintenance') etat-maintenance
                        @else etat-mauvais @endif">
                        {{ $equipement->etat ?? 'Non spécifié' }}
                    </span>
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label"><i class="fas fa-calendar-day me-2"></i>Date d'achat</div>
                <div>{{ $equipement->date_achat ? \Carbon\Carbon::parse($equipement->date_achat)->format('d/m/Y') : 'Non spécifiée' }}</div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>
