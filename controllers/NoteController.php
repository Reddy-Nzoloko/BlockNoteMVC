<?php
// controllers/NoteController.php
require_once __DIR__ . '/../models/Note.php';
require_once __DIR__ . '/../models/Category.php'; // Importation nécessaire ici

class NoteController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
    }

    // VERSION UNIQUE : Gère le tri, la recherche ET les catégories
    public function afficherAccueil() {
        $ordre = (isset($_GET['tri']) && $_GET['tri'] == 'asc') ? 'ASC' : 'DESC';
        $recherche = isset($_GET['q']) ? $_GET['q'] : '';

        $modelNote = new Note();
        $modelCat = new Category();

        // Récupère les notes filtrées
        $notes = $modelNote->lireToutesParUser($_SESSION['user_id'], $ordre, $recherche);
        // Récupère les catégories pour le formulaire
        $categories = $modelCat->tout(); 

        require __DIR__ . '/../views/liste.php';
    }

    // VERSION UNIQUE : Enregistre avec l'ID de catégorie
   public function sauvegarder() {
    if (!empty($_POST['titre']) && !empty($_POST['category_id'])) {
        $model = new Note();
        $model->creer($_POST['titre'], $_POST['contenu'], $_SESSION['user_id'], $_POST['category_id']);
        
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Nouvelle note enregistrée !'
        ];
    }
    header('Location: index.php');
}

    // Exemple pour la suppression
public function supprimerNote() {
    if (isset($_GET['id'])) {
        $model = new Note();
        $model->supprimer($_GET['id'], $_SESSION['user_id']);
        
        // On crée le message flash
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'La note a été supprimée avec succès !'
        ];
    }
    header('Location: index.php');
}

// Exemple pour la sauvegarde


    public function editerNote() {
        if (isset($_GET['id'])) {
            $modelNote = new Note();
            $modelCat = new Category();
            
            $note = $modelNote->lireUne($_GET['id']);
            $categories = $modelCat->tout(); // Utile si on veut changer la catégorie en éditant
            
            if (!$note || $note['user_id'] != $_SESSION['user_id']) {
                header('Location: index.php');
                exit();
            }
            require __DIR__ . '/../views/editer.php';
        }
    }

    public function mettreAJour() {
        if (isset($_POST['id']) && !empty($_POST['titre'])) {
            $model = new Note();
            $resultat = $model->modifier($_POST['id'], $_POST['titre'], $_POST['contenu']);
            
            if ($resultat) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Note mise à jour avec succès !'
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Erreur lors de la mise à jour.'
                ];
            }
        }
        header('Location: index.php');
    }

    public function changerStatut() {
        if (isset($_GET['id'])) {
            $model = new Note();
            $model->toggleStatut($_GET['id'], $_SESSION['user_id']);
        }
        header('Location: index.php');
    }
} // Fin de la classe