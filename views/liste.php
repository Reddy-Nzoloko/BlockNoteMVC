<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Mes Notes | MindFlow</title>
    <style>
        .note-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .note-card:hover { transform: translateY(-8px); shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
        /* Style pour masquer l'input file moche */
        .file-upload { position: relative; overflow: hidden; }
        .file-upload input[type=file] { position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">

    <nav class="bg-gray-800/50 backdrop-blur-md border-b border-gray-700 p-4 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-2xl">🧠</span>
                <span class="font-bold text-xl bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">MindFlow</span>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="hidden md:inline text-sm text-gray-400">👤 <?= htmlspecialchars($_SESSION['user_email']) ?></span>
                
                <div class="relative group">
                    <button class="p-2 hover:bg-gray-700 rounded-full transition">⚙️</button>
                    <div class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-xl shadow-xl hidden group-hover:block animate__animated animate__fadeIn">
                        <a href="index.php?action=supprimer_compte" 
                           onclick="return confirm('Attention ! Cela supprimera définitivement votre compte et TOUTES vos notes. Continuer ?')"
                           class="block px-4 py-3 text-sm text-red-400 hover:bg-red-900/20 rounded-xl transition">
                            ❌ Supprimer mon compte
                        </a>
                    </div>
                </div>

                <a href="index.php?action=logout" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-bold transition">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto p-6">
        
        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-6 p-4 rounded-xl bg-indigo-900/30 border border-indigo-500 text-indigo-200 animate__animated animate__bounceIn">
                <?= $_SESSION['flash']['message']; unset($_SESSION['flash']); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=ajouter" method="POST" enctype="multipart/form-data" 
              class="bg-gray-800 p-6 rounded-2xl shadow-2xl mb-12 border border-gray-700">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="titre" placeholder="Titre de la note..." required 
                       class="bg-gray-900 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                
                <select name="category_id" required class="bg-gray-900 border border-gray-700 rounded-xl p-3 text-white outline-none">
                    <option value="">📁 Choisir une catégorie</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <textarea name="contenu" placeholder="Votre pensée ici..." required 
                      class="w-full bg-gray-900 border border-gray-700 rounded-xl p-4 text-white h-32 mb-4 focus:ring-2 focus:ring-indigo-500 outline-none resize-none"></textarea>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="flex flex-col">
                    <label class="text-xs text-gray-500 font-bold mb-1 ml-1 uppercase">🔔 Rappel</label>
                    <input type="datetime-local" name="date_rappel" class="bg-gray-900 border border-gray-700 rounded-xl p-2 text-sm text-white outline-none">
                </div>
                <div class="flex flex-col">
                    <label class="text-xs text-gray-500 font-bold mb-1 ml-1 uppercase">📸 Ajouter une image</label>
                    <div class="file-upload bg-gray-900 border border-gray-700 rounded-xl p-2 text-sm text-center hover:bg-gray-850 transition">
                        <span class="text-gray-400">Cliquez pour choisir</span>
                        <input type="file" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                ✨ Enregistrer dans MindFlow
            </button>
        </form>

        <div class="flex flex-col md:flex-row gap-4 mb-10 items-center">
            <form action="index.php" method="GET" class="flex-grow flex gap-2 w-full">
                <input type="hidden" name="action" value="index">
                <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" 
                       placeholder="Rechercher une idée..." 
                       class="flex-grow bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 focus:ring-2 ring-indigo-500 outline-none">
                <button type="submit" class="bg-indigo-600 px-6 rounded-xl hover:bg-indigo-500 transition">🔍</button>
            </form>
            <a href="index.php?tri=<?= ($_GET['tri'] ?? 'desc') === 'asc' ? 'desc' : 'asc' ?>" 
               class="bg-gray-800 border border-gray-700 px-4 py-3 rounded-xl text-sm whitespace-nowrap hover:bg-gray-700 transition">
                <?= ($_GET['tri'] ?? 'desc') === 'asc' ? '⏳ Plus ancien' : 'Plus récent' ?>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($notes as $note): ?>
                <div class="note-card bg-gray-800 rounded-2xl border border-gray-700 flex flex-col overflow-hidden animate__animated animate__fadeInUp">
                    
                    <?php if (!empty($note['image_path'])): ?>
                        <div class="w-full h-48 overflow-hidden">
                            <img src="<?= $note['image_path'] ?>" alt="Illustration" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition duration-500">
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-full bg-indigo-900/50 text-indigo-300 border border-indigo-800">
                                <?= htmlspecialchars($note['cat_nom'] ?? 'Général') ?>
                            </span>
                            <div class="flex space-x-2">
                                <a href="index.php?action=editer&id=<?= $note['id'] ?>" class="hover:text-indigo-400 transition">✏️</a>
                                <a href="index.php?action=supprimer&id=<?= $note['id'] ?>" onclick="return confirm('Supprimer ?')" class="hover:text-red-400 transition">🗑️</a>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-white mb-2"><?= htmlspecialchars($note['titre']) ?></h2>
                        <p class="text-gray-400 text-sm line-clamp-4 leading-relaxed">
                            <?= nl2br(htmlspecialchars($note['contenu'])) ?>
                        </p>

                        <?php if ($note['date_rappel']): ?>
                            <div class="mt-4 flex items-center text-[11px] text-amber-400 bg-amber-900/20 p-2 rounded-lg border border-amber-800/50">
                                <span class="mr-2">⏰</span> Rappel : <?= date('d/m H:i', strtotime($note['date_rappel'])) ?>
                            </div>
                        <?php endif; ?>

                        <div class="mt-6 pt-4 border-t border-gray-700 flex justify-between items-center text-[10px] text-gray-500 uppercase tracking-tighter">
                            <span>📅 <?= date('d M Y', strtotime($note['date_creation'])) ?></span>
                            <a href="index.php?action=toggle&id=<?= $note['id'] ?>" class="text-lg">
                                <?= $note['statut'] ? '✅' : '⏳' ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        if (Notification.permission !== "granted") Notification.requestPermission();

        function verifierRappels() {
            const notes = <?= json_encode($notes) ?>;
            const maintenant = Math.floor(new Date().getTime() / 60000);

            notes.forEach(note => {
                if (note.date_rappel && !note.statut) {
                    const tRappel = Math.floor(new Date(note.date_rappel).getTime() / 60000);
                    if (maintenant === tRappel) {
                        new Notification("⏰ MindFlow : " + note.titre, {
                            body: "Il est temps de s'en occuper !",
                            icon: "https://cdn-icons-png.flaticon.com/512/1792/1792931.png"
                        });
                    }
                }
            });
        }
        setInterval(verifierRappels, 30000);
    </script>
</body>
</html>