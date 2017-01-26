-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2016 at 12:41 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Company_Title` varchar(255) NOT NULL,
  `Company_Description` varchar(255) NOT NULL,
  `Company_Website` varchar(255) NOT NULL,
  `Company_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_Title`, `Company_Description`, `Company_Website`, `Company_ID`, `User_ID`) VALUES
('LinkedIn Old', 'Old LinkedIn', 'www.linkedInNew.com', 7, 9899020),
('Facebook', 'Social Networking Site', 'www.facebook.com', 8, 9899022),
('GOOGLE INC', 'Search Engine Company', 'www.google.com', 10, 9899028),
('Barcelona', 'Football Team', 'www.bc.com', 11, 9899029);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `Education_ID` int(10) NOT NULL,
  `University` varchar(255) NOT NULL,
  `College` varchar(255) NOT NULL,
  `Degree` varchar(255) NOT NULL,
  `GPA` double(3,2) NOT NULL,
  `Start_Date` varchar(20) NOT NULL,
  `End_Date` varchar(20) DEFAULT NULL,
  `User_Profile_ID` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`Education_ID`, `University`, `College`, `Degree`, `GPA`, `Start_Date`, `End_Date`, `User_Profile_ID`) VALUES
(2, 'Andhra University', 'Biology College', 'MS in Boatany', 4.00, '1994-06-15', '1994-05-31', 2),
(3, 'Oxford University', 'College of business', 'Masters in Telecommunication', 4.00, '2004-01-01', '2006-01-02', 5);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `Job_Title` varchar(255) NOT NULL,
  `Job_Description` varchar(255) NOT NULL,
  `Job_Requirements` varchar(255) NOT NULL,
  `Post_Date` date NOT NULL,
  `Job_ID` int(10) NOT NULL,
  `Company_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`Job_Title`, `Job_Description`, `Job_Requirements`, `Post_Date`, `Job_ID`, `Company_ID`) VALUES
('Software Developer', 'Develop Applications for LinkedIn', '4 years experience in Java', '2016-12-06', 12345, 7),
('QA Engineer', 'Build Test Cases', '4 years expereience in Testing', '2016-12-04', 23478, 7),
('Software Engineer II', 'Work with Google Apps', '10 yrs of coding experience', '2016-12-08', 39856, 10),
('Java Developer', 'Develop a football website', 'Passion for football and coding', '2016-12-11', 4536728, 11);

-- --------------------------------------------------------

--
-- Table structure for table `userconnections`
--

CREATE TABLE `userconnections` (
  `User_ID` int(10) NOT NULL,
  `Connected_To` int(10) NOT NULL COMMENT 'User_ID''s of connected people'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userconnections`
--

INSERT INTO `userconnections` (`User_ID`, `Connected_To`) VALUES
(9899023, 9899021),
(9899024, 9899021),
(9899021, 9899023),
(9899024, 9899023),
(9899027, 9899023),
(9899027, 9899026),
(9899021, 9899027);

-- --------------------------------------------------------

--
-- Table structure for table `userjob`
--

CREATE TABLE `userjob` (
  `User_ID` int(10) NOT NULL,
  `Job_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userjob`
--

INSERT INTO `userjob` (`User_ID`, `Job_ID`) VALUES
(9899021, 12345),
(9899023, 12345),
(9899024, 12345),
(9899026, 12345),
(9899021, 23478),
(9899024, 23478),
(9899026, 23478),
(9899027, 23478),
(9899021, 39856);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Email_ID` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `User_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`First_Name`, `Last_Name`, `Email_ID`, `Pass`, `type`, `User_ID`) VALUES
('Yashwanth', 'Nerella', 'yashwanth.nerella@utah.edu', '54f5ecfb29206532906f6d116931ce6521309202064bacf0e6355bee7527d08d', 'employer', 9899020),
('Sadhana', 'Gautam', 'sg@gmail.com', '29f15dc906c65b39bfea25d3133e174b020578a20694839ad380c4ef43cbb583', 'employee', 9899021),
('Deepak', 'VVP', 'deepak@gmail.com', '310fbf88a1c795591e58f6a2c7a6dd5635e3477a84912ac20af85a1a4380bcea', 'employer', 9899022),
('Mohan Rao', 'Nerella', 'mn@gmail.com', 'b8f067f3af4cd1674f5949b81a4eeca88bfa433da391ffcea203b1270d619c80', 'employee', 9899023),
('sagar', 'singh', 'sagarsingh@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'employee', 9899024),
('Mark', 'Zuckerberg', 'mark@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'employer', 9899025),
('Usain', 'Bolt', 'bolt@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'employee', 9899026),
('martin', 'tyler', 'martin@gmail.com', 'b6f8d434a847fb0f0c1a8d9b936b8ca952e224f205a55f4ba9b2c20f88fdc9e7', 'employee', 9899027),
('Sundar', 'Pichai', 'sp@gmail.com', '89beafb3790f2fb5917de6baea168ad7d4b9bfa9a4e8961997cb532f561b28d7', 'employer', 9899028),
('Leo', 'Messi', 'lm@gmail.com', '8535e86c8118bbbb0a18ac72d15d3a2b37b18d1bce1611fc60165f322cf57386', 'employer', 9899029);

-- --------------------------------------------------------

--
-- Table structure for table `userspost`
--

CREATE TABLE `userspost` (
  `postid` int(10) NOT NULL,
  `post` text NOT NULL,
  `post_date` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userspost`
--

INSERT INTO `userspost` (`postid`, `post`, `post_date`, `userid`) VALUES
(1, 'Hi I am Sadhana', '2016-12-08', 9899021),
(2, 'Hi I am Mohan Rao', '2016-12-08', 9899023),
(3, 'Hi My name is Sagar Singh', '2016-12-08', 9899024),
(5, 'are there any football freaks in here?', '2016-12-08', 9899027);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `User_Profile_ID` int(10) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Summary` varchar(255) NOT NULL,
  `Profile_Link` varchar(255) NOT NULL,
  `Marital_Status` char(1) NOT NULL,
  `Contact_Email_ID` varchar(255) NOT NULL,
  `Phone_Number` varchar(10) NOT NULL,
  `User_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`User_Profile_ID`, `Title`, `Location`, `Summary`, `Profile_Link`, `Marital_Status`, `Contact_Email_ID`, `Phone_Number`, `User_ID`) VALUES
