-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 09:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `username`, `password`) VALUES
(1, 'faithcathedral', 'tabernacle');

-- --------------------------------------------------------

--
-- Table structure for table `audio_tbl`
--

CREATE TABLE `audio_tbl` (
  `audio_id` int(11) NOT NULL,
  `audio_title` varchar(255) NOT NULL,
  `uploaded_audio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `award_tbl`
--

CREATE TABLE `award_tbl` (
  `award_id` int(11) NOT NULL,
  `award_title` varchar(255) NOT NULL,
  `award_org` varchar(255) NOT NULL,
  `award_image` varchar(255) NOT NULL,
  `award_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`cat_id`, `cat_name`) VALUES
(2, 'test test'),
(4, 'test 3');

-- --------------------------------------------------------

--
-- Table structure for table `contact_tbl`
--

CREATE TABLE `contact_tbl` (
  `contact_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_tbl`
--

INSERT INTO `contact_tbl` (`contact_id`, `full_name`, `email`, `phone`, `message`) VALUES
(1, 'upload_certificate1', 'fiyinfholuwa@gmail.com', '08097238712', '1234'),
(2, 'upload_certificate1', 'fiyinfoluwa@tefy.org', '08097238712', 'fiyin'),
(3, 'upload_certificate1', 'fiyinfholuwa@gmail.com', '08097238712', 'love'),
(4, 'uba_redesign', 'janet@gmail.com', '08097238712', 'hello'),
(5, 'upload_certificate1', 'fiyinfholuwa@gmail.com', '08097238712', 'i love you');

-- --------------------------------------------------------

--
-- Table structure for table `enroll_tbl`
--

CREATE TABLE `enroll_tbl` (
  `enroll_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll_tbl`
--

INSERT INTO `enroll_tbl` (`enroll_id`, `full_name`, `email`, `phone`, `address`, `nationality`, `state`) VALUES
(2, 'upload_certificate1', 'janet@gmail.com', '08097238712', 'ib', 'Nigeria', 'oyo'),
(3, 'upload_certificate1', 'janet@gmail.com', '08097238712', 'ib', 'Nigeria', 'oyo'),
(4, 'upload_certificate1', 'janet@gmail.com', '08097238712', 'ib', 'Nigeria', 'oyo');

-- --------------------------------------------------------

--
-- Table structure for table `main_contact`
--

CREATE TABLE `main_contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_contact`
--

INSERT INTO `main_contact` (`contact_id`, `name`, `email`, `phone`, `message`) VALUES
(2, 'upload_certificate1', 'fiyinfoluwa@tefy.org', '08097238712', 'gg'),
(3, 'upload_notification1', 'olasopedaramola896@gmail.com', '08097238712', 'hello love');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `born_again` varchar(255) NOT NULL,
  `baptism` varchar(255) NOT NULL,
  `about_us` varchar(255) NOT NULL,
  `our_service` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `full_name`, `email`, `date_of_birth`, `location`, `occupation`, `telephone`, `sex`, `born_again`, `baptism`, `about_us`, `our_service`) VALUES
(1, 'olasope', 'fiyinfholuw', '2022-06-30', 'ib', 'web', '1', 'Male', 'Yes', 'Yes', 'friend', 'dd'),
(2, 'olasope', 'fiyinfholuw', '2022-06-28', 'ib', 'web', '11', 'Male', 'Yes', 'Yes', 'friend', 'ff'),
(3, 'olasope', 'fiyinfholuw', '2022-06-28', 'ib', 'web', '11', 'Male', 'Yes', 'Yes', 'friend', 'ff'),
(4, 'olasope', 'fiyinfholuw', '2022-06-28', 'ib', 'web', '12', 'Male', 'Yes', 'Yes', 'friend', 'dcxx'),
(5, 'olasope', 'fiyinfholuw', '2022-07-06', 'ib', 'web', '21', 'Male', 'Yes', 'Yes', 'friend', 'ssss'),
(6, 'olasope', 'fiyinfholuw', '2022-07-27', 'ib', 'web', '0808', 'Male', 'Yes', 'Yes', 'friend', 'you really did well'),
(7, 'olasope', 'olasopedaramola896@gmail.com', '2022-08-02', 'ib', 'web', '0808', 'Male', 'Yes', 'Yes', 'friend', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_tbl`
--

CREATE TABLE `pdf_tbl` (
  `pdf_id` int(11) NOT NULL,
  `pdf_title` varchar(255) NOT NULL,
  `uploaded_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_tbl`
--

CREATE TABLE `post_tbl` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_category` int(11) NOT NULL,
  `post_image` text NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_count` int(11) NOT NULL DEFAULT 0,
  `post_tags` varchar(255) NOT NULL,
  `read_time` varchar(255) NOT NULL,
  `post_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team_tbl`
--

CREATE TABLE `team_tbl` (
  `team_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `team_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testimony_tbl`
--

CREATE TABLE `testimony_tbl` (
  `test_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `test_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `audio_tbl`
--
ALTER TABLE `audio_tbl`
  ADD PRIMARY KEY (`audio_id`);

--
-- Indexes for table `award_tbl`
--
ALTER TABLE `award_tbl`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `enroll_tbl`
--
ALTER TABLE `enroll_tbl`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `main_contact`
--
ALTER TABLE `main_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `pdf_tbl`
--
ALTER TABLE `pdf_tbl`
  ADD PRIMARY KEY (`pdf_id`);

--
-- Indexes for table `post_tbl`
--
ALTER TABLE `post_tbl`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `team_tbl`
--
ALTER TABLE `team_tbl`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `testimony_tbl`
--
ALTER TABLE `testimony_tbl`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audio_tbl`
--
ALTER TABLE `audio_tbl`
  MODIFY `audio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `award_tbl`
--
ALTER TABLE `award_tbl`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enroll_tbl`
--
ALTER TABLE `enroll_tbl`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `main_contact`
--
ALTER TABLE `main_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pdf_tbl`
--
ALTER TABLE `pdf_tbl`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_tbl`
--
ALTER TABLE `post_tbl`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `team_tbl`
--
ALTER TABLE `team_tbl`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testimony_tbl`
--
ALTER TABLE `testimony_tbl`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
