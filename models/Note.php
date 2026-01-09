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
    // Methode pour l'insertion
    public function creer($titre, $contenu) {
    $req = $this->db->prepare('INSERT INTO notes (titre, contenu) VALUES (?, ?)');
    return $req->execute([$titre, $contenu]);
}
}