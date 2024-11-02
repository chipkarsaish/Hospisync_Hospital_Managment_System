-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 09:28 AM
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
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'ADMIN', 'mahendra@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `archived_patient`
--

CREATE TABLE `archived_patient` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DoctorName` varchar(100) DEFAULT NULL,
  `DateOfAppointment` date DEFAULT NULL,
  `PreferredTime` time DEFAULT NULL,
  `pdf_file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_patient`
--

INSERT INTO `archived_patient` (`id`, `Name`, `Email`, `PhoneNumber`, `DoctorName`, `DateOfAppointment`, `PreferredTime`, `pdf_file_path`) VALUES
(28, 'harsh ', NULL, '34443443343', NULL, '0000-00-00', '20:53:48', NULL),
(31, 'saaish', 'saish@gmail.com', '443454', NULL, '2024-10-23', '20:53:48', 'uploads/QuestionBankIA2DTS.pdf'),
(32, 'dina', 'dian@gmail.com', '43355554', NULL, '2024-09-11', '20:53:48', 'uploads/maths question bank.pdf'),
(34, 'hjhh', 'uii', '655758', 'rajdeep', '2024-09-03', '20:53:48', 'uploads/QuestionBankIA2DTS.pdf'),
(35, 'asdsada', 'dsadsd', '2321221312', 'dsadd', '2024-09-25', '20:53:48', 'uploads/maths question bank.pdf'),
(36, 'saish', 'saiahs@gmial.com', '2334433344344', 'rajdeep', '2024-09-25', '20:53:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `dob`, `specialization`, `experience`, `password`) VALUES
(22, 'Ellisa Roy', 'ellisa@gmail.com', '1996-03-15', 'oncology', 5, 'Ellisa'),
(23, 'Lewis Hamiltion', 'lewis@gmail.com', '1995-02-08', 'physciology', 7, 'admin'),
(24, 'Tushar Mishra', 'tushar@gmail.com', '1990-03-17', 'pediatrician', 8, 'admin'),
(25, 'Ramesh Gaitonde', 'ramesh@gmail.com', '1986-07-10', 'pediatrician', 7, 'admin'),
(26, 'Riya Bhatia', 'riya@gmial.com', '1956-07-11', 'nephrology', 6, 'admin'),
(27, 'Aisha Verma', 'aisha@gmail.com', '1967-10-10', 'orthopedic', 6, 'admin');

--
-- Triggers `doctors`
--
DELIMITER $$
CREATE TRIGGER `after_doctors_insert` AFTER INSERT ON `doctors` FOR EACH ROW BEGIN
    INSERT INTO user (email, password, role)
    VALUES (NEW.email, NEW.password, 'doctor');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_doctors_after_delete` AFTER DELETE ON `doctors` FOR EACH ROW BEGIN
    DELETE FROM user
    WHERE id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_rooms`
--

CREATE TABLE `hospital_rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `status` enum('vacant','occupied','housekeeping','blocked','retain') NOT NULL DEFAULT 'vacant',
  `block_name` varchar(50) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `patient_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_rooms`
--

INSERT INTO `hospital_rooms` (`id`, `room_name`, `status`, `block_name`, `last_updated`, `patient_name`) VALUES
(6, 'Operation Theater 1', 'occupied', 'A', '2024-10-20 18:33:18', 'raju'),
(7, 'Operation Theater 1', 'vacant', 'B', '2024-10-20 19:07:21', 'Rahul');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DoctorName` varchar(100) DEFAULT NULL,
  `DateOfAppointment` date DEFAULT NULL,
  `PreferredTime` time DEFAULT NULL,
  `id` int(11) NOT NULL,
  `pdf_file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`Name`, `Email`, `PhoneNumber`, `DoctorName`, `DateOfAppointment`, `PreferredTime`, `id`, `pdf_file_path`) VALUES
