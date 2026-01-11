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
    // ... (reste du code)

// Action : Supprimer
public function supprimerNote() {
    if (isset($_GET['id'])) {
        $model = new Note();
        $model->supprimer($_GET['id']);
    }
    header('Location: index.php');
}

// Action : Afficher le formulaire de modification
public function editerNote() {
    if (isset($_GET['id'])) {
        $model = new Note();
        $note = $model->lireUne($_GET['id']);
        require __DIR__ . '/../views/editer.php'; // On va créer cette vue
    }
}

// Action : Enregistrer les modifications
public function mettreAJour() {
    if (isset($_POST['id']) && !empty($_POST['titre'])) {
        $model = new Note();
        $model->modifier($_POST['id'], $_POST['titre'], $_POST['contenu']);
    }
    header('Location: index.php');
}
}