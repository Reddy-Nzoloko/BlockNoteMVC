<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MindFlow</title>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body id="body" class="dark bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-500">
    
    <div class="max-w-2xl mx-auto pt-12 px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">
                    Modifier la note
                </h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Mettez à jour vos idées en un clic.</p>
            </div>
            <a href="index.php" class="text-indigo-600 dark:text-indigo-400 hover:scale-105 transition-transform">
                <span class="text-2xl">✕</span>
            </a>
        </div>

        <form action="index.php?action=mettreAJour" method="POST" 
              class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700">
            
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            
            <div class="mb-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2 ml-1">
                    Titre de la note
                </label>
                <input type="text" name="titre" 
                       value="<?= htmlspecialchars($note['titre']) ?>" 
                       class="w-full p-4 bg-gray-100 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 ring-indigo-500 outline-none transition-all" 
                       required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2 ml-1">
            Catégorie
        </label>
        <select name="category_id" 
                class="w-full p-4 bg-gray-100 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 ring-indigo-500 outline-none transition-all">
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $note['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2 ml-1">
            🔔 Modifier le Rappel
        </label>
        <input type="datetime-local" name="date_rappel" 
               value="<?= $note['date_rappel'] ? date('Y-m-d\TH:i', strtotime($note['date_rappel'])) : '' ?>"
               class="w-full p-4 bg-gray-100 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 ring-indigo-500 outline-none transition-all">
    </div>
</div>

            <div class="mb-8">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2 ml-1">
                    Description détaillée
                </label>
                <textarea name="contenu" 
                          class="w-full p-4 bg-gray-100 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white h-56 focus:ring-2 ring-indigo-500 outline-none transition-all resize-none" 
                          required><?= htmlspecialchars($note['contenu']) ?></textarea>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-[2] bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/20 active:scale-95">
                    🚀 Enregistrer les modifications
                </button>
                <a href="index.php" class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 py-4 rounded-xl font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition text-center active:scale-95">
                    Annuler
                </a>
            </div>
        </form>

        <p class="text-center text-gray-400 dark:text-gray-600 text-xs mt-8">
            Dernière modification détectée le : <?= $note['date_creation'] ?>
        </p>
    </div>

    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'light') {
            document.getElementById('body').classList.remove('dark');
        } else {
            document.getElementById('body').classList.add('dark');
        }
    </script>
</body>
</html>