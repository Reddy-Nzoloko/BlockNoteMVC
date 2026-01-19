<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>MindFlow </title>
</head>
<body class="bg-gray-900 text-gray-100 h-screen flex items-center justify-center overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-900/20 rounded-full blur-[120px] animate__animated animate__pulse animate__infinite"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-900/20 rounded-full blur-[120px] animate__animated animate__pulse animate__infinite animate__delay-2s"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-6 animate__animated animate__zoomIn">
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-2xl bg-indigo-600 shadow-lg shadow-indigo-500/50 mb-4">
                <span class="text-3xl">📝</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                Note MindFlow 
            </h1>
            <p class="text-gray-400 mt-2">Gérez vos idées en toute sécurité.</p>
        </div>

        <div class="bg-gray-800/50 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-gray-700">
            <h2 class="text-xl font-bold mb-6 text-center text-white">Ravi de vous revoir !</h2>
            
            <?php if(isset($_GET['erreur'])): ?>
                <div class="bg-red-900/30 border border-red-800 text-red-400 p-3 rounded-lg text-sm mb-6 animate__animated animate__shakeX">
                    ⚠️ Email ou mot de passe incorrect.
                </div>
            <?php endif; ?>

            <form action="index.php?action=traiter_login" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Adresse Email</label>
                    <input type="email" name="email" placeholder="nom@exemple.com" 
                           class="w-full bg-gray-900/50 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder:text-gray-600" 
                           required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" 
                           class="w-full bg-gray-900/50 border border-gray-700 rounded-xl p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder:text-gray-600" 
                           required>
                </div>
                <!-- <div class="text-right mb-4">
    <a href="index.php?action=forgot_password" class="text-xs text-indigo-400 hover:underline">Mot de passe oublié ?</a>
</div> -->

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-500/20 active:scale-95 transform">
                    Se connecter
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-700 text-center">
                <p class="text-gray-400 text-sm">
                    Pas encore de compte ? 
                    <a href="index.php?action=register" class="text-indigo-400 font-bold hover:text-indigo-300 transition-colors ml-1">
                        Créer un compte
                    </a>
                </p>
            </div>
        </div>
        
        <p class="text-center text-gray-600 text-[10px] mt-8 uppercase tracking-[0.2em]">
            &copy; 2026 NoteMindFlow System - RedDev Version 001
        </p>
    </div>

</body>
</html>