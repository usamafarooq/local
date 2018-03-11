-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2018 at 01:52 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umer`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) UNSIGNED NOT NULL,
  `main_id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` text,
  `Phone` int(100) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `main_id`, `Name`, `Address`, `Phone`, `Email`, `user_id`, `created_at`) VALUES
(2, 29, 'Talha', 'xyz', 12345678, 'text@test.com', 2, '2018-03-10 18:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `deliver_order`
--

CREATE TABLE `deliver_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `deliver` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliver_order`
--

INSERT INTO `deliver_order` (`id`, `order_id`, `date`, `deliver`, `received`, `created_at`) VALUES
(2, 2, '2018-03-11', 20, 0, '2018-03-10 18:33:42'),
(3, 3, '2018-03-09', 10, 10, '2018-03-11 00:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `main_name` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `main_name`, `sort`, `icon`, `url`, `user_id`) VALUES
(2, 'Dashboard', 'dashboard', 1, 'home', 'home', 4),
(3, 'Modules', 'modules', 4, 'home', 'modules', 4),
(5, 'Role/Permission', 'role', 2, 'home', 'role', 4),
(7, 'Users', 'user', 3, 'home', 'users', 2),
(20, 'Client', 'client', 5, 'home', 'client', 2),
(21, 'Orders', 'orders', 6, 'home', 'orders', 2),
(22, 'Order Reporting', 'reporting', 7, 'home', 'reporting', 2),
(23, 'Pending Bottles', 'pending_bottles', 8, 'home', 'pending_bottles', 2),
(24, 'Rider Report', 'rider_reporting', 9, 'home', 'rider_reporting', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules_fileds`
--

CREATE TABLE `modules_fileds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `filed_type` varchar(100) NOT NULL,
  `options` varchar(255) NOT NULL,
  `filed_multiple` varchar(10) DEFAULT 'no',
  `length` int(11) NOT NULL,
  `required` int(11) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL,
  `is_relation` int(11) NOT NULL,
  `relation_column` varchar(100) DEFAULT NULL,
  `relation_table` varchar(100) DEFAULT NULL,
  `value_column` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_fileds`
--

INSERT INTO `modules_fileds` (`id`, `name`, `type`, `filed_type`, `options`, `filed_multiple`, `length`, `required`, `module_id`, `is_relation`, `relation_column`, `relation_table`, `value_column`) VALUES
(1, 'name', 'VARCHAR', 'input', '', 'no', 100, 1, 15, 0, NULL, NULL, NULL),
(2, 'gender', 'VARCHAR', 'radio', 'male,female', 'no', 100, 1, 15, 0, NULL, NULL, NULL),
(3, 'relationship_status', 'VARCHAR', 'select', 'single,married,divorced,widowed', 'no', 100, 1, 15, 0, NULL, NULL, NULL),
(4, 'image', 'VARCHAR', 'file', 'jpg,png,jpeg,gif', 'no', 100, 1, 15, 0, NULL, NULL, NULL),
(5, 'education', 'VARCHAR', 'checkbox', 'matric,inter,bachlor', 'no', 255, 1, 15, 0, NULL, NULL, NULL),
(6, 'message', 'TEXT', 'textarea', '', 'no', 255, 1, 15, 0, NULL, NULL, NULL),
(7, 'Name', 'VARCHAR', 'input', '', 'no', 100, 1, 16, 0, NULL, NULL, NULL),
(8, 'Icon', 'VARCHAR', 'file', 'png,jpg,jpeg,gif', 'no', 255, 1, 16, 0, NULL, NULL, NULL),
(9, 'Name', 'VARCHAR', 'input', '', 'no', 100, 1, 17, 0, NULL, NULL, NULL),
(10, 'Icon', 'VARCHAR', 'file', 'png,jpg,jpeg,gif', 'no', 255, 1, 17, 0, NULL, NULL, NULL),
(11, 'Title', 'VARCHAR', 'input', '', 'no', 255, 1, 18, 0, NULL, NULL, NULL),
(12, 'Description', 'TEXT', 'textarea', '', 'no', 500, 1, 18, 0, NULL, NULL, NULL),
(13, 'category', 'INT', 'input', '', 'no', 11, 1, 18, 1, 'id', 'blog_category', 'Name'),
(14, 'image', 'VARCHAR', 'file', 'png,jpg,jpeg,gif', 'no', 255, 1, 18, 0, NULL, NULL, NULL),
(15, 'Name', 'VARCHAR', 'input', '', 'no', 100, 1, 20, 0, NULL, NULL, NULL),
(16, 'Address', 'TEXT', 'textarea', '', 'no', 500, 0, 20, 0, NULL, NULL, NULL),
(17, 'Phone', 'INT', 'input', '', 'no', 100, 0, 20, 0, NULL, NULL, NULL),
(18, 'Email', 'INT', 'input', '', 'no', 100, 0, 20, 0, NULL, NULL, NULL),
(19, 'Client', 'INT', 'input', '', 'no', 11, 1, 21, 1, 'id', 'client', 'Name,Address'),
(20, 'Rider', 'INT', 'input', '', 'no', 11, 1, 21, 1, 'id', 'users', 'name'),
(21, 'Quantity', 'INT', 'input', '', 'no', 100, 1, 21, 0, NULL, NULL, NULL),
(22, 'Date', 'DATE', 'input', '', 'no', 100, 1, 21, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `Client` int(11) NOT NULL,
  `Rider` int(11) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Client`, `Rider`, `Quantity`, `Price`, `Date`, `user_id`, `created_at`) VALUES
(2, 2, 28, 20, 400, '2018-03-11', 2, '2018-03-10 18:32:09'),
(3, 2, 28, 10, 200, '2018-03-09', 2, '2018-03-11 00:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `client_id`, `amount`, `created_at`) VALUES
(1, 2, 500, '2018-03-11 00:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `view_all` int(11) NOT NULL DEFAULT '0',
  `created` int(11) DEFAULT '0',
  `edit` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `disable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `module_id`, `user_id`, `user_type_id`, `view`, `view_all`, `created`, `edit`, `deleted`, `disable`) VALUES
