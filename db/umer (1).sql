-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 11:56 PM
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
-- Table structure for table `assign_rider`
--

CREATE TABLE `assign_rider` (
  `id` int(11) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Rider` int(11) DEFAULT NULL,
  `Area` varchar(500) DEFAULT NULL,
  `Day` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_rider`
--

INSERT INTO `assign_rider` (`id`, `Date`, `Rider`, `Area`, `Day`, `user_id`, `created_at`) VALUES
(4, '2018-06-08', 28, 'garden,gulshan', 'Friday', 2, '2018-06-04 20:35:19');

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
  `Price` int(100) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Day` varchar(100) NOT NULL,
  `deposit` int(100) NOT NULL,
  `deposit_date` date NOT NULL,
  `area` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `main_id`, `Name`, `Address`, `Phone`, `Price`, `Email`, `Day`, `deposit`, `deposit_date`, `area`, `user_id`, `created_at`) VALUES
(2, 29, 'Talha', 'xyz', 12345678, 60, 'text@test.com', 'Friday', 0, '0000-00-00', 'gulshan', 2, '2018-06-04 20:15:17'),
(3, 30, 'umer', 'xyz', 123455656, 90, 'umer@gmail.com', 'Friday', 0, '0000-00-00', 'garden', 2, '2018-06-04 20:14:55'),
(4, 31, 'testing', 'testimg', 2147483647, 70, 'testing@gmail.com', '', 1100, '2018-06-06', '', 2, '2018-06-04 19:13:05');

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
(3, 3, '2018-03-16', 10, 5, '2018-03-16 16:01:39'),
(4, 5, '2018-03-25', 20, 10, '2018-03-25 19:17:10'),
(5, 6, '2018-04-08', 50, 10, '2018-04-08 12:04:55');

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
(3, 'Modules', 'modules', 4, 'store', 'modules', 4),
(5, 'Role/Permission', 'role', 2, 'verified_user', 'role', 4),
(7, 'Users', 'user', 3, 'account_circle', 'users', 2),
(20, 'Client', 'client', 5, 'account_circle', 'client', 2),
(21, 'Orders', 'orders', 6, 'shopping_basket', 'orders', 2),
(22, 'Order Reporting', 'reporting', 7, 'report', 'reporting', 2),
(23, 'Pending Bottles', 'pending_bottles', 8, 'schedule', 'pending_bottles', 2),
(24, 'Rider Report', 'rider_reporting', 9, 'directions_bike', 'rider_reporting', 2),
(25, 'Assign Rider', 'assign_rider', 5, 'check', 'assign_rider', 2),
(26, 'Daily Sales Report', 'daily_sales_report', 8, 'timeline', 'daily_sales_report', 2),
(27, 'Invoice', 'invoice', 9, 'picture_as_pdf', 'invoice', 2);

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
(22, 'Date', 'DATE', 'input', '', 'no', 100, 1, 21, 0, NULL, NULL, NULL),
(23, 'Date', 'DATE', 'input', '', 'no', 100, 0, 25, 0, NULL, NULL, NULL),
(24, 'Rider', 'INT', 'input', '', 'no', 11, 0, 25, 1, 'id', 'users', 'name'),
(25, 'Client', 'VARCHAR', 'input', '', 'no', 500, 0, 25, 1, 'id', 'client', 'Name'),
(26, 'Date', 'DATE', 'input', '', 'no', 11, 1, 25, 0, NULL, NULL, NULL),
(27, 'Rider', 'INT', 'input', '', 'no', 11, 1, 25, 1, 'id', 'users', 'name'),
(28, 'Client', 'VARCHAR', 'input', '', 'no', 500, 1, 25, 1, 'id', 'client', 'Name');

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
  `remarks` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Client`, `Rider`, `Quantity`, `Price`, `Date`, `remarks`, `user_id`, `created_at`) VALUES
(2, 2, 28, 20, 400, '2018-03-16', '', 2, '2018-03-16 15:41:24'),
(3, 2, 28, 10, 200, '2018-03-16', '', 2, '2018-03-16 15:41:36'),
(4, 2, 0, 10, 600, '2018-03-17', '', 29, '2018-03-16 18:34:38'),
(5, 2, 28, 20, 1200, '2018-03-25', '', 28, '2018-03-25 19:17:10'),
(6, 2, 28, 50, 3000, '2018-04-08', '', 28, '2018-04-08 12:04:55');

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
(1, 2, 500, '2018-03-11 00:01:17'),
(3, 2, 800, '2018-04-08 12:04:55');

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
(261, 2, 2, 1, 1, 1, 1, 1, 1, 1),
(262, 3, 2, 1, 1, 1, 1, 1, 1, 1),
(263, 5, 2, 1, 1, 1, 1, 1, 1, 1),
(264, 7, 2, 1, 1, 1, 1, 1, 1, 1),
(265, 20, 2, 1, 1, 1, 1, 1, 1, 1),
(266, 21, 2, 1, 1, 1, 1, 1, 1, 1),
(267, 22, 2, 1, 1, 1, 1, 1, 1, 1),
(268, 23, 2, 1, 1, 1, 1, 1, 1, 1),
(269, 24, 2, 1, 1, 1, 1, 1, 1, 1),
(270, 25, 2, 1, 1, 1, 1, 1, 1, 1),
(271, 26, 2, 1, 1, 1, 1, 1, 1, 1),
(272, 27, 2, 1, 1, 1, 1, 1, 1, 1);

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
(29, 'talha', 'text@test.com', 'ceb6c970658f31504a901b89dcd3e461', 16),
(30, 'umer', 'umer@gmail.com', '6a8d11f37a9ece9ebc851ea11331160e', 16),
(31, 'testing@gmail.com', 'testing@gmail.com', '06e4dff3c420e66ae6927dc539ba82c6', 16);

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
-- Indexes for table `assign_rider`
--
ALTER TABLE `assign_rider`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `assign_rider`
--
ALTER TABLE `assign_rider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `deliver_order`
--
ALTER TABLE `deliver_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `modules_fileds`
--
ALTER TABLE `modules_fileds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
