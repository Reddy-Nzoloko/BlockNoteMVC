<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modifier la note</title>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Modifier la note</h1>

        <form action="index.php?action=modifier" method="POST">
    <input type="hidden" name="id" value="<?= $note['id'] ?>">
    
    <input type="text" name="titre" value="<?= htmlspecialchars($note['titre']) ?>" required ...>
    <textarea name="contenu" ...><?= htmlspecialchars($note['contenu']) ?></textarea>
    
    <button type="submit">Mettre à jour</button>
</form>
    </div>
</body>
</html>