<?php
class Category {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=note_app;charset=utf8', 'root', '');
        } catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }
    }

    public function tout() {
        return $this->db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    }
}