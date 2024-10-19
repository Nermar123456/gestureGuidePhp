-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 03:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_id` int(200) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_initial` varchar(10) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `number` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `sped` enum('Yes','No') NOT NULL,
  `pwd` enum('Yes','No') NOT NULL,
  `address` text DEFAULT NULL,
  `address_provice` varchar(100) NOT NULL,
  `address_municipality` varchar(100) NOT NULL,
  `address_barangay` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `profile_img` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_id`, `user_name`, `first_name`, `middle_name`, `last_name`, `middle_initial`, `ext`, `number`, `gender`, `birthday`, `age`, `nationality`, `sped`, `pwd`, `address`, `address_provice`, `address_municipality`, `address_barangay`, `zip_code`, `profile_img`, `created_at`) VALUES
(2, 2, 'admin', 'Shane Marie', 'Bernal', 'Sunga', 'B.', '', '09461781931', 'Female', '2002-06-27', '22', 'Filipino', 'No', 'No', 'Purok 2', 'Bulacan', 'Hagonoy', 'Sagrada Familia', '3002`', '', '2024-09-20 01:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `teacher_id` varchar(255) NOT NULL,
  `admin_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_image`, `category_name`, `created_at`, `teacher_id`, `admin_id`) VALUES
(33, 'uploads/category_image/alphabet.jpg', 'Alphabet', '2024-09-20 08:46:58', '', '2'),
(34, 'uploads/category_image/animals.jpg', 'Animals', '2024-09-20 08:47:15', '', '2'),
(35, 'uploads/category_image/colors.jpg', 'Colors', '2024-09-20 08:47:30', '', '2'),
(36, 'uploads/category_image/numbers.jpg', 'Numbers', '2024-09-20 08:47:45', '', '2'),
(37, 'uploads/category_image/5w\'s.jpg', '5 W\'s', '2024-09-20 08:48:34', '', '2'),
(38, 'uploads/category_image/shapes.jpg', 'Shapes', '2024-09-20 08:48:52', '', '2');

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
(17, '33', 'Aa', 'uploads/content_image/Aa.jpg', 'uploads/vids/A.mp4', '2024-09-20 09:29:46'),
(18, '33', 'Bb', 'uploads/content_image/Bb.jpg', 'uploads/vids/B.mp4', '2024-09-20 09:30:19'),
(19, '33', 'Cc', 'uploads/content_image/3.png', 'uploads/vids/C.mp4', '2024-09-20 09:30:45'),
(20, '33', 'Dd', 'uploads/content_image/4.png', 'uploads/vids/D.mp4', '2024-09-20 09:31:12'),
(21, '33', 'Ee', 'uploads/content_image/5.png', 'uploads/vids/E.mp4', '2024-09-20 09:31:43'),
(22, '33', 'Ff', 'uploads/content_image/6.png', 'uploads/vids/F.mp4', '2024-09-20 09:32:38'),
(23, '33', 'Gg', 'uploads/content_image/7.png', 'uploads/vids/G.mp4', '2024-09-20 09:33:07'),
(24, '33', 'Hh', 'uploads/content_image/8.png', 'uploads/vids/H.mp4', '2024-09-20 09:35:58'),
(25, '33', 'Ii', 'uploads/content_image/9.png', 'uploads/vids/I.mp4', '2024-09-20 09:36:36'),
(26, '33', 'Jj', 'uploads/content_image/10.png', 'uploads/vids/J.mp4', '2024-09-20 09:37:27'),
(27, '37', 'When', 'uploads/content_image/when.jpg', 'uploads/vids/When.mp4', '2024-09-20 09:38:23'),
(28, '37', 'Where', 'uploads/content_image/where.jpg', 'uploads/vids/Where.mp4', '2024-09-20 09:39:10'),
(29, '37', 'What', 'uploads/content_image/What.jpg', 'uploads/vids/What.mp4', '2024-09-20 09:42:20'),
(30, '37', 'Why', 'uploads/content_image/Why.jpg', 'uploads/vids/Why.mp4', '2024-09-20 09:43:04'),
(31, '37', 'Who', 'uploads/content_image/Who.jpg', 'uploads/vids/Who.mp4', '2024-09-20 09:43:33'),
(32, '35', 'Brown', 'uploads/content_image/brown.png', 'uploads/vids/Brown.mp4', '2024-09-20 10:09:47'),
(33, '35', 'Pink', 'uploads/content_image/pink.png', 'uploads/vids/Pink.mp4', '2024-09-20 10:10:20'),
(34, '35', 'White', 'uploads/content_image/white.png', 'uploads/vids/White.mp4', '2024-09-20 10:24:46'),
(35, '35', 'Green', 'uploads/content_image/green.png', 'uploads/vids/Green.mp4', '2024-09-20 10:25:12'),
(36, '35', 'Blue', 'uploads/content_image/blue.png', 'uploads/vids/Blue.mp4', '2024-09-20 10:25:58'),
(37, '35', 'Orange', 'uploads/content_image/orange.png', 'uploads/vids/Orange.mp4', '2024-09-20 10:26:39'),
(38, '35', 'Red', 'uploads/content_image/red.png', 'uploads/vids/Red.mp4', '2024-09-20 10:27:02'),
(39, '35', 'Gray', 'uploads/content_image/gray.png', 'uploads/vids/Grey.mp4', '2024-09-20 10:28:27'),
(40, '35', 'Yellow', 'uploads/content_image/yellow.png', 'uploads/vids/Yellow.mp4', '2024-09-20 10:29:17'),
(41, '35', 'Purple', 'uploads/content_image/purple.png', 'uploads/vids/Purple.mp4', '2024-09-20 10:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `content_progress`
--

CREATE TABLE `content_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `progress` int(11) NOT NULL DEFAULT 0,
  `total_lessons` int(11) NOT NULL,
  `date_learned` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `user_type`, `event_date`, `title`, `description`) VALUES
(1, '', '', '2024-09-17', 'Hello', 'Hello lang'),
(2, '', '', '2024-09-21', 'event', 'okay'),
(3, '', '', '2024-09-21', 'School', 'School');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `points` int(11) DEFAULT 0,
  `question_video` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_title`, `question`, `option_a`, `option_b`, `correct_answer`, `points`, `question_video`, `created_at`, `updated_at`) VALUES
