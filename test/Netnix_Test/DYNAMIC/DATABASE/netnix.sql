-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 jan 2019 om 15:37
-- Serverversie: 10.1.35-MariaDB
-- PHP-versie: 7.2.9

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
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(10) NOT NULL,
  `firstname` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `surname` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `catagory`
--

CREATE TABLE `catagory` (
  `catagory_ID` int(10) NOT NULL,
  `catagory_Name` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comment`
--

CREATE TABLE `comment` (
  `comment_ID` int(10) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `like_Dislike_ID` int(10) NOT NULL,
  `comment_description` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `favourite`
--

CREATE TABLE `favourite` (
  `Favourite_ID` int(10) NOT NULL,
  `video_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `like_dislike`
--

CREATE TABLE `like_dislike` (
  `like_Dislike_ID` int(10) NOT NULL,
  `like_Dislike_Ratio` enum('Y','N') CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rating`
--

CREATE TABLE `rating` (
  `user_ID` int(10) NOT NULL,
  `Rating_ID` int(10) NOT NULL,
  `Rating_Star` varchar(5) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `upload`
--

CREATE TABLE `upload` (
  `upload_ID` int(10) NOT NULL,
  `video_Title` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `catagory_ID` int(10) NOT NULL,
  `video_Description` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `video_tag1` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `video_tag2` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `video_tag3` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_ID` int(10) NOT NULL,
  `firstname` varchar(14) CHARACTER SET utf8mb4 DEFAULT NULL,
  `surname` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(26) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `video`
--

CREATE TABLE `video` (
  `video_ID` int(10) NOT NULL,
  `upload_ID` int(10) NOT NULL,
  `rating_ID` int(5) NOT NULL,
  `comment_ID` int(10) NOT NULL,
  `catagory_ID` int(10) NOT NULL,
  `video_Hash` char(250) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexen voor tabel `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`catagory_ID`);

--
-- Indexen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `like_Dislike_ID` (`like_Dislike_ID`);

--
-- Indexen voor tabel `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`Favourite_ID`),
  ADD KEY `video_ID` (`video_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexen voor tabel `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`like_Dislike_ID`);

--
-- Indexen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`Rating_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexen voor tabel `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_ID`),
  ADD KEY `catagory_ID` (`catagory_ID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexen voor tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_ID`),
  ADD KEY `upload_ID` (`upload_ID`),
  ADD KEY `rating_ID` (`rating_ID`),
  ADD KEY `comment_ID` (`comment_ID`),
  ADD KEY `catagory_ID` (`catagory_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`like_Dislike_ID`) REFERENCES `like_dislike` (`like_Dislike_ID`);

--
-- Beperkingen voor tabel `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`video_ID`) REFERENCES `video` (`video_ID`),
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Beperkingen voor tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Beperkingen voor tabel `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`catagory_ID`) REFERENCES `catagory` (`catagory_ID`);

--
-- Beperkingen voor tabel `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`upload_ID`) REFERENCES `upload` (`upload_ID`),
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`rating_ID`) REFERENCES `rating` (`Rating_ID`),
  ADD CONSTRAINT `video_ibfk_3` FOREIGN KEY (`comment_ID`) REFERENCES `comment` (`comment_ID`),
  ADD CONSTRAINT `video_ibfk_4` FOREIGN KEY (`catagory_ID`) REFERENCES `catagory` (`catagory_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
