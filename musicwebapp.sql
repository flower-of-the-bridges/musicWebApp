-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 07, 2018 alle 12:21
-- Versione del server: 10.1.30-MariaDB
-- Versione PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicwebapp`
--
DROP DATABASE IF EXISTS `musicwebapp`;
CREATE DATABASE IF NOT EXISTS `musicwebapp` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `musicwebapp`;
-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50),
  `mail` varchar(50), -- NOT NULL,
  `password` varchar(24), -- NOT NULL,
-- tipologia dell'utente. puo' essere:
-- 0 - guest
-- 1 - listener
-- 2 - musician
-- 3 - moderator
-- gli utenti guest non hanno ovviamente entry nel db
  `type` set ('0','1','2','3') NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`),
   UNIQUE KEY `nickname_unique` (`nickname`),
   UNIQUE KEY `mail_unique` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabella root per tutti gli utenti';

--
-- Struttura della tabella `ascoltatore`
--

CREATE TABLE `listener` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `moderator`
--

CREATE TABLE `moderator` (
  `id` smallint(5) NOT NULL,
  `solved` int(11) NOT NULL DEFAULT '0', -- report risolti (Calcolabili come count da report)?
  `active` int(11) NOT NULL DEFAULT '0', -- report attivi (Calcolabili come count da report)?
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `musician`
--

CREATE TABLE `musician` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `views` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura per la tabella `song`
--

CREATE TABLE `song` (
  `id_song` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_artist` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `genre` varchar(40) NOT NULL,
  `mp3` blob NOT NULL, -- file mp3 salvato come byte
  `listens` smallint(5) UNSIGNED DEFAULT 0, -- numero di ascolti
-- campi booleani che denotano la visibilita' del brano
  `forall` tinyint(1) DEFAULT '0',
  `registered` tinyint(1) DEFAULT '1',
  `supporters` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_song`),
  UNIQUE KEY `name` (`name`,`id_artist`) -- un artista non ha piu canzoni con nomi simili

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struttura della tabella `report`
--

CREATE TABLE `report` (
  `id_report` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_moderator` smallint(5) , -- id moderatore che ha in carico il report
  `title` varchar(30) NOT NULL, -- titolo del report
  `description` varchar(65000) NOT NULL DEFAULT '""', -- descrizione del report
  `id_user` int(11) NOT NULL, -- id dell'utente che ha segnalato il contenuto  
  `state` set('0','1','2') NOT NULL DEFAULT '0', -- stati della segnalazione
   PRIMARY KEY (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
