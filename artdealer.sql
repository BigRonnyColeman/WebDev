-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2022 at 06:57 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistID`, `name`, `about`, `link`) VALUES
(1, 'Sophie Lawrence', 'Any frequent collectors on Bluethumb will be well familiar with the work of Sophie Lawrence. As our bestselling artist of 2020, this local Canberra artist is on track towards smashing her own record again this year. Her large-scale paintings are reliably bold and vibrant pieces, displaying abstraction and pops of colour. In more recent months, Sophie Lawrence has been exploring various degrees within her style. Described as an ‘intoxicating kaleidoscope of colour and energy’, she has quickly become a favourite with Australia’s collectors since joining the platform in January 2019.\r\n', 'https://bluethumb.com.au/sophie-lawrence'),
(2, 'Susan Trudinger', 'One of Bluethumb’s most successful landscape artists, Susan Trudinger paints vivid, high-spirited landscapes that emphasise the incredible colours and shapes in the natural world around us. Her abstract approach to various scenes offers a new perspective to traditional settings to the viewer. Her work has been influenced by many years and life experiences, including parenthood, career changes and travelling through the Middle East. It was during these travels Susan found herself “in awe of the landscape, the culture and the fine intricate designs on mosques and other buildings”.\r\n', 'https://bluethumb.com.au/susan-trudinger'),
(3, 'Sally Dunbar', 'With an impressive array of exhibitions already under her belt, Sally Dunbar has been climbing the ranks in popularity since she first joined Bluethumb in 2017. Sally Dunbar is currently living and working in Canberra and sees art as a sustaining part of her life. Her two-dimensional characters range from Australia’s native animals to classic pet friends at home. Sally’s simplified approach to the canvas provides a sense of candour and ease, much like naïve art so often does.\r\n', 'https://bluethumb.com.au/sally-dunbar'),
(4, 'Valentyna Crane', 'Light, movement and colour are all prime decisive factors in Valentyna’s contemporary impressionist landscapes. Committed to fostering atmosphere throughout her work, Valentyna Crane comes from a classical artistic background and uses her deep knowledge of art history to permeate her art. All of this creates a strong sense of  freedom and vibrancy, and carries the crispness of Canberra air.\r\n', 'https://bluethumb.com.au/val-crane'),
(5, 'Kate Rogers', '‘We like to think of ourselves as your poor man’s (or woman’s or person’s) Marie-Therese Walter or Dora Maar. In fact, if you blur your eyes to the point of not being able to see at all, you may even be able to catch the scent of a very syntheticy Eau de Wally Neuzil.\r\n\r\nYou may decide for yourself which, if any, of these muses lurk in our creator’s conscious, unconscious or collective unconscious... however, we do know for sure that the purpose of our existence is to reveal the dark, irreverent and unusual slivers that glint like broken glass in all of us imperfect forms here on Earth.’', 'https://bluethumb.com.au/belinda-nadwie'),
(6, 'Liliana Gigovic', 'I come from a very creative family so it was only natural for me to take an interest in art. My art is not placed within the boundaries of a single style or genre.I love using a combination of thick paint, a palette knife and experimenting with different color tones. I am inspired by nature, whether it be seascape or flowers, to create something that is a little bit different with a modern outlook. I am an explorer by nature and I let my curious personality lead me to new journeys in art.Oil is my favorite medium although I occasionally paint in acrylic. I believe my paintings possess a zest for life and I hope my art gives others a glimpse of joy and happiness that they provide me.', 'https://bluethumb.com.au/liliana-gigovic'),
(7, 'Angela Hawkey', 'Having a strong heritage in the arts, I explored many art mediums; but my two passions are oil palette knife painting and photography. Being a photographer and an artist allows me to really notice those little glimpses of beauty that are often missed. I like to embellish on that. A tiny hint of the ocean through the scrub can turn into a paradise oasis through a cottage garden or gum trees.\r\n\r\nI draw my inspiration from personal memories, photos taken on my travels, and photos taken by other talented photographers that I admire. Sometimes a combination of all three, as well as a bit of imagination. I take a messy, and free flowing approach to my art. Even when starting with a subject or idea in mind, I freely deviate from the plan. I love the unexpected surprises and naturalness that come from a relaxed style of painting.', 'https://bluethumb.com.au/angela-hawkey'),
(8, 'Pip Phelps', 'I have always had a love for the often perceived simplicity of the 1950s-70s. I long for simpler times and you may see some retro visuals such as midcentury architecture creep into my work.\r\nYou may also see some botanicals, still lifes and fauna pop up!\r\n\r\nMy seascapes and figurative works may provide the collector with calming, colourful and nostalgic holiday vibes that have the power to enrich both corporate and home environments.\r\n\r\nHaving grown up on the West Australian coast Ive spent many years on the beach (and in the bush) ..playing with my big brother within view from the kitchen window, to holidaying at Rotto, to living and surfing at Quinns, Trigg, Scarborough, Cottesloe and Margaret River, lifesaving at North Cott and swimming for West Coast Swim Club ...WA waters are a constant inspiration.', 'https://bluethumb.com.au/pipphelps'),
(9, 'Karen Lee Mungarrja', 'Exploring the connection between landscape and memory and more specifically the remnants and traces left in environments either in a physical form or as emotion.\r\n\r\nAboriginal peoples have walked this country for thousands of years, leaving tracks which are both tangible and spiritual.\r\nI challenge the idea of \' Past\' as something no longer existing. I believe it remains,in our memory and the land.In what we see and what we cannot.\r\n\r\nMy art hangs in the homes of private collections Both in Australia and overseas in USA, London, Dubai, Singapore,Tokyo to name a few, and in many public spaces including hospitals,schools and government departments.I also have two artworks from my \'Spaces Between\' exhibition purchased for the Australian Art Acquisitions an honour to be alongside amazing Australian artists.', 'https://bluethumb.com.au/karen-lee-art'),
(10, 'Dinah Wakefield', 'Dinah lived and worked as an artist in Sydney for over 20 years, developing a reputation for her dramatic abstract landscapes. She has many exhibitions, commissions and corporate representations in her CV. In 2016 she moved to Noosa establishing her studio in the garden of her new home in Peregian Beach. Dinah draws inspiration from the landscape around her, focusing on an abstract expression of colour and form. Her latest works continue the theme of abstract landscapes. They are inspired by the natural beauty of the area and are fluid and organic creating a sense of peace, tranquility and space.', 'https://bluethumb.com.au/dinah-wakefield'),
(11, 'Michelle Keighley', 'Maria\'s canvases are a spontaneous expression of thought and feeling - the painting of a mood, the reaction to a moment in time. The subject of each piece is open to interpretation. Her paintings are bright and happy, this is achieved by combining contrasting colours from her colour palette based on the Feng Shui color principles which is now part of her abstract range. Maria\'s art is made up of applying several layers of spontaneous brush and palette knife strokes she has developed over the years in order to create the harmony, organic movement and depth that she yearns for in all her (nature driven) paintings.', 'https://bluethumb.com.au/michelle-keighley'),
(12, 'Maria Cross', ' Maria\'s canvases are a spontaneous expression of thought and feeling - the painting of a mood, the reaction to a moment in time. The subject of each piece is open to interpretation. Her paintings are bright and happy, this is achieved by combining contrasting colours from her colour palette based on the Feng Shui color principles which is now part of her abstract range. Maria\'s art is made up of applying several layers of spontaneous brush and palette knife strokes she has developed over the years in order to create the harmony, organic movement and depth that she yearns for in all her (nature driven) paintings.', 'https://bluethumb.com.au/maria-cross');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

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
(16, 'Boundless Harmony', '4850.00', 4, 4),
(17, 'Blue and Green Should Always Be Seen', '790.00', 5, 1),
(18, 'Catelina on Candy Pink', '300.00', 5, 2),
(19, 'Lurid Fruit on Plate', '300.00', 5, 3),
(20, 'Sara di Sienna', '250.00', 5, 4),
(21, 'Water Lilies no 87', '1590.00', 6, 1),
(22, 'Yarra Valley', '440.00', 6, 2),
(23, 'Water Lilies no 89', '690.00', 6, 3),
(24, 'A Brand New Day', '3300.00', 6, 4),
(25, 'Singing Love Songs', '600.00', 7, 1),
(26, 'Nature\'s Palette', '400.00', 7, 2),
(27, 'Symphony of Colour', '3900.00', 7, 3),
(28, 'Torrent', '1980.00', 7, 4),
(29, 'Boardwalk at Morning Light', '290.00', 8, 1),
(30, 'Vogue 1974', '290.00', 8, 2),
(31, 'Country Road', '410.00', 8, 3),
(32, 'Motley Crew', '290.00', 8, 4),
(33, 'Baayi', '610.00', 9, 1),
(34, 'It Made Me Smile', '750.00', 9, 2),
(35, 'Bangal-buwu-rayi', '680.00', 9, 3),
(36, 'Yadhaa', '650.00', 9, 4),
(37, 'Erme', '3600.00', 10, 1),
(38, 'Rainbow Sands 2', '3400.00', 10, 2),
(39, 'Ocean\'s Reach 1', '3200.00', 10, 3),
(40, 'Desert Trails', '3200.00', 10, 4),
(41, 'Blue River Valley', '960.00', 11, 1),
(42, 'An Inch of Mercury', '420.00', 11, 2),
(43, 'Chasing the Sun ', '600.00', 11, 3),
(44, 'Poplar Plains', '1800.00', 11, 4),
(45, 'Thank You', '3850.00', 12, 1),
(46, 'Australian Rugged Outback', '3450.00', 12, 2),
(47, 'Sapphire Blue Clouds With The Sun Filtering Through', '2690.00', 12, 3),
(48, 'Summer Breeze', '2550.00', 12, 4);

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
