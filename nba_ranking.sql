-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 04:38 PM
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
-- Database: `nba_ranking`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` enum('PG','SG','SF','PF','C') NOT NULL,
  `status` enum('Active','Retired') NOT NULL DEFAULT 'Active',
  `rings` int(11) DEFAULT 0,
  `mvp` int(11) DEFAULT 0,
  `fmvp` int(11) DEFAULT 0,
  `dpoy` int(11) DEFAULT 0,
  `roty` int(11) DEFAULT 0,
  `mip` int(11) DEFAULT 0,
  `sixth_man` int(11) DEFAULT 0,
  `all_nba` int(11) DEFAULT 0,
  `all_def` int(11) DEFAULT 0,
  `ppg_lc` int(11) DEFAULT 0,
  `rpg_lc` int(11) DEFAULT 0,
  `apg_lc` int(11) DEFAULT 0,
  `spg_lc` int(11) DEFAULT 0,
  `bpg_lc` int(11) DEFAULT 0,
  `retired_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `position`, `status`, `rings`, `mvp`, `fmvp`, `dpoy`, `roty`, `mip`, `sixth_man`, `all_nba`, `all_def`, `ppg_lc`, `rpg_lc`, `apg_lc`, `spg_lc`, `bpg_lc`, `retired_order`, `created_at`, `updated_at`) VALUES
