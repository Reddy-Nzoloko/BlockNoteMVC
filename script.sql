CREATE DATABASE note_app;
USE note_app;

-- premiere partie on doit enrichir le truc
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- 1. Création de la table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- ajout de la collone des statuts pour les taches ou alors notes dans tous les sens cv 
ALTER TABLE notes ADD COLUMN statut TINYINT(1) DEFAULT 0; -- 0 = En cours, 1 = Terminé

-- 2. Ajout de la colonne user_id dans la table notes
ALTER TABLE notes ADD COLUMN user_id INT;

-- 3. (Optionnel) Créer un lien officiel entre les deux tables
ALTER TABLE notes ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
-- 1. Création de la table des catégories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    couleur VARCHAR(50) DEFAULT 'bg-gray-200 text-gray-800' -- Classe Tailwind
);

-- 2. Insertion de quelques catégories par défaut
INSERT INTO categories (nom, couleur) VALUES 
('Travail', 'bg-blue-100 text-blue-700'),
('Personnel', 'bg-green-100 text-green-700'),
('Idées', 'bg-purple-100 text-purple-700'),
('Urgent', 'bg-red-100 text-red-700'),
('Etude', 'bg-yellow-100 text-yellow-700'),
('Sport', 'bg-orange-100 text-orange-700');

-- 3. Ajout de la colonne category_id dans la table notes
ALTER TABLE notes ADD COLUMN category_id INT;

-- fonctionnalité de la recuperation des mots de pass 
CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expire_at DATETIME NOT NULL
);

-- ajout d'une table de notification pour que l'application notifis la personne 
ALTER TABLE notes ADD COLUMN date_rappel DATETIME NULL;