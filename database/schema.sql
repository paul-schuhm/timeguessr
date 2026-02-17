-- Création de la base si elle n'existe pas
CREATE DATABASE IF NOT EXISTS timeguessr CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utilisation de la base
USE timeguessr;

-- Création de la table image
CREATE TABLE IF NOT EXISTS image (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    path VARCHAR(100) NOT NULL,
    latitude DECIMAL(9, 6) NOT NULL,
    longitude DECIMAL(9, 6) NOT NULL,
    annee YEAR NOT NULL
) ENGINE = InnoDB;