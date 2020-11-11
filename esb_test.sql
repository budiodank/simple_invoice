-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2020 at 06:07 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esb_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldestination`
--

CREATE TABLE `tbldestination` (
  `destinationCd` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `createdDt` datetime NOT NULL,
  `updatedDt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldestination`
--

INSERT INTO `tbldestination` (`destinationCd`, `name`, `street`, `city`, `country`, `createdDt`, `updatedDt`) VALUES
(1, 'Discovery Design', '41 St. Vincent Place', 'Glasgow G1 2ER', 'Scotland', '2020-11-11 00:00:00', '2020-11-11 00:00:00'),
(2, 'Barrington Publishers', '17 Great Suffolk Street', 'London SE1 0NS', 'United Kingdom', '2020-11-11 00:00:00', '2020-11-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `invoiceCd` varchar(4) NOT NULL,
  `issueDt` date NOT NULL,
  `dueDt` date NOT NULL,
  `subject` varchar(100) NOT NULL,
  `fromCd` int(11) NOT NULL,
  `forCd` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `payDt` datetime DEFAULT NULL,
  `createdDt` datetime NOT NULL,
  `updatedDt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`invoiceCd`, `issueDt`, `dueDt`, `subject`, `fromCd`, `forCd`, `status`, `payDt`, `createdDt`, `updatedDt`) VALUES
('0003', '2020-11-11', '2020-11-11', 'Design programmer', 1, 2, 'Y', '2020-11-11 18:05:30', '2020-11-11 15:09:54', '2020-11-11 18:05:30'),
('0009', '2020-11-11', '2020-11-11', 'Coba Edit 123', 1, 2, 'N', NULL, '2020-11-11 15:26:52', '2020-11-11 15:26:52'),
('0011', '2020-11-11', '2020-11-11', 'ea 123', 1, 2, 'N', NULL, '2020-11-11 16:06:51', '2020-11-11 17:51:25'),
('0012', '2020-11-11', '2020-11-11', 'Marketing Test', 1, 2, 'N', NULL, '2020-11-11 17:04:03', '2020-11-11 17:04:03'),
('0013', '2020-11-11', '2020-11-11', 'Coba Edit', 1, 2, 'N', NULL, '2020-11-11 17:37:58', '2020-11-11 17:37:58'),
('0014', '2020-11-11', '2020-11-11', 'Programmer Pusing', 1, 2, 'N', NULL, '2020-11-11 18:01:03', '2020-11-11 18:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoiceitem`
--

CREATE TABLE `tblinvoiceitem` (
  `invoiceCd` varchar(4) NOT NULL,
  `seq` int(11) NOT NULL,
  `itemCd` int(11) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `unitPrice` decimal(18,0) NOT NULL,
  `amount` decimal(18,0) NOT NULL,
  `createdDt` datetime NOT NULL,
  `updatedDt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinvoiceitem`
--

INSERT INTO `tblinvoiceitem` (`invoiceCd`, `seq`, `itemCd`, `qty`, `unitPrice`, `amount`, `createdDt`, `updatedDt`) VALUES
('0003', 1, 2, '12', '330', '20', '2020-11-11 15:22:03', '2020-11-11 18:05:30'),
('0003', 2, 2, '12', '330', '20', '2020-11-11 15:22:31', '2020-11-11 18:05:30'),
('0009', 3, 2, '12', '10', '20', '2020-11-11 15:28:23', '2020-11-11 15:28:23'),
('0011', 5, 1, '12', '230', '20', '2020-11-11 16:06:51', '2020-11-11 17:51:25'),
('0012', 6, 2, '12', '2000', '24000', '2020-11-11 17:04:03', '2020-11-11 17:04:03'),
('0013', 7, 3, '12', '11', '132', '2020-11-11 17:37:58', '2020-11-11 17:37:58'),
('0014', 8, 2, '12', '40', '480', '2020-11-11 18:01:03', '2020-11-11 18:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

CREATE TABLE `tblitem` (
  `itemCd` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unitPrice` decimal(18,0) NOT NULL,
  `createdDt` datetime NOT NULL,
  `updatedDt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblitem`
--

INSERT INTO `tblitem` (`itemCd`, `type`, `description`, `unitPrice`, `createdDt`, `updatedDt`) VALUES
(1, 'Service', 'Design', '230', '2020-11-11 00:00:00', '2020-11-11 00:00:00'),
(2, 'Service', 'Development', '330', '2020-11-11 00:00:00', '2020-11-11 00:00:00'),
(3, 'Service', 'meetings', '60', '2020-11-11 00:00:00', '2020-11-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldestination`
--
ALTER TABLE `tbldestination`
  ADD PRIMARY KEY (`destinationCd`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`invoiceCd`),
  ADD KEY `invoice_for` (`fromCd`),
  ADD KEY `invoice_from` (`forCd`);

--
-- Indexes for table `tblinvoiceitem`
--
ALTER TABLE `tblinvoiceitem`
  ADD PRIMARY KEY (`seq`),
  ADD KEY `invoice_item` (`itemCd`),
  ADD KEY `invoice_master` (`invoiceCd`);

--
-- Indexes for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD PRIMARY KEY (`itemCd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldestination`
--
ALTER TABLE `tbldestination`
  MODIFY `destinationCd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblitem`
--
ALTER TABLE `tblitem`
  MODIFY `itemCd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD CONSTRAINT `invoice_for` FOREIGN KEY (`fromCd`) REFERENCES `tbldestination` (`destinationCd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_from` FOREIGN KEY (`forCd`) REFERENCES `tbldestination` (`destinationCd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblinvoiceitem`
--
ALTER TABLE `tblinvoiceitem`
  ADD CONSTRAINT `invoice_item` FOREIGN KEY (`itemCd`) REFERENCES `tblitem` (`itemCd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_master` FOREIGN KEY (`invoiceCd`) REFERENCES `tblinvoice` (`invoiceCd`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
