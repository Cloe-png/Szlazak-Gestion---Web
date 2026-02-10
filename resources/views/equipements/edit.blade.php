<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Stockage - Szlazak Gestion</title>
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

        .form-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-top: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(22, 32, 72, 0.3);
            color: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 0.25rem rgba(22, 32, 72, 0.25);
        }

        .equipment-info {
            background-color: rgba(22, 32, 72, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid var(--bleu-clair);
        }

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

    <main class="container py-5">
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-edit me-3"></i>Modifier le Stockage</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Mettez à jour les informations de l'équipement</p>
                </div>
                <a href="{{ route('equipements.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">

            <div class="equipment-info">
                <strong>Référence :</strong> #EQ{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}<br>
                <strong>Dernière modification :</strong> {{ $equipement->updated_at ? $equipement->updated_at->format('d/m/Y à H:i') : '--' }}
            </div>

            <form action="{{ route('equipements.update', $equipement->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 form-group-custom">
                        <label for="nom">Nom de l'élément</label>
                        <input type="text" class="form-control" id="nom" name="nom"
                               value="{{ old('nom', $equipement->nom) }}" required>
                    </div>
                    
                    <div class="col-md-6 form-group-custom">
                        <label for="quantite">Quantité</label>
                        <input type="number" class="form-control" id="quantite" name="quantite"
                               value="{{ old('quantite', $equipement->quantite) }}" min="1" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 form-group-custom">
                        <label for="date_achat">Date d'achat</label>
                        <input type="date" class="form-control" id="date_achat" name="date_achat"
                               value="{{ old('date_achat', $equipement->date_achat) }}">
                    </div>
                    
                    <div class="col-md-6 form-group-custom">
                        <label for="etat">État</label>
                        <select class="form-select" id="etat" name="etat" required>
                            <option value="Neuf" {{ old('etat', $equipement->etat) == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                            <option value="Bon état" {{ old('etat', $equipement->etat) == 'Bon état' ? 'selected' : '' }}>Bon état</option>
                            <option value="Usé" {{ old('etat', $equipement->etat) == 'Usé' ? 'selected' : '' }}>Usé</option>
                            <option value="En maintenance" {{ old('etat', $equipement->etat) == 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group-custom">
                    <label for="localisation">Localisation</label>
                    <input type="text" class="form-control" id="localisation" name="localisation"
                           value="{{ old('localisation', $equipement->localisation) }}">
                </div>
                
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('equipements.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-1"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Si le champ date_achat est vide, mettre la date d'aujourd'hui
            const dateAchatField = document.getElementById('date_achat');
            if (dateAchatField && !dateAchatField.value) {
                const today = new Date().toISOString().split('T')[0];
                dateAchatField.value = today;
            }
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


