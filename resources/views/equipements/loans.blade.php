<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunts - Stockage</title>
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
            --status-ok: #198754;
            --status-warn: #ffc107;
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

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 18px 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(22, 32, 72, 0.1);
            color: var(--bleu-marine);
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

        .table-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 15px var(--shadow-color);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table thead th {
            background: #eef2ff;
            color: var(--bleu-marine);
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
        }

        .badge-status {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-ok { background: rgba(25, 135, 84, 0.12); color: var(--status-ok); }
        .badge-warn { background: rgba(255, 193, 7, 0.18); color: #996b00; }

        .muted {
            color: var(--text-secondary);
        }
    </style>
</head>
<body>
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1><i class="fas fa-boxes me-3"></i>Emprunts de Stockage</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Suivi des emprunts et retours du matériel</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('equipements.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Retour Stockage
                    </a>
                </div>
            </div>
        </div>

        @php
            $total = $loans->count();
            $enCours = $loans->whereNull('date_retour')->count();
            $retournes = $loans->whereNotNull('date_retour')->count();
        @endphp

        <div class="row g-3 mb-4 animate__animated animate__fadeIn animate__delay-1s">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-list"></i></div>
                    <div>
                        <div class="muted">Total emprunts</div>
                        <div class="fs-5 fw-semibold">{{ $total }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-hand-holding"></i></div>
                    <div>
                        <div class="muted">En cours</div>
                        <div class="fs-5 fw-semibold">{{ $enCours }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-rotate-left"></i></div>
                    <div>
                        <div class="muted">Retournés</div>
                        <div class="fs-5 fw-semibold">{{ $retournes }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" id="searchLoans"
                   placeholder="Rechercher par équipement, Employé ou chantier...">
        </div>

        <div class="table-card animate__animated animate__fadeIn animate__delay-1s">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Équipement</th>
                            <th>Quantité</th>
                            <th>Employé</th>
                            <th>Chantier</th>
                            <th>Emprunt</th>
                            <th>Retour</th>
                            <th>État après retour</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="loansTable">
                        @forelse($loans as $loan)
                            @php
                                $equipement = $loan->equipement;
                                $user = $loan->user;
                                $chantier = $loan->chantier;
                                $isReturned = !is_null($loan->date_retour);
                            @endphp
                            <tr class="loan-row"
                                data-equipement="{{ strtolower($equipement->nom ?? '') }}"
                                data-user="{{ strtolower($user->nom ?? '') }}"
                                data-chantier="{{ strtolower($chantier->nom ?? '') }}">
                                <td>
                                    <div class="fw-semibold">{{ $equipement->nom ?? 'N/A' }}</div>
                                    <div class="muted small">{{ $equipement->localisation ?? '—' }}</div>
                                </td>
                                <td>{{ $loan->quantite }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $user->nom ?? 'N/A' }}</div>
                                    <div class="muted small">{{ $user->email ?? '' }}</div>
                                </td>
                                <td>{{ $chantier->nom ?? '—' }}</td>
                                <td>{{ optional($loan->date_emprunt)->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($loan->date_retour)
                                        {{ $loan->date_retour->format('d/m/Y H:i') }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ $loan->etat_apres_retour ?? '—' }}</td>
                                <td>
                                    @if($isReturned)
                                        <span class="badge-status badge-ok">Retourné</span>
                                    @else
                                        <span class="badge-status badge-warn">En cours</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$isReturned)
                                    <form action="{{ route('equipements.loans.return', $loan->id) }}" method="POST" class="d-flex flex-wrap gap-2 align-items-center">
                                        @csrf
                                        <select name="etat_apres_retour" class="form-select form-select-sm" style="min-width: 160px;" required>
                                            <option value="">État après retour</option>
                                            <option value="Bon état">Bon état</option>
                                            <option value="Usé">Usé</option>
                                            <option value="En maintenance">En maintenance</option>
                                            <option value="Endommagé">Endommagé</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-success"
                                                onclick="return confirm('Marquer cet emprunt comme retourné ? Le stock sera mis à jour.')">
                                            <i class="fas fa-rotate-left me-1"></i>Retour
                                        </button>
                                    </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 muted">
                                    Aucun emprunt pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @include('partials.app-footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchLoans');
            const rows = document.querySelectorAll('.loan-row');

            searchInput.addEventListener('input', function () {
                const term = this.value.toLowerCase().trim();
                rows.forEach(row => {
                    const equipement = row.dataset.equipement || '';
                    const user = row.dataset.user || '';
                    const chantier = row.dataset.chantier || '';
                    const match = !term || equipement.includes(term) || user.includes(term) || chantier.includes(term);
                    row.style.display = match ? '' : 'none';
                });
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>

