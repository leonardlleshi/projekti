SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `quiz`
--


-- --------------------------------------------------------

--
-- Table structure for table `answers`
--
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(555) NOT NULL,
  `correct` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `correct`) VALUES
(1, 1, 'Processor Handling Program', '0'),
(2, 1, 'Program Hypertext Preprocessor', '0'),
(3, 1, 'PHP: Hypertext Preprocessor', '1'),
(4, 1, ' Hypertext Preprocessor', '0'),
(5, 2, '// commented code to end of line', '1'),
(6, 2, '/* commented code here ', '0'),
(7, 2, '...commented code to end of line', '0'),
(8, 2, 'all of the above', '0'),
(9, 3, 'undef', '0'),
(10, 3, 'null', '1'),
(11, 3, 'none', '0'),
(12, 3, 'There is no such concept in PHP', '0');


-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `question` varchar(555) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_id`, `question`, `type`) VALUES
(1, 1, 'What does PHP stand for?', 'mc'),
(2, 2, ' Which of the following is the way to create comments in PHP?', 'mc'),
(3, 3, 'A value that has no defined value is expressed in PHP with the following keyword:', 'mc');





-- --------------------------------------------------------

--
-- Table structure for table `quiz_takers`
--

CREATE TABLE IF NOT EXISTS `quiz_takers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `percentage` varchar(24) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quiz_takers`
--

INSERT INTO `quiz_takers` (`id`, `username`, `percentage`, `date_time`) VALUES
(1, 'Fortesa Bryma', '50', '2016-05-5 14:44:29');


-----------Table for admin

CREATE TABLE admin
(
id INT PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(30) UNIQUE,
password VARCHAR(30)
);
INSERT INTO `admin` ( `username`,`password`) VALUES
('test', '1234');