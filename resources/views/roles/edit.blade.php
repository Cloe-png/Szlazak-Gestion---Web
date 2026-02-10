<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Rôle</title>
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
        <h1 class="mb-4">Modifier un Rôle</h1>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Rôle</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $role->nom }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
    @include('partials.app-footer')
    @include('partials.app-scripts')
</body>
</html>



