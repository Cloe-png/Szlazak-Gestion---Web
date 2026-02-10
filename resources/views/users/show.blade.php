<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->nom ?? 'Utilisateur' }} - Profil - Szlazak Gestion</title>
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
            --role-admin: #3498db;
            --role-chef: #2ecc71;
            --role-ouvrier: #f39c12;
            --role-apprenti: #9b59b6;
            --role-interimaire: #95a5a6;
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

        /* Profil */
        .profile-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
            margin-right: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
            position: relative;
            overflow: hidden;
        }

        .profile-avatar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.2) 100%);
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .profile-id {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .role-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
        }

        .role-admin { background-color: rgba(52, 152, 219, 0.1); color: var(--role-admin); border: 1px solid rgba(52, 152, 219, 0.2); }
        .role-chef { background-color: rgba(46, 204, 113, 0.1); color: var(--role-chef); border: 1px solid rgba(46, 204, 113, 0.2); }
        .role-ouvrier { background-color: rgba(243, 156, 18, 0.1); color: var(--role-ouvrier); border: 1px solid rgba(243, 156, 18, 0.2); }
        .role-apprenti { background-color: rgba(155, 89, 182, 0.1); color: var(--role-apprenti); border: 1px solid rgba(155, 89, 182, 0.2); }
        .role-interimaire { background-color: rgba(149, 165, 166, 0.1); color: var(--role-interimaire); border: 1px solid rgba(149, 165, 166, 0.2); }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin: 25px 0;
            padding: 20px;
            background-color: var(--bg-primary);
            border-radius: 8px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px var(--shadow-color);
            transition: transform var(--transition-speed) ease;
        }

        .stat-item:hover {
            transform: translateY(-3px);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--bleu-marine);
            margin-bottom: 5px;
            display: block;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .stat-icon {
            font-size: 1.5rem;
            color: var(--bleu-clair);
            margin-bottom: 10px;
            display: block;
        }

        .info-grid {
            display: grid;
            gap: 20px;
            margin-top: 25px;
        }

        .info-item {
            padding: 20px;
            background-color: var(--bg-primary);
            border-radius: 8px;
            border-left: 4px solid var(--bleu-clair);
            transition: all var(--transition-speed) ease;
        }

        .info-item:hover {
            background-color: var(--highlight-color);
            transform: translateX(5px);
        }

        .info-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 10px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-value {
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .info-value.empty {
            color: var(--text-secondary);
            font-style: italic;
        }

        /* Timeline */
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
            font-size: 0.9rem;
        }

        .timeline-content {
            background-color: var(--bg-secondary);
            padding: 12px 15px;
            border-radius: 8px;
            border-left: 3px solid var(--bleu-clair);
        }

        .timeline-content strong {
            color: var(--bleu-marine);
        }

        /* Action Buttons */
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

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <!-- Header -->
    @include('partials.app-navbar')

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Messages de succès -->
        <!-- Page Header -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-user me-3"></i>Profil du Membre</h1>
                    <div class="d-flex align-items-center mt-2" style="opacity: 0.9;">
                        <span class="role-badge role-{{ strtolower(str_replace(' ', '-', $user->role->nom)) }}">
                            <i class="fas fa-{{ 
                                $user->role->nom == 'Administrateur' ? 'user-shield' : 
                                ($user->role->nom == 'Chef de chantier' ? 'hard-hat' : 
                                ($user->role->nom == 'Ouvrier' ? 'tools' : 
                                ($user->role->nom == 'Apprenti' ? 'user-graduate' : 'clock'))) 
                            }} me-2"></i>
                            {{ $user->role->nom }}
                        </span>
                        <span class="ms-3"><i class="fas fa-hashtag me-1"></i>#EM{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'équipe
                </a>
            </div>
        </div>

        <!-- Carte de profil -->
        <div class="profile-card animate__animated animate__fadeIn animate__delay-1s">
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ substr($user->nom, 0, 2) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $user->nom }}</div>
                    <div class="profile-id">Membre de l'équipe Szlazak</div>
                </div>
            </div>
            
            <!-- Statistiques -->
            <div class="profile-stats">
                <div class="stat-item">
                    <i class="fas fa-hard-hat stat-icon"></i>
                    <div class="stat-value">{{ $stats['chantiers_count'] ?? 0 }}</div>
                    <div class="stat-label">Chantiers</div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-clock stat-icon"></i>
                    <div class="stat-value">{{ $stats['total_heures'] ?? 0 }}h</div>
                    <div class="stat-label">Heures totales</div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-calendar-day stat-icon"></i>
                    <div class="stat-value">{{ $stats['jours_travailles'] ?? 0 }}</div>
                    <div class="stat-label">Jours travaillés</div>
                </div>
                <div class="stat-item">
                    <i class="fas fa-plus-circle stat-icon text-warning"></i>
                    <div class="stat-value">{{ $stats['heures_supp_total'] ?? 0 }}h</div>
                    <div class="stat-label">Heures supp</div>
                </div>
            </div>
            
            <!-- Informations détaillées -->
            <div class="info-grid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-envelope"></i>
                                Adresse email
                            </div>
                            <div class="info-value">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-user-tag"></i>
                                Rôle principal
                            </div>
                            <div class="info-value">
                                <span class="role-badge role-{{ strtolower(str_replace(' ', '-', $user->role->nom)) }}">
                                    {{ $user->role->nom }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($user->telephone)
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-phone"></i>
                        Téléphone
                    </div>
                    <div class="info-value">
                        {{ $user->telephone }}
                        <a href="tel:{{ $user->telephone }}" class="btn btn-sm btn-outline-success ms-2">
                            <i class="fas fa-phone-alt"></i>
                        </a>
                    </div>
                </div>
                @endif

                @if($user->adresse)
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Adresse postale
                    </div>
                    <div class="info-value">
                        {{ $user->adresse }}
                        <a href="https://maps.google.com/?q={{ urlencode($user->adresse) }}" 
                           target="_blank" class="btn btn-sm btn-outline-info ms-2">
                            <i class="fas fa-map"></i>
                        </a>
                    </div>
                </div>
                @endif

                @if($user->date_embauche)
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-calendar-alt"></i>
                        Date d'embauche
                    </div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($user->date_embauche)->format('d/m/Y') }}
                        <span class="text-muted ms-2">
                            ({{ \Carbon\Carbon::parse($user->date_embauche)->diffForHumans() }})
                        </span>
                    </div>
                </div>
                @endif

                <!-- Informations système -->
                <div class="row">
                    
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="action-buttons animate__animated animate__fadeIn animate__delay-2s">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </form>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                <a href="{{ route('users.index') }}" class="btn-primary-custom">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <!-- Section Fiches d'Heures -->
        <div class="timesheet-container animate__animated animate__fadeIn animate__delay-3s" style="margin-top: 30px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 style="color: var(--bleu-marine);">
                    <i class="fas fa-clock me-2"></i>Fiches d'Heures
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('timesheets.create', ['user_id' => $user->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i>Ajouter une fiche
                    </a>
                </div>
            </div>
            
            @if($timesheets && $timesheets->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Jour</th>
                            <th>Chantier</th>
                            <th>Heures</th>
                            <th>Pause</th>
                            <th>Heures Supp</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timesheets as $timesheet)
                        <tr>
                            <td>{{ $timesheet->date_formatee ?? 'N/A' }}</td>
                            <td>{{ $timesheet->jour ?? 'N/A' }}</td>
                            <td>
                                @if($timesheet->chantier)
                                    {{ $timesheet->chantier->nom }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $timesheet->heure_debut_formatee ?? 'N/A' }} - {{ $timesheet->heure_fin_formatee ?? 'N/A' }}</td>
                            <td>
                                @if($timesheet->pause)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-secondary">Non</span>
                                @endif
                            </td>
                            <td>{{ $timesheet->heures_supp ?? 0 }}h</td>
                            <td><strong>{{ $timesheet->total_heures ?? 0 }}h</strong></td>
                            <td>
                                <form action="{{ route('timesheets.destroy', $timesheet) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Supprimer définitivement cette fiche d\\'heures ?')">
                                        <i class="fas fa-trash me-1"></i>Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Statistiques par mois -->
            @if($statsParMois && $statsParMois->count() > 0)
            <div class="mt-4">
                <h6 class="mb-3" style="color: var(--bleu-marine);">
                    <i class="fas fa-chart-bar me-2"></i>Statistiques par mois
                </h6>
                <div class="row">
                    @foreach($statsParMois as $stat)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">{{ $stat->mois ?? 'N/A' }}</h6>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <small class="text-muted">Jours</small>
                                        <div class="fw-bold">{{ $stat->jours ?? 0 }}</div>
                                    </div>
                                    <div>
                                        <small class="text-muted">Heures</small>
                                        <div class="fw-bold">{{ $stat->heures ?? 0 }}h</div>
                                    </div>
                                    <div>
                                        <small class="text-muted">Suppl.</small>
                                        <div class="fw-bold text-warning">{{ $stat->heures_supp ?? 0 }}h</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Aucune fiche d'heures enregistrée pour cet utilisateur.
            </div>
            @endif
        </div>

        <!-- Agenda -->
        <div class="timeline-container animate__animated animate__fadeIn animate__delay-3s">
            <h5 class="mb-4" style="color: var(--bleu-marine);">
                <i class="fas fa-history me-2"></i>Agenda
            </h5>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">
                        @if($user->created_at)
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        @else
                            Date inconnue
                        @endif
                    </div>
                    <div class="timeline-content">
                        <strong>Compte créé</strong>
                        <p class="mb-0">L'utilisateur a rejoint l'équipe Szlazak</p>
                    </div>
                </div>
                
                @if($user->date_embauche)
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ \Carbon\Carbon::parse($user->date_embauche)->format('d/m/Y') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Date d'embauche</strong>
                        <p class="mb-0">Début de collaboration avec l'entreprise</p>
                    </div>
                </div>
                @endif
                
                @if(($stats['chantiers_count'] ?? 0) > 0)
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ now()->subDays(rand(1, 30))->format('d/m/Y') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Assignation à un chantier</strong>
                        <p class="mb-0">Responsable de {{ $stats['chantiers_count'] }} chantier{{ $stats['chantiers_count'] > 1 ? 's' : '' }}</p>
                    </div>
                </div>
                @endif
                
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ now()->subHours(rand(1, 24))->format('d/m/Y H:i') }}
                    </div>
                    <div class="timeline-content">
                        <strong>Dernière activité</strong>
                        <p class="mb-0">Connecté au système de gestion</p>
                    </div>
                </div>
            </div>
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

            // Couleur dynamique de l'avatar en fonction du rôle
            const role = "{{ strtolower(str_replace(' ', '-', $user->role->nom)) }}";
            const avatar = document.querySelector('.profile-avatar');
            
            const gradients = {
                'administrateur': 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)',
                'chef-de-chantier': 'linear-gradient(135deg, #2ecc71 0%, #27ae60 100%)',
                'ouvrier': 'linear-gradient(135deg, #f39c12 0%, #d35400 100%)',
                'apprenti': 'linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%)',
                'intérimaire': 'linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%)'
            };
            
            if (gradients[role]) {
                avatar.style.background = gradients[role];
            }

            // Animation des info-items au survol
            const infoItems = document.querySelectorAll('.info-item');
            infoItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


