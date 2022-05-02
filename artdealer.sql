-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 02, 2022 at 01:21 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

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

CREATE TABLE `artist` (
  `artistID` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `about` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistID`, `name`, `about`, `link`) VALUES
(1, 'Sophie Lawrence', 'Any frequent collectors on Bluethumb will be well familiar with the work of Sophie Lawrence. As our bestselling artist of 2020, this local Canberra artist is on track towards smashing her own record again this year. Her large-scale paintings are reliably bold and vibrant pieces, displaying abstraction and pops of colour. In more recent months, Sophie Lawrence has been exploring various degrees within her style. Described as an ‘intoxicating kaleidoscope of colour and energy’, she has quickly become a favourite with Australia’s collectors since joining the platform in January 2019.\r\n', 'https://bluethumb.com.au/sophie-lawrence'),
(2, 'Susan Trudinger', 'One of Bluethumb’s most successful landscape artists, Susan Trudinger paints vivid, high-spirited landscapes that emphasise the incredible colours and shapes in the natural world around us. Her abstract approach to various scenes offers a new perspective to traditional settings to the viewer. Her work has been influenced by many years and life experiences, including parenthood, career changes and travelling through the Middle East. It was during these travels Susan found herself “in awe of the landscape, the culture and the fine intricate designs on mosques and other buildings”.\r\n', 'https://bluethumb.com.au/susan-trudinger'),
(3, 'Sally Dunbar', 'With an impressive array of exhibitions already under her belt, Sally Dunbar has been climbing the ranks in popularity since she first joined Bluethumb in 2017. Sally Dunbar is currently living and working in Canberra and sees art as a sustaining part of her life. Her two-dimensional characters range from Australia’s native animals to classic pet friends at home. Sally’s simplified approach to the canvas provides a sense of candour and ease, much like naïve art so often does.\r\n', 'https://bluethumb.com.au/sally-dunbar'),
(4, 'Valentyna Crane', 'Light, movement and colour are all prime decisive factors in Valentyna’s contemporary impressionist landscapes. Committed to fostering atmosphere throughout her work, Valentyna Crane comes from a classical artistic background and uses her deep knowledge of art history to permeate her art. All of this creates a strong sense of  freedom and vibrancy, and carries the crispness of Canberra air.\r\n', 'https://bluethumb.com.au/val-crane');

-- --------------------------------------------------------

--
-- Table structure for table `artpiece`
--

CREATE TABLE `artpiece` (
  `artpieceID` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `artistID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customerOrder`
--

CREATE TABLE `customerOrder` (
  `orderID` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mode` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `number` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderItem`
--

CREATE TABLE `orderItem` (
  `itemID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artistID`);

--
-- Indexes for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD PRIMARY KEY (`artpieceID`),
  ADD KEY `artistID` (`artistID`);

--
-- Indexes for table `customerOrder`
--
ALTER TABLE `customerOrder`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `orderItem`
--
ALTER TABLE `orderItem`
  ADD PRIMARY KEY (`itemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `artpiece`
--
ALTER TABLE `artpiece`
  MODIFY `artpieceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerOrder`
--
ALTER TABLE `customerOrder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderItem`
--
ALTER TABLE `orderItem`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD CONSTRAINT `artpiece_ibfk_1` FOREIGN KEY (`artistID`) REFERENCES `artist` (`artistID`);

--
-- Constraints for table `orderItem`
--
ALTER TABLE `orderItem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `artpiece` (`artpieceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
