-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 07:14 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lazur`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(6) UNSIGNED NOT NULL,
  `city` varchar(30) NOT NULL,
  `cityId` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `cityId`) VALUES
(1, 'Варна', 1),
(2, 'София', 2),
(3, 'Пловдив', NULL),
(4, 'Видин', 4),
(5, 'Стара Загора', 5);

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id` int(6) UNSIGNED NOT NULL,
  `deliver` varchar(30) NOT NULL,
  `bulsat` varchar(11) NOT NULL,
  `address` int(6) UNSIGNED DEFAULT NULL,
  `telephone` varchar(10) NOT NULL,
  `year` year(4) NOT NULL,
  `person` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id`, `deliver`, `bulsat`, `address`, `telephone`, `year`, `person`) VALUES
(1, 'Абоба', '00006587412', 1, '0881111111', 1995, 'Ева Илиева'),
(2, 'Иванови', '0007845789', 2, '0894222222', 2015, 'Петър Иванов'),
(3, 'Кокиче', '0000877412', 5, '0881111115', 2007, 'Милена Георгиева'),
(7, 'Лазур', '00000856231', 1, '0888888888', 2001, 'Мария Руменова'),
(8, 'Маг', '045891245', 1, '094611111', 1996, 'Иво Николов'),
(9, 'Орхидея', '005417863', 4, '0885666666', 2010, 'Митко Тодоров');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cityId` (`cityId`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `person` (`person`),
  ADD KEY `indx_address` (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`cityId`) REFERENCES `provider` (`address`) ON UPDATE CASCADE ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
