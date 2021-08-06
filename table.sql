-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 03:30 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eilia`
--

-- --------------------------------------------------------

--
-- Table structure for table `upload_tbl`
--

CREATE TABLE `upload_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(500) NOT NULL,
  `endd` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_tbl`
--

INSERT INTO `upload_tbl` (`id`, `title`, `url`, `endd`) VALUES
(23, '', 'uploaded/-file.JPG', 'JPG'),
(24, 'fgasdfadsf', 'uploaded/fgasdfadsf-file.exe', 'exe');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `log` int(2) NOT NULL,
  `cookie` varchar(5000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `status`, `log`, `cookie`) VALUES
(1, 'Eilia', 'eilia.abedian@yahoo.com', '49ebda6584e2ed9c7b468c6ecebd92a8', 2, 3, '49ebda6584e2ed9c7b468c6ecebd92a8ëÒÔ}„íë‘~â?^ZÚ!—­¯-±ŒÂ‡S01’žu');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `namee` varchar(20) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `description` text NOT NULL,
  `kind` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `namee`, `lastname`, `username`, `password`, `ip`, `description`, `kind`) VALUES
(1600, 'asdfjkasdklfjlk', 'jfjasdklfj', 'jlkasdfasdlfk', 'kasdjfklasdj', '5465456', 'aksdfaldks', 'aksjfaklsj'),
(1601, 'asdf', 'asdfa', 'asdfasdf', 'asdfasdf', '23', 'asdfasdf', 'e'),
(1602, 'kkossher', 'fotohi', 'ammekharab', 'asdfadf', '192.168.1.1', 'cfdfasdasdf', ''),
(1603, 'asdff', 'asdf', 'asdf', 'asfasf234', '192.554.156.245', 'asdfasdf', 'asdfasdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `upload_tbl`
--
ALTER TABLE `upload_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `upload_tbl`
--
ALTER TABLE `upload_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1604;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
