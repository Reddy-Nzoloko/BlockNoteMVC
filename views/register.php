<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Créer un compte | NoteFlash Pro</title>
</head>
<body class="bg-gray-900 text-gray-100 h-screen flex items-center justify-center overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute bottom-[-10%] left-[-10%] w-[45%] h-[45%] bg-purple-900/20 rounded-full blur-[120px] animate__animated animate__pulse animate__infinite"></div>
        <div class="absolute top-[-10%] right-[-10%] w-[45%] h-[45%] bg-indigo-900/20 rounded-full blur-[120px] animate__animated animate__pulse animate__infinite animate__delay-1s"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-6 animate__animated animate__fadeInUp">
        
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-xl mb-4">
                <span class="text-3xl text-white">🚀</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                Rejoignez NoteFlash
            </h1>
            <p class="text-gray-400 mt-2">Commencez à organiser vos pensées dès aujourd'hui.</p>
        </div>

        <div class="bg-gray-800/40 backdrop-blur-2xl p-8 rounded-[2.5rem] shadow-2xl border border-gray-700/50">
            
            <form action="index.php?action=traiter_register" method="POST" class="space-y-5">
                
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Votre Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">📧</span>
                        <input type="email" name="email" placeholder="nom@exemple.com" 
                               class="w-full bg-gray-900/60 border border-gray-700 rounded-2xl py-3 pl-10 pr-4 text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition-all placeholder:text-gray-600" 
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Mot de passe</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">🔒</span>
                        <input type="password" name="password" placeholder="Min. 8 caractères" 
                               class="w-full bg-gray-900/60 border border-gray-700 rounded-2xl py-3 pl-10 pr-4 text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition-all placeholder:text-gray-600" 
                               required>
                    </div>
                    <p class="text-[10px] text-gray-500 mt-2 ml-1 italic">Le chiffrement de bout en bout est activé.</p>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-purple-500/20 active:scale-95 transform mt-4">
                    Créer mon compte gratuit
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-700/50 text-center">
                <p class="text-gray-400 text-sm">
                    Déjà membre ? 
                    <a href="index.php?action=login" class="text-purple-400 font-bold hover:text-purple-300 transition-colors ml-1">
                        Connectez-vous ici
                    </a>
                </p>
            </div>
        </div>

        <p class="text-center text-gray-600 text-[10px] mt-8 uppercase tracking-[0.3em]">
            Cloud Synced • Secured Data • 2026
        </p>
    </div>

</body>
</html>