-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 07 jun 2017 om 13:27
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `authorisation`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam` varchar(500) DEFAULT NULL,
  `date_time` datetime(6) DEFAULT NULL,
  `examiner` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examiner` (`examiner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `exams`
--

INSERT INTO `exams` (`id`, `exam`, `date_time`, `examiner`) VALUES
(1, 'Nederlands 3F lezen en luisteren ', '2017-10-12 10:30:00.000000', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `exam_user`
--

CREATE TABLE IF NOT EXISTS `exam_user` (
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `result` decimal(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `exam_user`
--

INSERT INTO `exam_user` (`user_id`, `exam_id`, `result`) VALUES
(1, 1, '0.0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `abbreviation` varchar(10) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abbreviation` (`abbreviation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `prefix`, `lastname`, `email`, `password`, `abbreviation`, `role`) VALUES
(1, 'Romy', '', 'Bijkerk', 'romy-bijkerk@hotmail.com', '27fa9d3a680e68b32cfe2cd22bbdba28', NULL, 'Student'),
(2, 'Peter', '', 'Snoek', 'petersnoek@davinci.nl', 'f19a86bcd60e668b1d8a2b8530f8b9f4', 'SNP', 'Docent');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `FK_exams_users` FOREIGN KEY (`examiner`) REFERENCES `users` (`abbreviation`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
