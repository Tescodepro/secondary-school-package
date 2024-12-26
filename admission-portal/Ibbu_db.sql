-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2022 at 09:44 AM
-- Server version: 8.0.27-0ubuntu0.21.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Ibbu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admission_details`
--

CREATE TABLE `admission_details` (
  `id` int NOT NULL,
  `app_id` varchar(250) NOT NULL,
  `score` varchar(250) NOT NULL,
  `jamb_reg_num` varchar(250) NOT NULL,
  `jamb_type` varchar(250) NOT NULL,
  `firstchoicecourse` varchar(250) NOT NULL,
  `secondchoicecourse` varchar(250) NOT NULL,
  `sitting` varchar(250) NOT NULL,
  `exam_type` varchar(250) NOT NULL,
  `profile_pic` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admission_details`
--

INSERT INTO `admission_details` (`id`, `app_id`, `score`, `jamb_reg_num`, `jamb_type`, `firstchoicecourse`, `secondchoicecourse`, `sitting`, `exam_type`, `profile_pic`) VALUES
(1, 'LB/2022/37761516', '169', '505', 'jamb', 'Alayna', 'Tesleem', '1', 'Saepe voluptatibus repellendus asperiores exercitationem.', 'LB/2022/37761516_PROFILE_CamScanner 10-17-2021 07.48_4.jpg'),
(2, 'GR/2022/12304771', '15', '297', 'DE', 'Mathematic', 'Industrial  Mathematic', '1', 'Ipsa enim eum.', 'GR/2022/12304771_PROFILE_CamScanner 10-17-2021 07.48_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `id` int NOT NULL,
  `foreign_id` int NOT NULL,
  `degree_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_details`
--

CREATE TABLE `family_details` (
  `id` int NOT NULL,
  `app_id` varchar(250) NOT NULL,
  `next_kin_name` varchar(250) NOT NULL,
  `next_kin_email` varchar(250) NOT NULL,
  `next_kin_phone` varchar(250) NOT NULL,
  `next_kin_address` varchar(250) NOT NULL,
  `parent_name` varchar(250) NOT NULL,
  `parent_email` varchar(250) NOT NULL,
  `parent_phone` varchar(250) NOT NULL,
  `parent_address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `family_details`
--

INSERT INTO `family_details` (`id`, `app_id`, `next_kin_name`, `next_kin_email`, `next_kin_phone`, `next_kin_address`, `parent_name`, `parent_email`, `parent_phone`, `parent_address`) VALUES
(1, 'LB/2022/37761516', 'Nikko Friesen', 'your.email+fakedata60384@gmail.com', '596-310-3893', '69933 Hailey Cliff', 'Jackie Hudson', 'your.email+fakedata34101@gmail.com', '327-098-5164', '187 Craig Walk'),
(2, 'GR/2022/12304771', 'Alysa Schuster', 'your.email+fakedata12197@gmail.com', '266-163-9568', '6889 Brekke Rapids', 'Esther Strosin', 'your.email+fakedata46377@gmail.com', '294-083-2595', '286 Willy Via');

-- --------------------------------------------------------

--
-- Table structure for table `olevel`
--

CREATE TABLE `olevel` (
  `id` int NOT NULL,
  `app_id` text NOT NULL,
  `firstSubject` varchar(250) NOT NULL,
  `firstGrade` varchar(250) NOT NULL,
  `secondSubject` varchar(250) NOT NULL,
  `secondGrade` varchar(250) NOT NULL,
  `thirdSubject` varchar(250) NOT NULL,
  `thirdGrade` varchar(250) NOT NULL,
  `fourthSubject` varchar(250) NOT NULL,
  `fourthGrade` varchar(250) NOT NULL,
  `fifthSubject` varchar(250) NOT NULL,
  `fifthGrade` varchar(250) NOT NULL,
  `sixthSubject` varchar(250) NOT NULL,
  `sixthGrade` varchar(250) NOT NULL,
  `seventhSubject` varchar(250) NOT NULL,
  `seventhGrade` varchar(250) NOT NULL,
  `eightSubject` varchar(250) NOT NULL,
  `eightGrade` varchar(250) NOT NULL,
  `ninethSubject` varchar(250) NOT NULL,
  `ninethGrade` varchar(250) NOT NULL,
  `olevel_result` varchar(400) NOT NULL,
  `jamb_result` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `olevel`
--

INSERT INTO `olevel` (`id`, `app_id`, `firstSubject`, `firstGrade`, `secondSubject`, `secondGrade`, `thirdSubject`, `thirdGrade`, `fourthSubject`, `fourthGrade`, `fifthSubject`, `fifthGrade`, `sixthSubject`, `sixthGrade`, `seventhSubject`, `seventhGrade`, `eightSubject`, `eightGrade`, `ninethSubject`, `ninethGrade`, `olevel_result`, `jamb_result`) VALUES
(1, 'LB/2022/37761516', 'English Language', 'D7', 'Mathmatics', 'A1', 'Physics', 'C6', 'Statistics', 'ABS', 'Food and Nutrition', 'ABS', 'Computer Science', 'C6', 'Fashion and Textiles', 'A1', 'Marketting', 'C6', 'Accounting', 'A1', 'LB/2022/37761516_OLEVEL_CamScanner 10-17-2021 07.48_1.jpg', 'LB/2022/37761516_JAMB_CamScanner 10-17-2021 07.48_4.jpg'),
(2, 'GR/2022/12304771', 'English Language', 'B2', 'Mathmatics', 'A1', 'Geography', 'C4', 'Commerce', 'C6', 'Environment Management', 'E8', 'Agriculture Science', 'B3', 'Environment Management', 'D7', 'Commerce', 'C4', 'Physics', 'B3', 'GR/2022/12304771_OLEVEL_CamScanner 10-17-2021 07.48_1.jpg', 'GR/2022/12304771_JAMB_pdgN1.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `first_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `assign_id` varchar(50) NOT NULL,
  `application_found` varchar(250) NOT NULL DEFAULT '0',
  `acceptance_found` varchar(250) NOT NULL DEFAULT '0',
  `add_status` int NOT NULL DEFAULT '0',
  `is_register` int NOT NULL DEFAULT '0',
  `approved_course` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `assign_id`, `application_found`, `acceptance_found`, `add_status`, `is_register`, `approved_course`) VALUES
(1, 'George', 'Rosenbaum', 'ymail@gmail.com', 'GR/2022/12304771', '1', '0', 1, 1, 'agric'),
(2, 'Leora', 'Bernier', 'your@gmail.com', 'LB/2022/37761516', '1', '0', 1, 1, 'computer science'),
(7, 'TESLEEM', 'MUTIULAHI', 'tescodepro@gmail.com', 'TM/2022/64314900', '1', '0', 0, 0, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_details`
--
ALTER TABLE `admission_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_details`
--
ALTER TABLE `family_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olevel`
--
ALTER TABLE `olevel`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_details`
--
ALTER TABLE `admission_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_details`
--
ALTER TABLE `family_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `olevel`
--
ALTER TABLE `olevel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
