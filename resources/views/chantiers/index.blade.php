<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Chantiers - Szlazak Gestion</title>
    @include('partials.app-head')
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

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--bleu-marine);
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

        .btn-primary-custom i {
            margin-right: 8px;
        }

        .btn-secondary-custom {
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-secondary-custom:hover {
            background-color: var(--border-color);
            color: var(--text-primary);
        }

        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom th {
            background-color: var(--bg-secondary);
            color: var(--bleu-marine);
            font-weight: 600;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid var(--border-color);
        }

        .table-custom td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table-custom tr:hover {
            background-color: var(--highlight-color);
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-en-cours {
            background-color: rgba(0, 123, 255, 0.1);
            color: #007bff;
        }

        .badge-termine {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .badge-retard {
            background-color: rgba(220, 53, 69, 0.12);
            color: #dc3545;
        }

        .badge-a-venir {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        .badge-annule {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons .btn {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .btn-view {
            background-color: rgba(22, 32, 72, 0.1);
            color: var(--bleu-marine);
            border: none;
        }

        .btn-view:hover {
            background-color: var(--bleu-marine);
            color: white;
        }

        .btn-edit {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: none;
        }

        .btn-edit:hover {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: none;
        }

        .btn-delete:hover {
            background-color: #dc3545;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--border-color);
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

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Messages de succès / erreur -->
        <!-- Page Header -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-project-diagram me-3"></i>Chantiers</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Gérez tous vos chantiers en cours et à venir</p>
                </div>
                @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('chantiers.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Nouveau chantier
                </a>
                @endif
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">
            <!-- Statistiques rapides -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(0, 123, 255, 0.05);">
                        <div class="h4 mb-1" style="color: #007bff;">{{ $enCours }}</div>
                        <div class="text-muted">En cours</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(40, 167, 69, 0.05);">
                        <div class="h4 mb-1" style="color: #28a745;">{{ $termines }}</div>
                        <div class="text-muted">Terminés</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(255, 193, 7, 0.05);">
                        <div class="h4 mb-1" style="color: #ffc107;">{{ $aVenir }}</div>
                        <div class="text-muted">À venir</div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="mb-4">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('chantiers.index') }}" 
                       class="btn btn-sm {{ !request('statut') ? 'btn-primary' : 'btn-outline-primary' }}">
                       Tous
                    </a>
                    <a href="{{ route('chantiers.index', ['statut' => 'En cours']) }}" 
                       class="btn btn-sm {{ request('statut') == 'En cours' ? 'btn-primary' : 'btn-outline-primary' }}">
                       En cours
                    </a>
                    <a href="{{ route('chantiers.index', ['statut' => 'Terminé']) }}" 
                       class="btn btn-sm {{ request('statut') == 'Terminé' ? 'btn-primary' : 'btn-outline-primary' }}">
                       Terminés
                    </a>
                    <a href="{{ route('chantiers.index', ['statut' => 'À venir']) }}" 
                       class="btn btn-sm {{ request('statut') == 'À venir' ? 'btn-primary' : 'btn-outline-primary' }}">
                       À venir
                    </a>
                </div>
            </div>

            <!-- Barre de recherche -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text" style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                        <i class="fas fa-search" style="color: var(--text-secondary);"></i>
                    </span>
                    <input type="text" id="searchChantier" class="form-control" 
                           placeholder="Rechercher un chantier par nom..." 
                           style="border-color: var(--border-color);">
                </div>
            </div>

            <!-- Tableau -->
            @if($chantiers->count() > 0)
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Responsable</th>
                            <th>Tarif</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="chantierTableBody">
                        @foreach($chantiers as $chantier)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s; opacity: 0;">
                            <td>
                                <strong>{{ $chantier->nom }}</strong>
                                <br>
                                <small class="text-muted">#CH{{ str_pad($chantier->id, 4, '0', STR_PAD_LEFT) }}</small>
                            </td>
                            <td>{{ Str::limit($chantier->adresse, 30) }}</td>
                            <td>
                                @if($chantier->responsable)
                                    <div class="d-flex align-items-center">
                                        <div style="width: 30px; height: 30px; background-color: rgba(22, 32, 72, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                                            <i class="fas fa-user" style="color: var(--bleu-marine); font-size: 0.8rem;"></i>
                                        </div>
                                        <span>{{ $chantier->responsable->nom }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">Non assigné</span>
                                @endif
                            </td>
                            <td>
                                @if($chantier->tarif)
                                    {{ number_format($chantier->tarif, 2, ',', ' ') }} €
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($chantier->date_debut)
                                    {{ \Carbon\Carbon::parse($chantier->date_debut)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($chantier->date_fin)
                                    {{ \Carbon\Carbon::parse($chantier->date_fin)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $badgeClass = 'badge-a-venir';
                                    if($chantier->statut == 'En cours') $badgeClass = 'badge-en-cours';
                                    elseif($chantier->statut == 'Terminé') $badgeClass = 'badge-termine';
                                    elseif($chantier->statut == 'Annulé') $badgeClass = 'badge-annule';
                                @endphp
                                <span class="badge-custom {{ $badgeClass }}">
                                    @if($chantier->statut == 'Terminé')
                                        <i class="fas fa-check me-1"></i>
                                    @endif
                                    {{ $chantier->statut }}
                                </span>
                                @if($chantier->date_fin && \Carbon\Carbon::parse($chantier->date_fin)->isPast() && $chantier->statut != 'Terminé')
                                    <span class="badge-custom badge-retard ms-2">
                                        <i class="fas fa-triangle-exclamation me-1"></i>Retard
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('chantiers.show', $chantier->id) }}" class="btn btn-view" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user() && auth()->user()->isAdmin())
                                    <a href="{{ route('chantiers.edit', $chantier->id) }}" class="btn btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('chantiers.destroy', $chantier->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chantier ?')"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
            <!-- État vide -->
            <div class="empty-state">
                <i class="fas fa-project-diagram"></i>
                <h4 class="mt-3" style="color: var(--text-secondary);">Aucun chantier</h4>
                <p class="mb-4">
                    @if(request('statut'))
                        Aucun chantier avec le statut "{{ request('statut') }}"
                    @else
                        Commencez par créer votre premier chantier
                    @endif
                </p>
                @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('chantiers.create') }}" class="btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Créer un chantier
                </a>
                @endif
                @if(request('statut'))
                    <a href="{{ route('chantiers.index') }}" class="btn-secondary-custom ms-2">
                        <i class="fas fa-times me-2"></i>Effacer les filtres
                    </a>
                @endif
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
            // Animation des lignes du tableau
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                setTimeout(() => {
                    row.style.opacity = '1';
                }, index * 100);
            });

            // Recherche dynamique
            const searchInput = document.getElementById('searchChantier');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#chantierTableBody tr');
                    
                    rows.forEach(row => {
                        const chantierName = row.querySelector('td:first-child strong').textContent.toLowerCase();
                        if (chantierName.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


