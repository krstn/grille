-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2014 at 12:24 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grille`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `veri` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fname`, `lname`, `email`, `message`, `veri`) VALUES
(12, 'john', 'earl', 'wakowako@yahoo.com', 'my discount kamo kon ma kwa ko solo nga room?', 1),
(13, 'aaaaa', 'aaaaa', 'aaaaa', ' aaaaaa', 1),
(14, 'bbbb', 'bbbb', 'bbbb', ' bbbbb', 1),
(15, 'sample ka', 'sample japon', 'sample@sample.com', 'sample sample sample ', 0),
(16, 'sample feedback', 'january 25', 'sample@email.com', 'sample message', 1);

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `start`, `end`) VALUES
(1, 'dasdadadaadad', '2014-01-28', '2014-02-01'),
(2, 'sample', '2014-01-07', '2014-01-09'),
(3, 'sample', '2014-01-02', '2014-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `unit` varchar(200) NOT NULL,
  `supplier` varchar(200) NOT NULL,
  `stock_a` int(11) unsigned NOT NULL,
  `cost` int(11) NOT NULL,
  `date_delivered` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `pid`, `name`, `unit`, `supplier`, `stock_a`, `cost`, `date_delivered`) VALUES
(30, 314, ' carrots', 'kg', 'SM MEGA MALL', 50, 6000, '2014-02-15'),
(32, 20577, ' ketchup', 'cartons', 'SM MEGA MALL', 10, 2000, '2014-02-15'),
(33, 18361, ' salt  ', 'kg', 'SM MEGA MALL', 20, 3000, '2014-02-15'),
(34, 17965, ' pork', 'kg', 'Purefoods', 50, 5000, '2014-02-14'),
(35, 25067, 'chicken meat ', 'kg', 'Bounty Fresh', 90, 0, '2014-02-14'),
(36, 18263, 'potatoes', 'kg', 'SM MEGA MALL', 100, 3000, '2014-02-15'),
(37, 5847, ' kanding', 'sacks', 'Bounty Fresh', 5, 10000, '2014-02-13'),
(38, 10030, ' fruit coctail  ', 'kg', 'SM MEGA MALL', 0, 0, '2014-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE IF NOT EXISTS `inventory_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `supplier` varchar(250) NOT NULL,
  `stock_a` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `date_delivered` date NOT NULL,
  `date_update` date NOT NULL,
  `action` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `p_id`, `name`, `unit`, `supplier`, `stock_a`, `cost`, `date_delivered`, `date_update`, `action`) VALUES
(37, 314, ' carrots', 'kg', 'SM MEGA MALL', 50, 6000, '2014-02-15', '2014-02-14', 'add new item'),
(39, 20577, ' ketchup', 'cartons', 'SM MEGA MALL', 10, 2000, '2014-02-15', '2014-02-14', 'add new item'),
(40, 18361, ' salt', 'kg', 'SM', 20, 3000, '2014-02-15', '2014-02-14', 'add new item'),
(41, 18361, ' salt ', 'kg', 'SM MEGA MALL', 20, 0, '2014-02-15', '2014-02-14', 'incorrect input'),
(42, 18361, ' salt  ', 'kg', 'SM MEGA MALL', 20, 3000, '2014-02-15', '2014-02-14', 'incorrect input'),
(43, 17965, ' pork', 'kg', 'Purefoods', 50, 5000, '2014-02-14', '2014-02-14', 'add new item'),
(44, 25067, 'chicken meat', 'kg', 'Bounty Fresh', 100, 1000, '2014-02-16', '2014-02-14', 'add new item'),
(45, 25067, 'chicken meat ', 'kg', 'Bounty Fresh', 10, 0, '2014-02-14', '2014-02-14', 'kitchen order'),
(46, 18263, 'potatoes', 'kg', 'SM MEGA MALL', 100, 3000, '2014-02-15', '2014-02-15', 'add new item'),
(47, 5847, ' kanding', 'sacks', 'Bounty Fresh', 5, 10000, '2014-02-13', '2014-02-15', 'add new item'),
(48, 10030, ' fruit coctail', 'cartons', 'SM MEGA MALL', 5, 5000, '2014-02-15', '2014-02-15', 'add new item'),
(49, 10030, ' fruit coctail ', 'kg', 'SM MEGA MALL', 5, 0, '2014-02-15', '2014-02-15', 'restock'),
(50, 10030, ' fruit coctail  ', 'kg', 'SM MEGA MALL', 10, 0, '2014-02-15', '2014-02-15', 'kitchen order');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_filed` date NOT NULL,
  `by` varchar(255) NOT NULL,
  `log_id` int(11) NOT NULL,
  `veri` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date_filed`, `by`, `log_id`, `veri`, `date_from`, `date_to`) VALUES
