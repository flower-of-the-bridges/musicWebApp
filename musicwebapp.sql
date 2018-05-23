-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2018 at 09:49 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
DROP DATABASE IF EXISTS musicwebapp;
CREATE DATABASE IF NOT EXISTS musicwebapp;
USE musicwebapp;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id_user` smallint(5) NOT NULL,
  `id_follower` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` smallint(5) NOT NULL,
  `size` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `img` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listener`
--

CREATE TABLE `listener` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mp3`
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
-- Table structure for table `musician`
--

CREATE TABLE `musician` (
  `id` smallint(5) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `musician`
--

INSERT INTO `musician` (`id`, `nickname`) VALUES
(22, 'Rush');

-- --------------------------------------------------------

--
-- Table structure for table `report`
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
-- Table structure for table `song`
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
-- Table structure for table `supporter`
--

CREATE TABLE `supporter` (
  `id_artist` smallint(5) NOT NULL,
  `id_supporter` smallint(5) NOT NULL,
  `expiration_date` date NOT NULL,
  `renewal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support_info`
--

CREATE TABLE `support_info` (
  `id_artist` smallint(5) NOT NULL,
  `contribute` varchar(10) NOT NULL,
  `period` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support_info`
--

INSERT INTO `support_info` (`id_artist`, `contribute`, `period`) VALUES
(22, '1 $', 365);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Table structure for table `user_info`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listener`
--
ALTER TABLE `listener`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp3`
--
ALTER TABLE `mp3`
  ADD PRIMARY KEY (`id_song`);

--
-- Indexes for table `musician`
--
ALTER TABLE `musician`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`id_artist`);

--
-- Indexes for table `supporter`
--
ALTER TABLE `supporter`
  ADD PRIMARY KEY (`id_artist`,`id_supporter`);

--
-- Indexes for table `support_info`
--
ALTER TABLE `support_info`
  ADD PRIMARY KEY (`id_artist`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
