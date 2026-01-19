<?php
// controllers/NoteController.php
require_once __DIR__ . '/../models/Note.php';
require_once __DIR__ . '/../models/Category.php';

class NoteController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Sécurité : Vérifier si l'utilisateur est connecté
    private function verifierConnexion() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=home');
            exit();
        }
    }

    public function afficherAccueil() {
        $this->verifierConnexion();
        $ordre = (isset($_GET['tri']) && $_GET['tri'] == 'asc') ? 'ASC' : 'DESC';
        $recherche = $_GET['q'] ?? '';

        $modelNote = new Note();
        $modelCat = new Category();

        $notes = $modelNote->lireToutesParUser($_SESSION['user_id'], $ordre, $recherche);
        $categories = $modelCat->tout(); 

        require __DIR__ . '/../views/liste.php';
    }

    public function sauvegarder() {
        $this->verifierConnexion();
        if (!empty($_POST['titre'])) {
            $model = new Note();
            
            // Gestion de l'image (si tu as ajouté cette option)
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $nom = time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $nom);
                $imagePath = 'uploads/' . $nom;
            }

            $model->creer(
                $_POST['titre'], 
                $_POST['contenu'] ?? '', 
                $_SESSION['user_id'], 
                $_POST['category_id'] ?? null, 
                !empty($_POST['date_rappel']) ? $_POST['date_rappel'] : null,
                $imagePath
            );
        }
        header('Location: index.php');
        exit();
    }

    // --- CETTE MÉTHODE MANQUAIT (ERREUR LIGNE 62) ---
    public function editerNote() {
        $this->verifierConnexion();
        if (isset($_GET['id'])) {
            $modelNote = new Note();
            $modelCat = new Category();
            
            $note = $modelNote->lireUne($_GET['id']);
            $categories = $modelCat->tout(); 
            
            if (!$note || $note['user_id'] != $_SESSION['user_id']) {
                header('Location: index.php');
                exit();
            }
            require __DIR__ . '/../views/editer.php';
        }
    }

    // --- CETTE MÉTHODE MANQUAIT AUSSI ---
    public function mettreAJour() {
        $this->verifierConnexion();
        if (isset($_POST['id']) && !empty($_POST['titre'])) {
            $model = new Note();
            
            // On récupère l'image actuelle par défaut
            $imagePath = $_POST['ancienne_image'] ?? null;
            // Si une nouvelle image est uploadée
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $nom = time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $nom);
                $imagePath = 'uploads/' . $nom;
            }

            $model->modifier(
                $_POST['id'], 
                $_POST['titre'], 
                $_POST['contenu'], 
                $_POST['category_id'], 
                !empty($_POST['date_rappel']) ? $_POST['date_rappel'] : null,
                $imagePath
            );
        }
        header('Location: index.php');
        exit();
    }

    // --- CETTE MÉTHODE MANQUAIT AUSSI ---
    public function supprimerNote() {
        $this->verifierConnexion();
        if (isset($_GET['id'])) {
            $model = new Note();
            $model->supprimer($_GET['id'], $_SESSION['user_id']);
        }
        header('Location: index.php');
        exit();
    }

    public function changerStatut() {
        $this->verifierConnexion();
        if (isset($_GET['id'])) {
            $model = new Note();
            $model->toggleStatut($_GET['id'], $_SESSION['user_id']);
        }
        header('Location: index.php');
        exit();
    }

    public function supprimerMonCompte() {
        $this->verifierConnexion();
        $model = new Note();
        $model->supprimerToutUtilisateur($_SESSION['user_id']);
        session_destroy();
        header('Location: index.php?action=home');
        exit();
    }
}