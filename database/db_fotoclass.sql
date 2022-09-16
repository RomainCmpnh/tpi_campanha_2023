-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 15 sep. 2022 à 18:04
-- Version du serveur : 10.3.34-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_fotoclass`
--
CREATE DATABASE IF NOT EXISTS `db_fotoclass` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_fotoclass`;

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--
-- Création : jeu. 15 sep. 2022 à 15:54
--

DROP TABLE IF EXISTS `lieux`;
CREATE TABLE IF NOT EXISTS `lieux` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(125) NOT NULL,
  `pays` enum('SUISSE','FRANCE') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `motsclefs`
--
-- Création : jeu. 15 sep. 2022 à 15:57
--

DROP TABLE IF EXISTS `motsclefs`;
CREATE TABLE IF NOT EXISTS `motsclefs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--
-- Création : jeu. 15 sep. 2022 à 16:02
--

DROP TABLE IF EXISTS `productions`;
CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` mediumint(9) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `lieux_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IND_utilisateurs_id` (`utilisateurs_id`) USING BTREE,
  KEY `IND_lieux_id` (`lieux_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `productions_has_motsclefs`
--
-- Création : jeu. 15 sep. 2022 à 16:03
--

DROP TABLE IF EXISTS `productions_has_motsclefs`;
CREATE TABLE IF NOT EXISTS `productions_has_motsclefs` (
  `productions_id` int(11) NOT NULL,
  `motsclefs_id` smallint(6) NOT NULL,
  PRIMARY KEY (`productions_id`,`motsclefs_id`),
  KEY `IND_productions_id` (`productions_id`),
  KEY `IND_motsclefs_id` (`motsclefs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--
-- Création : jeu. 15 sep. 2022 à 15:52
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `login` varchar(125) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `productions_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productions_ibfk_2` FOREIGN KEY (`lieux_id`) REFERENCES `lieux` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `productions_has_motsclefs`
--
ALTER TABLE `productions_has_motsclefs`
  ADD CONSTRAINT `productions_has_motsclefs_ibfk_1` FOREIGN KEY (`productions_id`) REFERENCES `productions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productions_has_motsclefs_ibfk_2` FOREIGN KEY (`motsclefs_id`) REFERENCES `motsclefs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
