-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 01:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demogurleen`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `brand_name`, `size`, `color`, `price`) VALUES
(1, 'Sunglasses', 'Ray-Ban', 'Medium', 'Blue', 150.00),
(2, 'Reading Glasses', 'Oakley', 'Small', 'Blue', 120.00),
(3, 'Sunglasses', 'Maui Jim', 'Large', 'Brown', 180.00),
(4, 'Prescription Glasses', 'Gucci', 'Medium', 'Gray', 250.00),
(5, 'Sunglasses', 'Prada', 'Medium', 'Green', 200.00),
(6, 'Safety Glasses', 'Persol', 'Large', 'Black', 160.00),
(7, 'Swimming Goggles', 'Nike', 'Small', 'Red', 110.00),
(8, 'Sunglasses', 'Tom Ford', 'Medium', 'Amber', 220.00),
(9, 'Prescription Glasses', 'Ray-Ban', 'Large', 'Blue', 150.00),
(10, 'Sunglasses', 'Oakley', 'Medium', 'Black', 130.00),
(11, 'Safety Glasses', 'Gucci', 'Large', 'Silver', 270.00),
(13, 'shades', 'rayban', 'medium', 'black', 40.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
