# Système de Gestion d'Utilisateurs (PHP Procédural)

Ce projet est une application web complète de gestion d'utilisateurs réalisée en **PHP Procédural** (sans Programmation Orientée Objet). Il a été développé dans le cadre d'un exercice pédagogique visant à maîtriser les interactions avec une base de données MySQL via PDO, la gestion des sessions et la sécurisation des données.

## 📋 Fonctionnalités

Le projet respecte un cahier des charges strict incluant :

### 👤 Partie Utilisateur
* **Inscription sécurisée :**
    * Hachage des mots de passe (`password_hash`).
    * Vérification par Regex (8 caractères, majuscule, chiffre, caractères spéciaux).
    * Vérification d'unicité de l'email.
    * Confirmation du mot de passe.
* **Connexion / Déconnexion :** Gestion des sessions PHP.
* **Espace Membre :**
    * Affichage des informations personnelles.
    * Possibilité de supprimer son propre compte.

### 👑 Partie Administrateur (Back-office)
* Accessible uniquement aux utilisateurs ayant le rôle **Admin**.
* **Tableau de bord :** Liste complète des inscrits avec leur rôle.
* **Gestion (CRUD) :**
    * Ajouter un utilisateur.
    * Modifier un profil (Nom, Email, et Rôle).
    * Supprimer un utilisateur.
* **Sécurité :** Protection contre l'auto-rétrogradation (un admin ne peut pas se retirer ses propres droits).

## 🛠️ Stack Technique

* **Langage :** PHP 8 (Procédural).
* **Base de données :** MySQL.
* **Interface :** PDO avec requêtes préparées (Prepared Statements) pour éviter les injections SQL.
* **Frontend :** HTML5 / CSS3 (Simple et fonctionnel).

## 🚀 Installation et Configuration

Pour tester le projet localement :

1.  **Cloner le dépôt :**
    ```bash
    git clone [https://github.com/TON_PSEUDO/TON_REPO.git](https://github.com/TON_PSEUDO/TON_REPO.git)
    ```

2.  **Configuration de la Base de Données :**
    Ouvrez votre gestionnaire SQL (phpMyAdmin, HeidiSQL...) et exécutez les commandes suivantes pour créer la structure :

    ```sql
    CREATE DATABASE gestion_users;
    USE gestion_users;

    -- Création de la table des rôles
    CREATE TABLE roles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
    );

    -- Insertion des rôles par défaut
    INSERT INTO roles (name) VALUES ('user'), ('admin');

    -- Création de la table utilisateurs
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
    ```

3.  **Configuration PHP :**
    Vérifiez le fichier `fonctions.php` pour vous assurer que les identifiants de connexion à la base de données correspondent aux vôtres (root / "" par défaut sur Laragon/XAMPP).

## 🔑 Compte de Démonstration

Pour tester l'interface administrateur, vous pouvez créer un compte via l'inscription, puis modifier manuellement son `role_id` à **2** dans la base de données, ou utiliser les identifiants suivants (si créés) :

* **Email :** admin@test.com
* **Mot de passe :** Admin123!

## 🛡️ Sécurité

Le projet met un point d'honneur sur la sécurité :
* Utilisation systématique de `htmlspecialchars()` contre les failles XSS.
* Utilisation de `prepare()` et `execute()` contre les injections SQL.
* Validation des données entrantes (`trim`, `filter_var`, Regex).
* Contrôle strict des sessions (`requireLogin`, `requireAdmin`).

---
*Projet réalisé par Timéo Girard*
