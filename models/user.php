<?php
// models/User.php
class User {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }
    }

    public function inscrire($email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT); // Hachage sécurisé
        $req = $this->db->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        return $req->execute([$email, $hash]);
    }

    public function connecter($email, $password) {
        $req = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute([$email]);
        $user = $req->fetch();

        // On vérifie si l'utilisateur existe et si le mot de passe correspond au hash
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}