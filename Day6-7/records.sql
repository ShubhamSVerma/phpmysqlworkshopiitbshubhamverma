-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 10:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass_word` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass_word`) VALUES
(1, 'noiul', 'xotwoo');

-- --------------------------------------------------------

--
-- Table structure for table `admin_student`
--

CREATE TABLE `admin_student` (
  `record_id` int(11) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `PHP` int(100) NOT NULL,
  `MySQL` int(100) NOT NULL,
  `HTML` int(100) NOT NULL,
  `total_obtained` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `percent` float NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_student`
--

INSERT INTO `admin_student` (`record_id`, `student_email`, `PHP`, `MySQL`, `HTML`, `total_obtained`, `total`, `percent`, `Status`) VALUES
(1, 'noiul@gmail.com', 89, 90, 92, 271, 300, 90.3333, 'PASS'),
(8, 'shubhamsv01@gmail.com', 99, 98, 94, 291, 300, 97, 'PASS'),
(9, 'shusa@gmail.com', 89, 88, 90, 267, 300, 89, 'PASS'),
(14, 'vermashusa18it@student.mes.ac.in', 97, 99, 96, 292, 300, 97.3333, 'PASS'),
(15, 'faith@gmail.com', 45, 67, 56, 168, 300, 56, 'FAIL');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass_word` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `email`, `pass_word`) VALUES
(4, 'Noiul1', 'noiul@gmail.com', 'awert'),
(5, 'ShubhamSV', 'shubhamsv01@gmail.com', 'yes'),
(6, 'shusa', 'shusa@gmail.com', 'Yes@12345'),
(8, 'Noiul_123', 'vermashusa18it@student.mes.ac.in', 'Forgot@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_student`
--
ALTER TABLE `admin_student`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_student`
--
ALTER TABLE `admin_student`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
