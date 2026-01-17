<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Mes Notes Flash - Dark Edition</title>
    <style>
        /* Animation personnalisée pour l'entrée des notes */
        .note-card {
            transition: all 0.3s ease;
        }
        .note-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">

    <nav class="bg-gray-800 border-b border-gray-700 p-4 mb-8 shadow-xl">
        <div class="max-w-3xl mx-auto flex justify-between items-center">
            <span class="font-bold text-indigo-400">👤 <?= $_SESSION['user_email'] ?></span>
            <div class="flex space-x-6 items-center">
                <a href="index.php?tri=<?= isset($_GET['tri']) && $_GET['tri'] == 'asc' ? 'desc' : 'asc' ?>" class="text-sm text-gray-400 hover:text-indigo-400 transition">
                    📅 <?= isset($_GET['tri']) && $_GET['tri'] == 'asc' ? 'Ancien' : 'Récent' ?>
                </a>
                <a href="index.php?action=logout" class="bg-red-900/30 text-red-400 border border-red-800 px-3 py-1 rounded hover:bg-red-800 hover:text-white transition text-sm font-bold">
                    Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto p-4 animate__animated animate__fadeIn">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500 mb-8 text-center uppercase tracking-widest">
            Mes Notes Flash
        </h1>

        <form action="index.php?action=ajouter" method="POST" class="bg-gray-800 p-6 rounded-xl shadow-2xl mb-10 border border-gray-700 animate__animated animate__slideInDown">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="titre" placeholder="Titre captivant..." required 
                       class="bg-gray-900 border border-gray-600 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                
                <select name="category_id" required class="bg-gray-900 border border-gray-600 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                    <option value="">📁 Choisir une catégorie</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="mb-4">
    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">🔔 Programmer un rappel (Optionnel)</label>
    <input type="datetime-local" name="date_rappel" 
           class="w-full bg-gray-900/50 border border-gray-700 rounded-xl p-3 text-white outline-none focus:ring-2 ring-indigo-500 transition-all">
</div>
            </div>
            
            <textarea name="contenu" placeholder="Décrivez votre idée..." required 
                      class="w-full bg-gray-900 border border-gray-600 rounded-lg p-3 text-white h-24 mb-4 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
            
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg">
                ✨ Enregistrer la note
            </button>
        </form>

        <div class="mb-8">
            <form action="index.php" method="GET" class="flex gap-2">
                <input type="hidden" name="action" value="index">
                <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" 
                       placeholder="Rechercher dans le vide sidéral..." 
                       class="flex-grow bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-indigo-500 outline-none">
                <button type="submit" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition">🔍</button>
            </form>
        </div>

        <div class="grid gap-6">
            <?php foreach ($notes as $note): ?>
                <div class="note-card bg-gray-800 p-6 rounded-xl border-l-4 <?= $note['statut'] ? 'border-green-600' : 'border-indigo-600' ?> border-t border-r border-b border-gray-700 flex justify-between items-start animate__animated animate__fadeInUp">
                    <div class="flex-grow">
                        <div class="flex items-center space-x-3 mb-2">
                             <a href="index.php?action=toggle&id=<?= $note['id'] ?>" class="text-2xl hover:scale-125 transition">
                                <?= $note['statut'] ? '🟣' : '⚫' ?>
                            </a>
                            <?php if ($note['cat_nom']): ?>
                                <span class="text-[10px] font-bold uppercase px-2 py-1 rounded bg-indigo-900/50 text-indigo-300 border border-indigo-800">
                                    <?= htmlspecialchars($note['cat_nom']) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <h2 class="text-xl font-bold <?= $note['statut'] ? 'line-through text-gray-500' : 'text-white' ?>">
                            <?= htmlspecialchars($note['titre']) ?>
                        </h2>
                        <p class="text-gray-400 mt-2 line-clamp-3"><?= nl2br(htmlspecialchars($note['contenu'])) ?></p>
                        <div class="text-[10px] text-gray-600 mt-4 flex items-center">
                            <span class="mr-2">🕒</span> <?= $note['date_creation'] ?>
                        </div>
                    </div>
                    
                    <div class="flex flex-col space-y-4 ml-4">
                        <a href="index.php?action=editer&id=<?= $note['id'] ?>" class="text-gray-500 hover:text-indigo-400 transition text-xl">✏️</a>
                        <a href="index.php?action=supprimer&id=<?= $note['id'] ?>" onclick="return confirm('Supprimer définitivement ?')" class="text-gray-500 hover:text-red-400 transition text-xl">🗑️</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>