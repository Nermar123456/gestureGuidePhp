-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 02:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gesture_guide`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_image`, `category_name`, `created_at`, `user_id`, `mime_type`) VALUES
(25, 'uploads/category_image/animals.jpg', 'Animals', '2024-09-03 22:50:44', 31, NULL),
(26, 'uploads/category_image/alphabet.jpg', 'Alphabet', '2024-09-03 22:52:50', 31, NULL),
(27, 'uploads/category_image/5w\'s.jpg', '5 W\'s', '2024-09-03 23:04:59', 31, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(255) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `content_name` varchar(200) NOT NULL,
  `content_image` varchar(255) NOT NULL,
  `content_video` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `category_id`, `content_name`, `content_image`, `content_video`, `created_at`) VALUES
(13, '26', 'Aa', 'uploads/content_image/Aa.jpg', 'uploads/vids/Letter A.mp4', '2024-09-03 22:53:20'),
(14, '27', 'When', 'uploads/content_image/when.jpg', 'uploads/vids/When.mp4', '2024-09-03 23:08:40'),
(15, '27', 'Where', 'uploads/content_image/where.jpg', 'uploads/vids/Where.mp4', '2024-09-03 23:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `number`, `gender`, `birthday`, `password`, `address`, `user_type`, `image`) VALUES
(10, 'mikasa', 'mikawa', 'mikasa@gmail.com', '6578912345', 'female', '2006-03-05', '$2y$10$a5SQAAbwAXU/CJexcQcIsuD6//EVczhtQ9bSi.zMDkl/fFF4SczHG', 'malayoS', 'user', ''),
(20, 'joselita', 'jose', 'jose@gmail.com', '35468', 'male', '1982-07-06', '$2y$10$ySq6q9R/juH9kJVJSW7SK.iLRJlTAfXqcSfBdvbg4KlYdedmluewS', 'mirigunDONHG', 'user', ''),
(22, 'simon', 'simon ', 'simon@example.com', '1234590', 'male', '1993-05-01', '$2y$10$S2bjCbxQRM4PYJOVa23jM.6Z0y4ycgPyquDlvBB5e1k7h3N2qSfmq', 'marigundong', 'user', ''),
(24, 'Shane Sunga', 'diwata', 'shanesunga027@gmail.com', '234234', 'female', '2001-04-02', '$2y$10$EQ1hxbkEOgpikzz1NfIguuPOwAGaa2T2ktu649Dn0axHOWw1kYPBC', 'Paombong bulacan', 'user', ''),
(25, 'marivel', 'mars', 'mars@gmail.com', '5444545', 'male', '2000-02-23', '$2y$10$cvmfL1T3PD6XrFGOykqu7.KfH4MUJRf/mAjaSk4YJ0KfZOmdi/hke', 'mayo ang umaga', 'user', ''),
(27, 'dha', 'qwery', 'dha@gmail.com', '09461781931', 'female', '4556-03-05', '$2y$10$gaZ/qReWZYssU5Og.ZE.JuPWXVUDGXpJYgH7dr1I8dOqo1Ui3qE/.', 'sapang', 'user', ''),
(28, 'amy', 'amy', 'amy@gmail.com', '4567890', 'female', '1981-03-04', '$2y$10$OWD88cjL8RQWEYz82z6A/eD6CzdUUw31Jtw5qhBu8ODkKT1LA/GK.', '', 'user', ''),
(31, 'wencyysssxxxx', '', 'wencyy@gmail.com', '345678', 'female', '2024-08-07', '$2y$10$tjnihVf1D9Fj0weMqdzfT.U1joQzPu5b8KEBWd/Ql63/V9HVYHTqm', 'matayog', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
