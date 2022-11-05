-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2022 at 01:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storexweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoreis`
--

CREATE TABLE `categoreis` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoreis`
--

INSERT INTO `categoreis` (`id`, `title`) VALUES
(2, 'action'),
(4, 'horror'),
(5, 'romantic');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `rate` int(11) DEFAULT 0,
  `image` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `rate`, `image`, `category_id`) VALUES
(1, 'black Adam', 'the test movie', 5, '17765186501667574452.jpg', 2),
(3, 'movie232', 'sdddddddd', 3, '12934635421667578843.jpg', 2),
(4, 'Prey For The devil', 'ddddddddddddddddddd', 3, '16003618481667578946.jpg', 2),
(5, 'TICKET TO PARADISE', 'dddddddddddddddd', 4, '3534341311667579027.jpg', 5),
(11, 'Old Movie', 'the horror movieeeeeeeeee', 0, '532603861667651564.jpg', 4),
(12, 'test movieeeeeeeeeee', 'last test :)', 4, '8724688511667651783.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `user_id`, `movie_id`, `rate`) VALUES
(1, 6, 3, 3),
(2, 12, 4, 2),
(3, 6, 5, 5),
(4, 7, 5, 3),
(5, 9, 5, 2),
(6, 6, 1, 5),
(7, 8, 4, 4),
(8, 13, 5, 5),
(17, 10, 12, 4),
(18, 6, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `birthDate`) VALUES
(6, 'Laila Ibrahim Mahmoud', 'lailaibrahim798@gmail.com', '2022-11-18'),
(7, 'Magdy', 'magdy@gmail.com', '2022-11-08'),
(8, 'Mohamed', 'mohamed23@yahoo.com', '2022-12-07'),
(9, 'omar', 'omar@gmail.com', '2022-11-15'),
(10, 'nada', 'nada23@gmail.com', '2022-11-14'),
(11, 'mona', 'mona32@yahoo.com', '2022-11-23'),
(12, 'amgad', 'amgad456@gmail.com', '2022-11-17'),
(13, 'walid', 'walid32@gmail.com', '2022-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoreis`
--
ALTER TABLE `categoreis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Category_Relation` (`category_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_Relation` (`user_id`),
  ADD KEY `Movie_Relation` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoreis`
--
ALTER TABLE `categoreis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `Category_Relation` FOREIGN KEY (`category_id`) REFERENCES `categoreis` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `Movie_Relation` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_Relation` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