(24, '2014-02-14', 'ken', 30598, 1, '2014-02-14', '2014-02-14'),
(25, '2014-02-14', 'pretty', 6142, 0, '2014-02-01', '2014-03-01'),
(26, '2014-02-15', 'ken', 18076, 1, '2014-02-15', '2014-02-15'),
(27, '2014-02-15', 'pretty', 12895, 1, '2014-02-15', '2014-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `sender` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fname`, `lname`, `subject`, `message`, `sender`, `date`, `time`) VALUES
(62, 'KennethJames', 'Peromingan1989', 'fffff', ' fffff', 'ivan', '2014-02-10', '02:19:21'),
(65, 'KennethJames', 'Peromingan1989', 'sadaddaa', ' asdadada', 'ivan', '2014-02-10', '02:28:00'),
(66, 'Pretty ', 'Wahine ', 'adsaddada', ' asdasdadadasda', 'ken', '2014-02-09', '19:48:55'),
(67, 'KennethJames ', 'Peromingan1989 ', ' asdad', ' yes sir', 'pretty', '2014-02-09', '19:57:08'),
(68, 'Kenneth ', 'peromignan ', 'sample', 'sample ', 'ken', '2014-02-09', '20:01:17'),
(69, 'KennethJames ', 'Peromingan1989 ', ' asdadadads', ' asdadadadad', 'kenneth', '2014-02-09', '20:01:49'),
(70, 'ivan ', 'rubio ', 'asdada', ' asdadadda', 'ken', '2014-02-09', '20:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrition` text NOT NULL,
  `image` text NOT NULL,
  `news` text NOT NULL,
  `date` date NOT NULL,
  `by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `descrition`, `image`, `news`, `date`, `by`) VALUES
(8, 'sample news 2014', 'images/news/samp1.jpg', ' Try our sizzling hot Classic Chicken Fajita at 20% off today! Served with onions and bell peppers. ', '2014-01-24', ' ken'),
(9, 'Our Website is UP!', 'images/news/samp3.jpg', 'Subscribe to our email newsletter for useful tips and valuable resources, sent out every second Tuesday.', '2014-01-25', ' ken'),
(10, 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'images/news/samp5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sapien mauris, sagittis eget ante quis, consequat gravida enim. Pellentesque et metus id odio scelerisque suscipit. \r\nNam porta porta posuere. Curabitur facilisis nisi et lorem hendrerit, sit amet lacinia quam aliquam. Proin interdum porttitor tincidunt. Donec dictum, turpis sed auctor interdum, nibh eros vestibulum urna, a porta leo diam vitae nulla. Aliquam vehicula ac dolor et vulputate. Curabitur bibendum mi risus, non posuere nibh sagittis quis. Pellentesque eget mollis magna. Praesent molestie ipsum ut luctus commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet blandit magna, quis blandit erat. Aliquam euismod nibh erat.', '2014-02-01', ' ken'),
(11, 'Jon Stewart Has Bad Luck With Snacks', 'images/news/img.jpg', 'A lot of food is being changed or recalled, and Jon is trying to eat all of them.', '2014-02-15', ' ken');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starters` varchar(255) NOT NULL,
  `main` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `drink` varchar(255) NOT NULL,
  `s_p` int(11) NOT NULL,
  `main_p` int(11) NOT NULL,
  `des_p` int(11) NOT NULL,
  `dr_pres` int(11) NOT NULL,
  `s_image` text NOT NULL,
  `m_image` text NOT NULL,
  `d_image` text NOT NULL,
  `dr_image` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `starters`, `main`, `des`, `drink`, `s_p`, `main_p`, `des_p`, `dr_pres`, `s_image`, `m_image`, `d_image`, `dr_image`, `status`) VALUES
(1, 'sample new', 'sample new 1', 'sample new 2', 'sinsilyo', 100, 100, 100, 0, 'images/Amber-Wallpaper-amber-heard-35421468-1680-1050.jpg', 'images/Amber-Heard-20110303-Photoshoots-Maxim-Magazine-James-White-Aug08_07928.jpg', 'images/papaver.jpg', 'images/IMG_1160.JPG', 1),
(2, 'aaaa', 'bbbb', 'cccc', 'dddd', 12, 12, 12, 12, 'images/284286_211168745600577_2838083_n.jpg', 'images/250076_211170498933735_5379164_n.jpg', 'images/284671_211169812267137_3252724_n.jpg', 'images/281752_211172422266876_282847_n.jpg', 1),
(3, 'bbbb', 'cccc', 'dddd', 'aaaa', 11, 11, 11, 11, 'images/254756_211166842267434_1308624_n.jpg', 'images/254319_211172075600244_6617730_n.jpg', 'images/281752_211172422266876_282847_n.jpg', 'images/284407_211169185600533_5012044_n.jpg', 1),
(4, 'cccc', 'dddd', 'aaaa', 'bbbb', 5, 5, 5, 5, 'images/8.jpg', 'images/185365_211171608933624_263257_n.jpg', 'images/248568_211166995600752_3350841_n.jpg', 'images/281531_211169348933850_3117795_n.jpg', 1),
(6, 'mmmm', 'nnnn', 'xxxxx', 'zzzzzz', 4, 4, 4, 4, 'images/5.jpg', 'images/6.jpg', 'images/185365_211171608933624_263257_n.jpg', 'images/66.png', 1),
(7, 'asdaddsdads', 'asdada', 'asdadad', 'asdada', 2, 2, 2, 2, 'images/185365_211171608933624_263257_n.jpg', 'images/197759_211166678934117_687281_n.jpg', 'images/228853_211166382267480_5432285_n.jpg', 'images/281531_211169348933850_3117795_n.jpg', 1),
(8, 'sdadadada', 'qweqeqeecqwe qwq', 'asda adda asdadadsada adadas', 'adadadadaddada', 12, 12, 12, 12, 'images/281531_211169348933850_3117795_n.jpg', 'images/248568_211166995600752_3350841_n.jpg', 'images/5.jpg', 'images/216726_211170928933692_4181115_n.jpg', 1),
(9, 'yohoo', 'qwewqeqqwe', 'asdsadadada', 'qweeqeqw', 1, 23, 23, 45, 'images/284671_211169812267137_3252724_n.jpg', 'images/250076_211170498933735_5379164_n.jpg', 'images/284286_211168745600577_2838083_n.jpg', 'images/284407_211169185600533_5012044_n.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `rid` varchar(10) NOT NULL,
  `persons` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rdate` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `t_e` varchar(200) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `penalty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `rid`, `persons`, `fname`, `lname`, `address`, `date`, `mobile`, `email`, `rdate`, `time`, `t_e`, `venue`, `status`, `penalty`, `total`) VALUES
(102, '1012', 1, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-02-19', '10:00:00', '13:00:00', 'not applicable', 4, 0, 0),
(103, '9059', 22, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-02-19', '12:00:00', '18:00:00', 'Dining Room', 2, 0, 2200),
(104, '26695', 27, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-03-31', '10:00:00', '13:00:00', 'Dining Room', 3, 0, 2700),
(106, '16721', 1, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-04', '903283840 ', ' ayos@yahoo.com', '2014-02-19', '19:00:00', '22:00:00', 'not applicable', 3, 0, 0),
(107, '10905', 9, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-02-27', '10:00:00', '13:00:00', 'not applicable', 1, 0, 0),
(109, '11702', 15, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2013-12-13', '17:00:00', '20:00:00', 'Function Room', 3, 0, 1500),
(110, '21028', 27, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-02-28', '17:00:00', '20:00:00', 'Dining Room', 3, 0, 2700),
(111, '20912', 25, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-04-16', '10:00:00', '13:00:00', 'Dining Room', 3, 0, 2500),
(112, '26602', 46, 'ivan ', 'rubio ', 'Cadiz ', '2014-02-15', '903283840 ', ' ayos@yahoo.com', '2014-01-06', '18:00:00', '21:00:00', 'Dining Room', 1, 0, 4600),
(114, '5292', 1, 'juan ', 'lazy ', 'bacolod, neg occ ', '2014-02-15', '09182736485 ', ' juanlazy@gmail.com', '2014-02-19', '11:00:00', '14:00:00', 'not applicable', 4, 0, 0),
(115, '1885105695', 8, 'KennethJames', 'Peromingan1989', 'Calatrava', '2014-02-17', '34', 'k@e.com', '2014-02-21', '16:00:00', '19:00:00', 'Alfresco', 0, 0, 0),
(116, '1328617002', 1, 'KennethJames', 'Peromingan1989', 'Calatrava', '2014-02-17', '2123', 'k@e.com', '2014-02-08', '10:00:00', '13:00:00', 'Dining Room', 0, 0, 0),
(117, '894620569\r', 6, 'KennethJames', 'Peromingan1989', 'Calatrava', '2014-02-20', '421423523512', 'k@e.com', '2014-04-07', '15:00:00', '18:00:00', 'Function Room', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `date` date NOT NULL,
  `gross` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `rid`, `date`, `gross`, `discount`, `net`, `type`) VALUES
(7, 26695, '2014-02-14', 2812, 422, 2390, 'Function'),
(8, 21028, '2014-02-14', 2920, 438, 2482, 'Function'),
(9, 10905, '2014-02-14', 0, 0, 0, 'Regular'),
(10, 16721, '2014-02-14', 230, 0, 230, 'Regular'),
(11, 20912, '2014-02-15', 3410, 512, 2899, 'Function'),
(12, 11702, '2014-02-15', 2670, 401, 2270, 'Function');

-- --------------------------------------------------------

--
-- Table structure for table `sales_log`
--

CREATE TABLE IF NOT EXISTS `sales_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `by` varchar(255) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `veri` int(11) NOT NULL,
  `filed` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sales_log`
--

INSERT INTO `sales_log` (`id`, `sale_id`, `by`, `from`, `to`, `veri`, `filed`) VALUES
(4, 10454, 'ken', '2014-02-14', '2014-02-14', 1, '2014-02-14'),
(5, 29022, 'kenneth', '2014-02-14', '2014-02-14', 0, '2014-02-14'),
(6, 1622, 'ken', '2014-02-15', '2014-02-15', 1, '2014-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `temp_order`
--

CREATE TABLE IF NOT EXISTS `temp_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `ornum` int(11) NOT NULL,
  `veri` int(11) NOT NULL,
  `starters` varchar(255) NOT NULL,
  `main` varchar(255) NOT NULL,
  `des` varchar(255) NOT NULL,
  `dri` varchar(255) NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) NOT NULL,
  `q3` int(11) NOT NULL,
  `q4` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `temp_order`
--

INSERT INTO `temp_order` (`id`, `rid`, `ornum`, `veri`, `starters`, `main`, `des`, `dri`, `q1`, `q2`, `q3`, `q4`, `total`, `date`) VALUES
(71, 26695, 24614, 3, 'saging', 'nnnn', 'xxxxx', 'aaaa', 4, 5, 6, 7, 112, '2014-02-15'),
(72, 21028, 8589, 3, 'saging', 'kandela', 'libro', 'sinsilyo', 4, 5, 6, 7, 220, '2014-02-14'),
(73, 16721, 12291, 3, 'saging', 'kandela', 'libro', 'sinsilyo', 5, 7, 8, 3, 230, '2014-02-15'),
(74, 20912, 2944, 3, 'yohoo', 'kandela', 'libro', 'sinsilyo', 13, 13, 13, 13, 403, '2014-02-15'),
(75, 20912, 6463, 3, 'sdadadada', 'dddd', 'dddd', 'asdada', 13, 13, 13, 13, 507, '2014-02-15'),
(76, 26602, 18783, 0, 'asdaddsdads', 'kandela', 'libro', 'sinsilyo', 30, 30, 30, 30, 960, '2014-02-15'),
(77, 26602, 24492, 0, 'sdadadada', 'asdada', 'xxxxx', 'dddd', 20, 20, 20, 20, 440, '2014-02-15'),
(78, 11702, 16335, 3, 'asdaddsdads', 'nnnn', 'libro', 'sinsilyo', 45, 45, 45, 45, 1170, '2014-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `test` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `test`) VALUES
(1, 'sample 1', 'sample 1'),
(2, 'sample 2', 'sample 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) COLLATE latin1_bin NOT NULL,
  `password` varchar(65) COLLATE latin1_bin NOT NULL,
  `image` text COLLATE latin1_bin NOT NULL,
  `email` varchar(65) COLLATE latin1_bin NOT NULL,
  `mobile` varchar(250) COLLATE latin1_bin NOT NULL,
  `fname` varchar(65) COLLATE latin1_bin NOT NULL,
  `lname` varchar(65) COLLATE latin1_bin NOT NULL,
  `address` varchar(250) COLLATE latin1_bin NOT NULL,
  `type` varchar(250) COLLATE latin1_bin NOT NULL,
  `verify` int(1) NOT NULL,
  `gender` varchar(10) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=42 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `image`, `email`, `mobile`, `fname`, `lname`, `address`, `type`, `verify`, `gender`) VALUES
(1, 'ken', 'ken', '', 'ama@gmail.com', '2147483647', 'KennethJames', 'Peromingan1989', 'Calatrava', 'admin', 1, 'Mr.'),
(16, 'kenneth', 'kenneth', '', 'bait@gmail.com', '09293039384', 'Kenneth', 'peromignan', 'Calatrava', 'bookkeeper', 1, 'Mr.'),
(15, 'pretty', 'wahine', '', 'pretty@gmail.com', '09293039384', 'Pretty', 'Wahine', '', 'clerk', 1, ''),
(14, 'ivan', 'rubio', '', 'ayos@yahoo.com', '903283840', 'ivan', 'rubio', 'Cadiz', 'customer', 1, 'Mr.'),
(22, 'cxzcczczzc', 'zxczczczc', '', 'zxczczczc', '321323223', 'sdfsdfsdsd', 'zczcczc', '', 'guest', 0, ''),
(24, 'juan', 'lazy', '', 'juanlazy@gmail.com', '09182736485', 'juan', 'lazy', 'bacolod, neg occ', 'customer', 1, 'Mr.'),
(25, 'bonbon', 'bonbon', '', 'bonbon@gmail.com', '09128787569', 'Bon Bon', 'Pastor', '', 'customer', 1, ''),
(26, 'samplejan25', 'samplejan25', '', 'sample@sample.com', '09282837465', 'samplejan25', 'samplejan25', 'Bacolod, Negros Occidental', 'customer', 1, 'Mr.');
