-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2019 at 07:19 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_connection_type`
--

CREATE TABLE `forzaerp_connection_type` (
  `connection_type_id` int(15) NOT NULL,
  `connection_type_name` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_connection_type`
--

INSERT INTO `forzaerp_connection_type` (`connection_type_id`, `connection_type_name`) VALUES
(1, 'WIFI'),
(2, 'WIFI + 4G'),
(3, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_customer`
--

CREATE TABLE `forzaerp_customer` (
  `customer_id` int(15) NOT NULL,
  `customer_first_name` varchar(155) NOT NULL,
  `customer_last_name` varchar(155) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone_no` varchar(15) NOT NULL,
  `customer_type` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_customer`
--

INSERT INTO `forzaerp_customer` (`customer_id`, `customer_first_name`, `customer_last_name`, `customer_email`, `customer_phone_no`, `customer_type`) VALUES
(1, 'Norman', 'Garrison', 'sdthrussell@gmail.com', '', 1),
(2, 'simona', '', 'sdthrussell@gmail.com', '615370063', 1),
(3, 'simona', 'thrussell', 'multiple.awareness@hotmail.com', '0049615370063', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_customer_address`
--

CREATE TABLE `forzaerp_customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `street_no` int(15) NOT NULL,
  `addition` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_customer_address`
--

INSERT INTO `forzaerp_customer_address` (`address_id`, `customer_id`, `street_no`, `addition`, `street_name`, `postcode`, `city`, `country`) VALUES
(1, 1, 150, '', 'West 5th Street', '45202', 'Cincinnati', 'United States'),
(2, 2, 34, '', 'anna paulownahof', '5038VV', 'tilburg', ''),
(3, 3, 395, '', 'Kruidenlaan, 395', '5044CJ', 'Tilburg', 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_customer_expected_quote`
--

CREATE TABLE `forzaerp_customer_expected_quote` (
  `order_id` int(11) NOT NULL,
  `quote` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_customer_shipping_status_type`
--

CREATE TABLE `forzaerp_customer_shipping_status_type` (
  `status_id` int(15) NOT NULL,
  `cshipping_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_customer_shipping_status_type`
--

INSERT INTO `forzaerp_customer_shipping_status_type` (`status_id`, `cshipping_status_name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Being picked'),
(4, 'On Hold'),
(5, 'Ready for shipping'),
(6, 'Ready for Pickup @ Forza'),
(7, 'Ready for Pickup @ Ophaalpunt'),
(8, 'Ready for Pickup by PostNL'),
(9, 'In transit to PostNL'),
(10, 'In Distribution'),
(11, 'Sorted'),
(12, 'In delivery'),
(13, 'Delivered @ customer'),
(14, 'Picked up @ Ophaalpunt'),
(15, 'Picked up @ Forza'),
(16, 'Manco Sorting'),
(17, 'Delayed'),
(18, 'Cancelled'),
(19, 'Credited'),
(20, 'Under investigation');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_departments`
--

CREATE TABLE `forzaerp_departments` (
  `user_department_id` int(10) NOT NULL,
  `user_department_name` enum('IT','production','logistics','sales','cs','finance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_departments`
--

INSERT INTO `forzaerp_departments` (`user_department_id`, `user_department_name`) VALUES
(1, 'IT'),
(2, 'production'),
(3, 'logistics'),
(4, 'sales'),
(5, 'cs'),
(6, 'finance');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device`
--

CREATE TABLE `forzaerp_device` (
  `device_id` int(11) NOT NULL,
  `device_IMEI` varchar(15) NOT NULL,
  `device_type` int(11) NOT NULL,
  `device_storage` int(11) NOT NULL,
  `device_connection` int(11) NOT NULL,
  `device_colour` int(11) NOT NULL,
  `Grade` int(1) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `sale_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device`
--

INSERT INTO `forzaerp_device` (`device_id`, `device_IMEI`, `device_type`, `device_storage`, `device_connection`, `device_colour`, `Grade`, `purchase_date`, `sale_date`) VALUES
(1, '355314081021353', 8, 1, 1, 1, NULL, NULL, NULL),
(2, '355691071406315', 6, 1, 1, 1, NULL, NULL, NULL),
(3, '356559081294964', 5, 1, 1, 1, NULL, NULL, NULL),
(4, '355693077163649', 4, 1, 1, 1, NULL, NULL, NULL),
(5, '358537058051409', 4, 2, 3, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_action_buttons`
--

CREATE TABLE `forzaerp_device_action_buttons` (
  `button_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `button_link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_action_types`
--

CREATE TABLE `forzaerp_device_action_types` (
  `action_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_action_types`
--

INSERT INTO `forzaerp_device_action_types` (`action_id`, `action_type`) VALUES
(1, 'CHECK'),
(2, 'SEND TO DEVICE CHECK'),
(3, 'SEND TO REPAIR 1'),
(4, 'SEND TO REPAIR 2'),
(5, 'SEND TO PR INSPECTION'),
(6, 'REDO REPAIR'),
(7, 'GRADE'),
(8, 'RECYCLE'),
(9, 'RETURN'),
(10, 'SEND TO INSPECTION');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_colour`
--

CREATE TABLE `forzaerp_device_colour` (
  `colour_id` int(15) NOT NULL,
  `colour_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_colour`
--

INSERT INTO `forzaerp_device_colour` (`colour_id`, `colour_name`) VALUES
(0, 'uncoloured'),
(1, 'Jet Black'),
(2, 'Red'),
(3, 'Rose Gold'),
(4, 'Silver'),
(5, 'Black'),
(6, 'Matte Black'),
(7, 'Gold'),
(8, 'White'),
(9, 'Blue'),
(10, 'Space Gray');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_grade`
--

CREATE TABLE `forzaerp_device_grade` (
  `grade_id` int(11) NOT NULL,
  `grade_name` enum('A Grade','B Grade','C Grade','0 Grade') NOT NULL,
  `language_1` varchar(50) NOT NULL,
  `language_2` varchar(50) NOT NULL,
  `language_3` varchar(50) NOT NULL,
  `language_4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_grade`
--

INSERT INTO `forzaerp_device_grade` (`grade_id`, `grade_name`, `language_1`, `language_2`, `language_3`, `language_4`) VALUES
(0, '0 Grade', '0', '0', '0', '0'),
(1, 'A Grade', 'Zo goed als nieuw', 'Comme neuf', 'As good as new', 'Wie neu'),
(2, 'B Grade', 'Licht gebruikt', 'Legerement utilise', 'Slightly used', 'Leicht gebraucht'),
(3, 'C Grade', 'Zichtbaar gebruikt', 'Visiblement utilise', 'Visibly used', 'Sichtbar gebraucht');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_history`
--

CREATE TABLE `forzaerp_device_history` (
  `entry_id` int(15) NOT NULL,
  `imei` bigint(15) NOT NULL,
  `date` date NOT NULL,
  `event_type` int(15) NOT NULL,
  `event_stream` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_inventory`
--

CREATE TABLE `forzaerp_device_inventory` (
  `inv_device_id` int(11) NOT NULL,
  `IMEI` varchar(15) NOT NULL,
  `location_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_inventory`
--

INSERT INTO `forzaerp_device_inventory` (`inv_device_id`, `IMEI`, `location_code`) VALUES
(1, '355426078549266', 1),
(2, '355429077486464', 1),
(3, '353259074453841', 1),
(4, '112222222222222', 1),
(5, '777788889999999', 1),
(6, '666666667788778', 1),
(7, '111111111122222', 2),
(8, '999999998888888', 2),
(9, '358534051779987', 2),
(10, '445566778899011', 1),
(11, '355314081021353', 2),
(12, '355691071406315', 2),
(13, '356559081294964', 1),
(14, '355693077163649', 2),
(15, '358537058051409', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_model`
--

CREATE TABLE `forzaerp_device_model` (
  `device_id` int(15) NOT NULL,
  `device_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_model`
--

INSERT INTO `forzaerp_device_model` (`device_id`, `device_model`) VALUES
(1, 'IPhone SE'),
(2, 'IPhone 6'),
(3, 'IPhone 6S'),
(4, 'IPhone 6S Plus'),
(5, 'IPhone 7'),
(6, 'IPhone 8'),
(7, 'IPad 4'),
(8, 'IPad Mini 1'),
(9, 'IPad Mini 2'),
(10, 'IPad Mini 3'),
(11, 'IPad Mini 4'),
(12, 'IPad Air 1'),
(13, 'IPad Air 2'),
(14, 'IPad 2017'),
(15, 'IPhone 7Plus'),
(16, 'IPhone 4S'),
(17, 'IPhone 5'),
(18, 'IPhone 5S'),
(19, 'IPhone X'),
(20, 'Ipad Pro 9.7'),
(21, 'Iphone 8 PLUS'),
(22, 'Iphone 5c'),
(23, 'Iphone 6 PLUS'),
(24, 'IPad3'),
(25, 'IPad2');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_status`
--

CREATE TABLE `forzaerp_device_status` (
  `entry_id` int(11) NOT NULL,
  `device_imei` bigint(15) NOT NULL,
  `device_status` int(11) NOT NULL,
  `next_action` int(11) NOT NULL,
  `stream_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_status_types`
--

CREATE TABLE `forzaerp_device_status_types` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_status_types`
--

INSERT INTO `forzaerp_device_status_types` (`status_id`, `status_name`) VALUES
(1, 'RECEIVED'),
(2, 'CHECKED'),
(3, 'INSPECTED'),
(4, 'REPAIRED 1'),
(5, 'REPAIRED 2'),
(6, 'PR INSPECTION PASSED'),
(7, 'PR INSPECTION FAILED'),
(8, 'RETURNED'),
(9, 'RMA'),
(10, 'RECYCLED'),
(11, 'OUT OF WARRANTY'),
(12, 'REPLACED'),
(13, 'SCANNED IN');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_storage_type`
--

CREATE TABLE `forzaerp_device_storage_type` (
  `storage_type_id` int(15) NOT NULL,
  `storage_type_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_storage_type`
--

INSERT INTO `forzaerp_device_storage_type` (`storage_type_id`, `storage_type_name`) VALUES
(1, '16 GB'),
(2, '32 GB'),
(3, '64 GB'),
(4, '128 Gb'),
(5, '256 GB');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_device_type`
--

CREATE TABLE `forzaerp_device_type` (
  `device_type_id` int(11) NOT NULL,
  `device_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_device_type`
--

INSERT INTO `forzaerp_device_type` (`device_type_id`, `device_type_name`) VALUES
(1, 'IPhone'),
(2, 'IPad'),
(3, 'Macbook'),
(4, 'Accessory');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_eav_device_part`
--

CREATE TABLE `forzaerp_eav_device_part` (
  `deviceid` int(11) DEFAULT NULL,
  `partid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `forzaerp_eav_device_part`
--

INSERT INTO `forzaerp_eav_device_part` (`deviceid`, `partid`) VALUES
(1, 4),
(1, 5),
(1, 6),
(1, 10),
(1, 14),
(1, 18),
(1, 20),
(1, 27),
(1, 29),
(1, 30),
(2, 2),
(2, 4),
(2, 6),
(2, 7),
(2, 8),
(2, 10),
(2, 13),
(2, 15),
(2, 18),
(2, 19),
(2, 21),
(2, 22),
(2, 23),
(2, 25),
(2, 27),
(2, 29),
(2, 32),
(2, 39),
(2, 47),
(2, 49),
(2, 50),
(2, 53),
(2, 54),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 63),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(3, 3),
(3, 4),
(3, 9),
(3, 10),
(3, 14),
(3, 16),
(3, 18),
(3, 20),
(3, 26),
(3, 27),
(3, 29),
(3, 30),
(3, 40),
(3, 41),
(3, 42),
(3, 48),
(3, 51),
(3, 55),
(3, 56),
(3, 58),
(3, 60),
(3, 62),
(4, 4),
(4, 9),
(4, 10),
(4, 14),
(4, 18),
(4, 20),
(4, 26),
(4, 27),
(4, 29),
(4, 30),
(4, 40),
(5, 11),
(5, 14),
(5, 16),
(5, 18),
(5, 20),
(5, 24),
(5, 29),
(5, 30),
(5, 43),
(5, 83),
(5, 84),
(5, 85),
(6, 12),
(6, 17),
(6, 45),
(10, 12),
(15, 14),
(15, 18),
(15, 20),
(15, 29),
(15, 30),
(17, 6),
(17, 31),
(18, 1),
(18, 4),
(18, 5),
(18, 6),
(18, 8),
(18, 15),
(18, 18),
(18, 19),
(18, 23),
(18, 28),
(18, 31),
(18, 33),
(18, 34),
(18, 35),
(18, 36),
(18, 37),
(18, 38),
(18, 64),
(18, 77),
(18, 78),
(18, 79),
(18, 80),
(18, 81),
(18, 82),
(19, 12),
(21, 12),
(22, 1),
(22, 5),
(22, 6),
(22, 18),
(22, 19),
(22, 28),
(22, 31),
(22, 34),
(22, 35),
(22, 36),
(22, 37),
(22, 38),
(22, 64),
(22, 77),
(22, 78),
(22, 79),
(22, 80),
(22, 81),
(22, 82),
(23, 4),
(23, 6),
(23, 8),
(23, 10),
(23, 13),
(23, 15),
(23, 18),
(23, 19),
(23, 21),
(23, 23),
(23, 27),
(23, 31),
(23, 39),
(23, 63),
(23, 65),
(23, 66),
(23, 67),
(23, 68),
(23, 69),
(23, 70);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_events`
--

CREATE TABLE `forzaerp_events` (
  `event_id` int(15) NOT NULL,
  `event_type` int(15) NOT NULL,
  `imei` bigint(15) NOT NULL,
  `event_stream` int(11) NOT NULL,
  `user_id` int(15) NOT NULL,
  `event_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_status` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_events`
--

INSERT INTO `forzaerp_events` (`event_id`, `event_type`, `imei`, `event_stream`, `user_id`, `event_start`, `event_end`, `event_status`) VALUES
(1, 2, 355314081021353, 1, 1, '2019-05-28 17:11:42', '0000-00-00 00:00:00', 0),
(2, 1, 355314081021353, 1, 1, '2019-05-28 17:11:56', '0000-00-00 00:00:00', 0),
(3, 1, 355314081021353, 1, 1, '2019-05-28 17:12:07', '0000-00-00 00:00:00', 0),
(4, 2, 358534051779987, 1, 1, '2019-05-28 17:12:40', '0000-00-00 00:00:00', 0),
(5, 1, 358534051779987, 1, 1, '2019-05-28 17:12:58', '0000-00-00 00:00:00', 0),
(6, 1, 358534051779987, 1, 1, '2019-05-28 17:13:10', '0000-00-00 00:00:00', 0),
(7, 2, 355691071406315, 1, 1, '2019-05-28 17:13:39', '0000-00-00 00:00:00', 0),
(8, 1, 355691071406315, 1, 1, '2019-05-28 17:13:52', '0000-00-00 00:00:00', 0),
(9, 1, 355691071406315, 1, 1, '2019-05-28 17:14:03', '0000-00-00 00:00:00', 0),
(10, 2, 356559081294964, 1, 1, '2019-05-28 17:17:23', '0000-00-00 00:00:00', 0),
(11, 1, 356559081294964, 1, 1, '2019-05-28 17:17:36', '0000-00-00 00:00:00', 0),
(12, 1, 356559081294964, 1, 1, '2019-05-28 17:17:49', '0000-00-00 00:00:00', 0),
(13, 2, 355693077163649, 1, 1, '2019-05-28 17:18:22', '0000-00-00 00:00:00', 0),
(14, 1, 355693077163649, 1, 1, '2019-05-28 17:23:12', '0000-00-00 00:00:00', 0),
(15, 1, 355693077163649, 1, 1, '2019-05-28 17:23:25', '0000-00-00 00:00:00', 0),
(16, 2, 358537058051409, 1, 1, '2019-06-05 10:17:59', '0000-00-00 00:00:00', 0),
(17, 2, 358537058051409, 1, 1, '2019-06-05 10:19:49', '0000-00-00 00:00:00', 0),
(18, 1, 358537058051409, 1, 1, '2019-06-07 05:10:26', '0000-00-00 00:00:00', 0),
(19, 1, 358537058051409, 1, 1, '2019-06-07 08:47:57', '0000-00-00 00:00:00', 0),
(20, 2, 356559081294964, 1, 1, '2019-06-11 17:02:07', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_event_state`
--

CREATE TABLE `forzaerp_event_state` (
  `event_state_id` int(15) NOT NULL,
  `event_state_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_event_state`
--

INSERT INTO `forzaerp_event_state` (`event_state_id`, `event_state_name`) VALUES
(1, 'started'),
(2, 'completed'),
(3, 'aborted');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_event_streams`
--

CREATE TABLE `forzaerp_event_streams` (
  `stream_id` int(11) NOT NULL,
  `stream_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_event_streams`
--

INSERT INTO `forzaerp_event_streams` (`stream_id`, `stream_name`) VALUES
(1, 'Rebuy'),
(2, 'Repair'),
(3, 'Logistics'),
(4, 'Sales'),
(5, 'RMA'),
(6, 'Supply'),
(7, 'Returns');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_event_type`
--

CREATE TABLE `forzaerp_event_type` (
  `event_type_id` int(15) NOT NULL,
  `event_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_event_type`
--

INSERT INTO `forzaerp_event_type` (`event_type_id`, `event_name`) VALUES
(1, 'Inspection'),
(2, 'Check'),
(3, 'Picking'),
(4, 'Repair'),
(5, 'Repair2'),
(6, 'Grade'),
(7, 'RMA Intake'),
(8, 'Customer Support'),
(9, 'Sales Call'),
(10, 'RMA Accepted'),
(11, 'RMA Refused'),
(12, 'RMA submitted'),
(13, 'PRInspection'),
(14, 'Failcard');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection`
--

CREATE TABLE `forzaerp_inspection` (
  `order_id` int(11) NOT NULL,
  `buttons_inspection_id` int(11) NOT NULL,
  `camera_inspection_id` int(11) NOT NULL,
  `connections_inspection_id` int(11) NOT NULL,
  `misc_inspection_id` int(11) NOT NULL,
  `power_inspection_id` int(11) NOT NULL,
  `screen_inspection_id` int(11) NOT NULL,
  `sound_inspection_id` int(11) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `inspection_id` int(11) NOT NULL,
  `inspection_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection`
--

INSERT INTO `forzaerp_inspection` (`order_id`, `buttons_inspection_id`, `camera_inspection_id`, `connections_inspection_id`, `misc_inspection_id`, `power_inspection_id`, `screen_inspection_id`, `sound_inspection_id`, `device_imei`, `inspection_id`, `inspection_type`) VALUES
(1, 15, 0, 0, 0, 0, 0, 0, '355314081021353', 1, 1),
(1, 16, 0, 0, 0, 0, 0, 0, '358534051779987', 2, 1),
(1, 0, 7, 0, 0, 0, 0, 0, '355691071406315', 3, 1),
(2, 17, 0, 0, 0, 0, 0, 0, '356559081294964', 4, 1),
(2, 0, 8, 0, 0, 0, 0, 0, '355693077163649', 5, 1),
(3, 0, 0, 0, 0, 0, 0, 3, '358537058051409', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_buttons`
--

CREATE TABLE `forzaerp_inspection_details_buttons` (
  `buttons_insp_id` int(11) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `headset_jack` tinyint(4) NOT NULL,
  `power_button` tinyint(4) NOT NULL,
  `volume_flex_cable` tinyint(4) NOT NULL,
  `home_button` tinyint(4) NOT NULL,
  `touch_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_buttons`
--

INSERT INTO `forzaerp_inspection_details_buttons` (`buttons_insp_id`, `device_imei`, `headset_jack`, `power_button`, `volume_flex_cable`, `home_button`, `touch_id`) VALUES
(1, '357991058940528', 1, 0, 0, 0, 0),
(2, '355314081021353', 1, 0, 0, 0, 0),
(3, '355693077163643', 1, 0, 0, 0, 0),
(4, '358760050947958', 0, 0, 1, 0, 0),
(5, '357988051549454', 1, 0, 0, 0, 0),
(6, '358757058993455', 1, 0, 0, 0, 0),
(7, '139660060764231', 0, 0, 0, 1, 0),
(8, '358809059581175', 0, 1, 0, 0, 0),
(9, '138860078943861', 0, 0, 0, 1, 0),
(10, '138520097283292', 0, 0, 0, 0, 1),
(11, '355688077084989', 0, 0, 0, 1, 0),
(12, '355426078549266', 1, 1, 0, 0, 0),
(13, '666666667788778', 1, 0, 0, 0, 0),
(14, '445566778899011', 1, 0, 0, 0, 0),
(15, '355314081021353', 1, 0, 0, 0, 0),
(16, '358534051779987', 1, 0, 0, 0, 0),
(17, '356559081294964', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_camera`
--

CREATE TABLE `forzaerp_inspection_details_camera` (
  `camera_insp_id` int(15) NOT NULL,
  `device_imei` varchar(1) NOT NULL,
  `rear_camera` tinyint(4) NOT NULL,
  `front_camera` tinyint(4) NOT NULL,
  `front_camera _flex_cable` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_camera`
--

INSERT INTO `forzaerp_inspection_details_camera` (`camera_insp_id`, `device_imei`, `rear_camera`, `front_camera`, `front_camera _flex_cable`) VALUES
(1, '3', 1, 0, 0),
(2, '3', 1, 0, 0),
(3, '3', 1, 0, 0),
(4, '3', 1, 0, 0),
(5, '3', 0, 0, 1),
(6, '3', 0, 0, 1),
(7, '3', 1, 0, 0),
(8, '3', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_connections`
--

CREATE TABLE `forzaerp_inspection_details_connections` (
  `conn_insp_id` int(15) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `wifi_bt` tinyint(4) NOT NULL,
  `signal_strength` tinyint(4) NOT NULL,
  `no_cell_conn` tinyint(4) NOT NULL,
  `SIM_fail` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_connections`
--

INSERT INTO `forzaerp_inspection_details_connections` (`conn_insp_id`, `device_imei`, `wifi_bt`, `signal_strength`, `no_cell_conn`, `SIM_fail`) VALUES
(1, '139660073589371', 0, 0, 0, 1),
(2, '358535057024450', 1, 0, 0, 0),
(3, '358536052499481', 1, 0, 0, 0),
(4, '359314065274369', 0, 0, 1, 0),
(5, '358568078752858', 0, 0, 1, 0),
(6, '353259074453841', 1, 0, 0, 0),
(7, '999999998888888', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_misc`
--

CREATE TABLE `forzaerp_inspection_details_misc` (
  `misc_insp_id` int(15) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `vibration_motor` tinyint(4) NOT NULL,
  `GPS` tinyint(4) NOT NULL,
  `torch` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_misc`
--

INSERT INTO `forzaerp_inspection_details_misc` (`misc_insp_id`, `device_imei`, `vibration_motor`, `GPS`, `torch`) VALUES
(1, '358534051779987', 1, 0, 0),
(2, '358534051779987', 1, 0, 0),
(3, '355414074256516', 0, 1, 0),
(4, '112222222222222', 1, 0, 0),
(5, '358534051779987', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_power`
--

CREATE TABLE `forzaerp_inspection_details_power` (
  `power_insp_id` int(11) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `battery` tinyint(4) NOT NULL,
  `dock_connector_cable` tinyint(4) NOT NULL,
  `no_power` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_power`
--

INSERT INTO `forzaerp_inspection_details_power` (`power_insp_id`, `device_imei`, `battery`, `dock_connector_cable`, `no_power`) VALUES
(1, '352003060243225', 0, 1, 0),
(2, '352032061833668', 0, 0, 1),
(3, '355767078156648', 0, 1, 0),
(4, '355429077486464', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_screen`
--

CREATE TABLE `forzaerp_inspection_details_screen` (
  `screen_insp_id` int(15) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `LCD` tinyint(4) NOT NULL,
  `multi_touch` tinyint(4) NOT NULL,
  `image_quality` tinyint(4) NOT NULL,
  `ambient_light` tinyint(4) NOT NULL,
  `auto_brightness` tinyint(4) NOT NULL,
  `proximity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_screen`
--

INSERT INTO `forzaerp_inspection_details_screen` (`screen_insp_id`, `device_imei`, `LCD`, `multi_touch`, `image_quality`, `ambient_light`, `auto_brightness`, `proximity`) VALUES
(1, '358808052928318', 1, 0, 0, 0, 0, 0),
(2, '358534055422188', 1, 0, 0, 0, 0, 0),
(3, '355693071049624', 1, 0, 0, 0, 0, 0),
(4, '355697072917267', 1, 0, 0, 0, 0, 0),
(5, '356987062904444', 1, 0, 0, 0, 0, 0),
(6, '777788889999999', 1, 0, 0, 0, 0, 0),
(7, '111111111122222', 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_details_sound`
--

CREATE TABLE `forzaerp_inspection_details_sound` (
  `sound_insp_id` int(11) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `speakers` int(11) NOT NULL,
  `internal_speakers` int(11) NOT NULL,
  `microphone_bottom` int(11) NOT NULL,
  `microphone_back` int(11) NOT NULL,
  `front_speaker` int(11) NOT NULL,
  `microphone_top` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_details_sound`
--

INSERT INTO `forzaerp_inspection_details_sound` (`sound_insp_id`, `imei`, `speakers`, `internal_speakers`, `microphone_bottom`, `microphone_back`, `front_speaker`, `microphone_top`) VALUES
(1, '357990052485183', 1, 0, 0, 0, 0, 0),
(2, '358537051912292', 1, 0, 0, 0, 0, 0),
(3, '358537058051409', 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inspection_types`
--

CREATE TABLE `forzaerp_inspection_types` (
  `inspection_type_id` int(1) NOT NULL,
  `inspection_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inspection_types`
--

INSERT INTO `forzaerp_inspection_types` (`inspection_type_id`, `inspection_type_name`) VALUES
(1, 'Rebuy Inspection'),
(2, 'RMA Inspection'),
(3, 'Post Repair Inspection'),
(4, 'Supply Inspection');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_internal_shipping_status_type`
--

CREATE TABLE `forzaerp_internal_shipping_status_type` (
  `status_id` int(15) NOT NULL,
  `ishipping_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_internal_shipping_status_type`
--

INSERT INTO `forzaerp_internal_shipping_status_type` (`status_id`, `ishipping_status_name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Being picked'),
(4, 'On Hold'),
(5, 'Ready for shipping'),
(6, 'Ready for Pickup @ Forza'),
(7, 'Ready for Pickup @ Ophaalpunt'),
(8, 'Ready for Pickup by PostNL'),
(9, 'In transit to PostNL'),
(10, 'In Distribution'),
(11, 'Sorted'),
(12, 'In delivery'),
(13, 'Delivered @ customer'),
(14, 'Picked up @ Ophaalpunt'),
(15, 'Picked up @ Forza'),
(16, 'Manco Sorting'),
(17, 'Delayed'),
(18, 'Cancelled'),
(19, 'Credited'),
(20, 'Suspected fraud'),
(21, 'Under investigation');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_inventory_locations`
--

CREATE TABLE `forzaerp_inventory_locations` (
  `location_id` int(15) NOT NULL,
  `location_name` varchar(25) NOT NULL,
  `location_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_inventory_locations`
--

INSERT INTO `forzaerp_inventory_locations` (`location_id`, `location_name`, `location_code`) VALUES
(1, 'rebuy_inventory', 'RBI'),
(2, 'repair_inventory', 'RPI'),
(3, 'stock_inventory', 'STI'),
(4, 'warranty_inventory', 'WRI'),
(5, 'RMA_inventory', 'RMI'),
(6, 'Scrap_inventory', 'SCR');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_parts_inventory`
--

CREATE TABLE `forzaerp_parts_inventory` (
  `part_id` int(15) NOT NULL,
  `part_type` int(15) NOT NULL,
  `part_supplier` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_parts_suppliers`
--

CREATE TABLE `forzaerp_parts_suppliers` (
  `supplier_id` int(15) NOT NULL,
  `supplier_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_parts_suppliers`
--

INSERT INTO `forzaerp_parts_suppliers` (`supplier_id`, `supplier_name`) VALUES
(1, 'Jack'),
(2, 'Sandy'),
(3, 'Lenny'),
(4, 'Roy');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_post_repair_grade`
--

CREATE TABLE `forzaerp_post_repair_grade` (
  `imei` bigint(15) NOT NULL,
  `grading_date` date NOT NULL,
  `device_grade` int(11) NOT NULL,
  `graded_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_accepted_order_offers`
--

CREATE TABLE `forzaerp_rebuy_accepted_order_offers` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_action_buttons`
--

CREATE TABLE `forzaerp_rebuy_action_buttons` (
  `button_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `button_text` varchar(30) NOT NULL,
  `button_link` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_action_buttons`
--

INSERT INTO `forzaerp_rebuy_action_buttons` (`button_id`, `action_id`, `button_text`, `button_link`) VALUES
(1, 1, 'WAIT FOR DEVICE', 'status'),
(2, 2, 'CHECK IMEI', 'check'),
(3, 6, 'CHECK DEVICE', 'inspect'),
(4, 7, 'QUOTE DEVICE', 'quote'),
(5, 8, 'SEND OFFER', 'sendmail'),
(6, 9, 'SEND FOR PAYMENT', 'pay'),
(7, 14, 'WAIT FOR CUSTOMER', ''),
(8, 15, 'SET SECOND QUOTE', 'entersecondoffer'),
(9, 10, 'EMAIL SECOND OFFER', 'sendsecoffer'),
(10, 11, 'RETURN', 'return'),
(11, 12, 'RECYCLE DEVICE', 'recycledevice'),
(12, 13, 'CLOSE ORDER', 'closeorder'),
(13, 16, 'NO FURTHER ACTION', 'index'),
(14, 18, 'SET FAILCARD', 'failcard');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_action_status`
--

CREATE TABLE `forzaerp_rebuy_action_status` (
  `action_id` int(15) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_action_status`
--

INSERT INTO `forzaerp_rebuy_action_status` (`action_id`, `action_name`) VALUES
(1, 'WAIT FOR DEVICE TO BE RECEIVED'),
(2, 'CHECK IMEI'),
(3, 'INFORM POLICE DEVICE STOLEN'),
(4, 'INFORM CUSTOMER CHECK NOT PASSED'),
(5, 'RE-CHECK IMEI'),
(6, 'SEND TO DEVICE CHECK'),
(7, 'QUOTE DEVICE'),
(8, 'SEND FIRST OFFER'),
(9, 'SEND FOR PAYMENT'),
(10, 'SEND SECOND OFFER'),
(11, 'RETURN DEVICE'),
(12, 'RECYCLE DEVICE'),
(13, 'CLOSE ORDER'),
(14, 'WAIT FOR CUSTOMER TO ACCEPT'),
(15, 'SET SECOND OFFER'),
(16, 'Completed'),
(17, 'CHECK DEVICE'),
(18, 'SET FAILCARD');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_customer_estimation_types`
--

CREATE TABLE `forzaerp_rebuy_customer_estimation_types` (
  `est_type_id` int(15) NOT NULL,
  `est_type_name` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_customer_estimation_types`
--

INSERT INTO `forzaerp_rebuy_customer_estimation_types` (`est_type_id`, `est_type_name`) VALUES
(1, 'NOT FUNCTIONAL'),
(2, '100% FUNCTIONAL LIKE NEW OR LIGHT SIGNS OF USE'),
(3, '100%  FUNCTIONAL, VISIBLE SIGNS OF USE');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_customer_payment`
--

CREATE TABLE `forzaerp_rebuy_customer_payment` (
  `payment_id` int(11) NOT NULL,
  `cust_id` int(15) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cust_iban` varchar(18) NOT NULL,
  `cust_tnv` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_customer_payment`
--

INSERT INTO `forzaerp_rebuy_customer_payment` (`payment_id`, `cust_id`, `order_id`, `cust_iban`, `cust_tnv`) VALUES
(1, 1, 1, '44556677889910', 'Norman Garrison'),
(2, 2, 2, '44556677889910', 'Annelies Briesen'),
(3, 1, 1, '4636437272865488', 'simona thrussell'),
(4, 2, 2, '4636437272865488', 'Annelies Briesen'),
(5, 1, 1, '4636437272865', 'Norman Garrison'),
(6, 2, 2, '44556677889910', 'simona thrussell'),
(7, 3, 3, '4636437272865488', 'simona thrussell');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_customer_status_type`
--

CREATE TABLE `forzaerp_rebuy_customer_status_type` (
  `cust_status_id` int(15) NOT NULL,
  `cust_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_customer_status_type`
--

INSERT INTO `forzaerp_rebuy_customer_status_type` (`cust_status_id`, `cust_status_name`) VALUES
(1, 'ORDER CREATED'),
(2, 'DEVICE RECEIVED'),
(3, 'DEVICE SHIPPED'),
(4, 'OFFER ACCEPTED'),
(5, 'OFFER REFUSED'),
(6, 'RECYCLE DEVICE'),
(7, 'SECOND OFFER ACCEPTED'),
(8, 'SECOND OFFER REFUSED'),
(9, 'TO BE PAID'),
(10, 'PAID'),
(11, 'ORDER CLOSED'),
(12, 'RETURN DEVICE'),
(13, 'SUPPLIER ORDER'),
(14, 'DEVICE RECYCLED'),
(15, 'DEVICE RETURNED');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_customer_type`
--

CREATE TABLE `forzaerp_rebuy_customer_type` (
  `cust_type_id` int(15) NOT NULL,
  `cust_type_name` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_customer_type`
--

INSERT INTO `forzaerp_rebuy_customer_type` (`cust_type_id`, `cust_type_name`) VALUES
(1, 'INDIVIDUAL'),
(2, 'BUSINESS');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_device_accepted_offers`
--

CREATE TABLE `forzaerp_rebuy_device_accepted_offers` (
  `id` int(11) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `order_id` int(11) NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `quote_type` enum('1','2','','') NOT NULL,
  `accepted_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_device_accepted_offers`
--

INSERT INTO `forzaerp_rebuy_device_accepted_offers` (`id`, `imei`, `order_id`, `accepted`, `quote_type`, `accepted_date`) VALUES
(1, '355314081021353', 1, 1, '1', NULL),
(2, '358534051779987', 1, 1, '1', NULL),
(3, '355691071406315', 1, 1, '1', NULL),
(4, '356559081294964', 2, 0, '1', NULL),
(5, '355693077163649', 2, 0, '1', NULL),
(6, '358537058051409', 3, 0, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_device_check`
--

CREATE TABLE `forzaerp_rebuy_device_check` (
  `check_id` int(15) NOT NULL,
  `device_id` int(11) NOT NULL,
  `IMEI` varchar(15) NOT NULL,
  `stolen` tinyint(1) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_device_check`
--

INSERT INTO `forzaerp_rebuy_device_check` (`check_id`, `device_id`, `IMEI`, `stolen`, `checked`, `date`) VALUES
(1, 3, '355314081021353', 0, 1, NULL),
(2, 1, '358534051779987', 0, 1, NULL),
(3, 2, '355691071406315', 0, 1, NULL),
(4, 5, '356559081294964', 0, 1, NULL),
(5, 4, '355693077163649', 0, 1, NULL),
(6, 6, '358537058051409', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_device_condition`
--

CREATE TABLE `forzaerp_rebuy_device_condition` (
  `condition_id` int(15) NOT NULL,
  `condition_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_device_condition`
--

INSERT INTO `forzaerp_rebuy_device_condition` (`condition_id`, `condition_name`) VALUES
(1, 'NONFUNCTIONAL'),
(2, '100% FUNCTIONAL LIGHT USE'),
(3, '100%FUNCTIONAL VISIBLE USE'),
(4, 'SMALL REPAIR');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_device_quote`
--

CREATE TABLE `forzaerp_rebuy_device_quote` (
  `quote_id` int(11) NOT NULL,
  `quote_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_device_quote_table`
--

CREATE TABLE `forzaerp_rebuy_device_quote_table` (
  `quote_id` int(15) NOT NULL,
  `device_type_id` int(15) NOT NULL,
  `device_condition_id` int(15) NOT NULL,
  `device_connection_id` int(15) NOT NULL,
  `device_capacity` int(15) NOT NULL,
  `device_quote` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_device_quote_table`
--

INSERT INTO `forzaerp_rebuy_device_quote_table` (`quote_id`, `device_type_id`, `device_condition_id`, `device_connection_id`, `device_capacity`, `device_quote`) VALUES
(1, 1, 1, 3, 1, 40),
(2, 1, 1, 3, 2, 40),
(3, 1, 1, 3, 3, 40),
(4, 1, 4, 3, 1, 55),
(5, 1, 4, 3, 2, 60),
(6, 1, 4, 3, 3, 65),
(7, 1, 3, 3, 1, 70),
(8, 1, 3, 3, 2, 80),
(9, 1, 3, 3, 3, 90),
(10, 1, 2, 3, 1, 100),
(11, 1, 2, 3, 2, 110),
(12, 1, 2, 3, 3, 120),
(13, 2, 1, 3, 1, 35),
(14, 2, 1, 3, 3, 35),
(15, 2, 4, 3, 1, 50),
(16, 2, 4, 3, 3, 60),
(17, 2, 3, 3, 1, 75),
(18, 2, 3, 3, 3, 85),
(19, 2, 2, 3, 1, 100),
(20, 2, 2, 3, 3, 110);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_device_status`
--

CREATE TABLE `forzaerp_rebuy_device_status` (
  `device_order_id` int(15) NOT NULL,
  `device_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `imei` varchar(15) DEFAULT NULL,
  `forza_order_status` int(15) NOT NULL,
  `customer_order_status` int(11) NOT NULL,
  `next_action_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_device_status`
--

INSERT INTO `forzaerp_rebuy_device_status` (`device_order_id`, `device_id`, `order_id`, `imei`, `forza_order_status`, `customer_order_status`, `next_action_id`) VALUES
(1, 1, 1, '358534051779987', 15, 1, 16),
(2, 2, 1, '355691071406315', 15, 1, 16),
(3, 3, 1, '355314081021353', 15, 1, 16),
(4, 4, 2, '355693077163649', 14, 14, 13),
(5, 5, 2, '356559081294964', 7, 1, 13),
(6, 6, 3, '358537058051409', 17, 1, 19),
(7, 7, 3, '356559081294964', 4, 1, 6),
(8, 8, 3, '1', 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_forza_order_status_type`
--

CREATE TABLE `forzaerp_rebuy_forza_order_status_type` (
  `status_id` int(15) NOT NULL,
  `status_name` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_forza_order_status_type`
--

INSERT INTO `forzaerp_rebuy_forza_order_status_type` (`status_id`, `status_name`) VALUES
(1, 'ORDER RECEIVED'),
(2, 'LABEL SENT'),
(3, 'DEVICE RECEIVED'),
(4, 'IMEI CHECKED'),
(5, 'IMEI CHECK FAILED'),
(6, 'FAILCARD SET'),
(7, 'OFFER ACCEPTED'),
(8, ' OFFER NOT ACCEPTED'),
(9, 'OFFER SENT'),
(10, 'SECOND OFFER SENT'),
(11, 'TO BE PAID'),
(12, 'PAID'),
(13, 'DEVICE RETURNED'),
(14, 'DEVICE RECYCLED'),
(15, 'ORDER CLOSED'),
(16, 'DEVICE CHECKED'),
(17, 'QUOTED');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_forza_status_shipping`
--

CREATE TABLE `forzaerp_rebuy_forza_status_shipping` (
  `order_id` int(15) NOT NULL,
  `order_date` date NOT NULL,
  `order_shipping_status` varchar(15) NOT NULL,
  `order_received_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_inspection`
--

CREATE TABLE `forzaerp_rebuy_inspection` (
  `device_check_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_storage` varchar(255) NOT NULL,
  `device_connection` varchar(255) NOT NULL,
  `device_condition` varchar(255) NOT NULL,
  `device_colour` varchar(255) NOT NULL,
  `device_comments` text NOT NULL,
  `date` date DEFAULT NULL,
  `IMEI` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_inspection_failcard`
--

CREATE TABLE `forzaerp_rebuy_inspection_failcard` (
  `order_id` int(15) NOT NULL,
  `device_IMEI` varchar(15) NOT NULL,
  `failcard` tinyint(1) NOT NULL,
  `battery` tinyint(1) NOT NULL,
  `speakers` tinyint(1) NOT NULL,
  `lcd` tinyint(1) NOT NULL,
  `camera` tinyint(1) NOT NULL,
  `microphone` tinyint(1) NOT NULL,
  `powerbutton` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_inventory`
--

CREATE TABLE `forzaerp_rebuy_inventory` (
  `device_id` int(15) NOT NULL,
  `IMEI` int(20) NOT NULL,
  `order_id` int(15) NOT NULL,
  `device_type` int(15) NOT NULL,
  `device_condition` int(15) NOT NULL,
  `device_storage` int(15) NOT NULL,
  `device_connection` int(15) NOT NULL,
  `device_colour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_offers_aceptance`
--

CREATE TABLE `forzaerp_rebuy_offers_aceptance` (
  `offer_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order`
--

CREATE TABLE `forzaerp_rebuy_order` (
  `order_id` int(15) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `order_date` date NOT NULL,
  `payment_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_action_buttons`
--

CREATE TABLE `forzaerp_rebuy_order_action_buttons` (
  `button_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `button_link` varchar(50) NOT NULL,
  `button_text` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_order_action_buttons`
--

INSERT INTO `forzaerp_rebuy_order_action_buttons` (`button_id`, `action_id`, `button_link`, `button_text`) VALUES
(1, 1, '', 'WAIT FOR SHIPPING'),
(2, 2, 'checkorderimei', 'CHECK DEVICES'),
(3, 3, '', 'WAIT FOR ORDER TO BE PROCESSED'),
(4, 4, 'sendmail', 'SEND OFFER'),
(5, 5, 'process', 'PROCESS OFFER'),
(6, 6, 'entersecondoffer', 'Send Second Offer'),
(7, 7, 'pay', 'Send for Payment'),
(8, 8, 'returndevices', 'RETURN DEVICES'),
(9, 9, 'recycledevices', 'RECYCLE DEVICES'),
(10, 10, 'closeorder', 'CLOSE ORDER'),
(11, 11, '../devicestatus', 'NO FURTHER ACTION');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_action_types`
--

CREATE TABLE `forzaerp_rebuy_order_action_types` (
  `action_id` int(11) NOT NULL,
  `action_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_order_action_types`
--

INSERT INTO `forzaerp_rebuy_order_action_types` (`action_id`, `action_name`) VALUES
(1, 'WAIT FOR ORDER'),
(2, 'CHECK DEVICES'),
(3, 'WAIT FOR PROCESSING'),
(4, 'SEND OFFER'),
(5, 'PROCESS OFFER'),
(6, 'SEND SECOND OFFER'),
(7, 'SEND FOR PAYMENT'),
(8, 'RETURN DEVICES'),
(9, 'RECYCLE DEVICES'),
(10, 'CLOSE ORDER'),
(11, 'NO FURTHER ACTION');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_device`
--

CREATE TABLE `forzaerp_rebuy_order_device` (
  `device_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `device_type_id` int(15) NOT NULL,
  `device_storage_id` int(15) NOT NULL,
  `device_condition_id` int(15) NOT NULL,
  `device_connection_id` int(15) DEFAULT NULL,
  `device_colour_id` int(15) DEFAULT NULL,
  `device_imei` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_devices`
--

CREATE TABLE `forzaerp_rebuy_order_devices` (
  `entry_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `device_model` int(11) NOT NULL,
  `device_storage` int(11) NOT NULL,
  `device_grade` int(11) NOT NULL,
  `device_quote` int(11) NOT NULL,
  `device_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_offer`
--

CREATE TABLE `forzaerp_rebuy_order_offer` (
  `offer_id` int(15) NOT NULL,
  `offer` float NOT NULL,
  `imei` varchar(15) NOT NULL,
  `order_id` int(11) NOT NULL,
  `offer_type` enum('first offer','second offer','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_overview`
--

CREATE TABLE `forzaerp_rebuy_order_overview` (
  `order_id` int(15) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `customer_status` int(15) NOT NULL,
  `forza_status` int(15) NOT NULL,
  `last_action_date` date NOT NULL,
  `order_quote` float NOT NULL,
  `order_tag_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_quote`
--

CREATE TABLE `forzaerp_rebuy_order_quote` (
  `quote_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `order_quote` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_salestag`
--

CREATE TABLE `forzaerp_rebuy_order_salestag` (
  `order_id` int(15) NOT NULL,
  `sales_tag_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_secondquote`
--

CREATE TABLE `forzaerp_rebuy_order_secondquote` (
  `quote_id` int(11) NOT NULL,
  `quote` float NOT NULL,
  `imei` varchar(15) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_status`
--

CREATE TABLE `forzaerp_rebuy_order_status` (
  `status_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rebuy_order_status` int(15) NOT NULL,
  `next_action_id` int(11) NOT NULL,
  `customer_order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_status_types`
--

CREATE TABLE `forzaerp_rebuy_order_status_types` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_order_status_types`
--

INSERT INTO `forzaerp_rebuy_order_status_types` (`status_id`, `status_name`) VALUES
(1, 'ORDER CREATED'),
(2, 'RECEIVED AT FORZA'),
(3, 'ORDER PROCESSING'),
(4, 'OFFER SENT'),
(5, 'OFFER ACCEPTED IN FULL'),
(6, 'OFFER PROCESSING'),
(7, 'PAID'),
(8, 'ORDER CLOSED'),
(9, 'QUOTED'),
(10, 'DEVICES RETURNED'),
(11, 'DEVICES RECYCLED'),
(12, 'OFFER NOT ACCEPTED'),
(13, 'SECOND OFFER SENT'),
(14, 'SECOND OFFER ACCEPTED'),
(15, 'SECOND OFFER NOT ACCEPTED');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_order_totalquote`
--

CREATE TABLE `forzaerp_rebuy_order_totalquote` (
  `quote_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quote_type` enum('1','2') NOT NULL,
  `quote` float NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_payments`
--

CREATE TABLE `forzaerp_rebuy_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(15) NOT NULL,
  `offer` float NOT NULL,
  `customer_id` int(15) NOT NULL,
  `customer_payment_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_payment_action`
--

CREATE TABLE `forzaerp_rebuy_payment_action` (
  `order_id` int(15) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `payment_type_id` int(15) NOT NULL,
  `payment_amount` float NOT NULL,
  `payment_date` date NOT NULL,
  `payment status` enum('Paid','Awaiting Payment','Store Credit Issued') NOT NULL,
  `worker_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_payment_types`
--

CREATE TABLE `forzaerp_rebuy_payment_types` (
  `payment_type_id` int(15) NOT NULL,
  `payment_type` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_payment_types`
--

INSERT INTO `forzaerp_rebuy_payment_types` (`payment_type_id`, `payment_type`) VALUES
(0, 'supplier order'),
(1, 'IBAN'),
(2, 'Forza Credit'),
(3, 'supplier order');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_prices`
--

CREATE TABLE `forzaerp_rebuy_prices` (
  `price_id` int(11) NOT NULL,
  `price_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_prices`
--

INSERT INTO `forzaerp_rebuy_prices` (`price_id`, `price_amount`) VALUES
(1, 15),
(2, 20),
(3, 22.5),
(4, 30),
(5, 35),
(6, 40),
(7, 45),
(8, 50),
(9, 55),
(10, 60),
(11, 65),
(12, 70),
(13, 75),
(14, 80),
(15, 85),
(16, 90),
(17, 95),
(18, 100),
(19, 110),
(20, 120),
(21, 130),
(22, 140),
(23, 150),
(24, 160),
(25, 170),
(26, 180),
(27, 190),
(28, 200),
(29, 210),
(30, 220),
(31, 230),
(32, 240),
(33, 250),
(34, 260),
(35, 280),
(36, 320),
(37, 340),
(38, 350),
(39, 370),
(40, 420),
(41, 450);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_salesorders`
--

CREATE TABLE `forzaerp_rebuy_salesorders` (
  `entry_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sales_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_shipping`
--

CREATE TABLE `forzaerp_rebuy_shipping` (
  `order_id` int(15) NOT NULL,
  `shipping_status` int(15) NOT NULL,
  `shipping_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_shipping_status`
--

CREATE TABLE `forzaerp_rebuy_shipping_status` (
  `shipping_status_id` int(15) NOT NULL,
  `shipping_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rebuy_shipping_status`
--

INSERT INTO `forzaerp_rebuy_shipping_status` (`shipping_status_id`, `shipping_status_name`) VALUES
(1, 'DEVICE SENT'),
(2, 'SHIPPED'),
(3, 'RECEIVED'),
(4, 'SHIPPED TO CUSTOMER'),
(5, 'RECEIVED BY CUSTOMER'),
(6, 'LOST IN TRANSIT'),
(7, 'WAITING FOR SHIPPING');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rebuy_sublocation`
--

CREATE TABLE `forzaerp_rebuy_sublocation` (
  `subloc_id` int(15) NOT NULL,
  `subloc_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair1_parts_type`
--

CREATE TABLE `forzaerp_repair1_parts_type` (
  `part_type_id` int(15) NOT NULL,
  `device` int(15) NOT NULL,
  `part_type_name` varchar(150) NOT NULL,
  `supplier_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair1_parts_type`
--

INSERT INTO `forzaerp_repair1_parts_type` (`part_type_id`, `device`, `part_type_name`, `supplier_id`) VALUES
(1, 20, 'IPAD PRO 9.7 REAR CAMERA', 0),
(2, 20, 'IPAD PRO 9.7 POWERFLEX CABLE', 0),
(3, 14, 'Ipad 2017 COMPLETE FRONT DIGITIZER WHITE', NULL),
(4, 14, 'COMPLETE FRONT DIGITIZER BLACK', NULL),
(5, 14, 'LCD', NULL),
(6, 14, 'homebutton black', NULL),
(7, 14, 'homebutton white', NULL),
(8, 17, 'IPHONE 5 BACK CAMERA', NULL),
(9, 17, 'IPHONE 5 FRONT CAMERA + SENSORS', NULL),
(10, 17, 'IPHONE 5 EARSPEAKER', NULL),
(11, 17, 'IPHONE 5 POWER/VOLUME CIRCUIT', NULL),
(12, 17, 'IPHONE 5 SPEAKER ASSEM', NULL),
(13, 17, 'IPHONE 5 COMPLETE FRONT DIGITIZER AND LCD DISPLAY black', NULL),
(14, 17, 'IPHONE 5 COMPLETE FRONT DIGITIZER AND LCD DISPLAY white', NULL),
(15, 17, 'IPHONE 5 VIBRATOR / TRILMOTOR', NULL),
(16, 17, 'IPHONE 5 DOCK CONNECTOR WIT', NULL),
(17, 17, 'IPHONE 5 DOCK CONNECTOR ZWART', NULL),
(18, 17, 'IPHONE 5 HOME BUTTONFLEX', NULL),
(19, 17, 'IPHONE 5 HOME BUTTON BLACK', NULL),
(20, 17, 'IPHONE 5 HOME BUTTON WHITE', NULL),
(21, 17, 'IPHONE 5 WIFI ANTENNE', NULL),
(22, 18, 'WIFI ANTENNA', NULL),
(23, 18, 'IPHONE 5S DOCK CONNECTOR WHITE', NULL),
(24, 18, 'IPHONE 5S DOCK CONNECTOR BLACK', NULL),
(25, 18, 'IPHONE 5S BACK CAMERA', NULL),
(26, 18, 'IPHONE 5S FRONT CAMERA + SENSORS', NULL),
(27, 18, 'IPHONE 5S RECIEVER', NULL),
(28, 18, 'IPHONE 5S POWER/VOLUME CIRCUIT', NULL),
(29, 18, 'IPHONE 5S TRILMOTOR / vibrator', NULL),
(30, 18, 'IPHONE 5S SPEAKER ASSEM', NULL),
(31, 18, 'IPHONE 5S COMPLETE FRONT DIGITIZER AND LCD DISPLAY  black', NULL),
(32, 18, 'IPHONE 5S COMPLETE FRONT DIGITIZER AND LCD DISPLAY  White', NULL),
(33, 1, 'IPHONE SE DOCKCONNECTOR ZWART', NULL),
(34, 1, 'IPHONE SE DOCKCONNECTOR WIT', NULL),
(35, 1, 'IPHONE SE HOME BUTTON ROSE GOUD', NULL),
(36, 1, 'IPHONE SE VOLUME/POWER FLEX', NULL),
(37, 1, 'IPHONE SE FRONT CAMERA FLEX', NULL),
(38, 1, 'IPHONE SE REAR CAMERA', NULL),
(39, 13, 'IPAD AIR 2 COMPLETE FRONT DIGITIZTER BLACK', NULL),
(40, 13, 'IPAD AIR 2 COMPLETE FRONT DIGITIZER WHITE', NULL),
(41, 13, 'IPAD AIR 2 ACCU', NULL),
(42, 13, 'IPAD AIR 2 HOMEBUTTON BLACK', NULL),
(43, 13, 'IPAD AIR 2 HOMEBUTTON WHITE', NULL),
(44, 13, 'IPAD AIR 2 HOMEBUTTON GOLD', NULL),
(45, 13, 'IPAD AIR 2 FRONT CAMERA', NULL),
(46, 13, 'IPAD AIR 2 REAR CAMERA', NULL),
(47, 13, 'IPAD AIR 2 VOLUME FLEX CABLE', NULL),
(48, 13, 'IPAD AIR 2 POWER FLEX + MIC', NULL),
(49, 22, 'IPHONE 5C VIBRATOR', NULL),
(50, 22, 'IPHONE 5C WIFI FLEX', NULL),
(51, 22, 'IPHONE 5C DOCKCONNECTOR', NULL),
(52, 22, 'IPHONE 5C POWER/VOLUME CIRCUIT', NULL),
(53, 22, 'IPHONE 5C HOME BUTTON', NULL),
(54, 22, 'IPHONE 5C RECIEVER', NULL),
(55, 22, 'IPHONE 5C SPEAKER ASSEM', NULL),
(56, 22, 'IPHONE 5C FRONT CAMERA +SENSORS', NULL),
(57, 22, 'IPHONE 5C COMPLETE FRONT DIGITIZER AND LCD DISPLAY ', NULL),
(58, 22, 'IPHONE 5C REAR CAMERA', NULL),
(59, 22, 'IPHONE 5C HOME BUTTON FLEX', NULL),
(60, 2, 'IPHONE 6 COMPLETE FRONT DIGITIZER ASSEMBLY BLACK', NULL),
(61, 2, 'IPHONE 6 COMPLETE FRONT DIGITIZER ASSEMBLY WHITE', NULL),
(62, 2, 'IPHONE 6 WIFI-FLEX CABLE', NULL),
(63, 2, 'IPHONE 6 WIFI ANTENNA (BLOK)', NULL),
(64, 2, 'IPHONE 6 DOCK CONNECTOR FLEX GREY', NULL),
(65, 2, 'IPHONE 6 DOCK CONNECTOR FLEX WHITE', NULL),
(66, 2, 'IPHONE 6 FRONT CAMERA CIRCUIT', NULL),
(67, 2, 'IPHONE 6 LONG HOME FLEX', NULL),
(68, 2, 'IPHONE 6 RECIEVER', NULL),
(69, 2, 'IPHONE 6 SPEAKER ASSEM', NULL),
(70, 2, 'IPHONE 6 BACK CAMERA', NULL),
(71, 2, 'IPHONE 6 VIBRATOR', NULL),
(72, 2, 'IPHONE 6 VOLUME FLEX', NULL),
(73, 2, 'IPHONE 6 POWER FLEX', NULL),
(74, 23, 'IPHONE 6 PLUS COMPLETE FRONT DIGITIZER ASSEMBLY BLACK', NULL),
(75, 23, 'IPHONE 6 PLUS COMPLETE FRONT DIGITIZER ASSEMBLY WHITE', NULL),
(76, 23, 'IPHONE 6 PLUS POWER FLEX', NULL),
(77, 23, 'IPHONE 6 PLUS DOCKCONNECTOR GRAY', NULL),
(78, 23, 'IPHONE 6 PLUS DOCKCONNECTOR WHITE', NULL),
(79, 23, 'IPHONE 6 PLUS LONGHOME FLEX', NULL),
(80, 23, 'IPHONE 6 PLUS LOUDSPEAKER', NULL),
(81, 23, 'IPHONE 6 PLUS TRILMOTOR', NULL),
(82, 23, 'IPHONE 6 PLUS VOLUME BUTTON FLEX', NULL),
(83, 23, 'IPHONE 6 PLUS FRONT CAMERA WITH SENSOR', NULL),
(84, 23, 'IPHONE 6 PLUS WIFI ANTENNA', NULL),
(85, 23, 'IPHONE 6 PLUS BACK CAMERA', NULL),
(86, 23, 'IPHONE 6 PLUS EARSPEAKER', NULL),
(87, 23, 'IPHONE 6 PLUS WIFI FLEX (met block)', NULL),
(88, 12, 'IPAD AIR COMPLETE FRONT DIGITIZER BLACK', NULL),
(89, 12, 'IPAD AIR COMPLETE FRONT DIGITIZER WHITE', NULL),
(90, 12, 'IPAD AIR LCD', NULL),
(91, 12, 'IPAD AIR BATTERIJ', NULL),
(92, 12, 'IPAD AIR FRONT CAMERA', NULL),
(93, 12, 'IPAD AIR REAR CAMERA', NULL),
(94, 12, 'IPAD AIR HOMEBUTTON WHITE', NULL),
(95, 12, 'IPAD AIR HOMEBUTTON BLACK', NULL),
(96, 12, 'IPAD AIR DOCK CONNECTOR BLACK', NULL),
(97, 12, 'IPAD AIR DOCK CONNECTOR WHITE', NULL),
(98, 12, 'IPAD AIR HEADPHONE JACK WHITE', NULL),
(99, 12, 'IPAD AIR HEADPHONE JACK BLACK', NULL),
(100, 12, 'IPAD AIR WIFI FLEX', NULL),
(101, 12, 'IPAD AIR POWER/VOLUME FLEX', NULL),
(102, 11, 'IPAD MINI 4  LCD', NULL),
(103, 11, 'IPAD MINI 4 WIFI FLEX', NULL),
(104, 11, 'IPAD MINI 4 3G NETWORK FLEX', NULL),
(105, 11, 'IPAD MINI 4 POWER BUTTON', NULL),
(106, 11, 'IPAD MINI 4 HOME BUTTON GOLD', NULL),
(107, 11, 'IPAD MINI 4 HOME BUTTON BLACK', NULL),
(108, 11, 'IPAD MINI 4 HOME BUTTON WHITE', NULL),
(109, 11, 'IPAD MINI 4 ACCU', NULL),
(110, 11, 'IPAD MINI 4 COMPLETE FRONT DIGITIZER WHITE', NULL),
(111, 11, 'IPAD MINI 4 COMPLETE FRONT DIGITIZER BLACK', NULL),
(112, 3, 'IPHONE 6S POWER VOLUME FLEX', NULL),
(113, 3, 'IPHONE 6S DOCKCONNECTOR GRAY', NULL),
(114, 3, 'IPHONE 6S POWER VOLUME FLEX', NULL),
(115, 3, 'IPHONE 6S DOCKCONNECTOR GRAY', NULL),
(116, 3, 'IPHONE 6S DOCKCONNECTOR WHITE', NULL),
(117, 3, 'IPHONE 6S EARSPEAKER', NULL),
(118, 3, 'IPHONE 6S LOUDSPEAKER', NULL),
(119, 3, 'IPHONE 6S GPS ANTENNA', NULL),
(120, 3, 'IPHONE 6S WIFI ANTENNA', NULL),
(121, 3, 'IPHONE 6S VIBRATOR', NULL),
(122, 3, 'IPHONE 6S FRONT CAMERA', NULL),
(123, 3, 'IPHONE 6S REAR CAMERA', NULL),
(124, 3, 'IPHONE 6S SCHERM WIT', NULL),
(125, 3, 'IPHONE 6S SCHERM ZWART', NULL),
(126, 10, 'IPAD MINI 3 POWER/VOLUME FLEX CABLE', NULL),
(127, 10, 'IPAD MINI 3 HOMEBUTTON WHITE', NULL),
(128, 10, 'IPAD MINI 3 HOMEBUTTON GOLD', NULL),
(129, 10, 'IPAD MINI 3 HOMEBUTTON BLACK', NULL),
(130, 10, 'IPAD MINI 3 WIFI FLEX CABLE', NULL),
(131, 10, 'IPAD MINI 3 HEADPHONE JACK BLACK', NULL),
(132, 10, 'IPAD MINI 3 HEADPHONE JACK WHITE', NULL),
(133, 10, 'IPAD MINI 3 SPEAKERS', NULL),
(134, 10, 'IPAD MINI 3 COMPLETE FRONT DIGITIZER WHITE', NULL),
(135, 10, 'IPAD MINI 3 LCD', NULL),
(136, 4, 'IPHONE 6S PLUS DOCKCONNECTOR ZWART', NULL),
(137, 4, 'IPHONE 6S PLUS DOCKCONNECTOR WIT', NULL),
(138, 4, 'IPHONE 6S PLUS POWER FLEX', NULL),
(139, 4, 'IPHONE 6S PLUS EARSPEAKER', NULL),
(140, 4, 'IPHONE 6S PLUS LOUDSPEAKER', NULL),
(141, 4, 'IPHONE 6S PLUS LOUDSPEAKER ANTENNA', NULL),
(142, 4, 'IPHONE 6S PLUS GPS ANTENNA', NULL),
(143, 4, 'IPHONE 6S PLUS WIFI ANTENNA', NULL),
(144, 4, 'IPHONE 6S PLUS VIBRATOR', NULL),
(145, 4, 'IPHONE 6S PLUS FRONT CAMERA', NULL),
(146, 4, 'IPHONE 6S PLUS BACK CAMERA', NULL),
(147, 4, 'IPHONE 6S PLUS VOLUME FLEX', NULL),
(148, 4, 'IPHONE 6S PLUS LCD WIT', NULL),
(149, 4, 'IPHONE 6S PLUS LCD ZWART', NULL),
(150, 5, 'IPHONE 7 DOCKCONNECTOR ZWART', NULL),
(151, 5, 'IPHONE 7 DOCKCONNECTOR WIT', NULL),
(152, 5, 'IPHONE 7 POWER FLEX', NULL),
(153, 5, 'IPHONE 7 EARSPEAKER', NULL),
(154, 5, 'IPHONE 7 LOUDSPEAKER', NULL),
(155, 5, 'IPHONE 7 WIFI ANTENNA', NULL),
(156, 5, 'IPHONE 7 VIBRATOR', NULL),
(157, 5, 'IPHONE 7 FRONT CAMERA', NULL),
(158, 5, 'IPHONE 7 REAR CAMERA', NULL),
(159, 5, 'IPHONE 7 LCD WIT', NULL),
(160, 5, 'IPHONE 7 LCD ZWART', NULL),
(161, 15, 'IPHONE 7 PLUS DOCKCONNECTOR ZWART', NULL),
(162, 15, 'IPHONE 7 PLUS DOCKCONNECTOR WIT', NULL),
(163, 15, 'IPHONE 7 PLUS POWER FLEX', NULL),
(164, 15, 'IPHONE 7 PLUS EARSPEAKER', NULL),
(165, 15, 'IPHONE 7 PLUS LOUDSPEAKER', NULL),
(166, 15, 'IPHONE 7 PLUS WIFI ANTENNA', NULL),
(167, 15, 'IPHONE 7 PLUS VIBRATOR', NULL),
(168, 15, 'IPHONE 7 PLUS FRONT CAMERA', NULL),
(169, 15, 'IPHONE 7 PLUS REAR CAMERA', NULL),
(170, 15, 'IPHONE 7 PLUS LCD WIT', NULL),
(171, 15, 'IPHONE 7 PLUS LCD ZWART', NULL),
(172, 9, 'IPAD MINI 2 LCD', NULL),
(173, 9, 'IPAD MINI 2 DOCK CONNECTOR WHITE', NULL),
(174, 9, 'IPAD MINI 2 SPEAKERS', NULL),
(175, 9, 'IPAD MINI 2 HEADPHONE JACK BLACK', NULL),
(176, 9, 'IPAD MINI 2 HEADPHONE JACK WHITE', NULL),
(177, 9, 'IPAD MINI 2 POWER/VOLUME FLEX CABLE', NULL),
(178, 9, 'IPAD MINI 2 GPS FLEX CABLE', NULL),
(179, 9, 'IPAD MINI 2 WIFI FLEX CABLE', NULL),
(180, 9, 'IPAD MINI 2 ACCU', NULL),
(181, 9, 'IPAD MINI 2 REAR CAMERA MICROPHPONE', NULL),
(182, 9, 'IPAD MINI 2 DOCK CONNECTOR BLACK', NULL),
(183, 6, 'IPHONE 8 LCD COMPLETE BLACK', NULL),
(184, 6, 'IPHONE 8 LCD COMPLETE WHITE', NULL),
(185, 6, 'IPHONE 8 EAR SPEAKER', NULL),
(186, 6, 'IPHONE 8 BUZZER', NULL),
(187, 6, 'IPHONE 8 BUZZER CABLE', NULL),
(188, 6, 'IPHONE 8 POWER SWITCH FLEX CABLE', NULL),
(189, 6, 'IPHONE 8 REAR CAMERA', NULL),
(190, 6, 'IPHONE 8 CHARGING PORT BLACK', NULL),
(191, 6, 'IPHONE 8 CHARGING PORT WHITE', NULL),
(192, 6, 'IPHONE 8 CHARGING PORT GOLD', NULL),
(193, 6, 'IPHONE 8 VIBRATING MOTOR', NULL),
(194, 6, 'IPHONE 8 FRONT CAMERA FLEX CABLE', NULL),
(195, 6, 'IPHONE 8 HOME BUTTON BLACK', NULL),
(196, 6, 'IPHONE 8 HOME BUTTON WHITE', NULL),
(197, 6, 'IPHONE 8 LCD STEEL PLATE', NULL),
(198, 8, 'IPAD MINI COMPLETE FRONT DIGITIZER BLACK\r\n', NULL),
(199, 8, 'IPAD MINI COMPLETE FRONT DIGITIZER WHITE\r\n', NULL),
(200, 8, 'IPAD MINI POWER/VOLUME FLEX', NULL),
(201, 8, 'IPAD MINI FRONT CAMERA', NULL),
(202, 8, 'IPAD MINI REAR CAMERA', NULL),
(203, 8, 'IPAD MINI REAR CAMERA MICROPHONE', NULL),
(204, 8, 'IPAD MINI DOCK CONNECTOR BLACK', NULL),
(205, 8, 'IPAD MINI DOCK CONNECTOR WHITE', NULL),
(206, 8, 'IPAD MINI WIFI FLEX CABLE', NULL),
(207, 8, 'IPAD MINI HEADPHONE JACK WHITE', NULL),
(208, 8, 'IPAD MINI HEADPHONE JACK BLACK', NULL),
(209, 8, 'IPAD MINI ACCU', NULL),
(210, 8, 'IPAD MINI HOMEBUTTON BLACK', NULL),
(211, 8, 'IPAD MINI LCD BLACK', NULL),
(212, 21, 'IPHONE 8 PLUS EAR SPEAKER', NULL),
(213, 21, 'IPHONE 8 PLUS BUZZER', NULL),
(214, 21, 'IPHONE 8 PLUS BUZZER CABLE', NULL),
(215, 21, 'IPHONE 8 PLUS POWER SWITCH FLEX CABLE', NULL),
(216, 21, 'IPHONE 8 PLUS REAR CAMERA', NULL),
(217, 21, 'IPHONE 8 PLUS CHARGING PORT BLACK', NULL),
(218, 21, 'IPHONE 8 PLUS CHARGING PORT WHITE', NULL),
(219, 21, 'IPHONE 8 PLUS CHARGING PORT GOLD', NULL),
(220, 21, 'IPHONE 8 PLUS VIBRATING', NULL),
(221, 21, 'IPHONE 8 PLUS FRONT CAMERA', NULL),
(222, 21, 'IPHONE 8 PLUS DISPLAY WITH SMALL PARTS BLACK', NULL),
(223, 19, 'IPHONE X EAR SPEAKER WITH CABLE', NULL),
(224, 19, 'IPHONE X BUZZER', NULL),
(225, 19, 'IPHONE X BUZZER CABLE', NULL),
(226, 19, 'IPHONE X POWER SWITCH FLEX CABLE', NULL),
(227, 19, 'IPHONE X VOLUME FLEX CABLE', NULL),
(228, 19, 'IPHONE X REAR CAMERA', NULL),
(229, 19, 'IPHONE X CHARGING PORT BLACK', NULL),
(230, 19, 'IPHONE X CHARGING PORT WHITE', NULL),
(231, 19, 'IPHONE X VIBRATING MOTOR', NULL),
(232, 19, 'IPHONE X FRONT CAMERA', NULL),
(233, 19, 'IPHONE X LCD', NULL),
(234, 7, 'IPAD 4 FRONT CAMERA', NULL),
(235, 7, 'IPAD 4 BACK  CAMERA', NULL),
(236, 7, 'IPAD 4 HOMEBUTTON BLACK', NULL),
(237, 7, 'IPAD 4 HOMEBUTTON WHITE', NULL),
(238, 7, 'IPAD 4 SPEAKERS', NULL),
(239, 7, 'IPAD 4 WIFI FLEX', NULL),
(240, 7, 'IPAD 4 DOCKCONNECTOR', NULL),
(241, 7, 'IPAD 4 3G ANTENNAA', NULL),
(242, 24, 'IPAD 3 REAR CAMERA MICROPHONE\r\n', NULL),
(243, 24, 'IPAD 3 REAR CAMERA\r\n', NULL),
(244, 24, 'IPAD 3 WIFI ANTENNA', NULL),
(245, 24, 'IPAD 3G NETWORK FLEX', NULL),
(246, 24, 'IPAD 3 SPEAKERS', NULL),
(247, 24, 'IPAD 3 HEADPHONE JACK', NULL),
(248, 24, 'IPAD 3/4 COMPLETE FRONT DIGITIZER BLACK', NULL),
(249, 24, 'IPAD 3/4 COMPLETE FRONT DIGITIZER WHITE', NULL),
(250, 24, 'IPAD 3 DOCK CONNECTOR', NULL),
(251, 24, 'IPAD 3/4 POWER/VOLUME FLEX CABLE', NULL),
(252, 24, 'IPAD 3 FRONT CAMERA', NULL),
(253, 24, 'IPAD 3/4  LCD DISPLAY', NULL),
(254, 24, 'IPAD 3/4 BATTERIJ', NULL),
(255, 25, 'IPAD 2 VOLUME & POWER CONTROL FLEX', NULL),
(256, 25, 'IPAD 2 DOCKCONNECTOR', NULL),
(257, 25, 'IPAD 2 COMPLETE FRONT DIGITIZER BLACK', NULL),
(258, 25, 'IPAD 2 COMPLETE FRONT DIGITIZER WHITE', NULL),
(259, 25, 'IPAD 2 LCD', NULL),
(260, 25, 'IPAD 2 DOCKCONNECTOR', NULL),
(261, 25, 'IPAD 2 BACK CAMERA', NULL),
(262, 25, 'IPAD 2 FRONT CAMERA', NULL),
(263, 25, 'IPAD 2 WIFI CABLE', NULL),
(264, 25, 'IPAD 2 ACCU', NULL),
(265, 25, 'IPAD 2 3G NETWORK FLEX', NULL),
(266, 25, 'IPAD 2 HEADPHONE JACK + WIFI', NULL),
(267, 25, 'IPAD 2 SPEAKERS', NULL),
(268, 25, 'IPAD 2 HEADPHONE 3G CONNECTOR + WIFI', NULL),
(269, 25, 'IPAD 2 HOME BUTTON BLACK', NULL),
(270, 25, 'IPAD 2 HOME BUTTON WHITE', NULL),
(271, 25, 'IPAD 2 DISPLAY FLEX', NULL),
(272, 25, 'IPAD 2 BATTERY FLEX', NULL),
(273, 25, 'IPAD 2 REAR CAMERA MIC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair2_parts_type`
--

CREATE TABLE `forzaerp_repair2_parts_type` (
  `type_id` int(15) NOT NULL,
  `device_id` int(15) NOT NULL,
  `part_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair2_parts_type`
--

INSERT INTO `forzaerp_repair2_parts_type` (`type_id`, `device_id`, `part_name`) VALUES
(1, 1, 'camera strobe/flash driver IC'),
(2, 1, 'Touch IC SAGE'),
(3, 1, 'Touch IC CUMULUS'),
(4, 1, 'Tristar IC'),
(5, 1, 'TIGRIS CHARGER'),
(6, 1, 'Backlight coil'),
(7, 1, 'Display power manager CHESTNUT'),
(8, 1, 'backlight IC'),
(9, 1, 'Backlight diode'),
(10, 1, 'Backlight diode'),
(11, 17, 'Touch IC CUMULUS'),
(12, 17, 'Backlight diode'),
(13, 22, 'Wifi / Bluetooth chip'),
(14, 22, 'Touch IC SAGE'),
(15, 22, 'Touch IC CUMULUS'),
(16, 22, 'Display power manager CHESTNUT'),
(17, 22, 'Backlight IC'),
(18, 22, 'Backlight coil'),
(19, 22, 'Backlight diode'),
(20, 22, 'Oscar ic'),
(21, 22, 'Compass ic'),
(22, 22, 'Charging mosfet'),
(23, 22, 'ACCELEROMETER'),
(24, 22, 'Gyroscope'),
(25, 22, 'Cristal'),
(26, 22, 'Front camera connector'),
(27, 22, 'Power flex connector'),
(28, 22, 'Back camera connector'),
(29, 22, 'Touchscreen connector'),
(30, 22, 'LCD connector'),
(31, 22, 'Dock connector'),
(32, 18, 'Wifi / Bluetooth chip'),
(33, 18, 'camera strobe/flash driver IC'),
(34, 18, 'Touch IC SAGE'),
(35, 18, 'Touch IC CUMULUS'),
(36, 18, 'Camera LDO 2,85V'),
(37, 18, 'Audio codec IC'),
(38, 18, 'Display power manager CHESTNUT'),
(39, 18, 'Backlight IC'),
(40, 18, 'Charging mosfet'),
(41, 18, 'Backlight coil'),
(42, 18, 'Backlight diode'),
(43, 18, 'Power Management IC'),
(44, 18, 'Oscar ic'),
(45, 18, 'Compass ic'),
(46, 18, 'Charging mosfet'),
(47, 18, 'ACCELEROMETER'),
(48, 18, 'Gyroscope'),
(49, 18, 'Cristal'),
(50, 18, 'Front camera connector'),
(51, 18, 'Power flex connector'),
(52, 18, 'Back camera connector'),
(53, 18, 'Touchscreen connector'),
(54, 18, 'LCD connector'),
(55, 18, 'Dock connector'),
(56, 2, 'Wifi / Bluetooth chip'),
(57, 2, 'camera strobe/flash driver IC'),
(58, 23, 'camera strobe/flash driver IC'),
(59, 23, 'Touch IC CUMULUS'),
(60, 23, 'Camera LDO 2,85V'),
(61, 23, 'Tristar IC'),
(62, 23, 'TIGRIS CHARGER'),
(63, 23, 'Audio codec IC'),
(64, 23, 'Display power manager CHESTNUT'),
(65, 23, 'Backlight IC'),
(66, 23, 'Motor vibrator vibe driver ic'),
(67, 23, 'Charging mosfet'),
(68, 23, 'Backlight coil'),
(69, 23, 'Backlight diode'),
(70, 23, 'Filter'),
(71, 23, 'Baseband ic'),
(72, 23, 'Back camera Connector'),
(73, 23, 'touch screen connector'),
(74, 23, 'lcd connector'),
(75, 23, 'front camera connector'),
(76, 23, 'Home button connector'),
(77, 23, 'Dock connector'),
(78, 3, 'Wifi / Bluetooth chip'),
(79, 3, 'camera strobe/flash driver IC'),
(80, 3, 'Camera LDO 2,85V'),
(81, 3, 'Tristar IC'),
(82, 3, 'TIGRIS CHARGER '),
(83, 3, 'Audio codec IC'),
(84, 3, 'Display power manager CHESTNUT'),
(85, 3, 'backlight IC'),
(86, 3, 'Backlight Coil'),
(87, 3, 'Backlight coil'),
(88, 3, 'Backlight diode'),
(89, 3, 'Backlight diode'),
(90, 3, 'Backlight diode'),
(91, 3, 'backlight Filter '),
(92, 3, 'Backlight capacitor'),
(93, 3, 'BASEBAND POWERMANAGER'),
(94, 3, 'Power Amplifier IC'),
(95, 3, 'Power Amplifier IC'),
(96, 3, 'Antenna Switch IC'),
(97, 3, 'Antenna Switch IC'),
(98, 3, 'QFE DCDC IC'),
(99, 3, 'INTERMEDIATE RADIO FREQUENCY TRANSCEIVER'),
(100, 3, 'DIVERSITY MODULE IC');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_1`
--

CREATE TABLE `forzaerp_repair_1` (
  `repair_id` int(15) NOT NULL,
  `repair_date` date NOT NULL,
  `repaired_by` int(15) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `repair_part_1` varchar(50) DEFAULT NULL,
  `device_imei` varchar(15) NOT NULL,
  `status` enum('completed','sent to repair 2','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair_1`
--

INSERT INTO `forzaerp_repair_1` (`repair_id`, `repair_date`, `repaired_by`, `comments`, `repair_part_1`, `device_imei`, `status`) VALUES
(1, '2019-03-14', 4, 'Enter other repairs', 'IPHONE SE DOCKCONNECTOR ZWART', '355691070243230', 'completed'),
(2, '2019-03-27', 4, 'Enter other repairs', 'IPHONE 7 DOCKCONNECTOR ZWART', '355688076881716', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_2`
--

CREATE TABLE `forzaerp_repair_2` (
  `repair_id` int(15) NOT NULL,
  `repair_date` date NOT NULL,
  `repaired_by` int(15) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `repair_part_1` varchar(50) DEFAULT NULL,
  `device_imei` varchar(15) NOT NULL,
  `status` enum('completed','sent to repair 2','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_action_buttons`
--

CREATE TABLE `forzaerp_repair_action_buttons` (
  `button_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `button_text` varchar(30) NOT NULL,
  `button_link` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair_action_buttons`
--

INSERT INTO `forzaerp_repair_action_buttons` (`button_id`, `action_id`, `button_text`, `button_link`) VALUES
(1, 5, 'INSPECT', 'rmainspect'),
(2, 6, 'SEND TO REPAIR 1', 'dorepair'),
(3, 7, 'SEND TO REPAIR 2', 'dorepairtwo'),
(4, 15, 'SEND TO PR INSPECTION', 'PRinspect'),
(5, 8, 'RETURN DEVICE', 'returndevice'),
(6, 9, 'REPLACE DEVICE', 'replacedevice');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_action_types`
--

CREATE TABLE `forzaerp_repair_action_types` (
  `action_id` int(11) NOT NULL,
  `action_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair_action_types`
--

INSERT INTO `forzaerp_repair_action_types` (`action_id`, `action_name`) VALUES
(1, 'INSPECT'),
(2, 'SEND TO REPAIR 1'),
(3, 'SEND TO REPAIR 2'),
(4, 'SEND TO PR INSPECTION'),
(5, 'SEND TO RE-REPAIR'),
(6, 'SEND TO GRADING'),
(7, 'RETURN TO CLIENT'),
(8, 'ENTER TO SALE INVENTORY'),
(9, 'CLOSE REPAIR ORDER');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_orders`
--

CREATE TABLE `forzaerp_repair_orders` (
  `repair_id` int(15) NOT NULL,
  `imei` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `inspection_id` int(15) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair_orders`
--

INSERT INTO `forzaerp_repair_orders` (`repair_id`, `imei`, `date`, `inspection_id`, `type_id`) VALUES
(1, '111111111122222', '2019-05-26', 37, 2),
(2, '999999998888888', '2019-05-26', 38, 2),
(3, '358534051779987', '2019-05-26', 39, 2),
(4, '445566778899011', '2019-05-28', 40, 2),
(5, '355314081021353', '2019-05-28', 1, 2),
(6, '358534051779987', '2019-05-28', 2, 2),
(7, '355691071406315', '2019-05-28', 3, 2),
(8, '356559081294964', '2019-05-28', 4, 2),
(9, '355693077163649', '2019-05-28', 5, 2),
(10, '358537058051409', '2019-06-07', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_order_status`
--

CREATE TABLE `forzaerp_repair_order_status` (
  `order_id` int(15) NOT NULL,
  `imei` bigint(15) NOT NULL,
  `status_type` int(11) NOT NULL,
  `action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_order_status_types`
--

CREATE TABLE `forzaerp_repair_order_status_types` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair_order_status_types`
--

INSERT INTO `forzaerp_repair_order_status_types` (`status_id`, `status_name`) VALUES
(1, 'RECEIVED'),
(2, 'INSPECTED'),
(3, 'REPAIRED 1'),
(4, 'REPAIRED 2'),
(5, 'POST REPAIR INSPECTION PASSED'),
(6, 'POST REPAIR INSPECTION FAILED'),
(7, 'GRADED'),
(8, 'RETURNED');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_repair_order_type`
--

CREATE TABLE `forzaerp_repair_order_type` (
  `type_id` int(11) NOT NULL,
  `repair_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_repair_order_type`
--

INSERT INTO `forzaerp_repair_order_type` (`type_id`, `repair_type`) VALUES
(1, 'RMA'),
(2, 'STOCK REPAIR'),
(3, 'CUSTOMER REPAIR');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_retail_customer_payment`
--

CREATE TABLE `forzaerp_retail_customer_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `order_total` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_retail_customer_payment`
--

INSERT INTO `forzaerp_retail_customer_payment` (`payment_id`, `order_id`, `customer_id`, `payment_type_id`, `order_total`, `date`) VALUES
(0, 1, 3, 1, 200, '2019-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_retail_payment_data`
--

CREATE TABLE `forzaerp_retail_payment_data` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_retail_payment_type`
--

CREATE TABLE `forzaerp_retail_payment_type` (
  `payment_type_id` int(15) NOT NULL,
  `payment_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_retail_payment_type`
--

INSERT INTO `forzaerp_retail_payment_type` (`payment_type_id`, `payment_type_name`) VALUES
(1, 'Ideal'),
(2, 'Bancontact'),
(3, 'MasterCard'),
(4, 'Maestro'),
(5, 'Overbooking'),
(6, 'Visa'),
(7, 'PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_return_orders`
--

CREATE TABLE `forzaerp_return_orders` (
  `return_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `device_imei` bigint(15) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_action_buttons`
--

CREATE TABLE `forzaerp_rma_action_buttons` (
  `button_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `button_text` varchar(30) NOT NULL,
  `button_link` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rma_action_buttons`
--

INSERT INTO `forzaerp_rma_action_buttons` (`button_id`, `action_id`, `button_text`, `button_link`) VALUES
(1, 5, 'INSPECT', 'rmainspect'),
(2, 6, 'REPAIR 1', 'dorepair'),
(3, 7, 'REPAIR 2', 'dorepairtwo'),
(4, 15, 'PR INSPECTION', 'PRinspect'),
(5, 8, 'RETURN DEVICE', 'returndevice'),
(6, 9, 'REPLACE DEVICE', 'replacedevice'),
(7, 11, 'CLOSE RMA', 'closeorder');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_action_types`
--

CREATE TABLE `forzaerp_rma_action_types` (
  `action_id` int(15) NOT NULL,
  `action_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rma_action_types`
--

INSERT INTO `forzaerp_rma_action_types` (`action_id`, `action_name`) VALUES
(1, 'CREATE RMA'),
(2, 'ACCEPT RMA'),
(3, 'REFUSE RMA'),
(4, 'SEND TOKEN'),
(5, 'INSPECT'),
(6, 'SEND TO REPAIR 1'),
(7, 'SEND TO REPAIR 2'),
(8, 'RETURN DEVICE'),
(9, 'REPLACE DEVICE'),
(10, 'SEND PO'),
(11, 'CLOSE RMA'),
(12, 'REPAIR 2'),
(13, 'ACCEPT RMA'),
(14, 'REFUSE RMA'),
(15, 'SEND TO PR INSPECTION'),
(16, 'PRINT RETURN LABEL'),
(17, 'SEND EMAIL TO CUSTOMER');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_order`
--

CREATE TABLE `forzaerp_rma_order` (
  `rma_id` int(11) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `rma_date` date DEFAULT NULL,
  `imei` bigint(15) NOT NULL,
  `device_id` int(15) NOT NULL,
  `rma_approved_by` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_order_details`
--

CREATE TABLE `forzaerp_rma_order_details` (
  `rma_id` int(11) NOT NULL,
  `problem_id` int(15) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `device_imei` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_order_status`
--

CREATE TABLE `forzaerp_rma_order_status` (
  `rma_id` int(15) NOT NULL,
  `status_id` int(15) NOT NULL,
  `next_action_id` int(15) NOT NULL,
  `shipping_status_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_order_status_types`
--

CREATE TABLE `forzaerp_rma_order_status_types` (
  `status_id` int(15) NOT NULL,
  `status_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rma_order_status_types`
--

INSERT INTO `forzaerp_rma_order_status_types` (`status_id`, `status_type`) VALUES
(1, 'RMA CREATED'),
(2, 'Label SENT'),
(3, 'RECEIVED AT FORZA'),
(4, '	\r\nINSPECTED'),
(5, 'REPAIRED 1'),
(6, 'REPAIRED 2'),
(7, '	\r\nACCEPTED'),
(8, 'REPLACED'),
(9, 'RETURNED'),
(10, 'COMPLETED'),
(11, 'RMA NOT ACCEPTED'),
(12, 'POST REPAIR INSPECTION PASSED'),
(13, 'POST REPAIR INSPECTION FAILED'),
(14, 'LOST BY CARRIER'),
(15, 'REPAIR FAIL');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_order_steps`
--

CREATE TABLE `forzaerp_rma_order_steps` (
  `device_imei` bigint(20) NOT NULL,
  `breaks` int(11) NOT NULL,
  `liquid` int(11) NOT NULL,
  `turned_on` int(11) NOT NULL,
  `stuck` int(11) NOT NULL,
  `charging` int(11) NOT NULL,
  `reset` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_problem_code`
--

CREATE TABLE `forzaerp_rma_problem_code` (
  `problem_id` int(15) NOT NULL,
  `problem_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rma_problem_code`
--

INSERT INTO `forzaerp_rma_problem_code` (`problem_id`, `problem_name`) VALUES
(1, 'Battery'),
(2, 'Display'),
(3, 'Camera'),
(4, 'Network'),
(5, 'Crashes'),
(6, 'Microphone'),
(7, 'WiFi'),
(8, 'Speakers'),
(9, 'Buttons'),
(10, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_shipping`
--

CREATE TABLE `forzaerp_rma_shipping` (
  `rma_id` int(15) NOT NULL,
  `shipping_status` int(15) NOT NULL,
  `shipping_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_rma_shipping_status`
--

CREATE TABLE `forzaerp_rma_shipping_status` (
  `shipping_status_id` int(15) NOT NULL,
  `shipping_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_rma_shipping_status`
--

INSERT INTO `forzaerp_rma_shipping_status` (`shipping_status_id`, `shipping_status_name`) VALUES
(1, 'DEVICE SENT'),
(2, 'SHIPPED'),
(3, 'RECEIVED'),
(4, 'SHIPPED TO CUSTOMER'),
(5, 'RECEIVED BY CUSTOMER'),
(6, 'LOST IN TRANSIT'),
(7, 'WAITING FOR SHIPPING');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_salestag_order_events`
--

CREATE TABLE `forzaerp_salestag_order_events` (
  `order_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `event_date` int(11) NOT NULL,
  `event_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_inventory`
--

CREATE TABLE `forzaerp_sales_inventory` (
  `device_id` int(15) NOT NULL,
  `device_imei` varchar(15) NOT NULL,
  `device_type` int(15) NOT NULL,
  `device_grade` int(15) NOT NULL,
  `device_colour` int(15) NOT NULL,
  `device_storage` int(15) NOT NULL,
  `device_connection` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order`
--

CREATE TABLE `forzaerp_sales_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `device_price` float NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order`
--

INSERT INTO `forzaerp_sales_order` (`order_id`, `customer_id`, `device_price`, `payment_type_id`, `order_date`, `customer_type`) VALUES
(1, 3, 200, 1, '2019-05-21 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order_device`
--

CREATE TABLE `forzaerp_sales_order_device` (
  `order_id` int(15) NOT NULL,
  `device_type_id` int(15) NOT NULL,
  `device_storage_id` int(15) NOT NULL,
  `device_grade` enum('A','B','C','') NOT NULL,
  `device_connection_id` int(15) NOT NULL,
  `device_colour_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order_device`
--

INSERT INTO `forzaerp_sales_order_device` (`order_id`, `device_type_id`, `device_storage_id`, `device_grade`, `device_connection_id`, `device_colour_id`) VALUES
(1, 1, 1, 'A', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order_device_imei`
--

CREATE TABLE `forzaerp_sales_order_device_imei` (
  `order_id` int(15) NOT NULL,
  `device_imei` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order_device_imei`
--

INSERT INTO `forzaerp_sales_order_device_imei` (`order_id`, `device_imei`) VALUES
(1, '358809052767060');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order_state_type`
--

CREATE TABLE `forzaerp_sales_order_state_type` (
  `state_id` int(15) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order_state_type`
--

INSERT INTO `forzaerp_sales_order_state_type` (`state_id`, `state_name`) VALUES
(1, 'New'),
(2, 'Pending Payment'),
(3, 'Processing'),
(4, 'Complete'),
(5, 'Closed'),
(6, 'Cancelled'),
(7, 'On Hold'),
(8, 'Payment Review');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order_status`
--

CREATE TABLE `forzaerp_sales_order_status` (
  `order_id` int(15) NOT NULL,
  `order_status` int(15) NOT NULL,
  `order_state` int(15) NOT NULL,
  `internal_shipping_status` int(15) NOT NULL,
  `customer_shipping_status` int(15) NOT NULL,
  `next_action_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order_status`
--

INSERT INTO `forzaerp_sales_order_status` (`order_id`, `order_status`, `order_state`, `internal_shipping_status`, `customer_shipping_status`, `next_action_id`) VALUES
(1, 5, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order_status_type`
--

CREATE TABLE `forzaerp_sales_order_status_type` (
  `status_id` int(15) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order_status_type`
--

INSERT INTO `forzaerp_sales_order_status_type` (`status_id`, `status_name`) VALUES
(1, 'Order Placed'),
(2, 'Payment Pending'),
(3, 'Payment Completed'),
(4, 'Ready for Picking'),
(5, 'Order Picked'),
(6, 'Order Shipped'),
(7, 'Received By Customer'),
(8, 'Shipping Problem'),
(9, 'Closed'),
(10, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_order_tags`
--

CREATE TABLE `forzaerp_sales_order_tags` (
  `tag_id` int(15) NOT NULL,
  `tag_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_order_tags`
--

INSERT INTO `forzaerp_sales_order_tags` (`tag_id`, `tag_name`) VALUES
(1, 'Exchange'),
(2, 'marleen.smulders'),
(4, 'dave.ackermans'),
(5, 'pepijn.elissen'),
(8, 'Pieter Keijzer'),
(9, 'Newten Melcherts'),
(11, 'Michael Pique'),
(12, 'brigitte.sanger'),
(13, 'femke.vandenbrand');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_sales_shipping_status_type`
--

CREATE TABLE `forzaerp_sales_shipping_status_type` (
  `shipping_status_id` int(15) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_sales_shipping_status_type`
--

INSERT INTO `forzaerp_sales_shipping_status_type` (`shipping_status_id`, `status_name`) VALUES
(1, 'ORDER RECEIVED'),
(2, 'LABEL PRINTED'),
(3, 'READY FOR SHIPPING'),
(4, 'ORDER SHIPPED'),
(5, 'ORDER DELIVERED'),
(6, 'TO BE PICKED BY CUSTOMER'),
(7, 'READY TO BE PICKED BY CUSTOMER'),
(8, 'SHIPPING PROBLEM CUSTOMER NOT AT HOME'),
(9, 'SHIPPING PROBLEM ADDRESS INCORRECT'),
(10, 'SHIPPING PROBLEM COURIER ERROR');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_suppliers`
--

CREATE TABLE `forzaerp_suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_codename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_suppliers`
--

INSERT INTO `forzaerp_suppliers` (`supplier_id`, `supplier_codename`) VALUES
(1, 'jack'),
(2, 'larry'),
(3, 'John');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supplier_order`
--

CREATE TABLE `forzaerp_supplier_order` (
  `order_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `received_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supplier_order_device`
--

CREATE TABLE `forzaerp_supplier_order_device` (
  `order_id` int(11) NOT NULL,
  `rebuy_order_id` int(11) NOT NULL,
  `device_model_id` int(11) NOT NULL,
  `device_storage_id` int(11) NOT NULL,
  `device_connection` int(11) NOT NULL,
  `device_colour_id` int(11) NOT NULL,
  `device_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supplier_suborder`
--

CREATE TABLE `forzaerp_supplier_suborder` (
  `entry_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `suborder_id` int(11) NOT NULL,
  `device_model` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supply_action_types`
--

CREATE TABLE `forzaerp_supply_action_types` (
  `action_type` int(11) NOT NULL,
  `action_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_supply_action_types`
--

INSERT INTO `forzaerp_supply_action_types` (`action_type`, `action_name`) VALUES
(1, 'COUNT'),
(2, 'CHECK'),
(3, 'INSPECT'),
(4, 'REPORT');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supply_inspection`
--

CREATE TABLE `forzaerp_supply_inspection` (
  `inspection_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `device_storage` varchar(255) NOT NULL,
  `device_connection` varchar(255) NOT NULL,
  `device_condition` varchar(255) NOT NULL,
  `device_colour` varchar(255) NOT NULL,
  `device_comments` text NOT NULL,
  `date` date DEFAULT NULL,
  `IMEI` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supply_order_device`
--

CREATE TABLE `forzaerp_supply_order_device` (
  `entry_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `device_type_id` int(15) NOT NULL,
  `device_storage_id` int(15) NOT NULL,
  `device_condition_id` int(15) NOT NULL,
  `device_connection_id` int(15) NOT NULL,
  `device_colour_id` int(15) NOT NULL,
  `device_imei` bigint(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supply_order_status`
--

CREATE TABLE `forzaerp_supply_order_status` (
  `order_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_supply_order_status_types`
--

CREATE TABLE `forzaerp_supply_order_status_types` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_supply_order_status_types`
--

INSERT INTO `forzaerp_supply_order_status_types` (`status_id`, `status_name`) VALUES
(1, 'ORDER CREATED'),
(2, 'ORDER SHIPPED'),
(3, 'ORDER RECEIVED'),
(4, 'CHECKED'),
(5, 'INSPECTED'),
(6, 'CLOSED'),
(7, 'ORDER PROCESSING');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_users`
--

CREATE TABLE `forzaerp_users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_department` int(10) NOT NULL,
  `user_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_users`
--

INSERT INTO `forzaerp_users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_department`, `user_role`) VALUES
(2, 'simona', 'simona.thrussell@forza.refurbished.nl', 'darken47', 1, 4),
(3, 'juriel', 'juriel.verbaarschot@forza-refurbished.nl', 'Forza123!', 1, 4),
(4, 'marijn', 'marijn.schouw@forza-refurbished.nl', 'Forza123!', 2, 4),
(5, 'Armen', 'armen.albert@forza-refurbished.nl', 'Forza123!', 2, 4),
(6, 'Jeffrey', 'jeffrey.segeren@forza-refurbished.nl', 'Forza123!', 2, 3),
(7, 'Maarten', 'maarten.been@forza-refurbished.nl', 'Forza123!', 2, 6),
(8, 'Janos', 'janos.czeh@forza-group.nl', 'Forza123!', 2, 6),
(9, 'Magda', 'Magda.Filipek@forza-refurbished.nl', 'Forza123!', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_user_avatar`
--

CREATE TABLE `forzaerp_user_avatar` (
  `avatar_id` int(15) NOT NULL,
  `user_id` int(10) NOT NULL,
  `avatar_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_user_roles`
--

CREATE TABLE `forzaerp_user_roles` (
  `user_role_id` int(10) NOT NULL,
  `user_role_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_user_roles`
--

INSERT INTO `forzaerp_user_roles` (`user_role_id`, `user_role_name`) VALUES
(1, 'director'),
(2, 'supervisor'),
(3, 'manager'),
(4, 'administrator'),
(5, 'salesworker'),
(6, 'repair tech'),
(7, 'IT office'),
(8, 'support desk'),
(9, 'finance clerk'),
(10, 'warehouse op'),
(11, 'developer');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_warranty`
--

CREATE TABLE `forzaerp_warranty` (
  `warranty_id` int(15) NOT NULL,
  `order_id` int(15) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `device_IMEI` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzaerp_warranty`
--

INSERT INTO `forzaerp_warranty` (`warranty_id`, `order_id`, `start_date`, `end_date`, `device_IMEI`) VALUES
(1, 1, '2019-05-22', '2021-05-22', '358809052767060');

-- --------------------------------------------------------

--
-- Table structure for table `forzaerp_warranty_type`
--

CREATE TABLE `forzaerp_warranty_type` (
  `warranty_type_id` int(15) NOT NULL,
  `warranty_type_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forzerp_event_type`
--

CREATE TABLE `forzerp_event_type` (
  `event_type_id` int(15) NOT NULL,
  `event_type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forzerp_event_type`
--

INSERT INTO `forzerp_event_type` (`event_type_id`, `event_type`) VALUES
(1, 'Check'),
(2, 'Inspection'),
(3, 'Repair 1'),
(4, 'Repair 2'),
(5, 'Call- Sales'),
(6, 'Call-CS'),
(7, 'Call-RMA'),
(8, 'Payment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forzaerp_connection_type`
--
ALTER TABLE `forzaerp_connection_type`
  ADD PRIMARY KEY (`connection_type_id`);

--
-- Indexes for table `forzaerp_customer`
--
ALTER TABLE `forzaerp_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `forzaerp_customer_address`
--
ALTER TABLE `forzaerp_customer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `forzaerp_customer_shipping_status_type`
--
ALTER TABLE `forzaerp_customer_shipping_status_type`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_departments`
--
ALTER TABLE `forzaerp_departments`
  ADD PRIMARY KEY (`user_department_id`);

--
-- Indexes for table `forzaerp_device`
--
ALTER TABLE `forzaerp_device`
  ADD PRIMARY KEY (`device_id`),
  ADD UNIQUE KEY `device_IMEI` (`device_IMEI`),
  ADD UNIQUE KEY `device_id` (`device_id`);

--
-- Indexes for table `forzaerp_device_action_buttons`
--
ALTER TABLE `forzaerp_device_action_buttons`
  ADD PRIMARY KEY (`button_id`);

--
-- Indexes for table `forzaerp_device_action_types`
--
ALTER TABLE `forzaerp_device_action_types`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `forzaerp_device_colour`
--
ALTER TABLE `forzaerp_device_colour`
  ADD PRIMARY KEY (`colour_id`);

--
-- Indexes for table `forzaerp_device_grade`
--
ALTER TABLE `forzaerp_device_grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `forzaerp_device_history`
--
ALTER TABLE `forzaerp_device_history`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `event_type` (`event_type`);

--
-- Indexes for table `forzaerp_device_inventory`
--
ALTER TABLE `forzaerp_device_inventory`
  ADD PRIMARY KEY (`inv_device_id`),
  ADD UNIQUE KEY `IMEI` (`IMEI`),
  ADD KEY `location_code` (`location_code`);

--
-- Indexes for table `forzaerp_device_model`
--
ALTER TABLE `forzaerp_device_model`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `forzaerp_device_status`
--
ALTER TABLE `forzaerp_device_status`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `forzaerp_device_status_types`
--
ALTER TABLE `forzaerp_device_status_types`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_device_storage_type`
--
ALTER TABLE `forzaerp_device_storage_type`
  ADD PRIMARY KEY (`storage_type_id`);

--
-- Indexes for table `forzaerp_device_type`
--
ALTER TABLE `forzaerp_device_type`
  ADD PRIMARY KEY (`device_type_id`);

--
-- Indexes for table `forzaerp_eav_device_part`
--
ALTER TABLE `forzaerp_eav_device_part`
  ADD UNIQUE KEY `deviceid_partid` (`deviceid`,`partid`);

--
-- Indexes for table `forzaerp_events`
--
ALTER TABLE `forzaerp_events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `event_type` (`event_type`),
  ADD KEY `event_user` (`user_id`),
  ADD KEY `event_status` (`event_status`);

--
-- Indexes for table `forzaerp_event_state`
--
ALTER TABLE `forzaerp_event_state`
  ADD KEY `event_state_id` (`event_state_id`);

--
-- Indexes for table `forzaerp_event_streams`
--
ALTER TABLE `forzaerp_event_streams`
  ADD PRIMARY KEY (`stream_id`);

--
-- Indexes for table `forzaerp_event_type`
--
ALTER TABLE `forzaerp_event_type`
  ADD PRIMARY KEY (`event_type_id`);

--
-- Indexes for table `forzaerp_inspection`
--
ALTER TABLE `forzaerp_inspection`
  ADD PRIMARY KEY (`inspection_id`),
  ADD KEY `inspection_type` (`inspection_type`);

--
-- Indexes for table `forzaerp_inspection_details_buttons`
--
ALTER TABLE `forzaerp_inspection_details_buttons`
  ADD PRIMARY KEY (`buttons_insp_id`);

--
-- Indexes for table `forzaerp_inspection_details_camera`
--
ALTER TABLE `forzaerp_inspection_details_camera`
  ADD PRIMARY KEY (`camera_insp_id`);

--
-- Indexes for table `forzaerp_inspection_details_connections`
--
ALTER TABLE `forzaerp_inspection_details_connections`
  ADD PRIMARY KEY (`conn_insp_id`);

--
-- Indexes for table `forzaerp_inspection_details_misc`
--
ALTER TABLE `forzaerp_inspection_details_misc`
  ADD PRIMARY KEY (`misc_insp_id`);

--
-- Indexes for table `forzaerp_inspection_details_power`
--
ALTER TABLE `forzaerp_inspection_details_power`
  ADD PRIMARY KEY (`power_insp_id`);

--
-- Indexes for table `forzaerp_inspection_details_screen`
--
ALTER TABLE `forzaerp_inspection_details_screen`
  ADD PRIMARY KEY (`screen_insp_id`);

--
-- Indexes for table `forzaerp_inspection_details_sound`
--
ALTER TABLE `forzaerp_inspection_details_sound`
  ADD PRIMARY KEY (`sound_insp_id`);

--
-- Indexes for table `forzaerp_inspection_types`
--
ALTER TABLE `forzaerp_inspection_types`
  ADD PRIMARY KEY (`inspection_type_id`);

--
-- Indexes for table `forzaerp_internal_shipping_status_type`
--
ALTER TABLE `forzaerp_internal_shipping_status_type`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_inventory_locations`
--
ALTER TABLE `forzaerp_inventory_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `forzaerp_parts_suppliers`
--
ALTER TABLE `forzaerp_parts_suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `forzaerp_rebuy_accepted_order_offers`
--
ALTER TABLE `forzaerp_rebuy_accepted_order_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forzaerp_rebuy_action_buttons`
--
ALTER TABLE `forzaerp_rebuy_action_buttons`
  ADD PRIMARY KEY (`button_id`);

--
-- Indexes for table `forzaerp_rebuy_action_status`
--
ALTER TABLE `forzaerp_rebuy_action_status`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `action_id` (`action_id`);

--
-- Indexes for table `forzaerp_rebuy_customer_estimation_types`
--
ALTER TABLE `forzaerp_rebuy_customer_estimation_types`
  ADD PRIMARY KEY (`est_type_id`);

--
-- Indexes for table `forzaerp_rebuy_customer_payment`
--
ALTER TABLE `forzaerp_rebuy_customer_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `forzaerp_rebuy_customer_status_type`
--
ALTER TABLE `forzaerp_rebuy_customer_status_type`
  ADD PRIMARY KEY (`cust_status_id`);

--
-- Indexes for table `forzaerp_rebuy_customer_type`
--
ALTER TABLE `forzaerp_rebuy_customer_type`
  ADD PRIMARY KEY (`cust_type_id`);

--
-- Indexes for table `forzaerp_rebuy_device_accepted_offers`
--
ALTER TABLE `forzaerp_rebuy_device_accepted_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forzaerp_rebuy_device_check`
--
ALTER TABLE `forzaerp_rebuy_device_check`
  ADD PRIMARY KEY (`check_id`),
  ADD UNIQUE KEY `IMEI` (`IMEI`);

--
-- Indexes for table `forzaerp_rebuy_device_condition`
--
ALTER TABLE `forzaerp_rebuy_device_condition`
  ADD PRIMARY KEY (`condition_id`),
  ADD KEY `condition_id` (`condition_id`);

--
-- Indexes for table `forzaerp_rebuy_device_quote`
--
ALTER TABLE `forzaerp_rebuy_device_quote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `forzaerp_rebuy_device_quote_table`
--
ALTER TABLE `forzaerp_rebuy_device_quote_table`
  ADD PRIMARY KEY (`quote_id`),
  ADD KEY `device_type_id` (`device_type_id`),
  ADD KEY `device_condition_id` (`device_condition_id`),
  ADD KEY `device_connection_id` (`device_connection_id`);

--
-- Indexes for table `forzaerp_rebuy_device_status`
--
ALTER TABLE `forzaerp_rebuy_device_status`
  ADD PRIMARY KEY (`device_order_id`),
  ADD KEY `forza_order_status` (`forza_order_status`),
  ADD KEY `next_action_id` (`next_action_id`);

--
-- Indexes for table `forzaerp_rebuy_forza_order_status_type`
--
ALTER TABLE `forzaerp_rebuy_forza_order_status_type`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_rebuy_forza_status_shipping`
--
ALTER TABLE `forzaerp_rebuy_forza_status_shipping`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `forzaerp_rebuy_inspection`
--
ALTER TABLE `forzaerp_rebuy_inspection`
  ADD PRIMARY KEY (`device_check_id`);

--
-- Indexes for table `forzaerp_rebuy_inspection_failcard`
--
ALTER TABLE `forzaerp_rebuy_inspection_failcard`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `forzaerp_rebuy_inventory`
--
ALTER TABLE `forzaerp_rebuy_inventory`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `IMEI` (`IMEI`);

--
-- Indexes for table `forzaerp_rebuy_order`
--
ALTER TABLE `forzaerp_rebuy_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_date` (`order_date`);

--
-- Indexes for table `forzaerp_rebuy_order_action_buttons`
--
ALTER TABLE `forzaerp_rebuy_order_action_buttons`
  ADD PRIMARY KEY (`button_id`);

--
-- Indexes for table `forzaerp_rebuy_order_action_types`
--
ALTER TABLE `forzaerp_rebuy_order_action_types`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `forzaerp_rebuy_order_device`
--
ALTER TABLE `forzaerp_rebuy_order_device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `device_type_id` (`device_type_id`),
  ADD KEY `device_storage_id` (`device_storage_id`),
  ADD KEY `device_colour_id` (`device_colour_id`),
  ADD KEY `device_connection_id` (`device_connection_id`),
  ADD KEY `device_condition_id` (`device_condition_id`);

--
-- Indexes for table `forzaerp_rebuy_order_devices`
--
ALTER TABLE `forzaerp_rebuy_order_devices`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `forzaerp_rebuy_order_offer`
--
ALTER TABLE `forzaerp_rebuy_order_offer`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `forzaerp_rebuy_order_overview`
--
ALTER TABLE `forzaerp_rebuy_order_overview`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `customer_status` (`customer_status`),
  ADD KEY `forza_status` (`forza_status`),
  ADD KEY `order_tag_id` (`order_tag_id`);

--
-- Indexes for table `forzaerp_rebuy_order_quote`
--
ALTER TABLE `forzaerp_rebuy_order_quote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `forzaerp_rebuy_order_salestag`
--
ALTER TABLE `forzaerp_rebuy_order_salestag`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `sales_tag_id` (`sales_tag_id`);

--
-- Indexes for table `forzaerp_rebuy_order_secondquote`
--
ALTER TABLE `forzaerp_rebuy_order_secondquote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `forzaerp_rebuy_order_status`
--
ALTER TABLE `forzaerp_rebuy_order_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `forza_order_status` (`rebuy_order_status`);

--
-- Indexes for table `forzaerp_rebuy_order_status_types`
--
ALTER TABLE `forzaerp_rebuy_order_status_types`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_rebuy_order_totalquote`
--
ALTER TABLE `forzaerp_rebuy_order_totalquote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `forzaerp_rebuy_payments`
--
ALTER TABLE `forzaerp_rebuy_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `forzaerp_rebuy_payment_action`
--
ALTER TABLE `forzaerp_rebuy_payment_action`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `forzaerp_rebuy_payment_types`
--
ALTER TABLE `forzaerp_rebuy_payment_types`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `forzaerp_rebuy_prices`
--
ALTER TABLE `forzaerp_rebuy_prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `forzaerp_rebuy_salesorders`
--
ALTER TABLE `forzaerp_rebuy_salesorders`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `forzaerp_rebuy_shipping`
--
ALTER TABLE `forzaerp_rebuy_shipping`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `shipping_status` (`shipping_status`);

--
-- Indexes for table `forzaerp_rebuy_shipping_status`
--
ALTER TABLE `forzaerp_rebuy_shipping_status`
  ADD PRIMARY KEY (`shipping_status_id`);

--
-- Indexes for table `forzaerp_rebuy_sublocation`
--
ALTER TABLE `forzaerp_rebuy_sublocation`
  ADD PRIMARY KEY (`subloc_id`);

--
-- Indexes for table `forzaerp_repair1_parts_type`
--
ALTER TABLE `forzaerp_repair1_parts_type`
  ADD PRIMARY KEY (`part_type_id`),
  ADD KEY `device` (`device`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `forzaerp_repair2_parts_type`
--
ALTER TABLE `forzaerp_repair2_parts_type`
  ADD PRIMARY KEY (`type_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `forzaerp_repair_1`
--
ALTER TABLE `forzaerp_repair_1`
  ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `forzaerp_repair_2`
--
ALTER TABLE `forzaerp_repair_2`
  ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `forzaerp_repair_action_buttons`
--
ALTER TABLE `forzaerp_repair_action_buttons`
  ADD PRIMARY KEY (`button_id`);

--
-- Indexes for table `forzaerp_repair_action_types`
--
ALTER TABLE `forzaerp_repair_action_types`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `forzaerp_repair_orders`
--
ALTER TABLE `forzaerp_repair_orders`
  ADD PRIMARY KEY (`repair_id`),
  ADD KEY `imei` (`imei`);

--
-- Indexes for table `forzaerp_repair_order_status`
--
ALTER TABLE `forzaerp_repair_order_status`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `forzaerp_repair_order_status_types`
--
ALTER TABLE `forzaerp_repair_order_status_types`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_repair_order_type`
--
ALTER TABLE `forzaerp_repair_order_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `forzaerp_retail_customer_payment`
--
ALTER TABLE `forzaerp_retail_customer_payment`
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indexes for table `forzaerp_retail_payment_type`
--
ALTER TABLE `forzaerp_retail_payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `forzaerp_return_orders`
--
ALTER TABLE `forzaerp_return_orders`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `forzaerp_rma_action_buttons`
--
ALTER TABLE `forzaerp_rma_action_buttons`
  ADD PRIMARY KEY (`button_id`);

--
-- Indexes for table `forzaerp_rma_action_types`
--
ALTER TABLE `forzaerp_rma_action_types`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `forzaerp_rma_order`
--
ALTER TABLE `forzaerp_rma_order`
  ADD PRIMARY KEY (`rma_id`),
  ADD UNIQUE KEY `device_imei` (`imei`);

--
-- Indexes for table `forzaerp_rma_order_details`
--
ALTER TABLE `forzaerp_rma_order_details`
  ADD PRIMARY KEY (`rma_id`),
  ADD KEY `problem_id` (`problem_id`);

--
-- Indexes for table `forzaerp_rma_order_status`
--
ALTER TABLE `forzaerp_rma_order_status`
  ADD PRIMARY KEY (`rma_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `next_action_id` (`next_action_id`),
  ADD KEY `shipping_status_id` (`shipping_status_id`);

--
-- Indexes for table `forzaerp_rma_order_status_types`
--
ALTER TABLE `forzaerp_rma_order_status_types`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_rma_problem_code`
--
ALTER TABLE `forzaerp_rma_problem_code`
  ADD PRIMARY KEY (`problem_id`);

--
-- Indexes for table `forzaerp_rma_shipping`
--
ALTER TABLE `forzaerp_rma_shipping`
  ADD PRIMARY KEY (`rma_id`),
  ADD KEY `shipping_status` (`shipping_status`);

--
-- Indexes for table `forzaerp_rma_shipping_status`
--
ALTER TABLE `forzaerp_rma_shipping_status`
  ADD PRIMARY KEY (`shipping_status_id`);

--
-- Indexes for table `forzaerp_sales_inventory`
--
ALTER TABLE `forzaerp_sales_inventory`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `device_imei` (`device_imei`),
  ADD KEY `device_type` (`device_type`),
  ADD KEY `device_grade` (`device_grade`),
  ADD KEY `device_colour` (`device_colour`),
  ADD KEY `device_connection` (`device_connection`),
  ADD KEY `device_storage` (`device_storage`);

--
-- Indexes for table `forzaerp_sales_order`
--
ALTER TABLE `forzaerp_sales_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_type` (`payment_type_id`);

--
-- Indexes for table `forzaerp_sales_order_device`
--
ALTER TABLE `forzaerp_sales_order_device`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `device_type_id` (`device_type_id`),
  ADD KEY `device_storage_id` (`device_storage_id`),
  ADD KEY `device_colour_id` (`device_colour_id`),
  ADD KEY `device_connection_id` (`device_connection_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `forzaerp_sales_order_device_imei`
--
ALTER TABLE `forzaerp_sales_order_device_imei`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `imei` (`device_imei`);

--
-- Indexes for table `forzaerp_sales_order_state_type`
--
ALTER TABLE `forzaerp_sales_order_state_type`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `forzaerp_sales_order_status`
--
ALTER TABLE `forzaerp_sales_order_status`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_status` (`order_status`),
  ADD KEY `internal_shipping_status` (`internal_shipping_status`),
  ADD KEY `customer_shipping_status` (`customer_shipping_status`),
  ADD KEY `next_action_id` (`next_action_id`),
  ADD KEY `order_state` (`order_state`);

--
-- Indexes for table `forzaerp_sales_order_status_type`
--
ALTER TABLE `forzaerp_sales_order_status_type`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_sales_order_tags`
--
ALTER TABLE `forzaerp_sales_order_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `forzaerp_sales_shipping_status_type`
--
ALTER TABLE `forzaerp_sales_shipping_status_type`
  ADD PRIMARY KEY (`shipping_status_id`);

--
-- Indexes for table `forzaerp_suppliers`
--
ALTER TABLE `forzaerp_suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `forzaerp_supplier_order`
--
ALTER TABLE `forzaerp_supplier_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `forzaerp_supplier_order_device`
--
ALTER TABLE `forzaerp_supplier_order_device`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `device_model` (`device_model_id`);

--
-- Indexes for table `forzaerp_supplier_suborder`
--
ALTER TABLE `forzaerp_supplier_suborder`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `forzaerp_supply_action_types`
--
ALTER TABLE `forzaerp_supply_action_types`
  ADD PRIMARY KEY (`action_type`);

--
-- Indexes for table `forzaerp_supply_inspection`
--
ALTER TABLE `forzaerp_supply_inspection`
  ADD PRIMARY KEY (`inspection_id`);

--
-- Indexes for table `forzaerp_supply_order_device`
--
ALTER TABLE `forzaerp_supply_order_device`
  ADD PRIMARY KEY (`entry_id`),
  ADD UNIQUE KEY `device_imei` (`device_imei`),
  ADD KEY `device_type_id` (`device_type_id`),
  ADD KEY `device_storage_id` (`device_storage_id`),
  ADD KEY `device_colour_id` (`device_colour_id`),
  ADD KEY `device_connection_id` (`device_connection_id`),
  ADD KEY `device_condition_id` (`device_condition_id`);

--
-- Indexes for table `forzaerp_supply_order_status_types`
--
ALTER TABLE `forzaerp_supply_order_status_types`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `forzaerp_users`
--
ALTER TABLE `forzaerp_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_department` (`user_department`),
  ADD KEY `user_role` (`user_role`),
  ADD KEY `user_department_2` (`user_department`),
  ADD KEY `user_role_2` (`user_role`);

--
-- Indexes for table `forzaerp_user_avatar`
--
ALTER TABLE `forzaerp_user_avatar`
  ADD PRIMARY KEY (`avatar_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `forzaerp_user_roles`
--
ALTER TABLE `forzaerp_user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `forzaerp_warranty`
--
ALTER TABLE `forzaerp_warranty`
  ADD PRIMARY KEY (`warranty_id`),
  ADD UNIQUE KEY `device_IMEI` (`device_IMEI`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `forzaerp_warranty_type`
--
ALTER TABLE `forzaerp_warranty_type`
  ADD PRIMARY KEY (`warranty_type_id`);

--
-- Indexes for table `forzerp_event_type`
--
ALTER TABLE `forzerp_event_type`
  ADD PRIMARY KEY (`event_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forzaerp_connection_type`
--
ALTER TABLE `forzaerp_connection_type`
  MODIFY `connection_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_customer`
--
ALTER TABLE `forzaerp_customer`
  MODIFY `customer_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_customer_address`
--
ALTER TABLE `forzaerp_customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_customer_shipping_status_type`
--
ALTER TABLE `forzaerp_customer_shipping_status_type`
  MODIFY `status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `forzaerp_departments`
--
ALTER TABLE `forzaerp_departments`
  MODIFY `user_department_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forzaerp_device`
--
ALTER TABLE `forzaerp_device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forzaerp_device_action_buttons`
--
ALTER TABLE `forzaerp_device_action_buttons`
  MODIFY `button_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_device_action_types`
--
ALTER TABLE `forzaerp_device_action_types`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forzaerp_device_grade`
--
ALTER TABLE `forzaerp_device_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_device_history`
--
ALTER TABLE `forzaerp_device_history`
  MODIFY `entry_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_device_inventory`
--
ALTER TABLE `forzaerp_device_inventory`
  MODIFY `inv_device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forzaerp_device_model`
--
ALTER TABLE `forzaerp_device_model`
  MODIFY `device_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `forzaerp_device_status`
--
ALTER TABLE `forzaerp_device_status`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_device_status_types`
--
ALTER TABLE `forzaerp_device_status_types`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forzaerp_device_type`
--
ALTER TABLE `forzaerp_device_type`
  MODIFY `device_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forzaerp_events`
--
ALTER TABLE `forzaerp_events`
  MODIFY `event_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `forzaerp_event_state`
--
ALTER TABLE `forzaerp_event_state`
  MODIFY `event_state_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_event_streams`
--
ALTER TABLE `forzaerp_event_streams`
  MODIFY `stream_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_event_type`
--
ALTER TABLE `forzaerp_event_type`
  MODIFY `event_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forzaerp_inspection`
--
ALTER TABLE `forzaerp_inspection`
  MODIFY `inspection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_buttons`
--
ALTER TABLE `forzaerp_inspection_details_buttons`
  MODIFY `buttons_insp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_camera`
--
ALTER TABLE `forzaerp_inspection_details_camera`
  MODIFY `camera_insp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_connections`
--
ALTER TABLE `forzaerp_inspection_details_connections`
  MODIFY `conn_insp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_misc`
--
ALTER TABLE `forzaerp_inspection_details_misc`
  MODIFY `misc_insp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_power`
--
ALTER TABLE `forzaerp_inspection_details_power`
  MODIFY `power_insp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_screen`
--
ALTER TABLE `forzaerp_inspection_details_screen`
  MODIFY `screen_insp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_details_sound`
--
ALTER TABLE `forzaerp_inspection_details_sound`
  MODIFY `sound_insp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_inspection_types`
--
ALTER TABLE `forzaerp_inspection_types`
  MODIFY `inspection_type_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forzaerp_internal_shipping_status_type`
--
ALTER TABLE `forzaerp_internal_shipping_status_type`
  MODIFY `status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forzaerp_inventory_locations`
--
ALTER TABLE `forzaerp_inventory_locations`
  MODIFY `location_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forzaerp_parts_suppliers`
--
ALTER TABLE `forzaerp_parts_suppliers`
  MODIFY `supplier_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_accepted_order_offers`
--
ALTER TABLE `forzaerp_rebuy_accepted_order_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_action_buttons`
--
ALTER TABLE `forzaerp_rebuy_action_buttons`
  MODIFY `button_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_action_status`
--
ALTER TABLE `forzaerp_rebuy_action_status`
  MODIFY `action_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_customer_estimation_types`
--
ALTER TABLE `forzaerp_rebuy_customer_estimation_types`
  MODIFY `est_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_customer_payment`
--
ALTER TABLE `forzaerp_rebuy_customer_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_customer_status_type`
--
ALTER TABLE `forzaerp_rebuy_customer_status_type`
  MODIFY `cust_status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_customer_type`
--
ALTER TABLE `forzaerp_rebuy_customer_type`
  MODIFY `cust_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_device_accepted_offers`
--
ALTER TABLE `forzaerp_rebuy_device_accepted_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_device_check`
--
ALTER TABLE `forzaerp_rebuy_device_check`
  MODIFY `check_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_device_quote`
--
ALTER TABLE `forzaerp_rebuy_device_quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_device_quote_table`
--
ALTER TABLE `forzaerp_rebuy_device_quote_table`
  MODIFY `quote_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_device_status`
--
ALTER TABLE `forzaerp_rebuy_device_status`
  MODIFY `device_order_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_forza_order_status_type`
--
ALTER TABLE `forzaerp_rebuy_forza_order_status_type`
  MODIFY `status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_inspection`
--
ALTER TABLE `forzaerp_rebuy_inspection`
  MODIFY `device_check_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order`
--
ALTER TABLE `forzaerp_rebuy_order`
  MODIFY `order_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_action_buttons`
--
ALTER TABLE `forzaerp_rebuy_order_action_buttons`
  MODIFY `button_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_action_types`
--
ALTER TABLE `forzaerp_rebuy_order_action_types`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_device`
--
ALTER TABLE `forzaerp_rebuy_order_device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_devices`
--
ALTER TABLE `forzaerp_rebuy_order_devices`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_offer`
--
ALTER TABLE `forzaerp_rebuy_order_offer`
  MODIFY `offer_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_quote`
--
ALTER TABLE `forzaerp_rebuy_order_quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_secondquote`
--
ALTER TABLE `forzaerp_rebuy_order_secondquote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_status`
--
ALTER TABLE `forzaerp_rebuy_order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_status_types`
--
ALTER TABLE `forzaerp_rebuy_order_status_types`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_order_totalquote`
--
ALTER TABLE `forzaerp_rebuy_order_totalquote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_payments`
--
ALTER TABLE `forzaerp_rebuy_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_prices`
--
ALTER TABLE `forzaerp_rebuy_prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_salesorders`
--
ALTER TABLE `forzaerp_rebuy_salesorders`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_shipping_status`
--
ALTER TABLE `forzaerp_rebuy_shipping_status`
  MODIFY `shipping_status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_rebuy_sublocation`
--
ALTER TABLE `forzaerp_rebuy_sublocation`
  MODIFY `subloc_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_repair1_parts_type`
--
ALTER TABLE `forzaerp_repair1_parts_type`
  MODIFY `part_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `forzaerp_repair2_parts_type`
--
ALTER TABLE `forzaerp_repair2_parts_type`
  MODIFY `type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `forzaerp_repair_1`
--
ALTER TABLE `forzaerp_repair_1`
  MODIFY `repair_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forzaerp_repair_2`
--
ALTER TABLE `forzaerp_repair_2`
  MODIFY `repair_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_repair_action_buttons`
--
ALTER TABLE `forzaerp_repair_action_buttons`
  MODIFY `button_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forzaerp_repair_action_types`
--
ALTER TABLE `forzaerp_repair_action_types`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `forzaerp_repair_orders`
--
ALTER TABLE `forzaerp_repair_orders`
  MODIFY `repair_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forzaerp_repair_order_status_types`
--
ALTER TABLE `forzaerp_repair_order_status_types`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forzaerp_repair_order_type`
--
ALTER TABLE `forzaerp_repair_order_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_retail_payment_type`
--
ALTER TABLE `forzaerp_retail_payment_type`
  MODIFY `payment_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_return_orders`
--
ALTER TABLE `forzaerp_return_orders`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rma_action_buttons`
--
ALTER TABLE `forzaerp_rma_action_buttons`
  MODIFY `button_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_rma_action_types`
--
ALTER TABLE `forzaerp_rma_action_types`
  MODIFY `action_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forzaerp_rma_order`
--
ALTER TABLE `forzaerp_rma_order`
  MODIFY `rma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_rma_order_status_types`
--
ALTER TABLE `forzaerp_rma_order_status_types`
  MODIFY `status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forzaerp_rma_problem_code`
--
ALTER TABLE `forzaerp_rma_problem_code`
  MODIFY `problem_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forzaerp_rma_shipping_status`
--
ALTER TABLE `forzaerp_rma_shipping_status`
  MODIFY `shipping_status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_sales_inventory`
--
ALTER TABLE `forzaerp_sales_inventory`
  MODIFY `device_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_sales_order`
--
ALTER TABLE `forzaerp_sales_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forzaerp_sales_order_state_type`
--
ALTER TABLE `forzaerp_sales_order_state_type`
  MODIFY `state_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forzaerp_sales_order_status_type`
--
ALTER TABLE `forzaerp_sales_order_status_type`
  MODIFY `status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forzaerp_sales_order_tags`
--
ALTER TABLE `forzaerp_sales_order_tags`
  MODIFY `tag_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forzaerp_sales_shipping_status_type`
--
ALTER TABLE `forzaerp_sales_shipping_status_type`
  MODIFY `shipping_status_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forzaerp_suppliers`
--
ALTER TABLE `forzaerp_suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forzaerp_supplier_order`
--
ALTER TABLE `forzaerp_supplier_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_supplier_suborder`
--
ALTER TABLE `forzaerp_supplier_suborder`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_supply_action_types`
--
ALTER TABLE `forzaerp_supply_action_types`
  MODIFY `action_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forzaerp_supply_inspection`
--
ALTER TABLE `forzaerp_supply_inspection`
  MODIFY `inspection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_supply_order_device`
--
ALTER TABLE `forzaerp_supply_order_device`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_supply_order_status_types`
--
ALTER TABLE `forzaerp_supply_order_status_types`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forzaerp_users`
--
ALTER TABLE `forzaerp_users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `forzaerp_user_avatar`
--
ALTER TABLE `forzaerp_user_avatar`
  MODIFY `avatar_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzaerp_warranty`
--
ALTER TABLE `forzaerp_warranty`
  MODIFY `warranty_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forzaerp_warranty_type`
--
ALTER TABLE `forzaerp_warranty_type`
  MODIFY `warranty_type_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forzerp_event_type`
--
ALTER TABLE `forzerp_event_type`
  MODIFY `event_type_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forzaerp_rebuy_device_quote_table`
--
ALTER TABLE `forzaerp_rebuy_device_quote_table`
  ADD CONSTRAINT `c2` FOREIGN KEY (`device_type_id`) REFERENCES `forzaerp_device_model` (`device_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forzaerp_rebuy_inventory`
--
ALTER TABLE `forzaerp_rebuy_inventory`
  ADD CONSTRAINT `o2` FOREIGN KEY (`order_id`) REFERENCES `forzaerp_rebuy_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forzaerp_rebuy_order_device`
--
ALTER TABLE `forzaerp_rebuy_order_device`
  ADD CONSTRAINT `c4` FOREIGN KEY (`device_colour_id`) REFERENCES `forzaerp_device_colour` (`colour_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `c7` FOREIGN KEY (`device_condition_id`) REFERENCES `forzaerp_device_grade` (`grade_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `s3` FOREIGN KEY (`device_storage_id`) REFERENCES `forzaerp_device_storage_type` (`storage_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `t3` FOREIGN KEY (`device_type_id`) REFERENCES `forzaerp_device_model` (`device_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
