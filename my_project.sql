-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 05:11 PM
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
-- Database: `my project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Zaki Jonathan', 'zakijonathan3@gmail.com', '$2y$10$NTXEwCptQDb9QQwKcb8J3uImqeaWcviS.Go.vtcY2Ht33mF8e.iaO');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `slot` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `fullname`, `department`, `password`, `email`, `phone`, `slot`) VALUES
(5, 'Dr. Johnson', 'Eye Care', '$2y$10$CMCbJJAkjVnwTX0pYp41r.toq8NeTdFsZBwUG.I/.95IGEx/PCcKS', 'johnson@zion.com', '08123456789', 0),
(6, 'victor Aguh', 'Dentist', '$2y$10$YN97Z66S/qp8SU1ishLf3e6g0kWbdzYzyc7E1ZebRk0rVQSICwXTW', 'victor@gmail.com', '09098765432', 0),
(7, 'James Brown', 'Dentist', '$2y$10$u3rqDGTow.UFArmKiPZp5eSrVEIG30eNgMwwvsL9NBkJDZQ3c6Z5u', 'james@brown.com', '09123456789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `patientname` varchar(255) NOT NULL,
  `departments` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `your_email` varchar(255) NOT NULL,
  `your_phone` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `patientname`, `departments`, `doctor`, `your_email`, `your_phone`, `date`, `time`, `comments`, `status`, `reply`) VALUES
(9, '25', 'John Doe', 'Eye Care', 'Dr. Johnson', 'johndoe@gmail.com', '09035279803', '2024-07-10', '4:50', 'Comment2', 'Approved', 'We shall meet'),
(12, '32', 'jona xaki', 'Eye Care', 'Dr. Johnson', 'jonazaki@gmail.com', '07035279803', '2024-07-30', '8:00', 'hello', 'Declined', 'im not available'),
(14, '33', 'Zaki Jonathan', 'Dentist', 'James Brown', 'zakijonathan3@gmail.com', '09035279803', '2024-08-07', '8:00', 'hello james', 'Approved', 'hey zaki'),
(15, '32', 'jona xaki', 'Dentist', 'James Brown', 'jonazaki@gmail.com', '07035279803', '0000-00-00', '7:20', '12345678', 'Pending', 'Waiting for doctor\'s reply');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`) VALUES
(29, 'Zaki Jona', 'zakijona@gmail.com', '0903527980', '$2y$10$6iuPQp3BXa/NqOc5Wf7nzu9WKuN5ZqOW7CGXQE9/vmvEqCXGe61O2', '2024-07-09 11:33:29'),
(31, 'Johnson Mike', 'johnsonmike@gmail.com', '09124356789', '$2y$10$weh4DR54x/BCJeegUgWB7.PFjGp8ToQVdO3TMYtciYnwJs65EBaZq', '2024-07-10 12:32:34'),
(32, 'jona xaki', 'jonazaki@gmail.com', '07035279803', '$2y$10$gWQdd6QDwVErhcMiNh0xZemf/HFgkiFxaRUFffjmTTvjWhoEw0qyW', '2024-07-11 10:24:32'),
(33, 'Zaki Jona', 'zakijonathan@gmail.com', '08123456789', '$2y$10$NTXEwCptQDb9QQwKcb8J3uImqeaWcviS.Go.vtcY2Ht33mF8e.iaO', '2024-07-11 10:50:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
