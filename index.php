<?php
// index.php
session_start();

// On récupère l'action, par défaut c'est 'home' maintenant
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Import des contrôleurs
require_once 'controllers/NoteController.php';
require_once 'controllers/AuthController.php';

$noteCtrl = new NoteController();
$authCtrl = new AuthController();

switch ($action) {
    case 'home':
        // Si l'utilisateur est déjà connecté, on peut le rediriger vers ses notes
        // Sinon, on montre la page de présentation
        if (isset($_SESSION['user_id'])) {
            $noteCtrl->afficherAccueil();
        } else {
            require 'views/home.php';
        }
        break;

    case 'login':
        require 'views/login.php';
        break;

    case 'register':
        require 'views/register.php';
        break;

    case 'index':
        // C'est ici qu'on affiche la liste des notes après connexion
        $noteCtrl->afficherAccueil();
        break;

    case 'ajouter':
        $noteCtrl->sauvegarder();
        break;

    // ... gardez vos autres cases (supprimer, editer, etc.) ...

    default:
        require 'views/home.php';
        break;
}