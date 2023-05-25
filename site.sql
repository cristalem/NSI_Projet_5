-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 mai 2023 à 22:10
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `nom` varchar(30) NOT NULL,
  `entreprise` varchar(30) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'garage'),
(2, 'coiffeur'),
(3, 'estheticienne'),
(4, 'dentiste'),
(5, 'reparation informatique');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `entreprise` varchar(30) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `categorie` varchar(11) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `code_postal` int(6) NOT NULL,
  `tel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `entreprise`, `ville`, `categorie`, `adresse`, `code_postal`, `tel`) VALUES
(1, 'pipi', 'pii', 'garage', '25 rue du pipi', 25148, '0215487569'),
(2, 'caca', 'caaa', 'coiffeur', '25 rue du caca', 24584, '0215487569'),
(3, 'miam', 'Batilly-en-Gâtinais', 'garage', '25 rue jules cesar', 45340, '0673440476'),
(4, 'miam', 'zizi', 'garage', '25 rue du zizi', 45406, '0514258935');

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id_service` int(11) NOT NULL,
  `lundi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `mardi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `mercredi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `jeudi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `vendredi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `samedi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `dimanche` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id_service`, `lundi`, `mardi`, `mercredi`, `jeudi`, `vendredi`, `samedi`, `dimanche`) VALUES
(22, '1 2 4 5 6 7 12', '1 2 4 5 6 7 12', '1 2 4 5 6 7 12', '1 2 4 5 6 7 12', '1 2 4 5 6 7 12', '1 2 4 5 6 7 12', NULL),
(37, '3 4', '4', '5 6 7', '3 4', NULL, '14', '12 13 14');

-- --------------------------------------------------------

--
-- Structure de la table `membre_client`
--

CREATE TABLE `membre_client` (
  `id` int(11) NOT NULL,
  `nom` varchar(21) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mdp` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre_client`
--

INSERT INTO `membre_client` (`id`, `nom`, `prenom`, `email`, `mdp`) VALUES
(25, 'cristal', '', 'cristal@gmail.com', 'lepipi');

-- --------------------------------------------------------

--
-- Structure de la table `membre_pro`
--

CREATE TABLE `membre_pro` (
  `id` int(11) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mdp` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre_pro`
--

INSERT INTO `membre_pro` (`id`, `prenom`, `nom`, `email`, `mdp`) VALUES
(1, 'premier', 'pipi', 'elsa.mazzet@gmail.com', 'elsalecaca'),
(3, 'jules', 'cesar', 'elsa.mat@gmail.com', 'kekekeke'),
(25, 'elsa', 'mazzetti', 'nrty@fghfh.sdf', 'mememememe');

-- --------------------------------------------------------

--
-- Structure de la table `postsujet`
--

CREATE TABLE `postsujet` (
  `id` int(11) NOT NULL,
  `propri` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
  `sujet` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `postsujet`
--

INSERT INTO `postsujet` (`id`, `propri`, `contenu`, `date`, `sujet`) VALUES
(20, 25, 'le pippi', '2023-05-14 17:08:39', '20'),
(21, 25, 'le pippi', '2023-05-14 17:09:11', '20'),
(22, 25, 'le pippi', '2023-05-14 17:09:21', '20'),
(23, 25, 'nyon', '2023-05-14 17:09:36', '20'),
(24, 25, 'nyon', '2023-05-14 17:09:44', '20'),
(25, 25, 'hehehehehehe', '2023-05-14 17:11:01', '20'),
(26, 25, 'hehehehehehe', '2023-05-14 17:11:11', '20'),
(27, 25, 'hehehehehehe', '2023-05-14 17:11:18', '20'),
(28, 25, 'pipi\r\n', '2023-05-14 17:16:21', '20'),
(29, 25, 'pipi\r\n', '2023-05-14 17:16:26', '20'),
(30, 25, 'prout', '2023-05-22 21:16:29', '22');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_client` int(60) NOT NULL,
  `horaire` datetime NOT NULL,
  `id_service` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `categorie` varchar(21) NOT NULL,
  `prix` int(11) NOT NULL,
  `entreprise` varchar(11) NOT NULL,
  `note5` int(1) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id`, `name`, `categorie`, `prix`, `entreprise`, `note5`, `image`, `description`) VALUES
(20, 'jeux1', 'coiffeur', 0, '', 0, '', ''),
(21, 'shtdf', 'garage', 18, 'drgd', 0, NULL, 'dgrg'),
(22, 'jeux', 'garage', 18, 'miam', 0, NULL, 'tfh'),
(23, 'pipi', 'estheticienne', 150, 'miam', 0, NULL, 'le pipi c&#039;est delicieux'),
(24, 'caca', 'estheticienne', 18, 'miam', 0, NULL, 'pipi'),
(25, 'caca', 'estheticienne', 18, 'miam', 0, NULL, 'pipi'),
(26, 'caca', 'estheticienne', 18, 'miam', 0, NULL, 'pipi'),
(27, 'pipi', 'garage', 11111111, 'miam', 0, NULL, 'fgbaerwe '),
(28, 'ewqf', 'coiffeur', 3232, '1', 0, NULL, '213'),
(29, 'e', 'garage', 1, 'w', 0, NULL, 'w'),
(30, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(31, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(32, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(33, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(34, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(35, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(36, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1'),
(37, 'pipi', 'coiffeur', 1, 'miam', 0, NULL, '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entreprise` (`entreprise`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id_service`);

--
-- Index pour la table `membre_client`
--
ALTER TABLE `membre_client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `membre_pro`
--
ALTER TABLE `membre_pro`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `postsujet`
--
ALTER TABLE `postsujet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `membre_client`
--
ALTER TABLE `membre_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `membre_pro`
--
ALTER TABLE `membre_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `postsujet`
--
ALTER TABLE `postsujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `Sujet` FOREIGN KEY (`id_service`) REFERENCES `sujet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
