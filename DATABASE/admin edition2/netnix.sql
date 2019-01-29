-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 jan 2019 om 11:41
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.3.0

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
-- Tabelstructuur voor tabel `favorite`
--

CREATE TABLE `favorite` (
  `userID` int(11) NOT NULL,
  `videoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `favorite`
--

INSERT INTO `favorite` (`userID`, `videoID`) VALUES
(5, 6),
(5, 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likedvideos`
--

CREATE TABLE `likedvideos` (
  `videoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `liked` varchar(1) DEFAULT 'n',
  `disliked` varchar(1) DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `likedvideos`
--

INSERT INTO `likedvideos` (`videoID`, `userID`, `liked`, `disliked`) VALUES
(4, 5, 'y', 'n'),
(5, 5, 'n', 'y');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rating`
--

CREATE TABLE `rating` (
  `videoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `studentNumber`, `userName`, `firstName`, `lastName`, `email`, `userPass`, `admin`) VALUES
(1, 34567, 'thijsrijkers', 'Thijs', 'Rijkers', 'thijsrijkers@outlook.com', '$2y$10$IzhKHyNy2Uqx0IkxWh7T5eMN2j2cCc/bWCOentR9SpFtJ8p1TUizi', 0),
(2, 0, 'tim', 'tim', 'tim', 'tim@tim.tim', '$2y$10$k1zxW4BFtBLmUywTZA5hIOKgGeagDZoWqnv1xqpnQt5iaZ67ni4Pe', 0),
(3, 43758, 'root', 'IkBenRoot', 'ButNotGroot', 'groot@isroot.com', '$2y$10$wRIKohL8nSmA7mtks10VeuCj9Mt8cCqAc6/aDusRZFp3MbXu8mBj.', 0),
(4, 0, 'admin', 'admin', 'admin', 'admin@admin.admin', '$2y$10$GXmHfS19qEAUSBQulMQ4ROVPKO1wta9LvqVZKAXXExHrk7k1BBzd6', 1),
(5, 4567730, 'JannesDeKip', 'Kevin', 'Trip', 'kevin.trip@hotmail.com', '$2y$10$.0jgc31JBwa24rVL9yYVwOk02dPZcsUq1xdNtK5ejgIgoO71tjLmK', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videos`
--

CREATE TABLE `videos` (
  `videoID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `videoTitle` char(50) DEFAULT NULL,
  `videoDescription` varchar(500) DEFAULT NULL,
  `videoUploadPath` char(255) DEFAULT NULL,
  `categorie` varchar(60) NOT NULL,
  `aprove` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `videos`
--

INSERT INTO `videos` (`videoID`, `userID`, `videoTitle`, `videoDescription`, `videoUploadPath`, `categorie`, `aprove`) VALUES
(1, 1, 'fdafdas', 'fdafdsaf', 'uploads/1 sec VIDEO.mp4', 'wiskunde', 1),
(4, 1, 'hallo allemaal', 'wat fijn dat je er bent', 'uploads/wakanda.mp4', 'nederlands', 1),
(5, 3, 'Hello there', 'adsf', 'uploads/Obi-Wan - Hello there.mp4', 'wiskunde', 1),
(6, 5, 'erf', 'fdvgz', 'uploads/Suicidal Pigeon.mp4', 'informatiemanagement', 1),
(7, 5, '&lt;script&gt;alert(&quot;TEST&quot;);&lt;/script&', '&lt;script&gt;alert(&quot;TEST&quot;);&lt;/script&gt;', 'uploads/Obi-Wan - Hello there.mp4', 'wiskunde', 1),
(8, 5, 'adfhsdjfjsdihsldfi', 'TADNO', 'uploads/Harry Potter.mp4', 'wiskunde', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `likedvideos`
--
ALTER TABLE `likedvideos`
  ADD PRIMARY KEY (`videoID`,`userID`),
  ADD KEY `userliked_FK` (`userID`);

--
-- Indexen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`videoID`,`userID`),
  ADD KEY `ratinguser_FK` (`userID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexen voor tabel `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`videoID`),
  ADD KEY `UsersVideos_FK` (`userID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `videoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `likedvideos`
--
ALTER TABLE `likedvideos`
  ADD CONSTRAINT `userliked_FK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `videoliked_FK` FOREIGN KEY (`videoID`) REFERENCES `videos` (`videoID`);

--
-- Beperkingen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `ratinguser_FK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `ratingvideo_FK` FOREIGN KEY (`videoID`) REFERENCES `users` (`userID`);

--
-- Beperkingen voor tabel `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `UsersVideos_FK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
