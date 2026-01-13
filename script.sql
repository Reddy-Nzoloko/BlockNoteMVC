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

-- 2. Ajout de la colonne user_id dans la table notes
ALTER TABLE notes ADD COLUMN user_id INT;

-- 3. (Optionnel) Créer un lien officiel entre les deux tables
ALTER TABLE notes ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;