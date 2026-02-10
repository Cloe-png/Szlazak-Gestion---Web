<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiches d'Heures - Szlazak Gestion</title>
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
            --transition-speed: 0.3s;
            --highlight-color: rgba(22, 32, 72, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
            background-color: var(--bg-primary);
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

        .summary-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
            transition: transform var(--transition-speed) ease;
        }

        .summary-card:hover {
            transform: translateY(-3px);
        }

        .person-summary {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .person-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 2px 5px rgba(22, 32, 72, 0.2);
        }

        .person-info h5 {
            margin: 0;
            color: var(--bleu-marine);
        }

        .person-info p {
            margin: 0;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .week-summary {
            background-color: rgba(22, 32, 72, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .week-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .week-title {
            font-weight: 600;
            color: var(--bleu-marine);
        }

        .week-dates {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .hours-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
        }

        .hour-item {
            text-align: center;
        }

        .hour-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
        }

        .hour-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--bleu-marine);
        }

        .hour-value.supp {
            color: #ff6b35;
        }

        .hour-value.total {
            color: #28a745;
        }

        .btn-view-details {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-view-details:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .stats-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            margin-bottom: 20px;
        }

        .stats-title {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 10px;
        }

        .stats-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--bleu-marine);
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--border-color);
            margin-bottom: 20px;
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
                    <h1 class="text-white mb-2"><i class="fas fa-clock me-3"></i>Fiches d'Heures</h1>
                    <p class="mb-0" style="opacity: 0.9;">Vue hebdomadaire par personne</p>
                </div>
                <div>
                    <a href="{{ route('timesheets.create') }}" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-plus me-2"></i>Nouvelle fiche
                    </a>
                </div>
            </div>
        </div>

        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">

        <!-- Filtres -->
        <form class="row g-3 mb-4" method="GET" action="{{ route('timesheets.index') }}">
            <div class="col-md-3">
                <label class="form-label">Date début</label>
                <input type="date" name="date_from" class="form-control" value="{{ $filters['date_from'] ?? '' }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Date fin</label>
                <input type="date" name="date_to" class="form-control" value="{{ $filters['date_to'] ?? '' }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Chantier</label>
                <select name="chantier_id" class="form-select">
                    <option value="">Tous les chantiers</option>
                    @foreach($chantiers as $chantier)
                        <option value="{{ $chantier->id }}" {{ ($filters['chantier_id'] ?? '') == $chantier->id ? 'selected' : '' }}>
                            {{ $chantier->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i>Filtrer
                </button>
            </div>
        </form>

        @if(auth()->user() && auth()->user()->isAdmin())
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a class="btn btn-outline-success"
               href="{{ route('timesheets.export', array_filter(['date_from' => $filters['date_from'] ?? null, 'date_to' => $filters['date_to'] ?? null, 'chantier_id' => $filters['chantier_id'] ?? null])) }}">
                <i class="fas fa-file-csv me-1"></i>Exporter CSV
            </a>
            <a class="btn btn-outline-secondary"
               href="{{ route('timesheets.export', array_filter(['date_from' => $filters['date_from'] ?? null, 'date_to' => $filters['date_to'] ?? null, 'chantier_id' => $filters['chantier_id'] ?? null, 'format' => 'pdf'])) }}">
                <i class="fas fa-file-pdf me-1"></i>Exporter PDF
            </a>
        </div>
        @endif

        @php
            $totalHeuresTravaillees = $timesheets->sum('heures_travaillees');
            $totalHeuresSupp = 0;
            foreach ($timesheets->groupBy('user_id') as $userTimesheetsForStats) {
                $weeks = $userTimesheetsForStats->groupBy(function ($item) {
                    return \Carbon\Carbon::parse($item->date_travail)->format('Y-W');
                });
                foreach ($weeks as $weekTimesheetsForStats) {
                    $weekHours = $weekTimesheetsForStats->sum('heures_travaillees');
                    $totalHeuresSupp += max(0, $weekHours - 35);
                }
            }
        @endphp

        <!-- Statistiques globales -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-title">Total Personnes</div>
                    <div class="stats-value">{{ $timesheets->groupBy('user_id')->count() }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-title">Semaines actives</div>
                    <div class="stats-value">{{ $timesheets->groupBy(function($item) { return \Carbon\Carbon::parse($item->date_travail)->format('Y-W'); })->count() }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-title">Total Heures</div>
                    <div class="stats-value">{{ $totalHeuresTravaillees }}h</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-title">Heures Supp</div>
                    <div class="stats-value text-warning">{{ $totalHeuresSupp }}h</div>
                </div>
            </div>
        </div>

        <!-- Liste des personnes avec totaux hebdomadaires -->
        @if($timesheets->count() > 0)
            @php
                $groupedByUser = $timesheets->groupBy('user_id');
            @endphp

            @foreach($groupedByUser as $userId => $userTimesheets)
                @php
                    $user = $userTimesheets->first()->user;
                    $groupedByWeek = $userTimesheets->groupBy(function($item) {
                        return \Carbon\Carbon::parse($item->date_travail)->format('Y-W');
                    });
                    $totalNormalesPersonne = 0;
                    $totalHeuresSuppPersonne = 0;
                    $totalPersonne = 0;
                    foreach ($groupedByWeek as $weekTimesheetsForTotals) {
                        $weekHours = $weekTimesheetsForTotals->sum('heures_travaillees');
                        $weekSupp = max(0, $weekHours - 35);
                        $weekNorm = $weekHours - $weekSupp;
                        $totalPersonne += $weekHours;
                        $totalNormalesPersonne += $weekNorm;
                        $totalHeuresSuppPersonne += $weekSupp;
                    }
                @endphp

                <div class="summary-card">
                    <!-- En-tête personne -->
                    <div class="person-summary">
                        <div class="person-avatar">
                            {{ substr($user->nom, 0, 1) }}
                        </div>
                        <div class="person-info">
                            <h5>{{ $user->nom }}</h5>
                            <p>{{ $user->role->nom }}</p>
                        </div>
                        <div class="ms-auto"></div>
                    </div>

                    <!-- Totaux par semaine -->
                    @foreach($groupedByWeek as $weekKey => $weekTimesheets)
                        @php
                            $totalSemaine = $weekTimesheets->sum('heures_travaillees');
                            $totalHeuresSuppSemaine = max(0, $totalSemaine - 35);
                            $totalHeuresNormalesSemaine = $totalSemaine - $totalHeuresSuppSemaine;
                            $firstDate = $weekTimesheets->first()->date_travail;
                            $dateDebut = \Carbon\Carbon::parse($firstDate)->startOfWeek();
                            $dateFin = \Carbon\Carbon::parse($firstDate)->endOfWeek();
                            $weekNumber = \Carbon\Carbon::parse($firstDate)->weekOfYear;
                        @endphp

                        <div class="week-summary">
                            <div class="week-header">
                                <div class="week-title">
                                    <i class="fas fa-calendar-week me-2"></i>
                                    Semaine {{ $weekNumber }}
                                </div>
                                <div class="week-dates">
                                    {{ $dateDebut->format('d/m/Y') }} - {{ $dateFin->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="hours-summary">
                                <div class="hour-item">
                                    <div class="hour-label">Jours travaillés</div>
                                    <div class="hour-value">{{ $weekTimesheets->count() }}</div>
                                </div>
                                <div class="hour-item">
                                    <div class="hour-label">Heures normales</div>
                                    <div class="hour-value">{{ $totalHeuresNormalesSemaine }}h</div>
                                </div>
                                <div class="hour-item">
                                    <div class="hour-label">Heures supp</div>
                                    <div class="hour-value supp">{{ $totalHeuresSuppSemaine }}h</div>
                                </div>
                                <div class="hour-item">
                                    <div class="hour-label">Total</div>
                                    <div class="hour-value total">{{ $totalSemaine }}h</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Total personne -->
                    <div class="week-summary" style="background-color: rgba(22, 32, 72, 0.1);">
                        <div class="week-header">
                            <div class="week-title">
                                <i class="fas fa-user-clock me-2"></i>
                                Total {{ $user->nom }}
                            </div>
                        </div>
                        <div class="hours-summary">
                            @php
                                $totalPersonne = $totalPersonne;
                                $totalHeuresSuppPersonne = $totalHeuresSuppPersonne;
                            @endphp
                            <div class="hour-item">
                                <div class="hour-label">Total jours</div>
                                <div class="hour-value">{{ $userTimesheets->count() }}</div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-label">Total heures</div>
                                <div class="hour-value">{{ $totalNormalesPersonne }}h</div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-label">Total heures supp</div>
                                <div class="hour-value supp">{{ $totalHeuresSuppPersonne }}h</div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-label">Total global</div>
                                <div class="hour-value total">{{ $totalPersonne }}h</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="summary-card">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucune fiche d'heures</h4>
                    <p class="mb-4">Commencez par créer votre première fiche d'heures</p>
                    <a href="{{ route('timesheets.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Créer une fiche
                    </a>
                </div>
            </div>
        @endif
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour afficher/masquer les détails d'une semaine
            const semaineRows = document.querySelectorAll('.semaine-row');
            
            semaineRows.forEach(row => {
                row.addEventListener('click', function() {
                    let nextRow = this.nextElementSibling;
                    let isHidden = false;
                    
                    // Vérifier si la première ligne suivante est cachée
                    if(nextRow && nextRow.style.display === 'none') {
                        isHidden = true;
                    }
                    
                    // Parcourir jusqu'à la ligne suivante (semaine, total semaine, total personne ou fin)
                    while(nextRow && !nextRow.classList.contains('semaine-row') && 
                          !nextRow.classList.contains('total-personne-row') &&
                          !nextRow.classList.contains('personne-row')) {
                        if(nextRow.tagName === 'TR') {
                            nextRow.style.display = isHidden ? '' : 'none';
                        }
                        nextRow = nextRow.nextElementSibling;
                    }
                    
                    // Masquer/afficher aussi la ligne de total de la semaine
                    if(nextRow && nextRow.classList.contains('total-row')) {
                        nextRow.style.display = isHidden ? '' : 'none';
                    }
                    
                    // Changer l'icône
                    const icon = this.querySelector('i');
                    if(icon) {
                        if(isHidden) {
                            icon.className = 'fas fa-calendar-week me-2';
                        } else {
                            icon.className = 'fas fa-calendar-minus me-2';
                        }
                    }
                });
            });

            // Animation au scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            // Observer les éléments animés
            document.querySelectorAll('.animate-fade-in').forEach(el => {
                observer.observe(el);
            });

            // Confirmation de suppression
            const deleteForms = document.querySelectorAll('form[action*="timesheets"]');
            deleteForms.forEach(form => {
                const deleteBtn = form.querySelector('button[type="submit"]');
                if(deleteBtn) {
                    deleteBtn.addEventListener('click', function(e) {
                        if(!confirm('Êtes-vous sûr de vouloir supprimer cette fiche d\'heures ? Cette action est irréversible.')) {
                            e.preventDefault();
                        }
                    });
                }
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


