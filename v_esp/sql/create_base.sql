SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `v_esp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `v_esp` ;

-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Version du serveur: 5.5.27
-- Version de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de donnees: `v_esp`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(15) DEFAULT NULL,
  `rue` varchar(45) DEFAULT NULL,
  `longitude` int(11) DEFAULT NULL,
  `lattitude` int(11) DEFAULT NULL,
  `Ville_idVille` int(11) NOT NULL,
  PRIMARY KEY (`idAdresse`,`Ville_idVille`),
  KEY `fk_Adresse_Ville1_idx` (`Ville_idVille`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `numero`, `rue`, `longitude`, `lattitude`, `Ville_idVille`) VALUES
(1, '115', 'chemin de la halle', NULL, NULL, 1),
(2, '32', 'Marchal', NULL, NULL, 2),
(3, '20', 'Robert Fiat', NULL, NULL, 3),
(4, '3', 'Rue Agutte Sembat', NULL, NULL, 4),
(5, '5', 'Rue Ambroise Croizat', NULL, NULL, 4),
(6, '40', 'Victor Hugo', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE IF NOT EXISTS `animaux` (
  `idAnimal` int(11) NOT NULL AUTO_INCREMENT,
  `prenomAnimal` varchar(45) DEFAULT NULL,
  `dateNaissanceAnimal` date DEFAULT NULL,
  `Personne_idPersonne` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAnimal`,`Personne_idPersonne`),
  KEY `fk_Animaux_Personne1_idx` (`Personne_idPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `animaux`
--

INSERT INTO `animaux` (`idAnimal`, `prenomAnimal`, `dateNaissanceAnimal`, `Personne_idPersonne`, `type`) VALUES
(1, 'Willy', '2010-03-01', 1, 'Chien'),
(2, 'Danny', '1999-07-12', 4, 'Chat');

-- --------------------------------------------------------

--
-- Structure de la table `clinique`
--

CREATE TABLE IF NOT EXISTS `clinique` (
  `idClinique` int(11) NOT NULL AUTO_INCREMENT,
  `nomClinique` varchar(45) DEFAULT NULL,
  `proprietaireClinique` varchar(45) DEFAULT NULL,
  `telClinique` varchar(15) DEFAULT NULL,
  `mailClinique` varchar(45) DEFAULT NULL,
  `Adresse_idAdresse` int(11) NOT NULL,
  PRIMARY KEY (`idClinique`,`Adresse_idAdresse`),
  KEY `fk_Clinique_Adresse1_idx` (`Adresse_idAdresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `clinique`
--

INSERT INTO `clinique` (`idClinique`, `nomClinique`, `proprietaireClinique`, `telClinique`, `mailClinique`, `Adresse_idAdresse`) VALUES
(1, 'Clinique Veterinaire Bourg', 'Imbert Natalie', '0412522133', 'Clinique.veterinaire.Bourg@orange.fr', 2),
(2, 'Clinique Veterinaire Chambery', 'Doumain Antoine', '0425369874', 'Clinique.veterinaire.chambery@free.fr', 4);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `idDepartement` int(11) NOT NULL AUTO_INCREMENT,
  `nomDepartement` varchar(45) DEFAULT NULL,
  `codeDepartement` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDepartement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`idDepartement`, `nomDepartement`, `codeDepartement`) VALUES
