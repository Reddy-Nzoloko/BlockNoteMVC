<?php
session_start();
ini_set('display_errors', 1); // Pour voir les erreurs s'il y en a
error_reporting(E_ALL);

$action = $_GET['action'] ?? 'home';

require_once 'controllers/NoteController.php';
require_once 'controllers/AuthController.php';

switch ($action) {
    case 'home':
        if (isset($_SESSION['user_id'])) {
            (new NoteController())->afficherAccueil();
        } else {
            require __DIR__ . '/views/home.php';
        }
        break;

    case 'login':
        require __DIR__ . '/views/login.php';
        break;

    case 'register':
        require __DIR__ . '/views/register.php';
        break;

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

    case 'supprimer_compte':
        (new NoteController())->supprimerMonCompte();
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?action=home');
        break;

    default:
        header('Location: index.php?action=home');
        break;
}