<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Chantier - Szlazak Gestion</title>
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
                    <h1><i class="fas fa-plus-circle me-3"></i>Créer un Chantier</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Ajoutez un nouveau chantier à votre suivi</p>
                </div>
                <a href="{{ route('chantiers.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <div class="container-custom animate__animated animate__fadeIn animate__delay-1s">
            <form action="{{ route('chantiers.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 form-group-custom">
                        <label for="nom">Nom du Chantier</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="statut">Statut</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="En cours">En cours</option>
                            <option value="À venir">À venir</option>
                            <option value="Terminé">Terminé</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="date_debut">Date de Début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut">
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="date_fin">Date de Fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin">
                    </div>

                    <div class="col-12 form-group-custom">
                        <label for="adresse">Adresse</label>
                        <textarea class="form-control" id="adresse" name="adresse" rows="3" required></textarea>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="user_ids">Attribuer à</label>
                        <select class="form-select" id="user_ids" name="user_ids[]" multiple>
                            @foreach($usersAssignable as $user)
                                <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->nom }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs employés.</div>
                    </div>

                    <div class="col-md-6 form-group-custom">
                        <label for="tarif">Tarif</label>
                        <input type="number" class="form-control" id="tarif" name="tarif" min="0" step="0.01" placeholder="Ex: 25000.00">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('chantiers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-1"></i>Enregistrer
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
