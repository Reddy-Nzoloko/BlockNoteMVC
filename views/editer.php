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

        <form action="index.php?action=mettreAJour" method="POST" class="bg-white p-6 rounded shadow">
            
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            
            <div class="mb-4">
                <label class="block mb-1">Titre</label>
                <input type="text" name="titre" 
                       value="<?= htmlspecialchars($note['titre']) ?>" 
                       class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Contenu</label>
                <textarea name="contenu" class="w-full p-2 border rounded h-32" required><?= htmlspecialchars($note['contenu']) ?></textarea>
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Enregistrer</button>
                <a href="index.php" class="bg-gray-300 px-4 py-2 rounded">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>