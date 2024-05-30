-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 30 mai 2024 à 13:25
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Medicare`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administrateurs`
--

CREATE TABLE `Administrateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `code_postal` varchar(10) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `carte_vitale` int(20) DEFAULT NULL,
  `type_carte_paiement` varchar(50) DEFAULT NULL,
  `numero_carte` int(20) DEFAULT NULL,
  `nom_carte` varchar(50) DEFAULT NULL,
  `date_expiration_carte` date DEFAULT NULL,
  `code_securite_carte` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Disponibilites`
--

CREATE TABLE `Disponibilites` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `jour` int(7) DEFAULT NULL,
  `matin` tinyint(1) DEFAULT '1',
  `apres_midi` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Messages`
--

CREATE TABLE `Messages` (
  `id_message` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Personnels_Sante`
--

CREATE TABLE `Personnels_Sante` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `specialite` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `cv` varchar(256) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `est_disponible` tinyint(1) DEFAULT '0',
  `administrateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Rendez_vous`
--

CREATE TABLE `Rendez_vous` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `personnel_id` int(11) DEFAULT NULL,
  `jour` int(7) DEFAULT NULL,
  `heure` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Rendez_vous_Laboratoire`
--

CREATE TABLE `Rendez_vous_Laboratoire` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `date_heure` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Services_Laboratoire`
--

CREATE TABLE `Services_Laboratoire` (
  `id` int(11) NOT NULL,
  `nom_service` varchar(100) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Administrateurs`
--
ALTER TABLE `Administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Disponibilites`
--
ALTER TABLE `Disponibilites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personnel_id` (`personnel_id`);

--
-- Index pour la table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `personnel_id` (`personnel_id`);

--
-- Index pour la table `Personnels_Sante`
--
ALTER TABLE `Personnels_Sante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Rendez_vous_Administrateur0_FK` (`administrateur_id`);

--
-- Index pour la table `Rendez_vous`
--
ALTER TABLE `Rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `personnel_id` (`personnel_id`);

--
-- Index pour la table `Rendez_vous_Laboratoire`
--
ALTER TABLE `Rendez_vous_Laboratoire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Index pour la table `Services_Laboratoire`
--
ALTER TABLE `Services_Laboratoire`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Administrateurs`
--
ALTER TABLE `Administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Disponibilites`
--
ALTER TABLE `Disponibilites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Personnels_Sante`
--
ALTER TABLE `Personnels_Sante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Rendez_vous`
--
ALTER TABLE `Rendez_vous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Rendez_vous_Laboratoire`
--
ALTER TABLE `Rendez_vous_Laboratoire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Services_Laboratoire`
--
ALTER TABLE `Services_Laboratoire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Disponibilites`
--
ALTER TABLE `Disponibilites`
  ADD CONSTRAINT `disponibilites_ibfk_1` FOREIGN KEY (`personnel_id`) REFERENCES `Personnels_Sante` (`id`);

--
-- Contraintes pour la table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Rendez_vous_Clients0_FK` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`),
  ADD CONSTRAINT `Rendez_vous_Personnels0_FK` FOREIGN KEY (`personnel_id`) REFERENCES `Personnels_Sante` (`id`);

--
-- Contraintes pour la table `Personnels_Sante`
--
ALTER TABLE `Personnels_Sante`
  ADD CONSTRAINT `Rendez_vous_Administrateur0_FK` FOREIGN KEY (`administrateur_id`) REFERENCES `Administrateurs` (`id`);

--
-- Contraintes pour la table `Rendez_vous`
--
ALTER TABLE `Rendez_vous`
  ADD CONSTRAINT `rendez_vous_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`),
  ADD CONSTRAINT `rendez_vous_ibfk_2` FOREIGN KEY (`personnel_id`) REFERENCES `Personnels_Sante` (`id`);

--
-- Contraintes pour la table `Rendez_vous_Laboratoire`
--
ALTER TABLE `Rendez_vous_Laboratoire`
  ADD CONSTRAINT `rendez_vous_laboratoire_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`),
  ADD CONSTRAINT `rendez_vous_laboratoire_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `Services_Laboratoire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
