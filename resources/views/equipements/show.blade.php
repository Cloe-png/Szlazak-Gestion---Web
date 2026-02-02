<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Équipement - Szlazak Gestion</title>
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

        .details-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-top: 20px;
        }

        .details-card {
            background: linear-gradient(135deg, rgba(22, 32, 72, 0.05) 0%, rgba(30, 42, 102, 0.05) 100%);
            border-radius: 10px;
            padding: 25px;
            border-left: 4px solid var(--bleu-clair);
        }

        .details-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }

        .details-item {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .details-label {
            font-weight: 600;
            color: var(--bleu-marine);
            min-width: 150px;
        }

        .details-value {
            color: var(--text-primary);
            flex: 1;
        }

        .badge-custom {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-neuf {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-bon-etat {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .badge-use {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-maintenance {
            background-color: #f8d7da;
            color: #721c24;
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
                        <a class="nav-link active" href="{{ route('equipements.index') }}">
                            <i class="fas fa-tools me-1"></i>Équipements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
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
                                <!-- Formulaire de déconnexion -->
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

    <div class="container py-5 animate__animated animate__fadeIn">
        <div class="details-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0" style="color: var(--bleu-marine);">
                    <i class="fas fa-info-circle me-2"></i>Détails de l'Équipement
                </h1>
                <a href="{{ route('equipements.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                </a>
            </div>

            <div class="details-card">
                <div class="details-title">
                    {{ $equipement->nom }}
                </div>
                
                <div class="details-item">
                    <span class="details-label"><i class="fas fa-hashtag me-2"></i>Référence :</span>
                    <span class="details-value">#EQ{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                
                <div class="details-item">
                    <span class="details-label"><i class="fas fa-boxes me-2"></i>Quantité :</span>
                    <span class="details-value">{{ $equipement->quantite }}</span>
                </div>
                
                <div class="details-item">
                    <span class="details-label"><i class="fas fa-calendar-day me-2"></i>Date d'achat :</span>
                    <span class="details-value">{{ $equipement->date_achat ? \Carbon\Carbon::parse($equipement->date_achat)->format('d/m/Y') : 'Non spécifiée' }}</span>
                </div>
                
                <div class="details-item">
                    <span class="details-label"><i class="fas fa-cl