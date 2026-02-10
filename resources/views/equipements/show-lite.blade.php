<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Stockage - Szlazak Gestion</title>
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

        .info-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
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
                    <h1><i class="fas fa-info-circle me-3"></i>Détails du Stockage</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Informations essentielles</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('equipements.loans.create', ['equipement_id' => $equipement->id]) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-hand-holding me-2"></i>Emprunter
                    </a>
                    <a href="{{ route('equipements.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="info-card">
            <h4 class="mb-3">{{ $equipement->nom }}</h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="label">Quantité</div>
                    <div>{{ $equipement->quantite }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="label">Localisation</div>
                    <div>{{ $equipement->localisation ?? '—' }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="label">État</div>
                    <div>{{ $equipement->etat ?? '—' }}</div>
                </div>
            </div>
        </div>
    </main>

    @include('partials.app-footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>