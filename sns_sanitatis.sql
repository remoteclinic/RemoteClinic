/*
MySQL Data Transfer
Source Host: localhost
Source Database: sns_sanitatis
Target Host: localhost
Target Database: sns_sanitatis
Date: 2/9/2012 11:32:22 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for p_branches_dir
-- ----------------------------
DROP TABLE IF EXISTS `p_branches_dir`;
CREATE TABLE `p_branches_dir` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `guardian` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_global_permissions
-- ----------------------------
DROP TABLE IF EXISTS `p_global_permissions`;
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_logs
-- ----------------------------
DROP TABLE IF EXISTS `p_logs`;
CREATE TABLE `p_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `at` datetime NOT NULL,
  `action` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `priority` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1157 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_med_record
-- ----------------------------
DROP TABLE IF EXISTS `p_med_record`;
CREATE TABLE `p_med_record` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `medicine` varchar(250) NOT NULL,
  `doses` varchar(250) NOT NULL,
  `timings` varchar(250) NOT NULL,
  `days` varchar(250) NOT NULL,
  `total` int(20) NOT NULL,
  `physician_id` varchar(250) NOT NULL,
  `report_id` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_medicine_dir
-- ----------------------------
DROP TABLE IF EXISTS `p_medicine_dir`;
CREATE TABLE `p_medicine_dir` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `added_by` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_patients_dir
-- ----------------------------
DROP TABLE IF EXISTS `p_patients_dir`;
CREATE TABLE `p_patients_dir` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `friendly_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_reports
-- ----------------------------
DROP TABLE IF EXISTS `p_reports`;
CREATE TABLE `p_reports` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_sales
-- ----------------------------
DROP TABLE IF EXISTS `p_sales`;
CREATE TABLE `p_sales` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `branch` varchar(250) NOT NULL,
  `quaintly` int(20) NOT NULL,
  `patients` int(20) NOT NULL,
  `sales` int(20) NOT NULL,
  `charge_mode` varchar(250) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_staff_dir
-- ----------------------------
DROP TABLE IF EXISTS `p_staff_dir`;
CREATE TABLE `p_staff_dir` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for p_stock
-- ----------------------------
DROP TABLE IF EXISTS `p_stock`;
CREATE TABLE `p_stock` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(250) NOT NULL,
  `remaining` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `added_by` varchar(250) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `p_branches_dir` VALUES ('1', '1', 'Dellwood', 'Dellwood Street', 'Model CIty', '042-123456', 'Head Office', '2012-02-08 21:34:13');
INSERT INTO `p_branches_dir` VALUES ('12', '1', 'Rokoray', 'Southern Province', 'Rokoray', '12345678', 'Branch', '2012-02-08 21:21:55');
INSERT INTO `p_branches_dir` VALUES ('13', '1', 'Gilgit', 'Gilgit Main Street', 'Gilgit City', '12345678', 'Branch', '2012-02-08 21:22:37');
INSERT INTO `p_branches_dir` VALUES ('11', '1', 'Bayonne', 'Bayonne', 'Bordeaux Tours', '12345678', 'Branch', '2012-02-08 21:21:12');
INSERT INTO `p_branches_dir` VALUES ('10', '1', 'Colmar', 'Colmar', 'Alsace', '123456789', 'Branch', '2012-02-08 21:20:34');
INSERT INTO `p_global_permissions` VALUES ('1', 'Sanitatis', '1.1', 'SNS', 'Sanitatis', '3', '4', '3', '4', '5', '3', '3', '3', '5', '3', '5', '5', '5', '3', '4', '08', '16', '4', '', 'Asia/Karachi', '5', '2.5', '1', '0', 'Super Admin', 'Senior Officer', 'Medical Officer', 'Medical Staff', 'User', 'Guest', '4', '5', '4', '3', '4', '5', '5', '4', '4', '5', '60', 'AUD', '5', '3', '1', '0', '6', '2012-02-08 21:32:18');
INSERT INTO `p_logs` VALUES ('1', '1', '2012-01-27 12:06:53', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1152', '6', '2012-02-10 12:24:04', 'LoggedOut', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1153', '6', '2012-02-10 12:24:12', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1154', '6', '2012-02-10 12:25:09', 'LoggedOut', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1155', '6', '2012-02-10 12:30:19', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1156', '6', '2012-02-10 12:30:24', 'LoggedOut', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1002', '6', '2012-02-05 19:12:50', 'LoggedOut', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1003', '6', '2012-02-05 19:12:56', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1004', '6', '2012-02-05 19:13:08', 'updated profile for Dr. Chris Grant', 'staff', '40');
INSERT INTO `p_logs` VALUES ('1005', '6', '2012-02-05 19:13:18', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1006', '6', '2012-02-05 19:13:19', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1007', '6', '2012-02-05 19:13:21', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1008', '6', '2012-02-05 19:21:39', 'updated global settings for PH Remedies', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1009', '6', '2012-02-05 19:21:56', 'updated global settings for PH Remedies', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1010', '6', '2012-02-05 19:25:33', 'updated global settings for PH Remedies', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1011', '6', '2012-02-05 19:29:42', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1012', '6', '2012-02-05 19:29:43', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1013', '6', '2012-02-05 19:29:56', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1014', '6', '2012-02-05 19:30:54', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1015', '6', '2012-02-05 19:32:26', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1016', '6', '2012-02-05 19:32:43', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1017', '6', '2012-02-05 19:32:46', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1018', '6', '2012-02-05 19:32:47', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1019', '6', '2012-02-05 19:33:26', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1020', '6', '2012-02-05 19:33:35', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1021', '6', '2012-02-05 19:33:51', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1022', '6', '2012-02-05 19:34:00', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1023', '6', '2012-02-05 19:34:20', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1024', '6', '2012-02-05 19:35:52', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1025', '6', '2012-02-05 19:36:02', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1026', '6', '2012-02-05 19:36:05', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1027', '6', '2012-02-05 19:37:24', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1028', '6', '2012-02-05 19:37:31', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1029', '6', '2012-02-05 19:37:44', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1030', '6', '2012-02-05 19:37:53', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1031', '6', '2012-02-05 19:38:01', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1032', '6', '2012-02-05 19:38:01', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1033', '6', '2012-02-05 19:38:09', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1034', '6', '2012-02-05 19:38:11', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1035', '6', '2012-02-05 19:38:18', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1036', '6', '2012-02-05 19:38:18', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1037', '6', '2012-02-05 19:38:19', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1038', '6', '2012-02-05 19:41:08', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1039', '6', '2012-02-05 19:41:29', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1040', '6', '2012-02-05 19:41:35', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1041', '6', '2012-02-05 19:42:23', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1042', '6', '2012-02-05 19:51:16', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1043', '6', '2012-02-05 19:51:21', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1044', '6', '2012-02-05 19:51:28', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1045', '6', '2012-02-05 19:54:05', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1046', '6', '2012-02-05 19:54:11', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1047', '6', '2012-02-05 19:54:28', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1048', '6', '2012-02-05 19:54:36', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1049', '6', '2012-02-05 19:54:57', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1050', '6', '2012-02-05 19:57:11', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1051', '6', '2012-02-05 19:57:27', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1052', '6', '2012-02-05 19:58:18', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1053', '6', '2012-02-05 19:58:26', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1054', '6', '2012-02-05 19:58:29', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1055', '6', '2012-02-05 19:58:55', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1056', '6', '2012-02-05 19:59:26', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1057', '6', '2012-02-05 20:00:34', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1058', '6', '2012-02-05 20:00:36', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1059', '6', '2012-02-05 20:00:39', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1060', '6', '2012-02-05 20:00:39', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1061', '6', '2012-02-05 20:00:40', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1062', '6', '2012-02-05 20:00:40', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1063', '6', '2012-02-05 20:00:55', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1064', '6', '2012-02-05 20:00:58', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1065', '6', '2012-02-05 20:01:04', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1066', '6', '2012-02-05 20:01:05', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1067', '6', '2012-02-05 20:15:14', 'registered the patient fds f 4 at PHR 1', 'patient', '20');
INSERT INTO `p_logs` VALUES ('1068', '6', '2012-02-05 20:15:25', 'composed the report for fds f 4 at PHR1', 'report', '20');
INSERT INTO `p_logs` VALUES ('1069', '6', '2012-02-05 20:15:26', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1070', '6', '2012-02-05 20:15:35', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1071', '6', '2012-02-05 20:15:42', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1072', '6', '2012-02-05 20:15:50', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1073', '6', '2012-02-05 20:15:59', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1074', '6', '2012-02-05 20:17:31', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1075', '6', '2012-02-05 20:17:35', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1076', '6', '2012-02-05 20:17:39', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1077', '6', '2012-02-05 20:18:30', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1078', '6', '2012-02-05 20:18:35', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1079', '6', '2012-02-05 20:19:34', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1080', '6', '2012-02-05 20:43:08', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1081', '6', '2012-02-05 20:43:27', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1082', '6', '2012-02-05 20:46:55', 'composed the report for 32 5235 at PHR1', 'report', '20');
INSERT INTO `p_logs` VALUES ('1083', '6', '2012-02-05 20:46:56', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1084', '6', '2012-02-05 20:47:04', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1085', '6', '2012-02-05 20:47:48', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1086', '6', '2012-02-05 20:47:49', 'has engaged the report 13', 'report', '10');
INSERT INTO `p_logs` VALUES ('1087', '6', '2012-02-05 20:48:06', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1088', '6', '2012-02-05 20:48:14', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1089', '6', '2012-02-05 20:48:22', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1090', '6', '2012-02-05 20:48:23', 'has engaged the report 24', 'report', '10');
INSERT INTO `p_logs` VALUES ('1091', '6', '2012-02-05 20:48:28', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1092', '6', '2012-02-05 20:48:32', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1093', '6', '2012-02-05 20:48:34', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1094', '6', '2012-02-05 20:48:38', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1095', '6', '2012-02-05 20:48:43', 'has engaged the report 25', 'report', '10');
INSERT INTO `p_logs` VALUES ('1096', '6', '2012-02-05 20:55:44', 'registered the patient 345 456 at PHR 1', 'patient', '20');
INSERT INTO `p_logs` VALUES ('1097', '6', '2012-02-05 20:55:52', 'composed the report for 345 456 at PHR1', 'report', '20');
INSERT INTO `p_logs` VALUES ('1098', '6', '2012-02-05 20:55:52', 'has engaged the report 26', 'report', '10');
INSERT INTO `p_logs` VALUES ('1099', '6', '2012-02-05 20:55:57', 'has engaged the report 26', 'report', '10');
INSERT INTO `p_logs` VALUES ('1100', '6', '2012-02-05 20:56:05', 'has engaged the report 26', 'report', '10');
INSERT INTO `p_logs` VALUES ('1101', '10', '2012-02-05 21:02:34', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1102', '10', '2012-02-05 21:02:38', 'registered the patient 345 5 at PHR 3', 'patient', '20');
INSERT INTO `p_logs` VALUES ('1103', '10', '2012-02-05 21:03:32', 'composed the report for 345 5 at PHR3', 'report', '20');
INSERT INTO `p_logs` VALUES ('1104', '6', '2012-02-05 21:03:56', 'updated global settings for PH Remedies', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1105', '10', '2012-02-05 21:04:02', 'has engaged the report 27', 'report', '10');
INSERT INTO `p_logs` VALUES ('1106', '10', '2012-02-05 21:05:20', 'has engaged the report 27', 'report', '10');
INSERT INTO `p_logs` VALUES ('1107', '10', '2012-02-05 21:05:31', 'has engaged the report 27', 'report', '10');
INSERT INTO `p_logs` VALUES ('1108', '10', '2012-02-05 21:05:43', 'has engaged the report 27', 'report', '10');
INSERT INTO `p_logs` VALUES ('1109', '10', '2012-02-05 21:06:00', 'composed the report for 32 5235 at PHR3', 'report', '20');
INSERT INTO `p_logs` VALUES ('1110', '10', '2012-02-05 21:06:02', 'has engaged the report 28', 'report', '10');
INSERT INTO `p_logs` VALUES ('1111', '10', '2012-02-05 21:06:06', 'has engaged the report 28', 'report', '10');
INSERT INTO `p_logs` VALUES ('1112', '10', '2012-02-05 21:09:47', 'composed the report for fds f 4 at PHR3', 'report', '20');
INSERT INTO `p_logs` VALUES ('1113', '6', '2012-02-06 19:00:51', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1114', '6', '2012-02-06 20:12:52', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1115', '6', '2012-02-06 20:13:11', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1116', '6', '2012-02-06 20:32:51', 'registered New Branch Profile for ert (9)', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1117', '6', '2012-02-06 20:33:03', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1118', '6', '2012-02-06 20:33:14', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1119', '6', '2012-02-06 20:33:52', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1120', '6', '2012-02-06 20:34:16', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1121', '6', '2012-02-06 20:34:25', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1122', '6', '2012-02-06 20:35:07', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1123', '6', '2012-02-06 20:35:56', 'deleted Brnach  - ID#', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1124', '6', '2012-02-06 20:40:38', 'deleted Brnach ert - ID#9', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1125', '6', '2012-02-07 22:07:55', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1126', '6', '2012-02-07 22:12:22', 'registered the patient 3243 at PHR 1', 'patient', '20');
INSERT INTO `p_logs` VALUES ('1127', '6', '2012-02-08 21:12:43', 'LoggedIn', 'staff', '10');
INSERT INTO `p_logs` VALUES ('1128', '6', '2012-02-08 21:16:02', 'updated global settings for PH Remedies', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1129', '6', '2012-02-08 21:16:42', 'updated global settings for Sanitatis', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1130', '6', '2012-02-08 21:17:02', 'updated global settings for Sanitatis', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1131', '6', '2012-02-08 21:18:03', 'updated global settings for Sanitatis', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1132', '6', '2012-02-08 21:18:42', 'deleted Brnach Dellwood Street - ID#2', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1133', '6', '2012-02-08 21:18:48', 'deleted Brnach Eburones - ID#5', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1134', '6', '2012-02-08 21:18:55', 'deleted Brnach Scalae Gemoniae - ID#3', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1135', '6', '2012-02-08 21:19:02', 'deleted Brnach Opus Craticum - ID#4', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1136', '6', '2012-02-08 21:19:08', 'deleted Brnach Flamen - ID#6', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1137', '6', '2012-02-08 21:19:14', 'deleted Brnach Texilla - ID#8', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1138', '6', '2012-02-08 21:19:51', 'registered New Branch Profile for Colmar (10)', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1139', '6', '2012-02-08 21:20:21', 'updated Branch Profile for Colmar (10)', 'branch', '40');
INSERT INTO `p_logs` VALUES ('1140', '6', '2012-02-08 21:20:30', 'updated Branch Profile for Colmar (10)', 'branch', '40');
INSERT INTO `p_logs` VALUES ('1141', '6', '2012-02-08 21:20:34', 'updated Branch Profile for Colmar (10)', 'branch', '40');
INSERT INTO `p_logs` VALUES ('1142', '6', '2012-02-08 21:21:12', 'registered New Branch Profile for Bayonne (11)', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1143', '6', '2012-02-08 21:21:55', 'registered New Branch Profile for Rokoray (12)', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1144', '6', '2012-02-08 21:22:37', 'registered New Branch Profile for Gilgit (13)', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1145', '6', '2012-02-08 21:27:02', 'updated global settings for Sanitatis', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1146', '6', '2012-02-08 21:29:39', 'registered the patient 232423 at SNS 1', 'patient', '20');
INSERT INTO `p_logs` VALUES ('1147', '6', '2012-02-08 21:32:18', 'updated global settings for Sanitatis', 'branch', '50');
INSERT INTO `p_logs` VALUES ('1148', '6', '2012-02-08 21:34:13', 'updated Branch Profile for Dellwood (1)', 'branch', '40');
INSERT INTO `p_logs` VALUES ('1149', '6', '2012-02-08 21:35:01', 'deleted Staff Member Dr. Katz Hooks - ID#24', 'staff', '50');
INSERT INTO `p_logs` VALUES ('1150', '6', '2012-02-08 21:35:14', 'updated profile for Dr. Chris Grant', 'staff', '40');
INSERT INTO `p_logs` VALUES ('1151', '6', '2012-02-10 12:04:25', 'LoggedIn', 'staff', '10');
INSERT INTO `p_medicine_dir` VALUES ('1', 'Bottle', 'PR34', 'Testone', '5', '1', '2012-01-28 16:29:26');
INSERT INTO `p_medicine_dir` VALUES ('22', 'Bottle', 'JQ46', 'Alprazaline', '5', '1', '2012-01-28 19:16:40');
INSERT INTO `p_medicine_dir` VALUES ('23', 'Bottle', 'ZD87', 'Cloaca', '5', '1', '2012-01-28 19:17:08');
INSERT INTO `p_medicine_dir` VALUES ('24', 'Bottle', 'NP98', 'Adravil', '5', '1', '2012-01-28 19:17:14');
INSERT INTO `p_medicine_dir` VALUES ('25', 'Bottle', 'WU44', 'Ambrosia', '5', '1', '2012-01-28 19:17:17');
INSERT INTO `p_medicine_dir` VALUES ('26', 'Syrup', 'CT53', 'Anabioticss', '12', '6', '2012-01-31 23:18:02');
INSERT INTO `p_medicine_dir` VALUES ('27', 'Bottle', 'VJ87', 'Anti-Ague', '5', '1', '2012-01-28 19:17:25');
INSERT INTO `p_medicine_dir` VALUES ('28', 'Bottle', 'MM80', 'Antibiotic Gel', '5', '1', '2012-01-28 19:17:28');
INSERT INTO `p_medicine_dir` VALUES ('29', 'Bottle', 'HF79', 'Antidote', '5', '1', '2012-01-28 19:17:32');
INSERT INTO `p_medicine_dir` VALUES ('30', 'Bottle', 'AZ84', 'Ascomycin', '5', '1', '2012-01-28 19:17:35');
INSERT INTO `p_medicine_dir` VALUES ('31', 'Syrup', 'KS33', 'Aslan', '5', '1', '2012-01-28 19:17:40');
INSERT INTO `p_medicine_dir` VALUES ('32', 'Tablets', 'PQ94', 'Athsat', '5', '1', '2012-01-28 19:17:45');
INSERT INTO `p_medicine_dir` VALUES ('33', 'Syrup', 'WS97', 'Aquasol', '5', '1', '2012-01-28 19:17:49');
INSERT INTO `p_medicine_dir` VALUES ('34', 'Bottle', 'TN56', 'Aqua Cure', '5', '1', '2012-01-28 19:17:54');
INSERT INTO `p_medicine_dir` VALUES ('35', 'Bottle', 'YG78', 'Bacta', '5', '1', '2012-01-28 19:17:57');
INSERT INTO `p_medicine_dir` VALUES ('36', 'Bottle', 'VV82', 'Azoth', '5', '1', '2012-01-28 19:18:00');
INSERT INTO `p_medicine_dir` VALUES ('37', 'Bottle', 'HV51', 'Bellerophon', '5', '1', '2012-01-28 19:18:03');
INSERT INTO `p_medicine_dir` VALUES ('38', 'Bottle', 'RI68', 'Bio-mimetic gel', '5', '1', '2012-01-28 19:18:07');
INSERT INTO `p_medicine_dir` VALUES ('39', 'Bottle', 'JM63', 'Bittamucin', '5', '1', '2012-01-28 19:18:11');
INSERT INTO `p_medicine_dir` VALUES ('40', 'Bottle', 'UU30', 'Blaccine', '5', '1', '2012-01-28 19:18:14');
INSERT INTO `p_medicine_dir` VALUES ('41', 'Bottle', 'KO26', 'Byphodine', '5', '1', '2012-01-28 19:18:19');
INSERT INTO `p_medicine_dir` VALUES ('42', 'Bottle', 'OI83', 'Catana', '5', '1', '2012-01-28 19:18:21');
INSERT INTO `p_medicine_dir` VALUES ('43', 'Tablets', 'RT52', 'Celestial Wine', '5', '1', '2012-01-28 19:18:27');
INSERT INTO `p_medicine_dir` VALUES ('44', 'Bottle', 'WK59', 'Chamalla extract', '5', '1', '2012-01-28 19:18:30');
INSERT INTO `p_medicine_dir` VALUES ('45', 'Syrup', 'GN67', 'Charlanta', '10', '6', '2012-01-31 23:18:44');
INSERT INTO `p_medicine_dir` VALUES ('46', 'Bottle', 'IW20', 'Cloveritol', '5', '1', '2012-01-28 19:18:35');
INSERT INTO `p_medicine_dir` VALUES ('47', 'Bottle', 'SK64', 'Comanapracil', '5', '1', '2012-01-28 19:18:38');
INSERT INTO `p_medicine_dir` VALUES ('48', 'Bottle', 'PN64', 'Coma White', '5', '1', '2012-01-28 19:18:42');
INSERT INTO `p_medicine_dir` VALUES ('49', 'Syrup', 'CJ78', 'Contrari', '5', '1', '2012-01-28 19:18:46');
INSERT INTO `p_medicine_dir` VALUES ('50', 'Bottle', 'SY75', 'Cordrazine', '5', '1', '2012-01-28 19:18:51');
INSERT INTO `p_patients_dir` VALUES ('1', 'Male', '21', 'PA', 'John Doe', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '1', '6', '2012-01-29 18:09:05', 'john, doe');
INSERT INTO `p_patients_dir` VALUES ('3', 'Male', '22', 'PA', 'Jack Smith', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '1', '6', '2012-01-29 18:11:17', 'jack, smith');
INSERT INTO `p_staff_dir` VALUES ('1', 'Saad', 'Irfan', 'Mr. Saad Irfan', 'Mr.', '5', 'saad@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Cietro Research Lab', '1', 'active', '1', '2012-01-31 15:17:50');
INSERT INTO `p_staff_dir` VALUES ('6', 'System', 'Admin', 'System Admin', 'Miss.', '6', 'admin@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', '0012', 'n/a', 'n/a', 'Cietro Research Lab', '1', 'active', '1', '2012-02-10 12:30:19');
INSERT INTO `p_staff_dir` VALUES ('9', 'Danville', 'Garrett', 'Dr. Danville Garrett', 'Dr.', '3', 'danville@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Danville Residence', '1', 'active', '6', '2012-01-28 22:53:47');
INSERT INTO `p_staff_dir` VALUES ('10', 'Woolnough', 'Smith', 'Dr. Woolnough Smith', 'Dr.', '4', 'smith@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Smith Residence', '1', 'active', '6', '2012-02-05 21:02:34');
INSERT INTO `p_staff_dir` VALUES ('11', 'Sheldon', 'Harper', 'Dr. Sheldon Harper', 'Dr.', '5', 'sheldon@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Harper  Residence', '1', 'active', '6', '2012-01-28 22:54:27');
INSERT INTO `p_staff_dir` VALUES ('12', 'Buckley', 'Taylor', 'Dr. Buckley Taylor', 'Dr.', '5', 'buckley@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Taylor Residence', '1', 'active', '6', '2012-01-28 22:54:52');
INSERT INTO `p_staff_dir` VALUES ('13', 'David', 'Katz', 'Mr. David Katz', 'Mr.', '3', 'david@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Katz Residence', '1', 'active', '6', '2012-01-30 13:32:38');
INSERT INTO `p_staff_dir` VALUES ('14', 'Robert', 'Palm', 'Dr. Robert Palm', 'Dr.', '5', 'robert@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Robert Residence', '1', 'active', '6', '2012-02-01 10:05:18');
INSERT INTO `p_staff_dir` VALUES ('15', 'Chris', 'Grant', 'Dr. Chris Grant', 'Dr.', '5', 'chris@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Chris Residence', '1', 'active', '6', '2012-01-28 22:55:55');
INSERT INTO `p_staff_dir` VALUES ('16', 'Cardea', 'McGill', 'Dr. Cardea McGill', 'Dr.', '3', 'cardea@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'McGill Residence', '1', 'active', '6', '2012-01-30 13:29:47');
INSERT INTO `p_staff_dir` VALUES ('17', 'Ellis', 'Mitchell', 'Dr. Ellis Mitchell', 'Dr.', '4', 'ellis@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Mitchell Residence', '1', 'active', '6', '2012-01-30 23:06:45');
INSERT INTO `p_staff_dir` VALUES ('18', 'Walsh', 'Palmer', 'Dr. Walsh Palmer', 'Dr.', '3', 'walsh@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Walsh Residence', '1', 'active', '6', '2012-01-28 22:56:47');
INSERT INTO `p_staff_dir` VALUES ('19', 'Lawrence', 'Tennis', 'Dr. Lawrence Tennis', 'Dr.', '4', 'lawrence@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Lawrence Residence', '1', 'active', '6', '2012-01-28 22:57:02');
INSERT INTO `p_staff_dir` VALUES ('20', 'Lucy', 'Attorney', 'Dr. Lucy Attorney', 'Dr.', '3', 'attorney@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Lucy Residence', '1', 'active', '6', '2012-01-31 15:23:13');
INSERT INTO `p_staff_dir` VALUES ('21', 'Lauren', 'Matthews', 'Dr. Lauren Matthews', 'Dr.', '4', 'lauren@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Matthews Residence', '1', 'active', '6', '2012-01-30 13:37:13');
INSERT INTO `p_staff_dir` VALUES ('22', 'Turner', 'Loceff', 'Dr. Turner Loceff', 'Dr.', '3', 'turner@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Turner Residence', '1', 'active', '6', '2012-01-28 22:57:55');
INSERT INTO `p_staff_dir` VALUES ('23', 'Williams', 'Lenkov', 'Dr. Williams Lenkov', 'Dr.', '3', 'lenkov@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Lenkov Residence', '1', 'active', '6', '2012-01-28 22:58:10');
INSERT INTO `p_staff_dir` VALUES ('25', 'Bernstein', 'Steiner', 'Dr. Bernstein Steiner', 'Dr.', '3', 'steiner@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Steiner Residence', '1', 'active', '6', '2012-01-28 22:59:00');
INSERT INTO `p_staff_dir` VALUES ('26', 'Kelley', 'McGill', 'Dr. Kelley McGill', 'Dr.', '5', 'kelley@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'McGill Residence', '1', 'active', '6', '2012-01-31 12:28:56');
INSERT INTO `p_staff_dir` VALUES ('27', 'Glasberg', 'Glasberg', 'Dr. Glasberg Glasberg', 'Dr.', '5', 'scovell@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Scovell  Residence', '1', 'active', '6', '2012-01-28 22:59:42');
INSERT INTO `p_staff_dir` VALUES ('28', 'Goossen', 'Sousa', 'Dr. Goossen Sousa', 'Dr.', '3', 'sousa@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Goossen Residence', '1', 'active', '6', '2012-01-28 23:00:07');
INSERT INTO `p_staff_dir` VALUES ('29', 'Jimmy', 'McGill', 'Dr. Jimmy McGill', 'Dr.', '3', 'jimmy@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'n/a', '1', 'active', '6', '2012-02-01 10:10:57');
INSERT INTO `p_staff_dir` VALUES ('30', 'Lucy', 'Robot', 'Miss. Lucy Robot', 'Miss.', '5', 'lucy@abc.xyz', '7c52edba7e8494609a6088d3f366bd15', 'n/a', 'n/a', 'n/a', 'Lucy Residence', '1', 'active', '6', '2012-02-02 08:46:49');
INSERT INTO `p_stock` VALUES ('1', 'PR34', '1', '49', '4', '1', '2012-02-01 10:06:16');
INSERT INTO `p_stock` VALUES ('2', 'PR34', '1', '68', '5', '1', '2012-02-01 10:06:16');
INSERT INTO `p_stock` VALUES ('3', 'HF61', '37', '54', '1', '1', '2012-02-05 21:05:43');
INSERT INTO `p_stock` VALUES ('4', 'EG13', '21', '24', '1', '1', '2012-01-31 13:08:25');
INSERT INTO `p_stock` VALUES ('5', 'MR62', '54', '54', '1', '1', '2012-01-28 19:28:25');
INSERT INTO `p_stock` VALUES ('6', 'UK81', '45', '45', '1', '1', '2012-01-28 19:28:31');
INSERT INTO `p_stock` VALUES ('7', 'MB81', '72', '88', '1', '1', '2012-02-05 19:51:21');
INSERT INTO `p_stock` VALUES ('8', 'GT50', '83', '103', '1', '1', '2012-01-30 23:00:24');
INSERT INTO `p_stock` VALUES ('9', 'RN25', '24', '34', '1', '1', '2012-01-28 19:28:43');
INSERT INTO `p_stock` VALUES ('10', 'KS63', '1', '3', '1', '1', '2012-01-28 19:28:47');
INSERT INTO `p_stock` VALUES ('11', 'SG24', '44', '54', '1', '1', '2012-01-28 19:28:50');
INSERT INTO `p_stock` VALUES ('12', 'HF61', '37', '45', '3', '1', '2012-02-05 21:05:43');
INSERT INTO `p_stock` VALUES ('13', 'CJ78', '290', '345', '1', '1', '2012-02-05 20:48:06');
INSERT INTO `p_stock` VALUES ('14', 'HF79', '43', '43', '1', '1', '2012-01-28 19:29:01');
INSERT INTO `p_stock` VALUES ('15', 'MS30', '21', '34', '1', '1', '2012-01-30 22:16:54');
INSERT INTO `p_stock` VALUES ('16', 'PX79', '24', '34', '1', '1', '2012-01-28 19:29:06');
INSERT INTO `p_stock` VALUES ('17', 'WU44', '24', '54', '1', '1', '2012-01-28 19:29:09');
INSERT INTO `p_stock` VALUES ('19', 'FT48', '43', '43', '2', '1', '2012-01-31 15:19:11');
INSERT INTO `p_stock` VALUES ('18', 'TL12', '4', '34', '1', '1', '2012-02-05 20:43:08');
INSERT INTO `p_stock` VALUES ('20', 'JI50', '551', '554', '2', '1', '2012-02-01 00:05:12');
