<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-6 text-center">Connexion</h1>
        <?php if(isset($_GET['erreur'])): ?>
            <p class="text-red-500 text-sm mb-4">Email ou mot de passe incorrect.</p>
        <?php endif; ?>
        <form action="index.php?action=traiter_login" method="POST">
            <input type="email" name="email" placeholder="Email" class="w-full p-2 mb-4 border rounded" required>
            <input type="password" name="password" placeholder="Mot de passe" class="w-full p-2 mb-6 border rounded" required>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded">Se connecter</button>
            <div class="mt-6 text-center text-sm">
    <p class="text-gray-600">Pas encore de compte ? 
        <a href="index.php?action=register" class="text-indigo-600 font-bold hover:underline">S'inscrire gratuitement</a>
    </p>
</div>
        </form>
    </div>
</body>
</html>