(1, 'Ms.', 'Asia', 'I am very very talented girl', 'www.sgbh.com', 'N', 'sg@gmail.com', '1234567890', 9899021),
(2, 'Mr.', 'Asia', 'I am a very very talented guy', 'www.mn.com', 'Y', 'mn@gmail.com', '1234567980', 9899023),
(3, 'Mr.', 'USA', 'I am a student at the University of Utah', 'www.linkedin.com/sagarsingh24492', 'N', 'sagarsingh24492@gmail.com', '0987654321', 9899024),
(4, 'Mr.', 'USA', 'Fastest man on the planet', 'www.linkedin.com/bolt', 'N', 'bolt@gmail.com', '123456789', 9899026),
(5, 'Mr.', 'Europe', 'Hi my name is Martin. I am the best football commentator', 'www.linkedin.com/martin', 'D', 'martin@gmail.com', '123123123', 9899027);

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `Experience_ID` int(10) NOT NULL,
  `Job_Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Start_Date` varchar(20) NOT NULL,
  `End_Date` varchar(20) DEFAULT NULL,
  `User_Profile_ID` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`Experience_ID`, `Job_Title`, `Description`, `Start_Date`, `End_Date`, `User_Profile_ID`) VALUES
(1, 'Quality Analyst', 'Developed test suites', '2016-12-19', '', 1),
(3, 'Govt Employee', 'Commercial Taxes', '1990-07-25', '', 2),
(4, 'Commentator', 'Football Commentator since 2000', '2010-01-01', '2016-12-08', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Company_ID`),
  ADD UNIQUE KEY `Company_Email_ID` (`Company_Website`),
  ADD UNIQUE KEY `Company_Title` (`Company_Title`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`Education_ID`),
  ADD KEY `User_Profile_ID` (`User_Profile_ID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`Job_ID`),
  ADD KEY `Company_ID` (`Company_ID`);

--
-- Indexes for table `userconnections`
--
ALTER TABLE `userconnections`
  ADD PRIMARY KEY (`User_ID`,`Connected_To`),
  ADD KEY `Connected_To` (`Connected_To`);

--
-- Indexes for table `userjob`
--
ALTER TABLE `userjob`
  ADD PRIMARY KEY (`User_ID`,`Job_ID`),
  ADD KEY `Job_ID` (`Job_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email_ID` (`Email_ID`);

--
-- Indexes for table `userspost`
--
ALTER TABLE `userspost`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`User_Profile_ID`),
  ADD UNIQUE KEY `Profile_Link` (`Profile_Link`),
  ADD UNIQUE KEY `Contact_Email_ID` (`Contact_Email_ID`),
  ADD UNIQUE KEY `Phone_Number` (`Phone_Number`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`Experience_ID`),
  ADD KEY `User_Profile_ID` (`User_Profile_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `Company_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `Education_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `Job_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4536729;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9899030;
--
-- AUTO_INCREMENT for table `userspost`
--
ALTER TABLE `userspost`
  MODIFY `postid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `User_Profile_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `Experience_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`);

--
-- Constraints for table `userconnections`
--
ALTER TABLE `userconnections`
  ADD CONSTRAINT `userconnections_ibfk_1` FOREIGN KEY (`Connected_To`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `userjob`
--
ALTER TABLE `userjob`
  ADD CONSTRAINT `userjob_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `userjob_ibfk_2` FOREIGN KEY (`Job_ID`) REFERENCES `job` (`Job_ID`);

--
-- Constraints for table `userspost`
--
ALTER TABLE `userspost`
  ADD CONSTRAINT `userspost_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`User_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