('saish', 'saish@gmial.com', '4434344', 'doctor', '2024-10-23', '20:53:48', 37, 'uploads/QuestionBankIA2DTS.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `pharmaceuticals`
--

CREATE TABLE `pharmaceuticals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmaceuticals`
--

INSERT INTO `pharmaceuticals` (`id`, `name`, `barcode`, `vendor`, `category`, `quantity`) VALUES
(4, 'BandAID', '4444454554', 'new enterpriese', 'Aid', 34),
(5, 'Cotton ', '6767766567', 'Apollo medical', 'General ', 45);

-- --------------------------------------------------------

--
-- Table structure for table `prev_patient`
--

CREATE TABLE `prev_patient` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DoctorName` varchar(100) DEFAULT NULL,
  `DateOfAppointment` date DEFAULT NULL,
  `PreferredTime` time DEFAULT NULL,
  `pdf_file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prev_patient`
--

INSERT INTO `prev_patient` (`id`, `Name`, `Email`, `PhoneNumber`, `DoctorName`, `DateOfAppointment`, `PreferredTime`, `pdf_file_path`) VALUES
(21, 'Prabodh Kade', 'pramod@gmail.com', '0999879787872', 'Rajdeep', '2024-09-25', '20:53:48', NULL),
(22, 'Krishna Shukla', NULL, '9876765677', NULL, '2024-10-23', '20:53:48', NULL),
(23, 'Mohandas Baria', NULL, '976767673', NULL, '2024-10-24', '22:48:10', NULL),
(25, 'Shrutika Sandesh Chipkar', NULL, '9875546733', NULL, '2024-10-05', '13:30:00', NULL),
(26, 'Murlidhar Prasad', NULL, '98766766567', NULL, '2024-10-16', '07:18:00', NULL),
(27, 'shruti', NULL, '9987617179', NULL, '2024-10-20', '02:10:00', NULL),
(28, 'Piush', 'piyush@gmail.com', '99876288222', NULL, '2024-09-11', '20:53:48', NULL),
(29, 'sasih', NULL, '2334433344344', NULL, '2024-09-03', '20:53:48', NULL),
(30, 'saish', 'saish@gmail.com', '2222222', NULL, '2024-09-25', '20:53:48', NULL),
(33, 'Goli', 'goli@gmail.com', '34553553535', 'rajdeep', '2024-09-25', '20:53:48', 'uploads/maths question bank.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `dob`, `department`, `password`) VALUES
(20, 'Sarah Blake', 'sara@gmail.com', '1996-10-10', 'Pediatration', 'sarah');

--
-- Triggers `staff`
--
DELIMITER $$
CREATE TRIGGER `after_staff_insert` AFTER INSERT ON `staff` FOR EACH ROW BEGIN
    INSERT INTO user (email, password, role)
    VALUES (NEW.email, NEW.password, 'staff');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_staff_after_delete` AFTER DELETE ON `staff` FOR EACH ROW BEGIN
    DELETE FROM user
    WHERE id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(20, 'sonam1@gmail.com', '$2y$10$FTHBo3js8yox6tgIzhLEreqdVWEMOABPO/5OJ1Wilqjo5z7IoBNpK', 'staff'),
(22, 'kavita1@gmail.com', '', 'staff'),
(23, 'saish@gmail.com', 'Saish@2006', 'doctor'),
(24, 'kadamom313@gmail.com', 'omkadam1', 'doctor'),
(25, 'admin@gmail.com', '1234', 'doctor'),
(26, 'ram@gmail.com', '', 'staff'),
(27, 'sonam@gmial.com', '', 'staff'),
(32, 's@gma.com', '', 'staff'),
(33, 'folder@gmail.com', '', 'staff'),
(35, 'adm222in@gmail.com', 'admin', 'doctor'),
(36, 'gaurav@gmail.com', '', 'staff'),
(37, 'dddsds@gmail.com', 'admin', 'staff'),
(38, 'arjun@gmail.com', 'arjun', 'staff'),
(39, 'ellisa@gmail.com', 'Ellisa', 'doctor'),
(40, 'lewis@gmail.com', 'admin', 'doctor'),
(41, 'tushar@gmail.com', 'admin', 'doctor'),
(42, 'ramesh@gmail.com', 'admin', 'doctor'),
(43, 'riya@gmial.com', 'admin', 'doctor'),
(44, 'aisha@gmail.com', 'admin', 'doctor'),
(45, 'sara@gmail.com', 'sarah', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_patient`
--
ALTER TABLE `archived_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hospital_rooms`
--
ALTER TABLE `hospital_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmaceuticals`
--
ALTER TABLE `pharmaceuticals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prev_patient`
--
ALTER TABLE `prev_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `archived_patient`
--
ALTER TABLE `archived_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `hospital_rooms`
--
ALTER TABLE `hospital_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pharmaceuticals`
--
ALTER TABLE `pharmaceuticals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prev_patient`
--
ALTER TABLE `prev_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
