<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda - Szlazak Gestion</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    
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
            --fc-event-chantier: #3498db;
            --fc-event-reunion: #2ecc71;
            --fc-event-livraison: #f39c12;
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

        /* Style personnalisé pour FullCalendar */
        .calendar-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        #calendar {
            font-family: 'Roboto', sans-serif;
        }

        .fc-toolbar-title {
            font-family: 'Playfair Display', serif;
            color: var(--bleu-marine) !important;
            font-weight: 600;
        }

        .fc-button {
            background-color: white !important;
            border: 1px solid var(--border-color) !important;
            color: var(--bleu-marine) !important;
            font-weight: 500 !important;
        }

        .fc-button:hover {
            background-color: var(--bleu-marine) !important;
            color: white !important;
        }

        .fc-button-primary:not(:disabled).fc-button-active {
            background-color: var(--bleu-marine) !important;
            border-color: var(--bleu-marine) !important;
        }

        .fc-col-header-cell {
            background-color: var(--bg-secondary);
            color: var(--bleu-marine);
            font-weight: 600;
            padding: 10px 0;
        }

        .fc-day-today {
            background-color: rgba(22, 32, 72, 0.05) !important;
        }

        /* Styles personnalisés pour les événements */
        .fc-event {
            border: none !important;
            border-radius: 6px !important;
            font-size: 0.85rem !important;
            font-weight: 500 !important;
            padding: 3px 8px !important;
        }

        .fc-event-chantier {
            background-color: var(--fc-event-chantier) !important;
            border-left: 4px solid #2980b9 !important;
        }

        .fc-event-reunion {
            background-color: var(--fc-event-reunion) !important;
            border-left: 4px solid #27ae60 !important;
        }


        .fc-event-livraison {
            background-color: var(--fc-event-livraison) !important;
            border-left: 4px solid #d35400 !important;
        }


        /* Filtres et légende */
        .filters-section {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
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

        /* Liste des événements */
        .events-list-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
        }

        .event-item {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            border-left: 4px solid transparent;
            transition: all var(--transition-speed) ease;
        }

        .event-item:hover {
            background-color: var(--highlight-color);
            transform: translateX(5px);
        }

        .event-item:last-child {
            border-bottom: none;
        }

        .event-item.chantier { border-left-color: var(--fc-event-chantier); }
        .event-item.reunion { border-left-color: var(--fc-event-reunion); }
        .event-item.livraison { border-left-color: var(--fc-event-livraison); }

        .event-time {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
        }

        .event-title {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 5px;
        }

        .event-details {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-a-venir {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .badge-en-cours {
            background-color: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }

        .badge-termine {
            background-color: rgba(149, 165, 166, 0.1);
            color: #95a5a6;
        }

        /* Modal personnalisé */
        .modal-custom .modal-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .modal-custom .btn-close {
            filter: brightness(0) invert(1);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .action-buttons .btn {
            padding: 6px 12px;
            font-size: 0.85rem;
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
                        <a class="nav-link active" href="<?php echo e(route('evenements.index')); ?>">
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
                    <h1><i class="fas fa-calendar-alt me-3"></i>Agenda</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Gérez vos événements et planifiez vos interventions</p>
                </div>
                <div>
                    <a href="<?php echo e(route('evenements.create')); ?>" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Nouvel événement
                    </a>
                </div>
            </div>
        </div>

        <!-- Filtres et Légende -->
        <div class="filters-section animate__animated animate__fadeIn animate__delay-1s">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0" style="color: var(--bleu-marine);">
                    <i class="fas fa-filter me-2"></i>Filtres & Légende
                </h5>
                <button class="btn btn-sm btn-outline-primary" id="viewToggle">
                    <i class="fas fa-list me-2"></i>Vue Liste
                </button>
            </div>
            
            <div class="filter-group">
                <select class="filter-select" id="typeFilter">
                    <option value="">Tous les types</option>
                    <option value="chantier">Chantier</option>
                    <option value="reunion">Réunion</option>
                    <option value="livraison">Livraison</option>
                    <option value="autre">Autre</option>
                </select>
                
                <select class="filter-select" id="statutFilter">
                    <option value="">Tous les statuts</option>
                    <option value="À venir">À venir</option>
                    <option value="En cours">En cours</option>
                    <option value="Terminé">Terminé</option>
                    <option value="Annulé">Annulé</option>
                </select>
                
                <select class="filter-select" id="responsableFilter">
                    <option value="">Tous les responsables</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->nom); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="legend-container">
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--fc-event-chantier);"></div>
                    <span>Chantier</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--fc-event-reunion);"></div>
                    <span>Réunion</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: var(--fc-event-livraison);"></div>
                    <span>Livraison</span>
                </div>
            </div>
        </div>

        <!-- Calendar Container -->
        <div id="calendarContainer" class="calendar-container animate__animated animate__fadeIn animate__delay-2s">
            <div id="calendar"></div>
        </div>

        <!-- Liste des Événements (initialement cachée) -->
        <div id="listContainer" class="events-list-card animate__animated animate__fadeIn animate__delay-2s" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 style="color: var(--bleu-marine);">
                    <i class="fas fa-list me-2"></i>Liste des Événements
                </h5>
                <a href="<?php echo e(route('evenements.create')); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i>Ajouter
                </a>
            </div>
            
            <div id="eventsList">
                <?php $__empty_1 = true; $__currentLoopData = $evenements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evenement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="event-item <?php echo e($evenement->type ?? 'chantier'); ?>" 
                         data-id="<?php echo e($evenement->id); ?>"
                         data-type="<?php echo e($evenement->type ?? 'chantier'); ?>"
                         data-statut="<?php echo e($evenement->statut); ?>"
                         data-responsable="<?php echo e($evenement->user_id); ?>">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="event-time">
                                    <i class="fas fa-clock me-1"></i>
                                    <?php echo e(\Carbon\Carbon::parse($evenement->date_debut)->format('d/m/Y H:i')); ?>

                                    <?php if($evenement->date_fin): ?>
                                        - <?php echo e(\Carbon\Carbon::parse($evenement->date_fin)->format('H:i')); ?>

                                    <?php endif; ?>
                                </div>
                                <div class="event-title">
                                    <?php echo e($evenement->titre); ?>

                                    <span class="badge-status ms-2
                                        <?php if($evenement->statut == 'À venir'): ?> badge-a-venir
                                        <?php elseif($evenement->statut == 'En cours'): ?> badge-en-cours
                                        <?php elseif($evenement->statut == 'Terminé'): ?> badge-termine
                                        <?php else: ?> badge-termine <?php endif; ?>">
                                        <?php echo e($evenement->statut); ?>

                                    </span>
                                </div>
                                <div class="event-details">
                                    <i class="fas fa-user me-1"></i><?php echo e($evenement->user->nom ?? 'Non assigné'); ?>

                                    <?php if($evenement->chantier): ?>
                                        • <i class="fas fa-project-diagram me-1"></i><?php echo e($evenement->chantier->nom); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <a href="<?php echo e(route('evenements.show', $evenement->id)); ?>" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('evenements.edit', $evenement->id)); ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x mb-3" style="color: var(--text-secondary);"></i>
                        <p class="text-muted">Aucun événement trouvé</p>
                        <a href="<?php echo e(route('evenements.create')); ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer votre premier événement
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pagination pour la liste -->
        <?php if(method_exists($evenements, 'links') && $evenements->hasPages()): ?>
            <div class="pagination-custom mt-3" id="listPagination" style="display: none;">
                <?php echo e($evenements->links()); ?>

            </div>
        <?php endif; ?>

        <!-- Modal pour les détails de l'événement -->
        <div class="modal fade modal-custom" id="eventModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="eventModalBody">
                        <!-- Contenu chargé dynamiquement -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <a href="#" class="btn btn-primary" id="eventModalEdit">Modifier</a>
                    </div>
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
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser FullCalendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour',
                    list: 'Liste'
                },
                events: [
                    // Convertir les événements PHP en format FullCalendar
                    <?php $__currentLoopData = $evenements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        id: '<?php echo e($event->id); ?>',
                        title: '<?php echo e($event->titre); ?>',
                        start: '<?php echo e($event->date_debut); ?>',
                        <?php if($event->date_fin): ?>
                            end: '<?php echo e($event->date_fin); ?>',
                        <?php endif; ?>
                        extendedProps: {
                            type: '<?php echo e($event->type ?? "chantier"); ?>',
                            statut: '<?php echo e($event->statut); ?>',
                            responsable: '<?php echo e($event->user->nom ?? ""); ?>',
                            description: '<?php echo e(addslashes($event->description ?? "")); ?>',
                            chantier: '<?php echo e($event->chantier->nom ?? ""); ?>',
                            responsable_id: '<?php echo e($event->user_id); ?>'
                        },
                        className: 'fc-event-<?php echo e($event->type ?? "chantier"); ?>',
                        backgroundColor: getEventColor('<?php echo e($event->type ?? "chantier"); ?>'),
                        borderColor: getEventBorderColor('<?php echo e($event->type ?? "chantier"); ?>'),
                        textColor: 'white'
                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                eventClick: function(info) {
                    const event = info.event;
                    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
                    
                    // Remplir le modal
                    document.getElementById('eventModalTitle').textContent = event.title;
                    document.getElementById('eventModalEdit').href = `/evenements/${event.id}/edit`;
                    
                    const modalBody = document.getElementById('eventModalBody');
                    modalBody.innerHTML = `
                        <div class="mb-3">
                            <strong><i class="fas fa-clock me-2"></i>Date et heure:</strong><br>
                            ${event.start ? formatCalendarDate(event.start) : ''}
                            ${event.end ? ` - ${formatCalendarTime(event.end)}` : ''}
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-tag me-2"></i>Type:</strong><br>
                            <span class="badge" style="background-color: ${event.backgroundColor}; color: white; padding: 4px 8px; border-radius: 4px;">
                                ${getEventTypeName(event.extendedProps.type)}
                            </span>
                        </div>
                        <div class="mb-3">
                            <strong><i class="fas fa-user me-2"></i>Responsable:</strong><br>
                            ${event.extendedProps.responsable || 'Non assigné'}
                        </div>
                        ${event.extendedProps.chantier ? `
                        <div class="mb-3">
                            <strong><i class="fas fa-project-diagram me-2"></i>Chantier:</strong><br>
                            ${event.extendedProps.chantier}
                        </div>
                        ` : ''}
                        ${event.extendedProps.description ? `
                        <div class="mb-3">
                            <strong><i class="fas fa-align-left me-2"></i>Description:</strong><br>
                            ${event.extendedProps.description}
                        </div>
                        ` : ''}
                        <div class="mb-3">
                            <strong><i class="fas fa-flag me-2"></i>Statut:</strong><br>
                            <span class="badge-status ${getStatusClass(event.extendedProps.statut)}">
                                ${event.extendedProps.statut}
                            </span>
                        </div>
                    `;
                    
                    modal.show();
                },
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                height: 650,
                navLinks: true,
                dayMaxEvents: true,
                nowIndicator: true,
                selectable: true,
                selectMirror: true,
                weekends: true,
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5],
                    startTime: '08:00',
                    endTime: '18:00',
                },
                dayMaxEventRows: 3,
                handleWindowResize: true,
                windowResizeDelay: 100
            });

            calendar.render();

            // Fonction pour obtenir la couleur de l'événement
            function getEventColor(type) {
                const colors = {
                    'chantier': '#3498db',
                    'reunion': '#2ecc71',
                    'livraison': '#f39c12',
                    'autre': '#95a5a6'
                };
                return colors[type] || '#3498db';
            }

            // Fonction pour obtenir la couleur de bordure
            function getEventBorderColor(type) {
                const colors = {
                    'chantier': '#2980b9',
                    'reunion': '#27ae60',
                    'livraison': '#d35400',
                    'autre': '#7f8c8d'
                };
                return colors[type] || '#2980b9';
            }

            // Fonction pour obtenir le nom du type
            function getEventTypeName(type) {
                const names = {
                    'chantier': 'Chantier',
                    'reunion': 'Réunion',
                    'livraison': 'Livraison',
                    'autre': 'Autre'
                };
                return names[type] || 'Événement';
            }

            // Fonction pour formater la date
            function formatCalendarDate(date) {
                return date.toLocaleDateString('fr-FR', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Fonction pour formater l'heure
            function formatCalendarTime(date) {
                return date.toLocaleTimeString('fr-FR', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Fonction pour obtenir la classe du statut
            function getStatusClass(statut) {
                if (statut === 'À venir') return 'badge-a-venir';
                if (statut === 'En cours') return 'badge-en-cours';
                if (statut === 'Terminé') return 'badge-termine';
                if (statut === 'Annulé') return 'badge-termine';
                return 'badge-termine';
            }

            // Toggle entre vue calendrier et vue liste
            const viewToggle = document.getElementById('viewToggle');
            const calendarContainer = document.getElementById('calendarContainer');
            const listContainer = document.getElementById('listContainer');
            const listPagination = document.getElementById('listPagination');

            viewToggle.addEventListener('click', function() {
                if (calendarContainer.style.display !== 'none') {
                    // Passer à la vue liste
                    calendarContainer.style.display = 'none';
                    listContainer.style.display = 'block';
                    if (listPagination) listPagination.style.display = 'flex';
                    viewToggle.innerHTML = '<i class="fas fa-calendar-alt me-2"></i>Vue Calendrier';
                } else {
                    // Passer à la vue calendrier
                    calendarContainer.style.display = 'block';
                    listContainer.style.display = 'none';
                    if (listPagination) listPagination.style.display = 'none';
                    viewToggle.innerHTML = '<i class="fas fa-list me-2"></i>Vue Liste';
                }
            });

            // Filtres
            const typeFilter = document.getElementById('typeFilter');
            const statutFilter = document.getElementById('statutFilter');
            const responsableFilter = document.getElementById('responsableFilter');

            function applyFilters() {
                const type = typeFilter.value;
                const statut = statutFilter.value;
                const responsable = responsableFilter.value;
                
                // Filtrer les événements dans le calendrier
                calendar.getEvents().forEach(event => {
                    let show = true;
                    
                    if (type && event.extendedProps.type !== type) {
                        show = false;
                    }
                    
                    if (statut && event.extendedProps.statut !== statut) {
                        show = false;
                    }
                    
                    if (responsable && event.extendedProps.responsable_id != responsable) {
                        show = false;
                    }
                    
                    event.setProp('display', show ? 'auto' : 'none');
                });
                
                // Filtrer les événements dans la liste
                const eventItems = document.querySelectorAll('.event-item');
                eventItems.forEach(item => {
                    let show = true;
                    
                    if (type && item.dataset.type !== type) {
                        show = false;
                    }
                    
                    if (statut && item.dataset.statut !== statut) {
                        show = false;
                    }
                    
                    if (responsable && item.dataset.responsable != responsable) {
                        show = false;
                    }
                    
                    item.style.display = show ? 'flex' : 'none';
                });
                
                // Mettre à jour le compteur
                const visibleEvents = calendar.getEvents().filter(event => event.display !== 'none').length;
                const totalEvents = calendar.getEvents().length;
                
                // Mettre à jour le badge dans le header si existant
                const countBadge = document.querySelector('.event-count');
                if (!countBadge) {
                    const countElement = document.createElement('span');
                    countElement.className = 'event-count badge bg-primary ms-2';
                    countElement.textContent = `${visibleEvents}/${totalEvents}`;
                    viewToggle.parentElement.appendChild(countElement);
                } else {
                    countBadge.textContent = `${visibleEvents}/${totalEvents}`;
                }
            }

            // Écouter les changements de filtre
            typeFilter.addEventListener('change', applyFilters);
            statutFilter.addEventListener('change', applyFilters);
            responsableFilter.addEventListener('change', applyFilters);

            // Animation des éléments de la liste
            const eventItems = document.querySelectorAll('.event-item');
            eventItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.05}s`;
                item.classList.add('animate__animated', 'animate__fadeIn');
            });

            // Initialiser les filtres
            applyFilters();
            
            // Ajouter un événement à l'agenda en cliquant sur une date
            calendar.on('dateClick', function(info) {
                const date = info.dateStr;
                window.location.href = `/evenements/create?date_debut=${date}`;
            });

            // Gestion des touches pour navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && document.getElementById('eventModal').classList.contains('show')) {
                    bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\constructo\resources\views/evenements/index.blade.php ENDPATH**/ ?>