-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2017 at 06:07 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sns1`
--

-- --------------------------------------------------------

--
-- Table structure for table `p_branches_dir`
--

CREATE TABLE `p_branches_dir` (
  `id` bigint(20) NOT NULL,
  `guardian` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_branches_dir`
--

INSERT INTO `p_branches_dir` (`id`, `guardian`, `name`, `address`, `location`, `contact`, `type`, `last_update`) VALUES
(1, '1', 'Dellwood', 'Dellwood Street', 'Model City, NJ', '8005048220', 'Head Office', '2017-03-29 17:07:48'),
(13, '1', 'Arlington', 'Street 1', 'Arlington', '8005243233', 'Branch', '2017-03-29 19:25:44'),
(11, '1', 'Bayonne', '922-L Street 1', 'Southfield', '8005248232', 'Branch', '2017-03-29 17:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `p_global_permissions`
--

CREATE TABLE `p_global_permissions` (
  `id` varchar(250) NOT NULL DEFAULT '',
  `portal_name` varchar(250) NOT NULL,
  `version` varchar(250) NOT NULL,
  `guardian_short_name` varchar(250) NOT NULL,
  `guardian_name` varchar(250) NOT NULL,
  `register_patient` varchar(20) NOT NULL,
  `prescribe_patient` varchar(20) NOT NULL,
  `patients_directory` varchar(20) NOT NULL,
  `pending_prescriptions` varchar(20) NOT NULL,
  `add_staff` varchar(20) NOT NULL,
  `staff_directory` varchar(20) NOT NULL,
  `my_porfile` varchar(20) NOT NULL,
  `staff_profile` varchar(20) NOT NULL,
  `add_branch` varchar(20) NOT NULL,
  `branches_directory` varchar(20) NOT NULL,
  `global_settings` varchar(20) NOT NULL,
  `introduce_medicine` varchar(20) NOT NULL,
  `update_stock` varchar(20) NOT NULL,
  `consumed_stock_local` varchar(20) NOT NULL,
  `consumed_stock_global` varchar(20) NOT NULL,
  `opening_time` varchar(250) NOT NULL,
  `closing_time` varchar(250) NOT NULL,
  `during_close_time` varchar(20) NOT NULL,
  `theme` varchar(250) NOT NULL,
  `timezone` varchar(250) NOT NULL,
  `charge_mode_a` varchar(250) NOT NULL,
  `charge_mode_b` varchar(250) NOT NULL,
  `charge_mode_c` varchar(250) NOT NULL,
  `charge_mode_d` varchar(250) NOT NULL,
  `access_level_6` varchar(250) NOT NULL,
  `access_level_5` varchar(250) NOT NULL,
  `access_level_4` varchar(250) NOT NULL,
  `access_level_3` varchar(250) NOT NULL,
  `access_level_2` varchar(250) NOT NULL,
  `access_level_1` varchar(250) NOT NULL,
  `mobile_number` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `sign_level` varchar(250) NOT NULL,
  `medicine_directory` varchar(250) NOT NULL,
  `medicine_profile` varchar(250) NOT NULL,
  `patient_contact` varchar(250) NOT NULL,
  `patient_address` varchar(250) NOT NULL,
  `patient_email` varchar(250) NOT NULL,
  `edit_patient` varchar(250) NOT NULL,
  `manage_patients` varchar(250) NOT NULL,
  `auto_refresh` varchar(250) NOT NULL,
  `currency` varchar(250) NOT NULL,
  `charge_mode_a_value` int(20) NOT NULL,
  `charge_mode_b_value` int(20) NOT NULL,
  `charge_mode_c_value` int(20) NOT NULL,
  `charge_mode_d_value` int(20) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `last_update` datetime NOT NULL,
  `recent_hours` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_global_permissions`
--

INSERT INTO `p_global_permissions` (`id`, `portal_name`, `version`, `guardian_short_name`, `guardian_name`, `register_patient`, `prescribe_patient`, `patients_directory`, `pending_prescriptions`, `add_staff`, `staff_directory`, `my_porfile`, `staff_profile`, `add_branch`, `branches_directory`, `global_settings`, `introduce_medicine`, `update_stock`, `consumed_stock_local`, `consumed_stock_global`, `opening_time`, `closing_time`, `during_close_time`, `theme`, `timezone`, `charge_mode_a`, `charge_mode_b`, `charge_mode_c`, `charge_mode_d`, `access_level_6`, `access_level_5`, `access_level_4`, `access_level_3`, `access_level_2`, `access_level_1`, `mobile_number`, `address`, `sign_level`, `medicine_directory`, `medicine_profile`, `patient_contact`, `patient_address`, `patient_email`, `edit_patient`, `manage_patients`, `auto_refresh`, `currency`, `charge_mode_a_value`, `charge_mode_b_value`, `charge_mode_c_value`, `charge_mode_d_value`, `updated_by`, `last_update`, `recent_hours`) VALUES
('1', 'Remote Clinic', '2.0', 'RC', 'RemoteClinic', '3', '4', '3', '4', '5', '3', '3', '3', '5', '3', '5', '5', '5', '3', '4', '08', '16', '3', '', 'Asia/Karachi', '5', '1', '0.50', '0', 'Super Admin', 'Doctor', 'Triage / Nurse Practitioner', 'Staff Nurse', 'Receptionist', 'Guest', '4', '5', '4', '3', '4', '5', '5', '4', '4', '5', '60', 'KES', 5, 3, 1, 0, '6', '2017-04-05 22:51:06', '168');

-- --------------------------------------------------------

--
-- Table structure for table `p_logs`
--

CREATE TABLE `p_logs` (
  `id` bigint(20) NOT NULL,
  `user` varchar(250) NOT NULL,
  `at` datetime NOT NULL,
  `action` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `priority` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_logs`
--

INSERT INTO `p_logs` (`id`, `user`, `at`, `action`, `type`, `priority`) VALUES
(1990, '6', '2017-04-05 22:45:36', 'deleted stock id 32', 'stock', '30'),
(1991, '6', '2017-04-05 22:45:38', 'deleted stock id 29', 'stock', '30'),
(1992, '6', '2017-04-05 22:45:41', 'deleted stock id 33', 'stock', '30'),
(1993, '6', '2017-04-05 22:45:56', 'deleted a Patient profile for Test Patient', 'patient', '30'),
(1994, '6', '2017-04-05 22:46:07', 'deleted a Patient profile for Jack Smith', 'patient', '30'),
(1995, '6', '2017-04-05 22:46:21', 'deleted a Patient profile for John Doe', 'patient', '30'),
(1996, '6', '2017-04-05 22:51:06', 'updated global settings for Remote Clinic', 'branch', '50'),
(1989, '6', '2017-04-05 22:45:33', 'deleted stock id 26', 'stock', '30'),
(1988, '6', '2017-04-05 22:45:30', 'deleted stock id 28', 'stock', '30'),
(1987, '6', '2017-04-05 22:45:30', 'deleted stock id 23', 'stock', '30'),
(1986, '6', '2017-04-05 22:45:29', 'deleted stock id 22', 'stock', '30'),
(1985, '6', '2017-04-05 22:45:27', 'deleted stock id 13', 'stock', '30'),
(1984, '6', '2017-04-05 22:45:26', 'deleted stock id 25', 'stock', '30');

-- --------------------------------------------------------

--
-- Table structure for table `p_medicine_dir`
--

CREATE TABLE `p_medicine_dir` (
  `id` bigint(20) NOT NULL,
  `category` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `added_by` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_medicine_dir`
--

INSERT INTO `p_medicine_dir` (`id`, `category`, `code`, `name`, `price`, `added_by`, `last_update`) VALUES
(1, 'Bottle', 'PR34', 'Testone', '5', '1', '2012-01-28 16:29:26'),
(22, 'Bottle', 'JQ46', 'Alprazaline', '5', '1', '2012-01-28 19:16:40'),
(23, 'Bottle', 'ZD87', 'Cloaca', '5', '1', '2012-01-28 19:17:08'),
(24, 'Bottle', 'NP98', 'Adravil', '5', '1', '2012-01-28 19:17:14'),
(25, 'Bottle', 'WU44', 'Ambrosia', '5', '1', '2012-01-28 19:17:17'),
(26, 'Syrup', 'CT53', 'Anabioticss', '12', '6', '2012-01-31 23:18:02'),
(27, 'Bottle', 'VJ87', 'Anti-Ague', '5', '1', '2012-01-28 19:17:25'),
(28, 'Bottle', 'MM80', 'Antibiotic Gel', '5', '1', '2012-01-28 19:17:28'),
(29, 'Bottle', 'HF79', 'Antidote', '5', '1', '2012-01-28 19:17:32'),
(30, 'Bottle', 'AZ84', 'Ascomycin', '5', '6', '2017-03-18 23:35:17'),
(31, 'Syrup', 'KS33', 'Aslan', '5', '1', '2012-01-28 19:17:40'),
(32, 'Tablets', 'PQ94', 'Athsat', '5', '1', '2012-01-28 19:17:45'),
(33, 'Syrup', 'WS97', 'Aquasol', '5', '1', '2012-01-28 19:17:49'),
(34, 'Bottle', 'TN56', 'Aqua Cure', '5', '1', '2012-01-28 19:17:54'),
(35, 'Bottle', 'YG78', 'Bacta', '5', '1', '2012-01-28 19:17:57'),
(36, 'Bottle', 'VV82', 'Azoth', '5', '1', '2012-01-28 19:18:00'),
(37, 'Bottle', 'HV51', 'Bellerophon', '5', '1', '2012-01-28 19:18:03'),
(38, 'Bottle', 'RI68', 'Bio-mimetic gel', '5', '1', '2012-01-28 19:18:07'),
(39, 'Bottle', 'JM63', 'Bittamucin', '5', '1', '2012-01-28 19:18:11'),
(40, 'Bottle', 'UU30', 'Blaccine', '5', '1', '2012-01-28 19:18:14'),
(41, 'Bottle', 'KO26', 'Byphodine', '5', '1', '2012-01-28 19:18:19'),
(42, 'Bottle', 'OI83', 'Catana', '5', '1', '2012-01-28 19:18:21'),
(43, 'Tablets', 'RT52', 'Celestial Wine', '5', '1', '2012-01-28 19:18:27'),
(44, 'Bottle', 'WK59', 'Chamalla extract', '5', '1', '2012-01-28 19:18:30'),
(45, 'Syrup', 'GN67', 'Charlanta', '10', '6', '2012-01-31 23:18:44'),
(46, 'Bottle', 'IW20', 'Cloveritol', '5', '1', '2012-01-28 19:18:35'),
(47, 'Bottle', 'SK64', 'Comanapracil', '5', '1', '2012-01-28 19:18:38'),
(48, 'Bottle', 'PN64', 'Coma White', '5', '1', '2012-01-28 19:18:42'),
(49, 'Syrup', 'CJ78', 'Contrari', '5', '1', '2012-01-28 19:18:46'),
(50, 'Bottle', 'SY75', 'Cordrazine', '5', '1', '2012-01-28 19:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `p_med_record`
--

CREATE TABLE `p_med_record` (
  `id` bigint(20) NOT NULL,
  `medicine` varchar(250) NOT NULL,
  `doses` varchar(250) NOT NULL,
  `timings` varchar(250) NOT NULL,
  `days` varchar(250) NOT NULL,
  `total` int(20) NOT NULL,
  `physician_id` varchar(250) NOT NULL,
  `report_id` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL,
  `total_charge` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p_patients_dir`
--

CREATE TABLE `p_patients_dir` (
  `id` bigint(20) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `serial` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `weight` varchar(250) NOT NULL,
  `profession` varchar(250) NOT NULL,
  `ref_contact` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `physician` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL,
  `friendly_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_patients_dir`
--

INSERT INTO `p_patients_dir` (`id`, `gender`, `age`, `serial`, `name`, `contact`, `email`, `weight`, `profession`, `ref_contact`, `address`, `branch`, `physician`, `last_update`, `friendly_name`) VALUES
(156, 'Male', '16', 'PA', 'Joe', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '1', '25', '2017-04-01 20:54:10', 'Joe'),
(157, 'Male', '10', 'PA', 'Francisco', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '1', '25', '2017-04-01 20:56:24', 'Francisco'),
(151, 'Male', '22', 'PA', 'Turner Smith', '00108090803', 'n/a', '57', 'Student', 'n/a', 'n/a', '1', '6', '2017-03-29 19:46:08', 'Turner Smith'),
(152, 'Male', '18', 'PA', 'Aditya  Raj', '00108090803', 'n/a', '57', 'Student', 'n/a', 'n/a', '11', '23', '2017-03-29 19:53:15', 'Aditya  Raj'),
(154, 'Male', '16', 'PA', 'Abebi', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '1', '15', '2017-03-29 21:47:41', 'Abebi');

-- --------------------------------------------------------

--
-- Table structure for table `p_reports`
--

CREATE TABLE `p_reports` (
  `id` bigint(20) NOT NULL,
  `patient` varchar(250) NOT NULL,
  `charge` varchar(250) NOT NULL,
  `charging_for` varchar(250) DEFAULT NULL,
  `fever` varchar(250) NOT NULL,
  `blood_pressure` varchar(250) NOT NULL,
  `symptoms` longtext NOT NULL,
  `attachement` varchar(250) NOT NULL DEFAULT '0',
  `composed_by` varchar(250) NOT NULL,
  `engaged_by` varchar(250) NOT NULL,
  `signed_by` varchar(250) NOT NULL,
  `notes` longtext NOT NULL,
  `reply` longtext NOT NULL,
  `last_update` datetime NOT NULL,
  `branch` varchar(250) NOT NULL,
  `checkout_charges` varchar(250) NOT NULL,
  `cc` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p_staff_dir`
--

CREATE TABLE `p_staff_dir` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `access_level` varchar(50) NOT NULL,
  `userid` varchar(250) NOT NULL,
  `passkey` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `skype` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `registered_by` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_staff_dir`
--

INSERT INTO `p_staff_dir` (`id`, `first_name`, `last_name`, `full_name`, `title`, `access_level`, `userid`, `passkey`, `contact`, `mobile`, `skype`, `address`, `branch`, `status`, `registered_by`, `last_update`) VALUES
(1, 'Saad', 'Irfan', 'Mr. Saad Irfan', 'Mr.', '5', 'saad@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00108090807', '00108090807', 'saadirfan', 'RemoteClinic.io', '1', 'active', '1', '2012-01-31 15:17:50'),
(6, 'Super', 'Admin', 'Mr. Super Admin', 'Mr.', '6', 'admin@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00108090807', '00108090807', 'ian', 'RemoteClinic.io', '1', 'active', '1', '2017-04-05 22:43:26'),
(10, 'Woolnough', 'Smith', 'Mr. Woolnough Smith', 'Mr.', '4', 'smith@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00102030405', '00102030405', 'smith', 'Smith Residence', '13', 'active', '6', '2012-02-05 21:02:34'),
(11, 'Sheldon', 'Harper', 'Dr. Sheldon Harper', 'Dr.', '5', 'sheldon@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00102030405', '00102030405', 'sheldon', 'Harper  Residence', '1', 'active', '6', '2017-03-29 21:49:44'),
(12, 'Buckley', 'Taylor', 'Dr. Buckley Taylor', 'Dr.', '5', 'buckley@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00102030405', '00102030405', 'taylor', 'Taylor Residence', '11', 'active', '6', '2012-01-28 22:54:52'),
(15, 'Chris', 'Grant', 'Dr. Chris Grant', 'Dr.', '5', 'chris@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00108090807', '00108090807', 'chris', 'Chris Residence', '1', 'active', '6', '2017-03-29 21:39:30'),
(17, 'Ellis', 'Mitchell', 'Miss. Ellis Mitchell', 'Miss.', '4', 'ellis@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '123', '123', '123', 'Mitchell Residence', '1', 'blocked', '6', '2012-01-30 23:06:45'),
(19, 'Lawrence', 'Tennis', 'Miss. Lawrence Tennis', 'Miss.', '4', 'lawrence@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00102030405', '00102030405', 'lawrence', 'Lawrence Residence', '11', 'active', '6', '2012-01-28 22:57:02'),
(21, 'Lauren', 'Matthews', 'Miss. Lauren Matthews', 'Miss.', '4', 'lauren@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '0100032434', '0100032434', 'lauren', 'Matthews Residence', '13', 'active', '6', '2012-01-30 13:37:13'),
(23, 'Williams', 'Lenkov', 'Dr. Williams Lenkov', 'Dr.', '3', 'lenkov@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00108090803', '00108090803', 'lenkov', 'Lenkov Residence', '11', 'active', '6', '2017-03-29 19:50:36'),
(25, 'Bernstein', 'Steiner', 'Mr. Bernstein Steiner', 'Mr.', '3', 'steiner@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '123', '123', 'skype', 'Steiner Residence', '1', 'active', '6', '2017-04-05 22:51:33'),
(26, 'Kelley', 'McGill', 'Dr. Kelley McGill', 'Dr.', '5', 'kelley@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00102030405', '00102030405', 'mcgill', 'McGill Residence', '13', 'active', '6', '2012-01-31 12:28:56'),
(28, 'Goossen', 'Sousa', 'Miss. Goossen Sousa', 'Miss.', '3', 'sousa@domain.ext', 'bd3b535b4f6392dce69c4068b95fae42', '00108090807', '00108090807', 'sousa', 'Goossen Residence', '1', 'active', '6', '2012-01-28 23:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `p_stock`
--

CREATE TABLE `p_stock` (
  `id` bigint(20) NOT NULL,
  `code` varchar(250) NOT NULL,
  `remaining` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `added_by` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_stock`
--

INSERT INTO `p_stock` (`id`, `code`, `remaining`, `total`, `branch`, `added_by`, `last_update`) VALUES
(2, 'PR34', '1', '68', '5', '1', '2012-02-01 10:06:16'),
(24, 'PN64', '5', '50', '11', '6', '2017-04-02 21:39:40'),
(12, 'HF61', '34', '45', '3', '1', '2017-03-15 13:04:09'),
(19, 'FT48', '23', '43', '2', '1', '2012-01-31 15:19:11'),
(27, 'UU30', '10', '10', '1', '6', '2017-03-19 18:20:38'),
(20, 'JI50', '551', '554', '2', '1', '2012-02-01 00:05:12'),
(30, 'AZ84', '89', '100', '13', '6', '2017-04-05 21:42:47'),
(31, 'CT53', '20', '20', '13', '6', '2017-03-29 17:17:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p_branches_dir`
--
ALTER TABLE `p_branches_dir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_global_permissions`
--
ALTER TABLE `p_global_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_logs`
--
ALTER TABLE `p_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_medicine_dir`
--
ALTER TABLE `p_medicine_dir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_med_record`
--
ALTER TABLE `p_med_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_patients_dir`
--
ALTER TABLE `p_patients_dir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_reports`
--
ALTER TABLE `p_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_staff_dir`
--
ALTER TABLE `p_staff_dir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_stock`
--
ALTER TABLE `p_stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p_branches_dir`
--
ALTER TABLE `p_branches_dir`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `p_logs`
--
ALTER TABLE `p_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1998;
--
-- AUTO_INCREMENT for table `p_medicine_dir`
--
ALTER TABLE `p_medicine_dir`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `p_med_record`
--
ALTER TABLE `p_med_record`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `p_patients_dir`
--
ALTER TABLE `p_patients_dir`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `p_reports`
--
ALTER TABLE `p_reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `p_staff_dir`
--
ALTER TABLE `p_staff_dir`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `p_stock`
--
ALTER TABLE `p_stock`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
