-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 jan 2019 om 12:34
-- Serverversie: 10.1.36-MariaDB
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netnix`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `studentNumber` int(11) DEFAULT NULL,
  `userName` char(20) DEFAULT NULL,
  `firstName` char(30) DEFAULT NULL,
  `lastName` char(30) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `userPass` char(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `studentNumber`, `userName`, `firstName`, `lastName`, `email`, `userPass`, `admin`) VALUES
(1, 34567, 'thijsrijkers', 'Thijs', 'Rijkers', 'thijsrijkers@outlook.com', '$2y$10$IzhKHyNy2Uqx0IkxWh7T5eMN2j2cCc/bWCOentR9SpFtJ8p1TUizi', 0),
(2, 0, 'tim', 'tim', 'tim', 'tim@tim.tim', '$2y$10$k1zxW4BFtBLmUywTZA5hIOKgGeagDZoWqnv1xqpnQt5iaZ67ni4Pe', 0),
(3, 0, 'Admin', 'Admin', '', 'admin@netnix.com', '$2y$10$7XBu.w0CIWQoADwbjuns1OwYz8kGsQDuQApHOLtYa2Yydd1p1wamG', 1),
(4, 4545281, 'remyconen', 'R&eacute;my', 'Conen', 'remy.conen@hotmail.com', '$2y$10$HA/vCEvq/MBbzOQDX6LqMeiE1BCKNv.AWgu6S.CY.rIzJqmzyf5Qq', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
