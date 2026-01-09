<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mes Notes</title>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <!-- <h1 class="text-3xl font-bold text-indigo-600 mb-6">📝 Mes Notes Flash</h1> -->
        
        <div class="grid gap-4">
            <?php foreach ($notes as $note): ?>
                <div class="bg-white p-5 rounded-lg shadow-md border-l-4 border-indigo-500">
                    <h2 class="font-bold text-xl"><?= htmlspecialchars($note['titre']) ?></h2>
                    <p class="text-gray-600 mt-2"><?= nl2br(htmlspecialchars($note['contenu'])) ?></p>
                    <span class="text-xs text-gray-400 mt-4 block"><?= $note['date_creation'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Ajout de la note  -->
     <body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-indigo-600 mb-6 text-center">📝 Mes Notes Flash</h1>

        <form action="index.php?action=ajouter" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8">
            <div class="mb-4">
                <input type="text" name="titre" placeholder="Titre de la note" required
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <textarea name="contenu" placeholder="Écrivez votre idée ici..." required
                          class="w-full p-2 border border-gray-300 rounded h-24 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded hover:bg-indigo-700 transition">
                Enregistrer la note
            </button>
        </form>

        <div class="grid gap-4">
            </div>
    </div>
</body>
</body>
</html>