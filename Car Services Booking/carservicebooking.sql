-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 02:16 PM
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
-- Database: `carservicebooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`fName`, `lName`, `username`, `password`, `email`, `address`, `contactNo`, `dob`, `role`) VALUES
('Adam', 'Harris', 'reez9171', 'adam', 'adam@gmail.com', 'Sri Rampai', '0109171', '2007-02-14', 'Customer'),
('Alya', 'Karmilla', 'admin2', 'dbgroup4', 'alya@gmail.com', 'Jalan Arrakis, Dune 4, Lisan Al-Ghaib', '0193122701', '2007-01-27', 'admin'),
('Muhammad', 'Isa', 'admin1', 'dbgroup4', 'isa@gmail.com', 'Jalan Iceblock 1, Lubang Ice 2, Antartica', '0187668789', '2007-10-16', 'admin'),
('Mikhail ', 'Iman', 'mikaiman', 'mikahil', 'mika@gmail.com', 'Pesona Villa', '016445', '2026-09-04', 'Customer'),
('Naizryl', 'Agha', 'agha', 'student', 'naiz@gmail.com', 'Bukit Antarabangsa', '01976578', '2007-08-10', 'Customer'),
('Sir ', 'Azman', 'azman', 'lecturer', 'sirazman@gmail.com', 'UTMKL', '01657824', '1974-01-01', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `bookingTime` time NOT NULL,
  `bookingStatus` varchar(30) NOT NULL,
  `bookingNotes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `email`, `vehicleID`, `bookingDate`, `bookingTime`, `bookingStatus`, `bookingNotes`) VALUES
(1, 'adam@gmail.com', 1, '2025-07-16', '15:45:00', 'Completed', 'Engine check'),
(3, 'adam@gmail.com', 4, '2026-11-10', '15:45:00', 'Completed', 'Engine and oil check and change'),
(4, 'sirazman@gmail.com', 5, '2026-06-16', '22:00:00', 'Completed', 'Engine check,AC check, oil change.');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicleID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `vehicleType` varchar(20) NOT NULL,
  `maker` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `plateNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicleID`, `username`, `vehicleType`, `maker`, `model`, `year`, `plateNumber`) VALUES
(1, 'reez9171', 'Hatchback', 'perodua', 'axia', '2020', 'VAG 2134'),
(3, 'reez9171', 'SUV', 'proton', 'emas', '2025', 'vqv 5372'),
(4, 'reez9171', 'SUV', 'proton', 'emas', '2025', 'vqv 5372'),
(5, 'azman', 'SUV', 'proton', 'emas', '2025', 'abc 1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contactNo` (`contactNo`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`),
  ADD UNIQUE KEY `vehicleID` (`vehicleID`),
  ADD KEY `vehicleID_2` (`vehicleID`),
  ADD KEY `email_3` (`email`),
  ADD KEY `vehicleID_3` (`vehicleID`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicleID`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fkbookingaccounts_email` FOREIGN KEY (`email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `fkbookingsvehicle_vehicleID` FOREIGN KEY (`vehicleID`) REFERENCES `vehicles` (`vehicleID`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicle references username from account` FOREIGN KEY (`username`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
