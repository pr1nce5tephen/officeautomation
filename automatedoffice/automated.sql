-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2016 at 01:07 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `automated`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `classno` int(11) NOT NULL auto_increment,
  `sched_id` varchar(123) NOT NULL,
  `scode` varchar(10) NOT NULL,
  `course` varchar(11) NOT NULL,
  `section` varchar(234) NOT NULL,
  `in` varchar(15) NOT NULL,
  `out` varchar(15) NOT NULL,
  `days` varchar(10) NOT NULL,
  `room` varchar(20) NOT NULL,
  `size` int(11) NOT NULL,
  `Pop` int(11) NOT NULL,
  `sy` varchar(15) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `Status` varchar(15) NOT NULL,
  PRIMARY KEY  (`classno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=414 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classno`, `sched_id`, `scode`, `course`, `section`, `in`, `out`, `days`, `room`, `size`, `Pop`, `sy`, `sem`, `Status`) VALUES
(221, '', '42', '81', '29', '9:30 AM', '10:00 AM', 'Monday', '20', 12, 1, '2015-2016', '2', 'Not Full'),
(219, '', '41', '81', '27', '7:30 AM', '8:00 AM', 'Monday', '22', 11, 10, '2015-2016', '1', 'Not Full'),
(220, '', '41', '81', '27', '8:30 AM', '9:00 AM', 'Tuesday', '22', 11, 1, '2015-2016', '1', 'Not Full'),
(413, '557', '40', 'course', 'section', '09:00am', '10:00am', '', '20', 12, 0, '3', '1', 'Not Full');

