-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220715.346923e20a
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2022 at 08:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(65, 9, 'Marvell', 100, 1, '39f146621b0eb9c90bca49a38a7d060f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `id` int(255) NOT NULL,
  `user_name` varchar(500) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_number` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `story_name` varchar(500) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`id`, `user_name`, `user_email`, `user_number`, `image`, `story_name`, `type`) VALUES
(1, 'Farhan', 'farhan@gmail.com', '2147483647', 'Product Description exhaust fan (1).pdf', 'Knowledge is power', ''),
(2, 'Farhan', 'farhan@gmail.com', '2147483647', '_islam_pdfsurat_Arabic_Surah-Mulk-in-Arabic (1).pdf', 'ghjkfhyjk', ''),
(3, 'Farhan', 'farhan@gmail.com', '1234-5678', 'project.txt', 'rshyrsh', ''),
(4, 'Farhan', 'farhan@gmail.com', '03368138514', 'r.txt', 'tdkidkdykd', ''),
(5, 'Farhan', 'farhan@gmail.com', '03323848012', 'E-Books.doc', 'Lost Girl', ''),
(6, 'Farhan', 'farhan@gmail.com', '47553753', 'uploaded_file/Project Specification (E-Books) -OST.doc', 'djftgj', ''),
(7, 'Farhan', 'farhan@gmail.com', '03368138514', 'imp.txt', 'aesgvadg', ''),
(8, 'aliyan', 'aliyanmuhammad840@gmail.com', '03368138514', 'Product Description exhaust fan (1).pdf', '', 'essay'),
(9, 'aliyan', 'aliyanmuhammad840@gmail.com', '03368138514', '_islam_pdfsurat_Arabic_Surah-Mulk-in-Arabic (1).pdf', 'Independence Day', 'essay'),
(10, 'Ahmed', 'ahmed@gmail.com', '03368138514', 'license.txt', 'ryeryery', 'story'),
(11, 'Ahmed', 'ahmed@gmail.com', '4574574576', '_islam_pdfsurat_Arabic_Surah-Mulk-in-Arabic (1).pdf', 'Independence Day', 'essay'),
(12, 'Ahmed', 'ahmed@gmail.com', '4564265423', 'Product Description exhaust fan (1).pdf', 'Independence Day', 'essay'),
(13, 'Ahmed', 'ahmed@gmail.com', '4574687', 'Product Description exhaust fan (1).pdf', 'Independence Day', 'essay'),
(14, 'Ahmed', 'ahmed@gmail.com', '65346437', '_islam_pdfsurat_Arabic_Surah-Mulk-in-Arabic (1).pdf', 'Independence Day', 'essay');

-- --------------------------------------------------------

--
-- Table structure for table `essays`
--

CREATE TABLE `essays` (
  `id` int(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `essay_lines` int(40) NOT NULL,
  `start_date` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `end_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `essays`
--

INSERT INTO `essays` (`id`, `name`, `essay_lines`, `start_date`, `end_date`) VALUES
(2, 'Independence Day', 35, '2022-08-02 23:03:08', '2022-08-02 23:35');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`, `user_type`) VALUES
(11, 2, 'MUHAMMAD ALIYAN', 'aliyan@gmail.com', '5747537', 'cgjjttgcjtcgj', 'user'),
(13, 5, 'Publisher', 'publisher@gmail.com', '03323848012', 'I need my payement.', 'publisher'),
(14, 5, 'hrshsr', 'rt605re@gmail.com', '46564', 'fhfrhsrfxh', 'publisher'),
(15, 2, 'aliyan', 'aliyan@gmail.com', '75474545', 'dtjcgtjtdxcej', 'user'),
(16, 5, 'Publisher', 'publisher@gmail.com', '23532', 'I received it.', 'publisher'),
(17, 2, 'aliyan', 'aliyanmuhammad840@gmail.com', '03368138514', 'hi i like your website styling and developement and want to meet the developer of this site.\r\n\r\nThanks,\r\n\r\nRegards, ', 'user'),
(18, 2, 'aliyan', 'aliyanmuhammad840@gmail.com', '03368138514', 'I like it.', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `card_name` varchar(500) NOT NULL,
  `card_number` varchar(500) NOT NULL,
  `exp_month` varchar(40) NOT NULL,
  `exp_year` varchar(18) NOT NULL,
  `cvv` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `card_name`, `card_number`, `exp_month`, `exp_year`, `cvv`) VALUES
(10, 2, 'Muhammad Aliyan', '03368138514', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 605, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 0876', ', Marvell (1) ', 100, '07-Jul-2022', 'completed', '', '', '', '', 0),
(12, 4, 'Ali', '03312849040', 'ali@gmail.com', 'cash on delivery', 'flat no. 65, uddrtgfthdjk, Karachi, Pakistan - 56565', ', Marvell (5) , Harry Potter (2) ', 650, '08-Jul-2022', 'completed', '', '', '', '', 0),
(13, 2, 'jhbhkb', '8978908', 'rt605re@gmail.com', 'cash on delivery', 'flat no. 908, ythvghvj, ghbjn, ijkm - 809', ', Lost Bike (1) , Marvell (1) , Harry Potter (2) ', 375, '16-Jul-2022', 'completed', '', '', '', '', 0),
(14, 2, 'Muhammad Aliyan', '03312849040', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 56, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 71442', ', Marvell (1) ', 100, '24-Jul-2022', 'pending', '', '', '', '', 0),
(15, 2, 'Aliyan', '03368138514', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 46, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 76543', ', Lost Book (1) , Harry Potter (1) ', 395, '24-Jul-2022', 'completed', '', '', '', '', 0),
(16, 2, 'rydxy', '03323848012', 'aliyanmuhammad840@gmail.com', 'paytm', 'flat no. 7576, hbjjhjhv-889hbjk, Karachi, Pakistan - 575', ', Lost Book (1) ', 320, '24-Jul-2022', 'completed', '', '', '', '', 0),
(17, 2, 'Admin', '64363', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 45, 35gcj, tfgjxj, xhfhyx - 45634', ', Marvell (1) ', 100, '24-Jul-2022', 'pending', '', '', '', '', 0),
(18, 2, 'Aliyan', '03368138514', 'aliyanmuhammad840@gmail.com', 'credit card', 'flat no. 454, gdhtdhdh, Karachi, Pakistan - 4244', ', Lost Book (1) ', 320, '25-Jul-2022', 'pending', '', '', '', '', 0),
(19, 2, 'Alliyan', '03323848012', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 34, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 53534', ', Marvell (1) ', 100, '25-Jul-2022', 'pending', '', '', '', '', 0),
(20, 2, 'Muhammad Aliyan', '03368138514', 'aliyanmuhammad840@gmail.com', 'credit card', 'flat no. 5232, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 42242', ', Lost Book (1) ', 320, '25-Jul-2022', 'pending', '', '', '', '', 0),
(21, 2, 'Muhammad Aliyan', '03368138514', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 4423, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 42242', ', Lost Book (1) ', 320, '25-Jul-2022', 'pending', '', '', '', '', 0),
(22, 2, 'MUHAMMAD ALIYAN', '03368138514', 'aliyanmuhammad840@gmail.com', 'credit card', 'address. R-605 sector 11 c/1  north karachi, Karachi, Sindh, Pakistan - 6969', ', Harry Potter (1) ', 75, '25-Jul-2022', 'pending', 'Aliyan Irfan', '68568588568', 'ityiy', '8766', 8588),
(23, 2, 'Ali', '03368138514', 'aliyanmuhammad840@gmail.com', 'cash on delivery', 'flat no. 78, sector 11 c-1 near bi-amma park, north karachi, sir syed town., Karachi, Pakistan - 9867', ', Harry Potter (1) , Marvell (1) ', 175, '30-Jul-2022', 'pending', '', '', '', '', 0),
(24, 2, 'Ali', '03368138514', 'aliyanmuhammad840@gmail.com', 'credit card', 'address. R-605 sector 11 c/1  north karachi, Karachi, Sindh, Pakistan - 71500', ', Harry Potter (1) ', 75, '30-Jul-2022', 'pending', 'Aliyan Irfan', '213414141414', 'march', '2023', 456);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `p_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `p_id`) VALUES
(1, 'Harry Potter', 'Horror', 75, '12-120163_horror-wallpaper-hd-art-wallpaper-desktop-wallpapers-horror.jpg', 5),
(2, 'Marvell', 'Interesting', 100, '39f146621b0eb9c90bca49a38a7d060f.jpg', 5),
(10, 'Lost Book', 'Horror', 320, 'background.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(2, 'aliyan', 'aliyanmuhammad840@gmail.com', '86318e52f5ed4801abe1d13d509443de', 'user'),
(3, 'Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(5, 'Publisher', 'publisher@gmail.com', '6b41a85447824eb15d706915e4d6d9db', 'publisher/client'),
(9, 'Farhan', 'farhan@gmail.com', 'dd12627d9394835d4c4f824c08bdb38b', 'user'),
(10, 'Ahmed', 'ahmed@gmail.com', '9193ce3b31332b03f7d8af056c692b84', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essays`
--
ALTER TABLE `essays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `essays`
--
ALTER TABLE `essays`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
