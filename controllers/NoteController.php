<?php
require_once __DIR__ . '/../models/Note.php';
require_once __DIR__ . '/../models/Category.php';

class NoteController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function verifierConnexion() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=home');
            exit();
        }
    }

    public function afficherAccueil() {
        $this->verifierConnexion();
        $ordre = ($_GET['tri'] ?? 'DESC') === 'asc' ? 'ASC' : 'DESC';
        $recherche = $_GET['q'] ?? '';

        $modelNote = new Note();
        $notes = $modelNote->lireToutesParUser($_SESSION['user_id'], $ordre, $recherche);
        $categories = (new Category())->tout(); 

        require __DIR__ . '/../views/liste.php';
    }

    public function sauvegarder() {
        $this->verifierConnexion();
        
        if (!empty($_POST['titre'])) {
            $imagePath = $this->gererUploadImage();
            
            (new Note())->creer(
                $_POST['titre'], 
                $_POST['contenu'] ?? '', 
                $_SESSION['user_id'], 
                $_POST['category_id'] ?? null, 
                !empty($_POST['date_rappel']) ? $_POST['date_rappel'] : null,
                $imagePath
            );
            $_SESSION['flash'] = ['type' => 'success', 'message' => '✨ Note MindFlow ajoutée !'];
        }
        header('Location: index.php');
    }

    public function mettreAJour() {
        $this->verifierConnexion();
        if (isset($_POST['id'])) {
            $imagePath = $_POST['ancienne_image'] ?? null;
            if (!empty($_FILES['image']['name'])) {
                $imagePath = $this->gererUploadImage();
            }

            (new Note())->modifier(
                $_POST['id'], 
                $_POST['titre'], 
                $_POST['contenu'], 
                $_POST['category_id'], 
                !empty($_POST['date_rappel']) ? $_POST['date_rappel'] : null,
                $imagePath
            );
        }
        header('Location: index.php');
    }

    private function gererUploadImage() {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $dossier = 'uploads/';
            if (!is_dir($dossier)) mkdir($dossier, 0777, true);
            
            $nom = time() . '_' . basename($_FILES['image']['name']);
            $cheminComplet = $dossier . $nom;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $cheminComplet)) {
                return $cheminComplet;
            }
        }
        return null;
    }

    public function supprimerMonCompte() {
        $this->verifierConnexion();
        (new Note())->supprimerToutUtilisateur($_SESSION['user_id']);
        session_destroy();
        header('Location: index.php?action=home');
        exit();
    }

    // Ajoutez ici les méthodes supprimerNote(), editerNote(), etc. en utilisant verifierConnexion()
}