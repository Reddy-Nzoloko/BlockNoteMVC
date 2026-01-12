CREATE DATABASE note_app;
USE note_app;

-- premiere partie on doit enrichir le truc
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);