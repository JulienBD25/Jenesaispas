-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 27 mai 2024 à 13:58
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `medicare`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `Carte_Vitale` int(11) NOT NULL,
  `Nom_Prenom` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Mot_De_Passe` varchar(256) NOT NULL,
  `Adresse` varchar(256) NOT NULL,
  `Ville` varchar(256) NOT NULL,
  `Pays` varchar(256) NOT NULL,
  `Code_Postal` int(11) NOT NULL,
  `Telephone` int(11) NOT NULL,
  `Type_CB` varchar(256) NOT NULL,
  `Numero_CB` int(11) NOT NULL,
  `Date_Expiration_CB` int(11) NOT NULL,
  `Code_Securite_CB` int(11) NOT NULL,
  `Rendez-Vous` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `Nom_Prenom` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `ID_Medecin` int(11) NOT NULL,
  `CV` varchar(256) NOT NULL,
  `Photo` varchar(256) NOT NULL,
  `Specialite` varchar(256) NOT NULL,
  `Disponibilite_Semaine` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`Carte_Vitale`);

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`ID_Medecin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
