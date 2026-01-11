<?php
// models/Note.php
class Note {
    private $db;

    public function __construct() {
        // Connexion à la base de données
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function lireToutes() {
        $req = $this->db->query('SELECT * FROM notes ORDER BY date_creation DESC');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // Methode pour l'insertion des données dans la base de donnée 
    public function creer($titre, $contenu) {
    $req = $this->db->prepare('INSERT INTO notes (titre, contenu) VALUES (?, ?)');
    return $req->execute([$titre, $contenu]);

    // Supprimer une note
public function supprimer($id) {
    $req = $this->db->prepare('DELETE FROM notes WHERE id = ?');
    return $req->execute([$id]);
}

// Récupérer une seule note par son ID
public function lireUne($id) {
    $req = $this->db->prepare('SELECT * FROM notes WHERE id = ?');
    $req->execute([$id]);
    return $req->fetch(PDO::FETCH_ASSOC);
}

// Mettre à jour une note
public function modifier($id, $titre, $contenu) {
    $req = $this->db->prepare('UPDATE notes SET titre = ?, contenu = ? WHERE id = ?');
    return $req->execute([$titre, $contenu, $id]);
}
}
}