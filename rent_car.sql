-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 09:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `customer_support` text NOT NULL,
  `best_price` text NOT NULL,
  `location` text NOT NULL,
  `cancelation` text NOT NULL,
  `why_choose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `customer_support`, `best_price`, `location`, `cancelation`, `why_choose`) VALUES
(1, 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam.', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam.', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam.', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur aliquet quam.', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit.');

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE `banned_users` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `phone_num` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banned_users`
--

INSERT INTO `banned_users` (`id`, `email`, `f_name`, `l_name`, `phone_num`, `password`, `gender`, `dob`, `address`, `profile_picture`, `type`) VALUES
(60, 'adelshorap150@gmail.com', 'Adel', 'Shurrab', 567371501, '', 'male', '01/24/2003', 'shurrab street', 'wallpaperflare.com_wallpaper (1).jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `booking_num` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `PL` varchar(255) NOT NULL,
  `DL` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `booking_num`, `user_id`, `car_id`, `from_date`, `to_date`, `time`, `PL`, `DL`, `total_price`) VALUES
(2, 288215, 60, 34, '04-08-2023', '08/22/2023', '16:17', 'Shurrab Street', 'Company', '80.00'),
(3, 500127, 1, 31, '09-08-2023', '08/24/2023', '02:06', 'Shurrab Street', 'Company', '180.00');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(60) NOT NULL,
  `category` varchar(60) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_hour` int(11) NOT NULL,
  `availability` varchar(25) NOT NULL,
  `seats_num` int(11) NOT NULL,
  `gear` varchar(25) NOT NULL,
  `img1` varchar(500) NOT NULL,
  `img2` varchar(500) NOT NULL,
  `img3` varchar(500) NOT NULL,
  `img4` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `brand`, `model`, `category`, `quantity`, `price_per_hour`, `availability`, `seats_num`, `gear`, `img1`, `img2`, `img3`, `img4`) VALUES
(31, 'Tesla', 'Model 3', 'Electric', 30, 30, 'Available', 4, 'automatic', '2.jpg', '', '', ''),
(32, 'Hyundai', 'Hyundai Palisade', 'SUVs', 48, 25, 'Available', 7, 'automatic', '3.jpeg', '', '', ''),
(33, 'Fiat', 'Fiat Tipo', 'Sedans', 49, 15, 'Available', 4, 'manual', '4.jpeg', '', '', ''),
(34, 'Hyundai', 'Hyundai H1', 'Vans', 10, 40, 'Available', 7, 'manual', '1.jpg', '', '', ''),
(35, 'Hyundai', 'Hyundai Accent', 'Sedans', 35, 15, 'Available', 4, 'automatic', '2019_Hyundai_Accent.jpg', '', '', ''),
(36, 'Hyundai', 'Hyundai Kona', 'SUVs', 30, 25, 'Available', 4, 'automatic', '2019_Hyundai_Kona.jpg', '', '', ''),
(37, 'Ferrari', 'Ferrari 488 GTB', 'Sports', 3, 60, 'Available', 2, 'automatic', 'download.jpeg', '', '', ''),
(38, 'Rolls-Royce', 'Rolls-Royce Phantom', 'Luxury', 1, 100, 'Available', 6, 'automatic', 'download (1).jpeg', '', '', ''),
(39, 'Mercedes', 'Mercedes-Benz AMG GT Roadster', 'Convertible', 7, 55, 'Available', 2, 'automatic', '2018-mercedes.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ex_booking`
--

CREATE TABLE `ex_booking` (
  `book_id` int(11) NOT NULL,
  `booking_num` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `PL` varchar(255) NOT NULL,
  `DL` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ex_booking`
--

INSERT INTO `ex_booking` (`book_id`, `booking_num`, `user_id`, `car_id`, `from_date`, `to_date`, `time`, `PL`, `DL`, `total_price`) VALUES
(20, 288215, 60, 34, '04-08-2023', '08/22/2023', '16:17', 'Shurrab Street', 'Company', '80.00'),
(21, 500127, 1, 31, '09-08-2023', '08/24/2023', '02:06', 'Shurrab Street', 'Company', '180.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `phone_num` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'profile.png',
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `f_name`, `l_name`, `phone_num`, `password`, `gender`, `dob`, `address`, `profile_picture`, `type`) VALUES
(1, 'admin@gmail.com', 'Adel', 'Admin', 567371501, 'Zz187702@$', 'male', '01/24/2003', 'shurrab street', '1.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `booking_num` (`booking_num`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `ex_booking`
--
ALTER TABLE `ex_booking`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `booking_num` (`booking_num`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ex_booking`
--
ALTER TABLE `ex_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
