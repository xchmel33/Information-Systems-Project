
-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 03:03 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iis_bids`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `username` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(63) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `country`, `city`) VALUES
(1, 'lukas', 'lukas123', 'chmelolukas@gmail.com', 'Slovakia', 'PieÅ¡Å¥any');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
    `auction_id` int(255) NOT NULL AUTO_INCREMENT,
    `item_name` varchar(255) NOT NULL,
    `auction_type` int(1) NOT NULL,
    `auction_rule` int(1) NOT NULL,
    `auction_description` varchar(255),
    `start_price` FLOAT NOT NULL,
    `end_time` DATETIME NOT NULL,
    `image` varchar(255) DEFAULT NULL,
    PRIMARY KEY (auction_id)
);

DROP TABLE IF EXISTS `auction_user`;
CREATE TABLE `auction_user` (
    `auction` int(255),
    `user_id` int(255),
    `owner` int(1),
    FOREIGN KEY (auction) REFERENCES auction(auction_id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
)

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
