<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis détail - Szlazak Gestion</title>
    
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
            --statut-en-attente: #ffc107;
            --statut-en-cours: #3498db;
            --statut-accepte: #2ecc71;
            --statut-refuse: #e74c3c;
            --statut-archive: #95a5a6;
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

        /* Cartes principales */
        .main-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .main-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
        }

        /* En-tête devis */
        .devis-header-detail {
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .devis-title-detail {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .devis-id-detail {
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 500;
            display: inline-block;
        }

        .devis-statut-detail {
            padding: 10px 25px;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 500;
            display: inline-block;
            min-width: 150px;
            text-align: center;
        }

        .statut-en-attente { 
            background-color: rgba(255, 193, 7, 0.1); 
            color: var(--statut-en-attente); 
            border: 1px solid rgba(255, 193, 7, 0.2); 
        }
        .statut-en-cours { 
            background-color: rgba(52, 152, 219, 0.1); 
            color: var(--statut-en-cours); 
            border: 1px solid rgba(52, 152, 219, 0.2); 
        }
        .statut-accepte { 
            background-color: rgba(46, 204, 113, 0.1); 
            color: var(--statut-accepte); 
            border: 1px solid rgba(46, 204, 113, 0.2); 
        }
        .statut-refuse { 
            background-color: rgba(231, 76, 60, 0.1); 
            color: var(--statut-refuse); 
            border: 1px solid rgba(231, 76, 60, 0.2); 
        }
        .statut-archive { 
            background-color: rgba(149, 165, 166, 0.1); 
            color: var(--statut-archive); 
            border: 1px solid rgba(149, 165, 166, 0.2); 
        }

        /* Cartes d'information */
        .info-section {
            margin-bottom: 30px;
        }

        .info-section-title {
            color: var(--bleu-marine);
            font-size: 1.4rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .info-card {
            background-color: var(--bg-primary);
            border-radius: 12px;
            padding: 25px;
            border-left: 4px solid var(--bleu-clair);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .info-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.2rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .info-icon {
            font-size: 1.5rem;
            color: var(--bleu-clair);
            margin-bottom: 15px;
        }

        /* Description */
        .description-card {
            background-color: var(--bg-primary);
            border-radius: 12px;
            padding: 30px;
            margin-top: 10px;
            border-left: 3px solid var(--bleu-clair);
        }

        .description-content {
            line-height: 1.8;
            color: var(--text-primary);
            white-space: pre-line;
            font-size: 1.05rem;
        }

        /* Métadonnées */
        .meta-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 0.95rem;
            background-color: var(--bg-primary);
            border-radius: 8px;
            padding: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Actions */
        .actions-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-top: 30px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-secondary-custom {
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-secondary-custom:hover {
            background-color: var(--border-color);
            color: var(--text-primary);
        }

        .btn-danger-custom {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-danger-custom:hover {
            background-color: #dc3545;
            color: white;
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
                        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                            <i class="fas fa-home me-1"></i>Tableau de bord
                        </a>
                    </li>
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
                        <a class="nav-link active" href="<?php echo e(route('devis.index')); ?>">
                            <i class="fas fa-file-invoice me-1"></i>Devis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('evenements.index')); ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Agenda
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
                    <h1><i class="fas fa-file-invoice me-3"></i>Détails du devis</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Informations complètes sur ce devis</p>
                </div>
                <a href="<?php echo e(route('devis.index')); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux devis
                </a>
            </div>
        </div>

        <!-- Contenu principal du devis -->
        <div class="main-card animate__animated animate__fadeIn animate__delay-1s">
            <!-- En-tête -->
            <div class="devis-header-detail">
                <div>
                    <div class="devis-title-detail"><?php echo e($devis->nom_client); ?></div>
                    <div class="devis-id-detail">#DV<?php echo e(str_pad($devis->id, 4, '0', STR_PAD_LEFT)); ?></div>
                </div>
                <div class="devis-statut-detail statut-<?php echo e(strtolower(str_replace(' ', '-', $devis->statut))); ?>">
                    <?php echo e($devis->statut); ?>

                </div>
            </div>

            <!-- Informations client -->
            <div class="info-section animate__animated animate__fadeIn animate__delay-2s">
                <h3 class="info-section-title">
                    <i class="fas fa-user-circle"></i>
                    Informations client
                </h3>
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="info-label">Nom du client</div>
                        <div class="info-value"><?php echo e($devis->nom_client); ?></div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo e($devis->email); ?></div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-label">Téléphone</div>
                        <div class="info-value"><?php echo e($devis->telephone ?? 'Non renseigné'); ?></div>
                    </div>
                </div>
            </div>

            <!-- Détails du devis -->
            <div class="info-section animate__animated animate__fadeIn animate__delay-3s">
                <h3 class="info-section-title">
                    <i class="fas fa-info-circle"></i>
                    Détails du devis
                </h3>
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="info-label">Statut</div>
                        <div class="info-value"><?php echo e($devis->statut); ?></div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="info-label">Date de réception</div>
                        <div class="info-value">
                            <?php echo e($devis->date_reception ? \Carbon\Carbon::parse($devis->date_reception)->format('d/m/Y') : 'Non définie'); ?>

                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="info-label">Date de création</div>
                        <div class="info-value"><?php echo e($devis->created_at->format('d/m/Y')); ?></div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <?php if($devis->description): ?>
            <div class="info-section animate__animated animate__fadeIn animate__delay-4s">
                <h3 class="info-section-title">
                    <i class="fas fa-align-left"></i>
                    Description du projet
                </h3>
                <div class="description-card">
                    <div class="description-content"><?php echo e($devis->description); ?></div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Métadonnées -->
            <div class="meta-info animate__animated animate__fadeIn">
                <div class="meta-item">
                    <i class="fas fa-calendar-plus" style="color: var(--bleu-clair);"></i>
                    <span>Créé le <?php echo e($devis->created_at->format('d/m/Y à H:i')); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock" style="color: var(--bleu-clair);"></i>
                    <span>Dernière modification le <?php echo e($devis->updated_at->format('d/m/Y à H:i')); ?></span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions-section animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="<?php echo e(route('devis.index')); ?>" class="btn btn-secondary-custom">
                        <i class="fas fa-list me-2"></i>Voir tous les devis
                    </a>
                </div>
                <div class="action-buttons">
                    <a href="<?php echo e(route('devis.edit', $devis->id)); ?>" class="btn btn-primary-custom">
                        <i class="fas fa-edit me-2"></i>Modifier le devis
                    </a>
                    <form action="<?php echo e(route('devis.destroy', $devis->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger-custom" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devis ?')">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
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
            // Animation des cartes d'information
            const infoCards = document.querySelectorAll('.info-card');
            infoCards.forEach((card, index) => {
                card.style.animationDelay = `${(index % 3) * 0.1}s`;
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/devis/show.blade.php ENDPATH**/ ?>