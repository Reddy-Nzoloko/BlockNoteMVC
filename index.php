<?php
require_once 'controllers/NoteController.php';
require_once 'controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$auth = new AuthController();

switch($action) {
    case 'login': $auth->afficherLogin(); break;
    case 'traiter_login': $auth->traiterLogin(); break;
    case 'logout': $auth->logout(); break;
    // Dans index.php, ajoutez ces cases au switch ($action) :
case 'logout':
        $auth->logout();
        break;
    case 'toggle':
        $noteCtrl = new NoteController();
        $noteCtrl->changerStatut();
        break;
case 'register':
    $auth->afficherRegister();
    break;

case 'traiter_register':
    $auth->traiterRegister();
    break;
    
    // Pour toutes les autres actions sur les notes
    default:
        $noteCtrl = new NoteController();
        if ($action == 'ajouter') $noteCtrl->sauvegarder();
        else $noteCtrl->afficherAccueil();
        break;
}