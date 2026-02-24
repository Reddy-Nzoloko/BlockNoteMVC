<?php
// models/User.php
class User {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }
    }

   // Dans models/User.php

public function inscrire($email, $password) {
    // 1. Vérifier si l'email existe déjà
    $check = $this->db->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    
    if ($check->rowCount() > 0) {
        return false; // L'email est déjà pris
    }

    // 2. Si non, on procède à l'inscription
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $req = $this->db->prepare($sql);
    
    // Hachage du mot de passe (si ce n'est pas déjà fait dans le contrôleur)
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    
    return $req->execute([$email, $hashed]);
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
    public function supprimer($id) {
    // 1. Supprimer d'abord les notes de l'utilisateur
    $reqNotes = $this->db->prepare('DELETE FROM notes WHERE user_id = ?');
    $reqNotes->execute([$id]);

    // 2. Supprimer l'utilisateur
    $reqUser = $this->db->prepare('DELETE FROM users WHERE id = ?');
    return $reqUser->execute([$id]);
}
}