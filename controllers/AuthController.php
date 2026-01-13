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
        
        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header('Location: index.php');
        } else {
            header('Location: index.php?action=login&erreur=1');
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

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
    }
}