-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 16 maj 2024 kl 13:44
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `mello`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `admininlogg`
--

CREATE TABLE `admininlogg` (
  `id` int(11) NOT NULL,
  `anvandarnamn` varchar(255) NOT NULL,
  `losenord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `admininlogg`
--

INSERT INTO `admininlogg` (`id`, `anvandarnamn`, `losenord`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Tabellstruktur `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `namn` varchar(255) NOT NULL,
  `beskrivning` mediumtext NOT NULL,
  `bildURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `artist`
--

INSERT INTO `artist` (`id`, `namn`, `beskrivning`, `bildURL`) VALUES
(34, 'Adam Woods', 'Adam Woods, egentligen Adam Christopher Allskog, född den 14 mars 2001, svensk sångare, låtskrivare och producent.  Adam Woods har flera samarbeten med stora artister inom dansgenren. Bland sina inspirationerna nämner han Swedish House Mafia, Meduza och James Arthur.  Han läste ekonomi på gymnasiet, då han först inte vågade satsa på musiken. Ägnade sig tidigt åt klassiskt piano innan han övergick till att bli sångare.  Han gick till slutaudition i Idol 2019.', '450px-Adam_Woods_2024.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `bidrag`
--

CREATE TABLE `bidrag` (
  `id` int(11) NOT NULL,
  `låtNamn` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `låtskrivare` varchar(255) NOT NULL,
  `roster` int(11) NOT NULL,
  `artistNamn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `bidrag`
--

INSERT INTO `bidrag` (`id`, `låtNamn`, `url`, `låtskrivare`, `roster`, `artistNamn`) VALUES
(13, 'Supernatural', 'https://www.youtube.com/embed/ZBB3fSvuq08?si=qXdoqhUfRMcYslA9', 'Adam Woods, Jonna Hall, Calle Hellberg och William Segerdahl', 0, 'Adam Woods');

-- --------------------------------------------------------

--
-- Tabellstruktur `bidragdeltavlingjoin`
--

CREATE TABLE `bidragdeltavlingjoin` (
  `id` int(11) NOT NULL,
  `deltavlingNamnJoin` varchar(255) NOT NULL,
  `artistNamnJoin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `bidragdeltavlingjoin`
--

INSERT INTO `bidragdeltavlingjoin` (`id`, `deltavlingNamnJoin`, `artistNamnJoin`) VALUES
(7, 'deltavling1', 'Adam Woods');

-- --------------------------------------------------------

--
-- Tabellstruktur `deltavlingar`
--

CREATE TABLE `deltavlingar` (
  `id` int(11) NOT NULL,
  `deltavlingsNamn` varchar(255) NOT NULL,
  `startTid` varchar(15) NOT NULL,
  `slutTid` varchar(15) NOT NULL,
  `datum` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `deltavlingar`
--

INSERT INTO `deltavlingar` (`id`, `deltavlingsNamn`, `startTid`, `slutTid`, `datum`) VALUES
(1, 'deltävling1', '', '', ''),
(2, 'deltävling2', '', '', ''),
(3, 'deltävling3', '', '', ''),
(4, 'deltävling4', '', '', '');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `admininlogg`
--
ALTER TABLE `admininlogg`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `bidrag`
--
ALTER TABLE `bidrag`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `bidragdeltavlingjoin`
--
ALTER TABLE `bidragdeltavlingjoin`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `deltavlingar`
--
ALTER TABLE `deltavlingar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `admininlogg`
--
ALTER TABLE `admininlogg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT för tabell `bidrag`
--
ALTER TABLE `bidrag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT för tabell `bidragdeltavlingjoin`
--
ALTER TABLE `bidragdeltavlingjoin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `deltavlingar`
--
ALTER TABLE `deltavlingar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
