-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 03:00 PM
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
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
                           `auction_id` int(255) NOT NULL,
                           `item_name` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
                           `auction_type` int(1) NOT NULL,
                           `auction_rule` int(1) NOT NULL,
                           `auction_description` varchar(255) COLLATE utf8_slovak_ci DEFAULT NULL,
                           `start_price` int(255) NOT NULL,
                           `min_bid` int(255) NOT NULL,
                           `highest_bid` int(255) NOT NULL,
                           `highest_bidder` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
                           `end_time` datetime NOT NULL,
                           `image` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
                           `status` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
                           `owner_id` int(255) NOT NULL,
                           `organizator_id` int(11) NOT NULL,
                           `instant_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auction_id`, `item_name`, `auction_type`, `auction_rule`, `auction_description`, `start_price`, `min_bid`, `highest_bid`, `highest_bidder`, `end_time`, `image`, `status`, `owner_id`, `organizator_id`, `instant_price`) VALUES
(12, 'Joint', 0, 0, 'sfajcenicko', 100, 110, 140, '', '2021-12-02 09:36:00', 'App/Image/joint.jpg', 'started', 3, 3, 1000),
(13, 'Bongo', 0, 0, 'Bongo', 100, 130, 0, '', '2021-12-04 10:33:00', 'App/Image/bongo.jpg', 'started', 4, 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
    ADD PRIMARY KEY (`auction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
    MODIFY `auction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
