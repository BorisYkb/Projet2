-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2023 at 09:50 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `korhogocashew`
--

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

DROP TABLE IF EXISTS `production`;
CREATE TABLE IF NOT EXISTS `production` (
  `ID_PROD` int NOT NULL AUTO_INCREMENT,
  `DATE_ENREGIS` date DEFAULT NULL,
  `PRIX_KG` double DEFAULT NULL,
  `POIDS_TONNE` double DEFAULT NULL,
  `ID_USER` int DEFAULT NULL,
  PRIMARY KEY (`ID_PROD`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`ID_PROD`, `DATE_ENREGIS`, `PRIX_KG`, `POIDS_TONNE`, `ID_USER`) VALUES
(29, '2023-05-30', 300, 8.5, 2314),
(3, '2023-05-24', 350, 2, 2233),
(8, '2019-06-06', 450, 1.5, 9999),
(9, '2023-02-19', 355, 7.9, 4774),
(6, '2023-03-06', 325, 10, 8235),
(7, '2022-05-11', 375, 20, 8235),
(10, '2023-03-18', 300, 12, 4774),
(11, '2023-03-11', 290, 11, 3600),
(26, '2022-05-16', 250, 6, 9999),
(13, '2023-05-28', 200, 5.5, 4774),
(14, '2019-06-06', 450, 7.5, 9999),
(15, '2019-06-01', 415, 7.5, 9999),
(25, '2022-10-31', 200, 11, 9999),
(17, '2023-01-22', 260, 3, 3322),
(18, '2022-08-18', 300, 15.8, 9999),
(19, '2022-03-17', 300, 1.3, 9999),
(27, '2022-06-29', 350, 7.5, 9999),
(21, '2023-05-29', 280, 10, 3322),
(22, '2023-05-02', 280, 9, 3322),
(24, '2023-01-07', 325, 2, 2314),
(28, '2022-04-07', 350, 2, 2314);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int NOT NULL,
  `NOM_USER` varchar(50) NOT NULL,
  `NUM_USER` int NOT NULL,
  `MAIL_USER` varchar(50) NOT NULL,
  `MP_USER` int NOT NULL,
  `NIVEAU` int NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `NOM_USER`, `NUM_USER`, `MAIL_USER`, `MP_USER`, `NIVEAU`) VALUES
(4321, 'admin jean', 98563478, 'jeanadmin@gmail.com', 12345, 1),
(3322, 'Sylvain Paul', 34567111, 'sylvainj@gmail.com', 10037, 2),
(4774, 'ali diakité', 24680857, 'diakitea@gmail.com', 39999, 2),
(2233, 'traore salif', 24337474, 'salift@gmail.com', 24534, 2),
(8235, 'Issiaka Frank', 11111123, 'issiakaf@gmail.com', 33220, 2),
(3600, 'Issa Louis', 45645389, 'issal@gmail.com', 180013, 2),
(2314, 'Zébi François', 11115552, 'zebif@gmail.com', 11213, 2),
(1099, 'Yapo Julienne', 44996677, 'yapiju@gmail.com', 99015, 2),
(9978, 'Koffi Evrard', 34250446, 'koffie@gmail.com', 18450, 2),
(9099, 'Yapi Julien', 44556677, 'yapij@gmail.com', 19930, 2),
(2016, 'Sangaré Ivan', 56752788, 'sangarei@gmail.com', 20056, 2),
(1112, 'Peter Rick', 11133367, 'peterr@gmail.com', 10023, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
