<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Rôle</title>
    @include('partials.app-head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('partials.app-navbar')
    <div class="container mt-5">
        <h1 class="mb-4">Détails du Rôle</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $role->nom }}</h5>
            </div>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>
    @include('partials.app-footer')
    @include('partials.app-scripts')
</body>
</html>



