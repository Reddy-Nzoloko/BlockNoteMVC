<?php
// models/Note.php
class Note {
    private $db;

    public function __construct() {
        try {
            // Connexion à la base de données
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) { 
            die('Erreur : ' . $e->getMessage()); 
        }
    }

    // VERSION UNIQUE ET FUSIONNÉE : Récupérer les notes avec option de tri
   // Modifier cette fonction dans models/Note.php
public function lireToutesParUser($userId, $ordre = 'DESC', $recherche = '') {
    $sql = "SELECT * FROM notes WHERE user_id = ? ";
    $params = [$userId];

    // Si une recherche est fournie, on ajoute une condition SQL
    if (!empty($recherche)) {
        $sql .= " AND (titre LIKE ? OR contenu LIKE ?)";
        $terme = "%$recherche%"; // Le terme peut être au début, au milieu ou à la fin
        $params[] = $terme;
        $params[] = $terme;
    }

    $sql .= " ORDER BY date_creation $ordre";
    
    $req = $this->db->prepare($sql);
    $req->execute($params);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

    // On ajoute l'user_id lors de la création pour lier la note à l'utilisateur
    public function creer($titre, $contenu, $userId) {
        $req = $this->db->prepare('INSERT INTO notes (titre, contenu, user_id, statut) VALUES (?, ?, ?, 0)');
        return $req->execute([$titre, $contenu, $userId]);
    }

    // Inverser le statut (0 = en cours, 1 = terminé)
    public function toggleStatut($id, $userId) {
        $req = $this->db->prepare("UPDATE notes SET statut = NOT statut WHERE id = ? AND user_id = ?");
        return $req->execute([$id, $userId]);
    }

    public function supprimer($id, $userId) {
        // Sécurité : on vérifie l'user_id pour que personne ne supprime les notes des autres
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