<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mes Notes</title>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm p-4 mb-8">
        <div class="max-w-2xl mx-auto flex justify-between items-center">
            <span class="font-bold text-gray-700">👤 <?= $_SESSION['user_email'] ?></span>
            <div class="flex space-x-4">
                <a href="index.php?tri=<?= isset($_GET['tri']) && $_GET['tri'] == 'asc' ? 'desc' : 'asc' ?>" class="text-sm text-indigo-600 hover:underline">
                    Trier par date (<?= isset($_GET['tri']) && $_GET['tri'] == 'asc' ? 'Ancien' : 'Récent' ?>)
                </a>
                <a href="index.php?action=logout" class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200 text-sm font-bold">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-3xl font-bold text-indigo-600 mb-6 text-center">📝 Mes Notes Flash</h1>

        <form action="index.php?action=ajouter" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8 border-t-4 border-indigo-500">
            <div class="mb-4">
                <input type="text" name="titre" placeholder="Titre de la tâche..." required class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            
            <div class="mb-4">
                <select name="category_id" required class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <textarea name="contenu" placeholder="Détails..." required class="w-full p-2 border rounded h-20 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
            </div>
            
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded hover:bg-indigo-700 transition">
                Enregistrer la note
            </button>
        </form>

        <div class="mb-6">
            <form action="index.php" method="GET" class="flex gap-2">
                <input type="hidden" name="action" value="index">
                <div class="relative flex-grow">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">🔍</span>
                    <input type="text" name="q" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" 
                           placeholder="Rechercher une note..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none shadow-sm">
                </div>
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 transition">Filtrer</button>
                <?php if(!empty($_GET['q'])): ?>
                    <a href="index.php" class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 text-center">Effacer</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="grid gap-4">
            <?php foreach ($notes as $note): ?>
                <div class="bg-white p-5 rounded-lg shadow-md border-l-4 <?= $note['statut'] ? 'border-green-500 opacity-75' : 'border-indigo-500' ?> flex justify-between items-start">
                    <div class="flex items-start space-x-3 w-full">
                        <a href="index.php?action=toggle&id=<?= $note['id'] ?>" class="mt-1 text-2xl">
                            <?= $note['statut'] ? '✅' : '⬜' ?>
                        </a>
                        
                        <div class="flex-grow">
                            <?php if (!empty($note['cat_nom'])): ?>
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase mb-2 <?= $note['cat_couleur'] ?>">
                                    <?= htmlspecialchars($note['cat_nom']) ?>
                                </span>
                            <?php endif; ?>

                            <h2 class="font-bold text-xl <?= $note['statut'] ? 'line-through text-gray-400' : '' ?>">
                                <?= htmlspecialchars($note['titre']) ?>
                            </h2>
                            <p class="text-gray-600 mt-1"><?= nl2br(htmlspecialchars($note['contenu'])) ?></p>
                            <span class="text-xs text-gray-400 mt-2 block italic"><?= $note['date_creation'] ?></span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3 text-lg ml-4">
                        <a href="index.php?action=editer&id=<?= $note['id'] ?>" class="hover:scale-110 transition">✏️</a>
                        <a href="index.php?action=supprimer&id=<?= $note['id'] ?>" onclick="return confirm('Supprimer ?')" class="hover:scale-110 transition">🗑️</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>