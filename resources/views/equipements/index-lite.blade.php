<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockage - Szlazak Gestion</title>
    @include('partials.app-head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bleu-marine: #162048;
            --bleu-clair: #1e2a66;
            --bg-primary: #f8f9fa;
            --text-primary: #212529;
            --border-color: #dee2e6;
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
            background-color: var(--bg-primary);
        }

        .page-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        .page-header h1 { color: white; margin-bottom: 0; }

        .card-lite {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            height: 100%;
        }

        .label { color: #6c757d; font-size: 0.85rem; }
    </style>
</head>
<body>
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-tools me-3"></i>Stockage</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Matériel disponible</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('equipements.loans') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-boxes-stacked me-2"></i>Mes emprunts
                    </a>
                    <a href="{{ route('equipements.loans.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-hand-holding me-2"></i>Emprunter
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($equipements as $equipement)
            <div class="col-lg-4 col-md-6">
                <div class="card-lite">
                    <h5 class="mb-2">{{ $equipement->nom }}</h5>
                    <div class="mb-2">
                        <span class="label">Quantité</span>
                        <div>{{ $equipement->quantite }}</div>
                    </div>
                    <div class="mb-2">
                        <span class="label">Localisation</span>
                        <div>{{ $equipement->localisation ?? '—' }}</div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('equipements.show', $equipement->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Voir
                        </a>
                        <a href="{{ route('equipements.loans.create', ['equipement_id' => $equipement->id]) }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-hand-holding me-1"></i>Emprunter
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun matériel</h4>
                </div>
            </div>
            @endforelse
        </div>
    </main>

    @include('partials.app-footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>