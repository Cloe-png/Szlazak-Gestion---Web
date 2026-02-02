<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiches d'Heures - Szlazak Gestion</title>
    
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

        /* Dashboard Cards */
        .dashboard-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px var(--shadow-color);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(22, 32, 72, 0.2);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--bleu-marine);
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .card-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Table Styles */
        .table-personnel {
            font-size: 0.9rem;
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .table-personnel th {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border: none;
            padding: 15px 12px;
            font-weight: 600;
            font-family: 'Playfair Display', serif;
        }

        .table-personnel td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            transition: background-color var(--transition-speed) ease;
        }

        .table-personnel tbody tr:hover {
            background-color: var(--highlight-color);
        }

        /* Personne Row */
        .personne-row {
            background-color: rgba(22, 32, 72, 0.08);
            font-weight: 600;
            font-size: 1rem;
        }

        .personne-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .personne-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(22, 32, 72, 0.2);
        }

        /* Semaine Row */
        .semaine-row {
            background-color: rgba(143, 188, 143, 0.1);
            font-weight: 600;
            cursor: pointer;
            transition: background-color var(--transition-speed) ease;
        }

        .semaine-row:hover {
            background-color: rgba(143, 188, 143, 0.2);
        }

        .week-badge {
            background-color: #8FBC8F;
            color: white;
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 20px;
            margin-left: 10px;
            font-weight: 500;
        }

        /* Total Rows */
        .total-row {
            background-color: rgba(144, 238, 144, 0.15);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .total-personne-row {
            background-color: rgba(255, 165, 0, 0.1);
            font-weight: 700;
            border-top: 2px solid #FFA500 !important;
        }

        .global-total-row {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }

        /* Badges */
        .badge-heures {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            box-shadow: 0 2px 4px rgba(22, 32, 72, 0.2);
        }

        .badge-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .badge-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }

        /* Zone Badge */
        .badge-zone {
            background: linear-gradient(135deg, #6f42c1 0%, #8e44ad 100%);
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Button Styles */
        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Animation */
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

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-personnel {
                font-size: 0.8rem;
            }
            
            .personne-avatar {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
            
            .week-badge {
                font-size: 0.7rem;
                padding: 2px 6px;
            }
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
                        <a class="nav-link active" href="<?php echo e(route('timesheets.index')); ?>">
                            <i class="fas fa-clock me-1"></i>Fiches d'heures
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
        <!-- Page Header -->
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="text-white mb-2"><i class="fas fa-clock me-3"></i>Fiches d'Heures</h1>
                    <p class="mb-0" style="opacity: 0.9;">Vue hebdomadaire par personne avec totaux</p>
                </div>
                <div>
                    <a href="<?php echo e(route('timesheets.create')); ?>" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-plus me-2"></i>Nouvelle fiche
                    </a>
                </div>
            </div>
        </div>

        <!-- Tableau principal -->
        <div class="animate__animated animate__fadeIn animate__delay-1s">
            <div class="dashboard-card mb-4">
                <?php if($timesheets->count() > 0): ?>
                    <?php
                        $groupedByUser = $timesheets->groupBy('user_id');
                        $globalTotalHeures = 0;
                        $globalTotalHeuresSupp = 0;
                    ?>

                    <div class="table-responsive">
                        <table class="table table-hover table-personnel">
                            <thead>
                                <tr>
                                    <th>Personne / Date</th>
                                    <th>Chantier</th>
                                    <th>Zone</th>
                                    <th>Heures</th>
                                    <th>Pause</th>
                                    <th>H. Supp</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $groupedByUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $userTimesheets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $user = $userTimesheets->first()->user;
                                        $groupedByWeek = $userTimesheets->groupBy(function($item) {
                                            return \Carbon\Carbon::parse($item->date_travail)->format('Y-W');
                                        });
                                        $totalPersonne = $userTimesheets->sum('total_heures');
                                        $totalHeuresSuppPersonne = $userTimesheets->sum('heures_supp');
                                        $globalTotalHeures += $totalPersonne;
                                        $globalTotalHeuresSupp += $totalHeuresSuppPersonne;
                                    ?>
                                    
                                    <!-- Ligne personne -->
                                    <tr class="personne-row">
                                        <td colspan="8">
                                            <div class="personne-info">
                                                <div class="personne-avatar">
                                                    <?php echo e(substr($user->nom, 0, 1)); ?>

                                                </div>
                                                <div>
                                                    <strong><?php echo e($user->nom); ?></strong>
                                                    <small class="text-muted ms-2"><?php echo e($user->role->nom); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <?php $__currentLoopData = $groupedByWeek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekKey => $weekTimesheets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $totalSemaine = $weekTimesheets->sum('total_heures');
                                            $totalHeuresSuppSemaine = $weekTimesheets->sum('heures_supp');
                                            $firstDate = $weekTimesheets->first()->date_travail;
                                            $dateDebut = \Carbon\Carbon::parse($firstDate)->startOfWeek();
                                            $dateFin = \Carbon\Carbon::parse($firstDate)->endOfWeek();
                                            $weekNumber = \Carbon\Carbon::parse($firstDate)->weekOfYear;
                                        ?>
                                        
                                        <!-- Ligne semaine -->
                                        <tr class="semaine-row">
                                            <td>
                                                <i class="fas fa-calendar-week me-2"></i>
                                                Semaine <?php echo e($weekNumber); ?>

                                                <span class="week-badge"><?php echo e($dateDebut->format('d/m')); ?> - <?php echo e($dateFin->format('d/m')); ?></span>
                                            </td>
                                            <td colspan="6"></td>
                                            <td></td>
                                        </tr>
                                        
                                        <!-- Détails des jours -->
                                        <?php $__currentLoopData = $weekTimesheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar-day text-muted me-2"></i>
                                                    <div>
                                                        <strong><?php echo e(\Carbon\Carbon::parse($timesheet->date_travail)->format('d/m/Y')); ?></strong>
                                                        <div class="small text-muted"><?php echo e($timesheet->jour); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo e($timesheet->chantier->nom); ?>

                                                <div class="small text-muted"><?php echo e($timesheet->chantier->statut); ?></div>
                                            </td>
                                            <td>
                                                <?php if($timesheet->zone): ?>
                                                    <span class="badge badge-zone">Zone <?php echo e($timesheet->zone); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e(\Carbon\Carbon::parse($timesheet->heure_debut)->format('H:i')); ?><br>
                                                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($timesheet->heure_fin)->format('H:i')); ?></small>
                                            </td>
                                            <td>
                                                <?php if($timesheet->pause): ?>
                                                    <span class="badge bg-success">✓</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">✗</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($timesheet->heures_supp > 0): ?>
                                                <span class="text-warning fw-bold"><?php echo e($timesheet->heures_supp); ?>h</span>
                                                <?php else: ?>
                                                <span class="text-muted">0h</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-heures"><?php echo e($timesheet->total_heures); ?>h</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?php echo e(route('timesheets.edit', $timesheet)); ?>" class="btn btn-outline-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="<?php echo e(route('timesheets.destroy', $timesheet)); ?>" method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                                onclick="return confirm('Supprimer cette fiche ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <!-- Total semaine -->
                                        <tr class="total-row">
                                            <td colspan="5" class="text-end">
                                                <small>Total semaine <?php echo e($weekNumber); ?> :</small>
                                            </td>
                                            <td>
                                                <small class="text-warning fw-bold"><?php echo e($totalHeuresSuppSemaine); ?>h</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-heures badge-success"><?php echo e($totalSemaine); ?>h</span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <!-- Total personne -->
                                    <tr class="total-personne-row">
                                        <td colspan="5" class="text-end">
                                            <strong>Total <?php echo e($user->nom); ?> :</strong>
                                        </td>
                                        <td>
                                            <strong class="text-warning"><?php echo e($totalHeuresSuppPersonne); ?>h</strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-heures badge-primary"><?php echo e($totalPersonne); ?>h</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    
                                    <!-- Séparateur -->
                                    <tr>
                                        <td colspan="8" style="height: 10px; background-color: transparent;"></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                <!-- Total global -->
                                <tr class="global-total-row">
                                    <td colspan="5" class="text-end">
                                        <strong>TOTAL GLOBAL :</strong>
                                    </td>
                                    <td>
                                        <strong><?php echo e($globalTotalHeuresSupp); ?>h</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark"><?php echo e($globalTotalHeures); ?>h</span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if($timesheets->hasPages()): ?>
                    <div class="mt-4">
                        <?php echo e($timesheets->links()); ?>

                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <div class="card-icon mx-auto mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4 class="text-muted">Aucune fiche d'heures</h4>
                        <p class="mb-4">Commencez par créer votre première fiche d'heures</p>
                        <a href="<?php echo e(route('timesheets.create')); ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer une fiche
                        </a>
                    </div>
                <?php endif; ?>
            </div>
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
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/timesheets/index.blade.php ENDPATH**/ ?>