-- Active: 1754396916329@@127.0.0.1@3306@garden
CREATE DATABASE IF NOT EXISTS `garden`;

USE `garden`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
);

INSERT INTO
    `users` (`name`, `email`, `password`)
VALUES (
        'adrian',
        'adrian@gmail.com',
        SHA2('h3ll0.', 512)
    );

INSERT INTO
    `users` (`name`, `email`, `password`)
VALUES (
        'ana',
        'ana@gmail.com',
        SHA2('h3ll0.', 512)
    );

CREATE TABLE `plantas` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `familia` varchar(100) NOT NULL,
    `categoria` ENUM('cactus', 'ornamental', 'frutal') NOT NULL,
    `proximo_riego` date DEFAULT NULL,
    `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

INSERT INTO plantas
    (`nombre`, `familia`, `categoria`)
VALUES
    ('Aloe Vera', 'Asphodelaceae', 'cactus'),
    ('Lavanda', 'Lamiaceae', 'ornamental'),
    ('Fresa', 'Rosaceae', 'frutal'),
    ('Lengua de suegra', 'Asparagaceae', 'ornamental'),
    ('Nopal', 'Cactaceae', 'cactus'),
    ('Tomatera', 'Solanaceae', 'frutal'),
    ('Orquídea', 'Orchidaceae', 'ornamental'),
    ('Higuera', 'Moraceae', 'frutal'),
    ('Sansevieria', 'Asparagaceae', 'ornamental'),
    ('Pitahaya', 'Cactaceae', 'cactus');

CREATE TABLE `riegos` (
    `id` int AUTO_INCREMENT PRIMARY KEY,
    `planta_id` INT NOT NULL,
    `fecha_riego` DATE NOT NULL,
    FOREIGN KEY (planta_id) REFERENCES plantas(id) ON DELETE CASCADE
);