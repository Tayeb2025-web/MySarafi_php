-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3344
-- Generation Time: Jun 06, 2026 at 01:40 PM
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
-- Database: `mysarafi`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(45) DEFAULT NULL,
  `branch_address` varchar(45) DEFAULT NULL,
  `branch_partner` varchar(45) DEFAULT NULL,
  `branch_phone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_address`, `branch_partner`, `branch_phone`) VALUES
(20, 'Herat', 'karte-4', 'karem', '070000000'),
(21, 'Kabul', 'shar_now', 'nawid', '0711111111'),
(22, 'Takhar', 'Nahia_4', 'Haji Sharif', '072222222'),
(23, 'Iran', 'Mashhad', 'Dash Pourya', '091022345663'),
(24, 'Turkey', 'Anqara', 'Dawood', '083-452-3525');

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `receiver_id` int(11) NOT NULL,
  `this_receiver_name` varchar(20) DEFAULT NULL,
  `this_receiver_fatherName` varchar(20) DEFAULT NULL,
  `receive_code` varchar(20) DEFAULT NULL,
  `receive_amount` decimal(10,2) DEFAULT NULL,
  `receive_date` datetime DEFAULT NULL,
  `receive_from` int(11) NOT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `receive`
--

INSERT INTO `receive` (`receiver_id`, `this_receiver_name`, `this_receiver_fatherName`, `receive_code`, `receive_amount`, `receive_date`, `receive_from`, `status`) VALUES
(1, 'سید طیب', 'محمد شاه', '7461', 32000.00, '2026-06-05 00:00:00', 20, 'paid'),
(2, 'حیدر', 'کرار', 'E4430', 13200.00, '2026-06-12 00:00:00', 22, 'paid'),
(3, 'yar', 'کاکا رحیم', 'W2112', 3200.00, '2026-06-10 00:00:00', 21, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `send`
--

CREATE TABLE `send` (
  `send_id` int(11) NOT NULL,
  `that_reciever_name` varchar(20) DEFAULT NULL,
  `that_reciever_fatherName` varchar(20) DEFAULT NULL,
  `send_code` varchar(20) DEFAULT NULL,
  `send_amount` decimal(10,2) DEFAULT NULL,
  `send_date` datetime DEFAULT NULL,
  `send_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `send`
--

INSERT INTO `send` (`send_id`, `that_reciever_name`, `that_reciever_fatherName`, `send_code`, `send_amount`, `send_date`, `send_to`) VALUES
(2, 'نوید', 'حاجی کریم', 'h43289', 400.00, '2026-06-04 00:00:00', 21),
(4, 'نوید', 'ramin', 'h43289', 400.00, '0000-00-00 00:00:00', 20),
(5, 'نوید', 'حسین', 'P5431', 5000.00, '2026-06-05 00:00:00', 21),
(6, 'قربان قل', 'شاه گل', 'R4432', 1200.00, '2026-06-05 00:00:00', 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`) VALUES
(1, 'tayeb', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`receiver_id`),
  ADD KEY `fk_recieve_branch1_idx` (`receive_from`);

--
-- Indexes for table `send`
--
ALTER TABLE `send`
  ADD PRIMARY KEY (`send_id`),
  ADD KEY `fk_send_branch_idx` (`send_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `receive`
--
ALTER TABLE `receive`
  MODIFY `receiver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `send`
--
ALTER TABLE `send`
  MODIFY `send_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `receive`
--
ALTER TABLE `receive`
  ADD CONSTRAINT `fk_recieve_branch1` FOREIGN KEY (`receive_from`) REFERENCES `branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `send`
--
ALTER TABLE `send`
  ADD CONSTRAINT `fk_send_branch` FOREIGN KEY (`send_to`) REFERENCES `branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