-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE IF NOT EXISTS `contribution` (
  `contribID` int(10) NOT NULL auto_increment,
  `contribDesc` text NOT NULL,
  `contribAmount` varchar(45) NOT NULL,
  `contribSem` varchar(20) NOT NULL,
  `contribYear` year(4) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`contribID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contribution`
--

INSERT INTO `contribution` (`contribID`, `contribDesc`, `contribAmount`, `contribSem`, `contribYear`, `status`) VALUES
(1, 'intramurals', '500', '1st Sem', 2015, 1),
(2, 'new contribution', '577', '1st Sem', 2015, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL auto_increment,
  `course_code` varchar(67) NOT NULL,
  `course_desc` text NOT NULL,
  `years` varchar(60) NOT NULL,
  `span` varchar(44) NOT NULL,
  `course_stat` varchar(33) NOT NULL,
  PRIMARY KEY  (`course_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_desc`, `years`, `span`, `course_stat`) VALUES
(82, 'BSIS', 'Bachelor of Science in Information Systems', '4', '4 years', 'Offered'),
(81, 'BSIT', 'Bachelor of Science in Computer Technology', '4', '4 years', 'Offered'),
(83, 'NCIV-Progr', 'NCIVProgramming', '1', '6 months', 'Offered'),
(84, 'BSCS', 'Bachelor of Science in Computer Science', '4', '4 years', 'Offered'),
(85, 'BSCPE', 'Bachelor of Science in Computer Engineering', '5', '5 years', 'Offered'),
(86, 'AIS', 'Associate in Information Systems', '2', '2 years', 'Offered'),
(87, 'asdas', 'asdasd', '1', '1 year and 6 Months', 'Offered'),
(89, 'Tesda Short Course', 'Tesda Short Course', '1', '300 hours', 'Offered');

-- --------------------------------------------------------

--
-- Table structure for table `course_yrlvl`
--

CREATE TABLE IF NOT EXISTS `course_yrlvl` (
  `course_yrlvl_id` int(65) NOT NULL auto_increment,
  `course_id` varchar(76) NOT NULL,
  `yrlvl` varchar(45) NOT NULL,
  PRIMARY KEY  (`course_yrlvl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=236 ;

--
-- Dumping data for table `course_yrlvl`
--

INSERT INTO `course_yrlvl` (`course_yrlvl_id`, `course_id`, `yrlvl`) VALUES
(217, '85', '3'),
(216, '85', '2'),
(215, '85', '1'),
(214, '84', '4'),
(213, '84', '3'),
(205, '81', '3'),
(206, '81', '4'),
(207, '82', '1'),
(208, '82', '2'),
(209, '82', '3'),
(210, '82', '4'),
(211, '84', '1'),
(212, '84', '2'),
(204, '81', '2'),
(203, '81', '1'),
(202, '80', '2'),
(201, '80', '1'),
(198, '77', '2'),
(197, '77', '1'),
(218, '85', '4'),
(219, '85', '5'),
(232, '86', '2'),
(231, '86', '1'),
(222, '87', '1'),
(228, '89', '1'),
(235, '83', '1');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `days_id` int(24) NOT NULL auto_increment,
  `day` varchar(250) NOT NULL,
  PRIMARY KEY  (`days_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`days_id`, `day`) VALUES
(13, 'Wednesday'),
(12, 'Tuesday'),
(11, 'Monday');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE IF NOT EXISTS `enroll` (
  `enlistment_id` int(11) NOT NULL auto_increment,
  `control_number` int(30) NOT NULL,
  `classno` int(11) NOT NULL,
  `sem` varchar(20) NOT NULL,
  `SY` varchar(15) NOT NULL,
  `pgrade` varchar(10) NOT NULL,
  `mgrade` varchar(10) NOT NULL,
  `sfgrade` varchar(10) NOT NULL,
  `fgrade` varchar(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `equiv` varchar(10) NOT NULL,
  `remark` varchar(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`enlistment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`enlistment_id`, `control_number`, `classno`, `sem`, `SY`, `pgrade`, `mgrade`, `sfgrade`, `fgrade`, `grade`, `equiv`, `remark`, `date`) VALUES
(92, 29508476, 219, '1', '2015-2016', '', '', '', '', '', '', '', '0000-00-00'),
(93, 94862517, 221, '2', '2015-2016', '', '', '', '', '', '', '', '0000-00-00'),
(91, 29508476, 220, '1', '2015-2016', '76', '77', '78', '79', '78', '2.8', 'PASSED', '2015-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `fcode` int(11) NOT NULL auto_increment,
  `InstID` varchar(32) NOT NULL,
  `pin` varchar(40) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mi` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contactno` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `teaching_type` varchar(22) NOT NULL,
  PRIMARY KEY  (`fcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fcode`, `InstID`, `pin`, `lname`, `fname`, `mi`, `address`, `gender`, `contactno`, `position`, `status`, `teaching_type`) VALUES
(32, 'new instructor', 'password', 'new instructor', 'instructor', 'B', 'asdfas', 'Male', '12346798732', 'Programming Instructor', 'active', '7');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_subject`
--

CREATE TABLE IF NOT EXISTS `instructor_subject` (
  `instsubj_id` int(23) NOT NULL auto_increment,
  `fcode` varchar(50) NOT NULL,
  `classno` varchar(50) NOT NULL,
  PRIMARY KEY  (`instsubj_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `instructor_subject`
--


-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `entryNum` int(20) NOT NULL auto_increment,
  `contribID` int(20) NOT NULL,
  `studID` varchar(40) NOT NULL,
  `amount` varchar(35) NOT NULL,
  `ornum` varchar(23) NOT NULL,
  `stamp` date NOT NULL,
  PRIMARY KEY  (`entryNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`entryNum`, `contribID`, `studID`, `amount`, `ornum`, `stamp`) VALUES
(3, 1, '94862517', '500', 'WLC52946307', '2015-07-05'),
(4, 2, '94862517', '577', 'WLC40375692', '2015-07-05'),
(5, 2, '83471962', '577', 'WLC46079123', '2015-07-05'),
(6, 1, '83471962', '500', 'WLC97143805', '2015-07-05'),
(7, 1, '29508476', '500', 'WLC43617985', '2015-07-05'),
(8, 2, '29508476', '577', 'WLC73186250', '2015-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(10) NOT NULL auto_increment,
  `room_code` varchar(50) NOT NULL,
  `room_description` text NOT NULL,
  `room_specification` varchar(43) NOT NULL,
  PRIMARY KEY  (`room_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_code`, `room_description`, `room_specification`) VALUES
(20, 'Lab.1', 'Laboratory 1', '8'),
(22, 'aa', 'aaa', '7');

-- --------------------------------------------------------

--
-- Table structure for table `room_sizes`
--

CREATE TABLE IF NOT EXISTS `room_sizes` (
  `id` int(22) NOT NULL auto_increment,
  `room_id` varchar(34) NOT NULL,
  `room_size` varchar(34) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `room_sizes`
--

INSERT INTO `room_sizes` (`id`, `room_id`, `room_size`) VALUES
(12, '22', '11'),
(13, '20', '12');

-- --------------------------------------------------------

--
-- Table structure for table `scheds`
--

CREATE TABLE IF NOT EXISTS `scheds` (
  `sched_id` int(23) NOT NULL auto_increment,
  `start` varchar(55) NOT NULL,
  `end` varchar(55) NOT NULL,
  `monday` varchar(10) NOT NULL,
  `tuesday` varchar(10) NOT NULL,
  `wednesday` varchar(10) NOT NULL,
  `thursday` varchar(10) NOT NULL,
  `friday` varchar(10) NOT NULL,
  `saturday` varchar(10) NOT NULL,
  `sunday` varchar(10) NOT NULL,
  `room` varchar(55) NOT NULL,
  `size` varchar(55) NOT NULL,
  `sy` varchar(55) NOT NULL,
  `sem` varchar(55) NOT NULL,
  PRIMARY KEY  (`sched_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=563 ;

--
-- Dumping data for table `scheds`
--

INSERT INTO `scheds` (`sched_id`, `start`, `end`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `room`, `size`, `sy`, `sem`) VALUES
(559, '09:00am', '10:00am', '', 'Tuesday', '', 'Thursday', '', '', '', '22', '11', '3', '1'),
(558, '7:00am', '8:00am', 'Monday', 'Tuesday', 'Wednesday', '', '', '', '', '20', '12', '3', '1'),
(557, '09:00am', '10:00am', '', 'Tuesday', '', 'Thursday', '', '', '', '20', '12', '3', '1'),
(560, '7:00am', '8:00am', 'Monday', 'Tuesday', 'Wednesday', '', '', '', '', '22', '11', '3', '1'),
(561, '08:30am', '10:30am', '', 'Tuesday', '', 'Thursday', '', '', '', '20', '12', '3', '1'),
(562, '08:30am', '10:30am', '', 'Tuesday', '', 'Thursday', '', '', '', '22', '11', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL auto_increment,
  `section_course` varchar(234) NOT NULL,
  `section_yrlvl` varchar(50) NOT NULL,
  `section_sem` varchar(50) NOT NULL,
  `section_desc` varchar(50) NOT NULL,
  PRIMARY KEY  (`section_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_course`, `section_yrlvl`, `section_sem`, `section_desc`) VALUES
(29, '81', '2', '2', '1'),
(28, '81', '1', '1', '1'),
(27, '81', '3', '1', '1'),
(26, '77', '2', 'summer', '02'),
(25, '77', '1', '1', '01');

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE IF NOT EXISTS `specification` (
  `specification_id` int(23) NOT NULL auto_increment,
  `specification` varchar(33) NOT NULL,
  PRIMARY KEY  (`specification_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `specification`
--

INSERT INTO `specification` (`specification_id`, `specification`) VALUES
(8, 'Programming'),
(7, 'Specification:');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(20) NOT NULL auto_increment,
  `control_number` int(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mi` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `yrlvl` varchar(50) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `name` varchar(22) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `contact` varchar(22) NOT NULL,
  PRIMARY KEY  (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `control_number`, `lname`, `fname`, `mi`, `address`, `contact_number`, `gender`, `course`, `yrlvl`, `birthdate`, `status`, `name`, `address2`, `contact`) VALUES
(41, 94862517, 'newstudent', 'newstudent', 'B', 'address', '09890987890', 'Male', '83', '1', '1994-10-29', 'Active', 'name', 'address', '09873456789'),
(42, 83471962, 'Lastname', 'Lastname', 'L', 'Lastname', '33342143242', 'Male', '87', '1', '1995-12-21', 'Active', 'Lastname', 'Lastname', '23123131'),
(43, 29508476, 'Student', 'Student', 'S', 'Student', '80989080980', 'Male', '81', '1', '1987-11-30', 'Active', 'Student', 'Student', '1312312312'),
(40, 46378029, 'newstudent', 'newstudent', 'N', 'fasfasfasa', '090909898', 'Male', '77', '1', '1992-06-16', 'Active', 'Name', 'Address', '098765432111');

-- --------------------------------------------------------

--
-- Table structure for table `studentcontribution`
--

CREATE TABLE IF NOT EXISTS `studentcontribution` (
  `tableID` int(11) NOT NULL auto_increment,
  `contribID` varchar(20) NOT NULL,
  `StudID` varchar(40) NOT NULL,
  PRIMARY KEY  (`tableID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `studentcontribution`
--

INSERT INTO `studentcontribution` (`tableID`, `contribID`, `StudID`) VALUES
(10, '2', '94862517'),
(11, '2', '83471962'),
(12, '2', '29508476'),
(13, '2', '46378029'),
(14, '1', '94862517'),
(15, '1', '83471962'),
(16, '1', '29508476'),
(17, '1', '46378029');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(30) NOT NULL auto_increment,
  `subject_code` varchar(50) NOT NULL,
  `subject_desc` text NOT NULL,
  `subject_units` varchar(50) NOT NULL,
  `subject_yrlvl` varchar(10) NOT NULL,
  `subject_semester` varchar(150) NOT NULL,
  `subject_course` varchar(30) NOT NULL,
  `subject_specification` varchar(35) NOT NULL,
  PRIMARY KEY  (`subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_code`, `subject_desc`, `subject_units`, `subject_yrlvl`, `subject_semester`, `subject_course`, `subject_specification`) VALUES
(41, 'Add Subject', 'Add Subject', '2', '3', '1', '81', '7'),
(40, 'math 1', 'college algebra', '3', '1', '1', '77', '8'),
(39, 'Subject Description', 'Subject Description', '2', '1', '1', '77', '7'),
(42, 'subject2', 'subject2', '3', '2', '2', '81', '8');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE IF NOT EXISTS `sy` (
  `sy_id` int(11) NOT NULL auto_increment,
  `school_yr` year(4) NOT NULL,
  `school_yr2` year(4) NOT NULL,
  PRIMARY KEY  (`sy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sy`
--

INSERT INTO `sy` (`sy_id`, `school_yr`, `school_yr2`) VALUES
(3, 2015, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `time_id` int(44) NOT NULL auto_increment,
  `time_in` varchar(333) NOT NULL,
  `time_out` varchar(333) NOT NULL,
  `monday` varchar(10) NOT NULL,
  `tuesday` varchar(10) NOT NULL,
  `wednesday` varchar(10) NOT NULL,
  `thursday` varchar(10) NOT NULL,
  `friday` varchar(10) NOT NULL,
  `saturday` varchar(10) NOT NULL,
  `sunday` varchar(10) NOT NULL,
  PRIMARY KEY  (`time_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `time_in`, `time_out`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES
(32, '08:30am', '10:30am', '', 'Tuesday', '', 'Thursday', '', '', ''),
(31, '09:00am', '10:00am', '', 'Tuesday', '', 'Thursday', '', '', ''),
(30, '7:00am', '8:00am', 'Monday', 'Tuesday', 'Wednesday', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL auto_increment,
  `userName` varchar(20) NOT NULL,
  `userPass` varchar(40) NOT NULL,
  `userLevel` int(11) NOT NULL,
  `userStat` int(11) NOT NULL,
  PRIMARY KEY  (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPass`, `userLevel`, `userStat`) VALUES
(51, 'admin', 'admin51', 1, 1);
