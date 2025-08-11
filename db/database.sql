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
    `name` varchar(100) NOT NULL,
    `family` varchar(100) NOT NULL,
    `category` ENUM('cactus', 'ornamental', 'frutal') NOT NULL,
    PRIMARY KEY (`id`)
);