(1, 'Alphabet', 'What does the animation mean', 'A', 'B', 'A', 1, NULL, '2024-10-16 10:36:38', '2024-10-16 10:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `questions old`
--

CREATE TABLE `questions old` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `points` int(100) NOT NULL,
  `question_video` varchar(255) DEFAULT NULL,
  `option_1` varchar(200) NOT NULL,
  `option_2` varchar(200) NOT NULL,
  `is_correct` varchar(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `teacher_id` varchar(200) NOT NULL,
  `admin_id` varchar(200) NOT NULL,
  `quiz_title` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `teacher_id`, `admin_id`, `quiz_title`, `created_at`, `updated_at`) VALUES
(7, '', '2', 'Quiz #7', '2024-10-06 09:55:01', '2024-10-06 15:55:01'),
(8, '', '2', 'Quiz #8', '2024-10-06 09:55:39', '2024-10-06 15:55:39'),
(9, '', '2', 'Quiz #9', '2024-10-06 10:04:11', '2024-10-06 16:04:11'),
(10, '', '2', 'Quiz #1', '2024-10-06 10:15:59', '2024-10-06 16:15:59'),
(11, '', '2', 'Quiz #5', '2024-10-06 10:20:45', '2024-10-06 16:20:45'),
(12, '', '2', 'Quiz #4', '2024-10-06 10:27:23', '2024-10-06 16:27:23'),
(13, '', '2', 'Quiz #6', '2024-10-06 10:28:51', '2024-10-06 16:28:51'),
(14, '', '2', 'Quiz #13', '2024-10-06 10:37:05', '2024-10-06 16:37:05'),
(15, '', '2', 'Quiz #12', '2024-10-06 10:39:49', '2024-10-06 16:39:49'),
(16, '', '2', 'Quiz #45', '2024-10-06 10:42:44', '2024-10-06 16:42:44'),
(17, '', '2', 'Quiz #51', '2024-10-06 11:47:41', '2024-10-06 17:47:41'),
(18, '', '2', 'Quiz #18', '2024-10-06 11:54:39', '2024-10-06 17:54:39'),
(19, '', '2', 'Quiz #56', '2024-10-06 11:59:07', '2024-10-06 17:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_score`
--

CREATE TABLE `quiz_score` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `date_taken` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_score`
--

INSERT INTO `quiz_score` (`id`, `user_id`, `quiz_title`, `score`, `total_questions`, `date_taken`) VALUES
(11, 57, 'Alphabet', 1, 1, '2024-10-06 13:21:24'),
(12, 57, '5w Quiz', 1, 2, '2024-10-07 06:12:38'),
(13, 57, '5w Quiz', 1, 2, '2024-10-07 08:56:53'),
(14, 57, 'Alphabet', 1, 1, '2024-10-07 08:57:24'),
(15, 57, 'Alphabet', 1, 1, '2024-10-07 09:28:44'),
(16, 57, 'Alphabet', 0, 1, '2024-10-07 09:29:04'),
(17, 57, '5w Quiz', 1, 2, '2024-10-07 09:29:33'),
(18, 57, '5w Quiz', 1, 2, '2024-10-07 11:03:15'),
(19, 57, 'Alphabet', 1, 1, '2024-10-10 17:21:05'),
(20, 57, '5w Quiz', 1, 2, '2024-10-10 17:22:41'),
(21, 59, 'Alphabet', 1, 1, '2024-10-10 17:32:45'),
(22, 59, '5w Quiz', 2, 2, '2024-10-10 17:33:24'),
(23, 61, '5w Quiz', 2, 2, '2024-10-14 08:23:04'),
(24, 61, '5w Quiz', 0, 2, '2024-10-14 14:27:41'),
(25, 61, 'Alphabet', 1, 1, '2024-10-17 22:44:48'),
(26, 61, 'Alphabet', 1, 1, '2024-10-17 22:45:44'),
(27, 61, 'Alphabet', 0, 1, '2024-10-17 23:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_user_responses`
--

CREATE TABLE `quiz_user_responses` (
  `response_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `score` varchar(50) NOT NULL,
  `selected_choice` enum('A','B') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` int(200) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_initial` varchar(20) NOT NULL,
  `ext` varchar(20) NOT NULL,
  `number` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` varchar(200) NOT NULL,
  `sped` enum('Yes','No') NOT NULL,
  `pwd` enum('Yes','No') NOT NULL,
  `address` text DEFAULT NULL,
  `address_provice` varchar(50) NOT NULL,
  `address_municipality` varchar(100) NOT NULL,
  `address_barangay` varchar(100) NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `lrn` varchar(20) DEFAULT NULL,
  `program` varchar(200) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `school_address` text DEFAULT NULL,
  `fathers_last_name` varchar(200) NOT NULL,
  `fathers_first_name` varchar(200) NOT NULL,
  `fathers_middle_name` varchar(200) NOT NULL,
  `mothers_last_name` varchar(200) NOT NULL,
  `mothers_first_name` varchar(200) NOT NULL,
  `mothers_middle_name` varchar(200) NOT NULL,
  `guardians_last_name` varchar(200) NOT NULL,
  `guardians_first_name` varchar(200) NOT NULL,
  `guardians_middle_name` varchar(200) NOT NULL,
  `guardians_contact_number` varchar(200) NOT NULL,
  `mothers_occupation` varchar(100) DEFAULT NULL,
  `fathers_occupation` varchar(100) DEFAULT NULL,
  `civil_status` enum('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `profile_img` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` int(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_initial` varchar(20) NOT NULL,
  `ext` varchar(20) NOT NULL,
  `number` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `sped` enum('Yes','No') NOT NULL,
  `pwed` enum('Yes','No') NOT NULL,
  `address` text DEFAULT NULL,
  `address_provice` varchar(50) NOT NULL,
  `address_municipality` varchar(100) NOT NULL,
  `address_barangay` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `bachelors_degree` varchar(100) DEFAULT NULL,
  `masteral_degree` varchar(100) NOT NULL,
  `doctorate` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `school_address` text DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `profile_img` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('teacher','student','admin') NOT NULL,
  `verification_code` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `user_type`, `verification_code`, `created_at`) VALUES
(2, 'admin', 'Admin@gmail.com', '$2y$10$bS8s.zJLk4GXFGNw9f5usON8il1q9gEwf7JSG5wOhiBvwom.CbIEK', 'admin', '', '2024-09-16 07:18:29'),
(3, 'shane', 'shanesunga027@gmail.com', '$2y$10$yXsJcIUXhtB9SvPOwORRyOVkiSVCzvfSv.ffzrTXcq3W50RsVC8Dy', 'teacher', '', '2024-09-16 08:09:10'),
(4, 'marie', 'marie@gmail.com', '$2y$10$7uyfWsKRybVGKXgLnjTeEu4cwUGJ6DnRaiDJYYHo6nfVoed4J/W1i', 'student', '', '2024-09-16 13:22:25'),
(5, 'avel', 'avel@gmail.com', '$2y$10$ZtmsOKzBKtcWz52/fetQ0OtLHjSu/xBdnnRa9kZNuR5c/1.PKS5iu', 'student', '', '2024-09-16 14:06:32'),
(6, 'nermar', 'nermar@gmail.com', '$2y$10$/hMycLAw9NvLdE5/KPoFpOoNfWzRjfnm.PnggM6w9r0qp6PmFYOB.', 'student', '', '2024-09-16 14:08:49'),
(7, 'emcel', 'emcel@gmail.com', '$2y$10$LvFE3Z8UnAGWq2I7r9YJ5eQovtJ2PKG3Oe4cHuP7jS1XDWuIycxm.', 'student', '', '2024-09-17 05:10:28'),
(8, 'lance', 'lance@gmail.com', '$2y$10$aVdfEkp/frNVFUrNAOdfEeKXwmnrX9uErfuWb3hKGjJuvNyfu4mhO', 'student', '', '2024-09-17 13:49:47'),
(9, 'eds', 'eds@gmail.com', '$2y$10$W/N6y7AATQbD/xNQSer6au1NpzYWVP5Xs0LndWehWY8j9qRgnow4y', 'student', '', '2024-09-20 00:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `lrn` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `middleName` text NOT NULL,
  `middleInitial` text NOT NULL,
  `suffix` text NOT NULL,
  `birthday` date DEFAULT NULL,
  `number` int(255) NOT NULL,
  `address` text NOT NULL,
  `apiKey` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`user_id`, `name`, `username`, `email`, `password`, `lrn`, `firstName`, `lastName`, `middleName`, `middleInitial`, `suffix`, `birthday`, `number`, `address`, `apiKey`) VALUES
(36, '', 'e', 'e', '$2y$10$Up1S16/vX62RKZLW/1UTk.ii6p/3UZThqEAQHN7kajWfvPUuF6qRK', 0, 'e', 'e', 'e', 'e', 'e', '0000-00-00', 1234, 'hagonoy', 'cda575438e0e7a48aadc65c6276562957ccf5a042c7575'),
(47, '', 'second', 'second', '$2y$10$gXmz0ZyLTBXyG6xBgmL9Bek.9plu9lYJzPh6rtDmZBtw4vJ3aE1K.', 1048999, 'second', 'acc', 's', 's', 's', '2024-02-02', 1, 'second plas update naguupdate', 'd2af2f5e1b9543dc2599c135a202b43697a05adfca6b08'),
(48, '', 'a', 'a', '$2y$10$Rx3dUMdkwOjDtuZ8lSwUOusMBZB5Cu2tl8/JVZZJh7pA7fGo9GXN.', 100, 'a', 'a', 'a', 'a', 'a', '2001-02-02', 12341, 'a', ''),
(57, '', 'usernameplsupdate pls', 'email@gmail.com', '$2y$10$i5IOl4iWQx7y/aN/t.yZjeYJehfNc43Oxiykq0Calywpa9hlVhAR6', 1048, 'helloupdate pls', 'lastupdate pls', 'middleupdate pls', 'mupdate pls', 'plsjrupdate', '2000-02-01', 909091, 'address udate233 pls12', ''),
(58, '', 'name123', 'a@gmail.com', '$2y$10$UNEDeogcnjKrQiE22mB3Ke.JLYRJcCy.6yw42yg3wIloyprwkds12', 1048, 'first', 'last', 'middle', 'M', 'Jr.', '2000-01-02', 2147483647, 'sta monica hagonoy bulacan', '40092005d05951bc257fe1b843153fe8e05f50e1231691'),
(59, '', 'sampleusername', 'sampleusername@gmail.com', '$2y$10$Qr6mYwUwWG9sSESkzAKcCOzHEQVh4xtzEkQ.HZQt..4sxSXyzkn7y', 104848, 'samplefirstname', 'samplelastname', 'samplemiddle', 's', 'Jr.', '2003-01-03', 91234, 'Hagonoy,Bulacan', ''),
(60, '', 'samplename', 'samplename@gmail.com', '$2y$10$PjJYr4.JK/IUroP5XXn29Oe4lmPcV7qQ.SuNDd0Ey5nqeo7hPebYS', 104849, 'samplename', 'samplename', 'samplemiddle', 's', 'Jr.', '2003-05-03', 923478, 'Hagonoy', '72f923d5077c2fe0492249598559103b24eb90b36d98bf'),
(61, '', 'samplephone', 'phone@gmail.com', '$2y$10$4gjXgUdHMLVE9PxR3Pv5Xu7.FdUbOTaT2Qg6GeiZ7bAPh8Z/tpXMq', 1048, 'phone', 'phonelast', 'phonemiddle', 'P', 'jr', '2024-01-01', 1237, 'hagonoy, bulcana', '625e49a9d3c9556c8530c9a09148a5fa6612c5a7c59b8c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `content_progress`
--
ALTER TABLE `content_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions old`
--
ALTER TABLE `questions old`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_score`
--
ALTER TABLE `quiz_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quiz_user_responses`
--
ALTER TABLE `quiz_user_responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `content_progress`
--
ALTER TABLE `content_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions old`
--
ALTER TABLE `questions old`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quiz_score`
--
ALTER TABLE `quiz_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `quiz_user_responses`
--
ALTER TABLE `quiz_user_responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions old`
--
ALTER TABLE `questions old`
  ADD CONSTRAINT `questions old_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_user_responses`
--
ALTER TABLE `quiz_user_responses`
  ADD CONSTRAINT `quiz_user_responses_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_user_responses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions old` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
