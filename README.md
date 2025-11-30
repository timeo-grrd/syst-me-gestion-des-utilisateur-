# Système de Gestion des Utilisateurs

Petit projet perso en PHP pour gérer une liste d'utilisateurs avec des rôles différents. C'est du PHP procédural pur, sans framework - histoire de bien maitriser les bases avant de compliqué.

## C'est quoi ce projet ?

L'idée était simple : créer une app où les gens peuvent s'inscrire, se connecter, et où les admins peuvent gérer tout le monde. J'ai voulu mettre en pratique la gestion des sessions, la sécurité (vrai truc important), et comment faire fonctionner une base de données correctement.

## Que peut-on faire ?

### Côté utilisateur :

- S'inscrire avec un formulaire qui vérification quand même (email unique, mots de passe qui match, et faut que ce soit costaud : 8 caractères min, une majuscule, un chiffre, un caractère spécial)
- Voir son profil
- Supprimer son compte si on veut

### Côté admin :

- Voir tous les utilisateurs d'un coup d'œil
- Créer des comptes manuellement
- Modifier les infos d'un utilisateur (nom, email, et surtout le rôle)
- Supprimer un compte n'importe lequel
- Y a une petite protection qui empêche un admin de se retirer ses propres droits accidentellement (ça m'a sauvé plusieurs fois)

## Sécurité

J'ai vraiment pas rigolé là-dessus :

- Les requêtes à la base de données se font toutes avec PDO et des requêtes préparées → zéro injection SQL
- Les mots de passe sont hachés avec `password_hash()`
- Les données affichées sont protégées contre les failles XSS avec `htmlspecialchars()`

## Installation

### 1. Télécharger les fichiers

Clone le repo ou télécharge les fichiers dans ton dossier serveur local (pour Laragon c'est le dossier `www`, pour XAMPP c'est `htdocs`).

### 2. Créer la base de données

Ouvre phpMyAdmin et exécute ce script SQL :

```sql
CREATE DATABASE gestion_users;
USE gestion_users;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

INSERT INTO roles (name) VALUES ('user'), ('admin');

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

### 3. Configurer la connexion

Vérifie le fichier `fonctions.php` - c'est là qu'est la connexion à la base. Par défaut c'est configuré pour un environnement local classique (user: `root`, pass: vide). À adapter si c'est différent chez toi.

## Pour tester l'interface admin

Par défaut, quand on s'inscrit, on est "user". Pour tester l'admin :

1. Inscris-toi sur le site
2. Va dans phpMyAdmin, table `users`
3. Change la colonne `role_id` de ton compte à 2
4. Déconnecte-toi et reconnecte-toi
5. Et voilà, tu as accès à l'interface admin

---

Projet by Timéo Girard
