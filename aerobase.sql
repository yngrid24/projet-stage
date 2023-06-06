-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 30 Avril 2020 à 05:48
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `aerobase`
--

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE IF NOT EXISTS `passager` (
  `numpiece` varchar(30) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(15) NOT NULL,
  `choix_class` varchar(20) NOT NULL,
  `code_vol` varchar(20) NOT NULL,
  PRIMARY KEY (`numpiece`),
  KEY `fk1` (`code_vol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `passager`
--

INSERT INTO `passager` (`numpiece`, `nom`, `prenom`, `sexe`, `choix_class`, `code_vol`) VALUES
('A009', 'XAVIER', 'DURAND', 'MASCULIN', 'classe A', 'v6'),
('A132', 'DAVID', 'VINCENT', 'MASCULIN', 'classe A', 'v4'),
('A458', 'DENISE', 'BOUTLOU', 'FEMININ', 'classe B', 'v4'),
('A890', 'RETAL', 'GREGIN', 'MASCULIN', 'classe B', 'v4'),
('B567', 'HAROUN', 'HISSEIN', 'MASCULIN', 'classe A', 'v1'),
('C155', 'THEODORE', 'SEVERIN', 'MASCULIN', 'classe A', 'v7'),
('C456', 'ALICE', 'MC WIN', 'FEMININ', 'classe B', 'v4'),
('D211', 'ERNEST', 'ABRAHAM', 'MASCULIN', 'classe B', 'v6'),
('D212', 'LOUIS', 'SAMUEL', 'MASCULIN', 'classe A', 'v6'),
('D441', 'FILMORD', 'HENRI', 'MASCULIN', 'classe B', 'v6'),
('D450', 'DAVID', 'ALEX', 'MASCULIN', 'classe B', 'v4'),
('D456', 'NICOLAS', 'RILEU', 'MASCULIN', 'classe B', 'v4'),
('E221', 'DENISE', 'ANNE', 'FEMININ', 'classe A', 'v7'),
('E344', 'JULIEN', 'JACOB', 'MASCULIN', 'classe A', 'v7'),
('F789', 'REGINE', 'DIAMEN', 'FEMININ', 'classe B', 'v4'),
('S321', 'DAISY', 'DIVINE', 'FEMININ', 'classe A', 'v5'),
('T449', 'CARLE', 'ANDRE', 'MASCULIN', 'classe B', 'v7'),
('T690', 'BLANDINE', 'TENESSEE', 'FEMININ', 'classe A', 'v6'),
('U789', 'TARTAR', 'DIURN', 'MASCULIN', 'classe B', 'v4'),
('V545', 'ALAIN', 'FRANCIS', 'MASCULIN', 'classe A', 'v6');

-- --------------------------------------------------------

--
-- Structure de la table `secret`
--

CREATE TABLE IF NOT EXISTS `secret` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `secret`
--

INSERT INTO `secret` (`id`, `login`, `password`) VALUES
(1, 'chcode', 'chrislink');

-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE IF NOT EXISTS `vol` (
  `codevol` varchar(20) NOT NULL,
  `date_depart` varchar(20) NOT NULL,
  `heure_depart` varchar(20) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `nb_classa` smallint(6) NOT NULL,
  `nb_classb` smallint(6) NOT NULL,
  `prix_classa` int(11) NOT NULL,
  `prix_classb` int(11) NOT NULL,
  PRIMARY KEY (`codevol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `vol`
--

INSERT INTO `vol` (`codevol`, `date_depart`, `heure_depart`, `destination`, `nb_classa`, `nb_classb`, `prix_classa`, `prix_classb`) VALUES
('v1', '2020-04-27', '22:30', 'Legos', 90, 130, 125000, 95000),
('v2', '2020-04-28', '23:45', 'Paris', 75, 120, 1235000, 955000),
('v3', '2020-04-28', '03:30', 'Khartoum', 60, 90, 75000, 56000),
('v4', '2020-05-01', '03:30', 'Abidjan', 8, 12, 78000, 45000),
('v5', '2020-05-02', '04:30', 'Tokyo', 60, 150, 1675000, 1225000),
('v6', '2020-07-31', '04:30', 'Dakar', 90, 130, 275000, 195000),
('v7', '2021-03-01', '23:45', 'Lyon', 50, 90, 897000, 655000);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `passager`
--
ALTER TABLE `passager`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`code_vol`) REFERENCES `vol` (`codevol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
