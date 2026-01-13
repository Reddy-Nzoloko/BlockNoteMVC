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
                    Sortir par date (<?= isset($_GET['tri']) && $_GET['tri'] == 'asc' ? 'Ancien' : 'Récent' ?>)
                </a>
                <a href="index.php?action=logout" class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200 text-sm font-bold">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-3xl font-bold text-indigo-600 mb-6 text-center">📝 Mes Notes Flash</h1>

        <form action="index.php?action=ajouter" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8 border-t-4 border-indigo-500">
            <input type="text" name="titre" placeholder="Titre de la tâche..." required class="w-full p-2 border mb-4 rounded focus:ring-2 focus:ring-indigo-500 outline-none">
            <textarea name="contenu" placeholder="Détails..." required class="w-full p-2 border mb-4 rounded h-20 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded hover:bg-indigo-700">Enregistrer</button>
        </form>

        <div class="grid gap-4">
            <?php foreach ($notes as $note): ?>
                <div class="bg-white p-5 rounded-lg shadow-md border-l-4 <?= $note['statut'] ? 'border-green-500 opacity-75' : 'border-indigo-500' ?> flex justify-between items-start">
                    <div class="flex items-start space-x-3">
                        <a href="index.php?action=toggle&id=<?= $note['id'] ?>" class="mt-1 text-2xl">
                            <?= $note['statut'] ? '✅' : '⬜' ?>
                        </a>
                        <div>
                            <h2 class="font-bold text-xl <?= $note['statut'] ? 'line-through text-gray-400' : '' ?>">
                                <?= htmlspecialchars($note['titre']) ?>
                            </h2>
                            <p class="text-gray-600 mt-1"><?= nl2br(htmlspecialchars($note['contenu'])) ?></p>
                            <span class="text-xs text-gray-400 mt-2 block"><?= $note['date_creation'] ?></span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3 text-lg">
                        <a href="index.php?action=editer&id=<?= $note['id'] ?>" title="Modifier">✏️</a>
                        <a href="index.php?action=supprimer&id=<?= $note['id'] ?>" onclick="return confirm('Supprimer ?')" title="Supprimer">🗑️</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>