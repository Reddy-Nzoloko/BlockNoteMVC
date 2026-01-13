<?php
// models/Note.php
class Note {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }
    }

    // On ne récupère que les notes de l'utilisateur connecté
    public function lireToutesParUser($userId) {
        $req = $this->db->prepare('SELECT * FROM notes WHERE user_id = ? ORDER BY date_creation DESC');
        $req->execute([$userId]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // On ajoute l'user_id lors de la création
    public function creer($titre, $contenu, $userId) {
        $req = $this->db->prepare('INSERT INTO notes (titre, contenu, user_id) VALUES (?, ?, ?)');
        return $req->execute([$titre, $contenu, $userId]);
    }

    public function supprimer($id, $userId) {
        // Sécurité : on vérifie aussi l'user_id pour éviter qu'un malin supprime la note d'un autre via l'URL
        $req = $this->db->prepare('DELETE FROM notes WHERE id = ? AND user_id = ?');
        return $req->execute([$id, $userId]);
    }

    public function lireUne($id) {
        $req = $this->db->prepare('SELECT * FROM notes WHERE id = ?');
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function modifier($id, $titre, $contenu) {
        $req = $this->db->prepare('UPDATE notes SET titre = ?, contenu = ? WHERE id = ?');
        return $req->execute([$titre, $contenu, $id]);
    }
}