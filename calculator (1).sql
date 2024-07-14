-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 يناير 2024 الساعة 04:20
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calculator`
--

-- --------------------------------------------------------

--
-- بنية الجدول `calculatordetails`
--

CREATE TABLE `calculatordetails` (
  `CalculatorID` int(11) NOT NULL,
  `FinalBid` decimal(10,2) DEFAULT NULL,
  `TransactionTax` decimal(10,2) DEFAULT NULL,
  `CopartFees` decimal(10,2) DEFAULT NULL,
  `AutoBidMasterTransactionFees` decimal(10,2) DEFAULT NULL,
  `DocumentationFees` decimal(10,2) DEFAULT NULL,
  `Multiplier` decimal(10,3) DEFAULT NULL,
  `TotalPlus10` decimal(10,2) DEFAULT NULL,
  `ShippingPrice` decimal(10,2) DEFAULT NULL,
  `Customs` decimal(10,2) DEFAULT NULL,
  `FinalTotal` decimal(10,2) DEFAULT NULL,
  `Tax` decimal(10,2) DEFAULT NULL,
  `DealNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `calculatordetails`
--

INSERT INTO `calculatordetails` (`CalculatorID`, `FinalBid`, `TransactionTax`, `CopartFees`, `AutoBidMasterTransactionFees`, `DocumentationFees`, `Multiplier`, `TotalPlus10`, `ShippingPrice`, `Customs`, `FinalTotal`, `Tax`, `DealNumber`) VALUES
(5, 123.00, 233.00, 23.00, 2.00, 3.00, 148.220, 158.22, 200.00, 17.91, 376.14, 28.81, 1223);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `PhoneNumber`, `Address`, `City`, `State`, `Country`, `PostalCode`, `RegistrationDate`, `Approved`) VALUES
(1, 'admin', 'jamal', 'echotech2021@gmail.com', '32eab367750d9190d861c0c47d1767af', '0096894591144', NULL, NULL, NULL, NULL, NULL, '2023-12-11 14:38:54', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculatordetails`
--
ALTER TABLE `calculatordetails`
  ADD PRIMARY KEY (`CalculatorID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculatordetails`
--
ALTER TABLE `calculatordetails`
  MODIFY `CalculatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
