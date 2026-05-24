-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2026 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courier management`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer table`
--

CREATE TABLE `customer table` (
  `Name` varchar(100) NOT NULL,
  `Number` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'customer',
  `Address` varchar(100) NOT NULL,
  `Customer Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer table`
--

INSERT INTO `customer table` (`Name`, `Number`, `Email`, `Password`, `role`, `Address`, `Customer Id`) VALUES
('shawa', '90865', 'shawa@gmail.com', '$2y$10$RV4xZ1zhryV4AK5Vtag60u8XjvbvAbAg8a3tuiwkNsC0Cee2GfK.W', 'admin', 'dha', 1),
('hania', '2134', 'hania@gmail.com', '$2y$10$f6M6I3MX7D0lvfQAsTSZ3e5cWeuDTTkir/O16VKH4Q690d9Ka/p2e', 'customer', 'nazimabad', 2),
('hassan', '21e34', 'hassan@gmail.com', '$2y$10$TqFpuXqukR4A5nhywIYUleHGOrUvR1JWT/kW3IRmqJQxHpk.tuvJC', 'customer', 'nazimabasd', 4),
('hina', '90865', 'hina@gmail.com', '666', 'customer', 'kazimabad', 5),
('sara', '', 'sara@email.com', '', 'customer', 'nazimabad', 6),
('nimra', '', 'nimra@gmail.com', '', 'customer', 'dha', 7),
('', '', '', '', 'customer', 'model', 8),
('mahad', '6666', 'mahad@gmail.com', '9088', 'customer', 'dha', 9),
('john', '77777', 'john@gmail.com', '099988', 'customer', 'karachi', 12),
('ibrahim', '5678', 'ibrahim@gmail.com', '$2y$10$Z76ogdYtgynm/X9PQcVVtONhT/Rtb4WJH6/x0YCeFXg.ZLo4j1c8i', 'customer', 'dha', 13),
('hiba', '8907654', 'hiba@gmail.com', '124', 'customer', 'pakistan', 14),
('aleeba', '56789', 'aleeba@gmail.com', '3214', 'customer', 'karachi', 16),
('moosa', '65432', 'moosa@gmail.com', '890', 'customer', 'lahore', 17),
('amir', '7890', 'amir@gmail.com', '$2y$10$Oex6tpHQg94XfTx2/ov/VOjTRwvt.1dnU2nW70mySCWW1LM1I4hpu', 'customer', 'karachi', 18);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `customer id` int(11) NOT NULL,
  `tracking id` int(100) NOT NULL,
  `shipment id` int(11) NOT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `receiver_phone` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'pending',
  `parcel_weight` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`customer id`, `tracking id`, `shipment id`, `receiver_name`, `receiver_phone`, `status`, `parcel_weight`, `destination`, `booking_date`) VALUES
(2, 0, 11, 'mariam', '7689', 'Pending', '0.01', 'lahore', '2026-05-06 07:00:00'),
(14, 0, 12, 'mariam', '0987654', 'Pending', '0.03', 'lahore', '2026-05-06 07:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer table`
--
ALTER TABLE `customer table`
  ADD PRIMARY KEY (`Customer Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment id`),
  ADD KEY `customer id` (`customer id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer table`
--
ALTER TABLE `customer table`
  MODIFY `Customer Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`customer id`) REFERENCES `customer table` (`Customer Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
