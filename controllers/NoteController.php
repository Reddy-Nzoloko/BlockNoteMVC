<?php
// controllers/NoteController.php
require_once __DIR__ . '/../models/Note.php';

class NoteController {
    
    public function __construct() {
        // On démarre la session une seule fois
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Sécurité : Si pas de session, retour au login
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
    }

    public function afficherAccueil() {
        $model = new Note();
        $notes = $model->lireToutesParUser($_SESSION['user_id']); 
        require __DIR__ . '/../views/liste.php';
    }

    public function sauvegarder() {
        if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
            $model = new Note();
            // On passe l'ID de l'utilisateur connecté
            $model->creer($_POST['titre'], $_POST['contenu'], $_SESSION['user_id']);
        }
        header('Location: index.php');
    }

    public function supprimerNote() {
        if (isset($_GET['id'])) {
            $model = new Note();
            $model->supprimer($_GET['id'], $_SESSION['user_id']);
        }
        header('Location: index.php');
    }

    public function editerNote() {
        if (isset($_GET['id'])) {
            $model = new Note();
            $note = $model->lireUne($_GET['id']);
            
            // Vérification de sécurité : est-ce bien la note de l'utilisateur ?
            if ($note['user_id'] != $_SESSION['user_id']) {
                header('Location: index.php');
                exit();
            }
            require __DIR__ . '/../views/editer.php';
        }
    }

    public function mettreAJour() {
        if (isset($_POST['id']) && !empty($_POST['titre'])) {
            $model = new Note();
            $model->modifier($_POST['id'], $_POST['titre'], $_POST['contenu']);
        }
        header('Location: index.php');
    }
}