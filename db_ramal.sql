-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 08:11 AM
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
-- Database: `db_ramal`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_beras`
--

CREATE TABLE `t_beras` (
  `id_beras` int(10) NOT NULL,
  `harga_beras` float NOT NULL,
  `bulan_beras` int(2) NOT NULL,
  `tahun_beras` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_beras`
--

INSERT INTO `t_beras` (`id_beras`, `harga_beras`, `bulan_beras`, `tahun_beras`) VALUES
(1, 13588, 1, '2024'),
(2, 14397, 2, '2024'),
(3, 14528, 3, '2024'),
(4, 13902, 4, '2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_beras`
--
ALTER TABLE `t_beras`
  ADD PRIMARY KEY (`id_beras`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_beras`
--
ALTER TABLE `t_beras`
  MODIFY `id_beras` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
