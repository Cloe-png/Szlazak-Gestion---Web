<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Équipe - Szlazak Gestion</title>
    
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
            --role-commercial: #9b59b6;
            --role-stagiaire: #95a5a6;
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

        .btn-primary-custom i {
            margin-right: 8px;
        }

        /* Cartes des utilisateurs */
        .user-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            height: 100%;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px var(--shadow-color);
            border-color: var(--bleu-clair);
        }

        .user-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
        }

        .user-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin-right: 20px;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .user-id {
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .user-details {
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .detail-item i {
            width: 20px;
            color: var(--bleu-marine);
            margin-right: 10px;
            text-align: center;
        }

        .role-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .role-admin { background-color: rgba(52, 152, 219, 0.1); color: var(--role-admin); border: 1px solid rgba(52, 152, 219, 0.2); }
        .role-chef { background-color: rgba(46, 204, 113, 0.1); color: var(--role-chef); border: 1px solid rgba(46, 204, 113, 0.2); }
        .role-ouvrier { background-color: rgba(243, 156, 18, 0.1); color: var(--role-ouvrier); border: 1px solid rgba(243, 156, 18, 0.2); }
        .role-commercial { background-color: rgba(155, 89, 182, 0.1); color: var(--role-commercial); border: 1px solid rgba(155, 89, 182, 0.2); }
        .role-stagiaire { background-color: rgba(149, 165, 166, 0.1); color: var(--role-stagiaire); border: 1px solid rgba(149, 165, 166, 0.2); }

        .user-stats {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .stat-item {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--bleu-marine);
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
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

        .btn-view {
            background-color: rgba(22, 32, 72, 0.1);
            color: var(--bleu-marine);
        }

        .btn-view:hover {
            background-color: var(--bleu-marine);
            color: white;
        }

        .btn-edit {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .btn-edit:hover {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Filtres et statistiques */
        .stats-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background-color: var(--bg-primary);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            border-left: 4px solid var(--bleu-clair);
        }

        .stat-card-icon {
            font-size: 2rem;
            color: var(--bleu-clair);
            margin-bottom: 10px;
        }

        .stat-card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .stat-card-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .filters-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .filter-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-select {
            flex: 1;
            min-width: 200px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 12px;
            background-color: white;
        }

        .legend-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        /* État vide */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--border-color);
        }

        /* Pagination */
        .pagination-container {
            margin-top: 30px;
        }

        .pagination-custom .page-item.active .page-link {
            background-color: var(--bleu-marine);
            border-color: var(--bleu-marine);
        }

        .pagination-custom .page-link {
            color: var(--bleu-marine);
            border-color: var(--border-color);
        }

        .pagination-custom .page-link:hover {
            color: white;
            background-color: var(--bleu-clair);
            border-color: var(--bleu-clair);
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

        @keyframes  fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }
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
                        <a class="nav-link" href="<?php echo e(route('chantiers.index')); ?>">
                            <i class="fas fa-project-diagram me-1"></i>Chantiers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('equipements.index')); ?>">
                            <i class="fas fa-tools me-1"></i>Équipements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('users.index')); ?>">
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
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
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
                    <h1><i class="fas fa-users me-3"></i>Équipe</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Gérez les membres de votre équipe</p>
                </div>
                <a href="<?php echo e(route('users.create')); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Nouveau membre
                </a>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="stats-section animate__animated animate__fadeIn animate__delay-1s">
            <h5 class="mb-4" style="color: var(--bleu-marine);">
                <i class="fas fa-chart-bar me-2"></i>Statistiques de l'équipe
            </h5>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-value"><?php echo e($users->count()); ?></div>
                    <div class="stat-card-label">Membres total</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stat-card-value"><?php echo e($users->where('role.nom', 'Administrateur')->count()); ?></div>
                    <div class="stat-card-label">Administrateurs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div class="stat-card-value"><?php echo e($users->where('role.nom', 'Chef de chantier')->count()); ?></div>
                    <div class="stat-card-label">Chefs de chantier</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="stat-card-value"><?php echo e($users->where('role.nom', 'Ouvrier')->count()); ?></div>
                    <div class="stat-card-label">Ouvriers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div class="stat-card-value"><?php echo e($users->where('role.nom', 'Apprenti')->count()); ?></div>
                    <div class="stat-card-label">Apprenti</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div class="stat-card-value"><?php echo e($users->where('role.nom', 'Intérimaire')->count()); ?></div>
                    <div class="stat-card-label">Intérimaire</div>
                </div>
            </div>
        </div>

        <!-- Filtres et Légende -->
        <div class="filters-section animate__animated animate__fadeIn animate__delay-2s">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0" style="color: var(--bleu-marine);">
                    <i class="fas fa-filter me-2"></i>Filtres & Légende
                </h5>
                <span class="text-muted"><?php echo e($users->count()); ?> membres</span>
            </div>
            
            <div class="filter-group">
                <select class="filter-select" id="roleFilter">
                    <option value="">Tous les rôles</option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->id); ?>"><?php echo e($role->nom); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <input type="text" class="filter-select" placeholder="Rechercher un membre..." id="searchInput">
            </div>
            
            <div class="legend-container">
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--role-admin);"></div>
                    <span>Administrateur</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--role-chef);"></div>
                    <span>Chef de chantier</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--role-ouvrier);"></div>
                    <span>Ouvrier</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--role-apprenti);"></div>
                    <span>Apprenti</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--role-intérimaire);"></div>
                    <span>Intérimaire</span>
                </div>
            </div>
        </div>

        <!-- Grille des utilisateurs -->
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6 animate__animated animate__fadeIn animate__delay-<?php echo e(min(3, $loop->index + 2)); ?>s">
                <div class="user-card" 
                     data-role="<?php echo e($user->role_id); ?>"
                     data-name="<?php echo e(strtolower($user->nom)); ?>">
                    <div class="user-header">
                        <div class="user-avatar">
                            <?php echo e(substr($user->nom, 0, 2)); ?>

                        </div>
                        <div class="user-info">
                            <div class="user-name"><?php echo e($user->nom); ?></div>
                            <div class="user-id">#EM<?php echo e(str_pad($user->id, 4, '0', STR_PAD_LEFT)); ?></div>
                        </div>
                    </div>

                    <div class="user-details">
                        <div class="detail-item">
                            <i class="fas fa-envelope"></i>
                            <span><?php echo e($user->email); ?></span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-tag"></i>
                            <span class="role-badge role-<?php echo e(strtolower(str_replace(' ', '-', $user->role->nom))); ?>">
                                <?php echo e($user->role->nom); ?>

                            </span>
                        </div>
                        <?php if($user->date_embauche): ?>
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Embauche : <?php echo e(\Carbon\Carbon::parse($user->date_embauche)->format('d/m/Y')); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($user->telephone): ?>
                        <div class="detail-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo e($user->telephone); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-actions">
                        <a href="<?php echo e(route('users.show', $user->id)); ?>" class="btn-action btn-view">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-action btn-delete" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h4 class="mt-3" style="color: var(--text-secondary);">Aucun membre d'équipe</h4>
                    <p class="mb-4">Commencez par ajouter votre premier membre d'équipe</p>
                    <a href="<?php echo e(route('users.create')); ?>" class="btn-primary-custom">
                        <i class="fas fa-user-plus me-2"></i>Ajouter un membre
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if(method_exists($users, 'links') && $users->hasPages()): ?>
        <div class="pagination-container animate__animated animate__fadeIn animate__delay-4s">
            <nav aria-label="Pagination">
                <ul class="pagination pagination-custom justify-content-center">
                    <?php echo e($users->links()); ?>

                </ul>
            </nav>
        </div>
        <?php endif; ?>
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
            // Animation des cartes
            const cards = document.querySelectorAll('.user-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${(index % 3) * 0.1}s`;
            });

            // Filtres
            const roleFilter = document.getElementById('roleFilter');
            const searchInput = document.getElementById('searchInput');

            function applyFilters() {
                const role = roleFilter.value;
                const search = searchInput.value.toLowerCase();
                
                cards.forEach(card => {
                    let show = true;
                    
                    // Filtre par rôle
                    if (role && card.dataset.role !== role) {
                        show = false;
                    }
                    
                    // Filtre par recherche
                    if (search) {
                        const userName = card.dataset.name;
                        if (!userName.includes(search)) {
                            show = false;
                        }
                    }
                    
                    // Afficher ou cacher la carte
                    card.style.display = show ? 'block' : 'none';
                });
                
                // Mettre à jour le compteur
                const visibleCards = document.querySelectorAll('.user-card[style="display: block"]').length;
                const totalCards = cards.length;
                document.querySelector('.text-muted').textContent = `${visibleCards} membres`;
            }

            // Écouter les changements de filtre
            roleFilter.addEventListener('change', applyFilters);
            
            // Pour la recherche, ajouter un délai pour éviter trop de requêtes
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

            // Gestion des couleurs de rôle dynamiques
            function getRoleColor(roleName) {
                const colors = {
                    'administrateur': 'var(--role-admin)',
                    'chef-de-chantier': 'var(--role-chef)',
                    'ouvrier': 'var(--role-ouvrier)',
                    'commercial': 'var(--role-commercial)',
                    'stagiaire': 'var(--role-stagiaire)'
                };
                return colors[roleName] || 'var(--bleu-marine)';
            }

            // Mettre à jour les couleurs des avatars en fonction du rôle
            cards.forEach(card => {
                const roleBadge = card.querySelector('.role-badge');
                if (roleBadge) {
                    const roleClass = Array.from(roleBadge.classList).find(cls => cls.startsWith('role-'));
                    if (roleClass) {
                        const roleName = roleClass.replace('role-', '');
                        const avatar = card.querySelector('.user-avatar');
                        if (avatar) {
                            // Utiliser un dégradé basé sur la couleur du rôle
                            avatar.style.background = `linear-gradient(135deg, ${getRoleColor(roleName)} 0%, ${getRoleColor(roleName)}80 100%)`;
                        }
                    }
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/users/index.blade.php ENDPATH**/ ?>