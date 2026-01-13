<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Créer un compte</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 border-t-4 border-indigo-600">
        <h1 class="text-2xl font-bold mb-2 text-center text-gray-800">Inscription</h1>
        <p class="text-center text-gray-500 text-sm mb-6">Rejoignez-nous pour gérer vos notes</p>

        <form action="index.php?action=traiter_register" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Adresse Email</label>
                <input type="email" name="email" placeholder="exemple@mail.com" 
                       class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" 
                       class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded hover:bg-indigo-700 transition duration-200">
                Créer mon compte
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">Déjà un compte ? 
                <a href="index.php?action=login" class="text-indigo-600 font-bold hover:underline">Se connecter</a>
            </p>
        </div>
    </div>
</body>
</html>