-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2022 at 04:58 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artdealer`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `artistID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `about` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`artistID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistID`, `name`, `about`, `link`) VALUES
(1, 'Sophie Lawrence', 'Any frequent collectors on Bluethumb will be well familiar with the work of Sophie Lawrence. As our bestselling artist of 2020, this local Canberra artist is on track towards smashing her own record again this year. Her large-scale paintings are reliably bold and vibrant pieces, displaying abstraction and pops of colour. In more recent months, Sophie Lawrence has been exploring various degrees within her style. Described as an ‘intoxicating kaleidoscope of colour and energy’, she has quickly become a favourite with Australia’s collectors since joining the platform in January 2019.\r\n', 'https://bluethumb.com.au/sophie-lawrence'),
(2, 'Susan Trudinger', 'One of Bluethumb’s most successful landscape artists, Susan Trudinger paints vivid, high-spirited landscapes that emphasise the incredible colours and shapes in the natural world around us. Her abstract approach to various scenes offers a new perspective to traditional settings to the viewer. Her work has been influenced by many years and life experiences, including parenthood, career changes and travelling through the Middle East. It was during these travels Susan found herself “in awe of the landscape, the culture and the fine intricate designs on mosques and other buildings”.\r\n', 'https://bluethumb.com.au/susan-trudinger'),
(3, 'Sally Dunbar', 'With an impressive array of exhibitions already under her belt, Sally Dunbar has been climbing the ranks in popularity since she first joined Bluethumb in 2017. Sally Dunbar is currently living and working in Canberra and sees art as a sustaining part of her life. Her two-dimensional characters range from Australia’s native animals to classic pet friends at home. Sally’s simplified approach to the canvas provides a sense of candour and ease, much like naïve art so often does.\r\n', 'https://bluethumb.com.au/sally-dunbar'),
(4, 'Valentyna Crane', 'Light, movement and colour are all prime decisive factors in Valentyna’s contemporary impressionist landscapes. Committed to fostering atmosphere throughout her work, Valentyna Crane comes from a classical artistic background and uses her deep knowledge of art history to permeate her art. All of this creates a strong sense of  freedom and vibrancy, and carries the crispness of Canberra air.\r\n', 'https://bluethumb.com.au/val-crane'),
(5, 'Belinda Nadwie\r\n', 'Belinda Nadwie creates abstracted landscapes that traverse emotional, psychological and spiritual experience. Working with oil paint, charcoal, spray paint and oil crayons, she captures a spectrum of moods – from quiet, melancholy moments of indigo and teal to rapturous swathes of Persian pink and saffron.', 'https://bluethumb.com.au/belinda-nadwie');

-- --------------------------------------------------------

--
-- Table structure for table `artpiece`
--

DROP TABLE IF EXISTS `artpiece`;
CREATE TABLE IF NOT EXISTS `artpiece` (
  `artpieceID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `artistID` int(11) DEFAULT NULL,
  `artpieceNumber` int(11) NOT NULL,
  PRIMARY KEY (`artpieceID`),
  KEY `artistID` (`artistID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artpiece`
--

INSERT INTO `artpiece` (`artpieceID`, `name`, `price`, `artistID`, `artpieceNumber`) VALUES
(1, 'Pink Hydrangeas Big Jug', '1400.00', 1, 1),
(2, 'White Orchird Yellow Bowl', '990.00', 1, 2),
(3, 'Blue Night Hydrangea', '990.00', 1, 3),
(4, 'Green Farm', '1400.00', 1, 4),
(5, 'Cows on Pink', '760.00', 2, 1),
(6, 'Autumn Falling', '680.00', 2, 2),
(7, 'Grove of Trees', '890.00', 2, 3),
(8, 'Poplars and Cows', '830.00', 2, 4),
(9, '\"I Wanna Hear You Roar\"', '4400.00', 3, 1),
(10, 'Pink Galahs', '760.00', 3, 2),
(11, 'There’s a visitor at the window!', '540.00', 3, 3),
(12, 'Classic Canberra Controversial Sky Whale-Framed', '2950.00', 3, 4),
(13, 'Scattering of Light', '4850.00', 4, 1),
(14, 'Through the National Arboretum', '2500.00', 4, 2),
(15, 'Unspoken Question', '3900.00', 4, 3),
(16, 'Boundless Harmony', '4850.00', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

DROP TABLE IF EXISTS `customerorder`;
CREATE TABLE IF NOT EXISTS `customerorder` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `mode` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `number` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD CONSTRAINT `artpiece_ibfk_1` FOREIGN KEY (`artistID`) REFERENCES `artist` (`artistID`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `artpiece` (`artpieceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
