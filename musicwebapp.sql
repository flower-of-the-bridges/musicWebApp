-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2018 alle 09:30
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

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `id` smallint(5) NOT NULL,
  `size` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `img` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `listener`
--

CREATE TABLE `listener` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `moderator`
--

CREATE TABLE `moderator` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `mp3`
--

CREATE TABLE `mp3` (
  `id_song` smallint(5) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `size` varchar(25) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL DEFAULT '',
  `mp3` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `musician`
--

CREATE TABLE `musician` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `musician`
--

INSERT INTO `musician` (`id`, `nickname`) VALUES
(22, 'Rush');

-- --------------------------------------------------------

--
-- Struttura della tabella `report`
--

CREATE TABLE `report` (
  `id` smallint(5) NOT NULL,
  `id_moderatore` smallint(5) DEFAULT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(63000) NOT NULL DEFAULT '"no decription needed"',
  `id_segnalatore` smallint(5) NOT NULL,
  `id_object` smallint(5) NOT NULL,
  `object_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `song`
--

CREATE TABLE `song` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_artist` smallint(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `genre` varchar(40) NOT NULL,
  `forall` tinyint(1) DEFAULT '0',
  `registered` tinyint(1) DEFAULT '1',
  `supporters` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `supporter`
--

CREATE TABLE `supporter` (
  `id_artist` smallint(5) NOT NULL,
  `id_supporter` smallint(5) NOT NULL,
  `expiration_date` date NOT NULL,
  `renewal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `support_info`
--

CREATE TABLE `support_info` (
  `id_artist` smallint(5) NOT NULL,
  `contribute` varchar(10) NOT NULL,
  `period` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `support_info`
--

INSERT INTO `support_info` (`id_artist`, `contribute`, `period`) VALUES
(22, '1 $', 365);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `type` set('guest','user','music','mod') NOT NULL DEFAULT 'guest',
  `mail` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_info`
--

CREATE TABLE `user_info` (
  `id` smallint(5) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `birth_place` varchar(30) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `bio` char(255) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `listener`
--
ALTER TABLE `listener`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `mp3`
--
ALTER TABLE `mp3`
  ADD PRIMARY KEY (`id_song`);

--
-- Indici per le tabelle `musician`
--
ALTER TABLE `musician`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`id_artist`);

--
-- Indici per le tabelle `supporter`
--
ALTER TABLE `supporter`
  ADD PRIMARY KEY (`id_artist`,`id_supporter`);

--
-- Indici per le tabelle `support_info`
--
ALTER TABLE `support_info`
  ADD PRIMARY KEY (`id_artist`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indici per le tabelle `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `report`
--
ALTER TABLE `report`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `song`
--
ALTER TABLE `song`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
