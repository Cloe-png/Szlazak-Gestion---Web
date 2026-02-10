<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockage - Szlazak Gestion</title>
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
        }

        /* Barre de recherche */
        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all var(--transition-speed) ease;
        }

        .search-input:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 0.2rem rgba(22, 32, 72, 0.25);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        /* Cartes des équipements */
        .equipment-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            height: 100%;
            margin-bottom: 20px;
        }

        .equipment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow-color);
            border-color: var(--bleu-clair);
        }

        .equipment-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
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
            margin-right: 15px;
        }

        .equipment-info h5 {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .equipment-details {
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .detail-item i {
            width: 20px;
            color: var(--bleu-marine);
            margin-right: 10px;
            text-align: center;
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

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        .btn-action {
            flex: 1;
            text-align: center;
            padding: 8px;
            border-radius: 6px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-view { background-color: rgba(22, 32, 72, 0.1); color: var(--bleu-marine); }
        .btn-view:hover { background-color: var(--bleu-marine); color: white; }

        .btn-edit { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .btn-edit:hover { background-color: #ffc107; color: white; }

        .btn-delete { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .btn-delete:hover { background-color: #dc3545; color: white; }
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
                    <h1><i class="fas fa-tools me-3"></i>Stockage</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Gérez votre matériel et vos outils</p>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('equipements.loans') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-boxes-stacked me-2"></i>Emprunts
                    </a>
                    @if(auth()->user() && !auth()->user()->isAdmin())
                    <a href="{{ route('equipements.loans.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-hand-holding me-2"></i>Emprunter
                    </a>
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('equipements.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Nouveau stockage
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">
            @php
                $ruptures = $equipements->filter(function ($e) { return (int) $e->quantite <= 1; });
            @endphp
            @if($ruptures->count() > 0)
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
                    <i class="fas fa-triangle-exclamation"></i>
                    <div>
                        Stock faible (≤ 1) : {{ $ruptures->pluck('nom')->implode(', ') }}.
                    </div>
                </div>
            @endif
            <!-- Barre de recherche -->
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="searchEquipment" 
                       placeholder="Rechercher un élément en stockage par nom ou localisation...">
            </div>

            <!-- Grille du stockage -->
            <div class="row" id="equipment-grid">
                @forelse($equipements as $equipement)
                <div class="col-lg-4 col-md-6 mb-4 equipment-item" 
                     data-name="{{ strtolower($equipement->nom) }}"
                     data-localisation="{{ strtolower($equipement->localisation) }}">
                    <div class="equipment-card animate__animated animate__fadeIn">
                        <div class="equipment-header">
                            <div class="equipment-icon">
                                @php
                                    $icon = 'fa-tools';
                                    if (str_contains(strtolower($equipement->nom), 'marteau')) $icon = 'fa-hammer';
                                    elseif (str_contains(strtolower($equipement->nom), 'scie')) $icon = 'fa-cut';
                                    elseif (str_contains(strtolower($equipement->nom), 'perceuse')) $icon = 'fa-bolt';
                                    elseif (str_contains(strtolower($equipement->nom), 'bétonnière')) $icon = 'fa-truck-loading';
                                    elseif (str_contains(strtolower($equipement->nom), 'échafaudage')) $icon = 'fa-ladder';
                                    elseif (str_contains(strtolower($equipement->nom), 'génératrice')) $icon = 'fa-plug';
                                    elseif (str_contains(strtolower($equipement->nom), 'niveau')) $icon = 'fa-ruler-combined';
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <div class="equipment-info">
                                <h5>{{ $equipement->nom }}</h5>
                                <small class="text-muted">#EQ{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</small>
                            </div>
                        </div>

                        <div class="equipment-details">
                            <div class="detail-item">
                                <i class="fas fa-layer-group"></i>
                                <span>Quantité : <strong>{{ $equipement->quantite }}</strong></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Localisation : {{ $equipement->localisation }}</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-info-circle"></i>
                                <span>État : 
                                    <span class="badge-etat 
                                        @if($equipement->etat == 'Bon état' || $equipement->etat == 'Neuf') etat-bon
                                        @elseif($equipement->etat == 'Usé') etat-moyen
                                        @elseif($equipement->etat == 'En maintenance') etat-maintenance
                                        @else etat-mauvais @endif">
                                        {{ $equipement->etat }}
                                    </span>
                                </span>
                            </div>
                            @if($equipement->date_achat)
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Acheté le : {{ \Carbon\Carbon::parse($equipement->date_achat)->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('equipements.show', $equipement->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            @if(auth()->user() && auth()->user()->isAdmin())
                            <a href="{{ route('equipements.edit', $equipement->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('equipements.destroy', $equipement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément du stockage ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucun élément en stockage</h4>
                        <p class="mb-4">Commencez par ajouter votre premier élément</p>
                        @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('equipements.create') }}" class="btn-primary-custom">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter au stockage
                        </a>
                        @endif
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchEquipment');
            const equipmentItems = document.querySelectorAll('.equipment-item');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                equipmentItems.forEach(item => {
                    const equipmentName = item.dataset.name;
                    const equipmentLocation = item.dataset.localisation;
                    
                    if (searchTerm === '' || 
                        equipmentName.includes(searchTerm) || 
                        equipmentLocation.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
            
            // Animation des cartes
            const cards = document.querySelectorAll('.equipment-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate__fadeIn');
                }, index * 100);
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


