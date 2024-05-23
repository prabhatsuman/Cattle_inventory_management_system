-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2024 at 07:17 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cattle_inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cattle`
--

CREATE TABLE `cattle` (
  `cattle_id` varchar(5) NOT NULL,
  `cattle_type` varchar(100) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `DOB` date DEFAULT NULL,
  `vaccination` varchar(3) DEFAULT NULL,
  `milk_status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cattle`
--

INSERT INTO `cattle` (`cattle_id`, `cattle_type`, `sex`, `DOB`, `vaccination`, `milk_status`) VALUES
('B001', 'BUFFALO', 'M', '2018-09-11', 'YES', 0),
('B002', 'BUFFALO', 'M', '2019-10-09', 'YES', 0),
('B003', 'BUFFALO', 'F', '2022-10-14', 'NO', 1),
('B004', 'BUFFALO', 'F', '2019-10-16', 'YES', 1),
('C001', 'COW', 'F', '2019-10-01', 'YES', 1),
('C002', 'COW', 'M', '2020-08-04', 'YES', 0),
('C003', 'COW', 'M', '2022-10-26', 'YES', 0),
('C007', 'COW', 'F', '2020-01-03', 'YES', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cis_admin`
--

CREATE TABLE `cis_admin` (
  `admin_id` int NOT NULL,
  `admin_email` varchar(50) DEFAULT NULL,
  `admin_password` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cis_admin`
--

INSERT INTO `cis_admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(101, 'praneki@gmail.com', '123'),
(102, 'pranav@gmail.com', '123'),
(103, 'prabhat@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `dealer_id` varchar(3) NOT NULL,
  `dealer_name` varchar(100) NOT NULL,
  `d_address` varchar(200) NOT NULL,
  `p_number` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`dealer_id`, `dealer_name`, `d_address`, `p_number`) VALUES
('D01', 'Pratik', 'Patna', '7979866084'),
('D02', 'Priyanshu', 'Jaipur', '8227880484'),
('D03', 'Rishabh ', 'Ghaziabad', '9867895421'),
('D04', 'Nigam', 'Muzaffarpur', '9867858430');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` int NOT NULL,
  `e_date` date DEFAULT NULL,
  `e_type` varchar(100) DEFAULT NULL,
  `money_spent` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_id`, `e_date`, `e_type`, `money_spent`) VALUES
(7, '2022-11-25', 'MEDICINE', 200),
(6, '2022-11-25', 'FOOD', 100),
(8, '2022-10-25', 'INFRASTRUCTURE', 5000),
(9, '2022-10-02', 'VACCINATION', 500);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `p_id` int NOT NULL,
  `c_id` varchar(5) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `p_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`p_id`, `c_id`, `quantity`, `p_date`) VALUES
(7, 'C001', 7, '2022-10-10'),
(8, 'B003', 10, '2022-10-11'),
(9, 'B004', 5, '2022-11-02'),
(10, 'C007', 3, '2022-11-02'),
(11, 'B004', 3, '2022-11-25'),
(12, 'C001', 5, '2022-11-25'),
(13, 'C001', 15, '2022-11-25'),
(14, 'B004', 10, '2022-11-25'),
(15, 'B004', 10, '2023-06-14'),
(16, 'C007', 15, '2023-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `s_id` int NOT NULL,
  `d_id` varchar(3) DEFAULT NULL,
  `s_date` date DEFAULT NULL,
  `c_type` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `sale` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`s_id`, `d_id`, `s_date`, `c_type`, `quantity`, `sale`) VALUES
(1, 'D01', '2022-10-10', 'COW', 7, 280),
(2, 'D02', '2022-11-25', 'BUFFALO', 2, 100),
(3, 'D03', '2022-11-02', 'BUFFALO', 3, 150),
(4, 'D04', '2022-11-25', 'BUFFALO', 3, 150),
(5, 'D01', '2022-11-25', 'COW', 5, 200),
(7, 'D02', '2023-06-14', 'BUFFALO', 100, 5000),
(8, 'D03', '2023-06-14', 'COW', 10, 400),
(9, 'D03', '2023-06-14', 'BUFFALO', 250, 12500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cattle`
--
ALTER TABLE `cattle`
  ADD PRIMARY KEY (`cattle_id`);

--
-- Indexes for table `cis_admin`
--
ALTER TABLE `cis_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `d_id` (`d_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `s_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `production_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `cattle` (`cattle_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `dealers` (`dealer_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
