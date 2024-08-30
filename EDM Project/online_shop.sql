-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 12:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'frut'),
(2, 'vegetables'),
(3, 'spices');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_item`
--

CREATE TABLE `ordered_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `shipping_info` text NOT NULL,
  `payment_type` enum('online','cod') NOT NULL,
  `status` enum('pending','delivered') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `categorie` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `categorie`, `photo`, `description`, `price`, `quantity`) VALUES
(1, 'Apple', 'frut', 'Apple.jpg', 'Apple - Red Delicious, Economy, 4 pcs Approx. 450 g - 500 g.<br>\r\nMRP:₹190<br>\r\nYou Save:27% OFF<br>\r\n(inclusive of all taxes)', 139, 18),
(2, 'Pear', 'frut', 'Pear.jpg', 'Pear - Green, Imported, 3x2 pcs Multipack.<br>\r\nMRP:₹458<br>\r\nYou Save:27% OFF<br>\r\n(inclusive of all taxes)', 334, 8),
(3, 'Pomegranate', 'frut', 'Pomegranate.jpg', 'Pomegranate, 4 pcs (Approx. 800 g - 880 g).<br>\r\nMRP:₹230<br>\r\nYou Save:27% OFF<br>\r\n(inclusive of all taxes)', 168, 19),
(4, 'Lemon', 'vegetables', 'Lemon.jpg', 'Lemon - Organically Grown (Loose), 100 g.<br>\r\nMRP:₹19<br>\r\nYou Save:37% OFF<br>\r\n(inclusive of all taxes)\r\n', 12, 10),
(5, 'Turmeric', 'vegetables', 'Turmeric.jpg', 'Turmeric - Organically Grown (Loose), 1 kg<br>\r\nMRP:₹150<br>\r\nYou Save:27% OFF<br>\r\n(inclusive of all taxes)', 110, 36),
(6, 'Onion', 'vegetables', 'Onion.jpg', 'Onion, 5 kg Multipack<br>\r\nMRP:₹356<br>\r\nYou Save:27% OFF<br>\r\n(inclusive of all taxes)', 259, 15),
(7, 'Chilli Powder', 'spices', 'Chilli.jpg', 'Everest Tikhalal Chilli Powder/Menasina Pudi, 500 g Pouch<br>\r\nMRP:₹290<br>\r\nYou Save:₹17 OFF<br>\r\n(inclusive of all taxes)', 272, 40),
(8, 'Elachi', 'spices', 'Elachi.jpg', 'Royal Organic - Cardamom/Elachi Green, 2x50 g Multipack<br>\r\nMRP:₹504<br>\r\nYou Save:₹2 OFF<br>\r\n(inclusive of all taxes)', 502, 38),
(9, 'Jeera', 'spices', 'Jeera.jpg', 'Catch Jeera - Whole, 2x100 g Multipack<br>\r\nMRP:₹170<br>\r\nYou Save:35% OFF<br>\r\n(inclusive of all taxes)', 110, 47);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` double NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `password`, `address`, `city`, `state`) VALUES
(1, 'Vachhani Priyanshu K.', 9099144217, 'mr.xg0703@gmail.com', 'pri@0703', 'C-7 Sidhhnath Park, Opp Vaibhav Hall, Ghodasar', 'Ahmedabad', 'Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_item`
--
ALTER TABLE `ordered_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordered_item`
--
ALTER TABLE `ordered_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
