<?php
class Note {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }
    }

    public function lireToutesParUser($userId, $ordre, $recherche) {
        $sql = "SELECT n.*, c.nom as cat_nom, c.couleur as cat_couleur 
                FROM notes n LEFT JOIN categories c ON n.category_id = c.id 
                WHERE n.user_id = ?";
        $params = [$userId];
        if (!empty($recherche)) {
            $sql .= " AND (n.titre LIKE ? OR n.contenu LIKE ?)";
            $params[] = "%$recherche%"; $params[] = "%$recherche%";
        }
        $sql .= " ORDER BY n.date_creation $ordre";
        $req = $this->db->prepare($sql);
        $req->execute($params);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creer($titre, $contenu, $userId, $categoryId, $dateRappel, $imagePath) {
        $req = $this->db->prepare('INSERT INTO notes (titre, contenu, user_id, category_id, date_rappel, image_path, date_creation) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        return $req->execute([$titre, $contenu, $userId, $categoryId, $dateRappel, $imagePath]);
    }

    public function modifier($id, $titre, $contenu, $categoryId, $dateRappel, $imagePath) {
        $req = $this->db->prepare('UPDATE notes SET titre = ?, contenu = ?, category_id = ?, date_rappel = ?, image_path = ? WHERE id = ?');
        return $req->execute([$titre, $contenu, $categoryId, $dateRappel, $imagePath, $id]);
    }

    public function supprimerToutUtilisateur($userId) {
        // Supprime les notes
        $req1 = $this->db->prepare('DELETE FROM notes WHERE user_id = ?');
        $req1->execute([$userId]);
        // Supprime l'utilisateur
        $req2 = $this->db->prepare('DELETE FROM users WHERE id = ?');
        return $req2->execute([$userId]);
    }

    public function supprimer($id, $userId) {
        return $this->db->prepare('DELETE FROM notes WHERE id = ? AND user_id = ?')->execute([$id, $userId]);
    }

    public function lireUne($id) {
        $req = $this->db->prepare('SELECT * FROM notes WHERE id = ?');
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
}