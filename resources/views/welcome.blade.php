<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constructo - Connexion</title>
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
            --bleu-darker: #0d1433;
            --bleu-gradient: linear-gradient(135deg, var(--bleu-marine) 0%, var(--bleu-clair) 100%);
            --bleu-gradient-reverse: linear-gradient(135deg, var(--bleu-clair) 0%, var(--bleu-marine) 100%);
            --gold: #D4AF37;
            --gold-light: #F4E4B6;
            --bg-primary: #f8f9fa;
            --bg-secondary: #e9ecef;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --text-light: #f8f9fa;
            --border-color: #dee2e6;
            --card-bg: #ffffff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --shadow-heavy: rgba(0, 0, 0, 0.2);
            --transition-speed: 0.3s;
            --transition-slow: 0.5s;
            --success-color: #28a745;
            --error-color: #dc3545;
            --warning-color: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-primary);
            background: var(--bg-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        /* Panneau gauche - Bienvenue */
        .welcome-panel {
            flex: 1;
            background: var(--bleu-gradient);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .welcome-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        .company-logo {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .company-logo-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .company-name {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .company-subtitle {
            font-size: 18px;
            color: var(--gold-light);
            font-weight: 300;
            margin-top: 5px;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
            line-height: 1.2;
        }

        .welcome-title span {
            color: var(--gold);
            position: relative;
        }

        .welcome-title span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
        }

        .welcome-message {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.9);
        }

        .features-list {
            list-style: none;
            margin-bottom: 50px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 18px;
        }

        .company-info {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 40px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.9);
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-icon {
            color: var(--gold);
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        /* Panneau droit - Connexion */
        .login-panel {
            flex: 1;
            background: var(--card-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            min-height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 50px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(22, 32, 72, 0.1);
            border: 1px solid rgba(222, 226, 230, 0.3);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--bleu-gradient);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-icon {
            width: 70px;
            height: 70px;
            background: var(--bleu-gradient);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(22, 32, 72, 0.2);
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--bleu-marine);
            margin-bottom: 10px;
        }

        .login-subtitle {
            font-size: 16px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: var(--bleu-marine);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
        }

        .form-label i {
            color: var(--bleu-clair);
        }

        .input-group {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 2px solid var(--border-color);
            transition: all var(--transition-speed) ease;
        }

        .input-group:focus-within {
            border-color: var(--bleu-clair);
            box-shadow: 0 6px 20px rgba(22, 32, 72, 0.1);
        }

        .input-group-text {
            background: white;
            border: none;
            padding: 0 20px;
            color: var(--bleu-marine);
            font-size: 16px;
        }

        .form-control {
            border: none;
            padding: 16px 20px;
            font-size: 16px;
            background: white;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus {
            box-shadow: none;
            background: white;
        }

        .password-toggle {
            background: white;
            border: none;
            padding: 0 20px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: color var(--transition-speed) ease;
        }

        .password-toggle:hover {
            color: var(--bleu-marine);
        }

        .login-btn {
            width: 100%;
            padding: 18px;
            background: var(--bleu-gradient);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 17px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 8px 25px rgba(22, 32, 72, 0.2);
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(22, 32, 72, 0.3);
        }

        .alert {
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 25px;
            border: 2px solid transparent;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
            border-color: rgba(220, 53, 69, 0.2);
            color: var(--error-color);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
            border-color: rgba(40, 167, 69, 0.2);
            color: var(--success-color);
        }

        .login-footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 2px solid rgba(222, 226, 230, 0.3);
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(22, 32, 72, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            color: var(--bleu-marine);
            margin-bottom: 15px;
        }

        .copyright {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.3s; opacity: 0; }
        .animate-delay-4 { animation-delay: 0.4s; opacity: 0; }

        /* Responsive */
        @media (max-width: 1200px) {
            .login-container {
                flex-direction: column;
            }
            
            .welcome-panel, .login-panel {
                min-height: auto;
            }
            
            .welcome-panel {
                padding: 40px 30px;
            }
            
            .login-panel {
                padding: 40px 20px;
            }
        }

        @media (max-width: 768px) {
            .company-logo {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .company-name {
                font-size: 32px;
            }
            
            .welcome-title {
                font-size: 28px;
            }
            
            .login-card {
                padding: 40px 30px;
            }
            
            .login-title {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .welcome-panel {
                padding: 30px 20px;
            }
            
            .company-logo-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
            
            .login-card {
                padding: 30px 25px;
                border-radius: 20px;
            }
            
            .login-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    @include('partials.app-toasts')
    <div class="login-container">
        <!-- Panneau gauche : Bienvenue et présentation -->
        <div class="welcome-panel">
            <div class="welcome-content">
                <!-- Logo et nom de l'entreprise -->
                <div class="company-logo animate-fade-in-up">
                    <div class="company-logo-icon animate-float">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <div>
                        <h1 class="company-name">SZLAZAK</h1>
                        <div class="company-subtitle">Gestion de Chantiers Professionnelle</div>
                    </div>
                </div>

                <!-- Message de bienvenue personnalisé -->
                <h2 class="welcome-title animate-fade-in-up animate-delay-1">
                    Bienvenue sur <span>Constructo</span>
                </h2>
                
                <p class="welcome-message animate-fade-in-up animate-delay-2">
                    Accédez à votre tableau de bord de gestion intégrée.
                    Suivez vos chantiers en temps réel, gérez vos équipements et
                    coordonnez vos équipes avec notre plateforme dédiée aux
                    professionnels du BTP.
                </p>
            </div>
        </div>

        <!-- Panneau droit : Formulaire de connexion -->
        <div class="login-panel">
            <div class="login-card animate__animated animate__fadeInRight">
                <!-- En-tête du formulaire -->
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <p class="login-subtitle">
                        Veuillez entrer vos identifiants pour accéder<br>
                        à votre espace personnel
                    </p>
                </div>

                <!-- Messages d'erreur -->
                <!-- Formulaire de connexion -->
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Champ Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>Adresse Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user-tie"></i>
                            </span>
                            <input 
                                type="email" 
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                spellcheck="false"
                            >
                        </div>
                        @error('email')
                            <small class="text-danger mt-2 d-block">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Champ Mot de passe -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-key"></i>Mot de passe
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input 
                                type="password" 
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Mot de passe"
                                required
                                autocomplete="current-password"
                                spellcheck="false"
                            >
                            <button type="button" class="btn password-toggle" id="togglePassword" title="Afficher/Masquer">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger mt-2 d-block">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    <!-- Bouton de connexion -->
                    <button type="submit" class="login-btn" id="loginButton">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Connexion</span>
                        <span class="spinner-border spinner-border-sm d-none ms-2" id="loginSpinner"></span>
                    </button>

                    
                </form>

                    <p class="copyright mb-0">
                        <i class="fas fa-copyright me-1"></i>
                        EURL SZLAZAK © {{ date('Y') }} {{ config('app.version', '1.0.0') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const passwordIcon = togglePassword.querySelector('i');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                passwordIcon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
                passwordIcon.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    passwordIcon.style.transform = 'scale(1)';
                }, 200);
            });

            // Form submission animation
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const loginSpinner = document.getElementById('loginSpinner');
            const buttonText = loginButton.querySelector('span:nth-child(2)');

            loginForm.addEventListener('submit', function() {
                // Disable button and show spinner
                loginButton.disabled = true;
                buttonText.textContent = 'Authentification en cours...';
                loginSpinner.classList.remove('d-none');
                loginButton.querySelector('.fa-sign-in-alt').classList.add('d-none');
                
                // Add ripple effect
                loginButton.style.position = 'relative';
                loginButton.style.overflow = 'hidden';
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.width = '100px';
                ripple.style.height = '100px';
                ripple.style.top = '50%';
                ripple.style.left = '50%';
                ripple.style.marginLeft = '-50px';
                ripple.style.marginTop = '-50px';
                
                loginButton.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

            // Auto-focus email field with delay for animation
            setTimeout(() => {
                const emailInput = document.getElementById('email');
                if (emailInput.value === '') {
                    emailInput.focus();
                }
            }, 500);

            // Remove error class when user starts typing
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
            
            passwordInput.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });

            // Add CSS for ripple effect
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);

            // Add animation classes on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all animate elements
            document.querySelectorAll('.animate-fade-in-up').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
    @include('partials.app-footer')
    @include('partials.app-scripts')
</body>
</html>
