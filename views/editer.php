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

        <form action="index.php?action=confirmer_modifier" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Titre</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($note['titre']) ?>" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Contenu</label>
                <textarea name="contenu" required
                          class="w-full p-2 border border-gray-300 rounded h-32"><?= htmlspecialchars($note['contenu']) ?></textarea>
            </div>
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Enregistrer les changements
                </button>
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>