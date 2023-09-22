-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2023 at 07:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perso`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46'),
(2, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46'),
(3, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46'),
(4, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46'),
(5, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46'),
(6, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46'),
(7, 'bnvcnbvnbv', 'vbncvncvnvcncvnvcbnvcncvbhcvgngcfncvgncvg', '2023-09-19 16:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `roles` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `roles`) VALUES
(1, 'ddd', 'test@oi.f', '$argon2id$v=19$m=65536,t=4,p=1$SFFCTWxlcGJrL0gydWxaLg$iYl2neLI1lSQtd2yz0GO9nKHcZ7YAa1wOWMd8JH8TZY', '[\"ROLE_USER\"]'),
(2, 'ddd', 'test@oi.f', '$argon2id$v=19$m=65536,t=4,p=1$NllpZWova3Eua2FUSEdNVw$UZSHO5bLGNvlPU26L3A5nsZQhLOFqIfGRIk49SKfZ6Y', '[\"ROLE_USER\"]'),
(3, 'sss', 'test@b.c', '$argon2id$v=19$m=65536,t=4,p=1$VWNpUkNxZUhkbTk5bkpaLg$Hy+xw6VAMCuvNGn3nwKDgq6Bm+2zIf5XtD6CMP/v0c8', '[\"ROLE_USER\"]'),
(4, 'sss', 'a@b.c', '$argon2id$v=19$m=65536,t=4,p=1$cXU4Wld2SmxsRFd6ck8vRw$8unp7lQPLICCBDQZKcG0QBVJBnMkzoZiUJzuWS9taqw', '[\"ROLE_USER\"]'),
(5, 'sdfsdf', 'test@b.c', '$argon2id$v=19$m=65536,t=4,p=1$d2p3SEQ2Q0ZZYS8uZlFTTw$hegPNuemMTb6irPWa6Gnhu/phi1ArthMF6hil0yGXd8', '[\"ROLE_USER\"]'),
(6, '1546464', '123@h.j', '$argon2id$v=19$m=65536,t=4,p=1$dzJITzNxaEJGejVRYjVhaA$WDt0cTj4nmyLK4PcGHNPSApSWN6LlWBQU8iIwr+wie0', '[\"ROLE_USER\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
