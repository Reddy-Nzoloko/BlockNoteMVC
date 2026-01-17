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
  public function lireToutesParUser($userId, $ordre = 'DESC', $recherche = '') {
    // On sélectionne les colonnes de notes ET le nom/couleur de la catégorie
    $sql = "SELECT n.*, c.nom as cat_nom, c.couleur as cat_couleur 
            FROM notes n 
            LEFT JOIN categories c ON n.category_id = c.id 
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

// Mettre à jour aussi la méthode creer() pour inclure category_id et maintenant heure aussi
public function creer($titre, $contenu, $userId, $categoryId, $dateRappel) {
    // Notez qu'on a ajouté date_rappel dans la requête SQL
    $req = $this->db->prepare('INSERT INTO notes (titre, contenu, user_id, category_id, date_rappel, date_creation) VALUES (?, ?, ?, ?, ?, NOW())');
    
    return $req->execute([
        $titre, 
        $contenu, 
        $userId, 
        $categoryId, 
        $dateRappel
    ]);
}

    // On ajoute l'user_id lors de la création pour lier la note à l'utilisateur
    // public function creer($titre, $contenu, $userId) {
    //     $req = $this->db->prepare('INSERT INTO notes (titre, contenu, user_id, statut) VALUES (?, ?, ?, 0)');
    //     return $req->execute([$titre, $contenu, $userId]);
    // }

    // Inverser le statut (0 = en cours, 1 = terminé)
    public function toggleStatut($id, $userId) {
        $req = $this->db->prepare("UPDATE notes SET statut = NOT statut WHERE id = ? AND user_id = ?");
        return $req->execute([$id, $userId]);
    }

 public function supprimer($id, $userId) {
    // On ajoute AND user_id = ? pour la sécurité
    $req = $this->db->prepare('DELETE FROM notes WHERE id = ? AND user_id = ?');
    return $req->execute([$id, $userId]);
}

    public function lireUne($id) {
    $req = $this->db->prepare('SELECT * FROM notes WHERE id = ?');
    $req->execute([$id]);
    return $req->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif
}

    public function modifier($id, $titre, $contenu) {
    $req = $this->db->prepare('UPDATE notes SET titre = ?, contenu = ? WHERE id = ?');
    return $req->execute([$titre, $contenu, $id]);
}
}