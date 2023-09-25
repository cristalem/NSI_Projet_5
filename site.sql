-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 mai 2023 à 16:19
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
(1, 'garage Monier', 'Bignay', 'garage', '7 Chemin Bleu', 17400, '0215487569');

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
(1, '14 15 16 17 18', '10 11 12 14 15 16 17 18', '10 11 12 14 15 16 17 18', '14 15 16 17 18', '10 11 12 14 15 16 17 18', '10 11 12 14 15 16', NULL),
(38, '9 10 11 14 15 16 17 18', '7 8 9 14 15 16 17 18', '7 8 9 14 15 16 17 18', '9 10 11 14 15 16 17 18', '7 8 9 14 15 16 17 18', '7 8 9 14 15 16 17 18', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membre_client`
--

CREATE TABLE `membre_client` (
  `id` int(11) NOT NULL,
  `nom` varchar(21) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mdp` varchar(21) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre_client`
--

INSERT INTO `membre_client` (`id`, `nom`, `prenom`, `email`, `mdp`, `type`) VALUES
(27, 'David', 'Felix', 'davidfelix@yopmail.com', '3l4q57ly', 'client');

-- --------------------------------------------------------

--
-- Structure de la table `membre_pro`
--

CREATE TABLE `membre_pro` (
  `id` int(11) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mdp` varchar(80) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'pro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre_pro`
--

INSERT INTO `membre_pro` (`id`, `prenom`, `nom`, `email`, `mdp`, `type`) VALUES
(1, 'Fernande', 'Monier', 'garage.Monier@gmail.com', 'q3fuctsk', 'pro');

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
(31, 27, 'excellent très serviable et rapide je recommande', '2023-05-26 14:31:55', '1');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_client` int(60) NOT NULL,
  `id_service` int(60) NOT NULL,
  `date` date NOT NULL,
  `heure` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `id_client`, `id_service`, `date`, `heure`) VALUES
(7, 27, 1, '2023-05-30', '12');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `categorie` varchar(21) NOT NULL,
  `prix` int(11) NOT NULL,
  `entreprise` varchar(60) NOT NULL,
  `note5` int(1) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `description` varchar(12000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id`, `name`, `categorie`, `prix`, `entreprise`, `note5`, `image`, `description`) VALUES
(1, 'vidange', 'garage', 60, 'garage Monier', NULL, NULL, 'Vidange pour voiture.\n\nCette opération d\'entretien, qui consiste à changer l\'huile du moteur, le filtre à huile et le joint du bouchon de vidange, doit être réalisée tous les 10 000 à 15 000 kilomètres.\n\nAvec le garage Monier garantissez le fonctionnement de vos voitures, motos et utilitaires !'),
(38, 'controle technique', 'garage', 78, 'garage Monier', 0, NULL, 'controle technique');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClient` (`id_client`),
  ADD KEY `idService` (`id_service`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `membre_pro`
--
ALTER TABLE `membre_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `postsujet`
--
ALTER TABLE `postsujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `Sujet` FOREIGN KEY (`id_service`) REFERENCES `sujet` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `idClient` FOREIGN KEY (`id_client`) REFERENCES `membre_client` (`id`),
  ADD CONSTRAINT `idService` FOREIGN KEY (`id_service`) REFERENCES `sujet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
