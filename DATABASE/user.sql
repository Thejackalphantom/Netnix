-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 jan 2019 om 09:53
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.2.12

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
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `UserID` smallint(6) NOT NULL,
  `StudentID` varchar(200) DEFAULT NULL,
  `UserName` varchar(60) DEFAULT NULL,
  `FirstName` varchar(200) DEFAULT NULL,
  `LastName` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`UserID`, `StudentID`, `UserName`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(1, 'fdasadfadsf', 'dsafadsfads', 'fadsfadsf', 'fdsafdsaf', 'sdfafsadf', '$2y$10$Gamc/ZiwerRokhg2zLH.SuYLy8niZVQU8/8e5OFEUVwR91EWAQF/G'),
(2, 'fdasfasdf', 'thijsrijkers', 'Thijs', 'Rijkers', 'thijsrijkers@outlook.com', '$2y$10$wAhmPAGMySu26dSPaW4P1eaWkNCyNStCyk68c1Mx7bpRxSX7/HTF2'),
(3, '', 'root', '', '', '', '$2y$10$FK4BOCw.gkhGWMfhU9HPNe7.2.1.Q6b80t1B6Bawm0PXu7e2ZRh3S');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `UserID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
