<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Chantier - Szlazak Gestion</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: var(--bg-primary);
            font-family: 'Arial', sans-serif;
            color: var(--text-primary);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--bleu-marine);
        }

        .container-custom {
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 0 15px var(--shadow-color);
            margin-top: 20px;
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
        }

        .btn-custom i {
            margin-right: 8px;
        }

        .form-group-custom {
            margin-bottom: 20px;
        }

        .form-group-custom label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--bleu-marine);
        }

        .form-group-custom .form-control {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            transition: border-color var(--transition-speed) ease;
        }

        .form-group-custom .form-control:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 0.25rem rgba(22, 32, 72, 0.1);
        }

        .form-group-custom .form-select {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            transition: border-color var(--transition-speed) ease;
        }

        .form-group-custom .form-select:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 0.25rem rgba(22, 32, 72, 0.1);
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }
    </style>
           <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="fas fa-hard-hat me-2"></i>
                <span>Szlazak</span>
                <small class="text-muted ms-1">Gestion</small>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chantiers.index') }}">
                            <i class="fas fa-project-diagram me-1"></i>Chantiers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('equipements.index') }}">
                            <i class="fas fa-tools me-1"></i>Équipements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('users.index') }}">
                            <i class="fas fa-users me-1"></i>Équipe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('evenements.index') }}">
                            <i class="fas fa-calendar-alt me-1"></i>Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('timesheets.index') }}">
                            <i class="fas fa-calendar-alt me-1"></i>Fiches d'heures
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->nom ?? 'Szlazak Nicolas' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</head>
<body>
    <div class="container container-custom animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Modifier un Chantier</h1>
            <a href="{{ route('chantiers.index') }}" class="btn-custom">
                <i class="fas fa-arrow-left"></i>Retour
            </a>
        </div>

        <form action="{{ route('chantiers.update', $chantier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label for="nom">Nom du Chantier</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $chantier->nom }}" required>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label for="statut">Statut</label>
                    <select class="form-select" id="statut" name="statut" required>
                        <option value="En cours" {{ $chantier->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                        <option value="À venir" {{ $chantier->statut == 'À venir' ? 'selected' : '' }}>À venir</option>
                        <option value="Terminé" {{ $chantier->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label for="date_debut">Date de Début</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $chantier->date_debut ? $chantier->date_debut->format('Y-m-d') : '' }}">
                </div>

                <div class="col-md-6 form-group-custom">
                    <label for="date_fin">Date de Fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $chantier->date_fin ? $chantier->date_fin->format('Y-m-d') : '' }}">
                </div>

                <div class="col-12 form-group-custom">
                    <label for="adresse">Adresse</label>
                    <textarea class="form-control" id="adresse" name="adresse" rows="3" required>{{ $chantier->adresse }}</textarea>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label for="responsable_id">Responsable</label>
                    <select class="form-select" id="responsable_id" name="responsable_id" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $chantier->responsable_id == $user->id ? 'selected' : '' }}>{{ $user->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-custom">
                    <i class="fas fa-save"></i>Mettre à jour
                </button>
            </div>
        </form>
    </div>
</body>
</html>
