-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: יוני 21, 2020 בזמן 03:56 PM
-- גרסת שרת: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d&d`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `basic`
--

DROP TABLE IF EXISTS `basic`;
CREATE TABLE IF NOT EXISTS `basic` (
  `Power` int(11) NOT NULL,
  `Dexterity` int(11) NOT NULL,
  `Intelligence` int(11) NOT NULL,
  `Charism` int(11) NOT NULL,
  `Agility` int(11) NOT NULL,
  `Life` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `basic`
--

INSERT INTO `basic` (`Power`, `Dexterity`, `Intelligence`, `Charism`, `Agility`, `Life`) VALUES
(2, 2, 2, 2, 2, 3);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Job` tinytext NOT NULL,
  `Power` int(4) NOT NULL,
  `Dexterity` tinyint(4) NOT NULL,
  `Intelligence` tinyint(4) NOT NULL,
  `Charism` tinyint(4) NOT NULL,
  `Agility` tinyint(4) NOT NULL,
  `Life` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `job`
--

INSERT INTO `job` (`id`, `Job`, `Power`, `Dexterity`, `Intelligence`, `Charism`, `Agility`, `Life`) VALUES
(1, 'Saber', 1, 1, 0, 0, 1, 1),
(2, 'Lancer', 0, 2, 0, 0, 2, 0),
(3, 'Berseker', 2, 0, 0, 0, 1, 1),
(4, 'Caster', 0, 1, 2, 0, 1, 0),
(5, 'Assasin', 0, 2, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `lusers`
--

DROP TABLE IF EXISTS `lusers`;
CREATE TABLE IF NOT EXISTS `lusers` (
  `luser_num` int(11) NOT NULL,
  `player_name` text NOT NULL,
  `job` text NOT NULL,
  `race` text NOT NULL,
  `sex` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `lusers`
--

INSERT INTO `lusers` (`luser_num`, `player_name`, `job`, `race`, `sex`) VALUES
(1, '10', 'Lancer', 'Gobelin', 'Woman'),
(2, '12', 'Lancer', 'Human', 'Man'),
(3, '3', 'Caster', 'Human', 'Man'),
(4, '2', 'Caster', 'Demon', 'Woman'),
(5, '14', 'Lancer', 'Orcs', 'Man'),
(6, '5', 'Berseker', 'Orcs', 'Woman'),
(7, '11', 'Lancer', 'Demon', 'Man'),
(8, '9', 'Berseker', 'Orcs', 'Man'),
(1, '13', 'Lancer', 'Halfelin', 'Man'),
(2, '4', 'Caster', 'Orcs', 'Man'),
(3, '595', 'Assasin', 'Elves', 'Woman'),
(4, '8', 'Saber', 'Gobelin', 'Man'),
(1, '1', 'Saber', 'Elves', 'Woman'),
(2, '6', 'Lancer', 'Human', 'Woman'),
(1, '7', 'Saber', 'Human', 'Woman');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `player` text NOT NULL,
  `pow` int(11) NOT NULL,
  `dex` int(11) NOT NULL,
  `intel` int(11) NOT NULL,
  `charism` int(11) NOT NULL,
  `agility` int(11) NOT NULL,
  `life` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `players`
--

INSERT INTO `players` (`player`, `pow`, `dex`, `intel`, `charism`, `agility`, `life`) VALUES
('595', 1, 5, 4, 3, 3, 3),
('1', 2, 4, 2, 3, 4, 4),
('2', 3, 2, 3, 4, 4, 3),
('3', 2, 4, 4, 3, 3, 3),
('4', 3, 4, 3, 3, 3, 3),
('5', 5, 2, 1, 3, 4, 4),
('6', 2, 4, 2, 3, 5, 3),
('7', 3, 3, 2, 3, 4, 4),
('8', 4, 3, 2, 2, 4, 4),
('9', 7, 2, 1, 2, 3, 4),
('10', 1, 4, 2, 3, 6, 3),
('11', 5, 3, 1, 3, 4, 3),
('12', 4, 4, 2, 2, 4, 3),
('13', 3, 3, 3, 2, 5, 3),
('14', 5, 4, 1, 2, 4, 3),
('15', 6, 3, 1, 2, 3, 4);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `race`
--

DROP TABLE IF EXISTS `race`;
CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Race` tinytext NOT NULL,
  `Power` tinyint(1) NOT NULL,
  `Dexterity` tinyint(1) NOT NULL,
  `Intelligence` tinyint(1) NOT NULL,
  `Charism` tinyint(1) NOT NULL,
  `Agility` tinyint(1) NOT NULL,
  `Life` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `race`
--

INSERT INTO `race` (`id`, `Race`, `Power`, `Dexterity`, `Intelligence`, `Charism`, `Agility`, `Life`) VALUES
(1, 'Human', 0, 0, 0, 0, 0, 0),
(2, 'Demon', 1, -1, -1, 1, 0, 0),
(3, 'Elves', -1, 1, 0, 0, 0, 0),
(4, 'Orcs', 1, 0, -1, 0, 0, 0),
(5, 'Halfelin', -1, -1, 1, 0, 1, 0),
(6, 'Gobelin', -1, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `Sexe` tinytext NOT NULL,
  `Power` tinyint(1) NOT NULL,
  `Dexterity` tinyint(1) NOT NULL,
  `Intelligence` tinyint(1) NOT NULL,
  `Charism` tinyint(1) NOT NULL,
  `Agility` tinyint(1) NOT NULL,
  `Life` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `sexe`
--

INSERT INTO `sexe` (`Sexe`, `Power`, `Dexterity`, `Intelligence`, `Charism`, `Agility`, `Life`) VALUES
('Man', 2, 0, 0, 0, 0, 0),
('CasterMan', 0, 1, 0, 1, 0, 0),
('Woman', 0, 0, 0, 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
