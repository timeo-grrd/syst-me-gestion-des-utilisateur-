Système de Gestion d'Utilisateurs (PHP Procédural)
Ce dépôt contient le code source de mon projet de développement web. Il s'agit d'une application de gestion de membres réalisée en PHP procédural, sans utiliser de framework ni de Programmation Orientée Objet (POO).

L'objectif de ce travail était de mettre en pratique les fondamentaux du langage PHP : la gestion des sessions, la sécurité des formulaires et les interactions avec une base de données MySQL via PDO.

Fonctionnalités du projet
Le site est divisé en deux parties selon le rôle de l'utilisateur :

1. Partie Utilisateur (Publique)
Inscription : Le formulaire vérifie que l'email est unique, que les mots de passe correspondent et qu'ils respectent une complexité minimale (8 caractères, majuscule, chiffre, caractère spécial).

Connexion : Système d'authentification sécurisé via sessions PHP.

Gestion de compte : L'utilisateur peut consulter ses informations et supprimer son compte définitivement.

2. Partie Administrateur (Privée)
Accessible uniquement aux utilisateurs ayant le rôle "Admin".

Tableau de bord : Vue d'ensemble de tous les utilisateurs inscrits.

Ajout de membre : Possibilité de créer un compte manuellement.

Modification : L'administrateur peut modifier le nom, l'email et surtout le rôle (passer un membre en admin et inversement).

Suppression : Suppression de n'importe quel compte utilisateur.

Sécurité : Une protection empêche l'administrateur de se retirer ses propres droits accidentellement.

Choix Techniques
Langage : PHP 8 (structure procédurale).

Base de données : MySQL.

Sécurité BDD : Utilisation exclusive de PDO et des requêtes préparées (Prepared Statements) pour empêcher les injections SQL.

Sécurité des données : Les mots de passe sont hachés avec password_hash() et les affichages sont protégés contre les failles XSS avec htmlspecialchars().

Installation locale
Pour tester le projet sur votre machine, voici les étapes à suivre :

1. Récupération des fichiers Clonez ce dépôt ou téléchargez les fichiers dans le dossier de votre serveur local (ex: www pour Laragon/Wamp ou htdocs pour XAMPP).

2. Création de la Base de Données Ouvrez votre gestionnaire SQL (phpMyAdmin ou autre) et exécutez le script SQL suivant pour créer la base et les tables nécessaires :

SQL

CREATE DATABASE gestion_users;
USE gestion_users;

-- Table des rôles (Admin / User)
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

INSERT INTO roles (name) VALUES ('user'), ('admin');

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    adresse VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_users_roles FOREIGN KEY (role_id) REFERENCES roles(id)
);
3. Configuration Vérifiez le fichier fonctions.php à la racine. Il contient la fonction de connexion à la base de données. Par défaut, elle est configurée pour un environnement local standard (Utilisateur : root, Mot de passe : vide). Modifiez ces valeurs si nécessaire.

Accéder à l'interface Admin
Lors d'une inscription classique, l'utilisateur reçoit par défaut le rôle "User". Pour tester les fonctionnalités administrateur :

Inscrivez-vous sur le site via le formulaire.

Allez dans votre base de données (table users).

Modifiez la colonne role_id de votre utilisateur et mettez la valeur 2 (au lieu de 1).

Déconnectez-vous et reconnectez-vous sur le site : le menu administrateur sera désormais visible.

Projet réalisé par Timéo Girard