(194, 2, 2, 15, 1, 1, 1, 1, 1, 1),
(195, 3, 2, 15, 0, 0, 0, 0, 0, 0),
(196, 5, 2, 15, 0, 0, 0, 0, 0, 0),
(197, 7, 2, 15, 0, 0, 0, 0, 0, 0),
(216, 2, 2, 16, 0, 0, 0, 0, 0, 0),
(217, 3, 2, 16, 0, 0, 0, 0, 0, 0),
(218, 5, 2, 16, 0, 0, 0, 0, 0, 0),
(219, 7, 2, 16, 0, 0, 0, 0, 0, 0),
(220, 20, 2, 16, 0, 0, 0, 0, 0, 0),
(221, 21, 2, 16, 1, 0, 1, 0, 0, 0),
(222, 22, 2, 16, 0, 0, 0, 0, 0, 0),
(231, 2, 2, 1, 1, 1, 1, 1, 1, 1),
(232, 3, 2, 1, 1, 1, 1, 1, 1, 1),
(233, 5, 2, 1, 1, 1, 1, 1, 1, 1),
(234, 7, 2, 1, 1, 1, 1, 1, 1, 1),
(235, 20, 2, 1, 1, 1, 1, 1, 1, 1),
(236, 21, 2, 1, 1, 1, 1, 1, 1, 1),
(237, 22, 2, 1, 1, 1, 1, 1, 1, 1),
(238, 23, 2, 1, 1, 1, 1, 1, 1, 1),
(239, 24, 2, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(2, 'admin', 'admin@gmail.com', 'e6e061838856bf47e1de730719fb2609', 1),
(28, 'Usama', 'usama@gmail.com', '565074f3b5673ee26da150d2ff933e76', 15),
(29, 'talha', 'text@test.com', '3cc3d06306939024863d20714195ad70', 16);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `user_id`) VALUES
(1, 'Admin', 2),
(15, 'Rider', 2),
(16, 'Client', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliver_order`
--
ALTER TABLE `deliver_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_fileds`
--
ALTER TABLE `modules_fileds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deliver_order`
--
ALTER TABLE `deliver_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `modules_fileds`
--
ALTER TABLE `modules_fileds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
