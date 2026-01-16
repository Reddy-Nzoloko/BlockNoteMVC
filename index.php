<?php
require_once 'controllers/NoteController.php';
require_once 'controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$auth = new AuthController();

switch($action) {
    // --- AUTHENTIFICATION ---
    case 'login': 
        $auth->afficherLogin(); 
        break;
    case 'traiter_login': 
        $auth->traiterLogin(); 
        break;
    case 'logout': 
        $auth->logout(); 
        break;
    case 'register':
        $auth->afficherRegister();
        break;
    case 'traiter_register':
        $auth->traiterRegister();
        break;

    // --- GESTION DES NOTES ---
    case 'toggle':
        $noteCtrl = new NoteController(); // On crée l'objet
        $noteCtrl->changerStatut();
        break;

    case 'editer':
        $noteCtrl = new NoteController(); // On crée l'objet
        $noteCtrl->editerNote();
        break;

    case 'mettreAJour':
        $noteCtrl = new NoteController(); // On utilise le bon nom de variable
        $noteCtrl->mettreAJour();
        break;
    
    case 'ajouter':
        $noteCtrl = new NoteController();
        $noteCtrl->sauvegarder();
        break;

    case 'supprimer':
        $noteCtrl = new NoteController();
        $noteCtrl->supprimerNote();
        break;

    // --- ACCUEIL ---
    default:
        $noteCtrl = new NoteController();
        $noteCtrl->afficherAccueil();
        break;
}