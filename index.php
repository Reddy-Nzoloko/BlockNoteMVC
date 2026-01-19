<?php
// index.php
session_start();

// 1. Affichage des erreurs pour le développement
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Définition de l'action par défaut : la page de présentation (Home)
$action = $_GET['action'] ?? 'home';

// 3. Import des contrôleurs
require_once 'controllers/NoteController.php';
require_once 'controllers/AuthController.php';

// 4. Routage des actions
switch ($action) {
    
    // --- PARTIE PUBLIQUE ---
    case 'home':
        // Si l'utilisateur est déjà connecté, on l'envoie direct vers ses notes
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?action=index');
            exit();
        }
        require __DIR__ . '/views/home.php';
        break;

    case 'login':
        require __DIR__ . '/views/login.php';
        break;

    case 'register':
        require __DIR__ . '/views/register.php';
        break;

    // --- LOGIQUE D'AUTHENTIFICATION (C'est ici qu'on traite les formulaires) ---
    case 'traiter_login':
        (new AuthController())->login(); // Cette méthode doit rediriger vers index.php?action=index
        break;

    case 'traiter_register':
        (new AuthController())->register();
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?action=home');
        exit();
        break;

    // --- ESPACE UTILISATEUR (Sécurisé par le NoteController) ---
    case 'index':
        (new NoteController())->afficherAccueil();
        break;

    case 'ajouter':
        (new NoteController())->sauvegarder();
        break;

    case 'editer':
        (new NoteController())->editerNote();
        break;

    case 'mettreAJour':
        (new NoteController())->mettreAJour();
        break;

    case 'supprimer':
        (new NoteController())->supprimerNote();
        break;

    case 'toggle': // Pour cocher/décocher une note
        (new NoteController())->changerStatut();
        break;

    case 'supprimer_compte':
        (new NoteController())->supprimerMonCompte();
        break;

    // --- PAR DÉFAUT ---
    default:
        header('Location: index.php?action=home');
        exit();
        break;
}