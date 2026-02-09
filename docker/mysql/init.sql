-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : lun. 09 fév. 2026 à 14:13
-- Version du serveur : 8.0.45
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `url_git` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `url_git`, `creation_date`, `user_id`) VALUES
(1, 'Environnement du devloppeur', 'Ce projet détaille la configuration complète d’un environnement de développement moderne, incluant l’installation de l’éditeur, des outils de versioning, des serveurs locaux, et des extensions utiles pour améliorer la productivité. L’objectif est de permettre à un développeur de démarrer rapidement et efficacement.', 'https://github.com/user/dev-environnement', '2026-02-09 14:12:13', 1),
(2, 'HTML/CSS', 'Ce projet présente des exemples pratiques et des exercices pour maîtriser le HTML et le CSS. Il inclut la création de pages web responsives, la mise en forme avancée avec CSS, l’utilisation des flexbox et grid, ainsi que les bonnes pratiques pour structurer le contenu et styliser les éléments.', 'https://github.com/user/html-css', '2026-02-09 14:12:13', 1),
(3, 'PHP', 'Ce projet introduit la programmation côté serveur avec PHP. Il couvre la gestion des formulaires, les sessions, la manipulation des bases de données, la création de fonctions réutilisables et l’organisation du code pour développer des applications web dynamiques et sécurisées.', 'https://github.com/user/php-project', '2026-02-09 14:12:13', 1),
(4, 'MYSQL', 'Ce projet explore l’utilisation de MySQL pour la gestion des bases de données. Il inclut la création de tables, les relations entre les tables, l’écriture de requêtes SELECT, INSERT, UPDATE, DELETE, et l’optimisation des requêtes pour gérer efficacement les données dans des applications web.', 'https://github.com/user/mysql-project', '2026-02-09 14:12:13', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`) VALUES
(1, 'Camile');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;