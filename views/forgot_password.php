<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MindFlow</title>
</head>
<body class="bg-gray-900 text-gray-100 h-screen flex items-center justify-center">
    <div class="relative z-10 w-full max-w-md px-6">
        <div class="bg-gray-800/50 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-gray-700">
            <h2 class="text-2xl font-bold mb-2 text-center text-white">Mot de passe oublié ?</h2>
            <p class="text-gray-400 text-center text-sm mb-8">Entrez votre email pour recevoir un lien de récupération.</p>

            <form action="index.php?action=traiter_recuperation" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase mb-2 ml-1">Email de récupération</label>
                    <input type="email" name="email" placeholder="votre@email.com" 
                           class="w-full bg-gray-900/50 border border-gray-700 rounded-xl p-3 text-white outline-none focus:ring-2 focus:ring-indigo-500 transition-all" required>
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl shadow-lg transition-all active:scale-95">
                    Envoyer le lien
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="index.php?action=login" class="text-gray-500 hover:text-white text-sm transition">← Retour à la connexion</a>
            </div>
        </div>
    </div>
</body>
</html>