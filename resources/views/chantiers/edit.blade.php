<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Chantier - Szlazak Gestion</title>
    @include('partials.app-head')
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    @include('partials.app-navbar')

    <main class="container py-5">
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-pen-to-square me-3"></i>Modifier un Chantier</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Mettez à jour les informations du chantier</p>
                </div>
                <a href="{{ route('chantiers.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">
            <form action="{{ route('chantiers.update', $chantier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group-custom">
                        <label for="nom">Nom du Chantier</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $chantier->nom }}" required>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="statut">Statut</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="En cours" {{ $chantier->statut == 'En cours' ? 'selected' : '' }}>En cours</option>
                            <option value="À venir" {{ $chantier->statut == 'À venir' ? 'selected' : '' }}>À venir</option>
                            <option value="Terminé" {{ $chantier->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="date_debut">Date de Début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $chantier->date_debut ? $chantier->date_debut->format('Y-m-d') : '' }}">
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="date_fin">Date de Fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $chantier->date_fin ? $chantier->date_fin->format('Y-m-d') : '' }}">
                    </div>

                    <div class="col-12 form-group-custom">
                        <label for="adresse">Adresse</label>
                        <textarea class="form-control" id="adresse" name="adresse" rows="3" required>{{ $chantier->adresse }}</textarea>
                    </div>

                    <div class="col-12 form-group-custom">
                        <label for="commentaire">Commentaire (admin)</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="3" placeholder="Commentaire interne (optionnel)">{{ old('commentaire', $chantier->commentaire) }}</textarea>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="user_ids">Attribuer à</label>
                        <select class="form-select" id="user_ids" name="user_ids[]" multiple>
                            @foreach($usersAssignable as $user)
                                <option value="{{ $user->id }}" {{ in_array($user->id, $assigneesIds ?? []) ? 'selected' : '' }}>{{ $user->id }} - {{ $user->nom }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs employés.</div>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="tarif">Tarif</label>
                        <input type="number" class="form-control" id="tarif" name="tarif" min="0" step="0.01" value="{{ $chantier->tarif ?? '' }}" placeholder="Ex: 25000.00">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('chantiers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-1"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </main>

    @include('partials.app-footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.app-scripts')
</body>
</html>
