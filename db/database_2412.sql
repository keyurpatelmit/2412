-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 02:20 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_2412`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sales_call_id` int(11) DEFAULT NULL,
  `activity_date` date DEFAULT NULL,
  `activity_contact_name` text,
  `activity_outcome` text,
  `lab_test_id` int(11) DEFAULT NULL,
  `trial_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT 'new_sales_call, update_sales_call, trial, quotation, orders, visit, phone, email, other',
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `geocity` text,
  `geoaddress` text,
  `next_activity_date` date DEFAULT NULL,
  `brief_description` longtext,
  `start_time` time DEFAULT NULL,
  `stop_time` time DEFAULT NULL,
  `activity_start_time` text,
  `activity_end_time` text,
  `last_avtivity_desc` longtext,
  `inserted_time` datetime DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apidoc`
--

CREATE TABLE `apidoc` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `method` text NOT NULL,
  `action_url` text NOT NULL,
  `params` text NOT NULL,
  `mendetory_fileds` text NOT NULL,
  `description` text NOT NULL,
  `comments` text NOT NULL,
  `image` text NOT NULL,
  `images` text NOT NULL,
  `created_by` text NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inserted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apidoc`
--

INSERT INTO `apidoc` (`id`, `title`, `method`, `action_url`, `params`, `mendetory_fileds`, `description`, `comments`, `image`, `images`, `created_by`, `updated_time`, `inserted_time`, `is_deleted`) VALUES
(1, 'Get Zone list', 'post', 'get_zone', 'id', '', 'id (Optional)', '', '', '', 'Nirav ', '2021-08-21 07:31:06', '2021-08-21 07:31:06', '0'),
(2, 'Get State list', 'post', 'get_state', 'zone_id,\r\nid', '', 'zone_id,id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:31:36', '2021-08-21 07:31:36', '0'),
(3, 'Get city list', 'post', 'get_city', 'id,\r\nstate_id,\r\nzone_id ', '', 'id,state_id,zone_id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:32:05', '2021-08-21 07:32:05', '0'),
(4, 'Get Type of application list', 'post', 'get_type_of_application', 'id ', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 07:32:21', '2021-08-21 07:32:21', '0'),
(5, 'Get Applicator class list', 'post', 'get_applicator_class', 'id ', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 07:32:40', '2021-08-21 07:32:40', '0'),
(6, 'Get Applicator class list', 'post', 'get_applicators_annual_turnover', 'id', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 07:33:03', '2021-08-21 07:33:03', '0'),
(7, 'Get Dealer type list', 'post', 'get_dealer_type', 'id', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 07:33:25', '2021-08-21 07:33:25', '0'),
(8, 'Get Type of firm list', 'post', 'get_type_of_firm', 'id ', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:33:46', '2021-08-21 07:33:46', '0'),
(9, 'Get Dealer class list', 'post', 'get_dealer_class', 'id', '', 'id (Optional)		', '', '', '', 'Nirav', '2021-08-21 07:34:05', '2021-08-21 07:34:05', '0'),
(10, 'Get Dealers annual turnover list', 'post', 'get_dealers_annual_turnover', 'id ', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:34:24', '2021-08-21 07:34:24', '0'),
(11, 'Get Builder category list', 'post', 'get_builder_category', 'id ', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:34:42', '2021-08-21 07:34:42', '0'),
(12, 'Get Type of project site list', 'post', 'get_type_of_project_site', 'id ', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:35:03', '2021-08-21 07:35:03', '0'),
(13, 'Get Area Segmentation list', 'post', 'get_area_segmentation', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:35:38', '2021-08-21 07:35:38', '0'),
(14, 'Get Influencer type list', 'post', 'get_influencer_type', 'id', '', 'id (optional)', '', '', '', 'Nirav', '2021-08-21 07:36:00', '2021-08-21 07:36:00', '0'),
(15, 'Get work type', 'post', 'get_work_type', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:39:34', '2021-08-21 07:39:34', '0'),
(16, 'Get Dealer visit purpose', 'post', 'get_dealer_visit_purpose', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:42:35', '2021-08-21 07:42:35', '0'),
(17, 'Get Site visit purpose', 'post', 'get_site_visit_purpose', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:43:38', '2021-08-21 07:43:38', '0'),
(18, 'Get Applicator visit purpose', 'post', 'get_applicator_visit_purpose', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:45:23', '2021-08-21 07:45:23', '0'),
(19, 'Get Select customer type', 'post', 'get_select_customer_type', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:46:49', '2021-08-21 07:46:49', '0'),
(20, 'Get Type of sample', 'post', 'get_type_of_sample', 'id', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:48:34', '2021-08-21 07:48:34', '0'),
(21, 'Get Surface type', 'post', 'get_surface_type', 'id (Optional)', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:50:14', '2021-08-21 07:50:14', '0'),
(22, 'Get Meeting type', 'post', 'get_meeting_type', 'id (Optional)', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:52:01', '2021-08-21 07:52:01', '0'),
(23, 'Get Trial status', 'post', 'get_trial_status', 'id (Optional)', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:52:50', '2021-08-21 07:52:50', '0'),
(24, 'Get Reason for failure', 'post', 'get_reason_for_failure', 'id (Optional)', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:55:58', '2021-08-21 07:55:58', '0'),
(25, 'Get Reason for not interested', 'post', 'get_reason_for_not_interested', 'id (Optional)', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:56:47', '2021-08-21 07:56:47', '0'),
(26, 'Get Reason for not buying', 'post', 'get_reason_for_not_buying', 'id (Optional)', '', 'id (Optional)', '', '', '', 'Nirav', '2021-08-21 07:58:18', '2021-08-21 07:58:18', '0'),
(27, 'Get Inquiry source', 'post', 'get_inquiry_source', 'id (Optional)	', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 08:00:02', '2021-08-21 08:00:02', '0'),
(28, 'Get Complaint raised by', 'post', 'get_complaint_raised_by', ' id (Optional)	', '', ' id (Optional)	', '', '', '', 'Nirav', '2021-08-21 08:01:38', '2021-08-21 08:01:38', '0'),
(29, 'Get Product group', 'post', 'get_product_group', ' id (Optional)	', '', ' id (Optional)	', '', '', '', 'Nirav', '2021-08-21 08:02:59', '2021-08-21 08:02:59', '0'),
(30, 'Get Product category', 'post', 'get_product_category', 'id (Optional)	', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 08:04:33', '2021-08-21 08:04:33', '0'),
(31, 'Get sku', 'post', 'get_sku', 'id (Optional)	', '', 'id (Optional)	', '', '', '', 'Nirav', '2021-08-21 08:06:08', '2021-08-21 08:06:08', '0'),
(32, 'Add applicator', 'post', 'add_applicator', 'type\r\nname\r\nmobile\r\ndob\r\nanniversary\r\nemail\r\nstate_id\r\ncity_id\r\nannual_turnover\r\nno_of_labour\r\napplicator_class\r\nusing_brand\r\ndealer_id\r\ninfluencer_id\r\nassigned_to:\r\nlogin_user_id', 'type\r\nname\r\nmobile\r\nstate_id\r\ncity_id\r\nannual_turnover\r\nno_of_labour\r\napplicator_class\r\nusing_brand\r\ndealer_id\r\ninfluencer_id\r\n', '\r\ntype:1\r\nname:applicator 2\r\nmobile:7878787878\r\ndob:22-01-1990\r\nanniversary:12-12-2016\r\nemail:app@zydex.com\r\nstate_id:3\r\ncity_id:4\r\nannual_turnover:26\r\nno_of_labour:63\r\napplicator_class:4\r\nusing_brand:brand name\r\ndealer_id:1,2\r\ninfluencer_id:1\r\nassigned_to:\r\nlogin_user_id:544', '', '', '', 'Nirav', '2021-08-25 14:57:24', '2021-08-25 14:57:24', '0'),
(33, 'Update applicator', 'post', 'update_applicator', 'update_id\r\ntype\r\nname\r\nmobile\r\ndob\r\nanniversary\r\nemail\r\nstate_id\r\ncity_id\r\nannual_turnover\r\nno_of_labour\r\napplicator_class\r\nusing_brand\r\ndealer_id\r\ninfluencer_id\r\nassigned_to:\r\nlogin_user_id', 'update_id\r\ntype\r\nname\r\nmobile\r\nstate_id\r\ncity_id\r\nannual_turnover\r\nno_of_labour\r\napplicator_class\r\nusing_brand\r\ndealer_id\r\ninfluencer_id\r\n', 'update_id:5\r\ntype:1\r\nname:Applicator 2\r\nmobile:7878787878\r\ndob:22-01-1990\r\nanniversary:12-12-2016\r\nemail:app@zydex.com\r\nstate_id:3\r\ncity_id:4\r\nannual_turnover:30\r\nno_of_labour:65\r\napplicator_class:4\r\nusing_brand:Brand Name\r\ndealer_id:1,2\r\ninfluencer_id:1\r\nassigned_to:\r\nlogin_user_id:544', '', '', '', 'Nirav', '2021-08-25 15:00:03', '2021-08-25 14:57:24', '0'),
(34, 'Get Applicator', 'post', 'get_applicator', 'login_user_id', '', 'login_user_id:422', '', '', '', 'Nirav', '2021-08-26 18:38:52', '2021-08-26 18:38:52', '0'),
(35, 'Add Dealer', 'post', 'add_dealer', 'login_user_id\r\ncustomer_type\r\ncustomer_category\r\nname\r\nstate_id\r\ncity_id\r\npin_code\r\naddress\r\nmobile\r\nemail\r\nfirm_type\r\nowner_name\r\nowner_dob\r\nowner_anniversary\r\ndealershipcompanies\r\nturnover\r\nstart_business_year\r\nzydex_rank_id\r\nzydex_class_id\r\ngodown_space\r\nsap_code', '', 'login_user_id:544\r\ncustomer_type:direct_customer\r\ncustomer_category:sub_dealer\r\nname:Kisan firm\r\nstate_id:2\r\ncity_id:2\r\npin_code:390939\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nfirm_type:proprietorship\r\nowner_name:Bachubhai\r\nowner_dob:01-01-1957\r\nowner_anniversary:01-01-1970\r\ndealership:Dealership of other companies\r\nturnover:10\r\nstart_business_year:15\r\nzydex_rank_id:1\r\nzydex_class_id:1\r\ngodown_space:15\r\nsap_code:12560', '', '', '', 'Nirav', '2021-08-26 18:40:22', '2021-08-26 18:40:22', '0'),
(36, 'Update Dealer', 'post', 'update_dealer', 'update_id\r\nlogin_user_id\r\ncustomer_type\r\ncustomer_category\r\nname\r\nstate_id\r\ncity_id\r\npin_code\r\naddress\r\nmobile\r\nemail\r\nfirm_type\r\nowner_name\r\nowner_dob\r\nowner_anniversary\r\ndealershipcompanies\r\nturnover\r\nstart_business_year\r\nzydex_rank_id\r\nzydex_class_id\r\ngodown_space\r\nsap_code', '', 'update_id:1\r\nlogin_user_id:544\r\ncustomer_type:direct_customer\r\ncustomer_category:sub_dealer\r\nname:Kisan firm\r\nstate_id:2\r\ncity_id:2\r\npin_code:390939\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nfirm_type:proprietorship\r\nowner_name:Bachubhai\r\nowner_dob:01-01-1957\r\nowner_anniversary:01-01-1970\r\ndealership:Dealership of other companies\r\nturnover:10\r\nstart_business_year:15\r\nzydex_rank_id:1\r\nzydex_class_id:1\r\ngodown_space:15\r\nsap_code:12560', '', '', '', 'Nirav', '2021-08-26 18:41:29', '2021-08-26 18:40:22', '0'),
(37, 'Get Dealer', 'post', 'get_dealer', 'login_user_id', '', 'login_user_id:422', '', '', '', 'Nirav', '2021-08-26 18:42:12', '2021-08-26 18:42:12', '0'),
(38, 'Add Builder Group', 'post', 'add_builder_group', 'login_user_id\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nowner_name\r\nmobile\r\nemail\r\nwebsite\r\nzydex_class_id\r\nno_project_complete\r\nno_project_ongoing\r\nwaterproofing_companies\r\npaint_companies\r\ncc_companies\r\nzydex_class_id\r\nworking_other_cities\r\nphoto\r\nassigned_to', '', 'login_user_id:544\r\nname:Kisan firm\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nowner_name:Kantibhai Patel\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nwebsite:zydex.com\r\nzydex_class_id:1\r\nno_project_complete:10\r\nno_project_ongoing:20\r\nwaterproofing_companies:30\r\npaint_companies:40\r\ncc_companies:50\r\nzydex_class_id:1\r\nworking_other_cities:1\r\nphoto:image.png\r\nassigned_to:544', '', '', '', 'Nirav', '2021-08-27 10:25:03', '2021-08-27 10:25:03', '0'),
(39, 'Update Builder Group', 'post', 'update_builder_group', 'update_id\r\nlogin_user_id\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nowner_name\r\nmobile\r\nemail\r\nwebsite\r\nzydex_class_id\r\nno_project_complete\r\nno_project_ongoing\r\nwaterproofing_companies\r\npaint_companies\r\ncc_companies\r\nzydex_class_id\r\nworking_other_cities\r\nphoto\r\nassigned_to', '', 'update_id:1\r\nlogin_user_id:544\r\nname:Kisan firm\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nowner_name:Kantibhai Patel\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nwebsite:zydex.com\r\nzydex_class_id:1\r\nno_project_complete:10\r\nno_project_ongoing:20\r\nwaterproofing_companies:30\r\npaint_companies:40\r\ncc_companies:50\r\nzydex_class_id:1\r\nworking_other_cities:1\r\nphoto:image.png\r\nassigned_to:544', '', '', '', 'Nirav', '2021-08-27 10:25:03', '2021-08-27 10:25:03', '0'),
(40, 'Get Builder Group', 'post', 'get_builder_group', 'login_user_id', '', 'login_user_id:544', '', '', '', 'Nirav', '2021-08-26 18:42:12', '2021-08-26 18:42:12', '0'),
(41, 'Add Influencer', 'post', 'add_influencer', 'update_id\r\nlogin_user_id\r\ninfluencer_type\r\nowner_name\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nmobile\r\nemail\r\nwork_type_id\r\nbuilder_group_ids\r\nphoto\r\nassigned_to', '', 'login_user_id:544\r\ninfluencer_type:zydex.com\r\nowner_name:Kantibhai Patel\r\nname:Kisan firm\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nwork_type_id:1\r\nbuilder_group_ids :10\r\nphoto:image.png\r\nassigned_to:544', '', '', '', 'Nirav Darji', '2021-08-27 12:06:33', '2021-08-27 12:04:43', '0'),
(42, 'Update Influencer', 'post', 'update_influencer', 'update_id\r\nlogin_user_id\r\ninfluencer_type\r\nowner_name\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nmobile\r\nemail\r\nwork_type_id\r\nbuilder_group_ids\r\nphoto\r\nassigned_to', '', 'update_id:1\r\nlogin_user_id:544\r\ninfluencer_type:zydex.com\r\nowner_name:Kantibhai Patel\r\nname:Kisan firm\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nwork_type_id:1\r\nbuilder_group_ids:10\r\nphoto:image.png\r\nassigned_to:544', '', '', '', 'Nirav', '2021-08-27 12:06:28', '2021-08-27 12:06:28', '0'),
(43, 'Get Influencer', 'post', 'get_influencer', 'login_user_id', '', 'login_user_id:544', '', '', '', 'Nirav', '2021-08-27 12:07:20', '2021-08-27 12:07:20', '0'),
(44, 'Get Zydex Rank', 'post', 'get_zydex_rank', 'id ', '', 'id (optional)', '', '', '', 'Nirav', '2021-08-28 10:42:04', '2021-08-28 10:42:04', '0'),
(45, 'Get Project Potential', 'post', 'get_project_potential', 'login_user_id', '', 'login_user_id:544', '', '', '', 'Nirav', '2021-08-30 12:16:38', '2021-08-30 12:16:38', '0'),
(46, 'Add Project', 'post', 'add_project', 'login_user_id\r\nbuilder_id\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nmobile\r\nemail\r\nowner_name\r\nassigned_to\r\narea\r\nlandmark \r\ndesignation\r\nproject_type_id\r\narea_segmentation_id\r\nproject_potential_id\r\nsupply_point\r\ndealer_id\r\ninfluencer_reference\r\ninfluencer_id\r\narchitech_id\r\narchitech_name\r\narchitech_mobile\r\narchitech_firm\r\napplicator_id\r\napplicator_name\r\napplicator_mobile\r\napplicator_firm\r\ncivil_contractor_id\r\ncivil_contractor_name\r\ncivil_contractor_mobile\r\ncivil_contractor_firm\r\ntile_contractor_id\r\ntile_contractor_name\r\ntile_contractor_mobile\r\ntile_contractor_firm\r\npaint_contractor_id\r\npaint_contractor_name\r\npaint_contractor_mobile\r\npaint_contractor_firm', '', '\r\nlogin_user_id:544\r\nbuilder_id:10\r\nname:Kishan Project\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nowner_name:Kantibhai Patel\r\nassigned_to:544\r\narea:Main Road\r\nlandmark:Opp Gardan \r\ndesignation:\r\nproject_type_id:\r\narea_segmentation_id:\r\nproject_potential_id:\r\nsupply_point:\r\ndealer_id:\r\ninfluencer_reference:\r\ninfluencer_id:\r\narchitech_id:\r\narchitech_name:\r\narchitech_mobile:\r\narchitech_firm:\r\napplicator_id:\r\napplicator_name:\r\napplicator_mobile:\r\napplicator_firm:\r\ncivil_contractor_id:\r\ncivil_contractor_name:\r\ncivil_contractor_mobile:\r\ncivil_contractor_firm:\r\ntile_contractor_id:\r\ntile_contractor_name:\r\ntile_contractor_mobile:\r\ntile_contractor_firm:\r\npaint_contractor_id:\r\npaint_contractor_name:\r\npaint_contractor_mobile:\r\npaint_contractor_firm:', '', '', '', 'Nirav', '2021-08-30 12:18:24', '2021-08-30 12:18:24', '0'),
(47, 'Update Project', 'post', 'update_project', 'login_user_id\r\nupdate_id\r\nbuilder_id\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nmobile\r\nemail\r\nowner_name\r\nassigned_to\r\narea\r\nlandmark \r\ndesignation\r\nproject_type_id\r\narea_segmentation_id\r\nproject_potential_id\r\nsupply_point\r\ndealer_id\r\ninfluencer_reference\r\ninfluencer_id\r\narchitech_id\r\narchitech_name\r\narchitech_mobile\r\narchitech_firm\r\napplicator_id\r\napplicator_name\r\napplicator_mobile\r\napplicator_firm\r\ncivil_contractor_id\r\ncivil_contractor_name\r\ncivil_contractor_mobile\r\ncivil_contractor_firm\r\ntile_contractor_id\r\ntile_contractor_name\r\ntile_contractor_mobile\r\ntile_contractor_firm\r\npaint_contractor_id\r\npaint_contractor_name\r\npaint_contractor_mobile\r\npaint_contractor_firm', '', '\r\nlogin_user_id:544\r\nupdate_id:1\r\nbuilder_id:10\r\nname:Kishan Project\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nowner_name:Kantibhai Patel\r\nassigned_to:544\r\narea:Main Road\r\nlandmark:Opp Gardan \r\ndesignation:\r\nproject_type_id:\r\narea_segmentation_id:\r\nproject_potential_id:\r\nsupply_point:\r\ndealer_id:\r\ninfluencer_reference:\r\ninfluencer_id:\r\narchitech_id:\r\narchitech_name:\r\narchitech_mobile:\r\narchitech_firm:\r\napplicator_id:\r\napplicator_name:\r\napplicator_mobile:\r\napplicator_firm:\r\ncivil_contractor_id:\r\ncivil_contractor_name:\r\ncivil_contractor_mobile:\r\ncivil_contractor_firm:\r\ntile_contractor_id:\r\ntile_contractor_name:\r\ntile_contractor_mobile:\r\ntile_contractor_firm:\r\npaint_contractor_id:\r\npaint_contractor_name:\r\npaint_contractor_mobile:\r\npaint_contractor_firm:', '', '', '', 'Nirav', '2021-08-30 12:18:24', '2021-08-30 12:18:24', '0'),
(48, 'Get Projects', 'post', 'get_projects', '\r\nlogin_user_id:544', '', 'action:get_projects\r\nlogin_user_id:544', '', '', '', 'Nirav', '2021-08-30 12:19:54', '2021-08-30 12:19:54', '0'),
(49, 'Add Site', 'post', 'add_site', 'login_user_id\r\nbuilder_id\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nmobile\r\nemail\r\nowner_name\r\nassigned_to\r\narea\r\nlandmark \r\ndesignation\r\nproject_type_id\r\narea_segmentation_id\r\nproject_potential_id\r\nsupply_point\r\ndealer_id\r\ninfluencer_reference\r\ninfluencer_id\r\napplicator_id\r\napplicator_name\r\napplicator_mobile\r\n', '', 'action:update_site\r\nlogin_user_id:544\r\nbuilder_id:10\r\nname:Kishan Project\r\nstate_id:2\r\ncity_id:2\r\naddress:Near Airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nowner_name:Kantibhai Patel\r\nassigned_to:544\r\narea:Main Road\r\nlandmark:Opp Gardan\r\ndesignation:Manager\r\nproject_type_id:1\r\narea_segmentation_id:1\r\nproject_potential_id:1\r\nsupply_point:dealer\r\ndealer_id:1\r\ninfluencer_reference:yes\r\ninfluencer_id:1\r\napplicator_id:1\r\napplicator_name:text\r\napplicator_mobile:text', '', '', '', 'Nirav', '2021-08-31 08:05:22', '2021-08-30 12:18:24', '0'),
(50, 'Update site', 'post', 'update_site', 'login_user_id\r\nupdate_id\r\nbuilder_id\r\nname\r\nstate_id\r\ncity_id\r\naddress\r\nmobile\r\nemail\r\nowner_name\r\nassigned_to\r\narea\r\nlandmark \r\ndesignation\r\nproject_type_id\r\narea_segmentation_id\r\nproject_potential_id\r\nsupply_point\r\ndealer_id\r\ninfluencer_reference\r\ninfluencer_id\r\napplicator_id\r\napplicator_name\r\napplicator_mobile', '', 'action:update_site\r\nlogin_user_id:544\r\nbuilder_id:10\r\nname:kishan project\r\nstate_id:2\r\ncity_id:2\r\naddress:near airport\r\nmobile:9955336655\r\nemail:kisan@zydex.com\r\nowner_name:kantibhai patel\r\nassigned_to:544\r\narea:main road\r\nlandmark:opp gardan\r\ndesignation:manager\r\nproject_type_id:1\r\narea_segmentation_id:1\r\nproject_potential_id:1\r\nsupply_point:dealer\r\ndealer_id:1\r\ninfluencer_reference:yes\r\ninfluencer_id:1\r\napplicator_id:1\r\napplicator_name:text\r\napplicator_mobile:text', '', '', '', 'Nirav', '2021-08-31 08:06:06', '2021-08-30 12:18:24', '0'),
(51, 'Get Site', 'post', 'get_site', '\r\nlogin_user_id:544', '', 'action:get_projects\r\nlogin_user_id:544', '', '', '', 'Nirav', '2021-08-30 12:19:54', '2021-08-30 12:19:54', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sam_accessrights`
--

CREATE TABLE `sam_accessrights` (
  `id` bigint(20) NOT NULL,
  `role_id` text,
  `page_title` varchar(255) NOT NULL,
  `page_name` text,
  `module` text,
  `create_access` varchar(255) NOT NULL DEFAULT 'no',
  `edit_access` varchar(255) NOT NULL DEFAULT 'no',
  `view_access` varchar(255) NOT NULL DEFAULT 'no',
  `delete_access` varchar(255) NOT NULL DEFAULT 'no',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_accessrights`
--

INSERT INTO `sam_accessrights` (`id`, `role_id`, `page_title`, `page_name`, `module`, `create_access`, `edit_access`, `view_access`, `delete_access`, `is_deleted`, `status`, `created`, `modified`) VALUES
(1, 'admin', 'product_category', 'product_category', 'product_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:29:43', '0000-00-00 00:00:00'),
(2, 'staff', 'product_category', 'product_category', 'product_category', 'yes', 'no', 'yes', 'no', 0, '', '2021-09-03 18:29:43', '2021-09-04 14:03:10'),
(3, 'sales', 'product_category', 'product_category', 'product_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:29:43', '0000-00-00 00:00:00'),
(4, 'service', 'product_category', 'product_category', 'product_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:29:43', '2021-12-16 17:03:44'),
(5, 'account', 'product_category', 'product_category', 'product_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:29:43', '0000-00-00 00:00:00'),
(6, 'admin', 'product_brand', 'product_brand', 'product_brand', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:35:11', '0000-00-00 00:00:00'),
(7, 'staff', 'product_brand', 'Product brand', 'product_brand', 'no', 'no', 'no', 'no', 0, '', '2021-09-03 18:35:11', '2021-09-04 14:03:10'),
(8, 'sales', 'product_brand', 'product_brand', 'product_brand', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:35:11', '0000-00-00 00:00:00'),
(9, 'service', 'product_brand', 'product_brand', 'product_brand', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:35:11', '2021-12-16 17:03:44'),
(10, 'account', 'product_brand', 'product_brand', 'product_brand', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-03 18:35:11', '0000-00-00 00:00:00'),
(11, 'admin', 'Designation', 'Designation', 'designation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:16:47', '0000-00-00 00:00:00'),
(12, 'staff', 'Designation', 'Designation', 'designation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:16:47', '2021-09-04 14:03:10'),
(13, 'sales', 'Designation', 'Designation', 'designation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:16:47', '0000-00-00 00:00:00'),
(14, 'service', 'Designation', 'Designation', 'designation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:16:48', '2021-12-16 17:03:44'),
(15, 'account', 'Designation', 'Designation', 'designation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:16:48', '0000-00-00 00:00:00'),
(16, 'admin', 'Department', 'Department', 'department', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:20:52', '0000-00-00 00:00:00'),
(17, 'staff', 'Department', 'Department', 'department', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:20:52', '2021-09-04 14:03:10'),
(18, 'sales', 'Department', 'Department', 'department', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:20:52', '0000-00-00 00:00:00'),
(19, 'service', 'Department', 'Department', 'department', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:20:53', '2021-12-16 17:03:44'),
(20, 'account', 'Department', 'Department', 'department', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:20:53', '0000-00-00 00:00:00'),
(21, 'admin', 'Adminusers', 'Adminusers', 'adminusers', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:39:01', '0000-00-00 00:00:00'),
(22, 'staff', 'Adminusers', 'Adminusers', 'adminusers', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:39:01', '2021-09-04 14:03:10'),
(23, 'sales', 'Adminusers', 'Adminusers', 'adminusers', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:39:01', '0000-00-00 00:00:00'),
(24, 'service', 'Adminusers', 'Adminusers', 'adminusers', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:39:01', '2021-12-16 17:03:44'),
(25, 'account', 'Adminusers', 'Adminusers', 'adminusers', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 07:39:01', '0000-00-00 00:00:00'),
(26, 'admin', 'User', 'User', 'user', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:28:22', '0000-00-00 00:00:00'),
(27, 'staff', 'User', 'User', 'user', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:28:22', '2021-09-04 14:03:10'),
(28, 'sales', 'User', 'User', 'user', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:28:23', '0000-00-00 00:00:00'),
(29, 'service', 'User', 'User', 'user', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:28:23', '2021-12-16 17:03:44'),
(30, 'account', 'User', 'User', 'user', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:28:23', '0000-00-00 00:00:00'),
(31, 'admin', 'Accessrights', 'Accessrights', 'accessrights', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:31:21', '0000-00-00 00:00:00'),
(32, 'staff', 'Accessrights', 'Accessrights', 'accessrights', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:31:21', '2021-09-04 14:03:10'),
(33, 'sales', 'Accessrights', 'Accessrights', 'accessrights', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:31:21', '0000-00-00 00:00:00'),
(34, 'service', 'Accessrights', 'Accessrights', 'accessrights', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:31:21', '2021-12-16 17:03:44'),
(35, 'account', 'Accessrights', 'Accessrights', 'accessrights', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:31:21', '0000-00-00 00:00:00'),
(36, 'admin', 'uom', 'uom', 'uom', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:35:43', '0000-00-00 00:00:00'),
(37, 'staff', 'uom', 'uom', 'uom', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:35:43', '0000-00-00 00:00:00'),
(38, 'sales', 'uom', 'uom', 'uom', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:35:43', '0000-00-00 00:00:00'),
(39, 'service', 'uom', 'uom', 'uom', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:35:43', '2021-12-16 17:03:44'),
(40, 'account', 'uom', 'uom', 'uom', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 08:35:43', '0000-00-00 00:00:00'),
(41, 'admin', 'product_sub_category', 'product_sub_category', 'product_sub_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:23:02', '0000-00-00 00:00:00'),
(42, 'staff', 'product_sub_category', 'product_sub_category', 'product_sub_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:23:02', '0000-00-00 00:00:00'),
(43, 'sales', 'product_sub_category', 'product_sub_category', 'product_sub_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:23:02', '0000-00-00 00:00:00'),
(44, 'service', 'product_sub_category', 'product_sub_category', 'product_sub_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:23:02', '2021-12-16 17:03:44'),
(45, 'account', 'product_sub_category', 'product_sub_category', 'product_sub_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:23:03', '0000-00-00 00:00:00'),
(46, 'admin', 'service_category', 'service_category', 'service_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:45:10', '0000-00-00 00:00:00'),
(47, 'staff', 'service_category', 'service_category', 'service_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:45:10', '0000-00-00 00:00:00'),
(48, 'sales', 'service_category', 'service_category', 'service_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:45:10', '0000-00-00 00:00:00'),
(49, 'service', 'service_category', 'service_category', 'service_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:45:10', '2021-12-16 17:03:44'),
(50, 'account', 'service_category', 'service_category', 'service_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:45:10', '0000-00-00 00:00:00'),
(51, 'admin', 'customer_category', 'customer_category', 'customer_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:54:30', '0000-00-00 00:00:00'),
(52, 'staff', 'customer_category', 'customer_category', 'customer_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:54:30', '0000-00-00 00:00:00'),
(53, 'sales', 'customer_category', 'customer_category', 'customer_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:54:30', '0000-00-00 00:00:00'),
(54, 'service', 'customer_category', 'customer_category', 'customer_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:54:30', '2021-12-16 17:03:45'),
(55, 'account', 'customer_category', 'customer_category', 'customer_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 09:54:30', '0000-00-00 00:00:00'),
(56, 'admin', 'inquiry_source', 'inquiry_source', 'inquiry_source', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:06:36', '0000-00-00 00:00:00'),
(57, 'staff', 'inquiry_source', 'inquiry_source', 'inquiry_source', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:06:36', '0000-00-00 00:00:00'),
(58, 'sales', 'inquiry_source', 'inquiry_source', 'inquiry_source', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:06:36', '0000-00-00 00:00:00'),
(59, 'service', 'inquiry_source', 'inquiry_source', 'inquiry_source', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:06:36', '2021-12-16 17:03:45'),
(60, 'account', 'inquiry_source', 'inquiry_source', 'inquiry_source', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:06:36', '0000-00-00 00:00:00'),
(61, 'admin', 'payment_mode', 'payment_mode', 'payment_mode', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:17:20', '0000-00-00 00:00:00'),
(62, 'staff', 'payment_mode', 'payment_mode', 'payment_mode', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:17:21', '0000-00-00 00:00:00'),
(63, 'sales', 'payment_mode', 'payment_mode', 'payment_mode', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:17:21', '0000-00-00 00:00:00'),
(64, 'service', 'payment_mode', 'payment_mode', 'payment_mode', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:17:21', '2021-12-16 17:03:45'),
(65, 'account', 'payment_mode', 'payment_mode', 'payment_mode', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:17:21', '0000-00-00 00:00:00'),
(66, 'admin', 'tickets_priority', 'tickets_priority', 'tickets_priority', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:26:37', '0000-00-00 00:00:00'),
(67, 'staff', 'tickets_priority', 'tickets_priority', 'tickets_priority', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:26:37', '0000-00-00 00:00:00'),
(68, 'sales', 'tickets_priority', 'tickets_priority', 'tickets_priority', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:26:37', '0000-00-00 00:00:00'),
(69, 'service', 'tickets_priority', 'tickets_priority', 'tickets_priority', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:26:37', '2021-12-16 17:03:45'),
(70, 'account', 'tickets_priority', 'tickets_priority', 'tickets_priority', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:26:37', '0000-00-00 00:00:00'),
(71, 'admin', 'tickets_status', 'tickets_status', 'tickets_status', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:42:51', '0000-00-00 00:00:00'),
(72, 'staff', 'tickets_status', 'tickets_status', 'tickets_status', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:42:51', '0000-00-00 00:00:00'),
(73, 'sales', 'tickets_status', 'tickets_status', 'tickets_status', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:42:51', '0000-00-00 00:00:00'),
(74, 'service', 'tickets_status', 'tickets_status', 'tickets_status', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:42:51', '2021-12-16 17:03:45'),
(75, 'account', 'tickets_status', 'tickets_status', 'tickets_status', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 10:42:51', '0000-00-00 00:00:00'),
(76, 'admin', 'product_attributes', 'product_attributes', 'product_attributes', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 11:08:12', '0000-00-00 00:00:00'),
(77, 'staff', 'product_attributes', 'product_attributes', 'product_attributes', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 11:08:12', '0000-00-00 00:00:00'),
(78, 'sales', 'product_attributes', 'product_attributes', 'product_attributes', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 11:08:12', '0000-00-00 00:00:00'),
(79, 'service', 'product_attributes', 'product_attributes', 'product_attributes', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 11:08:12', '2021-12-16 17:03:45'),
(80, 'account', 'product_attributes', 'product_attributes', 'product_attributes', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 11:08:13', '0000-00-00 00:00:00'),
(81, 'admin', 'products', 'products', 'products', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 14:32:49', '0000-00-00 00:00:00'),
(82, 'staff', 'products', 'products', 'products', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 14:32:49', '0000-00-00 00:00:00'),
(83, 'sales', 'products', 'products', 'products', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 14:32:49', '0000-00-00 00:00:00'),
(84, 'service', 'products', 'products', 'products', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 14:32:50', '2021-12-16 17:03:45'),
(85, 'account', 'products', 'products', 'products', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-04 14:32:50', '0000-00-00 00:00:00'),
(86, 'admin', 'amc_device', 'amc_device', 'amc_device', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:22:14', '0000-00-00 00:00:00'),
(87, 'staff', 'amc_device', 'amc_device', 'amc_device', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:22:14', '0000-00-00 00:00:00'),
(88, 'sales', 'amc_device', 'amc_device', 'amc_device', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:22:14', '0000-00-00 00:00:00'),
(89, 'service', 'amc_device', 'amc_device', 'amc_device', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:22:14', '2021-12-16 17:03:45'),
(90, 'account', 'amc_device', 'amc_device', 'amc_device', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:22:15', '0000-00-00 00:00:00'),
(91, 'admin', 'city', 'city', 'city', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:36', '0000-00-00 00:00:00'),
(92, 'staff', 'city', 'city', 'city', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:36', '0000-00-00 00:00:00'),
(93, 'sales', 'city', 'city', 'city', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:36', '0000-00-00 00:00:00'),
(94, 'service', 'city', 'city', 'city', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:36', '2021-12-16 17:03:45'),
(95, 'account', 'city', 'city', 'city', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:36', '0000-00-00 00:00:00'),
(96, 'admin', 'state', 'state', 'state', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:43', '0000-00-00 00:00:00'),
(97, 'staff', 'state', 'state', 'state', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:43', '0000-00-00 00:00:00'),
(98, 'sales', 'state', 'state', 'state', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:43', '0000-00-00 00:00:00'),
(99, 'service', 'state', 'state', 'state', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:43', '2021-12-16 17:03:45'),
(100, 'account', 'state', 'state', 'state', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:33:43', '0000-00-00 00:00:00'),
(101, 'admin', 'expense_category', 'expense_category', 'expense_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:43:16', '0000-00-00 00:00:00'),
(102, 'staff', 'expense_category', 'expense_category', 'expense_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:43:16', '0000-00-00 00:00:00'),
(103, 'sales', 'expense_category', 'expense_category', 'expense_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:43:16', '0000-00-00 00:00:00'),
(104, 'service', 'expense_category', 'expense_category', 'expense_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:43:16', '2021-12-16 17:03:45'),
(105, 'account', 'expense_category', 'expense_category', 'expense_category', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 07:43:16', '0000-00-00 00:00:00'),
(106, 'admin', 'services', 'services', 'services', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 08:08:18', '0000-00-00 00:00:00'),
(107, 'staff', 'services', 'services', 'services', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 08:08:18', '0000-00-00 00:00:00'),
(108, 'sales', 'services', 'services', 'services', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 08:08:19', '0000-00-00 00:00:00'),
(109, 'service', 'services', 'services', 'services', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 08:08:19', '2021-12-16 17:03:45'),
(110, 'account', 'services', 'services', 'services', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 08:08:19', '0000-00-00 00:00:00'),
(111, 'admin', 'expense', 'expense', 'expense', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 10:36:18', '0000-00-00 00:00:00'),
(112, 'staff', 'expense', 'expense', 'expense', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 10:36:18', '0000-00-00 00:00:00'),
(113, 'sales', 'expense', 'expense', 'expense', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 10:36:18', '0000-00-00 00:00:00'),
(114, 'service', 'expense', 'expense', 'expense', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 10:36:18', '2021-12-16 17:03:45'),
(115, 'account', 'expense', 'expense', 'expense', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 10:36:18', '0000-00-00 00:00:00'),
(116, 'admin', 'amc', 'amc', 'amc', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 12:36:58', '0000-00-00 00:00:00'),
(117, 'staff', 'amc', 'amc', 'amc', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 12:36:58', '0000-00-00 00:00:00'),
(118, 'sales', 'amc', 'amc', 'amc', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 12:36:58', '0000-00-00 00:00:00'),
(119, 'service', 'amc', 'amc', 'amc', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 12:36:58', '2021-12-16 17:03:45'),
(120, 'account', 'amc', 'amc', 'amc', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-09-11 12:36:58', '0000-00-00 00:00:00'),
(121, 'admin', 'customer', 'customer', 'customer', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 10:58:26', '0000-00-00 00:00:00'),
(122, 'staff', 'customer', 'customer', 'customer', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 10:58:26', '0000-00-00 00:00:00'),
(123, 'sales', 'customer', 'customer', 'customer', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 10:58:26', '0000-00-00 00:00:00'),
(124, 'service', 'customer', 'customer', 'customer', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 10:58:26', '2021-12-16 17:03:45'),
(125, 'account', 'customer', 'customer', 'customer', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 10:58:26', '0000-00-00 00:00:00'),
(126, 'admin', 'inquiry', 'inquiry', 'inquiry', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 13:58:46', '0000-00-00 00:00:00'),
(127, 'staff', 'inquiry', 'inquiry', 'inquiry', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 13:58:46', '0000-00-00 00:00:00'),
(128, 'sales', 'inquiry', 'inquiry', 'inquiry', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 13:58:46', '0000-00-00 00:00:00'),
(129, 'service', 'inquiry', 'inquiry', 'inquiry', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 13:58:46', '2021-12-16 17:03:46'),
(130, 'account', 'inquiry', 'inquiry', 'inquiry', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-24 13:58:46', '0000-00-00 00:00:00'),
(131, 'admin', 'quotation', 'quotation', 'quotation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-25 12:48:13', '0000-00-00 00:00:00'),
(132, 'staff', 'quotation', 'quotation', 'quotation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-25 12:48:13', '0000-00-00 00:00:00'),
(133, 'sales', 'quotation', 'quotation', 'quotation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-25 12:48:13', '0000-00-00 00:00:00'),
(134, 'service', 'quotation', 'quotation', 'quotation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-25 12:48:13', '2021-12-16 17:03:46'),
(135, 'account', 'quotation', 'quotation', 'quotation', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-11-25 12:48:14', '0000-00-00 00:00:00'),
(136, 'admin', 'term_condition', 'term_condition', 'term_condition', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-08 10:59:47', '0000-00-00 00:00:00'),
(137, 'staff', 'term_condition', 'term_condition', 'term_condition', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-08 10:59:47', '0000-00-00 00:00:00'),
(138, 'sales', 'term_condition', 'term_condition', 'term_condition', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-08 10:59:47', '0000-00-00 00:00:00'),
(139, 'service', 'term_condition', 'term_condition', 'term_condition', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-08 10:59:47', '2021-12-16 17:03:46'),
(140, 'account', 'term_condition', 'term_condition', 'term_condition', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-08 10:59:47', '0000-00-00 00:00:00'),
(141, 'admin', 'invoice', 'invoice', 'invoice', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 06:07:29', '0000-00-00 00:00:00'),
(142, 'staff', 'invoice', 'invoice', 'invoice', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 06:07:29', '0000-00-00 00:00:00'),
(143, 'sales', 'invoice', 'invoice', 'invoice', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 06:07:29', '0000-00-00 00:00:00'),
(144, 'service', 'invoice', 'invoice', 'invoice', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 06:07:29', '2021-12-16 17:03:46'),
(145, 'account', 'invoice', 'invoice', 'invoice', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 06:07:29', '0000-00-00 00:00:00'),
(146, 'admin', 'tickets', 'tickets', 'tickets', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 13:21:56', '0000-00-00 00:00:00'),
(147, 'staff', 'tickets', 'tickets', 'tickets', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 13:21:56', '0000-00-00 00:00:00'),
(148, 'sales', 'tickets', 'tickets', 'tickets', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 13:21:56', '0000-00-00 00:00:00'),
(149, 'service', 'tickets', 'tickets', 'tickets', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 13:21:56', '2021-12-16 17:03:46'),
(150, 'account', 'tickets', 'tickets', 'tickets', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-15 13:21:56', '0000-00-00 00:00:00'),
(151, 'admin', 'amc_device_type', 'amc_device_type', 'amc_device_type', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-24 11:46:53', '0000-00-00 00:00:00'),
(152, 'staff', 'amc_device_type', 'amc_device_type', 'amc_device_type', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-24 11:46:53', '0000-00-00 00:00:00'),
(153, 'sales', 'amc_device_type', 'amc_device_type', 'amc_device_type', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-24 11:46:53', '0000-00-00 00:00:00'),
(154, 'service', 'amc_device_type', 'amc_device_type', 'amc_device_type', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-24 11:46:54', '0000-00-00 00:00:00'),
(155, 'account', 'amc_device_type', 'amc_device_type', 'amc_device_type', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-24 11:46:54', '0000-00-00 00:00:00'),
(156, 'admin', 'vandor', 'vandor', 'vandor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 08:48:49', '0000-00-00 00:00:00'),
(157, 'staff', 'vandor', 'vandor', 'vandor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 08:48:49', '0000-00-00 00:00:00'),
(158, 'sales', 'vandor', 'vandor', 'vandor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 08:48:49', '0000-00-00 00:00:00'),
(159, 'service', 'vandor', 'vandor', 'vandor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 08:48:50', '0000-00-00 00:00:00'),
(160, 'account', 'vandor', 'vandor', 'vandor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 08:48:50', '0000-00-00 00:00:00'),
(161, 'admin', 'vendor', 'vendor', 'vendor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 09:06:56', '0000-00-00 00:00:00'),
(162, 'staff', 'vendor', 'vendor', 'vendor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 09:06:56', '0000-00-00 00:00:00'),
(163, 'sales', 'vendor', 'vendor', 'vendor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 09:06:56', '0000-00-00 00:00:00'),
(164, 'service', 'vendor', 'vendor', 'vendor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 09:06:56', '0000-00-00 00:00:00'),
(165, 'account', 'vendor', 'vendor', 'vendor', 'yes', 'yes', 'yes', 'yes', 0, '', '2021-12-25 09:06:57', '0000-00-00 00:00:00'),
(166, 'admin', 'problem_report', 'problem_report', 'problem_report', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-10 09:22:25', '0000-00-00 00:00:00'),
(167, 'staff', 'problem_report', 'problem_report', 'problem_report', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-10 09:22:25', '0000-00-00 00:00:00'),
(168, 'sales', 'problem_report', 'problem_report', 'problem_report', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-10 09:22:25', '0000-00-00 00:00:00'),
(169, 'service', 'problem_report', 'problem_report', 'problem_report', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-10 09:22:25', '0000-00-00 00:00:00'),
(170, 'account', 'problem_report', 'problem_report', 'problem_report', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-10 09:22:25', '0000-00-00 00:00:00'),
(171, 'admin', 'component', 'component', 'component', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-14 07:43:30', '0000-00-00 00:00:00'),
(172, 'staff', 'component', 'component', 'component', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-14 07:43:30', '0000-00-00 00:00:00'),
(173, 'sales', 'component', 'component', 'component', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-14 07:43:30', '0000-00-00 00:00:00'),
(174, 'service', 'component', 'component', 'component', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-14 07:43:30', '0000-00-00 00:00:00'),
(175, 'account', 'component', 'component', 'component', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-02-14 07:43:30', '0000-00-00 00:00:00'),
(176, 'admin', 'salesorder', 'salesorder', 'salesorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-19 09:30:38', '0000-00-00 00:00:00'),
(177, 'staff', 'salesorder', 'salesorder', 'salesorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-19 09:30:38', '0000-00-00 00:00:00'),
(178, 'sales', 'salesorder', 'salesorder', 'salesorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-19 09:30:38', '0000-00-00 00:00:00'),
(179, 'service', 'salesorder', 'salesorder', 'salesorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-19 09:30:38', '0000-00-00 00:00:00'),
(180, 'account', 'salesorder', 'salesorder', 'salesorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-19 09:30:38', '0000-00-00 00:00:00'),
(181, 'admin', 'puchaseorder', 'puchaseorder', 'puchaseorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-29 13:35:58', '0000-00-00 00:00:00'),
(182, 'staff', 'puchaseorder', 'puchaseorder', 'puchaseorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-29 13:35:59', '0000-00-00 00:00:00'),
(183, 'sales', 'puchaseorder', 'puchaseorder', 'puchaseorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-29 13:35:59', '0000-00-00 00:00:00'),
(184, 'service', 'puchaseorder', 'puchaseorder', 'puchaseorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-29 13:35:59', '0000-00-00 00:00:00'),
(185, 'account', 'puchaseorder', 'puchaseorder', 'puchaseorder', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-03-29 13:35:59', '0000-00-00 00:00:00'),
(186, 'admin', 'challan', 'challan', 'challan', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-04-01 11:16:04', '0000-00-00 00:00:00'),
(187, 'staff', 'challan', 'challan', 'challan', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-04-01 11:16:04', '0000-00-00 00:00:00'),
(188, 'sales', 'challan', 'challan', 'challan', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-04-01 11:16:04', '0000-00-00 00:00:00'),
(189, 'service', 'challan', 'challan', 'challan', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-04-01 11:16:04', '0000-00-00 00:00:00'),
(190, 'account', 'challan', 'challan', 'challan', 'yes', 'yes', 'yes', 'yes', 0, '', '2022-04-01 11:16:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sam_customers`
--

CREATE TABLE `sam_customers` (
  `id` bigint(20) NOT NULL,
  `payment_terms` text,
  `customer_type` enum('customer','contractor') DEFAULT 'customer',
  `state_id` text,
  `city_id` int(11) DEFAULT NULL,
  `customer_id` text,
  `customer_category_id` text,
  `service_id` text,
  `product_id` text,
  `name` varchar(255) DEFAULT NULL,
  `customer_code` text,
  `address` text,
  `mobile` text,
  `email` text,
  `password` text,
  `password_text` text,
  `reference_by` text,
  `gst_no` text,
  `pin_code` varchar(50) DEFAULT NULL,
  `pan_no` text,
  `contact` text,
  `user_id` int(11) DEFAULT NULL,
  `description_note` text,
  `industry` text,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `created_by_type` varchar(20) NOT NULL COMMENT 'user , dealer',
  `inserted_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` timestamp NULL DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_customers`
--

INSERT INTO `sam_customers` (`id`, `payment_terms`, `customer_type`, `state_id`, `city_id`, `customer_id`, `customer_category_id`, `service_id`, `product_id`, `name`, `customer_code`, `address`, `mobile`, `email`, `password`, `password_text`, `reference_by`, `gst_no`, `pin_code`, `pan_no`, `contact`, `user_id`, `description_note`, `industry`, `is_deleted`, `status`, `created_by_type`, `inserted_time`, `updated_time`, `created_by_user_id`) VALUES
(1, NULL, 'customer', '3', 4, NULL, 'individual', NULL, NULL, 'Manubhai Patel', '000001', 'Near Address', '08855669944', 'manubhai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Facebook', 'ASDASDASD', '390009', 'ASDASDXC', NULL, NULL, '', '', 1, 'active', '', '2021-11-24 11:51:16', '2022-02-08 12:13:17', 1),
(2, NULL, 'customer', '3', 4, NULL, 'walk_in', NULL, NULL, 'Priyankaben patel', '000002', 'Near Address', '08855669944', 'mayur@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Facebook', 'ASDA0025555', '393145', 'ASDASD4554', NULL, NULL, '', '', 0, 'active', '', '2021-12-15 06:28:17', '2022-02-08 12:12:57', 1),
(10, NULL, 'contractor', '3', 4, NULL, '1', NULL, NULL, 'Meenaben Patel', '000003', 'Near Address', '8855669944', 'meena@gmail.com', '', NULL, NULL, NULL, '390009', NULL, NULL, NULL, NULL, NULL, 1, 'active', '', '2021-12-24 11:26:39', NULL, 1),
(11, NULL, 'contractor', '2', 5, NULL, '1', NULL, NULL, 'Kiran Patel', '000004', 'Near Address', '8855669944', 'kiran@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'FB', 'ASDASD', '393145', 'ASDASD4545', NULL, NULL, NULL, NULL, 1, 'active', '', '2021-12-25 09:11:24', '2021-12-25 09:15:16', 1),
(12, NULL, 'customer', '3', 3, NULL, 'individual', NULL, NULL, 'Kanti Patel 124', '000005', 'Near Station', '08596478798', 'kanti@gmail.com', '', NULL, '', '', '225566', '', NULL, NULL, '', '', 1, 'active', '', '2021-12-31 11:56:15', '2022-02-08 12:13:12', 1),
(13, NULL, 'customer', '3', 4, NULL, 'company', NULL, NULL, 'Maahi IT', '00006', 'Near Address', '8855669944', 'mayur@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'No Ref', 'ASD012254858', '393393', 'ASDA12548528', NULL, NULL, '', '', 1, 'active', '', '2022-01-03 10:11:20', '2022-02-08 12:12:49', 1),
(14, NULL, 'customer', '', 0, NULL, 'company', NULL, NULL, 'REHAU POLYMERS PRIVATE LIMITED', '00007', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', NULL, NULL, '', '', 1, 'active', '', '2022-02-03 13:22:36', '2022-02-08 12:12:45', 1),
(15, NULL, 'customer', '3', 4, NULL, 'walk_in', NULL, NULL, 'Madhuri', '1002', 'Vadodara', '9601288401', 'support@techservices.net.in', '', NULL, 'Hetal', 'sasfsdgsg', '390009', 'fdsfsf', NULL, NULL, '', '', 1, 'active', '', '2022-02-03 17:13:18', '2022-02-08 12:12:05', 1),
(16, NULL, 'customer', '3', 4, NULL, 'walk_in', NULL, NULL, 'Babu bhai ', '12345', 'asdf', '567800000', 'babu@babu.com', '', NULL, '', '', '390009', '', NULL, NULL, '', '', 1, 'active', '', '2022-02-04 16:28:13', '2022-02-08 12:11:58', 1),
(17, NULL, 'customer', '', 0, NULL, 'company', NULL, NULL, 'Mehul Bhatt', '12346', 'Hira Buag Complex, Sussen-Tarsali Road', '09601283521', 'backup.techservices@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin123', '', '', '', '', NULL, NULL, '', '', 1, 'active', '', '2022-02-04 16:42:13', '2022-02-08 12:12:32', 1),
(18, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'ITCG SOLUTIONS Pvt. Ltd.', NULL, '301,Earth The Landmark, Opp.satsang party plot, Sun pharma Road,Baroda', '7043541100', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '390012', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 17:46:15', NULL, 1),
(19, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Meridian Infotech Limited', NULL, 'Associated Society, Prasanna House 1, 301, opp. Radha Krishna Park Society, Akota, Vadodara', '9825043158', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 17:50:45', NULL, 1),
(20, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Ashapura Laptop Part', NULL, 'UF 3, Antrix Complex, Sayaji Ganj, Vadodara - 390020, Opposite BBC Tower', '7383806101', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 17:54:06', NULL, 1),
(21, 'k@k.com', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'Shree Balaji Enterprises ', NULL, '18-19, ROYAL PLAZA 6,Near Jetalpur Bridge Jetalpur Road, Alkapuri, Vadodara - 390007, Near 6 Sampatrao Colony ', '9825768080', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '24AHAPA5117F1Z5', '390007', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 17:58:33', '2022-05-07 15:43:08', 1),
(22, 'k@k.com', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'Famy Infotech', NULL, '6, Ground Floor, Antrix Complex, Sayaji Ganj, Vadodara - 390020, Opposite Silverline Complex', '9824408919', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '24AAAFF7740A1Z0', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 18:00:31', '2022-05-07 15:47:52', 1),
(23, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'PATEL INFOTECH', NULL, 'FF-06 VANESA PLAZA, NR VADSAR BRIDGE AND AMBE SCHOOL,OPP.VRAJBHOOMI SOC.,MANJALPUR,VADODARA', '9409386940', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 18:03:36', NULL, 1),
(24, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Nand Infotech', NULL, 'G/18,Ivory Terrace,NEAR REDIPHONE,R C Dutt Road, Alkapuri, Vadodara - 390007', '9601288401', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-04 18:06:56', NULL, 1),
(25, NULL, 'customer', '3', 4, NULL, 'company', NULL, NULL, 'Matrix ComSec Pvt. Ltd.', '00001', 'R & D-II: 416?GIDC, Makarpura, Vadodara?390 010', '9265872353', '', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, NULL, '', '', 1, 'active', '', '2022-02-04 18:41:51', '2022-02-08 12:12:28', 1),
(26, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Power House', NULL, 'E-6, Vaikunthdham Apartment, Opp Gajanan Heights, B/H Ganesh Hall, Darbar Chokdi, Manjalpur, Vadodara, Gujarat 390011', '9427859270', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 12:00:59', NULL, 1),
(27, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Khajanchi Infotech', NULL, 'Prestige Complex GF-5 & 6, Jetalpur Bridge, opp. Suraj Plaza, Sarod, Sayajiganj, Vadodara, Gujarat 390005', '800093035', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 12:22:11', NULL, 1),
(28, NULL, 'contractor', '3', 8, NULL, NULL, NULL, NULL, 'Gronext Future private limited', NULL, ' GroNext Corporate House 31, Navjivan Industrial Society, Canal Rd, near Unique Hospital, Udhna, Surat, Gujarat 395002', '9376637980', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 12:35:35', '2022-02-05 12:36:53', 1),
(29, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Shree Harsh Peripherial Private Limited', NULL, '19 Basement, Gokul Apartment, Laxmi Colony, Bpc Road, Bpc Road, near Haveli Mandir, Vadodara, Gujarat 390005', '', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 12:41:44', NULL, 1),
(30, NULL, 'contractor', '3', 9, NULL, NULL, NULL, NULL, 'Vin Trade Inc', NULL, 'Office no 2, Sur sarthi complex, Opp chhadawada police station, Ambawadi, Ahmedabad, Gujarat 380006', '9825511223', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 12:58:48', NULL, 1),
(31, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Aarav Technologies', NULL, 'AA-104 Sainath Square Tower-3,Behind Mother School Gotri Road, Vdodara-390021', '9898033042', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 13:06:07', NULL, 1),
(32, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Mahavir Computers', NULL, '201-F-Tower, Kunj Plaza, Palace Road, Vadodara-390001', '9824028497', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 13:12:34', NULL, 1),
(33, NULL, 'contractor', '3', 0, NULL, NULL, NULL, NULL, 'Varnitech Solution Private Limited', NULL, 'Trushar, Nr. New Hostel,Besides Maheshwari Palace, Bakrol Road Anand Gujarat 388120', '9879574844', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 13:32:15', '2022-02-28 10:58:59', 1),
(34, NULL, 'contractor', '3', 4, NULL, NULL, NULL, NULL, 'Ocean INC', NULL, '101, Sarthak Flats, 76, near M.K.High school, Alkapuri Society, Alkapuri, Vadodara, Gujarat 390007', '9909005912', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-02-05 15:14:43', '2022-02-28 10:54:56', 1),
(35, NULL, 'customer', '3', 4, NULL, 'walk_in', NULL, NULL, 'Dhara', '123', 'Vadodara', '9601288999', 'abc@xyz.com', '', NULL, 'Reference by', 'GST No', '390009', 'Pan No', NULL, NULL, '', 'industry', 1, 'active', '', '2022-02-05 18:14:42', '2022-02-08 12:11:45', 1),
(36, NULL, 'customer', '3', 10, NULL, 'individual', NULL, NULL, 'Priyank Mali', '00124', 'Near Airport, Main Bazar', '8545658547', 'priyank@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'No Any Ref', 'GSTNO000001', '390009', 'ASDASD2222', NULL, NULL, 'Short Description Here', 'banking', 0, 'active', '', '2022-02-08 10:35:13', '2022-02-08 12:11:10', 1),
(37, NULL, 'customer', '3', 9, NULL, '1', NULL, NULL, 'Sunil Patel', '00125', 'near station', '9955668844', 'sunil@gmail.com', '', NULL, NULL, NULL, '393393', NULL, NULL, NULL, NULL, NULL, 1, 'active', '', '2022-03-19 09:40:15', NULL, 1),
(38, NULL, 'customer', NULL, NULL, NULL, 'amc', NULL, NULL, 'asdas', '00126', NULL, NULL, 'asda', '130716294b00192b9094f7cad8349d38', 'aadas', 'asdas', 'asd', NULL, 'asd', NULL, NULL, 'asdas', 'banking', 1, 'active', '', '2022-03-23 08:29:27', NULL, 1),
(39, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'Matrix ComSec Pvt. Ltd.', '00127', 'A10 Pavan duplex,Matrix ComSec Pvt. Ltd.', '9988556699', 'gagandeep.singh@matrixcomsec.com', 'e6e061838856bf47e1de730719fb2609', '', '', '', NULL, '', NULL, NULL, '', 'banking', 1, 'active', '', '2022-04-01 10:15:16', '2022-04-05 16:04:18', 1),
(40, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'Gagan Shah', '00128', NULL, NULL, 'gagan@gmail.com', NULL, NULL, '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-04-01 11:53:56', '2022-04-01 12:12:58', 1),
(41, NULL, 'customer', '3', 11, NULL, '2', NULL, NULL, 'Mayur bhai', '00129', 'Tarsali Vadodara', '9601283521', 'mayur007@gmail.com', NULL, NULL, NULL, NULL, '390009', NULL, NULL, NULL, NULL, NULL, 1, 'active', '', '2022-04-01 17:33:38', NULL, 1),
(42, NULL, 'customer', '3', 11, NULL, '2', NULL, NULL, 'Rahul ', '00130', 'Vadodara', '9600128585', 'rahul007@gmail.com', NULL, NULL, NULL, NULL, '390009', NULL, NULL, NULL, NULL, NULL, 1, 'active', '', '2022-04-01 17:48:30', NULL, 1),
(43, NULL, 'customer', '3', 11, NULL, '2', NULL, NULL, 'Shiv Patel ', '00131', 'Gotri', '96012888402', 'shiv@gmail.com', NULL, NULL, NULL, NULL, '391101', NULL, NULL, NULL, NULL, NULL, 1, 'active', '', '2022-04-02 10:21:41', NULL, 1),
(44, NULL, 'customer', '3', 11, NULL, '2', NULL, NULL, 'Keshav Prajapati ', '00132', 'Waghodia ', '9601288409', 'keshav@gmail.com', NULL, NULL, NULL, NULL, '390025', NULL, NULL, NULL, NULL, NULL, 1, 'active', '', '2022-04-04 18:08:33', NULL, 1),
(45, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'Rajubhai', '00133', 'Tarsali Vadodara', '7600600010', 'raju@raju.com', NULL, NULL, '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-04-12 14:20:05', '2022-04-12 16:15:13', 1),
(46, NULL, 'customer', '', NULL, NULL, 'walk_in', '5', '9,10', 'Manubhai Patel', '00046', 'A-35 Shiv Complex', '8855446658', 'manu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'FB', 'ASDASDASDASDS', NULL, 'ASDASD001', NULL, NULL, 'Note', '', 0, 'active', '', '2022-04-13 16:40:16', '2024-11-23 13:02:14', 1),
(47, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'GREEN ENERZON PRIVATE LIMITED', '00047', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '24AAECG0426H1Z2', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-04-13 16:50:18', '2022-04-13 16:50:47', 1),
(48, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'ROTEX AUTOMATION LIMITED UNIT-1', '00048', '987/11, GIDC Makarpura, Vadodara – 390 010 Gujarat, India ', '', 'systembrd@rotexautomation.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '24AABCR0011J1Z0', NULL, 'AABCROO11J', NULL, NULL, '', 'industry', 1, 'active', '', '2022-04-14 16:25:14', NULL, 1),
(49, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'Deepak Shah ', '00048', 'Tarsali', '9601288403', 'deepak@deepakgmail.com', 'b1475c86962de59729daa6e056d2256e', 'Tech@123', '', '', NULL, '', NULL, NULL, 'Laptop', '', 1, 'active', '', '2022-04-14 16:37:25', NULL, 1),
(50, NULL, 'customer', NULL, NULL, NULL, '', NULL, NULL, 'Mehul bhai ', '00050', 'Tarsali Vadodara', '7600102200', 'mehul@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-04-14 17:03:54', NULL, 1),
(51, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'Meera Patel', '00051', 'Tarsali', '9601288403', 'meera@gmail.com', 'ad6009a7e354612e85bb1c393ee564d9', 'meera@123', '', '', NULL, '', NULL, NULL, 'Laptop', '1', 1, 'active', '', '2022-04-14 17:17:27', '2022-04-14 17:50:15', 1),
(52, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'Praful sir', '00052', '303 silverline complex , opp. BBC tower sayajigunj', '9227472303', 'optima4u@rediffmail.com', '202cb962ac59075b964b07152d234b70', '123', '', '', NULL, '', NULL, NULL, '', '2', 1, 'active', '', '2022-04-26 12:35:40', NULL, 1),
(53, NULL, 'customer', NULL, NULL, NULL, 'fmc', NULL, NULL, 'Yogesh Sharma ', '00053', 'manjalpur', '9825462977', 'yogesh@gmail.com', '3d52a9f7f1092a497da7384b80acde5c', 'yogesh@123', '', '', NULL, '', NULL, NULL, '', '', 0, 'active', '', '2022-04-27 17:23:49', NULL, 1),
(54, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'Yogesh Sharma ', '00054', '', '9825462977', 'yog@gmail.com', '3d52a9f7f1092a497da7384b80acde5c', 'yogesh@123', '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-04-27 17:48:38', NULL, 1),
(55, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'MR.Yunus', '00055', 'MARFATIA STOCK BROKING PVT LTD 216, Glacier complex, Jetalpur Road,, Vadodara, Gujarat 390005', '9725451622', 'yunus@marfatia.net', '202cb962ac59075b964b07152d234b70', '123', '', '', NULL, '', NULL, NULL, '', '2', 1, 'active', '', '2022-04-28 15:46:22', NULL, 1),
(56, '', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'Nifty Solutions', NULL, '1109,Nilamber Triumph, Nr.Bansal Mall, Nilamber Circle, Gotri Vasna Road, Vadodara - 390021', '8140725581', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '24ACIPT8269J1ZW', '390021', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 11:28:22', NULL, 1),
(57, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'Setco', '00001', 'Vadodara Godhra Highway, Kalol , 389330', '6357422454', 'ajay.thatte@setcoauto.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-05-07 11:43:28', NULL, 1),
(58, '', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'PIONEER SYSTEMS', NULL, 'GF-45,Paradise complex,Nr. Rajeshree Cinema ,Sayajiganj, Vadodara, Gujarat 390005', '9825873579', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '24ACRPB5167C1ZT', '390005', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 13:03:15', NULL, 1),
(59, '', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'KAVYA INFOTECH', NULL, 'G-19,Ivory Tarrace Opp. Alkapuri officer, S Club, R.C. Dutt road , Vadodara - 390007', '', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '24DMUPP1611M1ZM', '390007', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 13:30:25', NULL, 1),
(60, '', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'IR FOCUS', NULL, '1st Floor, Gopi Nivas,Opp.Alankar Appartment above Axis Bank, B/H Fire Station, Dandiya Bazar,Vadodara-390001', '7567530965', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '390001', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 15:23:00', NULL, 1),
(61, '', 'contractor', '3', 9, NULL, NULL, NULL, NULL, 'MEHTA BROTHERS', NULL, 'Kalash Enclave,98,Swastik Society,GR.Floor, Opp.Vedanr hospital, Samved HospitalRoad, Navrangpura,Ahmedabad,380009', '9925002826', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '380009', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 15:28:20', NULL, 1),
(62, '', 'contractor', '3', 9, NULL, NULL, NULL, NULL, 'EnvoQue Solutions', NULL, '22nd Floor,Block-B,Westgate,Nr.YMCA Club, SG Highway,Ahmedabad-380015', '7600338983', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '', '', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 15:32:08', NULL, 1),
(63, '07-09-2021', 'contractor', '3', 11, '2,36,46', NULL, NULL, NULL, 'RAJ INFOTECH', NULL, '402,403,404,Tower-A , The Atlantic, Opp-SRP Ground,  Makarpura, Vadodara, Gujarat 390010', '9328558281', 'ujjval@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '', '24AAMFR2233C1ZM', '390010', '', NULL, NULL, NULL, NULL, 0, 'active', '', '2022-05-07 15:41:02', '2024-11-25 12:00:07', 1),
(64, '07-09-2021', 'contractor', '3', 11, '46', NULL, NULL, NULL, 'Ashapura Laptop Part', NULL, 'UF 3, Antrix Complex, Sayaji Ganj, Vadodara - 390020, Opposite BBC Tower', '8866223931', 'ashapuracoputer@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '', '24AUAPD2355H1Z5', '390020', '', NULL, NULL, NULL, NULL, 0, 'active', '', '2022-05-07 15:49:58', '2024-11-25 11:59:50', 1),
(65, '', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'Meridian Infotech Limited', NULL, '301-Prasanna House-1,Associated Society, Opp.Radhakrishna Park,Akota, Vadodara - 390020', '', 'k@k.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', '', '24AABCM3420E1Z5', '390020', '', NULL, NULL, NULL, NULL, 1, 'active', '', '2022-05-07 16:04:14', NULL, 1),
(66, '', 'contractor', '3', 11, NULL, NULL, NULL, NULL, 'Shree Balaji Enterprises ', NULL, '18-19, ROYAL PLAZA 6,Near Jetalpur Bridge Jetalpur Road, Alkapuri, Vadodara 390007, Near 6 Sampatrao Colony ', '9825768080', 'Shreebalaji1605@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '', '24AHAPA5117F1Z5', '390007', '', NULL, NULL, NULL, NULL, 0, 'active', '', '2022-05-09 18:23:28', NULL, 1),
(67, 'test', 'contractor', '3', 11, '2,36,53,77', NULL, NULL, NULL, 'PATEL INFOTECH', NULL, 'FF-06 VANESA PLAZA, NR VADSAR BRIDGE AND AMBE SCHOOL,OPP.VRAJBHOOMI SOC.,MANJALPUR,VADODARA', '9409386940', 'patelinfotech@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '24BFVPP5775E1ZU', '390019', 'AAJCB8719R', NULL, NULL, NULL, NULL, 0, 'active', '', '2022-05-09 18:26:23', '2024-11-25 11:53:46', 1),
(68, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'jayti gangegi', '00068', 'tasali', '9033223515', 'as9319658@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', NULL, '', NULL, NULL, 'wi-fi option not showing', '', 1, 'active', '', '2022-05-25 15:48:29', '2022-05-25 15:50:57', 1),
(69, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'test 1', '00069', '', '9601606127', 'kiran0123@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-05-25 16:00:33', NULL, 1),
(70, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'BAAHU PANELS PRIVATE LIMITED', '00070', 'Survey No 17/1, Savli Halol Road Sherpura Vadodara , 391520', '9831170527', 'arnab.banerjee@greenply.com', '0192023a7bbd73250516f069df18b500', 'admin123', '', '24AAJCB8719R1ZX', NULL, 'AAJCB8719R', NULL, NULL, '', '', 1, 'active', '', '2022-05-25 16:54:34', NULL, 1),
(71, NULL, 'customer', NULL, NULL, NULL, 'walk_in', NULL, NULL, 'test 2', '00071', 'Vadodara', '7600610052', 'test@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin123', '', '', NULL, '', NULL, NULL, '', '', 1, 'active', '', '2022-05-26 13:04:19', NULL, 1),
(72, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'anjali singh', '00072', 'makarpura maneja', '9601606126', 'as960160@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', NULL, '', NULL, NULL, '', '11', 1, 'active', '', '2022-06-20 15:40:53', '2022-06-20 15:46:10', 1),
(73, NULL, 'customer', NULL, NULL, NULL, 'company', NULL, NULL, 'Nalisha Automation Pvt. Ltd.', '00073', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C, Ahmedabad-382430, Gujarat, India', '9979849514', 'info@integratedsolution.in', '0e7517141fb53f21ee439b355b5a1d0a', 'Admin@123', '', '24AAGCN2446Q1Z2', NULL, '', NULL, NULL, '', '2', 1, 'active', '', '2022-06-20 16:14:35', '2022-06-20 16:14:48', 1),
(74, NULL, 'customer', '', NULL, NULL, 'company', '10', '16,17', 'tarun', '00074', 'aajwa road vadodara', '8866223931', 'tarunjadav@gmail.com', '903ce9225fca3e988c2af215d4e544d3', '143', 'fgdg151', '23AOMPJ0691N1ZL', NULL, '3dhfd984', NULL, NULL, 'hyyyy', '1', 0, 'active', '', '2024-11-20 05:18:55', '2024-11-25 11:05:25', 1),
(75, NULL, 'customer', '10', NULL, NULL, 'amc', '9', '13,15', 'sachin', '00075', '35/4th Floor, Sidheshwar Plaza, New VIP Rd, Sheshnarayan Society, Sardar Estate, Sayaji Park Society, Vadodara, Gujarat 390022', '1234567890', 'sachin@gmail.com', '609017d94948a5650f59c1e90096b93e', 'sachin@123', 'tarun', '23AOMPJ0691N1ZL', NULL, 'ADFG5695f', NULL, NULL, 'test', '10', 0, 'active', '', '2024-11-22 07:12:59', '2024-11-23 13:00:26', 1),
(76, NULL, 'customer', '10', NULL, NULL, 'amc', '3,4', '6,7,8,9', 'tarun', '00076', 'aajwa road', '8866223931', 'tarunjadav@gmail.com', '2d0313fa52b3a237a4b7575bd3fb207e', 'tarun_123', 'tarun', '23AOMPJ0691N1ZL', NULL, 'AOMPJ0691N', NULL, NULL, '', '2', 1, 'active', '', '2024-11-23 07:48:43', NULL, 1),
(77, NULL, 'customer', '3', NULL, NULL, 'walk_in', '7,8', '10,11', 'parth', '00077', '35/4th Floor, Sidheshwar Plaza, New VIP Rd, Sheshnarayan Society, Sardar Estate, Sayaji Park Society, Vadodara, Gujarat 390022', '2233445566', 'parthpatel@gmail.com', '1592f4a6f03dfdf4dca29de2a7874507', 'parth@123', 'tarun', '23AOMPJ0691N1ZL', NULL, 'AOMPJ0691N', NULL, NULL, '', '6', 0, 'active', '', '2024-11-25 05:59:45', '2024-11-25 06:01:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sam_customers_address`
--

CREATE TABLE `sam_customers_address` (
  `id` int(11) NOT NULL,
  `customer_id` text,
  `cust_address_name` text,
  `cust_address` text,
  `cust_state_id` text,
  `cust_city_id` text,
  `cust_zip_code` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_customers_address`
--

INSERT INTO `sam_customers_address` (`id`, `customer_id`, `cust_address_name`, `cust_address`, `cust_state_id`, `cust_city_id`, `cust_zip_code`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '1', 'Tarsali', 'Reva party plot,Tarsali bypass, Tarsali', '3', '3', '390009', 0, 'active', NULL, NULL, NULL),
(2, '1', 'Rajpipla', 'opp old police station,darbar road', '2', '2', '393145', 0, 'active', NULL, NULL, NULL),
(3, '1', 'Rajpipla New', 'Shivam residency,near temple', '3', '4', '390009', 1, 'active', NULL, NULL, NULL),
(4, '2', 'Billing Address', 'Near Station road', '3', '4', '393939', 0, 'active', NULL, NULL, NULL),
(5, '2', 'Shippinh Address', 'Near Railyway station', '2', '2', '789987', 0, 'active', NULL, NULL, NULL),
(6, '3', 'Permanent Address', 'Alkapuri main road', '3', '4', '393001', 0, 'active', NULL, NULL, NULL),
(7, '13', 'Permanent Address', 'Reva party plot,Tarsali bypass', '3', '4', '396523', 0, 'active', NULL, NULL, NULL),
(8, '14', 'Halol', 'Survey No.785, Nexus Industrial Park – Phase: 2, Post: Kotambi,  Before Jarod, Opp. GE [Formerly Alstom Ltd], Vadodara-Halol Highway Road, ', '3', '', '391510', 0, 'active', NULL, NULL, NULL),
(9, '15', 'Vadodara', 'Vadodara', '3', '4', '390009', 0, 'active', NULL, NULL, NULL),
(10, '36', 'Permanent Address', 'Reva party plot,Tarsali bypass, Tarsali', '3', '3', '393366', 0, 'active', NULL, NULL, NULL),
(11, '36', 'Office Address', 'JURONG WEST AVE', '3', '4', '390009', 0, 'active', NULL, NULL, NULL),
(12, '38', 'asd', 'asdasd', '3', '10', '1', 0, 'active', NULL, NULL, NULL),
(13, '39', 'R & D', 'R & D-II: 416?GIDC, Makarpura,', '3', '11', '390010', 0, 'active', NULL, NULL, NULL),
(14, '39', 'Waghodia', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', 0, 'active', NULL, NULL, NULL),
(15, '39', 'Head Office', '394?GIDC, Makarpura, ', '3', '11', '390010', 0, 'active', NULL, NULL, NULL),
(16, '46', 'Head office', 'Near Station', '3', '9', '393696', 0, 'active', NULL, NULL, NULL),
(17, '47', 'Makarpura', '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', 0, 'active', NULL, NULL, NULL),
(18, '48', 'Makarpura', 'UNIT-1 - 987/11 G.I.D.C.MAKARPURA', '3', '11', '390010', 0, 'active', NULL, NULL, NULL),
(19, '50', 'tarsali ', 'Hirabuag Complex', '3', '11', '390009', 0, 'active', NULL, NULL, NULL),
(20, '51', 'Tarsali', 'HIRA', '3', '11', '390010', 0, 'active', NULL, NULL, NULL),
(21, '52', 'Sayajigunj', '303 silverline complex opp. BBC tower sayajigunj', '3', '11', '390005', 0, 'active', NULL, NULL, NULL),
(22, '55', 'Jetalpur road', '216, Glacier complex, Jetalpur Road', '3', '11', '390005', 0, 'active', NULL, NULL, NULL),
(23, '57', 'Vadodara', 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', 0, 'active', NULL, NULL, NULL),
(24, '68', 'tarsali', 'tarali', '3', '11', '390009', 0, 'active', NULL, NULL, NULL),
(25, '69', 'makarpura', 'indra nagar', '3', '11', '390010', 0, 'active', NULL, NULL, NULL),
(26, '70', 'Sherpura', 'Survey No 17/1, Savli Halol Road Sherpura', '3', '11', '391520', 0, 'active', NULL, NULL, NULL),
(27, '71', 'tarsali', 'TARSALI  ', '3', '11', '390009', 0, 'active', NULL, NULL, NULL),
(28, '72', 'makarpura', 'f-76 maneja makarpura', '3', '', '390019', 0, 'active', NULL, NULL, NULL),
(29, '73', ' Ahmedabad', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', 0, 'active', NULL, NULL, NULL),
(30, '74', 'dfgdfg', 'fgdf', '3', '11', '390019', 1, 'active', NULL, NULL, NULL),
(31, '75', 'test', '35/4th Floor, Sidheshwar Plaza, New VIP Rd, Sheshnarayan Society, Sardar Estate, Sayaji Park Society, Vadodara, Gujarat 390022', '3', '11', '390019', 0, 'active', NULL, NULL, NULL),
(32, '76', 'test', 'aajwa road', '3', '11', '390019', 1, 'active', NULL, NULL, NULL),
(33, '77', 'AAAA 1', '35/4th Floor, Sidheshwar Plaza, New VIP Rd, Sheshnarayan Society, Sardar Estate, Sayaji Park Society, Vadodara, Gujarat 390022', '8', '11', '390019', 0, 'active', NULL, '2024-11-25 10:44:02', NULL),
(34, '77', 'test', 'aajwa road vadodara', '3', '11', '390019', 0, 'inactive', NULL, '2024-11-25 10:48:20', NULL),
(35, '77', 'test 3', 'test', '3', '11', '390019', 0, 'inactive', NULL, '2024-11-25 10:48:09', NULL),
(36, '77', 'tarun test ', 'tarun test', '2', '2', '390019', 1, 'active', NULL, '2024-11-25 10:46:08', NULL),
(37, '36', 't', 't', NULL, NULL, NULL, 1, 'active', NULL, NULL, NULL),
(38, '74', 'test', 'test', '3', '11', '390019', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sam_customers_contact`
--

CREATE TABLE `sam_customers_contact` (
  `id` int(11) NOT NULL,
  `customer_id` text,
  `contact_persons` text,
  `designations_id` text,
  `mobile` text,
  `email` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_customers_contact`
--

INSERT INTO `sam_customers_contact` (`id`, `customer_id`, `contact_persons`, `designations_id`, `mobile`, `email`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '1', 'krutik pacholi', '2', '9966332255', 'kp@gmail.com', 0, 'active', NULL, NULL, NULL),
(2, '1', 'malav barot', '2', '8855223366', 'mb@gmail.com', 1, 'active', NULL, NULL, NULL),
(3, '1', 'Mayur Gosai', '2', '2233665544', 'mg@gmail.com', 0, 'active', NULL, NULL, NULL),
(4, '2', 'Mayur Gosai', '2', '0265223366', 'mayur@gmail.com', 0, 'active', NULL, NULL, NULL),
(5, '2', 'Maulik Patel', '2', '8855447799', 'maulik@gmail.com', 0, 'active', NULL, NULL, NULL),
(6, '3', 'Shivam Patel', '2', '9898989898', 'shivam@gmail.com', 0, 'active', NULL, NULL, NULL),
(7, '13', 'Developer Contact', '2', '0265223366', 'developer@gmail.com', 0, 'active', NULL, NULL, NULL),
(8, '14', 'Dinesh Kyada ', '', '9607835496', 'dineshkumar.kyada@rehau.com', 0, 'active', NULL, NULL, NULL),
(9, '15', 'Madhuri', '', '9601288401', 'support@techservices.net.in', 0, 'active', NULL, NULL, NULL),
(10, '25', 'Gagandeep Singh Sarna', '', '9265872353', '', 0, 'active', NULL, NULL, NULL),
(11, '36', 'Priyank Mali', '3', '0265223366', 'priyank@gmail.com', 0, 'active', NULL, NULL, NULL),
(12, '36', 'Monikaben Patel', '4', '0265332255', 'monika@gmail.com', 0, 'active', NULL, NULL, NULL),
(13, '38', 'asda', '11', '09596989793', 'activated010101@yopmail.com', 0, 'active', NULL, NULL, NULL),
(14, '39', 'Gagandeep Singh Sarna', '8', '9265872353', 'gagandeep.singh@matrixcomsec.com', 0, 'active', NULL, NULL, NULL),
(15, '39', 'Amit Thakor', '14', '7043200786', 'amit.thakor@matrixcomsec.com', 0, 'active', NULL, NULL, NULL),
(16, '40', 'Gagan Shah', '', '', '', 0, 'active', NULL, NULL, NULL),
(17, '46', 'Manubhai Patel', '3', '0265336699', 'manu@gmail.com', 0, 'active', NULL, NULL, NULL),
(18, '47', 'Dharmesh Patel', '20', '8511106524', 'Consult@greenelectricals.com', 0, 'active', NULL, NULL, NULL),
(19, '48', 'Chirag Pawar', '4', '917043644138', 'systembrd@rotexautomation.com', 0, 'active', NULL, NULL, NULL),
(20, '50', 'Mehul Bhai', '2', '7600102200', 'mehul@gmail.com', 0, 'active', NULL, NULL, NULL),
(21, '51', 'Meera Patel', '', '9601288403', 'meera@gmail.com', 0, 'active', NULL, NULL, NULL),
(22, '52', 'Praful sir', '3', '9227472303', 'optima4u@rediffmail.com', 0, 'active', NULL, NULL, NULL),
(23, '55', 'MR.Yunus', '', '9725451622', 'yunus@marfatia.net', 0, 'active', NULL, NULL, NULL),
(24, '57', 'Ajay Thatte', '20', '6357422454', 'ajay.thatte@setcoauto.com', 0, 'active', NULL, NULL, NULL),
(25, '68', 'jayti gangeli', '', '9033223515', '', 0, 'active', NULL, NULL, NULL),
(26, '68', 'Mehul Bhatt', '', '09601283521', 'backup.techservices@gmail.com', 0, 'active', NULL, NULL, NULL),
(27, '69', 'kirn', '', '9601606128', 'kiran0123@gmail.com', 0, 'active', NULL, NULL, NULL),
(28, '70', 'Arnab Banerjee', '', '9831170527', '', 0, 'active', NULL, NULL, NULL),
(29, '71', 'Test 2', '2', '7600610052', 'test@gmail.com', 0, 'active', NULL, NULL, NULL),
(30, '72', 'anjali', '7', '8487920815', 'as848792@gmail.com', 0, 'active', NULL, NULL, NULL),
(31, '73', 'Nalisha Automation', '3', '799701203', 'info@integratedsolution.in', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sam_settings`
--

CREATE TABLE `sam_settings` (
  `id` bigint(20) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `sitename` varchar(255) NOT NULL,
  `sitelogo` text NOT NULL,
  `gst_no` text,
  `pan_no` text,
  `email` text,
  `mobile` text,
  `address` text NOT NULL,
  `pdf_back_image` text NOT NULL,
  `language` varchar(50) NOT NULL,
  `currency_code` text CHARACTER SET utf8,
  `country` varchar(255) NOT NULL,
  `country_code` char(20) NOT NULL,
  `date_format` varchar(50) NOT NULL,
  `rows_per_page` int(11) NOT NULL,
  `sys_email` varchar(255) NOT NULL,
  `theme` char(50) NOT NULL,
  `order_description` longtext,
  `timezone` varchar(100) NOT NULL,
  `expense_lock_days` text,
  `attendance_lock_days` text,
  `ho_notifications` text,
  `smtp_status` text,
  `smtp_encryption` text,
  `smtp_username` text,
  `smtp_password` text,
  `smtp_name` text,
  `smtp_host` text,
  `offer_signature` text,
  `offer_signature_text` text,
  `amount_per_km_for_car` text,
  `amount_per_km_for_bike` text,
  `smtp_port` text,
  `paintertrainingcount` text,
  `dealertrainingcount` text,
  `paintermeetingcount` text,
  `zonal_officer_atp_dates` text,
  `rm_am_atp_dates` text,
  `agent_atp_dates` text,
  `bank_details` longtext,
  `important_contact` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_settings`
--

INSERT INTO `sam_settings` (`id`, `state_id`, `sitename`, `sitelogo`, `gst_no`, `pan_no`, `email`, `mobile`, `address`, `pdf_back_image`, `language`, `currency_code`, `country`, `country_code`, `date_format`, `rows_per_page`, `sys_email`, `theme`, `order_description`, `timezone`, `expense_lock_days`, `attendance_lock_days`, `ho_notifications`, `smtp_status`, `smtp_encryption`, `smtp_username`, `smtp_password`, `smtp_name`, `smtp_host`, `offer_signature`, `offer_signature_text`, `amount_per_km_for_car`, `amount_per_km_for_bike`, `smtp_port`, `paintertrainingcount`, `dealertrainingcount`, `paintermeetingcount`, `zonal_officer_atp_dates`, `rm_am_atp_dates`, `agent_atp_dates`, `bank_details`, `important_contact`) VALUES
(1, 10, 'Automation Arena', 'logo_2412_modified-removebg-preview.png', '23AOMPJ0691N1ZL', 'AOMPJ0691N', 'info@automationarena.in', '6264666133', '2269 Street Beside Prateek Mobile, Near Shitlamata Temple, W.Ghamapur Jabalpur (M.P), Pin- 482001', 'logo_2412.jpg', 'english', '₹', 'India', 'INR', 'YYYY-mm-dd', 20, 'nirav.2d@gmail.com', 'default', '<p>any</p>\r\n<p> </p>', 'Asia/Kolkata', NULL, NULL, '<p>1. Zydex Industries ( Gujarat )<br>    GST No :  24ABLPR6874K1ZW<br><br>2. Zydex Industries Pvt. Ltd. ( Gujarat )<br>    GST No : 24AAACZ3193J1Z4</p>', 'on', 'TLS', 'no_reply@maahiit.in', 'Maahi@100%', 'smtp', 'mail.maahiit.in', 'Zydex-logo-for-website-220x89.png', '<p>2269 - STREET BESIDE MAA TRAVELS SHITLAMAI GHAMAPUR , JABALPUR, Madhya Pradesh, India - 482001</p>', NULL, NULL, '587', '2', '2', '1', '16,17,18,19,20,21,22,23,24', '16,17,18,19,20,21,22,23,24', '16,17,18,19,20,21,22,23,24', '<h1 xss=removed><sup>Zydex Industries PVT. LTD.</sup></h1>\r\n<p xss=removed>Name of Bank                   : <strong>Bank of Baroda</strong></p>\r\n<p xss=removed>Bank Address                    : Gorwa, BIDC, Vadodara</p>\r\n<p xss=removed>Bank Account No             : <strong>01890200000388</strong></p>\r\n<p xss=removed>Account Type                    : Cash Credit</p>\r\n<p xss=removed>IFSC / SWIFT Code         : BARB0INDBAR    </p>\r\n<p xss=removed><strong>__________________________________________________________</strong></p>\r\n<p xss=removed> </p>\r\n<p xss=removed>Name of Bank                   : <strong>Citi Bank</strong></p>\r\n<p xss=removed>Bank Address                    : Vadodara</p>\r\n<p xss=removed>Bank Account No             : <strong>0711970029</strong></p>\r\n<p xss=removed>Account Type                    : Cash Credit</p>\r\n<p xss=removed>IFSC / SWIFT Code         : CITI0000008</p>', '<p>details here<span xss=removed>!!</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `sam_users`
--

CREATE TABLE `sam_users` (
  `id` int(20) NOT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT 'admin,user,depot,zonal_manager,state_head,middle_manager,exective,field_assistant,agronomist_manager,agronomist',
  `primary_manager` text,
  `reporting_manager` text,
  `role` text,
  `user_identity` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(500) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `password_txt` text,
  `phone` varchar(20) DEFAULT NULL,
  `emp_code` varchar(255) NOT NULL,
  `date_of_join` datetime NOT NULL,
  `image` text NOT NULL,
  `address` text NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `last_asscess_ip` varchar(30) NOT NULL,
  `current_asscess_ip` varchar(30) NOT NULL,
  `current_login` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `token_id` text NOT NULL,
  `imei` text NOT NULL,
  `device_name` text NOT NULL,
  `device_varifi` varchar(10) NOT NULL COMMENT 'varified,unvarified',
  `version` varchar(50) NOT NULL DEFAULT 'older',
  `inserted_time` datetime NOT NULL,
  `modified_time` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active' COMMENT 'active,inactive,deleted',
  `joining_date` text,
  `dob` text,
  `sign` text,
  `state_id` text,
  `city_id` text,
  `responsible_cost_centre` text,
  `login_end_date` date DEFAULT NULL,
  `quotation_email` text,
  `invoice_email` text,
  `user_image` text,
  `adhar_card_front` text,
  `adhar_card_end` text,
  `pancard_image` text,
  `is_deleted` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_users`
--

INSERT INTO `sam_users` (`id`, `type`, `primary_manager`, `reporting_manager`, `role`, `user_identity`, `name`, `email`, `mobile`, `password`, `password_txt`, `phone`, `emp_code`, `date_of_join`, `image`, `address`, `zipcode`, `ip_address`, `last_asscess_ip`, `current_asscess_ip`, `current_login`, `last_login`, `token_id`, `imei`, `device_name`, `device_varifi`, `version`, `inserted_time`, `modified_time`, `status`, `joining_date`, `dob`, `sign`, `state_id`, `city_id`, `responsible_cost_centre`, `login_end_date`, `quotation_email`, `invoice_email`, `user_image`, `adhar_card_front`, `adhar_card_end`, `pancard_image`, `is_deleted`, `created_by`, `modified_by`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, 'Praveen Jha', 'k@k.com', '9745231525', '8ce4b16b22b58894aa86c421e8759df3', 'k', NULL, '12337', '0000-00-00 00:00:00', '', '', '', '', '', '', '2021-01-12 10:28:01', '0000-00-00 00:00:00', '', '', '', 'verified', '', '2017-08-01 16:01:11', '2021-08-25 19:06:30', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 422),
(4, 'sales', '', '', NULL, NULL, 'Joy Doshi', 'joy@gmail.com', '9999999999', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, '001', '0000-00-00 00:00:00', '', 'Near Station road', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', 'older', '2021-12-15 12:09:32', '2024-11-22 19:29:45', 'active', '2021-12-01', '2021-12-01', NULL, '3', '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, 1, 1),
(10, 'account', '', '', NULL, NULL, 'Dineshbhai Patel', 'Dinesh@gmail.com', '9898989898', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, '00215', '0000-00-00 00:00:00', '', 'Near Address', '390009', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', 'older', '2022-02-08 23:32:23', '2024-11-22 19:29:28', 'active', '2022-02-08', '2022-02-01', '549hd1080.png', '3', '', NULL, NULL, '', '', '24570hd1080.png', '14763hd1080.png', '22536copy1.jpg', '7073copy1.jpg', 0, 1, 1),
(19, 'staff', '', '', NULL, NULL, 'Vraj Patel', 'pvraj205@gmail.com', '9696969696', '202cb962ac59075b964b07152d234b70', '123', NULL, 'TS033', '0000-00-00 00:00:00', '', 'C-16/93,Pomli faliya,wadi,Hathiya Khad Road, Vadodara - 390017 Gujarat', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', 'older', '2022-05-09 17:34:09', '2024-11-22 19:28:35', 'active', '2019-03-05', '1997-08-27', '801121250PATEL VRAJ.jpeg', '3', '11', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, 1, 1),
(20, 'service', '', '', NULL, NULL, 'Jigar Pandya', 'jigarpandya@gmail.com', '9797979797', '202cb962ac59075b964b07152d234b70', '123', NULL, 'TE006', '0000-00-00 00:00:00', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', 'older', '2022-05-09 18:14:23', '2024-11-22 19:29:15', 'active', '2017-08-01', '1983-04-08', NULL, '3', '11', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sam_users_old`
--

CREATE TABLE `sam_users_old` (
  `id` bigint(20) NOT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `emp_code` text,
  `state_id` text,
  `reporting_manager` text,
  `primary_manager` int(11) DEFAULT NULL,
  `working_segment` text,
  `role` int(2) DEFAULT NULL,
  `user_identity` text,
  `company_id` text,
  `joining_date` date DEFAULT NULL,
  `type` text,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone_no` text,
  `mobile` text,
  `initials` text,
  `login_name` varchar(100) DEFAULT NULL,
  `password` text,
  `password_txt` text,
  `password_expiry` datetime DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city_id` varchar(250) DEFAULT NULL,
  `zip_code` varchar(50) DEFAULT NULL,
  `products` text,
  `sign` text,
  `use_dashboard` int(2) DEFAULT NULL,
  `is_contractor` int(2) DEFAULT NULL,
  `status` char(20) DEFAULT NULL,
  `report_key` text,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL,
  `token_id` text,
  `device_name` longtext,
  `version` text,
  `device_varifi` enum('pending','verified') DEFAULT 'pending',
  `imei` longtext,
  `current_login` timestamp NULL DEFAULT NULL,
  `modified` datetime NOT NULL,
  `modified_by` bigint(20) NOT NULL,
  `yearly_cost` text,
  `requesting_cost_centre` text,
  `responsible_cost_centre` text,
  `employee_address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_users_old`
--

INSERT INTO `sam_users_old` (`id`, `branch_id`, `emp_code`, `state_id`, `reporting_manager`, `primary_manager`, `working_segment`, `role`, `user_identity`, `company_id`, `joining_date`, `type`, `first_name`, `last_name`, `code`, `email_id`, `dob`, `phone_no`, `mobile`, `initials`, `login_name`, `password`, `password_txt`, `password_expiry`, `street`, `city_id`, `zip_code`, `products`, `sign`, `use_dashboard`, `is_contractor`, `status`, `report_key`, `is_deleted`, `created`, `created_by`, `token_id`, `device_name`, `version`, `device_varifi`, `imei`, `current_login`, `modified`, `modified_by`, `yearly_cost`, `requesting_cost_centre`, `responsible_cost_centre`, `employee_address`) VALUES
(1, NULL, 'EMP111', '1', NULL, NULL, NULL, 1, '1', NULL, NULL, 'admin', 'Keyur', 'Patel', '', 'k@k.com', '2010-09-06', '', '9974892875', '', 'pravin', '8ce4b16b22b58894aa86c421e8759df3', NULL, '0000-00-00 00:00:00', '', '9', '', '', '', 1, 0, 'active', '', 0, '2017-09-19 13:24:15', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-11 15:02:58', 1, NULL, '123', '321', ''),
(48, NULL, 'EMP001', '1,2,7,9', '58', 0, 'Bitumen', 3, '3', '5', '2020-05-01', 'user', 'Divyang', 'Sodha', NULL, 'd@d.com', '1990-01-22', NULL, '6655447788', NULL, NULL, '8277e0910d750195b448797616e091ad', 'd', NULL, NULL, '9', NULL, NULL, 'image.png', 1, NULL, 'active', NULL, 0, '2020-05-09 05:56:07', 1, NULL, NULL, NULL, 'verified', NULL, NULL, '2020-08-20 14:14:08', 1, '100', '11122', '222', 'Employee Address'),
(49, 1, 'STAFF001', NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, 'admin', 'Staff', 'User', NULL, 'staff@gmail.com', '1990-01-22', NULL, '8877445566', NULL, 'Staff', '202cb962ac59075b964b07152d234b70', '123', NULL, NULL, NULL, NULL, NULL, 'picture-5.png', 1, NULL, 'active', NULL, 0, '2020-05-09 08:36:51', 1, NULL, NULL, NULL, 'pending', NULL, NULL, '2020-05-09 14:06:51', 1, NULL, NULL, NULL, NULL),
(58, NULL, 'EMP002', '1,2,8', '59', NULL, 'Bitumen,Soil', 2, '3', '1', '2020-03-28', 'user', 'Nirav', 'Darji', NULL, 'n@n.com', '2020-03-04', NULL, '09898098980', NULL, NULL, '7b8b965ad4bca0e41ab51de7b31363a1', 'n', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'active', NULL, 0, '2020-05-09 21:45:11', 1, NULL, NULL, NULL, 'verified', NULL, NULL, '2020-05-11 16:31:34', 1, '1000', NULL, NULL, ''),
(59, NULL, '003', '1', NULL, NULL, 'Bitumen,Soil', 3, '3', '1', '2020-04-30', 'user', 'Krunal', 'patel', NULL, 'k@p.com', '2020-05-05', NULL, '9898098982', NULL, NULL, '8ce4b16b22b58894aa86c421e8759df3', 'k', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'active', NULL, 0, '2020-05-10 22:33:33', 1, NULL, NULL, NULL, 'pending', NULL, NULL, '2020-07-04 17:49:32', 1, '1000', NULL, NULL, 'A-100'),
(60, NULL, '001', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, 'admin', 'Admin', 'User', NULL, 'admin@gmail.com', '2000-01-10', NULL, '8855221144', NULL, 'nirav.2d@gmail.com', '202cb962ac59075b964b07152d234b70', '123', NULL, NULL, NULL, NULL, NULL, 'aaa.jpg', 1, NULL, 'active', NULL, 0, '2020-06-07 14:09:16', 1, NULL, NULL, NULL, 'pending', NULL, NULL, '2020-06-07 19:39:16', 1, NULL, NULL, NULL, NULL),
(61, NULL, 'M0001', '1', '48,58', NULL, 'Bitumen', 3, '3', '1', '2020-06-25', 'user', 'Mayur', 'Trivedi', NULL, 'm@m.com', '0000-00-00', NULL, '1122334455', NULL, '', '6f8f57715090da2632453988d9a1501b', 'm', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'active', NULL, 0, '2020-06-25 06:08:12', 1, NULL, NULL, NULL, 'pending', NULL, NULL, '2020-06-25 11:40:41', 1, '15000', NULL, NULL, 'Address'),
(62, NULL, 'EMP007', '1', NULL, 58, 'Bitumen', 11, '3', '1', '2014-07-07', 'user', 'Suresh', 'Parmar', NULL, 'nirav.2d@gmail.com', '1990-01-22', NULL, '9897969594', NULL, '', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, NULL, '9', NULL, NULL, NULL, 1, NULL, 'active', NULL, 0, '2020-07-07 13:29:39', 1, NULL, NULL, NULL, 'verified', NULL, NULL, '2020-07-07 20:01:38', 1, '12000', NULL, NULL, 'Near Station'),
(63, NULL, '1298', '13', '58,59,61', 48, 'Bitumen,Soil', 3, '3', '', '0000-00-00', 'user', 'Vishal', 'Kasliwal', NULL, 'v@v.com', '0000-00-00', NULL, '', NULL, '', '8b64d2451b7a8f3fd17390f88ea35917', 'vishal', NULL, NULL, '15', NULL, NULL, NULL, 1, NULL, 'active', NULL, 0, '2020-08-11 09:02:42', 1, NULL, NULL, NULL, 'verified', NULL, NULL, '2020-08-11 14:33:44', 1, '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `sam_vandor_contact`
--

CREATE TABLE `sam_vandor_contact` (
  `id` int(11) NOT NULL,
  `customer_id` text,
  `contact_persons` text,
  `designations_id` text,
  `mobile` text,
  `email` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sam_vandor_contact`
--

INSERT INTO `sam_vandor_contact` (`id`, `customer_id`, `contact_persons`, `designations_id`, `mobile`, `email`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '34', 'a', NULL, '08855669944', 'mayur@gmail.com', 0, 'active', NULL, NULL, NULL),
(2, '34', 'a', NULL, '09596989793', 'activated010101@yopmail.com', 1, 'active', NULL, NULL, NULL),
(3, '33', 'manubhai patel', NULL, '9955223366', 'manubhai@gmail.com', 0, 'active', NULL, NULL, NULL),
(4, '56', 'Bhargav Patel', NULL, '8140725581', 'sales@niftysolutions.co.in', 0, 'active', NULL, NULL, NULL),
(5, '60', 'Pratik Akabari', NULL, '7567530965', 'irfocusvadodara@gmail.com', 0, 'active', NULL, NULL, NULL),
(6, '61', 'Ashish Shah', NULL, '9925002826', 'sale1.mehtabrothers@gmail.com', 0, 'active', NULL, NULL, NULL),
(7, '62', 'Chintan Vyas', NULL, '7600338983', 'chintan.vyas@envoque.in', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_installment`
--

CREATE TABLE `tbl_bank_installment` (
  `id` int(11) NOT NULL,
  `invoice_id` text,
  `installment_no` text,
  `transaction_type` text,
  `transaction_no` text,
  `transaction_date` text,
  `amount` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bank_installment`
--

INSERT INTO `tbl_bank_installment` (`id`, `invoice_id`, `installment_no`, `transaction_type`, `transaction_no`, `transaction_date`, `amount`, `is_deleted`, `inserted_time`, `updated_time`, `created_by`) VALUES
(1, '1', '1', 'Cash', 'ASDASDADAD', '01-12-2021', '2550', 0, NULL, '2021-12-11 11:33:48', 422),
(2, '1', '2', 'Cash', 'ASDASDADAD', '02-11-2021', '2550', 0, NULL, '2021-12-11 11:36:20', 422);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE `tbl_documents` (
  `id` int(11) NOT NULL,
  `image` text,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_documents`
--

INSERT INTO `tbl_documents` (`id`, `image`, `inserted_time`, `updated_time`, `status`, `is_deleted`) VALUES
(1, '12481918builderon-img17.jpg', NULL, NULL, 'active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `invoice_id` text,
  `transaction_type` text,
  `transaction_no` text,
  `transaction_date` text,
  `amount` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `invoice_id`, `transaction_type`, `transaction_no`, `transaction_date`, `amount`, `is_deleted`, `inserted_time`, `updated_time`, `created_by`) VALUES
(1, '1', 'Cash', 'ASDASDA', '15-12-2021', '15000', 0, NULL, '2021-12-15 11:39:33', 1),
(2, '1', 'UPI', 'ASDASD', '15-12-2021', '5000', 0, NULL, '2021-12-15 11:40:08', 1),
(3, '2', 'Cash', 'case', '04-05-2022', '250000', 0, NULL, '2022-05-03 09:33:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_challan`
--

CREATE TABLE `tbl_quotation_challan` (
  `id` int(11) NOT NULL,
  `challan_no` varchar(255) DEFAULT NULL,
  `quotation_no` varchar(255) DEFAULT NULL,
  `quotation_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `contact_no` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('pending','paid','created') DEFAULT 'pending',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `created_by_user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quotation_challan`
--

INSERT INTO `tbl_quotation_challan` (`id`, `challan_no`, `quotation_no`, `quotation_id`, `customer_id`, `contact_no`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `created_by_user_id`) VALUES
(1, '00001', '00003', '3', '14', NULL, 0, 'pending', '2022-04-01 17:05:26', NULL, '1'),
(2, '00002', '00004', '4', '39', NULL, 1, 'pending', '2022-04-01 17:05:46', NULL, '1'),
(3, '00003', '00001', '1', '2', NULL, 1, 'pending', '2022-04-04 15:53:52', NULL, '1'),
(4, '00004', '00004', '4', '39', NULL, 0, 'pending', '2022-04-12 13:49:38', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salesorder`
--

CREATE TABLE `tbl_salesorder` (
  `id` int(11) NOT NULL,
  `quotation_no` varchar(255) DEFAULT NULL,
  `quotation_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('pending','paid','created') DEFAULT 'pending',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `created_by_user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_salesorder`
--

INSERT INTO `tbl_salesorder` (`id`, `quotation_no`, `quotation_id`, `customer_id`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `created_by_user_id`) VALUES
(1, '0002', '2', '13', 0, 'pending', '2022-03-19 09:31:34', NULL, '1'),
(2, '0001', '1', '36', 0, 'pending', '2022-03-19 09:31:53', NULL, '1'),
(3, '00006', '6', '36', 0, 'pending', '2022-04-14 17:43:30', NULL, '1'),
(4, '00005', '5', '47', 0, 'pending', '2022-04-14 17:43:40', NULL, '1'),
(5, '00007', '7', '55', 0, 'pending', '2022-04-28 17:59:24', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_update_fields`
--

CREATE TABLE `tbl_update_fields` (
  `id` int(11) NOT NULL,
  `type` text,
  `main_title` text,
  `main_title_2` text,
  `sub_title` text,
  `sub_title_2` text,
  `image_1` text,
  `image_2` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_update_fields`
--

INSERT INTO `tbl_update_fields` (`id`, `type`, `main_title`, `main_title_2`, `sub_title`, `sub_title_2`, `image_1`, `image_2`, `status`, `inserted_time`, `updated_time`, `is_deleted`) VALUES
(1, 'home', 'Best third party inspection provider  in industry', 'Certificate quality inspection provider in india', 'Seamless Automation Solutions Designed to Simplify, Optimize, and Empower Your Business Processes.', 'Turning Your Vision Into Reality with Innovative Designs, Superior Craftsmanship, and Unmatched Quality.', '1710901667WhatsApp Image 2024-11-20 at 16.35.18.jpeg', '1443309983WhatsApp Image 2024-11-20 at 16.35.15 (1).jpeg', 'active', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tech_amc`
--

CREATE TABLE `tech_amc` (
  `id` int(11) NOT NULL,
  `assign_user` text,
  `residence` text,
  `assing_engineering` text,
  `customer_id` text,
  `service_ids` text,
  `device_ids` text,
  `type` text,
  `type_qty` text,
  `price` text,
  `start_time` time DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `gst_amount` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_amc`
--

INSERT INTO `tech_amc` (`id`, `assign_user`, `residence`, `assing_engineering`, `customer_id`, `service_ids`, `device_ids`, `type`, `type_qty`, `price`, `start_time`, `start_date`, `end_date`, `sub_total`, `gst_amount`, `grand_total`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, NULL, 'Residence', '2,4', '36', '[{\"service_id\":\"2\",\"hsn_code\":\"\",\"qty\":\"10\",\"amount\":\"1250\",\"gst\":\"18\",\"gst_amount\":\"2250\",\"total_amt\":\"14750\"}]', '[{\"devices_id\":\"3\",\"devices_type_id\":\"1\",\"devices_code\":\"DEVICE002\",\"devices_assign_to\":\"Assign User\",\"devices_note\":\"<p>Device Note<\\/p>\"}]', 'yearly', NULL, '15500', '10:00:00', '2022-01-01', '2022-12-31', '22500', '2250', '14750', 0, 'active', '2022-02-08 11:55:28', '2022-06-20 16:17:12', '1'),
(2, NULL, '', '2', '35', '[{\"service_id\":\"2\",\"hsn_code\":\"234234\",\"qty\":\"1\",\"amount\":\"1250\",\"gst\":\"18\",\"gst_amount\":\"225\",\"total_amt\":\"1475\"}]', '[{\"devices_id\":\"3\",\"devices_type_id\":\"3\",\"devices_code\":\"028436\",\"devices_assign_to\":\"\",\"devices_note\":\"\"}]', 'half_yearly', NULL, '100', '00:00:00', '0000-00-00', '0000-00-00', '225', '225', '1475', 0, 'inactive', '2022-06-20 16:01:40', '2022-06-20 16:17:01', '1'),
(3, NULL, 'Vadodara', '4', '72', '[{\"service_id\":\"3\",\"hsn_code\":\"\",\"qty\":\"5\",\"amount\":\"350\",\"gst\":\"18\",\"gst_amount\":\"315\",\"total_amt\":\"2065\"}]', '[{\"devices_id\":\"3\",\"devices_type_id\":\"2\",\"devices_code\":\"DEVICE002\",\"devices_assign_to\":\"Pritesh\",\"devices_note\":\"\"}]', 'monthly', NULL, '1250', '00:00:00', '2022-06-01', '2022-07-31', '1575', '315', '2065', 0, 'active', '2022-06-20 16:17:42', '2022-06-20 16:17:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_amc_device`
--

CREATE TABLE `tech_amc_device` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_amc_device`
--

INSERT INTO `tech_amc_device` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Laptop', 'laptop', 0, 'active', '2021-09-11 07:28:29', '2022-05-25 16:19:18', '1'),
(2, 'Desktop', 'desktop', 0, 'active', '2021-09-11 07:29:16', '2022-05-25 16:19:08', '1'),
(3, 'Printer', 'printer', 0, 'active', '2022-05-25 16:19:25', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_amc_device_type`
--

CREATE TABLE `tech_amc_device_type` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_amc_device_type`
--

INSERT INTO `tech_amc_device_type` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'System Update', 'system-update', 0, 'active', '2021-09-11 07:28:29', '2021-12-24 11:48:33', '1'),
(2, 'laptop camera', 'laptop-camera', 0, 'active', '2021-09-11 07:29:16', '2021-12-24 11:47:38', '1'),
(3, 'antivirus Add', 'antivirus-add', 0, 'active', '2021-12-24 11:51:29', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_challan`
--

CREATE TABLE `tech_challan` (
  `quotation_no` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `inquiry_id` int(11) DEFAULT NULL,
  `po_no` text,
  `invoice_no` text,
  `challan_no` varchar(255) DEFAULT NULL,
  `vendor_ids` varchar(255) DEFAULT NULL,
  `quotation_subject` longtext,
  `assign_user_id` text,
  `quotation_date` date DEFAULT NULL,
  `inquiry_source_id` text,
  `customer_id` text,
  `customer_contact_id` text,
  `contact_designation_id` text,
  `contact_email` text,
  `contact_mobile` text,
  `b_address_name` int(11) DEFAULT NULL,
  `b_address` text,
  `b_state` text,
  `b_city` text,
  `b_zip_code` text,
  `s_address_name` varchar(11) DEFAULT NULL,
  `s_address` text,
  `s_state` text,
  `s_city` text,
  `s_zip_code` text,
  `remark` text,
  `followup_remark` longtext,
  `term_condition_id` text,
  `total_amount` double DEFAULT NULL,
  `total_margin` double DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `temporary_status` varchar(255) DEFAULT NULL,
  `status` enum('invoice_pending','invoice_done','temporary') DEFAULT 'invoice_pending',
  `valid_till` date DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `create_by_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_challan`
--

INSERT INTO `tech_challan` (`quotation_no`, `id`, `inquiry_id`, `po_no`, `invoice_no`, `challan_no`, `vendor_ids`, `quotation_subject`, `assign_user_id`, `quotation_date`, `inquiry_source_id`, `customer_id`, `customer_contact_id`, `contact_designation_id`, `contact_email`, `contact_mobile`, `b_address_name`, `b_address`, `b_state`, `b_city`, `b_zip_code`, `s_address_name`, `s_address`, `s_state`, `s_city`, `s_zip_code`, `remark`, `followup_remark`, `term_condition_id`, `total_amount`, `total_margin`, `is_deleted`, `temporary_status`, `status`, `valid_till`, `reference`, `inserted_time`, `updated_time`, `create_by_id`) VALUES
('00005', 1, NULL, NULL, '2022-04-13', '00001', NULL, 'The standard Lorem Ipsum passage, used since the 1500s', '5', '2022-04-13', '1', '50', '20', '3', 'piyush@gmail.com', '5566998844', 20, 'A-15 Shiv Complete', '2', '2', '596856', '20', 'A-15 Shiv Complete', '2', '2', '596856', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', NULL, NULL, 274000, 6132, 1, 'given', 'temporary', '2022-04-13', 'Reference ', '2022-04-13 07:26:26', NULL, '1'),
('', 4, NULL, NULL, '0001', '00002', NULL, 'Challan subject', '5', '2022-04-13', '1', '13', '7', '2', 'developer@gmail.com', '0265223366', 7, 'Reva party plot,Tarsali bypass', '3', '', '396523', '7', 'Reva party plot,Tarsali bypass', '3', '9', '563256', '<p>Proin at dolor orci. In id tellus et elit lobortis rutrum. Sed ultricies, massa ac convallis pharetra, mi augue lacinia dolor, in ultrices tellus ante et quam. Duis auctor consectetur felis, eget varius sapien porttitor et. Donec accumsan nibh quis lorem hendrerit feugiat. Aliquam non euismod neque, sed iaculis mauris. Maecenas et urna eu justo elementum euismod.</p>', NULL, NULL, NULL, 0, 0, 'given', 'invoice_done', NULL, NULL, '2022-04-13 08:15:04', '2022-04-13 16:11:02', '1'),
('', 5, NULL, NULL, '', '00005', NULL, 'aa', '4', '2022-04-13', '1', '14', '8', '7', 'dineshkumar.kyada@rehau.com', '9607835496', 8, 'Survey No.785, Nexus Industrial Park – Phase: 2, Post: Kotambi,  Before Jarod, Opp. GE [Formerly Alstom Ltd], Vadodara-Halol Highway Road, ', '3', '', '391510', '8', 'Survey No.785, Nexus Industrial Park – Phase: 2, Post: Kotambi,  Before Jarod, Opp. GE [Formerly Alstom Ltd], Vadodara-Halol Highway Road, ', '3', '', '391510', '<p>Remark</p>', NULL, NULL, 0, 0, 0, 'given', 'temporary', '2022-04-13', 'a', '2022-04-13 16:13:09', '2022-04-13 16:13:24', '1'),
('00004', 6, NULL, '00006', '00003', '00006', NULL, 'DLink Switch', '6', '2022-04-08', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '<p>For Networking used</p>', NULL, NULL, 135671, 12500, 0, 'given', 'invoice_done', NULL, NULL, '2022-04-13 16:22:23', '2022-04-14 18:18:24', '1'),
('00009', 7, NULL, '33333', '11221', '00007', NULL, 'Quotation For DELL SERVER', '5', '2022-05-07', '8', '57', '24', '20', 'ajay.thatte@setcoauto.com', '6357422454', 23, 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '23', 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '', NULL, NULL, 0, 0, 0, '', 'invoice_done', NULL, NULL, '2022-05-07 12:00:55', '2022-05-07 12:02:34', '1'),
('00010', 8, NULL, '25250', '', '00008', NULL, 'Quotation for DELL Server and Laptop', '5', '2022-05-09', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '<p>NEW ITEM REQUIRED FOR MATRIX BARODA</p>', NULL, NULL, 3481000, 57000, 0, 'given', 'temporary', NULL, NULL, '2022-05-09 18:58:16', '2022-05-09 19:00:46', '1'),
('00012', 9, NULL, '12152', '', '00009', NULL, 'DELL AIO', '6', '2022-06-20', '6', '73', '31', '3', 'info@integratedsolution.in', '799701203', 29, 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '29', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '<p>DELL AIO</p>', NULL, NULL, 87000, 0, 0, '', 'invoice_done', NULL, NULL, '2022-06-20 16:35:32', '2022-06-20 16:38:43', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_challan_item`
--

CREATE TABLE `tech_challan_item` (
  `id` int(11) NOT NULL,
  `inquiry_id` text,
  `vendor_ids` varchar(255) DEFAULT NULL,
  `challan_id` int(11) DEFAULT NULL,
  `item_type` text,
  `item_id` text,
  `item_qty` text,
  `purchase_item_price` double DEFAULT NULL,
  `margin_item_price` double DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_gst` double DEFAULT NULL,
  `item_description` longtext,
  `item_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_challan_item`
--

INSERT INTO `tech_challan_item` (`id`, `inquiry_id`, `vendor_ids`, `challan_id`, `item_type`, `item_id`, `item_qty`, `purchase_item_price`, `margin_item_price`, `item_price`, `item_gst`, `item_description`, `item_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, NULL, NULL, 1, 'product', '4', '2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(2, NULL, NULL, 1, 'product', '6', '2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(3, NULL, NULL, 4, 'product', '4', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(4, NULL, NULL, 4, 'product', '5', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(5, NULL, NULL, 4, 'product', '6', '6', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(6, NULL, NULL, 5, 'product', '6', '2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(7, NULL, NULL, 5, 'product', '6', '3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(8, NULL, NULL, 6, 'product', '7', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(9, NULL, NULL, 6, 'product', '3', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(10, NULL, NULL, 6, 'product', '5', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(11, NULL, NULL, 7, 'product', '11', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(12, NULL, NULL, 8, 'product', '11', '2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(13, NULL, NULL, 8, 'product', '4', '5', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(14, NULL, NULL, 9, 'product', '12', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_component`
--

CREATE TABLE `tech_component` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_component`
--

INSERT INTO `tech_component` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'HDD', 'hdd', 1, 'active', '2022-02-14 07:43:48', NULL, '1'),
(2, 'RAM', 'ram', 1, 'active', '2022-02-14 07:43:58', NULL, '1'),
(3, 'SSD', 'ssd', 1, 'active', '2022-02-14 07:59:06', NULL, '1'),
(4, 'PRINTER', 'printer', 1, 'active', '2022-02-14 07:59:55', NULL, '1'),
(5, 'Wi-Fi Dongle', 'wi-fi-dongle', 0, 'active', '2022-02-14 08:00:40', NULL, '1'),
(6, 'asdas', 'asdas', 0, 'active', '2022-02-14 08:09:42', NULL, '1'),
(7, 'AASS', 'aass', 0, 'active', '2022-02-14 08:10:02', NULL, '1'),
(8, 'AAASSSS', 'aaassss', 0, 'active', '2022-02-14 08:10:58', NULL, '1'),
(9, 'ABCd', 'abcd', 0, 'active', '2022-03-05 12:53:48', NULL, '1'),
(10, 'XXXXXX', 'xxxxxx', 0, 'active', '2022-03-05 12:53:59', NULL, '1'),
(11, 'SSD', 'ssd', 0, 'active', '2022-05-07 11:16:14', NULL, '1'),
(12, 'RAM', 'ram', 0, 'active', '2022-05-07 11:16:31', NULL, '1'),
(13, 'HDD', 'hdd', 0, 'active', '2022-05-07 11:16:46', NULL, '1'),
(14, 'PRINTER', 'printer', 0, 'active', '2022-05-07 11:17:16', NULL, '1'),
(15, 'POWER CORD', 'power-cord', 0, 'active', '2022-05-07 11:18:10', NULL, '1'),
(16, 'MOUSE', 'mouse', 0, 'active', '2022-05-07 11:18:31', NULL, '1'),
(17, 'MOTHERBOARD', 'motherboard', 0, 'active', '2022-05-07 11:19:20', NULL, '1'),
(18, 'anjali', 'anjali', 0, 'active', '2022-06-20 15:49:54', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_customer_category`
--

CREATE TABLE `tech_customer_category` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_customer_category`
--

INSERT INTO `tech_customer_category` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Indivisual', 'indivisual', 0, 'active', '2021-09-04 09:58:19', '2021-12-24 09:25:48', '1'),
(2, 'Walk In', 'walk-in', 0, 'active', '2021-09-04 09:58:25', '2021-12-24 09:25:39', '1'),
(3, 'Comapny', 'comapny', 0, 'active', '2021-12-24 09:26:02', NULL, '1'),
(4, 'Facility Management Contract ( FMC )', 'facility-management-contract-fmc', 0, 'active', '2021-12-24 09:26:07', '2022-03-12 14:29:03', '1'),
(5, 'Annual Maintenance Contract ( AMC )', 'annual-maintenance-contract-amc', 0, 'active', '2022-03-12 14:28:14', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_expense`
--

CREATE TABLE `tech_expense` (
  `id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `payment_mode_id` text,
  `expanse_category_id` text,
  `amount` text,
  `expance_date` date DEFAULT NULL,
  `reference_no` text,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `remark` text,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_expense`
--

INSERT INTO `tech_expense` (`id`, `is_deleted`, `payment_mode_id`, `expanse_category_id`, `amount`, `expance_date`, `reference_no`, `status`, `remark`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 0, '1', '1', '1', '2021-09-10', 'as', 'pending', 'asdas', '2021-09-11 12:10:28', '2021-09-11 12:15:26', '1'),
(2, 0, '1', '2', '1250', '2021-09-14', 'asda', 'paid', 'asdas', '2021-09-11 12:17:59', '2021-09-11 12:19:33', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_expense_category`
--

CREATE TABLE `tech_expense_category` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_expense_category`
--

INSERT INTO `tech_expense_category` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Road Expenses', 'road-expenses', 0, 'active', '2021-09-11 07:44:51', '2021-09-11 07:44:56', '1'),
(2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n<li></li>\r\n</ul>', 'ul-li-p-strong-payment-nbsp-nbsp-nbsp-nbsp-strong-strong-nbsp-100-nbsp-advance-with-purchase-order-strong-p-li-li-p-strong-gst-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-strong-nbsp-18-nbsp-extra-p-li-li-p-strong-warranty-nbsp-nbsp-strong-nbsp-mention-or-1-year-nbsp-warranty-from-oem-p-li-li-p-strong-delivery-nbsp-nbsp-nbsp-strong-nbsp-1-nbsp-to-2-nbsp-working-weeks-nbsp-strong-limited-stock-so-please-confirm-with-us-stock-availability-and-price-before-order-strong-p-li-li-p-strong-validity-nbsp-nbsp-nbsp-strong-nbsp-price-valid-till-7-nbsp-nbsp-days-from-date-of-quote-or-till-stocks-last-whichever-is-earlier-p-li-li-p-strong-nbsp-order-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-strong-nbsp-nbsp-order-once-given-will-not-be-cancel-and-material-once-billed-will-not-be-taken-back-p-li-li-p-collect-material-by-yourself-from-our-office-between-11-am-to-5-pm-p-li-li-li-ul', 1, 'active', '2021-09-11 07:45:06', '2021-12-08 11:04:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_industry_type`
--

CREATE TABLE `tech_industry_type` (
  `id` int(11) NOT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_industry_type`
--

INSERT INTO `tech_industry_type` (`id`, `designation_id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, NULL, 'Banking', 'banking', 0, 'active', '2022-04-14 17:44:00', NULL, '1'),
(2, NULL, 'Industry ', 'industry', 0, 'active', '2022-04-14 17:44:12', '2022-04-14 17:44:45', '1'),
(3, NULL, 'aaaa', 'aaaa', 1, 'active', '2022-04-14 17:46:03', NULL, '1'),
(4, NULL, 'Chemical industries', 'chemical-industries', 0, 'active', '2022-05-09 16:53:01', NULL, '1'),
(5, NULL, 'Education', 'education', 0, 'active', '2022-05-09 16:53:09', NULL, '1'),
(6, NULL, 'Agriculture', 'agriculture', 0, 'active', '2022-05-09 16:53:39', NULL, '1'),
(7, NULL, 'Auto Components', 'auto-components', 0, 'active', '2022-05-09 16:53:55', NULL, '1'),
(8, NULL, 'Education & Training Industry', 'education-training-industry', 0, 'active', '2022-05-09 16:54:28', NULL, '1'),
(9, NULL, 'Manufacturing', 'manufacturing', 0, 'active', '2022-05-09 16:54:59', NULL, '1'),
(10, NULL, 'Telecom ', 'telecom', 0, 'active', '2022-05-09 16:55:16', NULL, '1'),
(11, NULL, 'Engineering Industry', 'engineering-industry', 0, 'active', '2022-05-09 16:55:45', NULL, '1'),
(12, NULL, 'Financial Services', 'financial-services', 0, 'active', '2022-05-09 16:55:56', NULL, '1'),
(13, NULL, 'Healthcare Industry', 'healthcare-industry', 0, 'active', '2022-05-09 16:56:08', NULL, '1'),
(14, NULL, 'Infrastructure Sector', 'infrastructure-sector', 0, 'active', '2022-05-09 16:56:19', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_inquiry`
--

CREATE TABLE `tech_inquiry` (
  `id` int(11) NOT NULL,
  `inquiry_subject` text,
  `inquiry_no` varchar(50) DEFAULT NULL,
  `assign_user_id` text,
  `inquery_date` date DEFAULT NULL,
  `inquiry_source_id` text,
  `customer_id` text,
  `customer_contact_id` text,
  `contact_designation_id` text,
  `contact_email` text,
  `contact_mobile` text,
  `b_address_name` int(11) DEFAULT NULL,
  `b_address` text,
  `b_state` text,
  `b_city` text,
  `b_zip_code` text,
  `s_address_name` varchar(11) DEFAULT NULL,
  `s_address` text,
  `s_state` text,
  `s_city` text,
  `s_zip_code` text,
  `term_condition_id` longtext,
  `remark` text,
  `followup_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('new','open','closed') DEFAULT 'new',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `create_by_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_inquiry`
--

INSERT INTO `tech_inquiry` (`id`, `inquiry_subject`, `inquiry_no`, `assign_user_id`, `inquery_date`, `inquiry_source_id`, `customer_id`, `customer_contact_id`, `contact_designation_id`, `contact_email`, `contact_mobile`, `b_address_name`, `b_address`, `b_state`, `b_city`, `b_zip_code`, `s_address_name`, `s_address`, `s_state`, `s_city`, `s_zip_code`, `term_condition_id`, `remark`, `followup_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `create_by_id`) VALUES
(1, 'Super market Product Inquire', '00001', '12', '2022-04-01', '1', '2', '5', '3', 'maulik@gmail.com', '8855447799', 4, 'Near Station road', '3', '', '393939', '5', 'Near Station road', '2', '2', '789987', NULL, '<p>Super market Product Inquire</p>', NULL, 0, 'open', '2022-04-04 15:29:50', '2022-04-04 15:31:07', '1'),
(2, 'Desktop inquiry for Rehau', '00002', '2', '2022-04-25', '6', '39', '15', '14', 'amit.thakor@matrixcomsec.com', '7043200786', 15, '394?GIDC, Makarpura, ', '3', '11', '390010', '15', '394?GIDC, Makarpura, ', '3', '11', '390010', NULL, '<p>ASTUK;\'</p>\r\n<p>&nbsp;</p>', NULL, 0, 'new', '2022-04-05 17:06:43', '2022-04-08 15:39:01', '1'),
(3, '50 inch & Switch  Requirement ', '00003', '5', '2022-04-13', '7', '47', '18', '20', 'Consult@greenelectricals.com', '8511106524', 17, '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '17', '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', NULL, '<p>Panasonic make LED<br />and switch make dlink&nbsp;</p>', NULL, 0, 'new', '2022-04-13 16:56:26', NULL, '1'),
(4, '', '00004', '5', '0000-00-00', '5', '47', '18', '20', 'Consult@greenelectricals.com', '8511106524', 17, '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '17', '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', NULL, '', NULL, 0, 'new', '2022-04-26 11:39:33', NULL, '1'),
(5, 'for laptop/ desktop & server', '00005', '5', '2022-04-25', '11', '52', '22', '3', 'optima4u@rediffmail.com', '9227472303', 21, '303 silverline complex opp. BBC tower sayajigunj', '3', '11', '390005', '21', '303 silverline complex opp. BBC tower sayajigunj', '3', '11', '390005', NULL, '', NULL, 0, 'new', '2022-04-26 12:50:57', NULL, '1'),
(6, 'Quotation for DELL Server and Laptop', '00006', '5', '2022-05-09', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', NULL, '', NULL, 0, 'new', '2022-05-09 18:31:16', NULL, '1'),
(7, 'DELL AIO', '00007', '5', '2022-06-20', '6', '73', '31', '3', 'info@integratedsolution.in', '799701203', 29, 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '29', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', NULL, '<p>DELL AIO</p>', NULL, 0, 'new', '2022-06-20 16:16:14', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_inquiry_item`
--

CREATE TABLE `tech_inquiry_item` (
  `id` int(11) NOT NULL,
  `inquiry_id` text,
  `item_type` text,
  `item_id` text,
  `item_qty` double DEFAULT '1',
  `item_description` longtext,
  `item_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_inquiry_item`
--

INSERT INTO `tech_inquiry_item` (`id`, `inquiry_id`, `item_type`, `item_id`, `item_qty`, `item_description`, `item_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '1', 'product', '4', 10, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(2, '1', 'product', '5', 20, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 1, 'active', NULL, NULL, NULL),
(3, '2', 'product', '3', 1, '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', NULL, 0, 'active', NULL, NULL, NULL),
(4, '3', 'product', '9', 1, '<p>&nbsp;50 INCHES, 4K, SMART ANDROID&nbsp;<br />3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(5, '3', 'product', '8', 1, '<p><br />24 x 10/100/1000BASE-T ports<br />4 x Gigabit RJ45/SFP Combo ports</p>', NULL, 0, 'active', NULL, NULL, NULL),
(6, '4', 'product', '5', 0, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(7, '5', 'product', 'Select products', 0, '', NULL, 0, 'active', NULL, NULL, NULL),
(8, '6', 'product', '11', 1, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(9, '6', 'product', '4', 1, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(10, '7', 'product', 'Select products', 0, '', NULL, 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_inquiry_source`
--

CREATE TABLE `tech_inquiry_source` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_inquiry_source`
--

INSERT INTO `tech_inquiry_source` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Facebook', 'facebook', 0, 'active', '2021-09-04 10:07:46', '2021-09-04 10:08:06', '1'),
(2, 'News Paper', 'news-paper', 0, 'active', '2021-09-04 10:07:53', '2021-09-04 10:07:58', '1'),
(3, '1 Year Plan', '1-year-plan', 1, 'active', '2021-09-11 07:23:36', NULL, '1'),
(4, 'Social Media', 'social-media', 1, 'active', '2022-03-12 14:29:45', NULL, '1'),
(5, 'WhatsApp', 'whatsapp', 0, 'active', '2022-03-12 14:29:57', NULL, '1'),
(6, 'E-Mail', 'e-mail', 0, 'active', '2022-03-12 14:30:03', '2022-03-12 14:37:41', '1'),
(7, 'Calling', 'calling', 0, 'active', '2022-03-12 14:30:11', NULL, '1'),
(8, 'Reference', 'reference', 0, 'active', '2022-03-12 14:30:41', NULL, '1'),
(9, 'Social Leads', 'social-leads', 0, 'active', '2022-03-12 14:34:42', NULL, '1'),
(10, 'Store Incoming Call', 'store-incoming-call', 0, 'active', '2022-03-12 14:35:57', NULL, '1'),
(11, 'Internal Referral', 'internal-referral', 0, 'active', '2022-03-12 14:38:02', NULL, '1'),
(12, 'Daily Digital Marketing Lead', 'daily-digital-marketing-lead', 0, 'active', '2022-03-12 14:39:03', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_inquiry_term_condition`
--

CREATE TABLE `tech_inquiry_term_condition` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tech_invoice`
--

CREATE TABLE `tech_invoice` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `assign_user_id` text,
  `invoice_date` date DEFAULT NULL,
  `inquiry_source_id` text,
  `customer_id` text,
  `customer_contact_id` text,
  `contact_designation_id` text,
  `contact_email` text,
  `contact_mobile` text,
  `b_address_name` int(11) DEFAULT NULL,
  `b_address` text,
  `b_state` text,
  `b_city` text,
  `b_zip_code` text,
  `s_address_name` varchar(11) DEFAULT NULL,
  `s_address` text,
  `s_state` text,
  `s_city` text,
  `s_zip_code` text,
  `remark` text,
  `followup_remark` longtext,
  `term_condition_id` text,
  `total_amount` double DEFAULT NULL,
  `total_margin` double DEFAULT NULL,
  `received_payment` double DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('new','open','closed') DEFAULT 'new',
  `support_dept` text,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `create_by_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_invoice`
--

INSERT INTO `tech_invoice` (`id`, `invoice_no`, `quotation_id`, `assign_user_id`, `invoice_date`, `inquiry_source_id`, `customer_id`, `customer_contact_id`, `contact_designation_id`, `contact_email`, `contact_mobile`, `b_address_name`, `b_address`, `b_state`, `b_city`, `b_zip_code`, `s_address_name`, `s_address`, `s_state`, `s_city`, `s_zip_code`, `remark`, `followup_remark`, `term_condition_id`, `total_amount`, `total_margin`, `received_payment`, `is_deleted`, `status`, `support_dept`, `inserted_time`, `updated_time`, `create_by_id`) VALUES
(1, '00001', 5, '5', '2022-05-04', '7', '47', '18', '20', 'Consult@greenelectricals.com', '8511106524', 17, '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '17', '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '<p>asdasda</p>', NULL, ',', 51000, 0, 0, 0, 'new', NULL, '2022-04-14 17:57:08', '2022-05-04 13:36:30', '1'),
(2, '00002', NULL, '5', '2022-05-03', '1', '14', '8', '7', 'dineshkumar.kyada@rehau.com', '9607835496', 8, 'Survey No.785, Nexus Industrial Park – Phase: 2, Post: Kotambi,  Before Jarod, Opp. GE [Formerly Alstom Ltd], Vadodara-Halol Highway Road, ', '3', '', '391510', '8', 'Survey No.785, Nexus Industrial Park – Phase: 2, Post: Kotambi,  Before Jarod, Opp. GE [Formerly Alstom Ltd], Vadodara-Halol Highway Road, ', '3', '', '391510', '', NULL, '', 0, 0, 250000, 0, 'new', NULL, '2022-05-03 09:31:49', '2022-05-04 13:34:31', '1'),
(3, '00003', NULL, '4', '2022-05-11', '2', '36', '12', '4', 'monika@gmail.com', '0265332255', 11, 'JURONG WEST AVE', '3', '10', '390009', '10', 'JURONG WEST AVE', '3', '3', '393366', '<p>asdas</p>', NULL, '', 0, 0, 0, 0, 'new', NULL, '2022-05-04 13:37:46', '2022-05-04 13:38:04', '1'),
(4, '00004', 9, '5', '0000-00-00', '8', '57', '', '', '', '', 23, 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '23', 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', NULL, NULL, '2,', 1468000, NULL, 0, 0, 'new', NULL, '2022-05-07 11:53:31', NULL, '1'),
(5, '00005', 10, '5', '0000-00-00', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 1 IDC, Waghodia,', '3', '11', '391760', NULL, NULL, '10,2', 3481000, NULL, 0, 0, 'new', NULL, '2022-05-09 19:06:04', NULL, '1'),
(6, '00006', 12, '6', '2022-06-20', '6', '73', '31', '3', 'info@integratedsolution.in', '799701203', 29, 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '29', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '', NULL, '2,', 87000, 0, 0, 0, 'new', '[\"support department 1\",\"support department 2\"]', '2022-06-20 16:41:44', '2022-06-22 11:39:11', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_invoice_item`
--

CREATE TABLE `tech_invoice_item` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `item_gst` double DEFAULT NULL,
  `invoice_id` text,
  `item_type` text,
  `item_id` text,
  `item_qty` double DEFAULT '1',
  `item_price` double DEFAULT NULL,
  `purchase_item_price` double DEFAULT NULL,
  `margin_item_price` double DEFAULT NULL,
  `item_description` longtext,
  `item_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_invoice_item`
--

INSERT INTO `tech_invoice_item` (`id`, `vendor_id`, `item_gst`, `invoice_id`, `item_type`, `item_id`, `item_qty`, `item_price`, `purchase_item_price`, `margin_item_price`, `item_description`, `item_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, NULL, NULL, '1', 'product', '9', 1, 36500, 33500, 3000, '<p>&nbsp;50 INCHES, 4K, SMART ANDROID&nbsp;<br />3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(2, NULL, 18, '1', 'product', '8', 1, 14500, 13500, 1000, '<p><br />24 x 10/100/1000BASE-T ports<br />4 x Gigabit RJ45/SFP Combo ports</p>', NULL, 1, 'active', NULL, NULL, NULL),
(3, NULL, NULL, '2', 'product', '3', 5, 10500, 10000, 2500, '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', NULL, 0, 'active', NULL, NULL, NULL),
(4, NULL, NULL, '2', 'service', '3', 10, NULL, NULL, NULL, '', NULL, 0, 'active', NULL, NULL, NULL),
(5, NULL, NULL, '3', 'product', '3', 10, NULL, NULL, NULL, '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', NULL, 0, 'active', NULL, NULL, NULL),
(6, NULL, 18, '4', 'product', '11', 1, NULL, NULL, NULL, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(7, NULL, 18, '5', 'product', '11', 2, NULL, NULL, NULL, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(8, NULL, 18, '5', 'product', '4', 5, NULL, NULL, NULL, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(9, NULL, NULL, '6', 'product', '12', 1, NULL, NULL, NULL, '<p>Core i3-10105T 10th Generaiton</p>\r\n<p>8 GB RAM</p>\r\n<p>256 GB SSD</p>\r\n<p>Windows 10 Pro</p>\r\n<p>21.5\" inch FHD Display</p>\r\n<p>No ODD</p>\r\n<p>3 Year Warranty</p>\r\n<p>Basic Stand/Camera</p>\r\n<p>Intel&reg; 3165 802.11ac dual band 1x1 + Bluetooth 4.2</p>\r\n<p>Wireless Keyboard and mouse</p>\r\n<p>&nbsp;</p>', '', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_invoice_term_condition`
--

CREATE TABLE `tech_invoice_term_condition` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_invoice_term_condition`
--

INSERT INTO `tech_invoice_term_condition` (`id`, `invoice_id`, `term_id`, `item_description`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, 2, 7, '<ul>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong>100% &nbsp;Advance with Purchase Order&nbsp;Now</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Warranty / Subscription :</strong>&nbsp;1 Year Subscription</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>TAX (GST ) :</strong>&nbsp;Tax will be extra as Applicable</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">The prices are in INR and are Unit Basic Prices.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Price Validity :</strong> Valid till 7 Days from date of Quote or till stocks last , whichever is earlier&nbsp;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:&nbsp;</strong> 7&nbsp;to 10&nbsp;Working Days&nbsp;( limited stock so please confirm with us stock Availability and Price before order )</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Autodesk , Adobe , &nbsp;Microsoft, Symantec : Paper License delivery mode is E-License which shall be delivered to your email</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Installation Charges :</strong>&nbsp; Installation and Configuration charges Extra&nbsp;as Actual&nbsp;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">All Back to back&nbsp;license orders are&nbsp;non- cancellable&nbsp;unless approved by authorized MS personnel as per RMA policy with applicable cancellation charges.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">All&nbsp;GGS legalization&nbsp;License SKU orders are non- cancellable. GGS orders to be placed as separate order and the SKU once placed cannot be&nbsp;processed for Cancellation under the RMA policy.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">O365 Policy:&nbsp; Customer can order multiple O365 M SKUs on a single purchase order. No returns are allowed after any of the O365 M SKUs on a single purchase order are redeemed. Once the OSA Key is redeemed, no return will be accepted - even if the customer hasn\'t assigned all seats represented by that Dynamic SKU purchase. Pls. read these terms carefully and explain this policy to end customers before accepting O365 Mid-market orders.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Prices are subject to change depending on the changes in taxation structure prevailing in various states from time to time.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Please note that as per&nbsp;Microsoft Policy, Multi-Tier Orders need to be pre-approved by them.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">We need following declaration with every PO for Multitier confirmation and non-cancellable clause.</span></span><br /><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&ldquo;We confirm that this PO&nbsp;is directly placed on us by End Customer&ldquo;</span></span><br /><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&ldquo;We agree that&nbsp;License Order&nbsp; once placed is Non-cancellable.&rdquo;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">As per new Microsoft compliance policy, PO should have same Part Number, Description, Qty and Pricing details</span></span></p>\r\n</li>\r\n<li><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">You must have a&nbsp;<em>minimum</em>&nbsp;initial purchase of&nbsp;<em>five</em>&nbsp;software&nbsp;<em>licenses</em>&nbsp;for an Open&nbsp;<em>License</em>&nbsp;agreement</span></span></li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&nbsp;Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></span></p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_notification`
--

CREATE TABLE `tech_notification` (
  `id` int(11) NOT NULL,
  `item_id` text,
  `item_type` text,
  `notification_message` text,
  `created_id` int(11) DEFAULT NULL,
  `assign_user_id` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_notification`
--

INSERT INTO `tech_notification` (`id`, `item_id`, `item_type`, `notification_message`, `created_id`, `assign_user_id`, `is_deleted`, `status`, `inserted_time`, `updated_time`) VALUES
(2, '2', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '4', 0, 'active', '2021-12-16 11:07:27', NULL),
(3, '3', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '2', 0, 'active', '2021-12-16 11:09:06', NULL),
(4, '2', 'Tickets', 'Tickets update by Keyur Patel', 1, '2', 0, 'active', '2021-12-16 11:28:49', NULL),
(5, '2', 'Tickets', 'Tickets update by Keyur Patel', 1, '4', 0, 'active', '2021-12-16 11:28:49', NULL),
(6, '4', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:08:31', NULL),
(7, '3', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:10:06', NULL),
(8, '4', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:13:05', NULL),
(9, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:14:13', NULL),
(10, '2', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:15:12', NULL),
(11, '3', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:15:37', NULL),
(12, '4', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:21:50', NULL),
(13, '2', 'Invoice', 'New Invoice create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:52:05', NULL),
(14, '3', 'Invoice', 'New Invoice create by Keyur Patel', 1, '2', 0, 'active', '2021-12-17 06:53:49', NULL),
(15, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '2', 0, 'active', '2021-12-24 09:43:19', NULL),
(16, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '4', 0, 'active', '2021-12-24 09:43:19', NULL),
(17, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '2', 0, 'active', '2021-12-24 11:33:02', NULL),
(18, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '4', 0, 'active', '2021-12-24 11:33:02', NULL),
(19, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '2', 0, 'active', '2021-12-24 11:33:07', NULL),
(20, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '4', 0, 'active', '2021-12-24 11:33:07', NULL),
(21, '4', 'Invoice', 'New Invoice create by Keyur Patel', 1, '4', 0, 'active', '2021-12-31 11:36:14', NULL),
(22, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-01-03 06:34:52', NULL),
(23, '6', 'Quotation', 'New Quotation create by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:24:07', NULL),
(24, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:45:09', NULL),
(25, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:46:29', NULL),
(26, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:48:40', NULL),
(27, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:48:55', NULL),
(28, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:49:36', NULL),
(29, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:51:25', NULL),
(30, '5', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 08:53:45', NULL),
(31, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '2', 0, 'active', '2022-01-03 09:50:09', NULL),
(32, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 09:50:09', NULL),
(33, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '2', 0, 'active', '2022-01-03 16:05:28', NULL),
(34, '3', 'Tickets', 'Tickets update by Keyur Patel', 1, '4', 0, 'active', '2022-01-03 16:05:28', NULL),
(35, '7', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2022-02-03 13:43:04', NULL),
(36, '4', 'Tickets', 'New Tickets create by Keyur Patel', 1, '2', 0, 'active', '2022-02-04 16:35:29', NULL),
(37, '4', 'Tickets', 'New Tickets create by Keyur Patel', 1, '4', 0, 'active', '2022-02-04 16:35:29', NULL),
(38, '5', 'Invoice', 'New Invoice create by Keyur Patel', 1, '2', 0, 'active', '2022-02-04 16:53:47', NULL),
(39, '6', 'Invoice', 'New Invoice create by Keyur Patel', 1, '4', 0, 'active', '2022-02-04 16:54:23', NULL),
(40, '5', 'Tickets', 'New Tickets create by Keyur Patel', 1, '2', 0, 'active', '2022-02-05 18:18:04', NULL),
(41, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-02-07 11:25:18', NULL),
(42, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-02-08 08:29:27', NULL),
(43, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-02-08 08:31:47', NULL),
(44, '7', 'Invoice', 'New Invoice create by Keyur Patel', 1, '2', 0, 'active', '2022-02-08 09:29:33', NULL),
(45, '8', 'Invoice', 'New Invoice create by Keyur Patel', 1, '2', 0, 'active', '2022-02-08 10:12:04', NULL),
(46, '1', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:05:35', NULL),
(47, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:22:25', NULL),
(48, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:23:09', NULL),
(49, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:23:22', NULL),
(50, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:24:44', NULL),
(51, '9', 'Invoice', 'New Invoice create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:25:01', NULL),
(52, '1', 'Invoice', 'New Invoice create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:26:20', NULL),
(53, '1', 'Invoice', 'New Invoice create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:28:33', NULL),
(54, '1', 'Invoice', 'New Invoice create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 11:30:34', NULL),
(55, '6', 'Tickets', 'New Tickets create by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 13:09:40', NULL),
(56, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 13:18:43', NULL),
(57, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 13:25:27', NULL),
(58, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-08 13:25:47', NULL),
(59, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 08:33:37', NULL),
(60, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 08:37:21', NULL),
(61, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 08:37:50', NULL),
(62, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 08:38:21', NULL),
(63, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 08:43:59', NULL),
(64, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 11:01:43', NULL),
(65, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 11:05:12', NULL),
(66, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 11:05:25', NULL),
(67, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 11:06:39', NULL),
(68, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 11:06:46', NULL),
(69, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-10 11:13:46', NULL),
(70, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 07:14:57', NULL),
(71, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 07:16:29', NULL),
(72, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 07:26:14', NULL),
(73, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 07:26:20', NULL),
(74, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 07:32:07', NULL),
(75, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 08:07:03', NULL),
(76, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 08:07:38', NULL),
(77, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-02-14 08:11:04', NULL),
(78, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-02-17 09:51:24', NULL),
(79, '2', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-02-17 09:53:14', NULL),
(80, '2', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-02-17 09:54:33', NULL),
(81, '3', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-02-17 10:34:52', NULL),
(82, '1', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 09:34:42', NULL),
(83, '1', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 09:38:32', NULL),
(84, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 10:13:11', NULL),
(85, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 10:15:54', NULL),
(86, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 10:17:27', NULL),
(87, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 10:37:21', NULL),
(88, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 10:37:49', NULL),
(89, '1', 'Invoice', 'New Invoice create by Keyur Patel', 1, '5', 0, 'active', '2022-02-18 11:07:56', NULL),
(90, '2', 'Invoice', 'New Invoice create by Keyur Patel', 1, '4', 0, 'active', '2022-02-18 11:36:08', NULL),
(91, '1', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '5', 0, 'active', '2022-02-19 13:27:04', NULL),
(92, '6', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-03-05 12:54:14', NULL),
(93, '2', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-03-05 15:13:41', NULL),
(94, '2', 'Quotation', 'New Quotation create by Keyur Patel', 1, '10', 0, 'active', '2022-03-17 05:08:11', NULL),
(95, '2', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '10', 0, 'active', '2022-03-26 12:00:13', NULL),
(96, '1', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '10', 0, 'active', '2022-03-26 12:11:39', NULL),
(97, '7', 'Tickets', 'New Tickets create by Keyur Patel', 1, '2', 0, 'active', '2022-03-29 10:58:38', NULL),
(98, '3', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 10:05:05', NULL),
(99, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 10:05:48', NULL),
(100, '4', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 10:22:52', NULL),
(101, '2', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 10:28:36', NULL),
(102, '8', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-01 11:56:12', NULL),
(103, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 13:56:20', NULL),
(104, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 16:55:58', NULL),
(105, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 16:56:35', NULL),
(106, '10', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 17:17:06', NULL),
(107, '11', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-01 17:17:24', NULL),
(108, '9', 'Tickets', 'New Tickets create by Keyur Patel', 1, '6', 0, 'active', '2022-04-01 17:49:04', NULL),
(109, '9', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-04-01 17:53:40', NULL),
(110, '9', 'Tickets', 'Tickets update by Keyur Patel', 1, '6', 0, 'active', '2022-04-01 17:53:55', NULL),
(111, '1', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 15:29:50', NULL),
(112, '1', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 15:31:07', NULL),
(113, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 15:52:49', NULL),
(114, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 16:22:13', NULL),
(115, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 16:28:18', NULL),
(116, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 16:31:01', NULL),
(117, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 16:37:09', NULL),
(118, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 16:53:16', NULL),
(119, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 17:58:07', NULL),
(120, '1', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '12', 0, 'active', '2022-04-04 17:58:59', NULL),
(121, '10', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-04 18:09:29', NULL),
(122, '10', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-04 18:24:54', NULL),
(123, '10', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-04 18:25:03', NULL),
(124, '10', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-04 18:25:25', NULL),
(125, '10', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-04 18:49:27', NULL),
(126, '10', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-04 18:52:03', NULL),
(127, '2', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 15:48:34', NULL),
(128, '2', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 16:03:43', NULL),
(129, '2', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 16:40:35', NULL),
(130, '2', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 16:41:50', NULL),
(131, '3', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 16:53:47', NULL),
(132, '2', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '2', 0, 'active', '2022-04-05 17:06:43', NULL),
(133, '2', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '2', 0, 'active', '2022-04-05 17:12:41', NULL),
(134, '2', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '2', 0, 'active', '2022-04-05 17:12:50', NULL),
(135, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 17:23:24', NULL),
(136, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 17:23:54', NULL),
(137, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-05 17:25:53', NULL),
(138, '2', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '2', 0, 'active', '2022-04-08 15:37:05', NULL),
(139, '2', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '2', 0, 'active', '2022-04-08 15:37:14', NULL),
(140, '2', 'Inquiry', 'Inquiry update by Keyur Patel', 1, '2', 0, 'active', '2022-04-08 15:39:01', NULL),
(141, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-08 15:39:41', NULL),
(142, '4', 'Quotation', 'New Quotation create by Keyur Patel', 1, '6', 0, 'active', '2022-04-08 16:57:03', NULL),
(143, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-04-08 17:09:36', NULL),
(144, '3', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '6', 0, 'active', '2022-04-08 17:23:37', NULL),
(145, '4', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-12 13:24:13', NULL),
(146, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-13 16:09:23', NULL),
(147, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-13 16:10:20', NULL),
(148, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-13 16:11:02', NULL),
(149, '5', 'Quotation', 'New Challan create by Keyur Patel', 1, '4', 0, 'active', '2022-04-13 16:13:09', NULL),
(150, '5', 'Quotation', 'Quotation update by Keyur Patel', 1, '4', 0, 'active', '2022-04-13 16:13:24', NULL),
(151, '6', 'Quotation', 'New Challan create by Keyur Patel', 1, '6', 0, 'active', '2022-04-13 16:22:23', NULL),
(152, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-04-13 16:23:27', NULL),
(153, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-04-13 16:23:40', NULL),
(154, '3', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-04-13 16:56:26', NULL),
(155, '5', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-13 16:57:03', NULL),
(156, '5', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-13 16:59:23', NULL),
(157, '5', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-14 16:35:17', NULL),
(158, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-04-14 16:38:36', NULL),
(159, '11', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-14 17:04:35', NULL),
(160, '11', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-14 17:08:06', NULL),
(161, '11', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-14 17:11:53', NULL),
(162, '11', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-14 17:12:47', NULL),
(163, '12', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-14 17:19:21', NULL),
(164, '6', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-14 17:19:51', NULL),
(165, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-14 17:20:57', NULL),
(166, '12', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-14 17:22:34', NULL),
(167, '4', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-04-14 17:43:58', NULL),
(168, '1', 'Invoice', 'New Invoice create by Keyur Patel', 1, '5', 0, 'active', '2022-04-14 17:57:08', NULL),
(169, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-04-14 18:18:24', NULL),
(170, '4', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-04-26 11:39:33', NULL),
(171, '5', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-04-26 12:50:57', NULL),
(172, '13', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-27 17:35:32', NULL),
(173, '14', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-27 17:49:36', NULL),
(174, '13', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-27 17:54:26', NULL),
(175, '7', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 15:53:50', NULL),
(176, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 15:56:44', NULL),
(177, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 16:01:57', NULL),
(178, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 16:04:19', NULL),
(179, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 16:07:15', NULL),
(180, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 16:09:38', NULL),
(181, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 16:35:30', NULL),
(182, '6', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-04-28 17:28:26', NULL),
(183, '13', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-28 18:40:45', NULL),
(184, '15', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-04-28 18:46:13', NULL),
(185, '15', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-04-28 18:48:57', NULL),
(186, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:26:13', NULL),
(187, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:36:39', NULL),
(188, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:41:05', NULL),
(189, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:44:15', NULL),
(190, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:46:27', NULL),
(191, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:47:15', NULL),
(192, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:49:32', NULL),
(193, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 06:52:28', NULL),
(194, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 07:19:27', NULL),
(195, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-04-30 07:19:50', NULL),
(196, '8', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2022-04-30 07:26:41', NULL),
(197, '2', 'Invoice', 'New Invoice create by Keyur Patel', 1, '5', 0, 'active', '2022-05-03 09:31:49', NULL),
(198, '1', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:21:59', NULL),
(199, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:41:38', NULL),
(200, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:41:46', NULL),
(201, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:41:57', NULL),
(202, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:42:07', NULL),
(203, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:42:23', NULL),
(204, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:44:26', NULL),
(205, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:45:38', NULL),
(206, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-03 10:47:19', NULL),
(207, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-04 07:05:00', NULL),
(208, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-04 07:05:40', NULL),
(209, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-04 07:16:21', NULL),
(210, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-04 07:18:04', NULL),
(211, '1', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2022-05-04 07:18:48', NULL),
(212, '2', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-04 07:38:22', NULL),
(213, '3', 'Invoice', 'New Invoice create by Keyur Patel', 1, '4', 0, 'active', '2022-05-04 13:37:46', NULL),
(214, '2', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-04 13:38:33', NULL),
(215, '3', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-04 13:38:52', NULL),
(216, '3', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-04 13:40:03', NULL),
(217, '9', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 11:47:30', NULL),
(218, '4', 'Invoice', 'New Invoice create by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 11:53:31', NULL),
(219, '9', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 11:55:36', NULL),
(220, '7', 'Quotation', 'New Challan create by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 12:00:55', NULL),
(221, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 12:02:34', NULL),
(222, '7', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 12:03:32', NULL),
(223, '4', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-07 12:05:54', NULL),
(224, '9', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 11:44:28', NULL),
(225, '6', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:31:16', NULL),
(226, '10', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:35:50', NULL),
(227, '10', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:36:43', NULL),
(228, '8', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:41:46', NULL),
(229, '10', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:46:40', NULL),
(230, '5', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:54:00', NULL),
(231, '5', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:54:53', NULL),
(232, '5', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:56:03', NULL),
(233, '8', 'Quotation', 'New Challan create by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 18:58:16', NULL),
(234, '8', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 19:00:46', NULL),
(235, '5', 'Invoice', 'New Invoice create by Keyur Patel', 1, '5', 0, 'active', '2022-05-09 19:06:04', NULL),
(236, '11', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-05-10 12:25:03', NULL),
(237, '16', 'Tickets', 'New Tickets create by Keyur Patel', 1, '18', 0, 'active', '2022-05-25 15:53:05', NULL),
(238, '16', 'Tickets', 'Tickets update by Keyur Patel', 1, '18', 0, 'active', '2022-05-25 15:55:56', NULL),
(239, '17', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-05-25 16:01:48', NULL),
(240, '17', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-05-25 16:04:47', NULL),
(241, '18', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-05-26 13:04:48', NULL),
(242, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-05-26 13:07:17', NULL),
(243, '5', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-06-14 14:17:40', NULL),
(244, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 11:03:06', NULL),
(245, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 11:03:18', NULL),
(246, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 11:04:14', NULL),
(247, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 11:04:34', NULL),
(248, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 11:12:48', NULL),
(249, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 13:42:47', NULL),
(250, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 14:14:06', NULL),
(251, '18', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-15 14:15:26', NULL),
(252, '19', 'Tickets', 'New Tickets create by Keyur Patel', 1, '11', 0, 'active', '2022-06-20 15:47:55', NULL),
(253, '19', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-20 15:52:08', NULL),
(254, '19', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-20 16:04:30', NULL),
(255, '19', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-20 16:11:24', NULL),
(256, '19', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-20 16:11:49', NULL),
(257, '19', 'Tickets', 'Tickets update by Keyur Patel', 1, '11', 0, 'active', '2022-06-20 16:12:02', NULL),
(258, '7', 'Inquiry', 'New Inquiry create by Keyur Patel', 1, '5', 0, 'active', '2022-06-20 16:16:14', NULL),
(259, '12', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-06-20 16:23:45', NULL),
(260, '12', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-06-20 16:25:33', NULL),
(261, '9', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '5', 0, 'active', '2022-06-20 16:26:23', NULL),
(262, '6', 'Quotation', 'New Quotation create by Keyur Patel', 1, '5', 0, 'active', '2022-06-20 16:27:49', NULL),
(263, '12', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-06-20 16:28:23', NULL),
(264, '9', 'Quotation', 'New Challan create by Keyur Patel', 1, '6', 0, 'active', '2022-06-20 16:35:32', NULL),
(265, '9', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-06-20 16:38:22', NULL),
(266, '9', 'Quotation', 'Quotation update by Keyur Patel', 1, '6', 0, 'active', '2022-06-20 16:38:43', NULL),
(267, '6', 'Quotation', 'Quotation update by Keyur Patel', 1, '5', 0, 'active', '2022-06-20 16:40:33', NULL),
(268, '6', 'Invoice', 'New Invoice create by Keyur Patel', 1, '6', 0, 'active', '2022-06-20 16:41:44', NULL),
(269, '13', 'Quotation', 'New Quotation create by Keyur Patel', 1, NULL, 0, 'active', '2024-11-21 07:25:27', NULL),
(270, '14', 'Quotation', 'New Quotation create by Keyur Patel', 1, NULL, 0, 'active', '2024-11-22 07:15:45', NULL),
(271, '7', 'Quotation', 'New Quotation create by Keyur Patel', 1, '2', 0, 'active', '2024-11-22 09:49:15', NULL),
(272, '7', 'Quotation', 'Quotation update by Keyur Patel', 1, '2', 0, 'active', '2024-11-22 09:49:48', NULL),
(273, '10', 'Invoice', 'New Purchase order create by Keyur Patel', 1, '12', 0, 'active', '2024-11-22 09:51:00', NULL),
(274, '14', 'Quotation', 'Quotation update by Keyur Patel', 1, NULL, 0, 'active', '2024-11-22 10:30:47', NULL),
(275, '14', 'Quotation', 'Quotation update by Keyur Patel', 1, NULL, 0, 'active', '2024-11-22 11:09:15', NULL),
(276, '13', 'Quotation', 'Quotation update by Keyur Patel', 1, NULL, 0, 'active', '2024-11-22 11:19:48', NULL),
(277, '13', 'Quotation', 'Quotation update by Praveen Jha', 1, NULL, 0, 'active', '2024-11-23 05:11:40', NULL),
(278, '13', 'Quotation', 'Quotation update by Praveen Jha', 1, NULL, 0, 'active', '2024-11-23 05:32:06', NULL),
(279, '13', 'Quotation', 'Quotation update by Praveen Jha', 1, NULL, 0, 'active', '2024-11-23 05:59:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_payment_mode`
--

CREATE TABLE `tech_payment_mode` (
  `id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tech_problem_report`
--

CREATE TABLE `tech_problem_report` (
  `id` int(11) NOT NULL,
  `title` text,
  `description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_problem_report`
--

INSERT INTO `tech_problem_report` (`id`, `title`, `description`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Hitting Issue	', '<p>Hitting Issue</p>', 0, 'active', '2022-02-10 09:24:57', '2022-02-10 10:13:00', '1'),
(2, 'Excel File Not open', '<p>Excel File Not open</p>', 0, 'active', '2022-02-10 10:13:42', NULL, '1'),
(3, 'Hingies / Body damage', '<p>Hingies / Body damage</p>', 0, 'active', '2022-02-10 10:13:49', '2022-02-10 10:13:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_product_attributes`
--

CREATE TABLE `tech_product_attributes` (
  `id` int(11) NOT NULL,
  `categoty_ids` varchar(255) DEFAULT NULL,
  `subcategory_ids` text,
  `title` text,
  `img` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_product_attributes`
--

INSERT INTO `tech_product_attributes` (`id`, `categoty_ids`, `subcategory_ids`, `title`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '4', '1', 'Color', NULL, 'color', 0, 'active', '2021-09-04 12:05:56', '2021-09-07 14:01:53', '1'),
(2, '2', '3', 'Dell Processer', NULL, 'dell-processer', 0, 'active', '2021-11-24 10:24:34', NULL, '1'),
(3, '18', '54', 'UPS', NULL, 'ups', 0, 'active', '2022-02-08 18:19:42', NULL, '1'),
(4, '18', '55', 'HDD', NULL, 'hdd', 0, 'active', '2022-02-14 08:17:56', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_product_attributes_value`
--

CREATE TABLE `tech_product_attributes_value` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_product_attributes_value`
--

INSERT INTO `tech_product_attributes_value` (`id`, `attribute_id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(5, 1, 'Red', NULL, 0, 'active', '2021-09-04 12:31:56', NULL, '1'),
(6, 1, 'Green', NULL, 0, 'active', '2021-09-07 14:01:53', NULL, '1'),
(7, 1, 'Black', NULL, 0, 'active', '2021-09-07 14:01:53', NULL, '1'),
(8, 2, 'i3 Processer', NULL, 0, 'active', '2021-11-24 10:24:34', NULL, '1'),
(9, 2, 'i4 Processer', NULL, 0, 'active', '2021-11-24 10:24:34', NULL, '1'),
(10, 2, 'i5 Processer', NULL, 0, 'active', '2021-11-24 10:24:34', NULL, '1'),
(11, 2, 'i6 Processer', NULL, 0, 'active', '2021-11-24 10:24:34', NULL, '1'),
(12, 3, 'UPS 500', NULL, 0, 'active', '2022-02-08 18:19:42', NULL, '1'),
(13, 3, 'UPS 750', NULL, 0, 'active', '2022-02-08 18:19:42', NULL, '1'),
(14, 3, 'UPS 1000', NULL, 0, 'active', '2022-02-08 18:19:42', NULL, '1'),
(15, 4, 'HDD 1TD', NULL, 0, 'active', '2022-02-14 08:17:56', NULL, '1'),
(16, 4, 'HDD 2TD', NULL, 0, 'active', '2022-02-14 08:17:56', NULL, '1'),
(17, 4, 'HDD 3TD', NULL, 0, 'active', '2022-02-14 08:17:57', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_product_sub_category`
--

CREATE TABLE `tech_product_sub_category` (
  `id` int(11) NOT NULL,
  `categoty_ids` varchar(255) DEFAULT NULL,
  `title` text,
  `img` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_product_sub_category`
--

INSERT INTO `tech_product_sub_category` (`id`, `categoty_ids`, `title`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '4', 'Acer', '28208copy1.jpg', 'acer', 1, 'active', '2021-09-04 09:31:38', '2021-09-04 09:39:12', '1'),
(2, '2,4', 'HP ', NULL, 'hp', 1, 'active', '2021-11-24 09:57:09', NULL, '1'),
(3, '2', 'Dell', NULL, 'dell', 1, 'active', '2021-11-24 10:23:03', NULL, '1'),
(4, '10', 'Server and Storage Virtualization', NULL, 'server-and-storage-virtualization', 0, 'active', '2022-02-05 10:54:50', NULL, '1'),
(5, '10', 'VMware virtualization', NULL, 'vmware-virtualization', 0, 'active', '2022-02-05 10:57:40', NULL, '1'),
(6, '10', 'Network Virtualization', NULL, 'network-virtualization', 0, 'active', '2022-02-05 10:58:38', NULL, '1'),
(7, '10', 'Storage Virtualization', NULL, 'storage-virtualization', 0, 'active', '2022-02-05 10:59:19', NULL, '1'),
(8, '10', 'Hyper V Virtualization', NULL, 'hyper-v-virtualization', 0, 'active', '2022-02-05 10:59:44', NULL, '1'),
(9, '10', 'Virtual Desktop Infrastructure (VDI)', NULL, 'virtual-desktop-infrastructure-vdi', 0, 'active', '2022-02-05 11:00:39', NULL, '1'),
(10, '11', 'Rack / Tower / Blade Servers', NULL, 'rack-tower-blade-servers', 0, 'active', '2022-02-05 11:01:19', NULL, '1'),
(11, '11', 'All Flash Hybrid Storage', NULL, 'all-flash-hybrid-storage', 0, 'active', '2022-02-05 11:02:18', NULL, '1'),
(12, '11', 'Software Defined-Storage', NULL, 'software-defined-storage', 0, 'active', '2022-02-05 11:04:25', NULL, '1'),
(13, '11', 'Midrange Enterprise Storage', NULL, 'midrange-enterprise-storage', 0, 'active', '2022-02-05 11:05:01', NULL, '1'),
(14, '11', 'SAN Switch', NULL, 'san-switch', 0, 'active', '2022-02-05 11:06:25', NULL, '1'),
(15, '11', 'Data Backup & Recovery', NULL, 'data-backup-recovery', 0, 'active', '2022-02-05 11:07:32', NULL, '1'),
(16, '12', 'Business Grade Laptops Tablets Ultrabook\'s', NULL, 'business-grade-laptops-tablets-ultrabook-s', 0, 'active', '2022-02-05 11:08:29', NULL, '1'),
(17, '12', 'Desktops Workstations PC', NULL, 'desktops-workstations-pc', 0, 'active', '2022-02-05 11:09:00', NULL, '1'),
(18, '12', 'Thin Clients', NULL, 'thin-clients', 0, 'active', '2022-02-05 11:09:34', NULL, '1'),
(19, '12', 'Computer Peripherals & Accessories', NULL, 'computer-peripherals-accessories', 0, 'active', '2022-02-05 11:10:25', NULL, '1'),
(20, '12', 'Printing and Scanning Solution', NULL, 'printing-and-scanning-solution', 0, 'active', '2022-02-05 11:10:45', NULL, '1'),
(21, '12', 'POS System Solutions', NULL, 'pos-system-solutions', 0, 'active', '2022-02-05 11:11:44', NULL, '1'),
(22, '13', 'Endpoint Security Solutions', NULL, 'endpoint-security-solutions', 0, 'active', '2022-02-05 11:12:21', NULL, '1'),
(23, '13', 'Antivirus Solutions', NULL, 'antivirus-solutions', 0, 'active', '2022-02-05 11:12:47', NULL, '1'),
(24, '13', 'DLP Encryption', NULL, 'dlp-encryption', 0, 'active', '2022-02-05 11:13:27', NULL, '1'),
(25, '13', 'Firewall Solutions', NULL, 'firewall-solutions', 0, 'active', '2022-02-05 11:13:48', NULL, '1'),
(26, '13', 'Wireless Network Security', NULL, 'wireless-network-security', 0, 'active', '2022-02-05 11:14:37', NULL, '1'),
(27, '13', 'Email Web Security', NULL, 'email-web-security', 0, 'active', '2022-02-05 11:15:12', NULL, '1'),
(28, '14', 'Access Control System', NULL, 'access-control-system', 0, 'active', '2022-02-05 11:16:40', NULL, '1'),
(29, '14', 'Projectors', NULL, 'projectors', 0, 'active', '2022-02-05 11:24:29', NULL, '1'),
(30, '14', 'CCTV and Surveillance', NULL, 'cctv-and-surveillance', 0, 'active', '2022-02-05 11:25:17', NULL, '1'),
(31, '14', 'Video Systems', NULL, 'video-systems', 0, 'active', '2022-02-05 11:25:48', NULL, '1'),
(32, '14', 'Audio Systems', NULL, 'audio-systems', 0, 'active', '2022-02-05 11:26:51', NULL, '1'),
(33, '14', 'Video Wall / Digital Signage', NULL, 'video-wall-digital-signage', 0, 'active', '2022-02-05 11:27:23', NULL, '1'),
(34, '15', 'WAN and LAN Networking', NULL, 'wan-and-lan-networking', 0, 'active', '2022-02-05 11:28:11', NULL, '1'),
(35, '15', 'Software Defined Access', NULL, 'software-defined-access', 0, 'active', '2022-02-05 11:28:41', NULL, '1'),
(36, '15', 'DNA Analytics Assurance', NULL, 'dna-analytics-assurance', 0, 'active', '2022-02-05 11:30:50', NULL, '1'),
(37, '15', 'Enterprise Network Security', NULL, 'enterprise-network-security', 0, 'active', '2022-02-05 11:31:25', NULL, '1'),
(38, '15', 'Wireless and Mobility', NULL, 'wireless-and-mobility', 0, 'active', '2022-02-05 11:32:59', NULL, '1'),
(39, '15', 'Cloud-Managed Networking', NULL, 'cloud-managed-networking', 0, 'active', '2022-02-05 11:34:05', NULL, '1'),
(40, '15', 'Routing Switching', NULL, 'routing-switching', 0, 'active', '2022-02-05 11:34:22', NULL, '1'),
(41, '15', 'Active/Passive Networking', NULL, 'active-passive-networking', 0, 'active', '2022-02-05 11:34:38', NULL, '1'),
(42, '16', 'Microsoft Business Solutions', NULL, 'microsoft-business-solutions', 0, 'active', '2022-02-05 11:35:00', NULL, '1'),
(43, '16', 'Genuine Autodesk Software', NULL, 'genuine-autodesk-software', 0, 'active', '2022-02-05 11:35:21', NULL, '1'),
(44, '16', 'G Suite Business Solutions', NULL, 'g-suite-business-solutions', 0, 'active', '2022-02-05 11:35:39', NULL, '1'),
(45, '16', 'Microsoft Cloud Solutions', NULL, 'microsoft-cloud-solutions', 0, 'active', '2022-02-05 11:35:57', NULL, '1'),
(46, '16', 'Adobe Software Solutions', NULL, 'adobe-software-solutions', 0, 'active', '2022-02-05 11:36:47', NULL, '1'),
(47, '16,17', 'On premise implementation', NULL, 'on-premise-implementation', 1, 'active', '2022-02-05 11:38:13', NULL, '1'),
(48, '17', 'On premise implementation', NULL, 'on-premise-implementation', 0, 'active', '2022-02-05 11:38:59', NULL, '1'),
(49, '17', 'IT Asset Management & Helpdesk Solutions', NULL, 'it-asset-management-helpdesk-solutions', 0, 'active', '2022-02-05 11:39:34', NULL, '1'),
(50, '17', 'L1 , L2 and L3 Engineer Support', NULL, 'l1-l2-and-l3-engineer-support', 0, 'active', '2022-02-05 11:39:53', NULL, '1'),
(51, '17', 'AMC / FMC Contract TATA', NULL, 'amc-fmc-contract-tata', 0, 'active', '2022-02-05 11:40:13', NULL, '1'),
(52, '17', 'Detailed Network Designing Implementation (e. plan, install , configure, customize, test, tune, stage and deploy)', NULL, 'detailed-network-designing-implementation-e-plan-install-configure-customize-test-tune-stage-and-deploy', 0, 'active', '2022-02-05 11:40:34', NULL, '1'),
(53, '17', 'In-house computer repair service', NULL, 'in-house-computer-repair-service', 0, 'active', '2022-02-05 11:41:22', NULL, '1'),
(54, '18', 'UPS Power Backup Systems', NULL, 'ups-power-backup-systems', 0, 'active', '2022-02-05 11:42:31', NULL, '1'),
(55, '18', 'DG Power Solutions', NULL, 'dg-power-solutions', 0, 'active', '2022-02-05 11:42:54', NULL, '1'),
(56, '18', 'Cooling Rack Solutions', NULL, 'cooling-rack-solutions', 0, 'active', '2022-02-05 11:43:56', NULL, '1'),
(57, '18', 'PDUs Batteries', NULL, 'pdus-batteries', 1, 'active', '2022-02-05 11:44:19', NULL, '1'),
(58, '19', 'PDUs Batteries', NULL, 'pdus-batteries', 0, 'active', '2022-05-07 11:07:56', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_purchase_order`
--

CREATE TABLE `tech_purchase_order` (
  `id` int(11) NOT NULL,
  `purchase_no` text,
  `quotation_no` varchar(50) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `payment_terms` text,
  `terms_of_delivery` text,
  `quotation_subject` longtext,
  `assign_user_id` text,
  `quotation_date` date DEFAULT NULL,
  `inquiry_source_id` text,
  `customer_id` text,
  `customer_contact_id` text,
  `contact_designation_id` text,
  `contact_email` text,
  `contact_mobile` text,
  `b_address_name` int(11) DEFAULT NULL,
  `b_address` text,
  `b_state` text,
  `b_city` text,
  `b_zip_code` text,
  `s_address_name` varchar(11) DEFAULT NULL,
  `s_address` text,
  `s_state` text,
  `s_city` text,
  `s_zip_code` text,
  `remark` text,
  `followup_remark` longtext,
  `term_condition_id` text,
  `total_amount` double DEFAULT NULL,
  `total_margin` double DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('new','open','closed') DEFAULT 'new',
  `vendor_ids` varchar(255) NOT NULL,
  `valid_till` date DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `create_by_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_purchase_order`
--

INSERT INTO `tech_purchase_order` (`id`, `purchase_no`, `quotation_no`, `quotation_id`, `payment_terms`, `terms_of_delivery`, `quotation_subject`, `assign_user_id`, `quotation_date`, `inquiry_source_id`, `customer_id`, `customer_contact_id`, `contact_designation_id`, `contact_email`, `contact_mobile`, `b_address_name`, `b_address`, `b_state`, `b_city`, `b_zip_code`, `s_address_name`, `s_address`, `s_state`, `s_city`, `s_zip_code`, `remark`, `followup_remark`, `term_condition_id`, `total_amount`, `total_margin`, `is_deleted`, `status`, `vendor_ids`, `valid_till`, `reference`, `inserted_time`, `updated_time`, `create_by_id`) VALUES
(1, '00001', '00001', 1, NULL, NULL, NULL, '12', '2022-04-01', '1', '2', '5', '3', 'maulik@gmail.com', '8855447799', 4, 'Near Station road', '3', '', '393939', '5', 'Near Station road', '2', '2', '789987', '', NULL, '', 3103420, 660, 0, 'new', '18,31', NULL, NULL, '2022-04-04 17:58:59', '2022-04-04 18:18:40', '1'),
(2, '00002', '00002', 2, NULL, NULL, NULL, '5', '2022-04-05', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 15, '394?GIDC, Makarpura, ', '3', '11', '390010', '14', '394?GIDC, Makarpura, ', '3', '11', '391760', '', NULL, '', 128671, 3671, 0, 'new', '18,23', NULL, NULL, '2022-04-05 16:03:43', '2022-04-05 16:49:26', '1'),
(3, '00003', '00004', 4, NULL, NULL, NULL, '6', '2022-04-08', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '15', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '', NULL, '', 135671, 12500, 0, 'new', '18,28', NULL, NULL, '2022-04-08 17:23:37', '2022-04-09 14:27:57', '1'),
(4, '00004', '', NULL, NULL, NULL, NULL, '5', '2022-04-12', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 15, '394?GIDC, Makarpura, ', '3', '11', '390010', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', NULL, NULL, '1,,', 28000, 3000, 0, 'new', '28', NULL, NULL, '2022-04-12 13:24:13', NULL, '1'),
(5, '00005', '00005', 5, NULL, NULL, NULL, '5', '2022-04-13', '7', '47', '18', '20', 'Consult@greenelectricals.com', '8511106524', 17, '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '17', '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', NULL, NULL, ',', 51000, 4000, 0, 'new', '', NULL, NULL, '2022-04-14 16:35:17', NULL, '1'),
(6, '00006', '00007', 7, NULL, NULL, NULL, '5', '2022-04-28', '10', '55', '23', '4', 'yunus@marfatia.net', '9725451622', 22, '216, Glacier complex, Jetalpur Road', '3', '11', '390005', '22', '216, Glacier complex, Jetalpur Road', '3', '11', '390005', NULL, NULL, '2,', 539000, 49000, 0, 'new', '', NULL, NULL, '2022-04-28 17:28:26', NULL, '1'),
(7, '00007', '00009', 9, NULL, NULL, NULL, '5', '2022-05-07', '8', '57', '24', '20', 'ajay.thatte@setcoauto.com', '6357422454', 23, 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '23', 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', NULL, NULL, '2,11', 0, 6000, 0, 'new', '28', NULL, NULL, '2022-05-07 12:03:32', NULL, '1'),
(8, '00008', '00010', 10, NULL, NULL, NULL, '5', '2022-05-09', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', NULL, NULL, '10,2', 3481000, 57000, 0, 'new', '67,33', NULL, NULL, '2022-05-09 18:41:46', NULL, '1'),
(9, '00009', '00012', 12, NULL, NULL, NULL, '5', '2022-06-20', '6', '73', '31', '3', 'info@integratedsolution.in', '799701203', 29, 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '29', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '', NULL, '', 87000, 0, 0, 'new', '28', NULL, NULL, '2022-06-20 16:26:23', '2024-11-22 09:47:27', '1'),
(10, '00010', '00001', 1, NULL, NULL, NULL, '12', '2022-04-01', '1', '2', '5', '3', 'maulik@gmail.com', '8855447799', 4, 'Near Station road', '3', '', '393939', '5', 'Near Station road', '2', '2', '789987', NULL, NULL, ',', 3103420, 660, 0, 'new', '', NULL, NULL, '2024-11-22 09:50:59', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_purchase_order_item`
--

CREATE TABLE `tech_purchase_order_item` (
  `id` int(11) NOT NULL,
  `vendor_id` text,
  `inquiry_id` text,
  `purchase_order_id` int(11) DEFAULT NULL,
  `item_type` text,
  `item_id` text,
  `item_qty` text,
  `purchase_item_price` double DEFAULT NULL,
  `margin_item_price` double DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_gst` double DEFAULT NULL,
  `item_description` longtext,
  `item_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_purchase_order_item`
--

INSERT INTO `tech_purchase_order_item` (`id`, `vendor_id`, `inquiry_id`, `purchase_order_id`, `item_type`, `item_id`, `item_qty`, `purchase_item_price`, `margin_item_price`, `item_price`, `item_gst`, `item_description`, `item_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, '18', NULL, 1, 'product', '4', '10', 108934, 660, 109000, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br /><br /></p>', NULL, 0, 'active', NULL, NULL, NULL),
(2, '31', NULL, 1, 'product', '5', '20', 100671, 0, 100671, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br /><br /></p>', NULL, 0, 'active', NULL, NULL, NULL),
(3, '18', NULL, 2, 'product', '6', '1', 25000, 3000, 28000, 18, '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', NULL, 0, 'active', NULL, NULL, NULL),
(4, '23', NULL, 2, 'product', '5', '1', 100000, 671, 100671, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(5, '18', NULL, 3, 'product', '7', '1', 12500, 2000, 14500, 28, '<p>3 Year Warranty </p>', NULL, 0, 'active', NULL, NULL, NULL),
(6, '28', NULL, 3, 'product', '3', '1', 10000, 500, 10500, 18, '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', NULL, 0, 'active', NULL, NULL, NULL),
(7, '28', NULL, 3, 'product', '5', '1', 100671, 10000, 110671, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(8, '28', NULL, 4, 'product', '6', '1', 25000, 3000, 28000, 18, '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', NULL, 0, 'active', NULL, NULL, NULL),
(9, '', NULL, 5, 'product', '9', '1', 33500, 3000, 36500, 28, '<p>&nbsp;50 INCHES, 4K, SMART ANDROID&nbsp;<br />3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(10, '', NULL, 5, 'product', '8', '1', 13500, 1000, 14500, 18, '<p><br />24 x 10/100/1000BASE-T ports<br />4 x Gigabit RJ45/SFP Combo ports</p>', NULL, 0, 'active', NULL, NULL, NULL),
(11, '', NULL, 6, 'product', '10', '1', 490000, 49000, 539000, 0, '<p>1 x Intel Xeon-Gold 6242R (3.1GHz/20-core/205W) Processor Kit<br />2 x HPE 32GB 2Rx4 PC4-2933Y-R Smart Kit<br />2 x HPE 480GB SATA RI SFF SC MV SSD<br />HPE Ethernet 1Gb 4-port FLR-T I350-T4V2 Adapter <br />P408i-a w/2GB cache with smart Storage battery <br />3-slots (x8, x16, x8 with dual m.2) as standard <br />1 x HPE 800W Flex Slot Platinum Hot Plug RPS Kit <br />HPE iLO Standard with Intelligent Provisioning <br />2U SFF Easy install rail kit with CMA<br />3 Years NBD Support</p>', NULL, 0, 'active', NULL, NULL, NULL),
(12, '28', NULL, 7, 'product', '11', '1', 1462000, 6000, 1468000, 18, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(13, '67', NULL, 8, 'product', '11', '2', 1462000, 12000, 1468000, 18, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(14, '33', NULL, 8, 'product', '4', '5', 100000, 45000, 109000, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(15, '28', NULL, 9, 'product', '12', '1', 51000, 3000, 54000, 18, '<p>Core i3-10105T 10th Generaiton</p>\r\n<p>8 GB RAM</p>\r\n<p>256 GB SSD</p>\r\n<p>Windows 10 Pro</p>\r\n<p>21.5\" inch FHD Display</p>\r\n<p>No ODD</p>\r\n<p>3 Year Warranty</p>\r\n<p>Basic Stand/Camera</p>\r\n<p>Intel&reg; 3165 802.11ac dual band 1x1 + Bluetooth 4.2</p>\r\n<p>Wireless Keyboard and mouse</p>\r\n<p>&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(16, '', NULL, 10, 'product', '4', '10', 108934, 660, 109000, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_purchase_order_term_condition`
--

CREATE TABLE `tech_purchase_order_term_condition` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_purchase_order_term_condition`
--

INSERT INTO `tech_purchase_order_term_condition` (`id`, `purchase_order_id`, `term_id`, `item_description`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, 1, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(2, 2, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(3, 3, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(4, 3, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 1, 'active', NULL, NULL, NULL),
(5, 4, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(6, 6, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention&nbsp;</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 4 to 5 Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(7, 7, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(8, 7, 11, '', 0, 'active', NULL, NULL, NULL),
(9, 8, 10, '<ul>\r\n<li><span style=\"font-size: 10pt;\"><strong>Payment&nbsp; &nbsp; &nbsp; &nbsp;:</strong> 100% Advance with Purchase Order</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>GST&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;18 % Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; &nbsp; :</strong> No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;5 - 6 Working Days (The equipment is accepted for the service on the condition that the repairs may be delayed if the required spare is not available with us or in the market These terms govern the provision of any computer support services (\"Services\") provided by TECH SERVICES)&nbsp;</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:</strong>&nbsp;&nbsp;3 days from date of Quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Order&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> Order once given will not be cancel and material once billed will not be taken back.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Quoted rates are approximate charges, actual repairing charges may vary &plusmn; 10%.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">There are 50% -50% chances of repairing. So, it may or may not repair, even after getting confirmation from your side.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">All Software\'s and Data are of client responsibility, please backup all the data before submitting for repair.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Data backup/ security is not our responsibility and if wanted than will be on extra cost ( without any guaranty )</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Maintenance and repairs will be on customer risk. If any machine /Laptop goes dead, we are not responsible for the same, no argument will be tolerated.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Collect material&nbsp;by yourself&nbsp;from our office between 11 am to 5 pm</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(10, 8, 2, '', 0, 'active', NULL, NULL, NULL),
(11, 9, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_quotation`
--

CREATE TABLE `tech_quotation` (
  `quotation_no` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `inquiry_id` int(11) DEFAULT NULL,
  `vendor_ids` varchar(255) DEFAULT NULL,
  `quotation_subject` longtext,
  `assign_user_id` text,
  `quotation_date` date DEFAULT NULL,
  `inquiry_source_id` text,
  `customer_id` text,
  `customer_contact_id` text,
  `contact_designation_id` text,
  `contact_email` text,
  `contact_mobile` text,
  `b_address_name` int(11) DEFAULT NULL,
  `b_address` text,
  `b_state` text,
  `b_city` text,
  `b_zip_code` text,
  `s_address_name` varchar(11) DEFAULT NULL,
  `s_address` text,
  `s_state` text,
  `s_city` text,
  `s_zip_code` text,
  `remark` text,
  `followup_remark` longtext,
  `term_condition_id` text,
  `team_conditions` text,
  `total_amount` double DEFAULT NULL,
  `total_margin` double DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('new','open','closed') DEFAULT 'new',
  `valid_till` date DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `create_by_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_quotation`
--

INSERT INTO `tech_quotation` (`quotation_no`, `id`, `inquiry_id`, `vendor_ids`, `quotation_subject`, `assign_user_id`, `quotation_date`, `inquiry_source_id`, `customer_id`, `customer_contact_id`, `contact_designation_id`, `contact_email`, `contact_mobile`, `b_address_name`, `b_address`, `b_state`, `b_city`, `b_zip_code`, `s_address_name`, `s_address`, `s_state`, `s_city`, `s_zip_code`, `remark`, `followup_remark`, `term_condition_id`, `team_conditions`, `total_amount`, `total_margin`, `is_deleted`, `status`, `valid_till`, `reference`, `inserted_time`, `updated_time`, `create_by_id`) VALUES
('00001', 1, 1, NULL, 'Super market Product Inquire', '12', '2022-04-01', '1', '2', '5', '3', 'maulik@gmail.com', '8855447799', 4, 'Near Station road', '3', '', '393939', '5', 'Near Station road', '2', '2', '789987', '<p>Super market Product Inquire</p>', NULL, '', NULL, 3103420, 660, 0, 'new', '2022-04-10', '', '2022-04-04 16:22:13', '2022-04-04 17:58:07', '1'),
('00002', 2, NULL, NULL, 'Lenovo Desktop ', '5', '2022-04-05', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 15, '394?GIDC, Makarpura, ', '3', '11', '390010', '14', '394?GIDC, Makarpura, ', '3', '11', '391760', '<p>ASDFGHM,./;LKJHGFDSA</p>', NULL, '1,', NULL, 128671, 3671, 0, 'new', '2022-04-12', 'For Frined', '2022-04-05 15:48:34', '2022-04-05 16:41:50', '1'),
('00003', 3, NULL, NULL, 'Lenovo Desktop ', '5', '2022-04-05', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 15, '394?GIDC, Makarpura, ', '3', '11', '390010', '14', '394?GIDC, Makarpura, ', '3', '11', '391760', '<p>1 to 2 Working Weeks ( limited stock so please confirm with us stock Availability and Price before order )</p>', NULL, '1,', NULL, 350, 350, 0, 'new', '2022-04-12', 'For Frined', '2022-04-05 16:53:47', '2022-04-08 15:39:41', '1'),
('00004', 4, NULL, NULL, 'DLink Switch', '6', '2022-04-08', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '<p>For Networking used</p>', NULL, '1,', NULL, 135671, 12500, 0, 'new', '2022-04-10', '123', '2022-04-08 16:57:03', '2022-04-14 17:43:58', '1'),
('00005', 5, 3, NULL, '50 inch & Switch  Requirement ', '5', '2022-04-13', '7', '47', '18', '20', 'Consult@greenelectricals.com', '8511106524', 17, '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '17', '755H+VWR, Makarpura GIDC, Makarpura,', '3', '11', '390010', '<p>Panasonic make LED<br />and switch make dlink&nbsp;</p>', NULL, '1,', NULL, 51000, 4000, 0, 'new', '2022-04-20', 'inquiry no 521', '2022-04-13 16:57:03', '2022-04-13 16:59:23', '1'),
('00006', 6, NULL, NULL, 'New Quotation 2022', '5', '2022-04-14', '1', '36', '12', '5', 'monika@gmail.com', '0265332255', 11, 'JURONG WEST AVE', '3', '', '390009', '10', 'JURONG WEST AVE', '3', '3', '393366', '<div>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>&nbsp;</div>', NULL, '8,2', NULL, 56000, 6000, 0, 'new', '2022-04-14', 'REF', '2022-04-14 17:19:51', '2022-04-14 17:20:57', '1'),
('00007', 7, NULL, NULL, 'HP SERVER', '5', '2022-04-28', '10', '55', '23', '4', 'yunus@marfatia.net', '9725451622', 22, '216, Glacier complex, Jetalpur Road', '3', '11', '390005', '22', '216, Glacier complex, Jetalpur Road', '3', '11', '390005', '', NULL, '2', NULL, 539000, 49000, 0, 'new', '2022-04-30', '', '2022-04-28 15:53:50', '2022-04-30 07:19:50', '1'),
('00008', 8, NULL, NULL, 'For GST Test', '2', '2022-04-30', '1', '36', '12', '4', 'monika@gmail.com', '0265332255', 11, 'JURONG WEST AVE', '3', '', '390009', '11', 'JURONG WEST AVE', '3', '', '390009', '<p>aaa</p>', NULL, '2', NULL, 29000, 4000, 0, 'new', '2022-04-30', 'For Frined', '2022-04-30 07:26:40', NULL, '1'),
('00009', 9, NULL, NULL, 'Quotation For DELL SERVER', '5', '2022-05-07', '8', '57', '24', '20', 'ajay.thatte@setcoauto.com', '6357422454', 23, 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '23', 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '', NULL, '2', NULL, 0, 0, 0, 'new', '2022-05-12', '', '2022-05-07 11:47:30', '2022-05-09 11:44:28', '1'),
('00010', 10, 6, NULL, 'Quotation for DELL Server and Laptop', '5', '2022-05-09', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '<p>NEW ITEM REQUIRED FOR MATRIX BARODA</p>', NULL, '10', NULL, 3481000, 57000, 0, 'new', '2022-05-15', 'BY MAIL', '2022-05-09 18:35:50', '2022-05-09 18:46:40', '1'),
('00011', 11, NULL, NULL, 'Quotation for DELL Server and Laptop', '5', '2022-05-09', '6', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '<p>NEW ITEM REQUIRED FOR MATRIX BARODA</p>', NULL, '10,10', NULL, 3263000, 39000, 0, 'new', '2022-05-15', 'BY MAIL', '2022-05-10 12:25:03', NULL, '1'),
('00012', 12, 7, NULL, 'DELL AIO', '6', '2022-06-20', '6', '73', '31', '3', 'info@integratedsolution.in', '799701203', 29, 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '29', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '<p>DELL AIO</p>', NULL, '2,', NULL, 87000, 0, 0, 'new', '0000-00-00', '', '2022-06-20 16:23:45', '2022-06-20 16:28:23', '1'),
('00013', 13, NULL, NULL, 'test', NULL, '2024-11-21', '1', '74', NULL, '6', 'ajay.thatte@setcoauto.com', '6357422454', 30, 'fgdf', '3', '11', '390019', '30', 'fgdf', '3', '11', '390019', NULL, NULL, NULL, '<p>1. Applicable taxes will be extra. 2. Work will resume after advance payment</p>', 0, 0, 0, 'new', '2024-11-22', 'maaahi it ', '2024-11-21 07:25:27', '2024-11-23 05:59:40', '1'),
('00014', 14, NULL, NULL, 'test', NULL, '2024-11-22', '6', '75', NULL, '6', 'ajay.thatte@setcoauto.com', '6357422454', 31, '35/4th Floor, Sidheshwar Plaza, New VIP Rd, Sheshnarayan Society, Sardar Estate, Sayaji Park Society, Vadodara, Gujarat 390022', '3', '11', '390019', '31', '35/4th Floor, Sidheshwar Plaza, New VIP Rd, Sheshnarayan Society, Sardar Estate, Sayaji Park Society, Vadodara, Gujarat 390022', '3', '11', '390019', NULL, NULL, NULL, '<p>1. Applicable taxes will be extra. 2. Work will resume after advance payment</p>', 0, 0, 0, 'new', '2024-11-24', 'maaahi it ', '2024-11-22 07:15:45', '2024-11-22 11:09:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_quotation_item`
--

CREATE TABLE `tech_quotation_item` (
  `id` int(11) NOT NULL,
  `inquiry_id` text,
  `vendor_ids` varchar(255) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `item_type` text,
  `item_id` text,
  `item_qty` double DEFAULT '1',
  `item_tax` text,
  `item_rate` text,
  `item_amount` text,
  `item_igst` text,
  `item_cgst` text,
  `item_sgst` text,
  `item_final_total` text,
  `purchase_item_price` double DEFAULT NULL,
  `margin_item_price` double DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_gst` double DEFAULT NULL,
  `item_description` longtext,
  `item_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_quotation_item`
--

INSERT INTO `tech_quotation_item` (`id`, `inquiry_id`, `vendor_ids`, `quotation_id`, `item_type`, `item_id`, `item_qty`, `item_tax`, `item_rate`, `item_amount`, `item_igst`, `item_cgst`, `item_sgst`, `item_final_total`, `purchase_item_price`, `margin_item_price`, `item_price`, `item_gst`, `item_description`, `item_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, NULL, NULL, 1, 'product', '4', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 108934, 660, 109000, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(2, NULL, NULL, 1, 'product', '5', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100671, 0, 100671, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 1, 'active', NULL, NULL, NULL),
(3, NULL, NULL, 2, 'product', '6', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, 3000, 28000, 18, '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', NULL, 0, 'active', NULL, NULL, NULL),
(4, NULL, NULL, 2, 'product', '5', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, 671, 100671, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(5, NULL, NULL, 3, 'service', '3', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 350, 350, NULL, '<ul>\r\n<li>This is demo content 1</li>\r\n</ul>', NULL, 0, 'active', NULL, NULL, NULL),
(6, NULL, NULL, 4, 'product', '7', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12500, 2000, 14500, 28, '<p>3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(7, NULL, NULL, 4, 'product', '3', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, 500, 10500, 18, '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', NULL, 0, 'active', NULL, NULL, NULL),
(8, NULL, NULL, 4, 'product', '5', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100671, 10000, 110671, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(9, NULL, NULL, 5, 'product', '9', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33500, 3000, 36500, 28, '<p>&nbsp;50 INCHES, 4K, SMART ANDROID&nbsp;<br />3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(10, NULL, NULL, 5, 'product', '8', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13500, 1000, 14500, 18, '<p><br />24 x 10/100/1000BASE-T ports<br />4 x Gigabit RJ45/SFP Combo ports</p>', NULL, 0, 'active', NULL, NULL, NULL),
(11, NULL, NULL, 6, 'product', '6', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, 6000, 28000, 18, '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', NULL, 0, 'active', NULL, NULL, NULL),
(12, NULL, NULL, 7, 'product', '10', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 490000, 49000, 539000, 18, '<p><span style=\"font-size: 12pt;\">1 x Intel Xeon-Gold 6242R (3.1GHz/20-core/205W) Processor Kit</span><br /><span style=\"font-size: 12pt;\">2 x HPE 32GB 2Rx4 PC4-2933Y-R Smart Kit</span><br /><span style=\"font-size: 12pt;\">2 x HPE 480GB SATA RI SFF SC MV SSD</span><br /><span style=\"font-size: 12pt;\">HPE Ethernet 1Gb 4-port FLR-T I350-T4V2 Adapter </span><br /><span style=\"font-size: 12pt;\">P408i-a w/2GB cache with smart Storage battery </span><br /><span style=\"font-size: 12pt;\">3-slots (x8, x16, x8 with dual m.2) as standard </span><br /><span style=\"font-size: 12pt;\">1 x HPE 800W Flex Slot Platinum Hot Plug RPS Kit </span><br /><span style=\"font-size: 12pt;\">HPE iLO Standard with Intelligent Provisioning </span><br /><span style=\"font-size: 12pt;\">2U SFF Easy install rail kit with CMA</span><br /><span style=\"font-size: 12pt;\">3 Years NBD Support</span></p>', NULL, 0, 'active', NULL, NULL, NULL),
(13, NULL, NULL, 8, 'product', '7', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12500, 4000, 14500, 28, '<p>3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(14, NULL, NULL, 9, 'product', '11', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1462000, 0, 1468000, 18, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(15, NULL, NULL, 10, 'product', '11', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1462000, 12000, 1468000, 18, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(16, NULL, NULL, 10, 'product', '4', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, 45000, 109000, 18, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 1, 'active', NULL, NULL, NULL),
(17, NULL, NULL, 11, 'product', '11', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1462000, 12000, 1468000, 18, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(18, NULL, NULL, 12, 'product', '12', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51000, 3000, 54000, 18, '<p>Core i3-10105T 10th Generaiton</p>\r\n<p>8 GB RAM</p>\r\n<p>256 GB SSD</p>\r\n<p>Windows 10 Pro</p>\r\n<p>21.5\" inch FHD Display</p>\r\n<p>No ODD</p>\r\n<p>3 Year Warranty</p>\r\n<p>Basic Stand/Camera</p>\r\n<p>Intel&reg; 3165 802.11ac dual band 1x1 + Bluetooth 4.2</p>\r\n<p>Wireless Keyboard and mouse</p>\r\n<p>&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(19, NULL, NULL, 12, 'product', '3', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, 500, 10500, 18, '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', NULL, 1, 'active', NULL, NULL, NULL),
(20, NULL, NULL, 12, 'product', '6', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, 0, 28000, NULL, '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', NULL, 1, 'active', NULL, NULL, NULL),
(21, NULL, NULL, 13, 'service', '4', 1, '18', '150000', '150000', '27000', '13500', '13500', '177000', NULL, NULL, NULL, 18, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(22, NULL, NULL, 13, 'service', '3', 1, '18', '150000', '150000', '27000', '13500', '13500', '177000', NULL, NULL, NULL, 18, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(23, NULL, NULL, 14, 'service', '6', 1, '18', '50000', '50000', '9000', '4500', '4500', '59000', NULL, NULL, NULL, 18, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(24, NULL, NULL, 14, 'service', '4', 1, '18', '150000', '150000', '27000', '13500', '13500', '177000', NULL, NULL, NULL, 18, NULL, NULL, 0, 'active', NULL, NULL, NULL),
(25, NULL, NULL, 14, 'service', '4', 1, '18', '150000', '1250', '225', '112.5', '112.5', '1475', NULL, NULL, NULL, 18, NULL, NULL, 1, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_quotation_term_condition`
--

CREATE TABLE `tech_quotation_term_condition` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_quotation_term_condition`
--

INSERT INTO `tech_quotation_term_condition` (`id`, `quotation_id`, `term_id`, `item_description`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, 1, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(2, 2, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(3, 3, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 1, 'active', NULL, NULL, NULL),
(4, 4, 0, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(5, 5, 1, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(6, 6, 8, '<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 % or 28% Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention or 1 year warranty from OEM on Products&nbsp;( No Warranty on cable and cable laying )&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; The standard delivery period of CCTV Services is 4-7 Working&nbsp;days from the date of acceptance of purchase order by&nbsp; Tech Services&nbsp; ( (limited stock so please confirm with us stock Availability before order )</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 2 days from date of Quote or till stocks last, whichever is earlier</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</span></p>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customers are advised to pay materials costing on signing/accepting this term and order form and also to settle the full invoice amount on completion of installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">installation materials like Cable, cable laying , connectors&nbsp;,&nbsp;pipe, bend, clamp ,etc charges as per qunitituy used&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>For Installing the required scaffolding, ladder should be arranged by the customer.</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Monitor should be arranged by the customer during the installation to preview and confirm quality output on the premises.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Ensure that the Internet wiring access is near to the location of DVR/NVR.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Installation requires drilling holes in interior and exterior walls. Tech Services limits its liability to the patching of said holes and cannot be responsible for providing paint or wall coverings to match those colors or coverings existing within Customer\'s premises</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Additional Accessories like mouse, network cable, router, etc.,should be arranged by the customer before installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customer should make premises available without interruption during Tech Services\'s normal working hours, 10:00 A.M. to 6:30 P.M., Monday through Saturday, excluding holidays.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Civil &amp; Electrical Work , Jari work ,is in the Scope of the Customer</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases</span></p>\r\n<p><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote 123</span></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(7, 6, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order ) 123</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(8, 7, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention&nbsp;</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 4 to 5 Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(9, 8, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(10, 9, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(11, 10, 10, '<ul>\r\n<li><span style=\"font-size: 10pt;\"><strong>Payment&nbsp; &nbsp; &nbsp; &nbsp;:</strong> 100% Advance with Purchase Order</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>GST&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;18 % Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; &nbsp; :</strong> No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;5 - 6 Working Days (The equipment is accepted for the service on the condition that the repairs may be delayed if the required spare is not available with us or in the market These terms govern the provision of any computer support services (\"Services\") provided by TECH SERVICES)&nbsp;</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:</strong>&nbsp;&nbsp;3 days from date of Quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Order&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> Order once given will not be cancel and material once billed will not be taken back.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Quoted rates are approximate charges, actual repairing charges may vary &plusmn; 10%.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">There are 50% -50% chances of repairing. So, it may or may not repair, even after getting confirmation from your side.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">All Software\'s and Data are of client responsibility, please backup all the data before submitting for repair.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Data backup/ security is not our responsibility and if wanted than will be on extra cost ( without any guaranty )</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Maintenance and repairs will be on customer risk. If any machine /Laptop goes dead, we are not responsible for the same, no argument will be tolerated.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Collect material&nbsp;by yourself&nbsp;from our office between 11 am to 5 pm</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(12, 11, 10, '<ul>\r\n<li><span style=\"font-size: 10pt;\"><strong>Payment&nbsp; &nbsp; &nbsp; &nbsp;:</strong> 100% Advance with Purchase Order</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>GST&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;18 % Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; &nbsp; :</strong> No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;5 - 6 Working Days (The equipment is accepted for the service on the condition that the repairs may be delayed if the required spare is not available with us or in the market These terms govern the provision of any computer support services (\"Services\") provided by TECH SERVICES)&nbsp;</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:</strong>&nbsp;&nbsp;3 days from date of Quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Order&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> Order once given will not be cancel and material once billed will not be taken back.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Quoted rates are approximate charges, actual repairing charges may vary &plusmn; 10%.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">There are 50% -50% chances of repairing. So, it may or may not repair, even after getting confirmation from your side.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">All Software\'s and Data are of client responsibility, please backup all the data before submitting for repair.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Data backup/ security is not our responsibility and if wanted than will be on extra cost ( without any guaranty )</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Maintenance and repairs will be on customer risk. If any machine /Laptop goes dead, we are not responsible for the same, no argument will be tolerated.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Collect material&nbsp;by yourself&nbsp;from our office between 11 am to 5 pm</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(13, 11, 10, '', 0, 'active', NULL, NULL, NULL),
(14, 12, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(15, 13, 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 1, 'active', NULL, NULL, NULL),
(16, 13, 9, '<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>AMC Time Period :</strong>&nbsp;Contract will be for 12 months.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST :</strong>&nbsp;prices are Exclusive of 18% GST. Or any change in govt. Taxes</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment Terms :</strong>&nbsp;Yearly Full amount has to be paid in advance</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Valid Till :</strong>&nbsp;Price valid till 7&nbsp;days from date of Quote</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The above said contract Does not include any spares(Contract is without spares)</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Consumer Like LED, CD/DVD Drive / Keyboard / Mouse &ndash; Touch pad (Laptop &ndash; Desktop) , Printer Toner, Fusor Assembly, paper feeder assembly will not be consider under AMC</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The calls will be attended within 24&nbsp;Working hours from loging&nbsp;complaints</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">First Remote Support if gets solved remotely then will complete call remotely, else will visit</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The complaints will be attended from 10:30&nbsp; a.m. to 6.p.m. except Sundays, public holidays.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">This Annual Maintenance Contract does not include shifting of equipment.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Software should be provided by user / customer.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Hardware calls will do diagnosis, but spares will be on Actual cost</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">All software / Antivirus /Data backup protection will be in your scope</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The above mentioned contract does not include the data entries, software customization, data corruption, data recovery or lost data due to virus attacks if any. However, we ensure that all necessary steps will be taken to ensure proper functioning of the system.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Internet Problem / Printer Problem / CCTV Problem / Network Problem will be in your scope</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Networking, Cabling, Switches, Router, Mail will not be covered under AMC.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">In case the problem is not solved at site the Client has to bear the cost of transportation &amp; duties (if applicable).</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Should any unauthorized person be permitted to access the database or installed applications, software/hardware under agreement and in the event of failures, support shall be on chargeable basis.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Server migration from OLD to NEW Hardware&nbsp; , Server Support&nbsp;&nbsp;will be charged as extra.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Additional maintenance of systems purchased during the year will have to be done with additional cost of Non- Comprehensive AMC Charges.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;This Annual Maintenance Contract does not include shifting and reinstallation of equipment.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>We will survey your site First, after discuss and solve Current problems and Parts issue, then we will take AMC</strong></span></p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_sales_order`
--

CREATE TABLE `tech_sales_order` (
  `id` int(11) NOT NULL,
  `po_no` text,
  `sales_order_no` varchar(50) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `quotation_no` text,
  `payment_terms` text,
  `assign_user_id` text,
  `sales_order_date` date DEFAULT NULL,
  `inquiry_source_id` text,
  `delivery_date` date DEFAULT NULL,
  `delivery_note` text,
  `shipping_address_pdf` text,
  `customer_id` text,
  `customer_contact_id` text,
  `contact_designation_id` text,
  `contact_email` text,
  `contact_mobile` text,
  `b_address_name` int(11) DEFAULT NULL,
  `b_address` text,
  `b_state` text,
  `b_city` text,
  `b_zip_code` text,
  `s_address_name` varchar(11) DEFAULT NULL,
  `s_address` text,
  `s_state` text,
  `s_city` text,
  `s_zip_code` text,
  `remark` text,
  `followup_remark` longtext,
  `term_condition_id` text,
  `total_amount` double DEFAULT NULL,
  `total_margin` double DEFAULT NULL,
  `received_payment` double DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('new','open','closed') DEFAULT 'new',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `create_by_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_sales_order`
--

INSERT INTO `tech_sales_order` (`id`, `po_no`, `sales_order_no`, `quotation_id`, `quotation_no`, `payment_terms`, `assign_user_id`, `sales_order_date`, `inquiry_source_id`, `delivery_date`, `delivery_note`, `shipping_address_pdf`, `customer_id`, `customer_contact_id`, `contact_designation_id`, `contact_email`, `contact_mobile`, `b_address_name`, `b_address`, `b_state`, `b_city`, `b_zip_code`, `s_address_name`, `s_address`, `s_state`, `s_city`, `s_zip_code`, `remark`, `followup_remark`, `term_condition_id`, `total_amount`, `total_margin`, `received_payment`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `create_by_id`) VALUES
(1, '0001', '00001', NULL, '00008', '30 Days', '2', '2022-04-30', '1', '2022-05-04', 'Delivery Note', 'Shipping address pdf', '36', '12', '4', 'monika@gmail.com', '0265332255', 11, 'JURONG WEST AVE', '3', '2', '390009', '11', 'JURONG WEST AVE', '3', '2', '390009', '<p>aaa</p>', NULL, '2,', 58000, 8000, NULL, 0, 'open', '2022-05-03 10:21:59', '2022-05-04 07:18:48', '1'),
(2, '002', '00002', NULL, '00006', '20 Days ', '5', '2022-04-14', '1', '2022-05-05', 'Delivery Note New', 'A-10 , Near station New', '36', '12', '5', 'monika@gmail.com', '0265332255', 11, 'JURONG WEST AVE', '3', '', '390009', '10', 'JURONG WEST AVE', '3', '3', '393366', '<div>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>&nbsp;</div>', NULL, '8,2,', 56000, 6000, NULL, 0, 'new', '2022-05-04 07:38:21', '2022-05-04 13:38:33', '1'),
(3, '', '00003', NULL, '00003', '', '5', '2022-04-05', '6', '2022-05-03', '', '', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 15, '394?GIDC, Makarpura, ', '3', '11', '390010', '14', '394?GIDC, Makarpura, ', '3', '11', '391760', '<p>1 to 2 Working Weeks ( limited stock so please confirm with us stock Availability and Price before order )</p>', NULL, '', 350, 350, NULL, 0, 'new', '2022-05-04 13:38:52', '2022-05-04 13:40:03', '1'),
(4, '', '00004', NULL, '00009', '', '5', '2022-05-07', '8', '0000-00-00', '', '', '57', '24', '20', 'ajay.thatte@setcoauto.com', '6357422454', 23, 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '23', 'Vadodara Godhra Highway, Kalol , 389330', '3', '11', '', '', NULL, '2,', 0, 0, NULL, 0, 'new', '2022-05-07 12:05:54', NULL, '1'),
(5, '2350', '00005', NULL, '00010', '30 Days', '5', '2022-05-09', '6', '2022-05-15', 'Frieght charges Extra ', '', '39', '14', '8', 'gagandeep.singh@matrixcomsec.com', '9265872353', 14, '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '14', '15 & 19?GIDC, Waghodia,', '3', '11', '391760', '<p>NEW ITEM REQUIRED FOR MATRIX BARODA</p>', NULL, '10,', 130000, 31000, NULL, 0, 'new', '2022-05-09 18:54:00', '2022-06-14 14:17:40', '1'),
(6, '', '00006', NULL, '00012', '', '5', '2022-06-20', '6', '0000-00-00', '', '', '73', '31', '3', 'info@integratedsolution.in', '799701203', 29, 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '29', 'Plot no. 37 Road no. 5A Kathwada G.I.D.C', '3', '9', '382430', '<p>DELL AIO</p>', NULL, '2,', 87000, 0, NULL, 0, 'new', '2022-06-20 16:27:49', '2022-06-20 16:40:33', '1'),
(7, '', '00007', NULL, '00008', '', '2', '2022-04-30', '1', '0000-00-00', '', '', '36', '12', '4', 'monika@gmail.com', '0265332255', 11, 'JURONG WEST AVE', '3', '', '390009', '11', 'JURONG WEST AVE', '3', '', '390009', '<p>aaa</p>', NULL, '2,', 29000, 4000, NULL, 0, 'new', '2024-11-22 09:49:15', '2024-11-22 09:49:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_sales_order_item`
--

CREATE TABLE `tech_sales_order_item` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `item_gst` double DEFAULT NULL,
  `sales_order_id` text,
  `item_type` text,
  `item_id` text,
  `item_qty` double DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `purchase_item_price` double DEFAULT NULL,
  `margin_item_price` double DEFAULT NULL,
  `item_description` longtext,
  `item_remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_sales_order_item`
--

INSERT INTO `tech_sales_order_item` (`id`, `vendor_id`, `item_gst`, `sales_order_id`, `item_type`, `item_id`, `item_qty`, `item_price`, `purchase_item_price`, `margin_item_price`, `item_description`, `item_remark`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 31, 28, '1', 'product', '7', 2, 14500, 12500, 4000, '<p>3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(2, 22, 28, '1', 'product', '7', 2, 14500, 12500, 4000, '<p>3 Year Warranty&nbsp;</p>', NULL, 1, 'active', NULL, NULL, NULL),
(3, 0, 18, '2', 'product', '6', 2, 28000, 25000, 6000, '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', NULL, 0, 'active', NULL, NULL, NULL),
(4, 0, 18, '3', 'service', '3', 1, 350, 0, 350, '<ul>\r\n<li>This is demo content 1</li>\r\n</ul>', NULL, 0, 'active', NULL, NULL, NULL),
(5, NULL, 18, '4', 'product', '11', 1, 1468000, 1462000, 0, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(6, 31, 18, '5', 'product', '11', 2, 15000, 12000, 6000, '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', NULL, 0, 'active', NULL, NULL, NULL),
(7, 28, 18, '5', 'product', '4', 5, 20000, 15000, 25000, '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', NULL, 0, 'active', NULL, NULL, NULL),
(8, 28, 18, '6', 'product', '12', 1, 54000, 51000, 3000, '<p>Core i3-10105T 10th Generaiton</p>\r\n<p>8 GB RAM</p>\r\n<p>256 GB SSD</p>\r\n<p>Windows 10 Pro</p>\r\n<p>21.5\" inch FHD Display</p>\r\n<p>No ODD</p>\r\n<p>3 Year Warranty</p>\r\n<p>Basic Stand/Camera</p>\r\n<p>Intel&reg; 3165 802.11ac dual band 1x1 + Bluetooth 4.2</p>\r\n<p>Wireless Keyboard and mouse</p>\r\n<p>&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL),
(9, 0, 28, '7', 'product', '7', 2, 14500, 12500, 4000, '<p>3 Year Warranty&nbsp;</p>', NULL, 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_sales_order_item_term_condition`
--

CREATE TABLE `tech_sales_order_item_term_condition` (
  `id` int(11) NOT NULL,
  `sales_order_id` varchar(50) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_sales_order_item_term_condition`
--

INSERT INTO `tech_sales_order_item_term_condition` (`id`, `sales_order_id`, `term_id`, `item_description`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, '1', 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(2, '1', 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 1, 'active', NULL, NULL, NULL),
(3, '2', 8, '<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 % or 28% Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention or 1 year warranty from OEM on Products&nbsp;( No Warranty on cable and cable laying )&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; The standard delivery period of CCTV Services is 4-7 Working&nbsp;days from the date of acceptance of purchase order by&nbsp; Tech Services&nbsp; ( (limited stock so please confirm with us stock Availability before order )</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 2 days from date of Quote or till stocks last, whichever is earlier</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</span></p>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customers are advised to pay materials costing on signing/accepting this term and order form and also to settle the full invoice amount on completion of installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">installation materials like Cable, cable laying , connectors&nbsp;,&nbsp;pipe, bend, clamp ,etc charges as per qunitituy used&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>For Installing the required scaffolding, ladder should be arranged by the customer.</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Monitor should be arranged by the customer during the installation to preview and confirm quality output on the premises.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Ensure that the Internet wiring access is near to the location of DVR/NVR.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Installation requires drilling holes in interior and exterior walls. Tech Services limits its liability to the patching of said holes and cannot be responsible for providing paint or wall coverings to match those colors or coverings existing within Customer\'s premises</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Additional Accessories like mouse, network cable, router, etc.,should be arranged by the customer before installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customer should make premises available without interruption during Tech Services\'s normal working hours, 10:00 A.M. to 6:30 P.M., Monday through Saturday, excluding holidays.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Civil &amp; Electrical Work , Jari work ,is in the Scope of the Customer</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases</span></p>\r\n<p><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote 123</span></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(4, '2', 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order ) 123</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(5, '4', 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(6, '5', 10, '<ul>\r\n<li><span style=\"font-size: 10pt;\"><strong>Payment&nbsp; &nbsp; &nbsp; &nbsp;:</strong> 100% Advance with Purchase Order</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>GST&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;18 % Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; &nbsp; :</strong> No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;5 - 6 Working Days (The equipment is accepted for the service on the condition that the repairs may be delayed if the required spare is not available with us or in the market These terms govern the provision of any computer support services (\"Services\") provided by TECH SERVICES)&nbsp;</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:</strong>&nbsp;&nbsp;3 days from date of Quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Order&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> Order once given will not be cancel and material once billed will not be taken back.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Quoted rates are approximate charges, actual repairing charges may vary &plusmn; 10%.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">There are 50% -50% chances of repairing. So, it may or may not repair, even after getting confirmation from your side.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">All Software\'s and Data are of client responsibility, please backup all the data before submitting for repair.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Data backup/ security is not our responsibility and if wanted than will be on extra cost ( without any guaranty )</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Maintenance and repairs will be on customer risk. If any machine /Laptop goes dead, we are not responsible for the same, no argument will be tolerated.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Collect material&nbsp;by yourself&nbsp;from our office between 11 am to 5 pm</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(7, '6', 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL),
(8, '7', 2, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_service`
--

CREATE TABLE `tech_service` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `title` text,
  `description` text,
  `service_category_id` text,
  `price` text,
  `code` text,
  `hsn_code` text,
  `gst` text,
  `image` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `created_by_user_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_service`
--

INSERT INTO `tech_service` (`id`, `vendor_id`, `title`, `description`, `service_category_id`, `price`, `code`, `hsn_code`, `gst`, `image`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`, `created_by_user_id`) VALUES
(1, NULL, 'Examination & certification of Lifting Tools & Tackles under Factories Act & Rules', '<ul>\r\n<li>Any capacity</li>\r\n<li>Industrial</li>\r\n<li>Pan India</li>\r\n<li>Made in India</li>\r\n</ul>', '1', '100', '', 'HSN123', '18', '6345831121570434582421-jpg-500x500.webp', NULL, 0, 'active', '2024-11-23 10:32:49', NULL, '1', '1'),
(2, NULL, 'Examination & certification of Lifting Machinery under Factories Act & Rules', '<ul>\r\n<li>Air Leakage Testing</li>\r\n<li>Chain Pulley etc.</li>\r\n<li>Lifting tools &amp; tackles</li>\r\n<li>testing &amp; inspection</li>\r\n<li>production and Manufacturing</li>\r\n<li>Personal Standard Certification</li>\r\n<li>Contractors</li>\r\n<li>on-site testing</li>\r\n<li>For certification under industrial health &amp; safety</li>\r\n</ul>', '1', '100', '', 'HSN123', '18', '555364880product-jpeg-500x500.webp', NULL, 0, 'active', '2024-11-23 10:38:28', NULL, '1', '1'),
(3, NULL, 'Examination & certification of Lift & Hoist under Factories Act & Rules', '', '1', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 10:40:21', '2024-11-23 10:40:31', '1', '1'),
(4, NULL, 'External Examination & certification of Pressure Vessels under Factories Act & Rules', '', '1', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:10:43', NULL, '1', '1'),
(5, NULL, 'Hydrostatic Testing & certification of Pressure Vessels under Factories Act & Rules', '', '1', '100', '', '123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:11:07', NULL, '1', '1'),
(6, NULL, 'Examination & certification of Dangerous Machine', '', '1', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:15:26', NULL, '1', '1'),
(7, NULL, 'Examination & certification of Press Machines', '', '1', '100', '', '123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:16:06', NULL, '1', '1'),
(8, NULL, 'Dust Collector Assembly Thermic Fluid Heater', '', '1', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:17:07', NULL, '1', '1'),
(9, NULL, 'Examination & certification of Ovens & Driers', '', '1', '100', '', 'HSN456', '18', NULL, NULL, 0, 'active', '2024-11-23 11:17:42', NULL, '1', '1'),
(10, NULL, 'Examination & certification of Paint Booth', '', '1', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:19:33', NULL, '1', '1'),
(11, NULL, 'Safety Interlock Examination', '', '1', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:20:02', NULL, '1', '1'),
(12, NULL, 'External Safety Audit Services as per IS14489:2018 Guidelines', '', '2', '100', '', '123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:23:40', '2024-11-23 11:23:54', '1', '1'),
(13, NULL, 'External Safety Audit factories Act & Rules', '', '2', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:24:53', NULL, '1', '1'),
(14, NULL, 'Environment Protection Act 1986', '', '2', '100', '', 'HSN123', '1', NULL, NULL, 0, 'active', '2024-11-23 11:25:40', NULL, '1', '1'),
(15, NULL, 'External Safety Audit PESO Act', '', '2', '100', '', 'HSN456', '1', NULL, NULL, 0, 'active', '2024-11-23 11:26:11', NULL, '1', '1'),
(16, NULL, 'Central Electricity Authority', '', '2', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:27:23', NULL, '1', '1'),
(17, NULL, 'External Safety Audit Mines Act', '', '2', '100', '', '123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:28:10', NULL, '1', '1'),
(18, NULL, 'External Safety Audit Boiler Act', '', '2', '100', '', 'HSN123', '4', NULL, NULL, 0, 'active', '2024-11-23 11:28:34', NULL, '1', '1'),
(19, NULL, 'External Safety Audit ISO Compliance Guidelines', '', '2', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:29:26', NULL, '1', '1'),
(20, NULL, 'Ultrasonic Flaw detection for metal surface & sub surface', '', '3', '100', '', 'HSN123', '1', NULL, NULL, 0, 'active', '2024-11-23 11:31:31', NULL, '1', '1'),
(21, NULL, 'Welded parts by  Certified person from American society of NDT', '', '3', '50000', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:32:08', NULL, '1', '1'),
(22, NULL, 'Dye/Liquid Penetrant Test by  Certified person from American society of NDT', '', '3', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:33:05', NULL, '1', '1'),
(23, NULL, 'Magnetic Particle Inspection by Certified person from American society of NDT', '', '3', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:33:31', NULL, '1', '1'),
(24, NULL, 'Building & Construction Act  Works', '', '4', '100', '', 'HSN456', '4', NULL, NULL, 0, 'active', '2024-11-23 11:34:16', NULL, '1', '1'),
(25, NULL, 'Export Import Certification Like Advance License', '', '5', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:38:19', NULL, '1', '1'),
(26, NULL, 'Chartered Engineer EPCG License', '', '5', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:38:47', NULL, '1', '1'),
(27, NULL, 'DBK1 Statement', '', '5', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:39:05', NULL, '1', '1'),
(28, NULL, 'Industrial Projects', '', '6', '100', '', '123', '1', NULL, NULL, 0, 'active', '2024-11-23 11:39:51', NULL, '1', '1'),
(29, NULL, 'Complience Audit Services', '', '7', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:40:42', '2024-11-23 11:40:48', '1', '1'),
(30, NULL, 'Ambient Air Monitoring Services', '', '8', '100', '', '123', '1', NULL, NULL, 1, 'active', '2024-11-23 11:41:47', NULL, '1', '1'),
(31, NULL, 'Workplace Air Monitoring services', '', '8', '100', '', 'HSN123', '4', NULL, NULL, 0, 'active', '2024-11-23 11:42:13', NULL, '1', '1'),
(32, NULL, 'Stack monitoring services', '', '8', '100', '', 'HSN456', '1', NULL, NULL, 0, 'active', '2024-11-23 11:42:42', NULL, '1', '1'),
(33, NULL, 'Noise Monitoring services', '', '8', '100', '', 'HSN456', '18', NULL, NULL, 0, 'active', '2024-11-23 11:43:06', NULL, '1', '1'),
(34, NULL, 'Illumination/Lux monitoring services', '', '8', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 11:43:50', NULL, '1', '1'),
(35, NULL, 'Drinking Water Sampling services', '', '8', '100', '', 'HSN123', '1', NULL, NULL, 0, 'active', '2024-11-23 11:44:10', NULL, '1', '1'),
(36, NULL, 'ETP/ STP water monitoring services', '', '8', '100', '', 'HSN123', '1', NULL, NULL, 0, 'active', '2024-11-23 11:45:07', NULL, '1', '1'),
(37, NULL, 'Soil Testing services', '', '8', '101', '', 'HSN456', '1', NULL, NULL, 0, 'active', '2024-11-23 11:45:25', NULL, '1', '1'),
(38, NULL, 'Pressure Gauge', '', '9', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 12:10:00', NULL, '1', '1'),
(39, NULL, 'Thermal Instruments', '', '9', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 12:10:25', NULL, '1', '1'),
(40, NULL, 'Calibration Mould', '', '9', '100', '', 'HSN123', '1', NULL, NULL, 0, 'active', '2024-11-23 12:10:53', NULL, '1', '1'),
(41, NULL, 'Dimensional Instrument', '', '9', '100', '', 'HSN456', '4', NULL, NULL, 0, 'active', '2024-11-23 12:11:21', NULL, '1', '1'),
(42, NULL, 'Weighing Instrument & machine calibration', '', '9', '100', '', 'HSN123', '4', NULL, NULL, 0, 'active', '2024-11-23 12:12:03', NULL, '1', '1'),
(43, NULL, 'MSRL Pipelines', '', '10', '100', '', 'HSN123', '1', NULL, NULL, 0, 'active', '2024-11-23 12:12:49', NULL, '1', '1'),
(44, NULL, 'Storage Tanks to Handle Slurry in mines', '', '10', '100', '', 'HSN456', '18', NULL, NULL, 0, 'active', '2024-11-23 12:13:14', NULL, '1', '1'),
(45, NULL, 'Acids in WTP', '', '10', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 12:13:45', NULL, '1', '1'),
(46, NULL, 'CPU DM plant', '', '10', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 12:14:02', NULL, '1', '1'),
(47, NULL, 'Chemical process', '', '10', '100', '', 'HSN456', '4', NULL, NULL, 0, 'active', '2024-11-23 12:14:26', NULL, '1', '1'),
(48, NULL, 'Sandblasting & Painting Services Services at Project Level', '', '11', '100', '', 'HSN123', '18', NULL, NULL, 0, 'active', '2024-11-23 12:15:03', NULL, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_service_category`
--

CREATE TABLE `tech_service_category` (
  `id` int(11) NOT NULL,
  `title` text,
  `img` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_service_category`
--

INSERT INTO `tech_service_category` (`id`, `title`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Inspection & certification', NULL, 'inspection-certification', 0, 'active', '2024-11-23 10:29:28', NULL, '1'),
(2, 'External Safety Audit ', NULL, 'external-safety-audit', 0, 'active', '2024-11-23 11:22:57', '2024-11-23 11:25:01', '1'),
(3, 'NDT Testing & Certification', NULL, 'ndt-testing-certification', 0, 'active', '2024-11-23 11:30:05', NULL, '1'),
(4, 'Third Party Inspection', NULL, 'third-party-inspection', 0, 'active', '2024-11-23 11:33:49', NULL, '1'),
(5, 'Chartered Engineer certification', NULL, 'chartered-engineer-certification', 0, 'active', '2024-11-23 11:34:38', NULL, '1'),
(6, 'Technical Audit', NULL, 'technical-audit', 0, 'active', '2024-11-23 11:39:26', NULL, '1'),
(7, 'Third Party', NULL, 'third-party', 0, 'active', '2024-11-23 11:40:22', NULL, '1'),
(8, 'Environment Monitoring', NULL, 'environment-monitoring', 0, 'active', '2024-11-23 11:41:27', NULL, '1'),
(9, 'Calibration', NULL, 'calibration', 0, 'active', '2024-11-23 12:09:34', NULL, '1'),
(10, 'Rubber Lining', NULL, 'rubber-lining', 0, 'active', '2024-11-23 12:12:29', NULL, '1'),
(11, 'Sandblasting & Painting', NULL, 'sandblasting-painting', 0, 'active', '2024-11-23 12:14:42', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_term_condition`
--

CREATE TABLE `tech_term_condition` (
  `id` int(11) NOT NULL,
  `title` longtext,
  `description` longtext,
  `img` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_term_condition`
--

INSERT INTO `tech_term_condition` (`id`, `title`, `description`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Sales Terms 2022', '<ul>\r\n<li>\r\n<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong>&nbsp;<strong>Now onwards billing will be done against advance / same day Payment, No Credit.</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 % or 28% Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 4 to 5 Working Days&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 2 days from date of Quote or till stocks last, whichever is earlier</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Collect material by yourself from our office between 11 am to 5 pm</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span></p>\r\n</li>\r\n<li><span style=\"font-size: 10pt;\">Cable,Cable laying and other Charges&nbsp;as per quantity used.</span></li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Installation and Configuration charges Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></p>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>', '5601image.png', 'sales-terms-2022', 1, 'active', '2021-09-04 09:48:26', '2022-04-13 17:06:21', '1'),
(2, 'Sale Terms & condition', '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n<p>&nbsp;</p>\r\n</li>\r\n</ul>', '3846picture-5.png', 'sale-terms-condition', 0, 'active', '2021-09-04 09:50:14', '2021-12-14 08:57:13', '1'),
(3, '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', NULL, NULL, 'ul-li-p-strong-payment-nbsp-nbsp-nbsp-nbsp-strong-strong-nbsp-100-nbsp-advance-with-purchase-order-strong-p-li-li-p-strong-gst-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-strong-nbsp-18-nbsp-extra-p-li-li-p-strong-warranty-nbsp-nbsp-strong-nbsp-mention-or-1-year-nbsp-warranty-from-oem-p-li-li-p-strong-delivery-nbsp-nbsp-nbsp-strong-nbsp-1-nbsp-to-2-nbsp-working-weeks-nbsp-strong-limited-stock-so-please-confirm-with-us-stock-availability-and-price-before-order-strong-p-li-li-p-strong-validity-nbsp-nbsp-nbsp-strong-nbsp-price-valid-till-7-nbsp-nbsp-days-from-date-of-quote-or-till-stocks-last-whichever-is-earlier-p-li-li-p-strong-nbsp-order-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-nbsp-strong-nbsp-nbsp-order-once-given-will-not-be-cancel-and-material-once-billed-will-not-be-taken-back-p-li-li-p-collect-material-by-yourself-from-our-office-between-11-am-to-5-pm-p-li-ul', 1, 'active', '2021-12-08 11:19:56', NULL, '1'),
(4, 'Inquiry Terms', NULL, NULL, 'inquiry-terms', 1, 'active', '2021-12-08 11:21:04', NULL, '1'),
(5, 'sfsdf', '<p>&nbsp;sdfsdfsd</p>', NULL, 'sfsdf', 1, 'active', '2021-12-08 11:21:32', NULL, '1'),
(6, 'Inquiry Terms & condition', '<ul>\r\n<li>\r\n<p><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 %&nbsp; Extra</p>\r\n</li>\r\n<li>\r\n<p><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention Or 1 Year&nbsp;warranty from OEM</p>\r\n</li>\r\n<li>\r\n<p><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; 1&nbsp;to 2&nbsp;Working Weeks&nbsp;<strong>( limited stock so please confirm with us stock Availability and Price before order )</strong></p>\r\n</li>\r\n<li>\r\n<p><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 7&nbsp;&nbsp;days from date of Quote or till stocks last, whichever is earlier</p>\r\n</li>\r\n<li>\r\n<p><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</p>\r\n</li>\r\n<li>\r\n<p>Collect material by yourself from our office between 11 am to 5 pm</p>\r\n</li>\r\n</ul>', NULL, 'inquiry-terms-condition', 1, 'active', '2021-12-08 11:22:09', '2021-12-08 11:22:25', '1'),
(7, 'Software ', '<ul>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong>100% &nbsp;Advance with Purchase Order&nbsp;Now</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Warranty / Subscription :</strong>&nbsp;1 Year Subscription</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>TAX (GST ) :</strong>&nbsp;Tax will be extra as Applicable</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">The prices are in INR and are Unit Basic Prices.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Price Validity :</strong> Valid till 7 Days from date of Quote or till stocks last , whichever is earlier&nbsp;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:&nbsp;</strong> 7&nbsp;to 10&nbsp;Working Days&nbsp;( limited stock so please confirm with us stock Availability and Price before order )</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Autodesk , Adobe , &nbsp;Microsoft, Symantec : Paper License delivery mode is E-License which shall be delivered to your email</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Installation Charges :</strong>&nbsp; Installation and Configuration charges Extra&nbsp;as Actual&nbsp;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">All Back to back&nbsp;license orders are&nbsp;non- cancellable&nbsp;unless approved by authorized MS personnel as per RMA policy with applicable cancellation charges.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">All&nbsp;GGS legalization&nbsp;License SKU orders are non- cancellable. GGS orders to be placed as separate order and the SKU once placed cannot be&nbsp;processed for Cancellation under the RMA policy.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">O365 Policy:&nbsp; Customer can order multiple O365 M SKUs on a single purchase order. No returns are allowed after any of the O365 M SKUs on a single purchase order are redeemed. Once the OSA Key is redeemed, no return will be accepted - even if the customer hasn\'t assigned all seats represented by that Dynamic SKU purchase. Pls. read these terms carefully and explain this policy to end customers before accepting O365 Mid-market orders.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Prices are subject to change depending on the changes in taxation structure prevailing in various states from time to time.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Please note that as per&nbsp;Microsoft Policy, Multi-Tier Orders need to be pre-approved by them.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">We need following declaration with every PO for Multitier confirmation and non-cancellable clause.</span></span><br /><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&ldquo;We confirm that this PO&nbsp;is directly placed on us by End Customer&ldquo;</span></span><br /><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&ldquo;We agree that&nbsp;License Order&nbsp; once placed is Non-cancellable.&rdquo;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">As per new Microsoft compliance policy, PO should have same Part Number, Description, Qty and Pricing details</span></span></p>\r\n</li>\r\n<li><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">You must have a&nbsp;<em>minimum</em>&nbsp;initial purchase of&nbsp;<em>five</em>&nbsp;software&nbsp;<em>licenses</em>&nbsp;for an Open&nbsp;<em>License</em>&nbsp;agreement</span></span></li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&nbsp;Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></span></p>\r\n</li>\r\n</ul>', NULL, 'software', 1, 'active', '2022-04-13 17:02:14', '2022-04-13 17:03:36', '1'),
(8, 'CCTV and Networking', '<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 % or 28% Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention or 1 year warranty from OEM on Products&nbsp;( No Warranty on cable and cable laying )&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; The standard delivery period of CCTV Services is 4-7 Working&nbsp;days from the date of acceptance of purchase order by&nbsp; Tech Services&nbsp; ( (limited stock so please confirm with us stock Availability before order )</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 2 days from date of Quote or till stocks last, whichever is earlier</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</span></p>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customers are advised to pay materials costing on signing/accepting this term and order form and also to settle the full invoice amount on completion of installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">installation materials like Cable, cable laying , connectors&nbsp;,&nbsp;pipe, bend, clamp ,etc charges as per qunitituy used&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>For Installing the required scaffolding, ladder should be arranged by the customer.</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Monitor should be arranged by the customer during the installation to preview and confirm quality output on the premises.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Ensure that the Internet wiring access is near to the location of DVR/NVR.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Installation requires drilling holes in interior and exterior walls. Tech Services limits its liability to the patching of said holes and cannot be responsible for providing paint or wall coverings to match those colors or coverings existing within Customer\'s premises</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Additional Accessories like mouse, network cable, router, etc.,should be arranged by the customer before installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customer should make premises available without interruption during Tech Services\'s normal working hours, 10:00 A.M. to 6:30 P.M., Monday through Saturday, excluding holidays.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Civil &amp; Electrical Work , Jari work ,is in the Scope of the Customer</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Project management , Documentation and&nbsp;Certification Charges&nbsp;Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">All other incidentals like traveling, food, accommodation, stay &amp; other expenses to be provide by the client.</span></p>\r\n</li>\r\n</ul>', NULL, 'cctv-and-networking', 1, 'active', '2022-04-13 17:04:41', NULL, '1'),
(9, 'AMC', '<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>AMC Time Period :</strong>&nbsp;Contract will be for 12 months.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST :</strong>&nbsp;prices are Exclusive of 18% GST. Or any change in govt. Taxes</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment Terms :</strong>&nbsp;Yearly Full amount has to be paid in advance</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Valid Till :</strong>&nbsp;Price valid till 7&nbsp;days from date of Quote</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The above said contract Does not include any spares(Contract is without spares)</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Consumer Like LED, CD/DVD Drive / Keyboard / Mouse &ndash; Touch pad (Laptop &ndash; Desktop) , Printer Toner, Fusor Assembly, paper feeder assembly will not be consider under AMC</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The calls will be attended within 24&nbsp;Working hours from loging&nbsp;complaints</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">First Remote Support if gets solved remotely then will complete call remotely, else will visit</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The complaints will be attended from 10:30&nbsp; a.m. to 6.p.m. except Sundays, public holidays.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">This Annual Maintenance Contract does not include shifting of equipment.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Software should be provided by user / customer.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Hardware calls will do diagnosis, but spares will be on Actual cost</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">All software / Antivirus /Data backup protection will be in your scope</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The above mentioned contract does not include the data entries, software customization, data corruption, data recovery or lost data due to virus attacks if any. However, we ensure that all necessary steps will be taken to ensure proper functioning of the system.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Internet Problem / Printer Problem / CCTV Problem / Network Problem will be in your scope</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Networking, Cabling, Switches, Router, Mail will not be covered under AMC.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">In case the problem is not solved at site the Client has to bear the cost of transportation &amp; duties (if applicable).</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Should any unauthorized person be permitted to access the database or installed applications, software/hardware under agreement and in the event of failures, support shall be on chargeable basis.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Server migration from OLD to NEW Hardware&nbsp; , Server Support&nbsp;&nbsp;will be charged as extra.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Additional maintenance of systems purchased during the year will have to be done with additional cost of Non- Comprehensive AMC Charges.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">&nbsp;This Annual Maintenance Contract does not include shifting and reinstallation of equipment.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>We will survey your site First, after discuss and solve Current problems and Parts issue, then we will take AMC</strong></span></p>\r\n</li>\r\n</ul>', NULL, 'amc', 0, 'active', '2022-04-13 17:05:08', NULL, '1'),
(10, 'Reparing', '<ul>\r\n<li><span style=\"font-size: 10pt;\"><strong>Payment&nbsp; &nbsp; &nbsp; &nbsp;:</strong> 100% Advance with Purchase Order</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>GST&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;18 % Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; &nbsp; :</strong> No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp; &nbsp; :</strong> &nbsp;5 - 6 Working Days (The equipment is accepted for the service on the condition that the repairs may be delayed if the required spare is not available with us or in the market These terms govern the provision of any computer support services (\"Services\") provided by TECH SERVICES)&nbsp;</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;:</strong>&nbsp;&nbsp;3 days from date of Quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\"><strong>Order&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong> Order once given will not be cancel and material once billed will not be taken back.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Quoted rates are approximate charges, actual repairing charges may vary &plusmn; 10%.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">There are 50% -50% chances of repairing. So, it may or may not repair, even after getting confirmation from your side.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">No Warranty on repairing.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">All Software\'s and Data are of client responsibility, please backup all the data before submitting for repair.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Data backup/ security is not our responsibility and if wanted than will be on extra cost ( without any guaranty )</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Maintenance and repairs will be on customer risk. If any machine /Laptop goes dead, we are not responsible for the same, no argument will be tolerated.</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Collect material&nbsp;by yourself&nbsp;from our office between 11 am to 5 pm</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span><br /><span style=\"font-size: 10pt;\">&nbsp;</span></li>\r\n<li><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></li>\r\n</ul>', NULL, 'reparing', 1, 'active', '2022-04-13 17:08:29', NULL, '1');
INSERT INTO `tech_term_condition` (`id`, `title`, `description`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(11, 'PO TERMS AND CONDITIONS', '<p style=\"text-align: left;\"><strong><span style=\"font-size: 10pt;\">1. Definitions:</span></strong><br /><span style=\"font-size: 10pt;\">As used herein, the following terms shall have the following meanings. \"Agreement\" shall mean these</span><br /><span style=\"font-size: 10pt;\">Service Order Terms and Conditions and any project-specific or additional terms and conditions set forth</span><br /><span style=\"font-size: 10pt;\">on the purchase order issued in connection with the Agreement or the Scope of Work attached as an</span><br /><span style=\"font-size: 10pt;\">exhibit to the Agreement, superseding all prior agreements and understandings, oral or written, not</span><br /><span style=\"font-size: 10pt;\">expressly incorporated herein. \"Company\" shall mean the entity set forth on the purchase order that</span><br /><span style=\"font-size: 10pt;\">receives Services, for the sake of this Service order the Company shall means Matrix Comsec Private</span><br /><span style=\"font-size: 10pt;\">Limited (hereinafter referred to as \"Company\"). \"Supplier\" shall mean the entity set forth on the purchase</span><br /><span style=\"font-size: 10pt;\">order that provides Services. \"Services\" shall mean the services provided to Company by Supplier as set</span><br /><span style=\"font-size: 10pt;\">forth on the purchase order issued in connection with the Agreement or the Scope of Work attached as an</span><br /><span style=\"font-size: 10pt;\">exhibit to the Agreement. \"Scope of Work\" shall mean the Services described in the Scope of Work</span><br /><span style=\"font-size: 10pt;\">attached as Exhibit A to the Agreement, if any.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>2. Acceptance and Modification:</strong><br />Commencement of the Services or delivery of goods called for by the Agreement in the absence of<br />Supplier\'s written acknowledgment shall be deemed acceptance of the Agreement. By acceptance of the<br />Agreement, Supplier agrees to be bound by and to comply with all these Service Order Terms and<br />Conditions, and all specifications and other documents referred to in the Agreement. No additions to or<br />variations from the terms herein shall be binding unless agreed to, in writing, by Company. If Supplier\'s<br />quotation is incorporated in the Agreement, it is made a part of the Agreement only to the extent of<br />specifying the nature and description of the Services to be performed, and then only to the extent such<br />terms are consistent with the other terms herein. ANY ADDITIONAL OR DIFFERENT TERMS OR<br />CONDITIONS WHICH MAY APPEAR IN ANY QUOTATION, PROPOSAL OR COMMUNICATION<br />FROM SUPPLIER OR IN SUPPLIER\'S ACKNOWLEDGEMENT OR SIGNED RETURN OF THE<br />AGREEMENT ARE HEREBY EXPRESSLY OBJECTED TO, SHALL NOT BECOME PART OF THE<br />AGREEMENT DESPITE COMPANY\'S ACCEPTANCE OF SUPPLIER\'S PERFORMANCE OF<br />SERVICES OR GOODS AND SHALL NOT BE EFFECTIVE OR BINDING UNLESS SPECIFICALLY<br />RECOGNIZED, ASSENTED TO AND AGREED TO IN WRITING BY COMPANY.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>3. Prices:</strong><br />All prices shall be firm unless otherwise stated in the purchase order issued in connection with the<br />Agreement. No payment in excess of any monetary limitation appearing in the purchase order shall be<br />permitted without the prior written approval of the Company. Pricing shall not be adjusted except with<br />prior written approval of the Company.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>4. Extra Charges:</strong><br />No charges of any kind, including, but not limited to charges for boxing, packing, loading, bracing or<br />cartage shall be allowed unless specifically stated in the purchase order issued in connection with the<br />Agreement.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>5. Transportation:</strong><br />Transportation requirements, if applicable, shall be as set forth in the purchase order issued in connection<br />with the Agreement. Notwithstanding the stated F.O.B. point, Supplier shall be responsible for any loss<br />or damage occurring to goods during transit when such loss or damage is attributable either to an act or<br />omission of Supplier or its contractors, or to a failure of either Supplier or its contractors to adhere to the<br />express shipping instructions of Company.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>6. Warranties:</strong><br />Supplier warrants that<br />a) all goods and/or Services sold pursuant hereto shall be free of any claim by any third person and that<br />Supplier shall convey clear title to Company;<br />b) all Services furnished hereunder shall be performed by technically competent and qualified personnel<br />in a safe and workmanlike manner, shall conform to the requirements of the Agreement including any<br />Scope of Work attached as an exhibit to the Agreement, shall be performed in accordance with generally<br />accepted professional standards associated with the particular industry, trade, and/or discipline involved<br />and shall be fit for the purpose for which intended;<br />c) all goods sold pursuant hereto shall be of new (unless expressly specified otherwise) merchantable<br />quality, free from all defects in design, workmanship and materials, fit for the particular purpose(s) for<br />which purchased and provided in strict accordance with the specifications, samples, drawings, designs<br />and other requirements (including performance specifications) of the Agreement;<br />d) all Services shall be performed in strict accordance with all applicable laws, regulations, codes, and<br />standards of any governmental agency or entity having jurisdiction; and<br />e) Supplier has all required permits and licenses necessary to perform the Services and that the Services<br />shall conform with all applicable permits and licenses. Copies of such permits or licenses shall be<br />provided to Company upon request. Supplier shall promptly notify Company in writing in the event any<br />permit or license related to this Supplier or to Supplier\'s authorization or capacity to perform Services<br />hereunder is revoked or has expired. For goods, if at any time prior to one (1) year from the date that the<br />goods are first used for the purposes intended by Company or two years from the date of final acceptance<br />by Company, whichever occurs first, it appears that the goods or any part thereof do not conform to these<br />warranties and Company so notifies Supplier within a reasonable time after such discovery, Supplier, at<br />its sole expense and after obtaining Company\'s concurrence, shall promptly correct such nonconformity<br />or replace the nonconforming goods. The warranty period for such corrected or replaced goods shall be<br />of an equal duration as the original warranty period and shall commence upon acceptance of such<br />corrected or replaced goods. For Services, if at any time prior to one (1) year from the date that the<br />Services are completed, it appears that the Services do not conform to these warranties and Company so<br />notifies Supplier within a reasonable time after such discovery, Supplier, at its sole expense and after<br />obtaining Company\'s concurrence, shall promptly correct such nonconformity. The warranty period for<br />such corrected Services shall be of an equal duration as the original warranty period and shall commence<br />upon acceptance of such corrected Services. If Supplier fails to fulfill its obligations under this<br />paragraph, Company may proceed to make corrections or accomplish the Services by the most<br />expeditious means available, and the cost of cover or correction performed by Company shall be for<br />Supplier\'s account. Company shall not be billed for any task(s) performed unsatisfactorily or defective<br />parts, materials and equipment and shall be reimbursed within thirty (15 ) days by Supplier upon demand<br />of Company if an invoice has been previously paid for such improper or defective Services or goods&nbsp;Any and all expenses (including, but not limited to shipping, manufacturing and labor expenses) incurred<br />by Company in the exercise of its right hereunder, at law and/or in equity, shall be reimbursed by<br />Supplier.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>7. Time is of the Essence, Delivery:</strong><br />Timely performance of the Services is of the essence. If any Services are not performed within the time<br />specified in the purchase order issued in connection with the Agreement or within a reasonable time if no<br />time is so specified, Company may refuse to have Seller perform such Services and cancel the<br />Agreement and shall be relieved of all liability for such Services and related goods. Any additional<br />transportation charges incurred to comply with the time specified in the purchase order issued in<br />connection with the Agreement in excess of those which would apply for the usual means of<br />transportation shall be for the account of Supplier.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>8. Company\'s Property:</strong><br />Unless otherwise agreed in writing, all tools, equipment or material of every description furnished to<br />Supplier by Company or specifically paid for by Company and any replacement thereof, or any materials<br />affixed or attached thereto, shall be and remain the property of the Company. Such property<br />i) shall be clearly marked and identified as property of the Company and shall be safely stored separate<br />and apart from Supplier\'s property;<br />ii) shall not be used except in the performance of the Services hereunder and Supplier shall not substitute<br />any property for Company\'s property;<br />iii) shall be held at Supplier\'s risk, and kept insured by Supplier at Supplier\'s expense in an amount equal<br />to the replacement cost with loss payable to Company; and<br />iv) shall be delivered to Company promptly upon its written request, in which event Supplier shall<br />prepare such property for shipment and shall deliver to Company in the same condition as originally<br />received by Supplier, reasonable wear and tear excepted, all at Supplier\'s expense.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>9. Changes:</strong><br />Company may, at any time, and from time to time, by written change order direct or order any changes,<br />additions or deletions in the Services and related goods to be supplied hereunder. If such changes,<br />additions, or deletions affect the Supplier\'s time for performance or price, Supplier shall promptly notify<br />Company and, if appropriate, an adjustment in the time for performance and or price shall be negotiated.<br />Failure to notify Company in writing within fifteen (3 5) days of receipt of the change order requesting<br />such change, addition or deletion shall result in a waiver by Supplier of such adjustment</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>10. Suspension:</strong><br />Company may suspend all or any part of the Services by written notice to Supplier. Supplier agrees to<br />resume any suspended Services as soon as practicable after receipt of written instructions to do so from<br />Company. Upon suspension of Services, Supplier agrees to waive all claims for damages, including<br />claims associated with the loss of use of or underutilization of Supplier\'s labor and facilities and the<br />associated overheads thereon. If Supplier\'s costs for completing the Services are increased over the costs<br />Supplier would have incurred had the Services not been suspended, Supplier agrees to accept as its sole<br />remedy for the suspension of the Services the amount of such increase.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>11. Termination:</strong><br />Company may terminate all or any part of the Services by ten (10) days written notice to Supplier. Upon<br />such termination, Supplier agrees to waive all claims for damages, including claims for loss of<br />anticipated profits and claims for the loss of use or underutilization of Supplier\'s labor, facilities and<br />equipment and the associated overheads thereon, and to accept as its sole remedy for termination the cost<br />of all Services performed and payment for goods delivered and accepted by Company prior to the date of<br />termination and reasonable costs incurred by Supplier in terminating the Services. Termination shall not<br />relieve Supplier of any of its obligations for Services already performed or for goods delivered<br />hereunder, including but not limited to complying with all applicable warranties associated with such<br />goods or Services.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>12. Non-Assignment, Subcontracting:</strong><br />Any assignment by Supplier of its rights (other than an assignment of the right to receive payment<br />hereunder) under the Agreement in any manner, in whole or in part, by operation of law or otherwise,<br />without the prior written consent of Company shall be void. Supplier shall not subcontract or delegate<br />performance of all or any part of the Services without the prior written consent of Company.</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>13. Set-Off:</strong><br />Company shall be entitled to set-off any amount owed at any time by Supplier, or its affiliate(s) to<br />Company or its affiliate(s) against any amount owed by Company or its affiliate(s) to Supplier.<br /><br /><strong>14. Applicable Law &amp; Jurisdiction:</strong><br />The Agreement shall be governed by and construed in accordance with the applicable laws of India,<br />except for those laws governing conflict and choice of law and the Courts of Vadodara, Gujarat, India<br />shall have exclusive jurisdiction to adjudicate the disputes pertaining to the contractual terms referred in<br />the said service order.<br /><br /><strong>15. Indemnification:</strong><br />Supplier assumes full responsibility for and agrees to save, indemnify, defend and hold harmless<br />Company and its affiliates from any and all claims, losses, liabilities, damages to property, injuries<br />(including, but not limited to, death) to persons (including, but not limited to, employees of Supplier and<br />Company), fines, penalties, fees (including, but not limited to, reasonable legal fees), and all other costs<br />and expenses of whatsoever kind or nature to the extent caused by the acts or omissions or misconduct or<br />failure of Supplier, its directors, officers, employees, agents, subcontractors and/or sub vendors at any<br />tier.<br /><br /><strong>16. Intellectual Property:</strong><br />Supplier shall indemnify, defend and hold harmless Company against any and all liabilities, damages,<br />losses, claims, suits, and proceedings brought against Company arising out of, based upon or resulting<br />from any claim alleging, whether rightful or otherwise, that any design, goods or Services furnished or&nbsp;delivered under the Agreement by Supplier or at the direction of Supplier infringes upon any United<br />States patent, copyright or other intellectual property right (\"Indemnified Claim\"). Supplier shall pay all<br />damages, expenses, fees and costs, including legal fees, awarded against Company in connection with<br />any such Indemnified Claim. In case any design, product or Services are held to constitute an intellectual<br />property infringement and the use of such design, product or Services is enjoined, Supplier shall, at its<br />sole expense, after obtaining the written concurrence of Company,<br />a) procure for Company the right to continue using the effected design, goods or Services,<br />b) replace the effected design, goods or Services with substantially equal but non-infringing design,<br />goods or Services, or<br />c) modify the design or Services so they become non-infringing. If none of these alternatives is available<br />on commercially reasonable terms, Company shall have the option to terminate the Agreement applicable<br />to the Indemnified Claim upon providing written notice to Supplier.<br /><br /><strong>17. Insurance:</strong><br />Supplier shall obtain and maintain for the duration of any Services insurance in forms and amounts<br />satisfactory to Company which may include, but not necessarily be limited to: Commercial General<br />Liability (CGL) (including Contractual Liability coverage insuring the liabilities assumed herein) and<br />property damage Automobile Liability and Employers\' Liability insurance; statutorily required Worker\'s<br />Compensation and Employers\' Liability insurance; Excess Liability insurance endorsed to apply on at<br />least as \"broad as primary basis\" covering loss in excess of the limits of other insurance policies required<br />herein.<br /><br /><strong>18. Compliance with Laws:</strong><br />Supplier shall ascertain and comply with all applicable State, and local laws, regulations, and ordinances,<br />as amended and Supplier agrees that it and all who act on their behalf shall fully and faithfully comply<br />with all the relevant laws, and with all applicable trade or industry codes, regulations and standards.<br /><br /><strong>19. Safety:</strong><br />Supplier shall perform its Services in a safe manner so as to prevent damage, injury or loss to any<br />individuals. Supplier assumes responsibility for implementing and monitoring all safety precautions and<br />programs related to the performance of the Services. In the performance of the Services, Supplier shall<br />comply, and cause its subcontractors to comply, with all statutes, regulations and ordinances relating to<br />safety, as well as any specific safety policies and requirements required by Company.<br /><br /><strong>20. Proprietary Information - Confidentiality:</strong><br />Supplier shall keep confidential any technical, process or economic information derived from drawings,<br />specifications and prototype articles, and other data furnished by Company or Supplier learns during the<br />performance of the Services and shall not divulge, export, or use, directly or indirectly, such information<br />for the benefit of any other party without obtaining Company\'s prior written consent. Except as required<br />for the efficient performance of the Services, Supplier shall not use such information or make copies or<br />permit copies to be made of such drawing\'s specifications, or other data without the prior written consent<br />of Company. Upon request of Company, Supplier shall promptly return to Company all materials and any<br />copies thereof; such request may be made at any time during or after completion of the Services. The<br />obligations under this paragraph shall survive the cancellation, termination, or completion of the<br />Agreement. Supplier shall not advertise or publish the fact that Company has contracted for services<br />from Supplier without prior written permission from Company. Any inventions, processes or other<br />patentable or marketable idea or product developed as a result of Supplier\'s performance of the Services<br />hereunder shall become the exclusive property of Company, and Supplier shall deliver all data, drawings<br />and other documents associated with such development to Company upon completion of the Services.<br /><br /><strong>21. Disclosure of Knowledge or Information:</strong><br />Any knowledge or information which Supplier shall have disclosed or may hereafter disclose to<br />Company in connection with a request for a quotation or the purchase of goods or Services covered by<br />the Agreement, shall not, unless otherwise specifically agreed upon in writing by Company, be deemed<br />to be confidential or proprietary information, and shall be acquired free from any restrictions other than a<br />claim for patent infringement as part of the consideration for the Agreement.<br /><br /><strong>22. Drawings:</strong><br />Unless otherwise specifically agreed in writing by Company any check or approval of drawings by<br />Company shall be for Supplier\'s convenience and shall not relieve Supplier of its responsibility to meet<br />all requirements of the Agreement.<br /><br /><strong>23. Consequential Damages:</strong><br />Neither Company nor Suppler shall be liable to the other for consequential damages of any kind,<br />including, but not limited to, loss of anticipated profits or loss of use of or underutilization of labor,<br />facilities or equipment resulting from performance or nonperformance of its obligations under the<br />Agreement or in the event of Suspension or Termination of the Services pursuant to paragraphs 11 and<br />12 respectively.<br /><br /><strong>24. Technical Data:</strong><br />All materials and documents prepared or developed by Supplier in connection with the performance of<br />this Order, including all manuals, data, designs, drawings, plans, specifications, reports, calculations and<br />summaries, shall become the property of Company when prepared, whether delivered to Company or not,<br />and shall, together with any materials and documents furnished to Supplier by Company, be delivered to<br />Company upon request and, in any event, upon termination or completion of this Order.<br /><br /><strong>25. Force Majeure:</strong><br />Neither party shall be liable to the other for default, failure or delay in providing or accepting goods or<br />Services hereunder if such failure is caused by an extraordinary event or occurrence beyond that party\'s<br />control such as fire, accident, strike, civil disturbance, war, act of terrorism, act of God, embargo,<br />governmental order or regulation, flood, windstorm, explosion, riots, natural disaster, sabotage or any<br />other similar or different contingency beyond the reasonable control of the Company or Supplier, as<br />applicable. Written notice of such delay, including the anticipated duration of the delay, must be given by<br />the nonperforming party within ten (10) days of the event. During the period of any delay or failure to<br />perform by Supplier, Company may purchase goods or procure Services from other sources and<br />proportionally reduce its obligations to Supplier for such goods and/or Services. If requested by<br />Company, Supplier shall, within five (5) days of such request, provide adequate assurance that the delay<br />shall not exceed such period of time as Company deems appropriate. If the delay lasts more than the time<br />period specified by Company, or Supplier does not provide adequate assurance that the delay shall cease<br />within such time period, Company may, among its other remedies, immediately terminate the Agreement<br />without liability.</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\"><strong>26. Non-Waiver:</strong><br />Failure or delay of either Company or Supplier to insist upon strict performance of any of the terms and<br />conditions hereof, or to exercise any rights or remedies provided herein or by law, or to properly notify<br />the other party in the event of breach, or Company acceptance of or payment for any goods or Services or<br />approval of any design, shall not release the other party from any of the warranties or obligations of the<br />Agreement and shall not be deemed a waiver of any right of a party to insist upon strict performance<br />hereof, or of any rights or remedies of a party as to any such services or goods (including the right to<br />reject nonconforming goods or to revoke acceptance of such goods) regardless of when performed,<br />shipped, received or accepted, or of any right or remedy of a party as to any prior or subsequent default<br />hereunder.<br /><br /><strong>27. Payment Terms:</strong><br />Company shall pay Supplier in accordance terms set forth in the purchase order issued in connection with<br />the Agreement, on receipt of a complete correct and conforming invoice therefor.<br /><br /><strong>28. Records:</strong><br />Unless the Services are totally priced on a firm fixed price basis, Supplier shall maintain time records,<br />supplier invoices, expense receipts/costs and supporting data and other evidence related to the Services<br />in accordance with generally accepted accounting procedures and practices. All materials shall be<br />preserved until the expiration of two years from the completion of the Services. Company shall have the<br />right at any time during normal business hours to examine such records which may involve the Services,<br />or which shall permit adequate evaluation of the costs and fee data related thereto. Adjustments in favor<br />of Company arising from any audit performed by Company shall be recognized as an adjustment of any<br />future payment due Supplier or, if no future payment is due Supplier, Supplier shall pay the amount of<br />any such adjustment to Company within thirty (15 ) days after completion of the audit.<br /><br /><strong>29. Independent Contractor:</strong><br />Supplier is and shall remain for all purposes an independent contractor, and it shall have no power, nor<br />shall it represent that it has any power, to bind Company or to assume or create any obligation, expressed<br />or implied, on behalf of Company.<br /><br /><strong>30. Notices:</strong><br />Unless notified otherwise, in writing, by Company, all notices required under the Agreement shall be<br />sent to the address/email addresses set forth in the purchase order issued in connection with the<br />Agreement.<br /><br /><strong>31. Survival of Terms:</strong><br />Those provisions of the Agreement which by their very nature are incapable of being performed or<br />enforced prior to expiration or termination of the Agreement or which suggest at least partial<br />performance or enforcement following such expiration or termination shall survive any such expiration<br />or termination of the Agreement.<br /><br /><strong>32. Company\'s Remedies:</strong><br />All rights and remedies provided for herein are not exclusive and all rights and remedies of Company<br />hereunder, at law or in equity, shall be cumulative and may be exercised singly or concurrently.<br /><br /><strong>33. GST Law:</strong><br />In the GST regime the below mentioned Terms and Conditions shall be applicable, including those<br />mentioned above:<br />33(1) Current taxes being reflected in the terms and conditions like Central Excise/ Service Tax /VAT/<br />CST, Entry tax, LBT, Octroi, etc.(other taxes to be subsumed in GST) to be replaced with SGST,<br />UTGST, CGST, IGST, GST Compensation Cess as applicable.<br />33(2) Payment Terms:<br />Vendor to confirm that the GST amount charged in invoice is declared in its GSTR-1 and GSTR-3 and<br />payment of taxes has been made.<br />33(3) Tax Indemnity clause:<br />Declaration/ Self Certificate stating that Taxes which have been collected/ with-held on behalf of<br />TECH SERVICES have been duly paid/ will be paid to the Government account within the due dates specified<br />under various Tax Laws in India and Rules made there under. It may please be noted that if TECH SERVICES is<br />not able to avail any tax credit due to any short coming on the part of the vendor (which otherwise should<br />have been available to TECH SERVICES in the normal course), then the vendor at his own cost and effort will<br />get the short coming rectified. If for any reason the same is not possible, then the vendor will make<br />good the loss suffered by TECH SERVICES due to the tax credit it lost in that transaction. Any shortcoming shall<br />be communicated byTECH SERVICES to vendor and the vendor shall take prompt action to rectify the same.<br />TECH SERVICES reserve right to recover from outstanding balance of party.<br />33(4) Timely provision of invoices/ Debit Note/ Credit Note:<br />Vendor to immediately provide invoice/ Debit Note/ Credit Note to enable&nbsp;TECH SERVICES to claim tax benefit<br />on or before stipulated time period. All necessary adjustment entries (Credit Note, Purchase Returns, and<br />Debit Notes) shall be made within 30 days. entries (Credit Note, Purchase Returns, and Debit Notes)<br />shall be made within 30 days.<br />33(5) HSN/SAC:<br />HSN / SAC for goods &amp; services respectively shall be specifically included in the invoices. In case of<br />receipt of advance, the vendor undertakes to raise the necessary statutory document. Further the vendor<br />declares to raise the prescribed documentation governing the movement of goods.<br />33(6) Discounts:<br />Any known discount should form part of terms of the agreement and invoice to enable Vendor/<br />TECH SERVICES&nbsp;to claim tax adjustment.<br />33(7) Manner of issue of invoices:<br />a) Mandatory three copies of the invoices need to be issued by Vendors in case of supply of goods (i.e.<br />\'Original\' for recipient, \'Duplicate\' for transporter and \'Triplicate\' for Vendor) and wherever the law<br />requires, an Electronic Reference Number for each invoice. 2 copies of invoice need to be issued by<br />Vendor in case of supply of services (i.e. \'Original\' for recipient and \'Duplicate\' for Vendor). Further, the<br />invoices for supplies shall clearly bear the GSTIN No/ UID No along with purchase order/ work order No<br />and date.<br />b) Vendor shall be responsible to issue documents required for movement of goods and the logistic<br />partner shall not be liable for any loss arising due to confiscation of goods by government agencies on<br />account of lack of proper documents or any miss- declaration.<br />c) Where the supply of goods/ services are liable to GST under reverse charge mechanism, then the<br />Vendor should clearly mention the category under which it has been registered and also that \"the liability<br />of payment of GST is on the Recipient of Service\".<br />d) The invoice should clearly specify any abatement, if any claimed or otherwise from the Taxable Value<br />while calculating the GST.</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\">e) Tax invoice is to be issued by the Vendor/vendor as per sec. 31 (read with rule 7) of invoice rules.<br />33(8) Other points:<br />a) Any Liability arising out of dispute on the tax structure, calculation and payment to the Government<br />will be to the Vendor\'s account.<br />b) The PO/ WO shall be void, if at any point of time you are found to be a blacklisted dealer as per<br />GSTN rating system and further no payment shall be entertained.<br />c) The Vendor/ Sub contractor shall communicate to TECH SERVICES with regard to any change in the<br />registration, issue of blacklisting or any non-compliance irrespective of the fact that whether such events<br />are attributable to the vendors or not.<br />d) Any local levies and or other charges levied by any Central/state/local authorities wherever applicable<br />shall be extra and Vendor shall be liable to discharge the same.<br />33(9) Clause on anti-profiteering:<br />Any economic or tax benefit arising out of the implementation of GST is mandatorily required to be<br />passed on to&nbsp;TECH SERVICES by you. Similarly, the benefits enjoyed by your vendors and other players in the<br />supply chain are also required to be passed on to you by them, which in turn shall be passed on to<br />TECH&nbsp; SERVICES by way of price reductions. Accordingly, you are expected to pass on any direct or indirect<br />benefits arising thereon. The responsibility to pass on the above benefits vests with you, as our<br />\'responsible vendors\' and&nbsp;TECH SERVICES reserves the right to understand and seek the manner/ mechanism in<br />which such benefits are passed on to TECH SERVICES</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 10pt;\">33(10) Obligation of Vendor:<br />The Vendor shall comply with all the compliance requirements under GST Law. Further, the Vendor<br />agrees to do all things that may be necessary to enable MATRIX to claim input tax credit in relation to<br />any GST payable under this Agreement/P.O./W.O. or in respect of any supply of Goods or Services<br />under this Agreement/P.O./W.O. This shall include (but not limited to):<br />a) Issuing Invoices/Debit Notes/Revised Invoices/Credit Notes as per the prescribed format, containing<br />all the information as is required for MATRIX to avail Input Tax Credit.<br />b) Submission of periodic statements/returns as per the GST laws within specified timelines with<br />complete and correct details as may be prescribed.<br />c) Issuance of Debit Note within the prescribed time limit to enable MATRIX to take the Credit.<br />d) Timely payment of tax liability by utilization of admissible credit or through cash.<br />e) Ensuring that the transportation of material is covered by valid e-way bills.<br />f) The Vendor continuously maintains a high GST Compliance Rating Score (to be intimated through a<br />separate mail) as per the GST Law. MATRIX reserves the right to terminate this Agreement/P.O./W.O. if<br />the Vendor fails to achieve/maintain an appropriate GST Compliance Rating Score.<br />g) During the transition period, Vendor shall ensure that in respect of capital goods invoices carrying<br />current taxes and duties are issued and such goods are received by MATRIX before appointed date.<br />Taxes and duties will not be reimbursed if such goods are received on or after the appointed date.<br />h) Before raising GST Invoices post appointed date, Vendor shall coordinate with MATRIX especially<br />in case of services with respect to address and GSTIN number on which such Invoices must be raised.<br />33(11) Penal Clause:<br />If any amount of credit, refund or any other benefit is denied or delayed to TECH SERIVCES or any penal charge<br />or interest is imposed on TECH SERIVCES due to any non-compliance by the Vendor (including but not limited<br />to the failure to upload or incorrect disclosure of details on the GSTIN portal or delay/failure to deposit<br />tax within due dates or due to non-furnishing or furnishing of incorrect/incomplete documents by the<br />Vendor, wrong determination of nature of supply), the Vendor shall be liable to reimburse the loss<br />which accrues to TECH SERIVCES on the aforesaid account. Alternatively, TECH SERIVCES shall be entitled to<br />withhold the payment of all the subsequent bills issued by the Vendor and recover such loss from any<br />outstanding payment.<br />33(12) Composition Scheme:<br />Dealers currently operating under the Composition Scheme under the current Indirect tax regime should<br />inform TECH SERIVCES on their decision whether they would continue under GST as a Composition dealer or<br />would cease to opt for Composition Scheme.<br />33(13) Review of Contract / Purchase Orders:<br />In view of anti-profiteering clause mentioned above, it would be relevant to review the existing terms<br />of our Contract / Purchase Order towards any economic or tax benefit arising because of implementation<br />of GST and passing of such benefit to 33(10) Obligation of Vendor:<br />The Vendor shall comply with all the compliance requirements under GST Law. Further, the Vendor<br />agrees to do all things that may be necessary to enable TECH SERIVCES to claim input tax credit in relation to<br />any GST payable under this Agreement/P.O./W.O. or in respect of any supply of Goods or Services<br />under this Agreement/P.O./W.O. This shall include (but not limited to):<br />a) Issuing Invoices/Debit Notes/Revised Invoices/Credit Notes as per the prescribed format, containing<br />all the information as is required for TECH SERIVCES to avail Input Tax Credit.<br />b) Submission of periodic statements/returns as per the GST laws within specified timelines with<br />complete and correct details as may be prescribed.<br />c) Issuance of Debit Note within the prescribed time limit to enable TECH SERIVCES&nbsp;to take the Credit.<br />d) Timely payment of tax liability by utilization of admissible credit or through cash.<br />e) Ensuring that the transportation of material is covered by valid e-way bills.<br />f) The Vendor continuously maintains a high GST Compliance Rating Score (to be intimated through a<br />separate mail) as per the GST Law. TECH SERIVCES reserves the right to terminate this Agreement/P.O./W.O. if<br />the Vendor fails to achieve/maintain an appropriate GST Compliance Rating Score.<br />g) During the transition period, Vendor shall ensure that in respect of capital goods invoices carrying<br />current taxes and duties are issued and such goods are received by TECH SERIVCES before appointed date.<br />Taxes and duties will not be reimbursed if such goods are received on or after the appointed date.<br />h) Before raising GST Invoices post appointed date, Vendor shall coordinate with TECH SERIVCES especially<br />in case of services with respect to address and GSTIN number on which such Invoices must be raised.<br />33(11) Penal Clause:<br />If any amount of credit, refund or any other benefit is denied or delayed to TECH SERIVCES or any penal charge<br />or interest is imposed on TECH SERIVCES due to any non-compliance by the Vendor (including but not limited<br />to the failure to upload or incorrect disclosure of details on the GSTIN portal or delay/failure to deposit<br />tax within due dates or due to non-furnishing or furnishing of incorrect/incomplete documents by the<br />Vendor, wrong determination of nature of supply), the Vendor shall be liable to reimburse the loss<br />which accrues to TECH SERIVCES on the aforesaid account. Alternatively, TECH SERIVCES shall be entitled to<br />withhold the payment of all the subsequent bills issued by the Vendor and recover such loss from any<br />outstanding payment.<br />33(12) Composition Scheme:<br />Dealers currently operating under the Composition Scheme under the current Indirect tax regime should<br />inform TECH SERIVCES on their decision whether they would continue under GST as a Composition dealer or<br />would cease to opt for Composition Scheme.<br />33(13) Review of Contract / Purchase Orders:<br />In view of anti-profiteering clause mentioned above, it would be relevant to review the existing terms<br />of our Contract / Purchase Order towards any economic or tax benefit arising because of implementation<br />of GST and passing of such benefit to TECH SERIVCES..</span></p>', NULL, 'po-terms-and-conditions', 0, 'active', '2022-04-13 17:20:39', '2022-04-13 17:21:05', '1'),
(12, 'Ticket Terms', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', NULL, 'ticket-terms', 1, 'active', '2022-06-15 11:12:32', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_tickets`
--

CREATE TABLE `tech_tickets` (
  `id` int(11) NOT NULL,
  `ticket_no` text,
  `title` text,
  `component_id` text,
  `description` text,
  `problem_description` longtext,
  `assign_user_id` text,
  `customer_id` int(11) DEFAULT NULL,
  `customer_contact_id` int(11) DEFAULT NULL,
  `address_id` text,
  `solution_Information` longtext,
  `tickets_priority_id` int(11) DEFAULT NULL,
  `tickets_status_id` int(11) DEFAULT NULL,
  `amc_id` text,
  `doc_image` text,
  `slug` text,
  `type` text,
  `estimate` text,
  `support_note` text,
  `sales_note` text,
  `serial_no` text,
  `model_no` text,
  `make` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_tickets`
--

INSERT INTO `tech_tickets` (`id`, `ticket_no`, `title`, `component_id`, `description`, `problem_description`, `assign_user_id`, `customer_id`, `customer_contact_id`, `address_id`, `solution_Information`, `tickets_priority_id`, `tickets_status_id`, `amc_id`, `doc_image`, `slug`, `type`, `estimate`, `support_note`, `sales_note`, `serial_no`, `model_no`, `make`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(2, '00002', 'aa', NULL, 'hhhh', NULL, '2,4', 1, 2, NULL, NULL, 3, 3, NULL, NULL, 'aa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2021-12-15 06:02:17', '2021-12-16 11:28:49', '1'),
(3, '00003', 'Fan Not work Leptop ', NULL, 'Please solve issue', '', '2,4', 2, 4, NULL, NULL, 1, 2, NULL, NULL, 'fan-not-work-leptop', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2021-12-16 08:29:38', '2022-01-03 16:05:28', '1'),
(4, '00004', 'Laptop', NULL, 'fghjklkre', 'rsdfhjk;l;tr', '2,4', 16, 0, NULL, NULL, 3, 2, NULL, NULL, 'laptop', '2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2022-02-04 16:35:29', NULL, '1'),
(5, '00005', 'laptop', NULL, 'fghjkl.yukl;', ',sadfghjmkl,dfghjmk,.', '2', 35, 0, NULL, NULL, 2, 1, NULL, NULL, 'laptop', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2022-02-05 18:18:04', NULL, '1'),
(6, '00006', 'Individual Tickets', '9,6,1,4,2,10', '<p style=\"text-align: justify;\">In Legal Terms, Declaration Letters need to be accurate as far as the individual&rsquo;s knowledge is concerned. Supporting Documents or Evidence needs to be attached.</p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>', 'Check Issue', '6', 36, 12, '11', '[{\"engineer_id\":\"2\",\"solution_date\":\"2022-02-10\",\"start_time\":\"02:48\",\"action_taken\":\"asdasd\",\"end_time\":\"04:50\"}]', 1, 1, '1', NULL, 'individual-tickets', 'individual', 'asdasdasda', 'as', 'sdasd', '', '', '', 0, 'active', '2022-02-08 13:09:40', '2022-03-05 12:54:14', '1'),
(7, '00007', 'aaa', NULL, '', '', '2', 38, 13, '12', NULL, 1, 1, '', NULL, 'aaa', 'amc', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2022-03-29 10:58:38', NULL, '1'),
(8, '00008', 'Laptop ', NULL, '', '', '11', 40, 0, '', NULL, 1, 1, '', NULL, 'laptop', 'walk_in', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2022-04-01 11:56:12', NULL, '1'),
(9, '00009', 'Laptop Reparing', '1,2,3', '<p>laptop Repairing</p>', '', '6', 42, 0, '', '[{\"engineer_id\":\"11\",\"solution_date\":\"\",\"start_time\":\"\",\"action_taken\":\"\",\"end_time\":\"\"}]', 1, 1, '', NULL, 'laptop-reparing', 'walk_in', '650', 'wINDOWS INSTTal', '', 'PG0071', 'ip330', '', 0, 'active', '2022-04-01 17:49:04', '2022-04-01 17:53:55', '1'),
(10, '00010', 'Laptop', '1,2,3,4,5', '', '', '11', 44, 0, '', 'null', 1, 1, '', NULL, 'laptop', 'walk_in', '2 days', '2 days', '', 'S0001', 'M0001', '10', 0, 'active', '2022-04-04 18:09:29', '2022-04-04 18:52:03', '1'),
(11, '00011', 'Laptop Reparing', '1,2,3', '<p>Hiting issue</p>', '', '11', 50, 20, '19', '[{\"engineer_id\":\"11\",\"solution_date\":\"\",\"start_time\":\"\",\"action_taken\":\"\",\"end_time\":\"\"}]', 2, 1, '', NULL, 'laptop-reparing', 'individual', '650', 'Install os and antivirus', '', 'PG0103', 'ASUS Laptop', '', 0, 'active', '2022-04-14 17:04:35', '2022-04-14 17:12:47', '1'),
(12, '00012', 'LAPTOP', '1,2,3,4', '<p>lAPTOP NO POWER&nbsp;</p>', '', '11', 51, 21, '20', '[{\"engineer_id\":\"11\",\"solution_date\":\"\",\"start_time\":\"\",\"action_taken\":\"\",\"end_time\":\"\"}]', 1, 1, '', NULL, 'laptop', 'walk_in', '650', 'nO POWER', '', 'JKJKJJK', 'DDFHGFH', '7', 0, 'active', '2022-04-14 17:19:21', '2022-04-14 17:22:34', '1'),
(13, '00013', 'Laptop', '1,2,3', '<p>Formating&nbsp;</p>', '', '11', 53, 0, '', 'null', 1, 1, '', NULL, 'laptop', 'walk_in', '', '', '', 'jhjbhk', 'jkjkjjll', '', 0, 'active', '2022-04-27 17:35:32', '2022-04-28 18:40:45', '1'),
(14, '00014', 'laptop', NULL, '', '', '11', 54, 0, '', NULL, 1, 1, '', NULL, 'laptop', 'walk_in', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', '2022-04-27 17:49:36', NULL, '1'),
(15, '00015', 'Laptop ', '1,3,4', '<p>hingies problem&nbsp;</p>', '', '11', 49, 0, '', 'null', 1, 1, '', NULL, 'laptop', 'walk_in', '1200', 'Hingis problem', '', 'PF0LFYK9', 'MK897', '6', 0, 'active', '2022-04-28 18:46:13', '2022-04-28 18:48:57', '1'),
(16, '00016', 'repairng', '', '', '', '18', 68, 0, '', 'null', 1, 1, '', NULL, 'repairng', 'walk_in', '', '', '', '', '', '', 0, 'active', '2022-05-25 15:53:05', '2022-05-25 15:55:56', '1'),
(17, '00017', 'battery ', '10,15', '<p>battery demage need new battery.</p>', '', '11', 69, 27, '25', '[{\"engineer_id\":\"16\",\"solution_date\":\"2022-05-25\",\"start_time\":\"\",\"action_taken\":\"\",\"end_time\":\"\"}]', 1, 1, '', NULL, 'battery', 'walk_in', '650', 'battery damage', '', 'pfhh556', 'z112', '5', 0, 'active', '2022-05-25 16:01:48', '2022-05-25 16:04:47', '1'),
(18, '00018', 'laptop reapring', '12,13,15,16', '<p>1. Above Goods are given for repairing only. <br />2.Goods repairing work will be done by Customer risk only.<br />3.Component charges will be on replacement basis only. <br />4.Goods will be delivered against this document only. <br />5.Company will not liable if goods are not collected within 10 days.<br />6.Diagnose charge if estimate not approved by customer...Rs.250/-<br />7.Basic call charges...Rs.650/-</p>', '', '11', 71, 29, '27', '[{\"engineer_id\":\"18\",\"solution_date\":\"2022-05-26\",\"start_time\":\"13:02\",\"action_taken\":\"\",\"end_time\":\"\"}]', 1, 1, '', NULL, 'laptop-reapring', 'walk_in', '650', 'OS AND SOFTWAre ', '', 'PG11011', '982546', '4', 0, 'active', '2022-05-26 13:04:48', '2022-06-15 14:15:26', '1'),
(19, '00019', 'bisnessman', '', '', '', '11', 68, 26, '24', '[{\"engineer_id\":\"2\",\"solution_date\":\"2022-06-21\",\"start_time\":\"16:52\",\"action_taken\":\"\",\"end_time\":\"18:54\"}]', 1, 1, '', NULL, 'bisnessman', 'walk_in', '1290', '', '', 'asdcvbhnjmk,lfr', 'h,oo', '', 0, 'active', '2022-06-20 15:47:55', '2022-06-20 16:12:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_tickets_priority`
--

CREATE TABLE `tech_tickets_priority` (
  `id` int(11) NOT NULL,
  `title` text,
  `color` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_tickets_priority`
--

INSERT INTO `tech_tickets_priority` (`id`, `title`, `color`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Normal', '#203c7e', 'normal', 0, 'active', '2021-09-04 10:34:02', '2022-03-12 14:45:03', '1'),
(2, 'Low', '#00e608', 'low', 0, 'active', '2021-09-04 10:35:05', '2021-12-15 13:34:48', '1'),
(3, 'High', '#000000', 'high', 0, 'active', '2021-12-15 13:35:11', NULL, '1'),
(4, 'Critical', '#ff0000', 'critical', 0, 'active', '2022-03-12 14:44:40', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_tickets_problem_report`
--

CREATE TABLE `tech_tickets_problem_report` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_tickets_problem_report`
--

INSERT INTO `tech_tickets_problem_report` (`id`, `ticket_id`, `term_id`, `item_description`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, 6, 1, '<p>Hitting Issue</p>', 1, 'active', NULL, NULL, NULL),
(2, 6, 3, '<p>Hingies / Body damage</p>', 1, 'active', NULL, NULL, NULL),
(3, 6, 1, '<p>Hitting Issue</p>', 0, 'active', NULL, NULL, NULL),
(4, 9, 2, '<p>Excel File Not open</p>', 0, 'active', NULL, NULL, NULL),
(5, 11, 1, '<p>Hitting Issue</p>', 1, 'active', NULL, NULL, NULL),
(6, 11, 1, '<p>Hitting Issue</p>', 1, 'active', NULL, NULL, NULL),
(7, 11, 1, '<p>Hitting Issue</p>', 0, 'active', NULL, NULL, NULL),
(8, 12, 1, '<p>Hitting Issue</p>', 0, 'active', NULL, NULL, NULL),
(9, 15, 1, '<p>Hitting Issue</p>', 0, 'active', NULL, NULL, NULL),
(10, 17, 1, '<p>Hitting Issue</p>', 0, 'active', NULL, NULL, NULL),
(11, 18, 1, '<p>Hitting Issue</p>', 0, 'active', NULL, NULL, NULL),
(12, 18, 2, '<p>Excel File Not open</p>', 0, 'active', NULL, NULL, NULL),
(13, 19, 3, '<p>Hingies / Body damage</p>', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_tickets_reply`
--

CREATE TABLE `tech_tickets_reply` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_type` enum('user','customer') DEFAULT 'user',
  `customer_id` int(11) DEFAULT NULL,
  `reply` text,
  `is_deleted` int(11) DEFAULT '0',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_tickets_reply`
--

INSERT INTO `tech_tickets_reply` (`id`, `ticket_id`, `user_type`, `customer_id`, `reply`, `is_deleted`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 2, 'user', 1, 'hi...... underprocess', 0, '2021-12-16 08:11:29', NULL, '1'),
(2, 2, 'user', 1, 'change main part of leptop system', 0, '2021-12-16 08:13:12', NULL, '1'),
(3, 2, 'user', 1, 'hii sam', 0, '2021-12-16 08:16:41', NULL, '1'),
(4, 2, 'user', 1, 'Solution this Done', 0, '2021-12-16 08:18:43', NULL, '1'),
(5, 2, 'user', 1, 'Not working', 0, '2021-12-16 08:19:55', NULL, '1'),
(6, 2, 'user', 1, 'Reopen this ticket', 0, '2021-12-16 08:26:13', NULL, '1'),
(7, 3, 'user', 2, 'Please solve issue', 0, '2021-12-16 08:29:38', NULL, '1'),
(8, 2, 'user', 1, 'Solve this ticket sir,', 0, '2021-12-16 10:17:13', NULL, '2'),
(9, 2, 'user', 1, 'Done', 0, '2021-12-16 10:17:37', NULL, '1'),
(10, 3, 'user', 2, 'fghf', 0, '2021-12-24 09:43:06', NULL, '1'),
(11, 3, 'user', 2, '', 0, '2022-01-03 10:12:49', NULL, '1'),
(12, 4, 'user', 16, 'fghjklkre', 0, '2022-02-04 16:35:29', NULL, '1'),
(13, 5, 'user', 35, 'fghjkl.yukl;', 0, '2022-02-05 18:18:04', NULL, '1'),
(14, 6, 'user', 36, 'CHECK ISSUE', 0, '2022-02-08 13:09:40', NULL, '1'),
(15, 7, 'user', 38, '', 0, '2022-03-29 10:58:38', NULL, '1'),
(16, 8, 'user', 40, '', 0, '2022-04-01 11:56:12', NULL, '1'),
(17, 9, 'user', 42, '', 0, '2022-04-01 17:49:04', NULL, '1'),
(18, 10, 'user', 44, '', 0, '2022-04-04 18:09:29', NULL, '1'),
(19, 11, 'user', 50, '', 0, '2022-04-14 17:04:35', NULL, '1'),
(20, 12, 'user', 51, '', 0, '2022-04-14 17:19:21', NULL, '1'),
(21, 13, 'user', 53, '', 0, '2022-04-27 17:35:32', NULL, '1'),
(22, 14, 'user', 54, '', 0, '2022-04-27 17:49:36', NULL, '1'),
(23, 15, 'user', 49, '', 0, '2022-04-28 18:46:13', NULL, '1'),
(24, 16, 'user', 0, '', 0, '2022-05-25 15:53:05', NULL, '1'),
(25, 17, 'user', 69, '', 0, '2022-05-25 16:01:48', NULL, '1'),
(26, 18, 'user', 71, '', 0, '2022-05-26 13:04:48', NULL, '1'),
(27, 19, 'user', 68, '', 0, '2022-06-20 15:47:55', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_tickets_solution_information`
--

CREATE TABLE `tech_tickets_solution_information` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `engineer_ids` int(11) DEFAULT NULL,
  `solution_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `action_taken` text,
  `end_time` time DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_tickets_solution_information`
--

INSERT INTO `tech_tickets_solution_information` (`id`, `ticket_id`, `engineer_ids`, `solution_date`, `start_time`, `action_taken`, `end_time`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, 6, 1, '0000-00-00', NULL, NULL, NULL, 1, 'active', NULL, NULL, NULL),
(2, 6, 3, '0000-00-00', NULL, NULL, NULL, 1, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_tickets_status`
--

CREATE TABLE `tech_tickets_status` (
  `id` int(11) NOT NULL,
  `title` text,
  `color` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_default` varchar(50) DEFAULT NULL,
  `is_last` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_tickets_status`
--

INSERT INTO `tech_tickets_status` (`id`, `title`, `color`, `slug`, `is_deleted`, `status`, `is_default`, `is_last`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Open', '#05eb2b', 'open', 0, 'active', '', 'yes', '2021-09-04 10:43:28', '2021-09-04 10:53:12', '1'),
(2, 'In Process', '#414bd2', 'in-process', 0, 'active', 'yes', '', '2021-09-04 10:43:45', '2021-09-04 10:53:16', '1'),
(3, 'Closed', '#d71414', 'closed', 0, 'active', 'yes', 'yes', '2021-09-04 10:43:54', '2021-09-04 10:51:42', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tech_ticket_problem_report`
--

CREATE TABLE `tech_ticket_problem_report` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tech_ticket_term_condition`
--

CREATE TABLE `tech_ticket_term_condition` (
  `id` int(11) NOT NULL,
  `ticket_id` varchar(50) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `item_description` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` varchar(50) DEFAULT NULL,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_ticket_term_condition`
--

INSERT INTO `tech_ticket_term_condition` (`id`, `ticket_id`, `term_id`, `item_description`, `is_deleted`, `status`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, '18', 12, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 0, 'active', NULL, NULL, NULL),
(2, '18', 8, '<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong><strong>&nbsp;100% &nbsp;Advance with Purchase Order</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp; 18 % or 28% Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Warranty&nbsp; &nbsp; :</strong>&nbsp; Mention or 1 year warranty from OEM on Products&nbsp;( No Warranty on cable and cable laying )&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:</strong>&nbsp; The standard delivery period of CCTV Services is 4-7 Working&nbsp;days from the date of acceptance of purchase order by&nbsp; Tech Services&nbsp; ( (limited stock so please confirm with us stock Availability before order )</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>Validity&nbsp; &nbsp; &nbsp; :</strong>&nbsp; Price valid till 2 days from date of Quote or till stocks last, whichever is earlier</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>&nbsp;Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong>&nbsp;&nbsp;Order once given will not be cancel and material once billed will not be taken back.</span></p>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customers are advised to pay materials costing on signing/accepting this term and order form and also to settle the full invoice amount on completion of installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">installation materials like Cable, cable laying , connectors&nbsp;,&nbsp;pipe, bend, clamp ,etc charges as per qunitituy used&nbsp;</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\"><strong>For Installing the required scaffolding, ladder should be arranged by the customer.</strong></span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Monitor should be arranged by the customer during the installation to preview and confirm quality output on the premises.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Ensure that the Internet wiring access is near to the location of DVR/NVR.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Installation requires drilling holes in interior and exterior walls. Tech Services limits its liability to the patching of said holes and cannot be responsible for providing paint or wall coverings to match those colors or coverings existing within Customer\'s premises</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Additional Accessories like mouse, network cable, router, etc.,should be arranged by the customer before installation.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Customer should make premises available without interruption during Tech Services\'s normal working hours, 10:00 A.M. to 6:30 P.M., Monday through Saturday, excluding holidays.</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Freight / Transportation / Delivery Charges Extra as Actual</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Services , Installation and Configuration charges Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Civil &amp; Electrical Work , Jari work ,is in the Scope of the Customer</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">Project management , Documentation and&nbsp;Certification Charges&nbsp;Extra</span></p>\r\n</li>\r\n<li>\r\n<p><span style=\"font-size: 10pt;\">All other incidentals like traveling, food, accommodation, stay &amp; other expenses to be provide by the client.</span></p>\r\n</li>\r\n</ul>', 1, 'active', NULL, NULL, NULL),
(3, '19', 7, '<ul>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Payment&nbsp;&nbsp;&nbsp; :&nbsp;</strong>100% &nbsp;Advance with Purchase Order&nbsp;Now</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Warranty / Subscription :</strong>&nbsp;1 Year Subscription</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>TAX (GST ) :</strong>&nbsp;Tax will be extra as Applicable</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">The prices are in INR and are Unit Basic Prices.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Price Validity :</strong> Valid till 7 Days from date of Quote or till stocks last , whichever is earlier&nbsp;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Delivery&nbsp; &nbsp; &nbsp;:&nbsp;</strong> 7&nbsp;to 10&nbsp;Working Days&nbsp;( limited stock so please confirm with us stock Availability and Price before order )</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Autodesk , Adobe , &nbsp;Microsoft, Symantec : Paper License delivery mode is E-License which shall be delivered to your email</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\"><strong>Installation Charges :</strong>&nbsp; Installation and Configuration charges Extra&nbsp;as Actual&nbsp;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">All Back to back&nbsp;license orders are&nbsp;non- cancellable&nbsp;unless approved by authorized MS personnel as per RMA policy with applicable cancellation charges.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">All&nbsp;GGS legalization&nbsp;License SKU orders are non- cancellable. GGS orders to be placed as separate order and the SKU once placed cannot be&nbsp;processed for Cancellation under the RMA policy.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">O365 Policy:&nbsp; Customer can order multiple O365 M SKUs on a single purchase order. No returns are allowed after any of the O365 M SKUs on a single purchase order are redeemed. Once the OSA Key is redeemed, no return will be accepted - even if the customer hasn\'t assigned all seats represented by that Dynamic SKU purchase. Pls. read these terms carefully and explain this policy to end customers before accepting O365 Mid-market orders.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Prices are subject to change depending on the changes in taxation structure prevailing in various states from time to time.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Please note that as per&nbsp;Microsoft Policy, Multi-Tier Orders need to be pre-approved by them.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">We need following declaration with every PO for Multitier confirmation and non-cancellable clause.</span></span><br /><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&ldquo;We confirm that this PO&nbsp;is directly placed on us by End Customer&ldquo;</span></span><br /><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&ldquo;We agree that&nbsp;License Order&nbsp; once placed is Non-cancellable.&rdquo;</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">As per new Microsoft compliance policy, PO should have same Part Number, Description, Qty and Pricing details</span></span></p>\r\n</li>\r\n<li><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">You must have a&nbsp;<em>minimum</em>&nbsp;initial purchase of&nbsp;<em>five</em>&nbsp;software&nbsp;<em>licenses</em>&nbsp;for an Open&nbsp;<em>License</em>&nbsp;agreement</span></span></li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">The prices given are for the complete bill of material. Prices will not be valid for partial purchases.</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">Tech Services&nbsp; has rights to change above quote any given point of time. I.e we reserve full rights against changing quote</span></span></p>\r\n</li>\r\n<li>\r\n<p><span class=\"example1\" style=\"color: #000000;\"><span style=\"font-size: 10pt;\">&nbsp;Taxes indicated above are at currently applicable rates &amp; are subject to changes as per government notifications.</span></span></p>\r\n</li>\r\n</ul>', 0, 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_uom`
--

CREATE TABLE `tech_uom` (
  `id` int(11) NOT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tech_uom`
--

INSERT INTO `tech_uom` (`id`, `designation_id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, NULL, 'kg', 'kg', 0, 'active', '2021-09-04 08:41:50', '2022-02-19 13:16:33', '1'),
(2, NULL, 'gm', 'gm', 0, 'active', '2021-09-04 08:41:58', '2022-02-19 13:16:27', '1'),
(3, NULL, 'Nos', 'nos', 0, 'active', '2022-04-01 10:10:27', NULL, '1'),
(4, NULL, 'Meter', 'meter', 0, 'active', '2022-05-07 11:09:32', NULL, '1'),
(5, NULL, '	Month', 'month', 0, 'active', '2022-05-07 11:09:51', NULL, '1'),
(6, NULL, 'YARD', 'yard', 0, 'active', '2022-05-07 11:10:15', NULL, '1'),
(7, NULL, '	Person', 'person', 0, 'active', '2022-05-07 11:10:46', NULL, '1'),
(8, NULL, '	Points', 'points', 0, 'active', '2022-05-07 11:10:59', NULL, '1'),
(9, NULL, '	Lot', 'lot', 0, 'active', '2022-05-07 11:11:11', NULL, '1'),
(10, NULL, '	Job', 'job', 0, 'active', '2022-05-07 11:11:37', NULL, '1'),
(11, NULL, 'Box', 'box', 0, 'active', '2022-05-07 11:11:49', NULL, '1'),
(12, NULL, 'Core', 'core', 0, 'active', '2022-05-07 11:12:21', NULL, '1'),
(13, NULL, 'User', 'user', 0, 'active', '2022-05-07 11:12:32', NULL, '1'),
(14, NULL, 'Server', 'server', 0, 'active', '2022-05-07 11:12:44', NULL, '1'),
(15, NULL, 'USD', 'usd', 0, 'active', '2022-05-07 11:12:55', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_city`
--

CREATE TABLE `zyd_city` (
  `id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_city`
--

INSERT INTO `zyd_city` (`id`, `state_id`, `city`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 2, 'vaodara', 1, 'inactive', NULL, '2021-02-24 14:43:23', NULL),
(2, 2, 'chandani chock', 0, 'active', NULL, '2021-02-24 14:43:27', NULL),
(3, 3, 'valsad', 0, 'active', '2021-02-25 11:06:29', NULL, '422'),
(4, 3, 'vaodara', 1, 'active', '2021-02-27 09:10:26', NULL, '422'),
(5, 2, 'Delhi', 0, 'active', '2021-02-27 09:10:36', '2021-02-27 10:31:46', '422'),
(6, 4, 'manali', 0, 'active', '2021-03-02 10:52:55', '2021-09-11 07:38:26', '422'),
(7, 5, 'ABCD', 1, 'active', '2021-08-11 09:00:32', '2021-08-11 09:00:39', '422'),
(8, 3, 'Surat', 0, 'active', '2022-02-05 12:36:17', '2022-02-05 12:36:29', '1'),
(9, 3, 'AHMEDABAD', 0, 'active', '2022-02-05 12:56:14', '2022-02-05 12:56:24', '1'),
(10, 3, 'Anand', 0, 'active', '2022-02-05 15:12:05', '2022-02-07 10:25:14', '1'),
(11, 3, 'Vadodara', 0, 'active', '2022-02-08 10:17:21', '2022-02-08 10:17:27', '1');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_department`
--

CREATE TABLE `zyd_department` (
  `id` int(11) NOT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_department`
--

INSERT INTO `zyd_department` (`id`, `designation_id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 2, 'It Department', 'it-department', 1, 'active', '2021-09-04 07:29:21', '2021-09-04 07:29:56', '422'),
(2, NULL, 'Customer category 2', 'customer-category-2', 1, 'active', '2021-09-04 07:29:41', '2021-09-04 09:58:30', '422'),
(3, NULL, 'Accounting', 'accounting', 0, 'active', '2022-02-05 17:34:02', '2022-03-12 14:42:47', '1'),
(4, NULL, 'Support', 'support', 0, 'active', '2022-02-05 17:34:12', NULL, '1'),
(5, NULL, 'Sales', 'sales', 0, 'active', '2022-03-12 14:41:04', NULL, '1'),
(6, NULL, 'Purchasing', 'purchasing', 0, 'active', '2022-03-12 14:41:35', '2022-03-12 14:42:35', '1'),
(7, NULL, 'Production', 'production', 0, 'active', '2022-03-12 14:41:53', NULL, '1'),
(8, NULL, 'Research and Development ( R&D )', 'research-and-development-r-d', 0, 'active', '2022-03-12 14:42:07', NULL, '1'),
(9, NULL, 'Marketing', 'marketing', 0, 'active', '2022-03-12 14:42:16', NULL, '1'),
(10, NULL, 'Human Resource Management', 'human-resource-management', 0, 'active', '2022-03-12 14:42:23', NULL, '1'),
(11, NULL, 'Finance', 'finance', 0, 'active', '2022-03-12 14:42:58', NULL, '1'),
(12, NULL, 'Operations', 'operations', 0, 'active', '2022-03-12 14:43:27', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_designation`
--

CREATE TABLE `zyd_designation` (
  `id` int(11) NOT NULL,
  `title` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_designation`
--

INSERT INTO `zyd_designation` (`id`, `title`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Manager ', 'manager', 1, 'active', '2021-09-04 07:17:01', '2021-09-04 07:17:48', '422'),
(2, 'Sales Head', 'sales-head', 0, 'active', '2021-09-04 07:17:57', NULL, '422'),
(3, 'Director ', 'director', 0, 'active', '2022-02-05 17:27:28', NULL, '1'),
(4, 'Support Head ', 'support-head', 0, 'active', '2022-02-05 17:27:48', NULL, '1'),
(5, 'Accountant ', 'accountant', 0, 'active', '2022-02-05 17:28:11', NULL, '1'),
(6, 'Engineer ', 'engineer', 0, 'active', '2022-02-05 17:28:33', NULL, '1'),
(7, 'Back Office ', 'back-office', 0, 'active', '2022-02-05 17:29:48', NULL, '1'),
(8, 'Engineer - Vendor Development', 'engineer-vendor-development', 0, 'active', '2022-03-12 14:15:03', NULL, '1'),
(9, 'Chief Executive Officer (CEO)', 'chief-executive-officer-ceo', 0, 'active', '2022-03-12 14:15:36', NULL, '1'),
(10, 'Chief Financial Officer (CFO)', 'chief-financial-officer-cfo', 0, 'active', '2022-03-12 14:15:50', NULL, '1'),
(11, 'Managing Director (MD)', 'managing-director-md', 0, 'active', '2022-03-12 14:16:32', NULL, '1'),
(12, 'Manager', 'manager', 0, 'active', '2022-03-12 14:17:01', NULL, '1'),
(13, 'Sales Executive', 'sales-executive', 0, 'active', '2022-03-12 14:17:31', NULL, '1'),
(14, 'Purchase Executive', 'purchase-executive', 0, 'active', '2022-03-12 14:18:02', NULL, '1'),
(15, 'Purchase Manager', 'purchase-manager', 0, 'active', '2022-03-12 14:18:12', NULL, '1'),
(16, 'Purchase Officer', 'purchase-officer', 0, 'active', '2022-03-12 14:18:41', NULL, '1'),
(17, 'Finance Manager', 'finance-manager', 0, 'active', '2022-03-12 14:19:47', NULL, '1'),
(18, 'Marketing Manager', 'marketing-manager', 0, 'active', '2022-03-12 14:19:56', NULL, '1'),
(19, 'General Manager', 'general-manager', 0, 'active', '2022-03-12 14:20:08', NULL, '1'),
(20, 'Chief Technology Officer', 'chief-technology-officer', 0, 'active', '2022-03-12 14:20:47', NULL, '1'),
(21, 'Store Manager', 'store-manager', 0, 'active', '2022-03-12 14:21:07', NULL, '1'),
(22, 'Recruitment Manager ', 'recruitment-manager', 0, 'active', '2022-03-12 14:21:21', NULL, '1'),
(23, 'Back Office Executive', 'back-office-executive', 0, 'active', '2022-03-12 14:22:22', NULL, '1'),
(24, 'Sales Coordinator', 'sales-coordinator', 0, 'active', '2022-03-12 14:22:44', NULL, '1'),
(25, 'Internal Referral', 'internal-referral', 1, 'active', '2022-03-12 14:32:21', NULL, '1'),
(26, 'Store Walkin', 'store-walkin', 1, 'active', '2022-03-12 14:32:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_products_img`
--

CREATE TABLE `zyd_products_img` (
  `id` int(11) NOT NULL,
  `product_id` text,
  `image_name` text,
  `is_deleted` int(11) DEFAULT '0',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_products_img`
--

INSERT INTO `zyd_products_img` (`id`, `product_id`, `image_name`, `is_deleted`, `inserted_time`, `updated_time`) VALUES
(1, '4', '648133technical-logo-vector-illustration-logo-sticker-emblem-technical-logo-color-vector-illustration-logo-sticker-194279233.jpg', 0, NULL, NULL),
(2, '4', '175935picture-5.png', 0, NULL, NULL),
(3, '5', '365113circle-technical-logo-vector-20787371 (1).jpg', 0, '2021-09-07 13:23:01', NULL),
(9, '4', '253938copy1.jpg', 0, '2021-09-07 14:00:49', NULL),
(10, '2', '467194Car-Maintenance-automobile.jpg', 0, '2021-11-24 10:26:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zyd_products_mst`
--

CREATE TABLE `zyd_products_mst` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `product_code` text NOT NULL,
  `product_name` text,
  `category_ids` text,
  `brand_id` text,
  `image_name` text,
  `uom_id` text,
  `price` double DEFAULT NULL,
  `purchased_price` double DEFAULT NULL,
  `hsn_code` text,
  `sku` text,
  `description` longtext,
  `gst` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `subcategory_ids` text,
  `is_deleted` int(11) DEFAULT '0',
  `user_id` text,
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_products_mst`
--

INSERT INTO `zyd_products_mst` (`id`, `vendor_id`, `product_code`, `product_name`, `category_ids`, `brand_id`, `image_name`, `uom_id`, `price`, `purchased_price`, `hsn_code`, `sku`, `description`, `gst`, `status`, `subcategory_ids`, `is_deleted`, `user_id`, `inserted_time`, `updated_time`) VALUES
(1, 31, '0001', '4 GB RAM for DELL PowerEdge T20 Server ', '6', '4', '15920hd1080.png', '1', 22500, NULL, 'HAS001', 'PART001', '<p>4 GB RAM for DELL PowerEdge T20 Server&nbsp;</p>', '18', 'active', NULL, 0, '1', '2022-02-18 08:03:01', '2022-02-18 10:26:58'),
(2, 31, '0002', '8 GB RAM for DELL PowerEdge T20 Server', '6', '4', '22867hd1080.png', '1', 15200, NULL, 'HAS002', 'PArt001', '<p>8 GB RAM for DELL PowerEdge T20 Server</p>', '18', 'active', NULL, 0, '1', '2022-02-18 08:05:56', '2022-02-18 08:06:27'),
(3, 31, '0003', 'Epson EcoTank L3110 Multifunction InkTank Printer', '6', '6', '656hd1080.png', '1', 10500, 10000, 'HAS003', 'PART003', '<p>Epson EcoTank L3110 Multifunction InkTank Printer</p>', '18', 'active', NULL, 0, '1', '2022-02-18 08:07:12', '2022-02-19 13:20:25'),
(4, 28, '00004', 'Dell Latitude 5420 CTO Base (16 GB RAM )', '6', '4', NULL, '3', 109000, 108934, '84713010', 'Latitude 5420', '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 32GB, 2x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', '18', 'active', NULL, 0, '1', '2022-04-01 10:09:43', '2022-05-10 12:28:52'),
(5, 0, '00005', 'Dell Latitude 5420 CTO Base (32 GB RAM )', '11', '4', NULL, '3', 100671, 100671, '84713010', ' Latitude 5420 CTO ', '<p>Components<br />1 I7-1165G7 Trans, Intel Iris Xe Graphics Capable, Thunderbolt<br />1 ENERGY STAR Qualified<br />1 14\" HD (1366x768) Non-Touch, Anti-Glare, TN, HD Camera, 220nits, WLAN<br />1 No Security, Backlit Single Point English International Keyboard<br />1 Latitude 5420 Bottom Door<br />1 16GB,1x16GB, DDR4 Non-ECC<br />1 M.2 1TB PCIe NVMe 4 Class 40 Solid State Drive<br />1 Power Cord for 3-pin Adapter (IND)<br />1 3 Cell 42Whr ExpressCharge Capable Battery<br />1 (INDIA) Dell Essential Backpack 15-ES1520P-Fits most laptops up to 15\"<br />1 65W Type-C EPEAT Adapter<br />1 Realtek RTL8822CE 802.11ac Dual Band (2x2) Wireless Adapter + Bluetooth 5.0<br />1 Realtek 8822CE WLAN Driver<br />1 No Mobile Broadband Card<br />1 Dell Mobile Wireless Mouse MS3320W - Titan Gray - Retail Packaging<br />1 Keyboard Included<br />1 Dell Applications for Windows<br />1 Battery Carries 1 Year Warranty from Invoice Date<br />Software<br />1 No Resource USB Media<br />1 Windows 10 Pro (Includes Windows 11 Pro License) English<br />1 Microsoft Office Trial(30 Days)<br />1 No Out-of-Band Systems Management - No vPro<br />1 No Anti-Virus Software<br />Service<br />1 1Y Carry-In Service<br />1 1Y Basic Onsite Service Upgrade<br />1 Y2-3 Basic Onsite Service Extension</p>', '18', 'active', NULL, 0, '1', '2022-04-01 10:18:33', NULL),
(6, 23, '00006', 'Lenovo Thinkcentre Neo 50s 11T0S00200', '6', '3', NULL, '3', 28000, 25000, '8471', '50S Neo', '<p>Core I5-12400 12th Genration <br />8 GB RAM<br />1 TB_HD_7200RPM HDD<br />No ODD<br />Wired Keyboard and Mouse<br />NO WIRELESS_LAN<br />No OS<br />3 Year ONSite Warranty <br />21.5&rdquo; inch Monitor</p>', '18', 'active', NULL, 0, '1', '2022-04-05 15:46:29', NULL),
(7, 31, '00007', 'D-Link DGS-1016A 16-Port Gigabit Unmanaged Switch', '15', '17', NULL, '3', 14500, 12500, '8471', '1016A', '<p>3 Year Warranty&nbsp;</p>', '28', 'active', NULL, 0, '1', '2022-04-08 16:53:24', NULL),
(8, 0, '00008', 'Dlink 28-Port Gigabit Smart Managed Switch DGS-1210-28', '', '17', NULL, '3', 14500, 13500, '8471', 'DGS-1210-28', '<p><br />24 x 10/100/1000BASE-T ports<br />4 x Gigabit RJ45/SFP Combo ports</p>', '18', 'active', NULL, 0, '1', '2022-04-13 16:52:05', NULL),
(9, 0, '00009', 'Panasonic 50 inch Penasonic LED ( LH-50AN3ND )', '6', '29', NULL, '3', 36500, 33500, '8470', 'LH-50AN3ND', '<p>&nbsp;50 INCHES, 4K, SMART ANDROID&nbsp;<br />3 Year Warranty&nbsp;</p>', '28', 'active', NULL, 0, '1', '2022-04-13 16:53:26', '2022-04-13 16:53:53'),
(10, 28, '00010', 'HPE ProLiant DL380 Gen10 NC: (8 SFF)', '11', '5', NULL, '3', 539000, 490000, '', '', '<p><span style=\"font-size: 12pt;\">1 x Intel Xeon-Gold 6242R (3.1GHz/20-core/205W) Processor Kit</span><br /><span style=\"font-size: 12pt;\">2 x HPE 32GB 2Rx4 PC4-2933Y-R Smart Kit</span><br /><span style=\"font-size: 12pt;\">2 x HPE 480GB SATA RI SFF SC MV SSD</span><br /><span style=\"font-size: 12pt;\">HPE Ethernet 1Gb 4-port FLR-T I350-T4V2 Adapter </span><br /><span style=\"font-size: 12pt;\">P408i-a w/2GB cache with smart Storage battery </span><br /><span style=\"font-size: 12pt;\">3-slots (x8, x16, x8 with dual m.2) as standard </span><br /><span style=\"font-size: 12pt;\">1 x HPE 800W Flex Slot Platinum Hot Plug RPS Kit </span><br /><span style=\"font-size: 12pt;\">HPE iLO Standard with Intelligent Provisioning </span><br /><span style=\"font-size: 12pt;\">2U SFF Easy install rail kit with CMA</span><br /><span style=\"font-size: 12pt;\">3 Years NBD Support</span></p>', '18', 'active', NULL, 0, '1', '2022-04-28 15:49:29', '2022-04-28 16:22:43'),
(11, 0, '00011', 'PowerEdge T340 Server', '6', '4', NULL, '3', 1468000, 1462000, '84715000', 'T340', '<p>PowerEdge T340 MLK Motherboard<br />1 Intel Xeon E-2224 3.4GHz, 8M cache, 4C/4T, turbo (71W)<br />1 iDRAC Group Manager, Enabled<br />1 3.5\" Chassis up to 8 Hot Plug Hard Drives<br />1 Security Bezel<br />1 PowerEdge T340 Shipping Material<br />1 3200MT/s UDIMM<br />1 Performance Optimized<br />1 8GB UDIMM, 3200MT/s, ECC<br />1 iDRAC9,Enterprise<br />1 1TB 7.2K RPM SATA 6Gbps 512n 3.5in Hot-plug Hard Drive<br />1 480GB SSD SATA Read Intensive 6Gbps 512 2.5in Hot-plug AG Drive,3.5in HYB CARR<br />1 PERC H330 RAID Controller, Adapter, Full Height<br />1 Performance BIOS Settings<br />1 Standard Heatsink<br />1 DVD +/-RW, SATA, Internal<br />2 Power Cord - C13, 1.8M, 250V, 10A (India)<br />1 Dual, Hot-plug, Redundant Power Supply 1+1, 495W<br />2 Jumper Cord - C13/C14, 4M, 250V, 10A (India BIS)<br />1 Trusted Platform Module 2.0<br />1 On-Board LOM<br />1 Dell Optical Mouse MS116 - Black<br />1 Dell KB216 Wired Keyboard English<br />1 No Systems Documentation, No OpenManage DVD Kit<br />1 Casters<br />1 No RAID<br />Software<br />1 No Media Required<br />1 No Operating System<br />1 UEFI BIOS Boot Mode with GPT Partition</p>\r\n<p>Service<br />1 No Installation Services Selected<br />1 Basic Next Business Day 12 Months<br />1 ProSupport and Next Business Day Onsite Service Initial, 12 Month(s)<br />1 ProSupport and Next Business Day Onsite Service Extension, 24 Month(s)</p>', '18', 'active', NULL, 0, '1', '2022-05-07 11:33:00', '2022-05-10 12:27:51'),
(12, 28, '00012', 'Dell Optiplex 3280 AIO (Core i3 / Win 10 Pro )', '6', '4', NULL, '', 54000, 51000, '8471', '', '<p>Core i3-10105T 10th Generaiton</p>\r\n<p>8 GB RAM</p>\r\n<p>256 GB SSD</p>\r\n<p>Windows 10 Pro</p>\r\n<p>21.5\" inch FHD Display</p>\r\n<p>No ODD</p>\r\n<p>3 Year Warranty</p>\r\n<p>Basic Stand/Camera</p>\r\n<p>Intel&reg; 3165 802.11ac dual band 1x1 + Bluetooth 4.2</p>\r\n<p>Wireless Keyboard and mouse</p>\r\n<p>&nbsp;</p>', '18', 'active', NULL, 0, '1', '2022-06-20 16:19:00', '2022-06-20 16:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_products_mst_attribute`
--

CREATE TABLE `zyd_products_mst_attribute` (
  `id` int(11) NOT NULL,
  `product_id` text,
  `attribute_id` text,
  `quantity` text,
  `price` text,
  `remark` longtext,
  `is_deleted` int(11) DEFAULT '0',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_products_mst_attribute`
--

INSERT INTO `zyd_products_mst_attribute` (`id`, `product_id`, `attribute_id`, `quantity`, `price`, `remark`, `is_deleted`, `inserted_time`, `updated_time`) VALUES
(1, '1', '5', '60', '31500', '', 0, '2021-11-24 10:05:59', NULL),
(2, '1', '6', '60', '31500', '', 0, '2021-11-24 10:05:59', NULL),
(4, '2', '9', '100', '2000', 'DELL PRECISION 3650 TOWER CTO BASE WORKSTATION ( CORE I4 )	', 0, '2021-11-24 10:26:42', NULL),
(5, '2', '10', '100', '3000', 'DELL PRECISION 3650 TOWER CTO BASE WORKSTATION ( CORE I5 )	', 0, '2021-11-24 10:26:42', NULL),
(7, '3', '7', '50', '39500', 'Acer Predator Helios 300 ', 1, '2021-12-14 06:20:22', NULL),
(8, '3', '12', '100', '25000', 'no desc', 0, NULL, NULL),
(9, '3', '12', '100', '25000', 'no desc', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zyd_product_brand`
--

CREATE TABLE `zyd_product_brand` (
  `id` int(11) NOT NULL,
  `title` text,
  `img` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_product_brand`
--

INSERT INTO `zyd_product_brand` (`id`, `title`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(1, 'Brand 11', '14841copy1.jpg', 'brand-11', 1, 'active', '2021-09-03 18:37:09', '2021-09-03 18:37:23', '422'),
(2, 'Brand 2', NULL, 'brand-2', 1, 'active', '2021-09-03 18:37:33', NULL, '422'),
(3, 'LENOVO', NULL, 'lenovo', 0, 'active', '2022-02-07 10:59:06', NULL, '1'),
(4, 'DELL', NULL, 'dell', 0, 'active', '2022-02-07 10:59:21', NULL, '1'),
(5, 'HP', NULL, 'hp', 0, 'active', '2022-02-07 10:59:29', NULL, '1'),
(6, 'ACER', NULL, 'acer', 0, 'active', '2022-02-07 10:59:46', NULL, '1'),
(7, 'ASUS', NULL, 'asus', 0, 'active', '2022-02-07 11:00:13', NULL, '1'),
(8, 'Vm Ware', NULL, 'vm-ware', 0, 'active', '2022-02-07 11:00:47', NULL, '1'),
(9, 'Microsoft', NULL, 'microsoft', 0, 'active', '2022-02-07 11:01:09', NULL, '1'),
(10, 'Google Cloud', NULL, 'google-cloud', 0, 'active', '2022-02-07 11:01:37', NULL, '1'),
(11, 'HYPER - V', NULL, 'hyper-v', 0, 'active', '2022-02-07 11:02:21', NULL, '1'),
(12, 'VEEAM', NULL, 'veeam', 0, 'active', '2022-02-07 11:02:44', NULL, '1'),
(13, 'CISCO', NULL, 'cisco', 0, 'active', '2022-02-07 11:03:03', NULL, '1'),
(14, 'Honeywell', NULL, 'honeywell', 0, 'active', '2022-02-07 11:03:29', NULL, '1'),
(15, 'COMMSCOPE', NULL, 'commscope', 0, 'active', '2022-02-07 11:04:04', NULL, '1'),
(16, 'Tp- link', NULL, 'tp-link', 0, 'active', '2022-02-07 11:04:35', NULL, '1'),
(17, 'D-LINK', NULL, 'd-link', 0, 'active', '2022-02-07 11:04:53', NULL, '1'),
(18, 'MOLEX', NULL, 'molex', 0, 'active', '2022-02-07 11:05:53', NULL, '1'),
(19, 'Digi Link', NULL, 'digi-link', 0, 'active', '2022-02-07 11:06:52', NULL, '1'),
(20, 'ARUBA', NULL, 'aruba', 0, 'active', '2022-02-07 11:07:14', NULL, '1'),
(21, 'RUCKUS', NULL, 'ruckus', 0, 'active', '2022-02-07 11:07:38', NULL, '1'),
(22, 'NETGEAR', NULL, 'netgear', 0, 'active', '2022-02-07 11:07:55', NULL, '1'),
(23, 'SONICWALL', NULL, 'sonicwall', 0, 'active', '2022-02-07 11:08:18', NULL, '1'),
(24, 'SOPHOS', NULL, 'sophos', 0, 'active', '2022-02-07 11:08:33', NULL, '1'),
(25, 'FORTINET', NULL, 'fortinet', 0, 'active', '2022-02-07 11:08:51', NULL, '1'),
(26, 'Watch Guard', NULL, 'watch-guard', 0, 'active', '2022-02-07 11:09:38', NULL, '1'),
(27, 'QNAP', NULL, 'qnap', 0, 'active', '2022-02-07 11:09:57', NULL, '1'),
(28, 'SAMSUNG', NULL, 'samsung', 0, 'active', '2022-02-07 11:10:14', NULL, '1'),
(29, 'Panasonic', NULL, 'panasonic', 0, 'active', '2022-02-07 11:10:36', NULL, '1'),
(30, 'BenQ', NULL, 'benq', 0, 'active', '2022-02-07 11:10:59', NULL, '1'),
(31, 'ViewSonic', NULL, 'viewsonic', 0, 'active', '2022-02-07 11:11:33', NULL, '1'),
(32, 'BARCO', NULL, 'barco', 0, 'active', '2022-02-07 11:11:58', NULL, '1'),
(33, 'SONY', NULL, 'sony', 0, 'active', '2022-02-07 11:12:18', NULL, '1'),
(34, 'Polycom', NULL, 'polycom', 0, 'active', '2022-02-07 11:12:52', NULL, '1'),
(35, 'PeopleLink', NULL, 'peoplelink', 0, 'active', '2022-02-07 11:13:51', NULL, '1'),
(36, 'eSSL', NULL, 'essl', 0, 'active', '2022-02-07 11:14:15', NULL, '1'),
(37, 'MATRIX', NULL, 'matrix', 0, 'active', '2022-02-07 11:14:33', NULL, '1'),
(38, 'EPSON', NULL, 'epson', 0, 'active', '2022-02-07 11:14:48', NULL, '1'),
(39, 'Canon', NULL, 'canon', 1, 'active', '2022-02-07 11:16:02', '2022-02-07 11:16:25', '1'),
(40, 'Canon', NULL, 'canon', 0, 'active', '2022-02-07 11:16:48', NULL, '1'),
(41, 'Brother', NULL, 'brother', 0, 'active', '2022-02-07 11:17:07', NULL, '1'),
(42, 'TVS Electronics', NULL, 'tvs-electronics', 0, 'active', '2022-02-07 15:36:15', NULL, '1'),
(43, 'ZEBRA Technologies', NULL, 'zebra-technologies', 0, 'active', '2022-02-07 15:36:58', NULL, '1'),
(44, 'APC', NULL, 'apc', 0, 'active', '2022-02-07 15:37:20', NULL, '1'),
(45, 'EATON', NULL, 'eaton', 0, 'active', '2022-02-07 15:45:26', NULL, '1'),
(46, 'DELL', NULL, 'dell', 0, 'active', '2022-05-10 12:27:07', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_product_category`
--

CREATE TABLE `zyd_product_category` (
  `id` int(11) NOT NULL,
  `title` text,
  `img` text,
  `slug` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_product_category`
--

INSERT INTO `zyd_product_category` (`id`, `title`, `img`, `slug`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(2, 'Computer', NULL, 'computer', 1, 'active', '2021-08-14 07:18:26', '2021-09-04 09:30:31', '422'),
(4, 'Electronic', '6996picture-5.png', 'electronic', 1, 'active', '2021-09-03 18:16:08', '2021-09-04 09:30:23', '422'),
(5, 'LAPTOP', NULL, 'laptop', 1, 'active', '2022-02-04 18:17:55', NULL, '1'),
(6, 'HARDWARE', NULL, 'hardware', 0, 'active', '2022-02-04 18:19:08', NULL, '1'),
(7, 'Software			', NULL, 'software', 0, 'active', '2022-02-04 18:19:23', NULL, '1'),
(8, 'Networking', NULL, 'networking', 0, 'active', '2022-02-04 18:19:41', NULL, '1'),
(9, '	Peripherals', NULL, 'peripherals', 0, 'active', '2022-02-04 18:20:05', NULL, '1'),
(10, 'Virtualization Solutions', NULL, 'virtualization-solutions', 0, 'active', '2022-02-04 18:31:23', NULL, '1'),
(11, 'Server storage and backup solutions', NULL, 'server-storage-and-backup-solutions', 0, 'active', '2022-02-04 18:32:18', NULL, '1'),
(12, 'End user computing solutions', NULL, 'end-user-computing-solutions', 0, 'active', '2022-02-04 18:32:45', NULL, '1'),
(13, 'Security solutions', NULL, 'security-solutions', 0, 'active', '2022-02-04 18:33:06', NULL, '1'),
(14, 'Unified communication Solutions', NULL, 'unified-communication-solutions', 0, 'active', '2022-02-04 18:33:25', NULL, '1'),
(15, 'Networking Solutions', NULL, 'networking-solutions', 0, 'active', '2022-02-04 18:33:40', NULL, '1'),
(16, 'Software Solutions', NULL, 'software-solutions', 0, 'active', '2022-02-04 18:33:55', NULL, '1'),
(17, 'It Managed Services', NULL, 'it-managed-services', 0, 'active', '2022-02-04 18:34:11', NULL, '1'),
(18, 'Power Solutions', NULL, 'power-solutions', 1, 'active', '2022-02-04 18:34:22', NULL, '1'),
(19, 'Power Solution', NULL, 'power-solution', 0, 'active', '2022-05-07 11:06:37', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_request_log`
--

CREATE TABLE `zyd_request_log` (
  `id` int(11) NOT NULL,
  `data` longtext NOT NULL,
  `inserted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zyd_request_log`
--

INSERT INTO `zyd_request_log` (`id`, `data`, `inserted_time`) VALUES
(1, '{\"action\":\"get_zone\"}', '2021-08-11 07:21:06'),
(2, '{\"action\":\"get_zone\"}', '2021-08-11 07:21:44'),
(3, '{\"action\":\"get_state\",\"state_id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:40:29'),
(4, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:40:42'),
(5, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:40:56'),
(6, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:44:22'),
(7, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:44:32'),
(8, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:44:33'),
(9, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:44:33'),
(10, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:46:22'),
(11, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 08:46:47'),
(12, '{\"action\":\"get_state\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 09:05:49'),
(13, '{\"action\":\"get_city\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 09:08:53'),
(14, '{\"action\":\"get_city\",\"id\":\"1\",\"zone_id\":\"1\"}', '2021-08-11 09:09:32'),
(15, '{\"action\":\"get_city\"}', '2021-08-11 09:09:37'),
(16, '{\"action\":\"get_city\"}', '2021-08-11 09:10:05'),
(17, '{\"action\":\"get_city\"}', '2021-08-11 09:10:07'),
(18, '{\"action\":\"get_city\"}', '2021-08-11 09:10:07'),
(19, '{\"action\":\"get_city\"}', '2021-08-11 09:10:08'),
(20, '{\"action\":\"get_city\"}', '2021-08-11 09:10:08'),
(21, '{\"action\":\"get_city\"}', '2021-08-11 09:10:08'),
(22, '{\"action\":\"get_city\"}', '2021-08-11 09:10:34'),
(23, '{\"action\":\"get_city\"}', '2021-08-11 09:10:35'),
(24, '{\"action\":\"get_city\"}', '2021-08-11 09:10:35'),
(25, '{\"action\":\"get_city\"}', '2021-08-11 09:10:35'),
(26, '{\"action\":\"get_city\"}', '2021-08-11 09:10:35'),
(27, '{\"action\":\"get_city\"}', '2021-08-11 09:11:05'),
(28, '{\"action\":\"get_city\"}', '2021-08-11 09:11:06'),
(29, '{\"action\":\"get_city\"}', '2021-08-11 09:11:45'),
(30, '{\"action\":\"get_type_of_application\"}', '2021-08-11 10:31:26'),
(31, '{\"action\":\"get_applicator_class\"}', '2021-08-11 10:34:24'),
(32, '{\"action\":\"get_type_of_application\"}', '2021-08-11 10:34:28'),
(33, '{\"action\":\"get_type_of_application\"}', '2021-08-11 10:34:31'),
(34, '{\"action\":\"get_type_of_application\"}', '2021-08-11 10:35:05'),
(35, '{\"action\":\"get_applicator_class\"}', '2021-08-11 10:35:09'),
(36, '{\"action\":\"get_applicator_class\"}', '2021-08-11 10:35:11'),
(37, '{\"action\":\"get_applicators_annual_turnover\"}', '2021-08-11 10:39:40'),
(38, '{\"action\":\"get_dealer_type\"}', '2021-08-11 10:52:53'),
(39, '{\"action\":\"get_dealer_type\",\"id\":\"1\"}', '2021-08-11 10:52:59'),
(40, '{\"action\":\"get_dealer_type\"}', '2021-08-11 10:53:04'),
(41, '{\"action\":\"get_dealer_type\",\"id2\":\"\"}', '2021-08-11 10:53:12'),
(42, '{\"action\":\"get_dealer_type\",\"id\":\"2\"}', '2021-08-11 10:53:15'),
(43, '{\"action\":\"get_type_of_firm\"}', '2021-08-11 11:07:20'),
(44, '{\"action\":\"get_type_of_firm\",\"id\":\"2\"}', '2021-08-11 11:07:27'),
(45, '{\"action\":\"get_dealer_class\",\"id\":\"2\"}', '2021-08-11 11:21:00'),
(46, '{\"action\":\"get_dealer_class\"}', '2021-08-11 11:21:07'),
(47, '{\"action\":\"get_dealers_annual_turnover\"}', '2021-08-11 11:35:30'),
(48, '{\"action\":\"get_zone\"}', '2021-08-11 13:37:11'),
(49, '{\"action\":\"get_circle\"}', '2021-08-11 13:38:39'),
(50, '{\"action\":\"get_circle\"}', '2021-08-11 13:38:45'),
(51, '{\"action\":\"get_circle\"}', '2021-08-11 13:38:56'),
(52, '{\"action\":\"get_circle\"}', '2021-08-11 13:38:57'),
(53, '{\"action\":\"get_circle\"}', '2021-08-11 13:39:15'),
(54, '{\"action\":\"get_circle\"}', '2021-08-11 14:13:50'),
(55, '{\"action\":\"get_dealer_type\"}', '2021-08-14 13:54:52'),
(56, '{\"action\":\"get_builder_category\"}', '2021-08-14 13:54:56'),
(57, '{\"action\":\"get_builder_category\"}', '2021-08-14 13:55:47'),
(58, '{\"action\":\"get_type_of_project_site\"}', '2021-08-14 13:57:24'),
(59, '{\"action\":\"get_area_segmentation\"}', '2021-08-14 13:58:34'),
(60, '{\"action\":\"get_influencer_type\"}', '2021-08-14 14:00:33'),
(61, '{\"action\":\"get_work_type\"}', '2021-08-14 14:01:10'),
(62, '{\"action\":\"get_city\"}', '2021-08-21 07:37:14'),
(63, '{\"action\":\"get_area_segmentation\"}', '2021-08-21 07:37:27'),
(64, '{\"action\":\"get_area_segmentation\"}', '2021-08-21 07:37:38'),
(65, '{\"action\":\"get_area_segmentation\"}', '2021-08-21 07:37:40'),
(66, '{\"action\":\"get_influencer_type\"}', '2021-08-21 07:37:53'),
(67, '{\"action\":\"get_influencer_type\"}', '2021-08-21 07:38:28'),
(68, '{\"action\":\"get_work_type\"}', '2021-08-21 07:38:53'),
(69, '{\"action\":\"get_work_type\"}', '2021-08-21 07:38:58'),
(70, '{\"action\":\"get_dealer_visit_purpose\"}', '2021-08-21 07:41:36'),
(71, '{\"action\":\"get_dealer_visit_purpose\"}', '2021-08-21 07:41:50'),
(72, '{\"action\":\"get_dealer_visit_purpose\"}', '2021-08-21 07:41:53'),
(73, '{\"action\":\"get_dealer_visit_purpose\"}', '2021-08-21 07:42:03'),
(74, '{\"action\":\"get_dealer_visit_purpose\"}', '2021-08-21 07:42:15'),
(75, '{\"action\":\"get_site_visit_purpose\"}', '2021-08-21 07:44:14'),
(76, '{\"action\":\"get_applicator_visit_purpose\"}', '2021-08-21 07:46:00'),
(77, '{\"action\":\"get_select_customer_type\"}', '2021-08-21 07:47:28'),
(78, '{\"action\":\"get_select_customer_type\"}', '2021-08-21 07:47:34'),
(79, '{\"action\":\"get_type_of_sample\"}', '2021-08-21 07:49:29'),
(80, '{\"action\":\"get_surface_type\"}', '2021-08-21 07:50:46'),
(81, '{\"action\":\"get_meeting_type\"}', '2021-08-21 07:51:45'),
(82, '{\"action\":\"get_trial_status\"}', '2021-08-21 07:53:27'),
(83, '{\"action\":\"get_reason_for_failure\"}', '2021-08-21 07:55:41'),
(84, '{\"action\":\"get_reason_for_not_interested\"}', '2021-08-21 07:57:18'),
(85, '{\"action\":\"get_reason_for_not_buying\"}', '2021-08-21 07:58:59'),
(86, '{\"action\":\"get_inquiry_source\"}', '2021-08-21 07:59:38'),
(87, '{\"action\":\"get_inquiry_source\"}', '2021-08-21 08:00:32'),
(88, '{\"action\":\"get_inquiry_source\"}', '2021-08-21 08:00:40'),
(89, '{\"action\":\"get_complaint_raised_by\"}', '2021-08-21 08:01:19'),
(90, '{\"action\":\"get_complaint_raised_by\"}', '2021-08-21 08:02:11'),
(91, '{\"action\":\"get_product_group\"}', '2021-08-21 08:03:28'),
(92, '{\"action\":\"get_product_category\"}', '2021-08-21 08:04:14'),
(93, '{\"action\":\"zyd_product_category\"}', '2021-08-21 08:05:06'),
(94, '{\"action\":\"get_product_category\"}', '2021-08-21 08:05:11'),
(95, '{\"action\":\"get_product_group\"}', '2021-08-21 08:05:19'),
(96, '{\"action\":\"get_sku\"}', '2021-08-21 08:06:48'),
(97, '{\"action\":\"add_applicator\",\"type\":\"1\",\"name\":\"Applicator 2\",\"mobile\":\"7878787878\",\"dob\":\"22-01-1990\",\"anniversary\":\"12-12-2016\",\"email\":\"app@zydex.com\",\"state_id\":\"3\",\"city_id\":\"4\",\"annual_turnover\":\"26\",\"no_of_labour\":\"63\",\"applicator_class\":\"4\",\"using_brand\":\"Brand Name\",\"dealer_id\":\"1,2\",\"influencer_id\":\"2,3\",\"assigned_to\":\"\",\"login_user_id\":\"422\"}', '2021-08-25 14:49:14'),
(98, '{\"action\":\"add_applicator\",\"type\":\"1\",\"name\":\"Applicator 2\",\"mobile\":\"7878787878\",\"dob\":\"22-01-1990\",\"anniversary\":\"12-12-2016\",\"email\":\"app@zydex.com\",\"state_id\":\"3\",\"city_id\":\"4\",\"annual_turnover\":\"26\",\"no_of_labour\":\"63\",\"applicator_class\":\"4\",\"using_brand\":\"Brand Name\",\"dealer_id\":\"1,2\",\"influencer_id\":\"1\",\"assigned_to\":\"\",\"login_user_id\":\"544\"}', '2021-08-25 14:50:41'),
(99, '{\"action\":\"update_applicator\",\"update_id\":\"5\",\"type\":\"1\",\"name\":\"Applicator 2\",\"mobile\":\"7878787878\",\"dob\":\"22-01-1990\",\"anniversary\":\"12-12-2016\",\"email\":\"app@zydex.com\",\"state_id\":\"3\",\"city_id\":\"4\",\"annual_turnover\":\"26\",\"no_of_labour\":\"63\",\"applicator_class\":\"4\",\"using_brand\":\"Brand Name\",\"dealer_id\":\"1,2\",\"influencer_id\":\"1\",\"assigned_to\":\"\",\"login_user_id\":\"544\"}', '2021-08-25 14:53:36'),
(100, '{\"action\":\"update_applicator\",\"update_id\":\"5\",\"type\":\"1\",\"name\":\"Applicator 2\",\"mobile\":\"7878787878\",\"dob\":\"22-01-1990\",\"anniversary\":\"12-12-2016\",\"email\":\"app@zydex.com\",\"state_id\":\"3\",\"city_id\":\"4\",\"annual_turnover\":\"30\",\"no_of_labour\":\"65\",\"applicator_class\":\"4\",\"using_brand\":\"Brand Name\",\"dealer_id\":\"1,2\",\"influencer_id\":\"1\",\"assigned_to\":\"\",\"login_user_id\":\"544\"}', '2021-08-25 14:53:59'),
(101, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:37:50'),
(102, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:38:50'),
(103, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:39:17'),
(104, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:40:29'),
(105, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:41:21'),
(106, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:41:25'),
(107, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:41:58'),
(108, '{\"action\":\"get_applicator\",\"login_user_id\":\"544\"}', '2021-08-26 07:42:31'),
(109, '{\"action\":\"get_applicator\",\"login_user_id\":\"422\"}', '2021-08-26 07:43:42'),
(110, '{\"action\":\"get_applicator\",\"login_user_id\":\"422\"}', '2021-08-26 07:43:47'),
(111, '{\"action\":\"get_applicator\",\"login_user_id\":\"422\"}', '2021-08-26 08:59:33'),
(112, '{\"action\":\"get_applicator\",\"login_user_id\":\"422\"}', '2021-08-26 08:59:58'),
(113, '{\"action\":\"add_dealer\",\"login_user_id\":\"544\",\"customer_type\":\"direct_customer\",\"customer_category\":\"sub_dealer\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"pin_code\":\"390939\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"firm_type\":\"proprietorship\",\"owner_name\":\"Bachubhai\",\"owner_dob\":\"01-01-1957\",\"owner_anniversary\":\"01-01-1970\",\"dealership\":\"Dealership of other companies\",\"turnover\":\"10\",\"start_business_year\":\"15\",\"zydex_rank_id\":\"1\",\"zydex_class_id\":\"1\",\"godown_space\":\"15\",\"sap_code\":\"12560\"}', '2021-08-26 17:56:11'),
(114, '{\"action\":\"add_dealer\",\"login_user_id\":\"544\",\"customer_type\":\"direct_customer\",\"customer_category\":\"sub_dealer\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"pin_code\":\"390939\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"firm_type\":\"proprietorship\",\"owner_name\":\"Bachubhai\",\"owner_dob\":\"01-01-1957\",\"owner_anniversary\":\"01-01-1970\",\"dealership\":\"Dealership of other companies\",\"turnover\":\"10\",\"start_business_year\":\"15\",\"zydex_rank_id\":\"1\",\"zydex_class_id\":\"1\",\"godown_space\":\"15\",\"sap_code\":\"12560\"}', '2021-08-26 17:56:44'),
(115, '{\"action\":\"update_dealer\",\"login_user_id\":\"544\",\"update_id\":\"3\",\"customer_type\":\"direct_customer\",\"customer_category\":\"sub_dealer\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"pin_code\":\"390939\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"firm_type\":\"proprietorship\",\"owner_name\":\"Bachubhai\",\"owner_dob\":\"01-01-1957\",\"owner_anniversary\":\"01-01-1970\",\"dealership\":\"Dealership of other companies\",\"turnover\":\"10\",\"start_business_year\":\"15\",\"zydex_rank_id\":\"1\",\"zydex_class_id\":\"1\",\"godown_space\":\"15\",\"sap_code\":\"12560\"}', '2021-08-26 18:00:17'),
(116, '{\"action\":\"update_dealer\",\"login_user_id\":\"544\",\"update_id\":\"3\",\"customer_type\":\"direct_customer\",\"customer_category\":\"sub_dealer\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"pin_code\":\"390939\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"firm_type\":\"proprietorship\",\"owner_name\":\"Bachubhai\",\"owner_dob\":\"01-01-1957\",\"owner_anniversary\":\"01-01-1970\",\"dealership\":\"Dealership of other companies\",\"turnover\":\"10\",\"start_business_year\":\"15\",\"zydex_rank_id\":\"1\",\"zydex_class_id\":\"1\",\"godown_space\":\"15\",\"sap_code\":\"12560\"}', '2021-08-26 18:00:59'),
(117, '{\"action\":\"get_dealer\",\"login_user_id\":\"422\"}', '2021-08-26 18:03:33'),
(118, '{\"action\":\"get_dealer\",\"login_user_id\":\"422\"}', '2021-08-26 18:03:51'),
(119, '{\"action\":\"get_dealer\",\"login_user_id\":\"422\"}', '2021-08-26 18:19:35'),
(120, '{\"action\":\"get_dealer\",\"login_user_id\":\"422\"}', '2021-08-26 18:19:54'),
(121, '{\"action\":\"add_builder_group\",\"login_user_id\":\"544\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"owner_name\":\"Kantibhai Patel\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"website\":\"zydex.com\",\"zydex_class_id\":\"1\",\"no_project_complete\":\"10\",\"no_project_ongoing\":\"20\",\"waterproofing_companies\":\"30\",\"paint_companies\":\"40\",\"cc_companies\":\"50\",\"working_other_cities\":\"1\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 10:13:20'),
(122, '{\"action\":\"update_builder_group\",\"update_id\":\"1\",\"login_user_id\":\"544\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"owner_name\":\"Kantibhai Patel\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"website\":\"zydex.com\",\"zydex_class_id\":\"1\",\"no_project_complete\":\"10\",\"no_project_ongoing\":\"20\",\"waterproofing_companies\":\"30\",\"paint_companies\":\"40\",\"cc_companies\":\"50\",\"working_other_cities\":\"1\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 10:16:23'),
(123, '{\"action\":\"update_builder_group\",\"update_id\":\"1\",\"login_user_id\":\"544\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"owner_name\":\"Kantibhai Patel\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"website\":\"zydex.com\",\"zydex_class_id\":\"1\",\"no_project_complete\":\"101\",\"no_project_ongoing\":\"202\",\"waterproofing_companies\":\"303\",\"paint_companies\":\"404\",\"cc_companies\":\"505\",\"working_other_cities\":\"1\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 10:16:31'),
(124, '{\"action\":\"get_builder_group\",\"login_user_id\":\"422\"}', '2021-08-27 10:18:58'),
(125, '{\"action\":\"get_builder_group\",\"login_user_id\":\"422\"}', '2021-08-27 10:19:11'),
(126, '{\"action\":\"get_builder_group\",\"login_user_id\":\"544\"}', '2021-08-27 10:19:27'),
(127, '{\"action\":\"get_builder_group\",\"login_user_id\":\"544\"}', '2021-08-27 10:21:38'),
(128, '{\"action\":\"get_builder_group\",\"login_user_id\":\"544\"}', '2021-08-27 10:21:55'),
(129, '{\"action\":\"add_influencer\",\"login_user_id\":\"544\",\"influencer_type\":\"zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"work_type_id\":\"1\",\"builder_group_ids_\":\"10\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 11:58:23'),
(130, '{\"action\":\"add_influencer\",\"login_user_id\":\"544\",\"influencer_type\":\"zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"work_type_id\":\"1\",\"builder_group_ids_\":\"10\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 12:01:23'),
(131, '{\"action\":\"update_influencer\",\"udpate_id\":\"1\",\"login_user_id\":\"544\",\"influencer_type\":\"zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"work_type_id\":\"1\",\"builder_group_ids\":\"10\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 12:02:37'),
(132, '{\"action\":\"update_influencer\",\"update_id\":\"1\",\"login_user_id\":\"544\",\"influencer_type\":\"zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"name\":\"Kisan firm\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"work_type_id\":\"1\",\"builder_group_ids\":\"10\",\"photo\":\"image.png\",\"assigned_to\":\"544\"}', '2021-08-27 12:02:42'),
(133, '{\"action\":\"get_influencer\",\"login_user_id\":\"544\"}', '2021-08-27 12:03:22'),
(134, '{\"action\":\"get_city\"}', '2021-08-28 10:40:51'),
(135, '{\"action\":\"get_zydex_rank\"}', '2021-08-28 10:40:54'),
(136, '{\"action\":\"get_zydex_rank\"}', '2021-08-28 10:40:55'),
(137, '{\"action\":\"add_project\",\"login_user_id\":\"544\",\"builder_group_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan \"}', '2021-08-30 08:44:53'),
(138, '{\"action\":\"update_project\",\"update_id\":\"1\",\"login_user_id\":\"544\",\"builder_group_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan\"}', '2021-08-30 08:47:26'),
(139, '{\"action\":\"get_projects\",\"login_user_id\":\"422\"}', '2021-08-30 08:48:38'),
(140, '{\"action\":\"get_projects\",\"login_user_id\":\"422\"}', '2021-08-30 08:49:00'),
(141, '{\"action\":\"get_projects\",\"login_user_id\":\"544\"}', '2021-08-30 08:49:14'),
(142, '{\"action\":\"get_applicator\",\"login_user_id\":\"422\"}', '2021-08-30 10:05:51'),
(143, '{\"action\":\"get_dealer\",\"login_user_id\":\"422\"}', '2021-08-30 10:05:54'),
(144, '{\"action\":\"get_builder_group\",\"login_user_id\":\"544\"}', '2021-08-30 10:05:57'),
(145, '{\"action\":\"get_influencer\",\"login_user_id\":\"544\"}', '2021-08-30 10:06:00'),
(146, '{\"action\":\"get_projects\",\"login_user_id\":\"544\"}', '2021-08-30 10:06:03'),
(147, '{\"action\":\"add_project\",\"login_user_id\":\"544\",\"builder_group_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan \",\"designation\":\"\",\"project_type_id\":\"\",\"area_segmentation_id\":\"\",\"project_potential_id\":\"\",\"supply_point\":\"\",\"dealer_id\":\"\",\"influencer_reference\":\"\",\"influencer_id\":\"\",\"architech_id\":\"\",\"architech_name\":\"\",\"architech_mobile\":\"\",\"architech_firm\":\"\",\"applicator_id\":\"\",\"applicator_name\":\"\",\"applicator_mobile\":\"\",\"applicator_firm\":\"\",\"civil_contractor_id\":\"\",\"civil_contractor_name\":\"\",\"civil_contractor_mobile\":\"\",\"civil_contractor_firm\":\"\",\"tile_contractor_id\":\"\",\"tile_contractor_name\":\"\",\"tile_contractor_mobile\":\"\",\"tile_contractor_firm\":\"\",\"paint_contractor_id\":\"\",\"paint_contractor_name\":\"\",\"paint_contractor_mobile\":\"\",\"paint_contractor_firm\":\"\"}', '2021-08-30 10:47:19'),
(148, '{\"action\":\"add_project\",\"login_user_id\":\"544\",\"builder_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan \",\"designation\":\"\",\"project_type_id\":\"\",\"area_segmentation_id\":\"\",\"project_potential_id\":\"\",\"supply_point\":\"\",\"dealer_id\":\"\",\"influencer_reference\":\"\",\"influencer_id\":\"\",\"architech_id\":\"\",\"architech_name\":\"\",\"architech_mobile\":\"\",\"architech_firm\":\"\",\"applicator_id\":\"\",\"applicator_name\":\"\",\"applicator_mobile\":\"\",\"applicator_firm\":\"\",\"civil_contractor_id\":\"\",\"civil_contractor_name\":\"\",\"civil_contractor_mobile\":\"\",\"civil_contractor_firm\":\"\",\"tile_contractor_id\":\"\",\"tile_contractor_name\":\"\",\"tile_contractor_mobile\":\"\",\"tile_contractor_firm\":\"\",\"paint_contractor_id\":\"\",\"paint_contractor_name\":\"\",\"paint_contractor_mobile\":\"\",\"paint_contractor_firm\":\"\"}', '2021-08-30 10:47:46'),
(149, '{\"action\":\"add_project\",\"login_user_id\":\"544\",\"builder_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan \",\"designation\":\"\",\"project_type_id\":\"\",\"area_segmentation_id\":\"\",\"project_potential_id\":\"\",\"supply_point\":\"\",\"dealer_id\":\"\",\"influencer_reference\":\"\",\"influencer_id\":\"\",\"architech_id\":\"\",\"architech_name\":\"\",\"architech_mobile\":\"\",\"architech_firm\":\"\",\"applicator_id\":\"\",\"applicator_name\":\"\",\"applicator_mobile\":\"\",\"applicator_firm\":\"\",\"civil_contractor_id\":\"\",\"civil_contractor_name\":\"\",\"civil_contractor_mobile\":\"\",\"civil_contractor_firm\":\"\",\"tile_contractor_id\":\"\",\"tile_contractor_name\":\"\",\"tile_contractor_mobile\":\"\",\"tile_contractor_firm\":\"\",\"paint_contractor_id\":\"\",\"paint_contractor_name\":\"\",\"paint_contractor_mobile\":\"\",\"paint_contractor_firm\":\"\"}', '2021-08-30 10:48:11'),
(150, '{\"action\":\"update_project\",\"update_id\":\"1\",\"login_user_id\":\"544\",\"builder_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan\",\"designation\":\"\",\"project_type_id\":\"\",\"area_segmentation_id\":\"\",\"project_potential_id\":\"\",\"supply_point\":\"\",\"dealer_id\":\"\",\"influencer_reference\":\"\",\"influencer_id\":\"\",\"architech_id\":\"\",\"architech_name\":\"\",\"architech_mobile\":\"\",\"architech_firm\":\"\",\"applicator_id\":\"\",\"applicator_name\":\"\",\"applicator_mobile\":\"\",\"applicator_firm\":\"\",\"civil_contractor_id\":\"\",\"civil_contractor_name\":\"\",\"civil_contractor_mobile\":\"\",\"civil_contractor_firm\":\"\",\"tile_contractor_id\":\"\",\"tile_contractor_name\":\"\",\"tile_contractor_mobile\":\"\",\"tile_contractor_firm\":\"\",\"paint_contractor_id\":\"\",\"paint_contractor_name\":\"\",\"paint_contractor_mobile\":\"\",\"paint_contractor_firm\":\"\"}', '2021-08-30 10:48:14'),
(151, '{\"action\":\"add_site\",\"login_user_id\":\"544\",\"builder_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan\",\"designation\":\"Manager\",\"project_type_id\":\"1\",\"area_segmentation_id\":\"1\",\"project_potential_id\":\"1\",\"supply_point\":\"dealer\",\"dealer_id\":\"1\",\"influencer_reference\":\"yes\",\"influencer_id\":\"1\",\"applicator_id\":\"1\",\"applicator_name\":\"text\",\"applicator_mobile\":\"text\"}', '2021-08-31 07:59:42'),
(152, '{\"action\":\"update_site\",\"login_user_id\":\"544\",\"update_id\":\"1\",\"builder_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan\",\"designation\":\"Manager\",\"project_type_id\":\"1\",\"area_segmentation_id\":\"1\",\"project_potential_id\":\"1\",\"supply_point\":\"dealer\",\"dealer_id\":\"1\",\"influencer_reference\":\"yes\",\"influencer_id\":\"1\",\"applicator_id\":\"1\",\"applicator_name\":\"text\",\"applicator_mobile\":\"text\"}', '2021-08-31 08:00:47'),
(153, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:01:27'),
(154, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:09:29'),
(155, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:09:47'),
(156, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:10:31'),
(157, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:11:18'),
(158, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:11:58'),
(159, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:12:28'),
(160, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:13:06'),
(161, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:13:40'),
(162, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:13:59'),
(163, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:14:10'),
(164, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:14:31'),
(165, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:15:01'),
(166, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:15:46'),
(167, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:16:45'),
(168, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:16:51'),
(169, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:20:28'),
(170, '{\"action\":\"get_site\",\"login_user_id\":\"544\"}', '2021-08-31 08:20:37'),
(171, '{\"action\":\"get_projects\",\"login_user_id\":\"544\"}', '2021-08-31 08:21:43'),
(172, '{\"action\":\"get_projects\",\"login_user_id\":\"544\"}', '2021-08-31 08:22:25'),
(173, '{\"action\":\"get_projects\",\"login_user_id\":\"422\"}', '2021-08-31 08:22:40'),
(174, '{\"action\":\"update_site\",\"login_user_id\":\"544\",\"update_id\":\"1\",\"builder_id\":\"10\",\"name\":\"Kishan Project\",\"state_id\":\"2\",\"city_id\":\"2\",\"address\":\"Near Airport\",\"mobile\":\"9955336655\",\"email\":\"kisan@zydex.com\",\"owner_name\":\"Kantibhai Patel\",\"assigned_to\":\"544\",\"area\":\"Main Road\",\"landmark\":\"Opp Gardan\",\"designation\":\"Manager\",\"project_type_id\":\"1\",\"area_segmentation_id\":\"1\",\"project_potential_id\":\"1\",\"supply_point\":\"dealer\",\"dealer_id\":\"1\",\"influencer_reference\":\"yes\",\"influencer_id\":\"1\",\"applicator_id\":\"1\",\"applicator_name\":\"text\",\"applicator_mobile\":\"text\"}', '2021-08-31 13:37:30'),
(175, '{\"action\":\"below_employee\",\"login_user_id\":\"544\"}', '2021-08-31 13:38:15'),
(176, '{\"action\":\"below_employee\",\"login_user_id\":\"422\"}', '2021-08-31 13:38:22'),
(177, '{\"action\":\"get_state\"}', '2021-08-31 13:50:32'),
(178, '{\"action\":\"get_state\"}', '2021-08-31 13:50:42'),
(179, '{\"action\":\"get_state\"}', '2021-08-31 13:50:48'),
(180, '{\"action\":\"get_state\"}', '2021-08-31 13:50:58'),
(181, '{\"action\":\"get_state\"}', '2021-08-31 13:51:39'),
(182, '{\"action\":\"get_state\"}', '2021-08-31 13:52:23'),
(183, '{\"action\":\"get_state\",\"login_user_id\":\"\"}', '2021-08-31 13:53:44'),
(184, '{\"action\":\"get_state\",\"login_user_id\":\"422\"}', '2021-08-31 13:53:55'),
(185, '{\"action\":\"get_state\",\"login_user_id\":\"422\"}', '2021-08-31 13:54:08'),
(186, '{\"action\":\"get_state\",\"login_user_id\":\"422\"}', '2021-08-31 13:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `zyd_state`
--

CREATE TABLE `zyd_state` (
  `id` int(11) NOT NULL,
  `state` text,
  `is_deleted` int(11) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `inserted_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zyd_state`
--

INSERT INTO `zyd_state` (`id`, `state`, `is_deleted`, `status`, `inserted_time`, `updated_time`, `user_id`) VALUES
(2, 'Delhi', 0, 'active', NULL, '2021-02-24 11:40:02', NULL),
(3, 'Gujarat', 0, 'active', '2021-02-24 14:37:33', '2021-03-02 11:03:59', '422'),
(4, 'Tamilnadu', 0, 'active', '2021-02-25 06:16:26', '2022-02-05 15:28:32', '422'),
(5, 'Jharkhand', 0, 'active', '2021-02-25 06:20:49', NULL, '422'),
(6, 'Himachal', 0, 'active', '2021-03-02 10:50:33', '2021-08-11 04:06:56', '422'),
(7, 'MP', 1, 'inactive', '2021-09-11 07:39:01', '2021-09-11 07:39:10', '1'),
(8, 'MAHARASHTRA', 0, 'active', '2022-02-05 15:36:12', NULL, '1'),
(9, 'MAHARASHTRA', 1, 'active', '2022-02-05 15:38:05', NULL, '1'),
(10, 'Madhya Pradesh', 0, 'active', '2024-11-19 11:49:49', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apidoc`
--
ALTER TABLE `apidoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `sam_accessrights`
--
ALTER TABLE `sam_accessrights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_customers`
--
ALTER TABLE `sam_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_customers_address`
--
ALTER TABLE `sam_customers_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_customers_contact`
--
ALTER TABLE `sam_customers_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_settings`
--
ALTER TABLE `sam_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_users`
--
ALTER TABLE `sam_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_users_old`
--
ALTER TABLE `sam_users_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sam_vandor_contact`
--
ALTER TABLE `sam_vandor_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bank_installment`
--
ALTER TABLE `tbl_bank_installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation_challan`
--
ALTER TABLE `tbl_quotation_challan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_salesorder`
--
ALTER TABLE `tbl_salesorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_update_fields`
--
ALTER TABLE `tbl_update_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_amc`
--
ALTER TABLE `tech_amc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_amc_device`
--
ALTER TABLE `tech_amc_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_amc_device_type`
--
ALTER TABLE `tech_amc_device_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_challan`
--
ALTER TABLE `tech_challan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_challan_item`
--
ALTER TABLE `tech_challan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_component`
--
ALTER TABLE `tech_component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_customer_category`
--
ALTER TABLE `tech_customer_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_expense`
--
ALTER TABLE `tech_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_expense_category`
--
ALTER TABLE `tech_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_industry_type`
--
ALTER TABLE `tech_industry_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_inquiry`
--
ALTER TABLE `tech_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_inquiry_item`
--
ALTER TABLE `tech_inquiry_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_inquiry_source`
--
ALTER TABLE `tech_inquiry_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_inquiry_term_condition`
--
ALTER TABLE `tech_inquiry_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_invoice`
--
ALTER TABLE `tech_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_invoice_item`
--
ALTER TABLE `tech_invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_invoice_term_condition`
--
ALTER TABLE `tech_invoice_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_notification`
--
ALTER TABLE `tech_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_payment_mode`
--
ALTER TABLE `tech_payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_problem_report`
--
ALTER TABLE `tech_problem_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_product_attributes`
--
ALTER TABLE `tech_product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_product_attributes_value`
--
ALTER TABLE `tech_product_attributes_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_product_sub_category`
--
ALTER TABLE `tech_product_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_purchase_order`
--
ALTER TABLE `tech_purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_purchase_order_item`
--
ALTER TABLE `tech_purchase_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_purchase_order_term_condition`
--
ALTER TABLE `tech_purchase_order_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_quotation`
--
ALTER TABLE `tech_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_quotation_item`
--
ALTER TABLE `tech_quotation_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_quotation_term_condition`
--
ALTER TABLE `tech_quotation_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_sales_order`
--
ALTER TABLE `tech_sales_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_sales_order_item`
--
ALTER TABLE `tech_sales_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_sales_order_item_term_condition`
--
ALTER TABLE `tech_sales_order_item_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_service`
--
ALTER TABLE `tech_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_service_category`
--
ALTER TABLE `tech_service_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_term_condition`
--
ALTER TABLE `tech_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_tickets`
--
ALTER TABLE `tech_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_tickets_priority`
--
ALTER TABLE `tech_tickets_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_tickets_problem_report`
--
ALTER TABLE `tech_tickets_problem_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_tickets_reply`
--
ALTER TABLE `tech_tickets_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_tickets_solution_information`
--
ALTER TABLE `tech_tickets_solution_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_tickets_status`
--
ALTER TABLE `tech_tickets_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_ticket_problem_report`
--
ALTER TABLE `tech_ticket_problem_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_ticket_term_condition`
--
ALTER TABLE `tech_ticket_term_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tech_uom`
--
ALTER TABLE `tech_uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_city`
--
ALTER TABLE `zyd_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_department`
--
ALTER TABLE `zyd_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_designation`
--
ALTER TABLE `zyd_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_products_img`
--
ALTER TABLE `zyd_products_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_products_mst`
--
ALTER TABLE `zyd_products_mst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_products_mst_attribute`
--
ALTER TABLE `zyd_products_mst_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_product_brand`
--
ALTER TABLE `zyd_product_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_product_category`
--
ALTER TABLE `zyd_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_request_log`
--
ALTER TABLE `zyd_request_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zyd_state`
--
ALTER TABLE `zyd_state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apidoc`
--
ALTER TABLE `apidoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sam_accessrights`
--
ALTER TABLE `sam_accessrights`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `sam_customers`
--
ALTER TABLE `sam_customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `sam_customers_address`
--
ALTER TABLE `sam_customers_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sam_customers_contact`
--
ALTER TABLE `sam_customers_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sam_users`
--
ALTER TABLE `sam_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sam_users_old`
--
ALTER TABLE `sam_users_old`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sam_vandor_contact`
--
ALTER TABLE `sam_vandor_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_bank_installment`
--
ALTER TABLE `tbl_bank_installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_quotation_challan`
--
ALTER TABLE `tbl_quotation_challan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_salesorder`
--
ALTER TABLE `tbl_salesorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_update_fields`
--
ALTER TABLE `tbl_update_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tech_amc`
--
ALTER TABLE `tech_amc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tech_amc_device`
--
ALTER TABLE `tech_amc_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tech_amc_device_type`
--
ALTER TABLE `tech_amc_device_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tech_challan`
--
ALTER TABLE `tech_challan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tech_challan_item`
--
ALTER TABLE `tech_challan_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tech_component`
--
ALTER TABLE `tech_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tech_customer_category`
--
ALTER TABLE `tech_customer_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tech_expense`
--
ALTER TABLE `tech_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tech_expense_category`
--
ALTER TABLE `tech_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tech_industry_type`
--
ALTER TABLE `tech_industry_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tech_inquiry`
--
ALTER TABLE `tech_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tech_inquiry_item`
--
ALTER TABLE `tech_inquiry_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tech_inquiry_source`
--
ALTER TABLE `tech_inquiry_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tech_inquiry_term_condition`
--
ALTER TABLE `tech_inquiry_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tech_invoice`
--
ALTER TABLE `tech_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tech_invoice_item`
--
ALTER TABLE `tech_invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tech_invoice_term_condition`
--
ALTER TABLE `tech_invoice_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tech_notification`
--
ALTER TABLE `tech_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `tech_payment_mode`
--
ALTER TABLE `tech_payment_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tech_problem_report`
--
ALTER TABLE `tech_problem_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tech_product_attributes`
--
ALTER TABLE `tech_product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tech_product_attributes_value`
--
ALTER TABLE `tech_product_attributes_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tech_product_sub_category`
--
ALTER TABLE `tech_product_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tech_purchase_order`
--
ALTER TABLE `tech_purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tech_purchase_order_item`
--
ALTER TABLE `tech_purchase_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tech_purchase_order_term_condition`
--
ALTER TABLE `tech_purchase_order_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tech_quotation`
--
ALTER TABLE `tech_quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tech_quotation_item`
--
ALTER TABLE `tech_quotation_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tech_quotation_term_condition`
--
ALTER TABLE `tech_quotation_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tech_sales_order`
--
ALTER TABLE `tech_sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tech_sales_order_item`
--
ALTER TABLE `tech_sales_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tech_sales_order_item_term_condition`
--
ALTER TABLE `tech_sales_order_item_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tech_service`
--
ALTER TABLE `tech_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tech_service_category`
--
ALTER TABLE `tech_service_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tech_term_condition`
--
ALTER TABLE `tech_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tech_tickets`
--
ALTER TABLE `tech_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tech_tickets_priority`
--
ALTER TABLE `tech_tickets_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tech_tickets_problem_report`
--
ALTER TABLE `tech_tickets_problem_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tech_tickets_reply`
--
ALTER TABLE `tech_tickets_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tech_tickets_solution_information`
--
ALTER TABLE `tech_tickets_solution_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tech_tickets_status`
--
ALTER TABLE `tech_tickets_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tech_ticket_problem_report`
--
ALTER TABLE `tech_ticket_problem_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tech_ticket_term_condition`
--
ALTER TABLE `tech_ticket_term_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tech_uom`
--
ALTER TABLE `tech_uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zyd_city`
--
ALTER TABLE `zyd_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `zyd_department`
--
ALTER TABLE `zyd_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zyd_designation`
--
ALTER TABLE `zyd_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `zyd_products_img`
--
ALTER TABLE `zyd_products_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `zyd_products_mst`
--
ALTER TABLE `zyd_products_mst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zyd_products_mst_attribute`
--
ALTER TABLE `zyd_products_mst_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zyd_product_brand`
--
ALTER TABLE `zyd_product_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `zyd_product_category`
--
ALTER TABLE `zyd_product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `zyd_request_log`
--
ALTER TABLE `zyd_request_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `zyd_state`
--
ALTER TABLE `zyd_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