(1, 'JURA', '39'),
(2, 'AIN', '01'),
(3, 'ISERE', '38'),
(4, 'SAVOIE', '73'),
(5, 'RHONE', '69');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE IF NOT EXISTS `examen` (
  `Clinique_idClinique` int(11) NOT NULL,
  `Animaux_idAnimal` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `heure` varchar(15) DEFAULT NULL,
  `Personne_idPersonne` int(11) NOT NULL,
  PRIMARY KEY (`Clinique_idClinique`,`Animaux_idAnimal`,`Personne_idPersonne`),
  KEY `fk_Examinen_Animaux1_idx` (`Animaux_idAnimal`),
  KEY `fk_Examinen_Personne1_idx` (`Personne_idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `examen`
--

INSERT INTO `examen` (`Clinique_idClinique`, `Animaux_idAnimal`, `date`, `heure`, `Personne_idPersonne`) VALUES
(1, 1, '2013-04-25', '16h35', 2),
(2, 2, '2013-04-27', '8h30', 4);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nomPersonne` varchar(45) DEFAULT NULL,
  `prenomPersonne` varchar(45) DEFAULT NULL,
  `dateNaissancePersonne` date DEFAULT NULL,
  `telFixePersonne` varchar(15) DEFAULT NULL,
  `telMobilePersonne` varchar(15) DEFAULT NULL,
  `mailPersonne` varchar(45) DEFAULT NULL,
  `TypePersonne` varchar(45) DEFAULT NULL,
  `Adresse_idAdresse` int(11) NOT NULL,
  `pwd` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idPersonne`,`Adresse_idAdresse`),
  KEY `fk_Personne_Adresse1_idx` (`Adresse_idAdresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `nomPersonne`, `prenomPersonne`, `dateNaissancePersonne`, `telFixePersonne`, `telMobilePersonne`, `mailPersonne`, `TypePersonne`, `Adresse_idAdresse`, `pwd`) VALUES
(1, 'Sarrazin', 'Sophie', '1992-11-05', '0478569321', '06478595', 'Sarrazin.Sophie@orange.fr', 'Proprietaire', 1, 'soso39'),
(2, 'Fagnot', 'Valentin', '1983-04-15', '0424859678', '0645872232', 'Valentin.Fagnot@free.fr', 'Veterinaire', 3, 'veto38aa'),
(3, 'Doumain', 'Antoine', '1982-11-13', '0412522277', '0674585598', 'doumain.antoine@free.fr', 'Veterinaire', 5, 'doum58'),
(4, 'Marc', 'Antoine', '1990-07-11', '0435863589', '0678855512', 'marc.antoine@orange.fr', 'Propreitaire', 6, 'marc75sf');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `idVille` int(11) NOT NULL AUTO_INCREMENT,
  `nomVille` varchar(45) DEFAULT NULL,
  `codePostal` varchar(45) DEFAULT NULL,
  `Departement_idDepartement` int(11) NOT NULL,
  PRIMARY KEY (`idVille`,`Departement_idDepartement`),
  KEY `fk_Ville_Departement_idx` (`Departement_idDepartement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`idVille`, `nomVille`, `codePostal`, `Departement_idDepartement`) VALUES
(1, 'Premanon', '39220', 1),
(2, 'Bourg-en-Bresse', '01000', 2),
(3, 'Saint Egreve', '38120', 3),
(4, 'Chambery', '37000', 4),
(5, 'Lyon', '69001', 5);

--
-- Contraintes pour les tables exportees
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `fk_Adresse_Ville1` FOREIGN KEY (`Ville_idVille`) REFERENCES `ville` (`idVille`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD CONSTRAINT `fk_Animaux_Personne1` FOREIGN KEY (`Personne_idPersonne`) REFERENCES `personne` (`idPersonne`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `clinique`
--
ALTER TABLE `clinique`
  ADD CONSTRAINT `fk_Clinique_Adresse1` FOREIGN KEY (`Adresse_idAdresse`) REFERENCES `adresse` (`idAdresse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `fk_Examinen_Animaux1` FOREIGN KEY (`Animaux_idAnimal`) REFERENCES `animaux` (`idAnimal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Examinen_Clinique1` FOREIGN KEY (`Clinique_idClinique`) REFERENCES `clinique` (`idClinique`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Examinen_Personne1` FOREIGN KEY (`Personne_idPersonne`) REFERENCES `personne` (`idPersonne`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `fk_Personne_Adresse1` FOREIGN KEY (`Adresse_idAdresse`) REFERENCES `adresse` (`idAdresse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `fk_Ville_Departement` FOREIGN KEY (`Departement_idDepartement`) REFERENCES `departement` (`idDepartement`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
