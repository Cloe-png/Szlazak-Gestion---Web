<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Mot de passe</title>
    @include('partials.app-head')
    <style>
        .strength-bar {
            height: 6px;
            background: #e9ecef;
            border-radius: 999px;
            overflow: hidden;
            margin-top: 8px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            background: #dc3545;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .strength-text {
            font-size: 0.85rem;
            margin-top: 6px;
            color: var(--text-secondary);
        }
    </style>
</head>
<body>
    @include('partials.app-navbar')

    <div class="container mt-4">
        <div class="page-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1><i class="fas fa-gear me-3"></i>Paramètres</h1>
                    <p class="mb-0">Modifier votre mot de passe en toute sécurité.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                </a>
            </div>
        </div>

        <div class="container-custom">
            <form method="POST" action="{{ route('settings.password') }}" class="mt-3">
                @csrf

                <div class="form-group-custom">
                    <label for="current_password"><i class="fas fa-lock me-2"></i>Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required autocomplete="current-password">
                    @error('current_password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label for="password"><i class="fas fa-key me-2"></i>Nouveau mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
                    <div class="strength-bar">
                        <div id="strength-bar-fill" class="strength-bar-fill"></div>
                    </div>
                    <div id="strength-text" class="strength-text">Force : —</div>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label for="password_confirmation"><i class="fas fa-check me-2"></i>Confirmer le nouveau mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const bar = document.getElementById('strength-bar-fill');
            const text = document.getElementById('strength-text');

            function scorePassword(value) {
                let score = 0;
                if (value.length >= 8) score++;
                if (/[A-Z]/.test(value)) score++;
                if (/[0-9]/.test(value)) score++;
                if (/[^A-Za-z0-9]/.test(value)) score++;
                return score;
            }

            function updateStrength() {
                const val = passwordInput.value || '';
                const score = scorePassword(val);
                const percent = (score / 4) * 100;

                bar.style.width = percent + '%';
                if (score <= 1) {
                    bar.style.background = '#dc3545';
                    text.textContent = 'Force : faible';
                } else if (score === 2) {
                    bar.style.background = '#ffc107';
                    text.textContent = 'Force : moyenne';
                } else if (score === 3) {
                    bar.style.background = '#0d6efd';
                    text.textContent = 'Force : bonne';
                } else {
                    bar.style.background = '#198754';
                    text.textContent = 'Force : très bonne';
                }
                if (!val) {
                    bar.style.width = '0%';
                    text.textContent = 'Force : —';
                }
            }

            passwordInput.addEventListener('input', updateStrength);
        });
    </script>
</body>
</html>