(1, 'LeBron James', 'SF', 'Retired', 4, 4, 4, 0, 1, 0, 0, 18, 6, 1, 0, 0, 0, 0, 1, '2026-03-30 11:45:35', '2026-03-30 14:15:42'),
(2, 'Luka Doncic', 'PG', 'Retired', 4, 4, 4, 0, 1, 0, 1, 15, 1, 3, 0, 0, 0, 0, 2, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(3, 'Kobe Bryant', 'SG', 'Retired', 5, 1, 2, 0, 0, 0, 0, 15, 12, 2, 0, 0, 0, 0, 3, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(4, 'Tim Duncan', 'PF', 'Retired', 4, 2, 2, 0, 0, 0, 0, 11, 11, 0, 0, 0, 0, 0, 4, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(5, 'Shaquille O\'Neal', 'C', 'Retired', 4, 1, 3, 0, 0, 0, 0, 8, 3, 1, 0, 0, 0, 0, 5, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(6, 'Giannis Antetokounmpo', 'PF', 'Retired', 2, 2, 2, 3, 0, 1, 0, 12, 9, 0, 1, 0, 0, 0, 6, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(7, 'Nikola Jokic', 'C', 'Retired', 3, 3, 1, 0, 0, 0, 0, 11, 0, 0, 4, 0, 0, 0, 7, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(8, 'Byron De la Cruz', 'C', 'Active', 3, 3, 0, 0, 0, 0, 0, 13, 0, 1, 1, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(9, 'Kevin Durant', 'SF', 'Retired', 2, 1, 2, 0, 1, 0, 0, 10, 0, 5, 0, 0, 0, 0, 8, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(10, 'Stephen Curry', 'PG', 'Retired', 3, 2, 0, 0, 0, 0, 0, 9, 0, 1, 0, 0, 1, 0, 9, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(11, 'Kevin Garnett', 'PF', 'Retired', 1, 1, 0, 1, 0, 0, 0, 8, 12, 0, 3, 0, 0, 0, 10, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(12, 'Alan Samuel', 'PG', 'Active', 0, 2, 0, 0, 0, 1, 0, 10, 9, 0, 0, 0, 1, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(13, 'Kawhi Leonard', 'SF', 'Retired', 3, 0, 3, 2, 0, 0, 0, 2, 7, 0, 0, 0, 1, 0, 11, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(14, 'Brian Wingate', 'PG', 'Active', 3, 0, 3, 0, 0, 0, 0, 5, 0, 1, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(15, 'Dirk Nowitzki', 'PF', 'Retired', 1, 1, 1, 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 12, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(16, 'Bruce Jameson', 'SF', 'Retired', 1, 1, 1, 0, 1, 0, 0, 8, 2, 0, 0, 0, 0, 0, 13, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(17, 'Patrick Perry', 'SF', 'Active', 0, 2, 0, 3, 1, 0, 0, 3, 4, 0, 0, 0, 2, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(18, 'Dwyane Wade', 'SG', 'Retired', 3, 0, 1, 0, 0, 0, 0, 8, 0, 1, 0, 0, 0, 0, 14, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(19, 'Russell Westbrook', 'PG', 'Retired', 1, 1, 0, 0, 0, 0, 0, 9, 0, 2, 0, 1, 0, 0, 15, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(20, 'Dwight Howard', 'C', 'Retired', 1, 0, 0, 3, 0, 0, 0, 8, 5, 0, 6, 0, 0, 2, 16, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(21, 'Steve Nash', 'PG', 'Retired', 0, 2, 0, 0, 0, 0, 0, 7, 0, 0, 0, 5, 0, 0, 17, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(22, 'Coty Sessions', 'PG', 'Active', 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 5, 2, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 14:15:58'),
(23, 'Elden Alexander', 'PG', 'Active', 1, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 4, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(24, 'Joel Embiid', 'C', 'Retired', 0, 1, 0, 1, 0, 0, 0, 9, 5, 1, 0, 0, 0, 1, 18, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(25, 'James Harden', 'SG', 'Retired', 0, 1, 0, 0, 0, 0, 1, 9, 0, 1, 0, 1, 0, 0, 19, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(26, 'Paulo Carlos', 'C', 'Active', 0, 1, 0, 0, 0, 0, 0, 3, 5, 0, 4, 0, 0, 1, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(27, 'Ruben Pessoa', 'C', 'Active', 1, 1, 0, 2, 1, 0, 0, 6, 6, 0, 2, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(28, 'Chris Paul', 'PG', 'Retired', 0, 0, 0, 0, 1, 0, 0, 8, 9, 0, 0, 5, 7, 0, 20, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(29, 'Laurence Petersen', 'SF', 'Active', 1, 0, 1, 0, 0, 0, 0, 3, 1, 2, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(30, 'Maurice Matthews', 'PF', 'Retired', 0, 1, 0, 1, 1, 0, 0, 5, 4, 0, 3, 0, 0, 0, 21, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(31, 'Anthony Davis', 'PF', 'Retired', 2, 0, 0, 1, 1, 0, 0, 7, 7, 0, 0, 0, 0, 3, 22, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(32, 'Cliff Lowry', 'C', 'Active', 1, 0, 0, 2, 1, 0, 0, 0, 8, 0, 1, 0, 0, 2, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(33, 'Derek Quinn', 'PG', 'Active', 2, 1, 2, 0, 0, 0, 0, 5, 3, 1, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(34, 'Kyle Anderson', 'C', 'Retired', 1, 0, 0, 2, 1, 0, 0, 4, 10, 0, 0, 0, 0, 2, 23, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(35, 'Allen Iverson', 'PG', 'Retired', 0, 1, 0, 0, 0, 0, 0, 6, 0, 4, 0, 0, 3, 0, 24, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(37, 'Dylan Gardner', 'SG', 'Active', 1, 0, 0, 0, 0, 0, 0, 6, 0, 1, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(38, 'Trae Young', 'PG', 'Retired', 1, 0, 1, 0, 1, 0, 0, 8, 0, 2, 0, 2, 0, 0, 25, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(39, 'Donte Forte', 'C', 'Active', 1, 0, 1, 0, 1, 0, 0, 4, 2, 0, 0, 0, 0, 1, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(40, 'Vincent Samuels', 'PF', 'Active', 1, 0, 0, 0, 1, 0, 0, 11, 1, 1, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(41, 'Claude Galloway', 'SG', 'Active', 1, 0, 0, 0, 0, 0, 0, 8, 6, 0, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(42, 'Paul James', 'PF', 'Active', 0, 0, 0, 0, 1, 0, 0, 9, 2, 0, 0, 0, 0, 0, NULL, '2026-03-30 11:45:35', '2026-03-30 11:45:35'),
(45, 'Jason Tatum', 'SF', 'Retired', 1, 0, 0, 0, 0, 0, 0, 7, 0, 1, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(46, 'Reggie Lopez', 'SG', 'Retired', 1, 0, 1, 0, 0, 1, 0, 7, 0, 2, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(47, 'Paul George', 'SF', 'Retired', 2, 0, 0, 0, 0, 0, 0, 5, 6, 0, 0, 0, 1, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(48, 'Jason Kidd', 'PG', 'Retired', 1, 0, 0, 0, 0, 0, 0, 5, 8, 0, 0, 4, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(49, 'Jrue Holiday', 'PG', 'Retired', 2, 0, 0, 1, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(50, 'Damian Lillard', 'PG', 'Retired', 0, 0, 0, 0, 1, 0, 0, 8, 0, 1, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(51, 'Dejounte Murray', 'PG', 'Retired', 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 0, 0, 3, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(52, 'Ryan Ware', 'PG', 'Active', 0, 1, 0, 0, 1, 0, 0, 6, 1, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(53, 'Carl Reeves', 'SG', 'Active', 1, 0, 1, 0, 0, 0, 0, 1, 6, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(54, 'Wade Larson', 'PF', 'Active', 0, 0, 0, 1, 0, 1, 0, 3, 4, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(55, 'Bryant Carson', 'PF', 'Active', 0, 0, 0, 0, 0, 1, 0, 9, 0, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(56, 'Frank Cartwright', 'PG', 'Active', 1, 0, 1, 0, 0, 0, 0, 6, 2, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(57, 'Wally Maggette', 'C', 'Retired', 1, 0, 0, 1, 0, 0, 0, 0, 7, 0, 2, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(58, 'Mikael Larsson', 'PF', 'Active', 1, 0, 0, 0, 0, 0, 0, 2, 3, 0, 0, 0, 1, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(59, 'Lonny Coles', 'PF', 'Active', 0, 1, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, NULL, '2026-03-30 12:46:48', '2026-03-30 12:46:48'),
(62, 'JJ Rooks', 'PG', 'Active', 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 0, 0, 0, 0, NULL, '2026-03-30 14:15:21', '2026-03-30 14:15:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_retired_order` (`retired_order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
