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