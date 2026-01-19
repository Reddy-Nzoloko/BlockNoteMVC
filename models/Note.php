<?php
// models/Note.php
class Note {
    private $db;

    public function __construct() {
        try {
            // Connexion à la base de données avec activation des erreurs SQL
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) { 
            die('Erreur de connexion : ' . $e->getMessage()); 
        }
    }

    public function lireToutesParUser($userId, $ordre, $recherche) {
        $sql = "SELECT n.*, c.nom as cat_nom, c.couleur as cat_couleur 
                FROM notes n LEFT JOIN categories c ON n.category_id = c.id 
                WHERE n.user_id = ?";
        $params = [$userId];
        
        if (!empty($recherche)) {
            $sql .= " AND (n.titre LIKE ? OR n.contenu LIKE ?)";
            $params[] = "%$recherche%"; 
            $params[] = "%$recherche%";
        }
        
        $sql .= " ORDER BY n.date_creation $ordre";
        $req = $this->db->prepare($sql);
        $req->execute($params);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creer($titre, $contenu, $userId, $categoryId, $dateRappel, $imagePath) {
        // Ajout explicite du statut à 0 (non terminé) par défaut
        $req = $this->db->prepare('INSERT INTO notes (titre, contenu, user_id, category_id, date_rappel, image_path, date_creation, statut) VALUES (?, ?, ?, ?, ?, ?, NOW(), 0)');
        return $req->execute([$titre, $contenu, $userId, $categoryId, $dateRappel, $imagePath]);
    }

    // --- LA MÉTHODE MANQUANTE AJOUTÉE ICI ---
    public function toggleStatut($id, $userId) {
        // "NOT statut" inverse la valeur : 0 devient 1, 1 devient 0
        $req = $this->db->prepare("UPDATE notes SET statut = NOT statut WHERE id = ? AND user_id = ?");
        return $req->execute([$id, $userId]);
    }

    public function modifier($id, $titre, $contenu, $categoryId, $dateRappel, $imagePath) {
        $req = $this->db->prepare('UPDATE notes SET titre = ?, contenu = ?, category_id = ?, date_rappel = ?, image_path = ? WHERE id = ?');
        return $req->execute([$titre, $contenu, $categoryId, $dateRappel, $imagePath, $id]);
    }

    public function supprimer($id, $userId) {
        $req = $this->db->prepare('DELETE FROM notes WHERE id = ? AND user_id = ?');
        return $req->execute([$id, $userId]);
    }

    public function lireUne($id) {
        $req = $this->db->prepare('SELECT * FROM notes WHERE id = ?');
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function supprimerToutUtilisateur($userId) {
        // 1. Supprimer les notes
        $req1 = $this->db->prepare('DELETE FROM notes WHERE user_id = ?');
        $req1->execute([$userId]);
        
        // 2. Supprimer l'utilisateur
        $req2 = $this->db->prepare('DELETE FROM users WHERE id = ?');
        return $req2->execute([$userId]);
    }
}