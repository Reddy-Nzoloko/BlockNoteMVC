<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modifier la note</title>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Modifier la note</h1>
            <a href="index.php" class="text-indigo-600 hover:underline text-sm">← Retourner à la liste</a>
        </div>

        <form action="index.php?action=mettreAJour" method="POST" class="bg-white p-6 rounded-lg shadow-md border-t-4 border-indigo-500">
            
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Titre de la note</label>
                <input type="text" name="titre" 
                       value="<?= htmlspecialchars($note['titre']) ?>" 
                       required 
                       class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                <textarea name="contenu" 
                          required 
                          class="w-full p-2 border border-gray-300 rounded h-40 focus:ring-2 focus:ring-indigo-500 outline-none"><?= htmlspecialchars($note['contenu']) ?></textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-grow bg-indigo-600 text-white font-bold py-2 rounded hover:bg-indigo-700 transition">
                    Enregistrer les modifications
                </button>
                <a href="index.php" class="bg-gray-200 text-gray-700 px-6 py-2 rounded font-bold hover:bg-gray-300 transition text-center">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</body>
</html>