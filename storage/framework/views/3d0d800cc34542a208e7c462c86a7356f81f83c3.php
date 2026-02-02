<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Équipe - Constructo Gestion</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1a237e;
            --primary-light: #534bae;
            --primary-dark: #000051;
            --secondary-color: #ff6f00;
            --secondary-light: #ffa040;
            --secondary-dark: #c43e00;
            --success-color: #2e7d32;
            --warning-color: #f9a825;
            --danger-color: #c62828;
            --info-color: #0277bd;
            --light-bg: #f5f7fa;
            --dark-bg: #1e293b;
            --text-primary: #2c3e50;
            --text-secondary: #6c757d;
            --border-color: #e1e5eb;
            --card-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            --transition-fast: 0.2s ease;
            --transition-smooth: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 16px;
            --border-radius-sm: 10px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Header amélioré */
        .main-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(26, 35, 126, 0.2);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 0;
        }

        .navbar-brand i {
            font-size: 1.8rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 12px 20px !important;
            border-radius: var(--border-radius-sm);
            margin: 0 4px;
            transition: all var(--transition-fast);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--secondary-color);
            transition: all var(--transition-smooth);
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-link.active::before {
            width: 80%;
        }

        .user-dropdown .dropdown-toggle {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius-sm);
            padding: 10px 20px !important;
            backdrop-filter: blur(10px);
        }

        /* Hero Section */
        .hero-section {
            padding: 60px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(135deg, rgba(26, 35, 126, 0.05) 0%, rgba(255, 111, 0, 0.05) 100%);
            border-radius: 0 0 0 100px;
            z-index: -1;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin-bottom: 30px;
        }

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            text-align: center;
            transition: all var(--transition-smooth);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            border-color: var(--primary-light);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary-color);
            background: linear-gradient(135deg, rgba(26, 35, 126, 0.1) 0%, rgba(255, 111, 0, 0.1) 100%);
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        /* User Cards */
        .user-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            height: 100%;
            transition: all var(--transition-smooth);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .user-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--hover-shadow);
        }

        .user-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .user-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin: 0 auto 25px;
            box-shadow: 0 10px 25px rgba(26, 35, 126, 0.3);
            border: 4px solid white;
        }

        .user-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
            text-align: center;
        }

        .user-id {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Courier New', monospace;
        }

        .user-role {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
            width: 100%;
        }

        .role-admin { 
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        .role-chef { 
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }
        .role-ouvrier { 
            background: linear-gradient(135deg, #f39c12, #d35400);
            color: white;
        }
        .role-apprenti { 
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
            color: white;
        }
        .role-interimaire { 
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
        }

        .user-details {
            margin: 25px 0;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item i {
            width: 30px;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .detail-text {
            flex: 1;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        .user-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
            padding: 20px;
            background: linear-gradient(135deg, rgba(26, 35, 126, 0.03) 0%, rgba(255, 111, 0, 0.03) 100%);
            border-radius: var(--border-radius-sm);
        }

        .user-stat {
            text-align: center;
        }

        .stat-number {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            display: block;
            line-height: 1;
        }

        .stat-description {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 5px;
        }

        .card-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 25px;
        }

        .action-btn {
            padding: 10px;
            border-radius: var(--border-radius-sm);
            border: none;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-view { background: linear-gradient(135deg, var(--primary-color), var(--primary-light)); }
        .btn-edit { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .btn-delete { background: linear-gradient(135deg, #e74c3c, #c0392b); }

        /* Controls Section */
        .controls-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            margin: 40px 0;
            box-shadow: var(--card-shadow);
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all var(--transition-fast);
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 35, 126, 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .filter-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            background: white;
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .filter-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 35, 126, 0.1);
            outline: none;
        }

        .legend-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            padding: 20px;
            background: linear-gradient(135deg, rgba(26, 35, 126, 0.03) 0%, rgba(255, 111, 0, 0.03) 100%);
            border-radius: var(--border-radius-sm);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 50%;
        }

        .legend-admin { background: linear-gradient(135deg, #3498db, #2980b9); }
        .legend-chef { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .legend-ouvrier { background: linear-gradient(135deg, #f39c12, #d35400); }
        .legend-apprenti { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
        .legend-interimaire { background: linear-gradient(135deg, #95a5a6, #7f8c8d); }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state-icon {
            font-size: 5rem;
            color: var(--border-color);
            margin-bottom: 30px;
            opacity: 0.5;
        }

        .empty-state-title {
            font-size: 2rem;
            color: var(--text-secondary);
            margin-bottom: 15px;
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        @keyframes  fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stagger-delay-1 { animation-delay: 0.1s; }
        .stagger-delay-2 { animation-delay: 0.2s; }
        .stagger-delay-3 { animation-delay: 0.3s; }
        .stagger-delay-4 { animation-delay: 0.4s; }
        .stagger-delay-5 { animation-delay: 0.5s; }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .user-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .card-actions {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .legend-container {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .user-stats,
            .card-actions {
                grid-template-columns: 1fr;
            }
            
            .nav-link {
                padding: 10px 15px !important;
                margin: 2px 0;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
                <i class="fas fa-building"></i>
                <span>Constructo</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('chantiers.index')); ?>">
                            <i class="fas fa-hard-hat me-2"></i>Chantiers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('equipements.index')); ?>">
                            <i class="fas fa-tools me-2"></i>Équipements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('users.index')); ?>">
                            <i class="fas fa-users me-2"></i>Équipe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('evenements.index')); ?>">
                            <i class="fas fa-calendar-alt me-2"></i>Agenda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('timesheets.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Fiches d'heures
                        </a>
                    </li>
                </ul>

                <div class="navbar-nav">
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar-small me-2" style="width: 35px; height: 35px; background: linear-gradient(135deg, var(--secondary-color), var(--secondary-light)); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                <?php echo e(substr(Auth::user()->nom ?? 'SN', 0, 2)); ?>

                            </div>
                            <span><?php echo e(Auth::user()->nom ?? 'Admin'); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Mon profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-4">
        <!-- Hero Section -->
        <section class="hero-section" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="page-title">Gestion de l'Équipe</h1>
                    <p class="page-subtitle">Gérez efficacement les membres de votre équipe de construction</p>
                </div>
                <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-lg shadow-lg" style="background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark)); border: none; padding: 15px 30px; border-radius: var(--border-radius);">
                    <i class="fas fa-user-plus me-2"></i>Ajouter un membre
                </a>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Statistiques</h3>
            <div class="stats-grid">
                <?php
                    $stats = [
                        'total' => ['icon' => 'users', 'value' => $users->count(), 'label' => 'Membres total'],
                        'admin' => ['icon' => 'user-tie', 'value' => $users->where('role_id', 1)->count(), 'label' => 'Administrateurs'],
                        'ouvriers' => ['icon' => 'tools', 'value' => $users->where('role_id', 3)->count(), 'label' => 'Ouvriers'],
                        'apprentis' => ['icon' => 'graduation-cap', 'value' => $users->where('role_id', 4)->count(), 'label' => 'Apprentis'],
                        'interim' => ['icon' => 'clock', 'value' => $users->where('role_id', 5)->count(), 'label' => 'Intérimaires'],
                    ];
                ?>
                
                <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="stat-card fade-in-up stagger-delay-<?php echo e($loop->index); ?>">
                    <div class="stat-icon">
                        <i class="fas fa-<?php echo e($stat['icon']); ?>"></i>
                    </div>
                    <div class="stat-value"><?php echo e($stat['value']); ?></div>
                    <div class="stat-label"><?php echo e($stat['label']); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <!-- Controls Section -->
        <section class="controls-section" data-aos="fade-up" data-aos-delay="200">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Rechercher un membre par nom, email ou rôle...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="filter-select" id="roleFilter">
                        <option value="">Tous les rôles</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->nom); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            
            <div class="legend-container mt-4">
                <div class="legend-item">
                    <div class="legend-color legend-admin"></div>
                    <span>Administrateur</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-chef"></div>
                    <span>Chef de chantier</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-ouvrier"></div>
                    <span>Ouvrier</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-apprenti"></div>
                    <span>Apprenti</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-interimaire"></div>
                    <span>Intérimaire</span>
                </div>
            </div>
        </section>

        <!-- Users Grid -->
        <section class="mb-5">
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e(($loop->index % 3) * 100); ?>">
                    <div class="user-card" 
                         data-role="<?php echo e($user->role_id); ?>"
                         data-name="<?php echo e(strtolower($user->nom)); ?>"
                         data-email="<?php echo e(strtolower($user->email)); ?>"
                         data-id="<?php echo e($user->id); ?>">
                        
                        <div class="user-avatar">
                            <?php echo e(substr($user->nom, 0, 2)); ?>

                        </div>
                        
                        <div class="user-name"><?php echo e($user->nom); ?></div>
                        <div class="user-id">EMP<?php echo e(str_pad($user->id, 4, '0', STR_PAD_LEFT)); ?></div>
                        
                        <div class="user-role role-<?php echo e(strtolower(str_replace('é', 'e', $user->role->nom))); ?>">
                            <?php echo e($user->role->nom); ?>

                        </div>
                        
                        <div class="user-details">
                            <div class="detail-item">
                                <i class="fas fa-envelope"></i>
                                <span class="detail-text"><?php echo e($user->email); ?></span>
                            </div>
                            
                            <?php if($user->date_embauche): ?>
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="detail-text">Embauche : <?php echo e(\Carbon\Carbon::parse($user->date_embauche)->format('d/m/Y')); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <div class="detail-item">
                                <i class="fas fa-user-clock"></i>
                                <span class="detail-text">Membre depuis <?php echo e(\Carbon\Carbon::parse($user->created_at)->diffForHumans()); ?></span>
                            </div>
                        </div>
                        
                        <div class="user-stats">
                            <div class="user-stat">
                                <span class="stat-number"><?php echo e(rand(1, 15)); ?></span>
                                <span class="stat-description">Chantiers</span>
                            </div>
                            <div class="user-stat">
                                <span class="stat-number"><?php echo e(rand(85, 100)); ?>%</span>
                                <span class="stat-description">Disponibilité</span>
                            </div>
                            <div class="user-stat">
                                <span class="stat-number"><?php echo e(rand(1, 36)); ?></span>
                                <span class="stat-description">Mois</span>
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <a href="<?php echo e(route('users.show', $user->id)); ?>" class="action-btn btn-view">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="action-btn btn-edit">
                                <i class="fas fa-edit"></i> Éditer
                            </a>
                            <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="action-btn btn-delete" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12" data-aos="fade-up">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="empty-state-title">Aucun membre d'équipe</h3>
                        <p class="mb-4">Commencez par ajouter votre premier membre d'équipe</p>
                        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark)); border: none; padding: 15px 30px; border-radius: var(--border-radius);">
                            <i class="fas fa-user-plus me-2"></i>Ajouter un membre
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Pagination -->
        <?php if(method_exists($users, 'links') && $users->hasPages()): ?>
        <section data-aos="fade-up">
            <div class="d-flex justify-content-center">
                <?php echo e($users->links('pagination::bootstrap-5')); ?>

            </div>
        </section>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="mt-5 pt-4 pb-3" style="background: var(--primary-color); color: white;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-building fa-2x" style="opacity: 0.8;"></i>
                        <div>
                            <h5 class="mb-1" style="color: white;">Constructo Gestion</h5>
                            <p class="mb-0" style="opacity: 0.8;">Solution de gestion pour entreprises du BTP</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">
                        © <?php echo e(date('Y')); ?> Constructo. Tous droits réservés. 
                        <span class="d-block d-md-inline mt-2 mt-md-0 ms-md-3" style="opacity: 0.8;">Version 2.0</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const roleFilter = document.getElementById('roleFilter');
            const userCards = document.querySelectorAll('.user-card');
            
            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedRole = roleFilter.value;
                
                userCards.forEach(card => {
                    const name = card.dataset.name;
                    const email = card.dataset.email;
                    const role = card.dataset.role;
                    const id = card.dataset.id;
                    
                    let matchesSearch = !searchTerm || 
                        name.includes(searchTerm) || 
                        email.includes(searchTerm) ||
                        id.includes(searchTerm);
                    
                    let matchesRole = !selectedRole || role === selectedRole;
                    
                    if (matchesSearch && matchesRole) {
                        card.closest('.col-xl-4').style.display = 'block';
                        // Add animation
                        card.style.animation = 'fadeInUp 0.4s ease forwards';
                    } else {
                        card.closest('.col-xl-4').style.display = 'none';
                    }
                });
                
                // Check if any cards are visible
                const visibleCards = Array.from(userCards).filter(card => 
                    card.closest('.col-xl-4').style.display !== 'none'
                );
                
                // Show empty state if no cards
                const emptyState = document.querySelector('.empty-state');
                if (emptyState) {
                    emptyState.style.display = visibleCards.length === 0 ? 'block' : 'none';
                }
            }
            
            // Event listeners
            searchInput.addEventListener('input', filterUsers);
            roleFilter.addEventListener('change', filterUsers);
            
            // Add hover effects
            userCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '10';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = '1';
                });
            });
            
            // Initialize
            filterUsers();
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/users/edit.blade.php ENDPATH**/ ?>