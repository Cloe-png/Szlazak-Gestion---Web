<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Devis</title>
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
    <div class="container mt-5">
        <h1 class="mb-4">Ajouter un Devis</h1>
        <form action="<?php echo e(route('devis.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="nom_client" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" id="nom_client" name="nom_client" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <input type="text" class="form-control" id="statut" name="statut" value="En attente">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?php echo e(route('devis.index')); ?>" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\wamp64\www\constructo\resources\views/devis/create.blade.php ENDPATH**/ ?>