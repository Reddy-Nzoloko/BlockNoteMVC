<?php
// index.php
require_once 'controllers/NoteController.php';

$controller = new NoteController();

// 1. On récupère l'action de l'URL, si elle n'existe pas, on utilise 'index' par défaut
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 2. Le "Router" : un seul switch pour diriger l'utilisateur au bon endroit
switch($action) {
    case 'ajouter':
        $controller->sauvegarder();
        break;
        
    case 'supprimer':
        $controller->supprimerNote();
        break;
        
    case 'editer':
        $controller->editerNote();
        break;
        
    case 'confirmer_modifier':
        $controller->mettreAJour();
        break;
        
    case 'index':
    default:
        $controller->afficherAccueil();
        break;
}