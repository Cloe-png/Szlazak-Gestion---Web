<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Nouveau Devis'); ?> - Szlazak Gestion</title>
    
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

        .page-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 12px;
            padding: 25px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        .page-header h1 {
            color: white;
            margin-bottom: 0;
        }

        .form-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 0.2rem rgba(22, 32, 72, 0.25);
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

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-section-title {
            color: var(--bleu-marine);
            font-size: 1.2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--bleu-clair);
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
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-file-invoice me-3"></i>
                        <?php if(isset($devis)): ?>
                            Modifier le devis #DV<?php echo e(str_pad($devis->id, 4, '0', STR_PAD_LEFT)); ?>

                        <?php else: ?>
                            Nouveau devis
                        <?php endif; ?>
                    </h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">
                        <?php if(isset($devis)): ?>
                            Modifiez les informations de ce devis
                        <?php else: ?>
                            Créez un nouveau devis pour vos clients
                        <?php endif; ?>
                    </p>
                </div>
                <a href="<?php echo e(route('devis.index')); ?>" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>

        <!-- Messages d'erreur -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <div class="form-container">
            <form action="<?php echo e(isset($devis) ? route('devis.update', $devis->id) : route('devis.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php if(isset($devis)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <!-- Section Informations Client -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-user me-2"></i>Informations du client
                    </h3>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom_client" class="form-label required-field">Nom du client</label>
                            <input type="text" class="form-control" id="nom_client" name="nom_client" 
                                   value="<?php echo e(old('nom_client', $devis->nom_client ?? '')); ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required-field">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo e(old('email', $devis->email ?? '')); ?>" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" 
                                   value="<?php echo e(old('telephone', $devis->telephone ?? '')); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="date_reception" class="form-label">Date de réception</label>
                            <input type="date" class="form-control" id="date_reception" name="date_reception" 
                                   value="<?php echo e(old('date_reception', $devis->date_reception ?? '')); ?>">
                        </div>
                    </div>
                </div>

                <!-- Section Détails du Devis -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle me-2"></i>Détails du devis
                    </h3>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label required-field">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo e(old('description', $devis->description ?? '')); ?></textarea>
                        <div class="form-text">Décrivez le projet ou les travaux à réaliser</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut">
                                <option value="En attente" <?php echo e(old('statut', $devis->statut ?? 'En attente') == 'En attente' ? 'selected' : ''); ?>>En attente</option>
                                <option value="En cours" <?php echo e(old('statut', $devis->statut ?? '') == 'En cours' ? 'selected' : ''); ?>>En cours</option>
                                <option value="Terminé" <?php echo e(old('statut', $devis->statut ?? '') == 'Terminé' ? 'selected' : ''); ?>>Terminé</option>
                                <option value="Refusé" <?php echo e(old('statut', $devis->statut ?? '') == 'Refusé' ? 'selected' : ''); ?>>Refusé</option>
                                <option value="Archivé" <?php echo e(old('statut', $devis->statut ?? '') == 'Archivé' ? 'selected' : ''); ?>>Archivé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?php echo e(route('devis.index')); ?>" class="btn btn-secondary-custom">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                    
                    <div class="d-flex gap-3">
                        <?php if(isset($devis)): ?>
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-plus-circle me-2"></i>Créer le devis
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
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
            // Mettre la date du jour par défaut si création
            <?php if(!isset($devis)): ?>
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('date_reception').value = today;
            <?php endif; ?>
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/devis/edit.blade.php ENDPATH**/ ?>