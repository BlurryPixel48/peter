-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 23 maj 2025 kl 10:27
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `bdl`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `rk`
--

CREATE TABLE `rk` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userlevel` int(11) NOT NULL DEFAULT 100,
  `remember_me` tinyint(1) DEFAULT NULL,
  `titel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `rk`
--

INSERT INTO `rk` (`id`, `email`, `password`, `userlevel`, `remember_me`, `titel`) VALUES
(19, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 100, NULL, NULL),
(20, 'test@gmail.com', '05b972dcf28374406d13e879724bfe3b', 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `ärenden`
--

CREATE TABLE `ärenden` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `beskrivning` text DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `prioritet` varchar(50) DEFAULT NULL,
  `skapad_av` varchar(255) DEFAULT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `ärenden`
--

INSERT INTO `ärenden` (`id`, `titel`, `beskrivning`, `kategori`, `status`, `prioritet`, `skapad_av`, `datum`) VALUES
(6, 'hjälp', 'hjälp', 'Buggrapport', NULL, 'Medium', 'test@gmail.com', '2025-04-28 11:53:39');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `rk`
--
ALTER TABLE `rk`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `ärenden`
--
ALTER TABLE `ärenden`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `rk`
--
ALTER TABLE `rk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT för tabell `ärenden`
--
ALTER TABLE `ärenden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
