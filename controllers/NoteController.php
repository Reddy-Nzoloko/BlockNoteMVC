<?php
require_once __DIR__ . '/../models/Note.php';

class NoteController {
    
    // Action : Afficher la liste
    public function afficherAccueil() {
        $model = new Note();
        $notes = $model->lireToutes();
        require __DIR__ . '/../views/liste.php';
    }

    // Action : Sauvegarder une note
    public function sauvegarder() {
        if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
            $model = new Note();
            $model->creer($_POST['titre'], $_POST['contenu']);
        }
        // Une fois fini, on redirige vers l'accueil pour voir la nouvelle note
        header('Location: index.php');
    }
}