<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Chantiers - Szlazak Gestion</title>
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

        @keyframes  fadeIn {
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
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('dashboard')); ?>">
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
                        <a class="nav-link active" href="<?php echo e(route('chantiers.index')); ?>">
                            <i class="fas fa-project-diagram me-1"></i>Chantiers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('equipements.index')); ?>">
                            <i class="fas fa-tools me-1"></i>Équipements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('users.index')); ?>">
                            <i class="fas fa-users me-1"></i>Équipe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('evenements.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('timesheets.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Fiches d'heures
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?php echo e(Auth::user()->nom ?? 'Szlazak Nicolas'); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <!-- Formulaire de déconnexion -->
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
                                    <?php echo csrf_field(); ?>
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

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Messages de succès -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-project-diagram me-3"></i>Chantiers</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Gérez tous vos chantiers en cours et à venir</p>
                </div>
                <a href="<?php echo e(route('chantiers.create')); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-plus-circle me-2"></i>Nouveau chantier
                </a>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">
            <!-- Données de démonstration -->
            <?php
                // Données de démonstration pour les tests
                $chantiers = collect([
                    (object)[
                        'id' => 1,
                        'nom' => 'Rénovation Appartement Paris 16ème',
                        'adresse' => '45 Avenue Victor Hugo, 75016 Paris',
                        'responsable' => (object)['nom' => 'Nicolas Szlazak'],
                        'date_debut' => '2024-01-15',
                        'date_fin' => '2024-03-30',
                        'statut' => 'En cours'
                    ],
                    (object)[
                        'id' => 2,
                        'nom' => 'Construction Maison Neuilly',
                        'adresse' => '12 Rue de la République, 92200 Neuilly-sur-Seine',
                        'responsable' => (object)['nom' => 'Jean Dupont'],
                        'date_debut' => '2024-02-01',
                        'date_fin' => '2024-05-15',
                        'statut' => 'En cours'
                    ],
                    (object)[
                        'id' => 3,
                        'nom' => 'Agrandissement Bureau Levallois',
                        'adresse' => '8 Boulevard de la Seine, 92300 Levallois-Perret',
                        'responsable' => (object)['nom' => 'Marie Martin'],
                        'date_debut' => '2023-11-10',
                        'date_fin' => '2024-01-20',
                        'statut' => 'Terminé'
                    ],
                    (object)[
                        'id' => 4,
                        'nom' => 'Rénovation Toiture Versailles',
                        'adresse' => '25 Rue Royale, 78000 Versailles',
                        'responsable' => null,
                        'date_debut' => '2024-04-01',
                        'date_fin' => '2024-04-30',
                        'statut' => 'À venir'
                    ]
                ]);
                
                $statutFiltre = request('statut');
                if ($statutFiltre) {
                    $chantiers = $chantiers->where('statut', $statutFiltre);
                }
                
                $totalChantiers = $chantiers->count();
                $enCours = $chantiers->where('statut', 'En cours')->count();
                $termines = $chantiers->where('statut', 'Terminé')->count();
                $aVenir = $chantiers->where('statut', 'À venir')->count();
            ?>

            <!-- Statistiques rapides -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(22, 32, 72, 0.05);">
                        <div class="h4 mb-1" style="color: var(--bleu-marine);"><?php echo e($totalChantiers); ?></div>
                        <div class="text-muted">Total chantiers</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(0, 123, 255, 0.05);">
                        <div class="h4 mb-1" style="color: #007bff;"><?php echo e($enCours); ?></div>
                        <div class="text-muted">En cours</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(40, 167, 69, 0.05);">
                        <div class="h4 mb-1" style="color: #28a745;"><?php echo e($termines); ?></div>
                        <div class="text-muted">Terminés</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="text-center p-3 rounded" style="background-color: rgba(255, 193, 7, 0.05);">
                        <div class="h4 mb-1" style="color: #ffc107;"><?php echo e($aVenir); ?></div>
                        <div class="text-muted">À venir</div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="mb-4">
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?php echo e(route('chantiers.index')); ?>" 
                       class="btn btn-sm <?php echo e(!request('statut') ? 'btn-primary' : 'btn-outline-primary'); ?>">
                       Tous
                    </a>
                    <a href="<?php echo e(route('chantiers.index', ['statut' => 'En cours'])); ?>" 
                       class="btn btn-sm <?php echo e(request('statut') == 'En cours' ? 'btn-primary' : 'btn-outline-primary'); ?>">
                       En cours
                    </a>
                    <a href="<?php echo e(route('chantiers.index', ['statut' => 'Terminé'])); ?>" 
                       class="btn btn-sm <?php echo e(request('statut') == 'Terminé' ? 'btn-primary' : 'btn-outline-primary'); ?>">
                       Terminés
                    </a>
                    <a href="<?php echo e(route('chantiers.index', ['statut' => 'À venir'])); ?>" 
                       class="btn btn-sm <?php echo e(request('statut') == 'À venir' ? 'btn-primary' : 'btn-outline-primary'); ?>">
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
            <?php if($chantiers->count() > 0): ?>
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Responsable</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="chantierTableBody">
                        <?php $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: <?php echo e($loop->index * 0.05); ?>s; opacity: 0;">
                            <td>
                                <strong><?php echo e($chantier->nom); ?></strong>
                                <br>
                                <small class="text-muted">#CH<?php echo e(str_pad($chantier->id, 4, '0', STR_PAD_LEFT)); ?></small>
                            </td>
                            <td><?php echo e(Str::limit($chantier->adresse, 30)); ?></td>
                            <td>
                                <?php if($chantier->responsable): ?>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 30px; height: 30px; background-color: rgba(22, 32, 72, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                                            <i class="fas fa-user" style="color: var(--bleu-marine); font-size: 0.8rem;"></i>
                                        </div>
                                        <span><?php echo e($chantier->responsable->nom); ?></span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Non assigné</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($chantier->date_debut): ?>
                                    <?php echo e(\Carbon\Carbon::parse($chantier->date_debut)->format('d/m/Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($chantier->date_fin): ?>
                                    <?php echo e(\Carbon\Carbon::parse($chantier->date_fin)->format('d/m/Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $badgeClass = 'badge-a-venir';
                                    if($chantier->statut == 'En cours') $badgeClass = 'badge-en-cours';
                                    elseif($chantier->statut == 'Terminé') $badgeClass = 'badge-termine';
                                    elseif($chantier->statut == 'Annulé') $badgeClass = 'badge-annule';
                                ?>
                                <span class="badge-custom <?php echo e($badgeClass); ?>">
                                    <?php echo e($chantier->statut); ?>

                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('chantiers.show', $chantier->id)); ?>" class="btn btn-view" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('chantiers.edit', $chantier->id)); ?>" class="btn btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('chantiers.destroy', $chantier->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-delete" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chantier ?')"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php else: ?>
            <!-- État vide -->
            <div class="empty-state">
                <i class="fas fa-project-diagram"></i>
                <h4 class="mt-3" style="color: var(--text-secondary);">Aucun chantier</h4>
                <p class="mb-4">
                    <?php if(request('statut')): ?>
                        Aucun chantier avec le statut "<?php echo e(request('statut')); ?>"
                    <?php else: ?>
                        Commencez par créer votre premier chantier
                    <?php endif; ?>
                </p>
                <a href="<?php echo e(route('chantiers.create')); ?>" class="btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Créer un chantier
                </a>
                <?php if(request('statut')): ?>
                    <a href="<?php echo e(route('chantiers.index')); ?>" class="btn-secondary-custom ms-2">
                        <i class="fas fa-times me-2"></i>Effacer les filtres
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">EURL SZLAZAK</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">© <?php echo e(date('Y')); ?> - Tous droits réservés</p>
                </div>
            </div>
        </div>
    </footer>

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
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/chantiers/index.blade.php ENDPATH**/ ?>