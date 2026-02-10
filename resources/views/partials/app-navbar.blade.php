<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
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
                    <a class="nav-link" href="{{ route('chantiers.index') }}">
                        <i class="fas fa-project-diagram me-1"></i>Chantiers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('equipements.index') }}">
                        <i class="fas fa-tools me-1"></i>Stockage
                    </a>
                </li>
                @if(auth()->user() && auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-users me-1"></i>Équipe
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('evenements.index') }}">
                        <i class="fas fa-calendar-alt me-1"></i>Agenda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('timesheets.index') }}">
                        <i class="fas fa-calendar-alt me-1"></i>Fiches d'heures
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <span class="nav-link">
                        <i class="fas fa-user me-1"></i>{{ Auth::user()->nom ?? 'Szlazak Nicolas' }}
                    </span>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('settings.edit') }}">
                        <i class="fas fa-gear me-1"></i>Paramètres
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>
@include('partials.app-toasts')
