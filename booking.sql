-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 05:54 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `programme_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `startDate`, `endDate`, `programme_id`, `token`) VALUES
(1, '2004-06-03 09:45:00', '2004-06-03 10:45:00', 4, '1505a65a39d67295cd007b73d9e5684f'),
(12, '2004-06-03 09:00:00', '2004-06-03 09:30:00', 4, '1505a65a39d67295cd007b73d9e5684f'),
(14, '2004-06-03 11:00:00', '2004-06-03 12:30:00', 4, '1505a65a39d67295cd007b73d9e5684f'),
(15, '2004-06-03 12:45:00', '2004-06-03 12:57:00', 4, '1505a65a39d67295cd007b73d9e5684f'),
(16, '2004-06-03 12:58:00', '2004-06-03 12:59:00', 4, '1505a65a39d67295cd007b73d9e5684f'),
(17, '2004-06-03 13:00:00', '2004-06-03 13:01:00', 4, '1505a65a39d67295cd007b73d9e5684f'),
(18, '2004-06-03 13:00:00', '2004-06-03 13:01:00', 12, '4540156e960cdc43f1788ffa3fe96544'),
(19, '2004-06-03 13:00:00', '2004-06-03 13:01:00', 7, '4540156e960cdc43f1788ffa3fe96544');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `maximumUsers` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `type`, `maximumUsers`, `room_id`) VALUES
(4, 'Pilates', 79, 2),
(7, 'kangoo jumps', 32, 1),
(12, 'Programare noua', 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`) VALUES
(1, ' South Room'),
(2, 'North Room');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `token` varchar(255) NOT NULL,
  `CNP` bigint(25) NOT NULL,
  `isAdmin` int(10) NOT NULL,
  `programme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`token`, `CNP`, `isAdmin`, `programme_id`) VALUES
('1505a65a39d67295cd007b73d9e5684f', 1990788553322, 1, 7),
('4540156e960cdc43f1788ffa3fe96544', 1990788553329, 0, 12),
('8ae525620457f314ad1e9129f7a4c0cb', 1990788553330, 0, 4),
('99382f8fae1be00a0111274d53e407d1', 1990788553323, 1, 7),
('a4d343c88e7e8af5aae16205c2c0f9c6', 1990788553324, 0, 12),
('aac2ac1073f64a1cc0190bb703ef0f6e', 1990788553325, 0, 7),
('ab335b792a5acefe54940832001a5206', 1990788553326, 0, 12),
('f11b9ebf7dd88cc8c5fc4d7a9bc1abac', 1990788553331, 0, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkusers_id3` (`token`),
  ADD KEY `fk_programme_id3` (`programme_id`) USING BTREE;

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreignkey_room_id` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`token`),
  ADD KEY `fk_programme_id6` (`programme_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fkusers_id3` FOREIGN KEY (`token`) REFERENCES `users` (`token`);

--
-- Constraints for table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_programme_id6` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
