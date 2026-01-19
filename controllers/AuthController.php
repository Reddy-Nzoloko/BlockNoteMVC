<?php
// controllers/AuthController.php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function __construct() {
        // On s'assure que la session est démarrée pour les messages flash
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Cette méthode correspond à l'action 'login' du switch (affichage)
    public function afficherLogin() {
        require __DIR__ . '/../views/login.php';
    }

    // Cette méthode correspond à 'traiter_login' dans ton index.php
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $model = new User();
            // On suppose que ta méthode connecter() vérifie l'email ET le mot de passe
            $user = $model->connecter($email, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Heureux de vous revoir, ' . explode('@', $user['email'])[0] . ' !'
                ];
                
                header('Location: index.php?action=index');
                exit();
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Identifiants incorrects.'
                ];
                header('Location: index.php?action=login');
                exit();
            }
        }
    }

    public function afficherRegister() {
        require __DIR__ . '/../views/register.php';
    }

    // Cette méthode correspond à 'traiter_register'
    public function register() {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $model = new User();
            $success = $model->inscrire($_POST['email'], $_POST['password']);
            
            if ($success) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Compte créé avec succès ! Connectez-vous.'
                ];
                header('Location: index.php?action=login');
                exit();
            } else {
                header('Location: index.php?action=register&erreur=1');
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=home');
        exit();
    }

    public function supprimerCompte() {
        if (isset($_SESSION['user_id'])) {
            $model = new User();
            $model->supprimer($_SESSION['user_id']);
            
            session_destroy();
            header('Location: index.php?action=home');
            exit();
        }
    }

    public function traiterRecuperation() {
        if (!empty($_POST['email'])) {
            // Logique de simulation de mail
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Si cet email existe, un lien a été envoyé !'
            ];
        }
        header('Location: index.php?action=login');
        exit();
    }
}