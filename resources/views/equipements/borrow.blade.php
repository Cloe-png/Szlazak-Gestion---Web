<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunter un Matériel - Szlazak Gestion</title>
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

        .page-header h1 {
            color: white;
            margin-bottom: 0;
        }

        .form-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }
    </style>
</head>
<body>
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-hand-holding me-3"></i>Emprunter un Matériel</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Enregistrez un nouvel emprunt</p>
                </div>
                <a href="{{ route('equipements.loans') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux emprunts
                </a>
            </div>
        </div>

        <div class="form-card">
            <form action="{{ route('equipements.loans.store') }}" method="POST">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-tools me-2"></i>Matériel *
                        </label>
                        <select name="equipement_id" class="form-select" required>
                            <option value="">Sélectionnez un matériel</option>
                            @foreach($equipements as $equipement)
                                <option value="{{ $equipement->id }}" {{ old('equipement_id', $selectedEquipement) == $equipement->id ? 'selected' : '' }}>
                                    {{ $equipement->nom }} (Stock: {{ $equipement->quantite }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-hammer me-2"></i>Chantier (optionnel)
                        </label>
                        <select name="chantier_id" class="form-select">
                            <option value="">Aucun chantier</option>
                            @foreach($chantiers as $chantier)
                                <option value="{{ $chantier->id }}" {{ old('chantier_id') == $chantier->id ? 'selected' : '' }}>
                                    {{ $chantier->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-layer-group me-2"></i>Quantité *
                        </label>
                        <input type="number" name="quantite" class="form-control" min="1"
                               value="{{ old('quantite', 1) }}" required>
                        @error('quantite')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer l'emprunt
                    </button>
                </div>
            </form>
        </div>
    </main>

    @include('partials.app-footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>
