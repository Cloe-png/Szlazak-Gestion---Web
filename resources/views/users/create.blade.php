<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Employé - Szlazak Gestion</title>
    @include('partials.app-head')
    
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

        .form-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px var(--shadow-color);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--bleu-clair);
            box-shadow: 0 0 0 3px rgba(22, 32, 72, 0.1);
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

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            font-weight: 600;
            margin: 0 auto 20px;
            box-shadow: 0 4px 15px rgba(22, 32, 72, 0.2);
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
    @include('partials.app-navbar')

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-user-plus me-3"></i>Nouvel Employé</h1>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Ajoutez un nouveau membre à votre équipe</p>
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'équipe
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <div class="avatar-preview" id="avatarPreview">
                ??
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-user me-2"></i>Nom complet *
                        </label>
                        <input type="text" name="nom" class="form-control" 
                               value="{{ old('nom') }}" required 
                               placeholder="Ex: Jean Dupont" id="nomInput">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email *
                        </label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email') }}" required 
                               placeholder="exemple@szlazak.fr">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>Mot de passe *
                        </label>
                        <input type="password" name="password" class="form-control" 
                               required placeholder="Minimum 8 caractères" id="password">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>Confirmer le mot de passe *
                        </label>
                        <input type="password" name="password_confirmation" class="form-control" 
                               required placeholder="Retapez le mot de passe">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-user-tag me-2"></i>Rôle *
                        </label>
                        <select name="role_id" class="form-select" required>
                            <option value="">Sélectionnez un rôle</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt me-2"></i>Date d'embauche
                        </label>
                        <input type="date" name="date_embauche" class="form-control" 
                               value="{{ old('date_embauche', date('Y-m-d')) }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-phone me-2"></i>Téléphone
                        </label>
                        <input type="tel" name="telephone" class="form-control" 
                               value="{{ old('telephone') }}" 
                               placeholder="Ex: 06 12 34 56 78">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt me-2"></i>Adresse
                        </label>
                        <input type="text" name="adresse" class="form-control" 
                               value="{{ old('adresse') }}" 
                               placeholder="Ex: 123 Rue de la Construction, 75000 Paris">
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Réinitialiser
                    </button>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer l'employé
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.app-footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mise à jour dynamique de l'avatar
            const nomInput = document.getElementById('nomInput');
            const avatarPreview = document.getElementById('avatarPreview');
            
            if (nomInput && avatarPreview) {
                nomInput.addEventListener('input', function() {
                    const nom = this.value.trim();
                    if (nom.length >= 2) {
                        const initials = nom.split(' ')
                            .map(word => word.charAt(0).toUpperCase())
                            .slice(0, 2)
                            .join('');
                        avatarPreview.textContent = initials;
                    } else {
                        avatarPreview.textContent = '??';
                    }
                });
            }
            
            // Validation du formulaire
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const password = form.querySelector('input[name="password"]').value;
                const confirmPassword = form.querySelector('input[name="password_confirmation"]').value;
                
                if (password.length < 8) {
                    e.preventDefault();
                    alert('Le mot de passe doit contenir au moins 8 caractères.');
                    return;
                }
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Les mots de passe ne correspondent pas.');
                    return;
                }
            });
        });
    </script>
    @include('partials.app-scripts')
</body>
</html>


