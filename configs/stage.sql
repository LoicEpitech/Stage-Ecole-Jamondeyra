-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 28 juin 2024 à 09:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

DROP TABLE IF EXISTS `actualite`;
CREATE TABLE IF NOT EXISTS `actualite` (
  `idActualite` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dates` date DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `idUtilisateur` int NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  PRIMARY KEY (`idActualite`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `actualite`
--

INSERT INTO `actualite` (`idActualite`, `Titre`, `description`, `dates`, `image`, `idUtilisateur`, `privacy`) VALUES
(1, 'L\'école offre des beignets !', 'L\'ecole ofaozfozakfoazkofkozakofako fkoazfkoza kof foazf koazfokazopf kaz fkoa fkoazkof koafoazofk fazo', '2024-05-24', 'img_beignet.jpg', 0, 0),
(4, 'Les mercredis anglais', 'Communication en anglais pendant la journée découverte et apprentissage à travers le jeu, les activités manuelles, la culture, la musique, la compréhension orale...', '2024-06-25', 'IMG-20240624-WA0006.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `idDocument` int NOT NULL,
  `nomDocument` varchar(50) DEFAULT NULL,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`idDocument`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `mdp` varchar(500) NOT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `SuperAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `Nom`, `Prenom`, `mdp`, `Mail`, `login`, `isAdmin`, `SuperAdmin`) VALUES
(1, 'tannou', 'rewann', '1e009dc9a7c617b77d4d5b5181b7d20de4c7da30', 'rewann.tannou@gmail.com', 'r.tannou', 1, 0),
(2, 'Reevers', 'isbad', 'a16358be6e2306b153b1f071477e68837266075e', 'g@gmail.com', 'g.tannou', 0, 0),
(3, 'caca', 'pipi', '7afeeac0445ee96ea7b04c5365228ffe9aaa6683', 'j@gmail.com', 'j.tannou', 0, 1),
(4, 'caca', 'taata', '03913c546d4676e3bb1ac82bee7236e39be2eb2d', 'n@gmail.com', 'n.tannou', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
