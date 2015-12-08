
-- Use this file to create both your XAMPp database and table.

-- Host: localhost



SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- ******Run once in XAMPP********

CREATE DATABASE inventory;




USE inventory;



-- *******************************
-- Touch nothing else after the line below....
-- *******************************

-- ********None shall pass!********--------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `ISBN` char(13) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `author_firstName` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `author_lastName` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `genre` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `publisher` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `yearPublished` char(4) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `price` float DEFAULT '0',
  PRIMARY KEY (`ISBN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Sample data for table `books`
--

INSERT INTO `books` (`ISBN`, `title`, `author_firstName`, `author_lastName`, `genre`, `publisher`, `yearPublished`, `price`) VALUES
('1234567892468', 'Energy Sandwich', 'Bubba', 'Jones', 'Cooking', 'Lulu', '2015', 42.42),
('9780345453747', 'The Ultimate Hitchhiker\'s Guide to the Galaxy', 'Douglas', 'Adams', 'Science Fiction', 'Del Rey', '2002', 11.89),
('9780743435710', 'On Basilisk Station', 'David', 'Weber', 'Science Fiction', 'Baen', '2002', 7.99);
