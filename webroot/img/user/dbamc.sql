-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2016 at 06:20 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbamc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `cat_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`cat_id`, `type`, `title`, `status`, `created_date`, `create_by`) VALUES
(2, 'brand', 'brand1', 1, '2016-05-25 06:08:40', 0),
(3, 'category', 'cate1', 1, '2016-05-25 06:09:05', 0),
(4, 'unit', 'unit1', 1, '2016-05-25 06:09:20', 0),
(5, 'warehouse', 'ware1', 1, '2016-05-25 06:09:45', 0),
(6, 'brand', 'bradn2', 1, '2016-05-25 06:15:12', 0),
(7, 'category', 'cate2', 1, '2016-05-25 06:16:05', 0),
(8, 'unit', 'dfdsf', 1, '2016-05-25 06:16:39', 0),
(13, 'category', 'cate', 1, '2016-05-25 06:27:31', 0),
(14, 'category', 'cateee', 1, '2016-05-25 06:28:59', 0),
(15, 'unit', 'ddf', 1, '2016-05-25 06:31:39', 0),
(18, 'category', '22', 1, '2016-05-25 12:24:30', 0),
(19, 'brand', '5', 1, '2016-05-25 12:24:54', 0),
(20, 'unit', '2222', 1, '2016-05-25 12:25:04', 0),
(21, 'category', 'rrtr', 1, '2016-05-25 12:25:16', 0),
(22, 'warehouse', 'rrt', 1, '2016-05-25 12:25:28', 0),
(23, 'category', 'rer', 1, '2016-05-25 12:36:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_idf` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `alt_mobile` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_idf`, `company_name`, `company_address`, `city`, `state`, `pincode`, `mobile_no`, `alt_mobile`, `phone`, `email`, `photo`) VALUES
(1, '', 'dfdfdf', 'dfdfd', 'fdfdf', 'fdfdf', 'dfdfd', 'dfdf', 0, 'fdfdfdfdf', 'dfdfd', ''),
(2, 'dd', 'sfsfdsf', 'sfsf', 'sfsfsd', 'sfsfsfsfds', 'fsdfsf', 'sfsfsdf', 0, 'sfsdfdsfdsf', 'sfsdfsfsf', ''),
(3, 'dd', 'fsdfdsfsf', 'sfsf', 'sfsfsfs', 'sfdsfsf', 'fsfsf', 'sfsfs', 0, 'fsfssf', 'fsfsfs', ''),
(4, 'dd', 'sfsfsds', 'sfsfs', 'ssd', 'sfsdfsf', 'fsfsfsfsf', 'sfsdfdsf', 0, 'sfsdfdsfdsf', 'sdfsfdsf', ''),
(5, 'dd', 'sfsdfsd', 'sdfdsf', 'sfsdf', 'sdfdsf', 'sfsdfsdf', 'sdfsdf', 0, 'sdfsdf', 'sdfdsf', ''),
(6, 'dd', 'sfsf', 'sfsfsdf', 'sfsfsfs', 'sfsdfs', 'sfsfsf', 'sfsfsf', 0, 'sfsf', 'sfsfsf', ''),
(7, 'dd', 'sfsdfdsf', 'sfsf', 'sfsfsf', 'sfsdfs', 'fdsfsfdsf', 'sfsdfsdf', 0, 'sfsfsf', 'sfsfsf', ''),
(8, 'dd', 'sfsf', 'sfsf', 'sfsfsf', 'sfsf', 'sfsf', 'sfsf', 0, 'sfsf', 'sfsf', 'group.png'),
(9, 'C8146537', 'dsfsf', 'sfsfsdf', 'sfsdf', 'dfddfgdg', 'sfsfsf', 'sfsfsf', 0, 'sfsfs', 'sfsfs', 'slider2.png'),
(10, 'C922382', 'sfsf', 'sfsf', 'sfsf', 'sfsf', 'fsfsf', 'sfsf', 0, 'sfsf', 'sfsf', 'default.png'),
(11, 'C10062016', 'ssf', 'fsfsf', 'sfsfsfssfsf', 'sfsfsf', 'sfsf', 'sfsfsf', 0, 'sfsfs', 'sfsdfsf', 'group.png'),
(12, 'C11062016', 'sfsf', 'sfs', 'fsfsf', 'sfsdf', 'sfsf', 'sfsdf', 0, 'sfsf', 'sfsfs', 'about-image.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_no` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `open_stock` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `max_stock` int(11) NOT NULL,
  `specification` text NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `item_name`, `brand_id`, `model_no`, `product_code`, `category_id`, `short_name`, `price`, `unit_id`, `image`, `open_stock`, `min_stock`, `max_stock`, `specification`, `warehouse_id`, `product_qty`, `created_date`) VALUES
