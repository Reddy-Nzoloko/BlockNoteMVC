<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindFlow | Libérez votre esprit, organisez votre vie.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <style>
        /* Petit ajustement pour masquer la barre de défilement tout en gardant le scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body id="body" class="dark bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-500 overflow-x-hidden font-sans">

    <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2 animate__animated animate__fadeInLeft">
                <span class="text-3xl">🧠</span>
                <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">
                    MindFlow
                </span>
            </div>
            <div class="flex items-center space-x-4 animate__animated animate__fadeInRight">
                <a href="index.php?action=login" class="hidden md:block text-gray-600 dark:text-gray-300 font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Se connecter
                </a>
                <a href="index.php?action=register" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2 rounded-full transition shadow-lg shadow-indigo-500/30 active:scale-95">
                    Commencer gratuitement
                </a>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] bg-indigo-500/10 dark:bg-indigo-900/20 rounded-full blur-[150px] animate__animated animate__pulse animate__infinite animate__slower"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[50%] h-[50%] bg-purple-500/10 dark:bg-purple-900/20 rounded-full blur-[150px] animate__animated animate__pulse animate__infinite animate__slower animate__delay-2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-8 tracking-tight leading-tight animate__animated animate__fadeInUp">
                Libérez votre esprit.<br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">
                    L'organisation réinventée.
                </span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
                Capturez vos idées, planifiez vos tâches et ne manquez jamais une échéance grâce à nos rappels intelligents. Un design premium conçu pour votre clarté mentale.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-20 animate__animated animate__fadeInUp animate__delay-2s">
                <a href="index.php?action=register" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-lg font-bold rounded-full shadow-xl shadow-indigo-500/30 hover:scale-105 transition transform active:scale-95">
                    🚀 Créer mon espace MindFlow
                </a>
                <a href="#features" class="px-8 py-4 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white text-lg font-bold rounded-full hover:bg-gray-300 dark:hover:bg-gray-700 transition transform active:scale-95">
                    Découvrir les fonctionnalités
                </a>
            </div>

            <div class="relative mx-auto max-w-5xl animate__animated animate__fadeInUp animate__delay-3s">
                <div class="bg-gray-900/5 dark:bg-white/5 rounded-3xl p-4 backdrop-blur-xl border border-gray-200/20 dark:border-gray-700/30 shadow-2xl">
                    <div class="aspect-video rounded-2xl overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center relative">
                         <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500/10 to-purple-500/10 z-0"></div>
                         <div class="text-center z-10 p-10">
                             <span class="text-6xl mb-4 block">📱💻</span>
                             <p class="text-gray-500 dark:text-gray-400 font-bold text-lg">Capture d'écran de votre interface MindFlow</p>
                             <p class="text-sm text-gray-400">(Vos notes, vos catégories, vos rappels en un coup d'œil)</p>
                         </div>
                    </div>
                </div>
                 <div class="absolute -bottom-20 left-[10%] w-[80%] h-20 bg-indigo-600/30 blur-[100px] -z-10"></div>
            </div>
        </div>
    </section>

    <section id="features" class="py-32 bg-gray-100 dark:bg-gray-900/50 relative">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold mb-6">Conçu pour la productivité moderne</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    MindFlow combine simplicité et puissance pour vous aider à rester concentré sur ce qui compte vraiment.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center text-4xl mb-6 text-indigo-600 dark:text-indigo-400">
                        🌗
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Mode Sombre & Clair</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Une interface qui s'adapte à votre environnement. Travaillez confortablement de jour comme de nuit avec un design soigné.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center text-4xl mb-6 text-purple-600 dark:text-purple-400">
                        🔔
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Rappels Intelligents</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Ne ratez plus jamais rien. Programmez des notifications précises pour vos tâches importantes directement depuis votre navigateur.
                    </p>
                </div>

                 <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-4xl mb-6 text-blue-600 dark:text-blue-400">
                        📂
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Organisation Intuitive</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Classez vos pensées par catégories, triez-les en un clic et retrouvez tout instantanément grâce à la recherche intégrée.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-center space-x-2 mb-6 opacity-75 hover:opacity-100 transition">
                <span class="text-2xl">🧠</span>
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">
                    MindFlow
                </span>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">
                &copy; 2026 MindFlow. Tous droits réservés. <br>Créé avec passion pour la productivité.
            </p>
        </div>
    </footer>

    <script>
        // On vérifie la préférence système ou le stockage local
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.getElementById('body').classList.add('dark');
        } else {
            document.getElementById('body').classList.remove('dark');
        }
    </script>
</body>
</html>