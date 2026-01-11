<?php
// index.php
require_once 'controllers/NoteController.php';

$controller = new NoteController();

// On regarde si une action est demandée dans l'URL (ex: index.php?action=ajouter)
if (isset($_GET['action']) && $_GET['action'] == 'ajouter') {
    $controller->sauvegarder();
} else {
    // Par défaut, on affiche la liste
    $controller->afficherAccueil();
}
// ... (sous l'action ajouter)
switch($_GET['action']) {
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
    default:
        $controller->afficherAccueil();
        break;
}