(2, 'sfsfsdf', 15, 'sfsfsdf', 'sfssfsdfsdf', 26, 'sfsdfsdf', '1200.00', 23, 'image-new.png', 0, 0, 0, '<p>fsfsdfsdf</p>', 35, 120, '2016-05-24 12:26:51'),
(3, 'sfsdfds', 15, '65436456', 'sfsfsdf', 21, 'sfsfsf', '1200.00', 27, 'image-new.png', 10, 20, 10, '<p>sfsdfdsfdsf</p>', 35, 120, '2016-05-24 12:26:51'),
(4, 'sfsdfds', 15, '65436456', 'sfsfsdf', 21, 'sfsfsf', '1200.00', 27, 'Untitled-2.png', 10, 20, 10, '<p>sfsdfdsfdsf</p>', 35, 120, '2016-05-24 12:26:51'),
(7, 'sfsdfsdfsdf', 2, 'sfsfsfsdfsfs', 'ssdfdsfdfdsfsfsdf', 7, 'sfsfsdfdsf', '0.00', 8, 'default.png', 0, 0, 0, '', 0, 0, '2016-05-25 06:10:29'),
(8, 'itemname12', 2, 'model12', 'product12', 3, 'shortname12', '12012.00', 4, 'i2.jpg', 15, 15, 15, '<p>sfsdfdsf</p>', 5, 180, '2016-05-25 06:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `generate_by` int(11) NOT NULL,
  `remark` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=canceled,1=complete,2=In-Progress',
  `billing_address` text NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `mobile` int(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`purchase_id`, `purchase_no`, `customer_name`, `purchase_date`, `generate_by`, `remark`, `status`, `billing_address`, `contact_person`, `mobile`, `email`, `created_date`, `created_by`) VALUES
(1, 101, '', '2016-05-26', 0, 'rt6rtyr', 1, 'ytryrtyry', 'rtyrty', 0, '', '2016-05-26 12:07:25', 0),
(2, 0, '', '2016-05-26', 0, '', 0, '', '', 0, '', '2016-05-26 12:14:37', 0),
(3, 0, '', '2016-05-30', 0, '', 0, '', '', 0, '', '2016-05-30 05:21:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_history`
--

CREATE TABLE `tbl_purchase_history` (
  `purchase_h_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_name` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `net_amount` double NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_history`
--

INSERT INTO `tbl_purchase_history` (`purchase_h_id`, `purchase_id`, `item_name`, `qty`, `price`, `net_amount`, `create_date`) VALUES
(1, 1, 3, 2, 1200, 2400, '2016-05-26 12:07:25'),
(2, 2, 8, 10, 12012, 120120, '2016-05-26 12:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `client_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `marital_status` varchar(30) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `alt_mobile` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `client_id`, `first_name`, `middle_name`, `last_name`, `dob`, `gender`, `marital_status`, `company_id`, `branch_id`, `address`, `city`, `state`, `pincode`, `mobile_no`, `alt_mobile`, `phone`, `email`, `photo`, `role`) VALUES
(1, '', 'sfsf', 'sfsfs', 'sfsf', '0000-00-00', 'Female', 'Married', 2, 0, 'sfsf', 'sfsf', 'sfsf', '0', 'sfsfs', '', 'sfss', 'sss', 'about_icon.png', 'client'),
(2, '', 'wwr', 'wrwr', 'wrwr', '0000-00-00', 'Female', 'Married', 0, 0, 'wrwr', 'wrwr', 'wrwr', '0', 'wrwr', '', 'wrwr', 'wrwr', 'about-image.png', 'client'),
(3, 'C37062016', 'sfsf', '', 'sfsfsfs', '0000-00-00', 'Female', 'Married', 0, 0, 'sfsdfds', 'sfsdfsd', 'sfsf', '0', 'ssfsdfsf', '', 'sfdsfs', 'sdfsfsf', 'about-image.png', 'client'),
(4, 'C97062016', 'sfsf', 'sfsfsdf', 'sfsdfsdf', '0000-00-00', 'Male', 'Unmarried', 0, 0, 'sfsfsf', 'sfsfsfsf', 'ssfsdf', '0', 'sfsdf', '', 'sfsfs', 'sfsf', 'about-image.png', 'client'),
(5, 'C60062016', '', '', '', '0000-00-00', '', '', 0, 0, '', '', '', '23423423', '', '', '', '', 'default.png', 'client'),
(6, 'C39062016', '', 's', '', '0000-00-00', 'Male', 'Unmarried', 0, 0, '', '', '', '0', '', '', '', '', 'default.png', 'client'),
(7, 'C58062016', '', '', '', '0000-00-00', '', '', 0, 0, '', '', '', '0', '', '', '', '', 'default.png', 'client'),
(8, 'C29062016', '', 'sdfsd', '', '2016-06-21', '', '', 0, 0, '', '', '', '0', '', '', '', '', 'default.png', 'client'),
(9, 'C73062016', 'd', '', 'fdfdf', '2016-06-21', '', '', 2, 0, 'gfg', 'ggfg', 'fgf', '0', 'fgfg', '', 'fgf', 'fgfg', 'about_icon.png', 'client'),
(10, 'C29062016', '', '', '', '0000-00-00', '', '', 0, 0, '', '', '', '0', '', 'f34535435435', '', '', 'default.png', 'client'),
(11, 'C44062016', 'dd', '', 'dd', '2016-06-01', 'Male', 'Married', 2, 0, 'cxcxc', 'xcxcxc', 'cxcxc', 'xcxcx', 'xcxc', 'xcxc', 'xcxc', 'xcxc', 'about-image.png', 'client'),
(12, 'C35062016', 'dfef', '', 'dfdf', '2016-06-10', 'Male', 'Married', 1, 0, 'dfddf', 'dfd', 'dd', 'fdfd', 'dddf', 'dfd', 'dfdfdf', 'ddfd', 'about_icon.png', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`cat_id`) KEY_BLOCK_SIZE=11;

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`) KEY_BLOCK_SIZE=11;

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`) KEY_BLOCK_SIZE=11;

--
-- Indexes for table `tbl_purchase_history`
--
ALTER TABLE `tbl_purchase_history`
  ADD PRIMARY KEY (`purchase_h_id`) KEY_BLOCK_SIZE=11;

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_purchase_history`
--
ALTER TABLE `tbl_purchase_history`
  MODIFY `purchase_h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
