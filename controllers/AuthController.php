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
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Veuillez remplir tous les champs.'
                ];
                header('Location: index.php?action=login');
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Adresse email invalide.'
                ];
                header('Location: index.php?action=login');
                exit();
            }

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
    // Dans controllers/AuthController.php, méthode register()

public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Veuillez remplir tous les champs.'
            ];
            header('Location: index.php?action=register');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Adresse email invalide.'
            ];
            header('Location: index.php?action=register');
            exit();
        }

        if (strlen($password) < 6) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Le mot de passe doit contenir au moins 6 caractères.'
            ];
            header('Location: index.php?action=register');
            exit();
        }

        $model = new User();
        $success = $model->inscrire($email, $password);
        
        if ($success) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Compte créé ! Vous pouvez vous connecter.'
            ];
            header('Location: index.php?action=login');
            exit();
        } else {
            // C'est ici qu'on gère le doublon
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Cette adresse email est déjà utilisée.'
            ];
            header('Location: index.php?action=register');
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