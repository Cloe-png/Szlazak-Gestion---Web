<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiches d'heures - Szlazak Gestion</title>
    @include('partials.app-head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .page-header {
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
        }

        .page-header h1 { color: white; margin-bottom: 0; }

        .container-custom {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
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

        .search-container {
            position: relative;
            margin: 20px 0;
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

        .btn-view {
            background-color: rgba(22, 32, 72, 0.1);
            color: var(--bleu-marine);
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .btn-view:hover {
            background-color: var(--bleu-marine);
            color: white;
        }
    </style>
</head>
<body>
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-clock me-3"></i>Mes fiches d'heures</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Vue en tableau</p>
                </div>
                <a href="{{ route('timesheets.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Ajouter
                </a>
            </div>
        </div>

        <div class="container-custom">
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

            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" id="searchTimesheets"
                       placeholder="Rechercher par chantier ou date...">
            </div>

            @if($timesheets->count() > 0)
            <div class="table-responsive">
                <table class="table-custom w-100">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Chantier</th>
                            <th>Horaires</th>
                            <th>Heures</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="timesheetTable">
                        @foreach($timesheets as $timesheet)
                            <tr data-chantier="{{ strtolower($timesheet->chantier->nom ?? '') }}"
                                data-date="{{ $timesheet->date_formatee }}">
                                <td>
                                    <div class="fw-semibold">{{ $timesheet->date_formatee }}</div>
                                    <div class="text-muted small">{{ $timesheet->jour }}</div>
                                </td>
                                <td>
                                    {{ $timesheet->chantier->nom ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $timesheet->heure_debut_formatee }} - {{ $timesheet->heure_fin_formatee }}
                                </td>
                                <td>
                                    {{ $timesheet->total_heures }}h
                                </td>
                                <td>
                                    <a href="{{ route('timesheets.show', $timesheet->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-clock"></i>
                <h4 class="mt-3" style="color: var(--text-secondary);">Aucune fiche d'heures</h4>
                <p class="mb-4">Commencez par créer votre première fiche</p>
                <a href="{{ route('timesheets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Créer une fiche
                </a>
            </div>
            @endif
        </div>
    </main>

    @include('partials.app-footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchTimesheets');
            const rows = document.querySelectorAll('#timesheetTable tr');

            searchInput.addEventListener('input', function () {
                const term = this.value.toLowerCase().trim();
                rows.forEach(row => {
                    const chantier = row.dataset.chantier || '';
                    const date = (row.dataset.date || '').toLowerCase();
                    const match = !term || chantier.includes(term) || date.includes(term);
                    row.style.display = match ? '' : 'none';
                });
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>
