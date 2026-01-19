<?php
// controllers/AuthController.php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function afficherLogin() {
        require __DIR__ . '/../views/login.php';
    }

    public function traiterLogin() {
        $model = new User();
        $user = $model->connecter($_POST['email'], $_POST['password']);
        
        // Dans controllers/AuthController.php, méthode traiterLogin() :
if ($user) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Heureux de vous revoir, ' . explode('@', $user['email'])[0] . ' !'
    ];
    
    header('Location: index.php');
}
    }
    // Dans controllers/AuthController.php

public function afficherRegister() {
    require __DIR__ . '/../views/register.php';
}


public function traiterRegister() {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $model = new User();
        // On appelle la méthode inscrire du modèle
        $success = $model->inscrire($_POST['email'], $_POST['password']);
        
        if ($success) {
            // Inscription réussie -> vers le login avec un petit message de succès
            header('Location: index.php?action=login&success=1');
        } else {
            // Erreur (email déjà pris ?)
            header('Location: index.php?action=register&erreur=1');
        }
    }
}
// Fonction de Recuperation des mots de pass
public function traiterRecuperation() {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        // 1. Vérifier si l'user existe (à faire dans le Model)
        // 2. Générer un token
        $token = bin2hex(random_bytes(32)); 
        
        // 3. Sauvegarder en base de données avec une expiration (+15 min)
        // (Simulé ici)
        
        // 4. "Envoyer" l'email
        // Pour vos tests, on va juste afficher un message de succès
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Si cet email existe, un lien a été envoyé !'
        ];
    }
    header('Location: index.php?action=login');
}
// Suppression du compte utilisateur 
public function supprimerCompte() {
    if (isset($_SESSION['user_id'])) {
        $model = new User();
        $model->supprimer($_SESSION['user_id']);
        
        // On détruit la session après suppression
        session_destroy();
        header('Location: index.php?action=home');
        exit();
    }
}

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
    }
}