-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2020 at 12:15 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topaz-build-1.8`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_events`
--

CREATE TABLE IF NOT EXISTS `audit_events` (
  `id` int(100) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `short_desc` varchar(300) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `long_desc` text,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `custom` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=498 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_events`
--

INSERT INTO `audit_events` (`id`, `name`, `short_desc`, `type`, `long_desc`, `created_date`, `custom`) VALUES
(1, '1', '', '1', '1', '2019-01-28 15:47:01', ''),
(2, 'User login', '', 'userlogin', 'Systems Administrator', '2019-01-28 15:48:27', ''),
(3, 'Checklist is currently un-published.', '', 'Document event: warning', '', '2019-01-28 15:56:42', ''),
(4, 'Checklist Updated', 'Test Checklist', 'checklist', 'Name: Test ChecklistType ID: 121Associated Unit: 0', '2019-01-28 15:56:47', ''),
(5, 'The values entered have been inserted/updated correctly.', '', 'Document event: success', '', '2019-01-28 15:56:47', ''),
(6, 'The username and/or password do not match our records. Please try again.', '', 'Document event: err', '', '2019-01-28 15:58:26', ''),
(7, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-01-28 15:58:32', ''),
(8, 'Checklist Updated', 'Test Checklist', 'checklist', 'Name: Test Checklist<br />Type ID: 121<br />Associated Unit: 114', '2019-01-28 15:58:43', ''),
(9, 'The values entered have been inserted/updated correctly.', '', 'Document event: success', '', '2019-01-28 15:58:43', ''),
(10, 'Checklist Added', 'Test add 2', 'checklist', 'Name: Test add 2<br />Type ID: 121<br />Associated Unit: ', '2019-01-28 16:01:07', ''),
(11, 'Checklist Added', 'Test', 'checklist', 'Name: Test<br />Type ID: 121<br />Associated Unit: ', '2019-01-28 16:06:45', ''),
(12, 'Checklist is currently un-published.', '', 'warning', '', '2019-01-28 16:06:49', ''),
(13, 'Checklist is currently un-published.', '', 'warning', '', '2019-01-28 16:06:57', ''),
(14, 'Check List name: The value you entered is not valid.', '', 'err', '', '2019-01-28 16:06:57', ''),
(15, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-01-27 15:58:32', ''),
(16, 'User login', '', 'userlogin', 'Systems Administrator', '2019-01-26 15:48:27', ''),
(17, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-01-28 19:35:26', ''),
(18, 'QA Checklist is currently un-published.', '', 'warning', '', '2019-01-28 20:29:57', ''),
(19, 'Checklist is disabled. No QA recording can be completed using this checklist.', '', 'err', '', '2019-01-28 20:29:57', ''),
(20, 'QA Checklist is currently un-published.', '', 'warning', '', '2019-01-28 20:30:05', ''),
(21, 'Checklist is disabled. No QA recording can be completed using this checklist.', '', 'err', '', '2019-01-28 20:30:05', ''),
(22, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-01-28 20:37:39', ''),
(23, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-01-28 20:37:54', ''),
(24, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-01-28 22:13:33', ''),
(25, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-02-01 18:11:30', ''),
(26, 'Audit is currently un-published.', '', 'warning', '', '2019-02-01 18:25:21', ''),
(27, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-02-01 18:25:21', ''),
(28, 'Audit is currently un-published.', '', 'warning', '', '2019-02-01 18:26:40', ''),
(29, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-02-01 18:26:40', ''),
(30, 'Audit is currently un-published.', '', 'warning', '', '2019-02-01 18:26:56', ''),
(31, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-02-01 18:26:56', ''),
(32, 'Audit is currently un-published.', '', 'warning', '', '2019-02-01 18:27:04', ''),
(33, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-02-01 18:27:04', ''),
(34, 'Audit is currently un-published.', '', 'warning', '', '2019-02-01 18:27:13', ''),
(35, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-02-01 18:27:13', ''),
(36, 'Checklist Added', 'Files test', 'checklist', 'Name: Files test<br />Type ID: 121<br />Associated Unit: ', '2019-02-01 18:40:14', ''),
(37, 'Checklist is currently un-published.', '', 'warning', '', '2019-02-01 18:40:19', ''),
(38, 'Checklist is currently un-published.', '', 'warning', '', '2019-02-01 18:40:21', ''),
(39, 'Checklist is currently un-published.', '', 'warning', '', '2019-02-01 18:40:40', ''),
(40, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-02-03 19:43:13', ''),
(41, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-02-03 19:43:19', ''),
(42, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-02-03 19:45:59', ''),
(43, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-02-03 22:22:17', ''),
(44, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-02-03 22:22:21', ''),
(45, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-02-03 22:23:15', ''),
(46, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-02-03 22:23:55', ''),
(47, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2019-02-03 22:24:05', ''),
(48, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2019-02-03 22:24:08', ''),
(49, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2019-02-03 22:24:20', ''),
(50, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-02-03 23:03:23', ''),
(51, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-02-03 23:03:44', ''),
(52, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-02-04 20:04:08', ''),
(53, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-02-04 20:04:16', ''),
(54, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-02-04 20:18:58', ''),
(55, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-02-04 20:51:28', ''),
(56, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-02-07 12:38:48', ''),
(57, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-02-25 11:48:09', ''),
(58, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-02-25 11:48:16', ''),
(59, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-03-03 19:41:37', ''),
(60, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-04-04 21:31:04', ''),
(61, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-04-04 21:31:11', ''),
(62, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-04-07 14:13:40', ''),
(63, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-04-07 14:13:45', ''),
(64, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-04-07 15:09:27', ''),
(65, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-04-07 15:09:31', ''),
(66, 'Checklist is currently un-published.', '', 'warning', '', '2019-04-07 15:09:34', ''),
(67, 'Checklist is currently un-published.', '', 'warning', '', '2019-04-07 15:09:36', ''),
(68, '<p>There are no records to report on for this version of the list.</p>', '', 'err', '', '2019-04-07 17:17:41', ''),
(69, '<p>There are no records to report on for this version of the list.</p>', '', 'err', '', '2019-04-07 17:18:12', ''),
(70, '<p>There are no records to report on for this version of the list.</p>', '', 'err', '', '2019-04-07 17:18:19', ''),
(71, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-04-07 17:18:36', ''),
(72, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-04-07 17:18:41', ''),
(73, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-04-07 19:47:28', ''),
(74, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-04-07 20:38:19', ''),
(75, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-04-07 20:38:42', ''),
(76, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-04-07 20:39:02', ''),
(77, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-04-16 19:03:45', ''),
(78, 'Checklist Added', 'incident Management Checklist', 'checklist', 'Name: incident Management Checklist<br />Type ID: 120<br />Associated Unit: ', '2019-04-16 19:11:18', ''),
(79, 'Checklist is currently un-published.', '', 'warning', '', '2019-04-16 19:11:29', ''),
(80, 'Checklist is currently un-published.', '', 'warning', '', '2019-04-16 19:11:31', ''),
(81, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-06-02 19:54:34', ''),
(82, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-06-02 19:55:37', ''),
(83, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-02 20:58:35', ''),
(84, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-02 22:13:05', ''),
(85, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=874&confirm', '', 'warning', '', '2019-07-02 22:20:41', ''),
(86, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=883&confirm', '', 'warning', '', '2019-07-02 22:20:46', ''),
(87, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=875&confirm', '', 'warning', '', '2019-07-02 22:20:49', ''),
(88, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=882&confirm', '', 'warning', '', '2019-07-02 22:20:53', ''),
(89, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=876&confirm', '', 'warning', '', '2019-07-02 22:20:56', ''),
(90, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=877&confirm', '', 'warning', '', '2019-07-02 22:21:00', ''),
(91, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=878&confirm', '', 'warning', '', '2019-07-02 22:21:03', ''),
(92, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=884&confirm', '', 'warning', '', '2019-07-02 22:21:07', ''),
(93, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=885&confirm', '', 'warning', '', '2019-07-02 22:21:11', ''),
(94, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=879&confirm', '', 'warning', '', '2019-07-02 22:21:14', ''),
(95, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=881&confirm', '', 'warning', '', '2019-07-02 22:21:30', ''),
(96, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=880&confirm', '', 'warning', '', '2019-07-02 22:21:35', ''),
(97, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=872&del=873&confi', '', 'warning', '', '2019-07-02 22:21:41', ''),
(98, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=872&confirm', '', 'warning', '', '2019-07-02 22:21:47', ''),
(99, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-02 22:29:55', ''),
(100, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-02 22:49:41', ''),
(101, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-02 22:49:46', ''),
(102, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-02 23:03:18', ''),
(103, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-02 23:05:53', ''),
(104, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-02 23:11:33', ''),
(105, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-02 23:11:50', ''),
(106, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-02 23:11:52', ''),
(107, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-02 23:12:43', ''),
(108, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-04 12:48:29', ''),
(109, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-04 12:52:55', ''),
(110, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-04 12:57:55', ''),
(111, 'You are not authorised to access this section.', '', 'err', '', '2019-07-04 12:58:14', ''),
(112, 'You are not authorised to access this section.', '', 'err', '', '2019-07-04 12:58:16', ''),
(113, 'You are not authorised to access this section.', '', 'err', '', '2019-07-04 12:58:18', ''),
(114, '<p>Oops, looks like the page you are looking for is missing or might be a document assigned as a Wiki Page.<br />Please contact your Systems Administr', '', 'err', '', '2019-07-04 13:02:12', ''),
(115, '<p>Oops, looks like the page you are looking for is missing or might be a document assigned as a Wiki Page.<br />Please contact your Systems Administr', '', 'err', '', '2019-07-04 13:02:12', ''),
(116, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=886&del=891&confi', '', 'warning', '', '2019-07-04 13:02:29', ''),
(117, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=886&del=891&confi', '', 'warning', '', '2019-07-04 13:02:51', ''),
(118, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=886&del=891&confi', '', 'warning', '', '2019-07-04 13:02:54', ''),
(119, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-09 09:16:23', ''),
(120, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-10 11:22:16', ''),
(121, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-10 11:26:57', ''),
(122, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-10 11:27:09', ''),
(123, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-10 11:27:16', ''),
(124, 'A comment is required as some of the mandatory fields have not been recorded.', '', 'warning', '', '2019-07-10 11:40:51', ''),
(125, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-12 08:50:34', ''),
(126, 'Checklist Added', 'Task list test', 'checklist', 'Name: Task list test<br />Type ID: 119<br />Associated Unit: ', '2019-07-12 09:53:35', ''),
(127, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-12 09:53:45', ''),
(128, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-12 09:53:50', ''),
(129, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-07-12 09:54:42', ''),
(130, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-07-12 09:54:44', ''),
(131, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2019-07-12 09:54:50', ''),
(132, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-07-12 10:05:14', ''),
(133, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2019-07-12 10:05:38', ''),
(134, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-12 10:41:32', ''),
(135, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-15 13:55:17', ''),
(136, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-15 14:03:28', ''),
(137, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-15 14:07:06', ''),
(138, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-15 14:07:22', ''),
(139, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-15 14:07:48', ''),
(140, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-15 14:07:51', ''),
(141, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2019-07-15 14:09:24', ''),
(142, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-15 14:32:13', ''),
(143, '<p>You are about to move a document and its child nodes</p><br /><form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-m', '', 'warning', '', '2019-07-15 14:36:40', ''),
(144, 'You are not authorised to access this section.', '', 'err', '', '2019-07-15 14:37:21', ''),
(145, 'You are not authorised to access this section.', '', 'err', '', '2019-07-15 14:37:24', ''),
(146, 'You are not authorised to access this section.', '', 'err', '', '2019-07-15 14:37:25', ''),
(147, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-15 14:37:40', ''),
(148, 'Checklist is currently un-published.', '', 'warning', '', '2019-07-15 14:37:47', ''),
(149, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-15 16:30:48', ''),
(150, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-15 16:31:34', ''),
(151, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-15 16:35:09', ''),
(152, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-15 16:35:13', ''),
(153, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-07-16 16:13:52', ''),
(154, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-16 16:14:45', ''),
(155, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-16 16:14:57', ''),
(156, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-24 09:15:47', ''),
(157, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2019-07-24 11:43:17', ''),
(158, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 11:47:49', ''),
(159, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 11:47:54', ''),
(160, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 11:47:57', ''),
(161, 'Email: The value you entered is not valid.', '', 'err', '', '2019-07-24 11:49:41', ''),
(162, 'Job Title: The value you entered is not valid.', '', 'err', '', '2019-07-24 11:49:41', ''),
(163, 'Passwords: The value you entered is not valid.', '', 'err', '', '2019-07-24 11:49:41', ''),
(164, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-24 14:14:02', ''),
(165, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-24 14:14:23', ''),
(166, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-07-24 14:17:12', ''),
(167, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 14:44:09', ''),
(168, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 14:44:14', ''),
(169, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 14:44:15', ''),
(170, 'You are not authorised to access this section.', '', 'err', '', '2019-07-24 14:44:16', ''),
(171, 'File 1 (.pdf): File type or extension is not correct', '', 'err', '', '2019-07-24 15:51:18', ''),
(172, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-30 15:19:18', ''),
(173, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:33:54', ''),
(174, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:35:12', ''),
(175, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-30 15:35:27', ''),
(176, 'User logged in', '', 'userlogin', 'Toni  Kelly', '2019-07-30 15:35:35', ''),
(177, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:35:47', ''),
(178, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-30 15:38:17', ''),
(179, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-30 15:38:50', ''),
(180, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-30 15:38:57', ''),
(181, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:42:26', ''),
(182, 'You are not authorised to access this section.', '', 'err', '', '2019-07-30 15:44:00', ''),
(183, 'You are not authorised to access this section.', '', 'err', '', '2019-07-30 15:44:06', ''),
(184, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-07-30 15:46:59', ''),
(185, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:47:03', ''),
(186, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:47:52', ''),
(187, 'User logged in', '', 'userlogin', 'Harrison West', '2019-07-30 15:49:04', ''),
(188, 'You must complete all questions to record attendance.', '', 'err', '', '2019-07-30 15:52:57', ''),
(189, 'You are not authorised to access this section.', '', 'err', '', '2019-07-30 16:11:51', ''),
(190, 'You are not authorised to access this section.', '', 'err', '', '2019-07-30 16:11:54', ''),
(191, 'You are not authorised to access this section.', '', 'err', '', '2019-07-30 16:11:55', ''),
(192, 'Audit is currently un-published.', '', 'warning', '', '2019-07-30 16:12:56', ''),
(193, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-07-30 16:12:56', ''),
(194, 'Audit is currently un-published.', '', 'warning', '', '2019-07-30 16:14:01', ''),
(195, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-07-30 16:14:01', ''),
(196, 'Audit is currently un-published.', '', 'warning', '', '2019-07-30 16:14:04', ''),
(197, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-07-30 16:14:04', ''),
(198, 'Audit is currently un-published.', '', 'warning', '', '2019-07-30 16:14:09', ''),
(199, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-07-30 16:14:09', ''),
(200, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-30 16:16:12', ''),
(201, 'No presenter has been selected for the 2019-07-31 13:28:00', '', 'warning', '', '2019-07-30 16:22:43', ''),
(202, 'Warning! You are about to delete some data.<a href="https://demo1.topazweb.net/console/index.php?t=education-tracker&o=ins-edit&id=7&did=5&confirm=1">', '', 'warning', '', '2019-07-30 16:22:56', ''),
(203, 'User logged in', '', 'userlogin', 'Justin Dixon', '2019-07-30 16:28:32', ''),
(204, 'User logged in', '', 'userlogin', 'Justin Dixon', '2019-07-30 16:30:54', ''),
(205, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=894&search=true"   ><input type="text" nam', '', 'info', '', '2019-07-30 16:35:34', ''),
(206, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=894&search=true"   ><input type="text" nam', '', 'info', '', '2019-07-30 16:35:37', ''),
(207, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2019-07-30 16:37:11', ''),
(208, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-30 16:38:19', ''),
(209, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-30 16:38:23', ''),
(210, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-30 16:38:37', ''),
(211, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-07-30 16:38:41', ''),
(212, '<p>You are about to move a document and its child nodes</p><br /><form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-m', '', 'warning', '', '2019-07-30 16:40:04', ''),
(213, 'You are not authorised to perform this action.', '', 'warning', '', '2019-07-30 16:42:58', ''),
(214, 'User logged in', '', 'userlogin', 'Justin Dixon', '2019-07-31 08:40:44', ''),
(215, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-07-31 14:17:51', ''),
(216, 'Audit Name: The value you entered is not valid.', '', 'err', '', '2019-07-31 14:27:50', ''),
(217, 'Audit is currently un-published.', '', 'warning', '', '2019-07-31 14:27:57', ''),
(218, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2019-07-31 14:27:57', ''),
(219, 'User logged in', '', 'userlogin', 'Demo Admin', '2019-08-15 12:53:25', ''),
(220, 'There are associated users with this group. Deleting will remove association.', '', 'warning', '', '2019-08-15 13:38:47', ''),
(221, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=user-manager&o=groups&del=45&confirm=1">Continue</', '', 'warning', '', '2019-08-15 13:38:47', ''),
(222, 'There are associated users with this group. Deleting will remove association.', '', 'warning', '', '2019-08-15 13:38:54', ''),
(223, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=user-manager&o=groups&del=45&confirm=1">Continue</', '', 'warning', '', '2019-08-15 13:38:54', ''),
(224, 'The data could not be deleted. No matching data found.', '', 'err', '', '2019-08-15 13:38:57', ''),
(225, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 13:44:57', ''),
(226, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&search=true"   ><input type="text" name=', '', 'info', '', '2019-08-15 13:51:32', ''),
(227, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&search=true"   ><input type="text" name=', '', 'info', '', '2019-08-15 13:51:36', ''),
(228, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-15 13:53:17', ''),
(229, 'In-Service: The value you entered is not valid.', '', 'err', '', '2019-08-15 13:54:13', ''),
(230, 'Credits: The value you entered is not valid.', '', 'err', '', '2019-08-15 13:54:13', ''),
(231, 'Credits: The value you entered is not valid.', '', 'err', '', '2019-08-15 14:00:18', ''),
(232, 'Checklist Added', 'LA1', 'checklist', 'Name: LA1<br />Type ID: 121<br />Associated Unit: ', '2019-08-15 14:06:24', ''),
(233, 'Title must be specified', '', 'err', '', '2019-08-15 14:10:18', ''),
(234, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2019-08-15 14:10:33', ''),
(235, '<form method="post" action="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=0&search=true"   ><input type="text" name=', '', 'info', '', '2019-08-15 14:14:32', ''),
(236, 'Warning! You are about to delete some data. <a href="https://demo1.topazweb.net/console/index.php?t=document-manager&o=documents&pid=1&del=902&confirm', '', 'warning', '', '2019-08-15 14:33:09', ''),
(237, 'Checklist Added', 'asd', 'checklist', 'Name: asd<br />Type ID: 119<br />Associated Unit: ', '2019-08-15 14:38:12', ''),
(238, 'Checklist Added', 'asdasd', 'checklist', 'Name: asdasd<br />Type ID: 119<br />Associated Unit: ', '2019-08-15 14:38:42', ''),
(239, 'Checklist Added', 'ASasdfr', 'checklist', 'Name: ASasdfr<br />Type ID: 121<br />Associated Unit: ', '2019-08-15 14:39:19', ''),
(240, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:40:25', ''),
(241, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:40:27', ''),
(242, 'QA Checklist is currently un-published.', '', 'warning', '', '2019-08-15 14:41:57', ''),
(243, 'Checklist is disabled. No QA recording can be completed using this checklist.', '', 'err', '', '2019-08-15 14:41:57', ''),
(244, 'QA Checklist is currently un-published.', '', 'warning', '', '2019-08-15 14:43:57', ''),
(245, 'Checklist is disabled. No QA recording can be completed using this checklist.', '', 'err', '', '2019-08-15 14:43:57', ''),
(246, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2019-08-15 14:44:50', ''),
(247, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:49:46', ''),
(248, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:49:49', ''),
(249, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:51:02', ''),
(250, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:51:02', ''),
(251, 'You are not authorised to access this section.', '', 'err', '', '2019-08-15 14:51:03', ''),
(252, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-15 15:14:51', ''),
(253, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-15 15:35:20', ''),
(254, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-15 15:54:03', ''),
(255, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-08-22 16:47:52', ''),
(256, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-08-22 16:48:00', ''),
(257, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-22 16:48:05', ''),
(258, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-08-22 16:52:56', ''),
(259, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-08-22 16:53:15', ''),
(260, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-22 16:53:23', ''),
(261, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-08-22 16:54:11', ''),
(262, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-08-22 16:54:17', ''),
(263, 'User logged in', '', 'userlogin', 'Harrison West', '2019-08-22 16:54:22', ''),
(264, 'User logged in', '', 'userlogin', 'Kate Murray', '2019-08-22 16:54:53', ''),
(265, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-10-12 13:25:57', ''),
(266, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-10-12 16:32:26', ''),
(267, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-10-12 16:37:49', ''),
(268, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-10-12 16:38:02', ''),
(269, 'Checklist Added', 'Feedback Profile 1', 'checklist', 'Name: Feedback Profile 1<br />Type ID: 131<br />Associated Unit: ', '2019-10-12 17:03:44', ''),
(270, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:03:50', ''),
(271, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:03:51', ''),
(272, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:05:26', ''),
(273, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:19:17', ''),
(274, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:19:24', ''),
(275, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:20:12', ''),
(276, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:20:16', ''),
(277, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:20:45', ''),
(278, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:21:27', ''),
(279, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:23:10', ''),
(280, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:23:13', ''),
(281, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:23:57', ''),
(282, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:26:17', ''),
(283, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 17:26:37', ''),
(284, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-10-12 21:06:49', ''),
(285, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-10-12 21:06:54', ''),
(286, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-10-12 21:07:02', ''),
(287, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:07:11', ''),
(288, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:07:13', ''),
(289, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:07:32', ''),
(290, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:09:09', ''),
(291, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:14:38', ''),
(292, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:15:24', ''),
(293, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:26:05', ''),
(294, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:26:33', ''),
(295, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:32:01', ''),
(296, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:33:26', ''),
(297, 'Checklist is currently un-published.', '', 'warning', '', '2019-10-12 21:33:48', ''),
(298, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-11-03 14:50:37', ''),
(299, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2019-11-03 14:50:41', ''),
(300, 'User logged in', '', 'userlogin', 'Systems Administrator', '2019-11-03 14:50:48', ''),
(301, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-04-27 12:01:54', ''),
(302, 'Insufficient user rights access for this document.', '', 'err', '', '2020-04-27 12:03:05', ''),
(303, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-02 08:52:06', ''),
(304, 'Audit is disabled. No recording can be completed using this audit.', '', 'err', '', '2020-05-02 09:28:24', ''),
(305, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 12:44:09', ''),
(306, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-02 16:30:08', ''),
(307, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 16:33:09', ''),
(308, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-02 16:37:50', ''),
(309, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 16:38:26', ''),
(310, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 16:38:52', ''),
(311, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:14:22', ''),
(312, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:14:45', ''),
(313, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:21:28', ''),
(314, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:22:00', ''),
(315, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:22:03', ''),
(316, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:22:35', ''),
(317, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:22:38', ''),
(318, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=option-editor&o=view-user-groups&id=37&del=7', '', 'warning', '', '2020-05-02 17:49:04', ''),
(319, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 17:59:12', ''),
(320, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-02 18:00:24', ''),
(321, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-02 18:00:25', ''),
(322, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-02 18:00:41', ''),
(323, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:03:04', ''),
(324, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:04:26', ''),
(325, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:05:50', ''),
(326, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:06:32', ''),
(327, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:06:52', ''),
(328, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:08:07', ''),
(329, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:08:26', ''),
(330, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:18:10', ''),
(331, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:18:48', ''),
(332, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:19:02', ''),
(333, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:19:10', ''),
(334, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:19:16', ''),
(335, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:19:35', ''),
(336, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:20:03', ''),
(337, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:20:19', ''),
(338, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 18:20:28', ''),
(339, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-02 19:09:11', ''),
(340, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-03 09:14:23', ''),
(341, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-03 09:14:30', ''),
(342, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-03 09:14:37', ''),
(343, 'User already receiving notifications', '', 'warning', '', '2020-05-03 11:21:46', ''),
(344, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 11:22:10', ''),
(345, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 11:22:17', ''),
(346, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-03 16:56:26', ''),
(347, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 16:59:54', ''),
(348, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 17:00:07', ''),
(349, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 17:00:16', ''),
(350, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 17:01:39', ''),
(351, 'User is already receiving notifications', '', 'warning', '', '2020-05-03 17:09:50', ''),
(352, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=option-editor&o=view-user-groups&id=38&del=7', '', 'warning', '', '2020-05-03 17:59:00', ''),
(353, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-03 18:00:33', ''),
(354, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-03 19:37:49', ''),
(355, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-03 19:38:06', ''),
(356, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-03 19:38:16', ''),
(357, 'Checklist is disabled. No data recording can be completed using this checklist.', '', 'err', '', '2020-05-03 19:38:39', ''),
(358, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-04 08:09:39', ''),
(359, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-04 09:17:16', ''),
(360, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-04 09:23:50', ''),
(361, '<p>You are about to move a document and its child nodes</p><br /><form method="post" action="http://localhost/topaz-build-1.8/console/index.php?t=docu', '', 'warning', '', '2020-05-04 10:03:19', ''),
(362, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-04 12:38:14', ''),
(363, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-05 09:21:11', ''),
(364, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-05 09:21:18', ''),
(365, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-05 09:37:19', ''),
(366, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=139&confir', '', 'warning', '', '2020-05-05 09:42:02', ''),
(367, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=cred_type&del=144&co', '', 'warning', '', '2020-05-05 10:13:43', ''),
(368, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=cred_type&del=145&co', '', 'warning', '', '2020-05-05 10:13:47', ''),
(369, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=cred_type&del=147&co', '', 'warning', '', '2020-05-05 10:28:11', ''),
(370, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=cred_type&del=146&co', '', 'warning', '', '2020-05-05 10:28:15', ''),
(371, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=148&confir', '', 'warning', '', '2020-05-05 10:28:30', ''),
(372, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=143&confir', '', 'warning', '', '2020-05-05 10:28:36', ''),
(373, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=142&confir', '', 'warning', '', '2020-05-05 10:28:39', ''),
(374, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=141&confir', '', 'warning', '', '2020-05-05 10:28:42', ''),
(375, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=140&confir', '', 'warning', '', '2020-05-05 10:29:01', ''),
(376, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=138&confir', '', 'warning', '', '2020-05-05 10:29:05', ''),
(377, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-05 10:29:07', ''),
(378, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=cred_type&del=150&co', '', 'warning', '', '2020-05-05 10:35:27', ''),
(379, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=151&confir', '', 'warning', '', '2020-05-05 10:35:41', ''),
(380, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=152&confir', '', 'warning', '', '2020-05-05 10:35:56', ''),
(381, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=links&del=151&confir', '', 'warning', '', '2020-05-05 10:36:01', ''),
(382, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-06 09:10:26', ''),
(383, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-06 10:46:16', ''),
(384, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-06 10:46:41', ''),
(385, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-06 10:55:42', ''),
(386, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-06 10:55:50', ''),
(387, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-06 10:56:11', ''),
(388, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-06 10:56:15', ''),
(389, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-08 14:21:50', ''),
(390, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-08 14:22:52', ''),
(391, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-08 14:23:36', ''),
(392, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-08 14:23:42', ''),
(393, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-08 14:24:08', ''),
(394, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-08 14:24:09', ''),
(395, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-11 09:13:11', ''),
(396, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-11 09:15:51', ''),
(397, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:19:15', ''),
(398, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:28:09', ''),
(399, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:28:15', ''),
(400, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:32:54', ''),
(401, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:23', ''),
(402, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:28', ''),
(403, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:31', ''),
(404, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:34', ''),
(405, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:38', ''),
(406, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:42', ''),
(407, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:33:45', ''),
(408, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:34:30', ''),
(409, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:34:43', ''),
(410, 'Checklist is currently un-published. A previous version of this checklist is still active for data recording.', '', 'warning', '', '2020-05-11 09:47:10', ''),
(411, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-11 12:47:34', ''),
(412, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 09:27:55', ''),
(413, 'Warning! You are about to delete some data.<a href="http://localhost/topaz-build-1.8/console/index.php?t=education-tracker&o=ins&did=11&confirm=1">Con', '', 'warning', '', '2020-05-12 09:31:13', ''),
(414, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-12 09:32:58', ''),
(415, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-12 09:33:01', ''),
(416, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-12 09:33:08', ''),
(417, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-12 09:33:17', ''),
(418, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 09:33:21', ''),
(419, 'Email address is already registered.', '', 'warning', '', '2020-05-12 09:33:36', ''),
(420, 'User logged in', '', 'userlogin', 'Adam Heaney', '2020-05-12 09:33:48', ''),
(421, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-12 09:46:39', ''),
(422, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 09:46:43', ''),
(423, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 10:11:47', '');
INSERT INTO `audit_events` (`id`, `name`, `short_desc`, `type`, `long_desc`, `created_date`, `custom`) VALUES
(424, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 10:39:14', ''),
(425, 'Email address is already registered.', '', 'warning', '', '2020-05-12 12:49:12', ''),
(426, 'QA Checklist is currently un-published. A previous version of this checklist is still active for QA recording.', '', 'warning', '', '2020-05-12 13:29:50', ''),
(427, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-12 13:30:08', ''),
(428, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-12 13:30:13', ''),
(429, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 15:24:21', ''),
(430, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2020-05-12 16:36:58', ''),
(431, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2020-05-12 16:37:18', ''),
(432, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 16:53:39', ''),
(433, '<p>There are no records to report on for this version.</p>', '', 'err', '', '2020-05-12 16:57:06', ''),
(434, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 17:07:40', ''),
(435, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-12 17:09:35', ''),
(436, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-14 10:44:43', ''),
(437, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-14 11:04:29', ''),
(438, 'Email address is already registered.', '', 'warning', '', '2020-05-14 11:43:26', ''),
(439, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-14 11:57:49', ''),
(440, 'Warning! You are about to delete some data. <a href="http://localhost/topaz-build-1.8/console/index.php?t=system&o=typelists&type=edu_typ&del=153&conf', '', 'warning', '', '2020-05-14 12:30:10', ''),
(441, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-14 15:52:27', ''),
(442, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-14 15:52:31', ''),
(443, 'QA Checklist is currently un-published. A previous version of this checklist is still active for QA recording.', '', 'warning', '', '2020-05-14 16:27:31', ''),
(444, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2020-05-14 17:29:53', ''),
(445, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-14 19:18:46', ''),
(446, 'No system IDs exist', '', 'err', '', '2020-05-14 20:07:03', ''),
(447, 'No system IDs exist', '', 'err', '', '2020-05-14 20:10:45', ''),
(448, 'No system IDs exist', '', 'err', '', '2020-05-14 20:18:52', ''),
(449, 'No system IDs exist', '', 'err', '', '2020-05-14 20:27:28', ''),
(450, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-15 09:34:55', ''),
(451, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-15 09:35:00', ''),
(452, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-16 09:18:12', ''),
(453, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-16 09:18:16', ''),
(454, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-16 09:18:21', ''),
(455, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2020-05-16 09:48:28', ''),
(456, 'There was a database error. Please contact your Systems Administrator. ', '', 'err', '', '2020-05-16 09:49:13', ''),
(457, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-16 10:00:39', ''),
(458, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-16 10:00:47', ''),
(459, 'The username and/or password do not match our records. Please try again.', '', 'err', '', '2020-05-16 10:00:55', ''),
(460, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-16 12:36:54', ''),
(461, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 08:47:56', ''),
(462, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 08:48:09', ''),
(463, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 08:51:12', ''),
(464, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 08:55:36', ''),
(465, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:07:52', ''),
(466, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:08:12', ''),
(467, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:08:21', ''),
(468, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:08:42', ''),
(469, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:09:56', ''),
(470, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:10:18', ''),
(471, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:10:48', ''),
(472, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:11:04', ''),
(473, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:11:56', ''),
(474, 'Requested action cannot be completed. System ID not found.', '', 'err', '', '2020-05-18 09:13:18', ''),
(475, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-18 09:50:56', ''),
(476, 'Checklist Added', 'Feedback Demo 1', 'checklist', 'Name: Feedback Demo 1<br />Type ID: 131<br />Associated Unit: ', '2020-05-18 10:13:08', ''),
(477, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-18 10:13:15', ''),
(478, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-18 10:13:16', ''),
(479, 'Checklist is currently un-published.', '', 'warning', '', '2020-05-18 10:14:00', ''),
(480, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-18 12:59:34', ''),
(481, 'QA Checklist is currently un-published. A previous version of this checklist is still active for QA recording.', '', 'warning', '', '2020-05-18 13:23:31', ''),
(482, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-19 09:21:58', ''),
(483, '<form method="post" action="http://localhost/topaz-build-1.8/console/index.php?t=document-manager&o=documents&pid=1&search=true"   ><input type="text"', '', 'info', '', '2020-05-19 09:22:17', ''),
(484, 'You are not authorised to access this section.', '', 'err', '', '2020-05-28 10:08:10', ''),
(485, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-28 10:08:20', ''),
(486, 'You are not authorised to access this section.', '', 'err', '', '2020-05-28 13:08:05', ''),
(487, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-28 13:08:13', ''),
(488, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-28 14:31:46', ''),
(489, 'You are not authorised to access this section.', '', 'err', '', '2020-05-28 16:16:04', ''),
(490, 'You are not authorised to access this section.', '', 'err', '', '2020-05-28 16:23:06', ''),
(491, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-05-28 16:23:16', ''),
(492, 'User logged in', '', 'userlogin', 'Systems Administrator', '2020-06-14 16:37:36', ''),
(493, 'Checklist is currently un-published.', '', 'warning', '', '2020-06-14 17:06:58', ''),
(494, 'Checklist is currently un-published.', '', 'warning', '', '2020-06-14 17:09:48', ''),
(495, 'Checklist is currently un-published.', '', 'warning', '', '2020-06-14 17:10:31', ''),
(496, 'QA Checklist is currently un-published. A previous version of this checklist is still active for QA recording.', '', 'warning', '', '2020-06-14 17:54:18', ''),
(497, 'QA Checklist is currently un-published. A previous version of this checklist is still active for QA recording.', '', 'warning', '', '2020-06-14 17:56:54', '');

-- --------------------------------------------------------

--
-- Table structure for table `document_events`
--

CREATE TABLE IF NOT EXISTS `document_events` (
  `id` int(11) NOT NULL,
  `did` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `eid` int(3) NOT NULL,
  `date` datetime NOT NULL,
  `link` varchar(200) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_events`
--

INSERT INTO `document_events` (`id`, `did`, `uid`, `eid`, `date`, `link`, `text`) VALUES
(1, 871, 1, 66, '2018-10-22 00:46:48', '', ''),
(34, 888, 75, 66, '2019-07-04 11:00:28', '', ''),
(35, 889, 75, 66, '2019-07-04 11:00:41', '', ''),
(36, 890, 75, 66, '2019-07-04 11:00:49', '', ''),
(31, 886, 1, 66, '2019-07-02 21:08:58', '', ''),
(32, 887, 1, 66, '2019-07-02 21:09:07', '', ''),
(33, 886, 1, 67, '2019-07-02 21:11:00', '', 'Document name: Radiation Therapy, Link (slug): radiation-therapy'),
(50, 896, 75, 60, '2019-07-30 14:37:29', '', 'All Groups'),
(49, 896, 75, 66, '2019-07-30 14:37:29', '', ''),
(48, 895, 75, 60, '2019-07-30 14:37:11', '', 'All Groups'),
(38, 892, 75, 66, '2019-07-15 12:33:18', '', ''),
(39, 892, 75, 24, '2019-07-15 12:33:18', '614044_v1.docx', ''),
(40, 892, 75, 28, '2019-07-15 12:33:18', '1', ''),
(41, 893, 75, 66, '2019-07-15 14:34:55', '', ''),
(42, 893, 75, 24, '2019-07-15 14:34:55', '789173_v1.pdf', ''),
(43, 893, 75, 28, '2019-07-15 14:34:55', '1', ''),
(44, 893, 75, 60, '2019-07-15 14:34:56', '', 'All Groups'),
(45, 894, 75, 66, '2019-07-24 13:50:04', '', ''),
(46, 895, 75, 66, '2019-07-30 14:37:11', '', ''),
(47, 895, 75, 26, '2019-07-30 14:37:11', '153703_v1.pdf', ''),
(51, 896, 75, 26, '2019-07-30 14:38:09', '153703_v1.pdf', ''),
(52, 896, 75, 31, '2019-07-30 14:40:31', '', '<p>\r\n	radiation. Test. Stuff</p>\r\n'),
(53, 896, 75, 58, '2019-07-30 14:41:05', '', 'RT Bookings (789173)'),
(54, 896, 75, 31, '2019-07-30 14:41:58', '', '<p>\r\n	Radiaition test. Test. Stuff</p>\r\n<p>\r\n	&nbsp;</p>\r\n'),
(55, 896, 75, 67, '2019-07-30 14:44:27', '', 'Link (slug): test, Status: Disabled'),
(56, 893, 75, 25, '2019-07-31 12:41:50', '789173_v1.pdf', ''),
(57, 893, 75, 24, '2019-07-31 12:41:50', '789173_v2.pdf', ''),
(58, 893, 75, 28, '2019-07-31 12:41:50', '2', ''),
(59, 897, 75, 66, '2019-08-15 12:06:52', '', ''),
(60, 898, 75, 66, '2019-08-15 12:08:08', '', ''),
(61, 898, 75, 60, '2019-08-15 12:08:09', '', 'All Groups'),
(62, 897, 75, 58, '2019-08-15 12:13:46', '', 'SABR (804152)'),
(63, 899, 75, 66, '2019-08-15 12:14:54', '', ''),
(64, 900, 75, 66, '2019-08-15 12:15:15', '', ''),
(65, 900, 75, 58, '2019-08-15 12:15:24', '', 'SABR (804152)'),
(66, 901, 75, 66, '2019-08-15 12:26:08', '', ''),
(67, 901, 75, 24, '2019-08-15 12:26:08', '474917_v1.pdf', ''),
(68, 901, 75, 28, '2019-08-15 12:26:08', '1', ''),
(72, 903, 75, 66, '2019-08-15 12:32:16', '', ''),
(73, 903, 75, 24, '2019-08-15 12:32:16', '455081_v1.pdf', ''),
(74, 903, 75, 28, '2019-08-15 12:32:16', '1', ''),
(75, 903, 1, 24, '2020-04-27 10:02:47', '455081_v2.pdf', ''),
(76, 903, 1, 28, '2020-04-27 10:02:47', '2', ''),
(77, 903, 1, 26, '2020-04-27 10:02:47', '455081_v2.txt', ''),
(78, 903, 1, 38, '2020-05-06 08:47:42', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `document_links`
--

CREATE TABLE IF NOT EXISTS `document_links` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `link` text NOT NULL,
  `did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document_properties`
--

CREATE TABLE IF NOT EXISTS `document_properties` (
  `did` int(6) NOT NULL,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `active` int(1) NOT NULL,
  `docno` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `reviewer` varchar(200) NOT NULL,
  `approver` varchar(200) NOT NULL,
  `doc_type` int(3) NOT NULL,
  `imp_date` date NOT NULL,
  `rev_date` date NOT NULL,
  `lock` int(10) NOT NULL DEFAULT '0',
  `unit` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_properties`
--

INSERT INTO `document_properties` (`did`, `name`, `link`, `active`, `docno`, `author`, `reviewer`, `approver`, `doc_type`, `imp_date`, `rev_date`, `lock`, `unit`) VALUES
(1, 'Home', 'home', 1, '0', '0', 'Marcus Tony', 'Tory Thurburton', 15, '0000-00-00', '0000-00-00', 0, '0'),
(896, 'test', 'test-radiation', 1, '153703', 'Harrison', '', '', 105, '2019-07-30', '2020-07-30', 0, '0'),
(897, 'LA1', 'la1', 1, '225694', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '130'),
(898, 'SABR', 'sabr', 1, '804152', 'Harrison West', 'harrison West', 'harrison West', 107, '2019-08-15', '2020-08-15', 0, '0'),
(894, 'TK test', 'tk-test', 1, '507320', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(888, 'CT', 'ct', 1, '738260', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(889, 'PLANNING', 'planning', 1, '505166', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(890, 'TMT', 'tmt', 1, '261760', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(892, 'Test Upload AA', 'test-upload-aa', 1, '614044', '', '', '', 104, '2019-07-15', '2020-07-15', 0, '0'),
(893, 'RT Bookings', 'rt-bookings', 1, '789173', '', '', '', 105, '2019-07-15', '2020-07-15', 0, '0'),
(887, 'Medical Oncology', 'medical-oncology', 0, '772646', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(886, 'Radiation Oncology', 'radiation-oncology', 1, '276096', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(871, 'Archive', 'archive', 0, '767803', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(899, 'Planning', 'planning-266287', 1, '266287', '', '', '', 37, '0000-00-00', '0000-00-00', 0, '0'),
(900, 'Breast', 'breast', 1, '785636', '', '', '', 104, '2019-08-15', '2020-08-15', 0, '0'),
(901, 'Booking test 2 ', 'booking-test-2', 1, '474917', '', '', '', 107, '2019-08-15', '2020-08-15', 0, '0'),
(903, 'Testingh', 'testingh', 1, '455081', '', '', '', 107, '2019-08-15', '2020-08-15', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `document_properties_ext`
--

CREATE TABLE IF NOT EXISTS `document_properties_ext` (
  `did` int(6) NOT NULL,
  `text` text NOT NULL,
  `pdf` varchar(300) NOT NULL,
  `doc` varchar(300) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  `standards` text NOT NULL,
  `related_docs` text NOT NULL,
  `private` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_properties_ext`
--

INSERT INTO `document_properties_ext` (`did`, `text`, `pdf`, `doc`, `version`, `standards`, `related_docs`, `private`) VALUES
(1, '<h1>\r\n	Home</h1>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=radiation-oncology"><img alt="" src="{website_loc}_uploads/images/home-page/btn-documents.png" style="width: 130px; height: 109px" /><br />\r\n	Radiation Oncology</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=checklist-manager&amp;t=119"><img alt="" src="{website_loc}_uploads/images/home-page/btn-quality-improvement.png" style="width: 130px; height: 109px" /><br />\r\n	Quality Improvement</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=qa-audits&amp;t=117"><img alt="" src="{website_loc}_uploads/images/home-page/btn-qa-audit.png" style="width: 130px; height: 109px" /><br />\r\n	Organisational Audits</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=msds-register"><img alt="" src="{website_loc}_uploads/images/home-page/btn-msds.png" style="width: 130px; height: 109px" /><br />\r\n	MSDS Register</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=checklist-manager&amp;t=121"><img alt="" src="{website_loc}_uploads/images/home-page/btn-report-faults.png" style="width: 130px; height: 109px" /><br />\r\n	General Faults</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=search"><img alt="" src="{website_loc}_uploads/images/home-page/btn-search.png" style="width: 130px; height: 109px" /><br />\r\n	Search Documents</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=contact-numbers"><img alt="" src="{website_loc}_uploads/images/home-page/btn-emergency-numbers.png" style="width: 130px; height: 109px" /><br />\r\n	Contact Numbers</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=directory"><img alt="" src="{website_loc}_uploads/images/home-page/btn-directory.png" style="width: 130px; height: 109px" /><br />\r\n	Staff Directory</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=checklist-manager&amp;t=122"><img alt="" src="{website_loc}_uploads/images/home-page/btn-radiotherapy.png" style="width: 130px; height: 109px" /><br />\r\n	Machine Faults</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=qa-audits&amp;t=118"><img alt="" src="{website_loc}_uploads/images/home-page/btn-rt-qa-audit.png" style="width: 130px; height: 109px" /><br />\r\n	RT QA Audits</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=checklist-manager&amp;t=120"><img alt="" src="{website_loc}_uploads/images/home-page/btn-incident.png" style="width: 130px; height: 109px" /><br />\r\n	Incidents</a></p>\r\n<p class="btn-home">\r\n	<a href="{website_loc}?p=machine-qa"><img alt="" src="{website_loc}_uploads/images/home-page/btn-machine-qa.png" style="width: 130px; height: 109px" /><br />\r\n	Machine QA</a></p>\r\n<p class="btn-home">\r\n	<a href="https://www.gotomypc.com/en_US/members/myComputers.tmpl" target="_blank"><img alt="" src="{website_loc}_uploads/images/home-page/btn-go-to-my-pc.png" style="width: 130px; height: 109px" /><br />\r\n	Go to My PC</a></p>\r\n', '', '', 0, '', '', ''),
(888, '', '', '', 0, '', '', ''),
(889, '', '', '', 0, '', '', ''),
(890, '', '', '', 0, '', '', ''),
(892, '', '614044_v1.docx', '', 1, '', '', ''),
(893, '', '789173_v2.pdf', '', 2, '', '896;', ''),
(894, '', '', '', 0, '', '', ''),
(895, '', '', '153703_v1.pdf', 1, '', '', ''),
(887, '', '', '', 0, '', '', ''),
(886, '', '', '', 0, '', '', ''),
(871, '', '', '', 0, '', '', ''),
(896, '', '', '153703_v1.pdf', 1, '', '893;', ''),
(897, '', '', '', 0, '', '898;', ''),
(898, '', '', '', 0, '', '897;900;', ''),
(899, '', '', '', 0, '', '', ''),
(900, '', '', '', 0, '', '898;', ''),
(901, '', '474917_v1.pdf', '', 1, '', '', ''),
(903, '', '455081_v2.pdf', '455081_v2.txt', 2, '', '', '44');

-- --------------------------------------------------------

--
-- Table structure for table `document_reads`
--

CREATE TABLE IF NOT EXISTS `document_reads` (
  `id` int(11) NOT NULL,
  `did` int(6) NOT NULL,
  `deid` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_reads`
--

INSERT INTO `document_reads` (`id`, `did`, `deid`, `uid`, `date`) VALUES
(1, 893, 44, 1, '0000-00-00 00:00:00'),
(2, 893, 44, 74, '0000-00-00 00:00:00'),
(3, 893, 44, 75, '0000-00-00 00:00:00'),
(4, 895, 48, 76, '0000-00-00 00:00:00'),
(5, 895, 48, 1, '0000-00-00 00:00:00'),
(6, 895, 48, 74, '0000-00-00 00:00:00'),
(7, 895, 48, 75, '0000-00-00 00:00:00'),
(8, 895, 48, 77, '0000-00-00 00:00:00'),
(9, 895, 48, 78, '0000-00-00 00:00:00'),
(10, 896, 50, 1, '0000-00-00 00:00:00'),
(11, 896, 50, 74, '0000-00-00 00:00:00'),
(12, 896, 50, 75, '0000-00-00 00:00:00'),
(13, 896, 50, 76, '2019-08-15 12:20:03'),
(14, 896, 50, 77, '0000-00-00 00:00:00'),
(15, 896, 50, 78, '0000-00-00 00:00:00'),
(16, 893, 0, 76, '2019-08-15 11:51:17'),
(17, 898, 61, 76, '0000-00-00 00:00:00'),
(18, 898, 61, 77, '0000-00-00 00:00:00'),
(19, 898, 61, 1, '0000-00-00 00:00:00'),
(20, 898, 61, 74, '0000-00-00 00:00:00'),
(21, 898, 61, 75, '0000-00-00 00:00:00'),
(22, 898, 61, 78, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `document_search`
--

CREATE TABLE IF NOT EXISTS `document_search` (
  `did` int(11) NOT NULL,
  `name` text,
  `link` text,
  `keywords` text,
  `gentext` text,
  `active` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_search`
--

INSERT INTO `document_search` (`did`, `name`, `link`, `keywords`, `gentext`, `active`) VALUES
(1, 'Home', 'home', '', '', 1),
(892, 'Test Upload AA', 'test-upload-aa', '', '', 1),
(893, 'RT Bookings', 'rt-bookings', 'committee,management,iscahn,information,data,technology,network,shoalhavencancer,haematology,governance,illawarra,reports,procurement,mechanism,reference', 'xx      TERMS OF REFERENCE Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT MEMBERSHIP xx      TERMS OF REFERENCE Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT xxTRIM DT                  REV                                       Ratified                                                 Page of THIS ISLHD DOCUMENT BECOMES UNCONTROLLED WHEN DOWNLOADED OR PRINTED Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT Governance Serves as the approval mechanism for new IT projectsProvides oversight of ITrelated projects underway in ISCaHNProvides approval and management of research and data requestsProcurement Procurement requests approvals are presented and overseen by the ISCaHN IT Procurement Governance committee The ITProcurement Governance committee will provide reports back to this committee for notingIT Security  StorageOversee and reviews the security and storage of IT in ISCaHNData management Supports and facilitates the development of data management capability in Cancer Services Provides an approval mechanism for major data requests or data management proposals  Oversees the management of data in ISCaHNand with a view to ensuring compliancwith ethical and regulatory requirements  FREQUENCY OF MEETINGS Monthly on the third Tuesday of the month at pm To be held in theLevel ICCC Function Room and Meeting Room  at SCCC via videoconference   SECRETARIAT Clerical Support Officer     EXECUTIVE SPONSOR Directorof Cancer Services REPORTING MECHANISM According to the ISCaHNGovernance and Committee Structure The IMT Committee reports directly to the ISCaHNExecutive xx      TERMS OF REFERENCE Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT xxTRIM DT                  REV                                       Ratified                                                 Page of THIS ISLHD DOCUMENT BECOMES UNCONTROLLED WHEN DOWNLOADED OR PRINTED The MOSAIQ Committee reports to the IMT Committee  The IMT Committee reports for information only to the Operational Management Committee Representatives on the IMT Committee must report information from the Committee through their Department meeting structures The ISCaHN IT Procurement Governance Committee report into this committeeIllawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT  METHOD OF EVALUATION Committee members are responsible to undertake an annual audit of the Committees Performance to determine its effectiveness and ensure compliance with Terms of Reference   Key Performance Indicators to be utilised in the evaluation include Attendance of members Number of Action items completed  ', 1),
(898, 'SABR', 'sabr', '', '', 1),
(900, 'Breast', 'breast', '', '', 1),
(901, 'Booking test 2 ', 'booking-test-2', 'committee,management,iscahn,information,data,technology,network,shoalhavencancer,haematology,governance,illawarra,reports,procurement,mechanism,reference', 'xx      TERMS OF REFERENCE Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT MEMBERSHIP xx      TERMS OF REFERENCE Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT xxTRIM DT                  REV                                       Ratified                                                 Page of THIS ISLHD DOCUMENT BECOMES UNCONTROLLED WHEN DOWNLOADED OR PRINTED Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT Governance Serves as the approval mechanism for new IT projectsProvides oversight of ITrelated projects underway in ISCaHNProvides approval and management of research and data requestsProcurement Procurement requests approvals are presented and overseen by the ISCaHN IT Procurement Governance committee The ITProcurement Governance committee will provide reports back to this committee for notingIT Security  StorageOversee and reviews the security and storage of IT in ISCaHNData management Supports and facilitates the development of data management capability in Cancer Services Provides an approval mechanism for major data requests or data management proposals  Oversees the management of data in ISCaHNand with a view to ensuring compliancwith ethical and regulatory requirements  FREQUENCY OF MEETINGS Monthly on the third Tuesday of the month at pm To be held in theLevel ICCC Function Room and Meeting Room  at SCCC via videoconference   SECRETARIAT Clerical Support Officer     EXECUTIVE SPONSOR Directorof Cancer Services REPORTING MECHANISM According to the ISCaHNGovernance and Committee Structure The IMT Committee reports directly to the ISCaHNExecutive xx      TERMS OF REFERENCE Illawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT xxTRIM DT                  REV                                       Ratified                                                 Page of THIS ISLHD DOCUMENT BECOMES UNCONTROLLED WHEN DOWNLOADED OR PRINTED The MOSAIQ Committee reports to the IMT Committee  The IMT Committee reports for information only to the Operational Management Committee Representatives on the IMT Committee must report information from the Committee through their Department meeting structures The ISCaHN IT Procurement Governance Committee report into this committeeIllawarra ShoalhavenCancer and Haematology Network ISCaHN Information Management and Technology Committee IMT  METHOD OF EVALUATION Committee members are responsible to undertake an annual audit of the Committees Performance to determine its effectiveness and ensure compliance with Terms of Reference   Key Performance Indicators to be utilised in the evaluation include Attendance of members Number of Action items completed  ', 1),
(895, 'test', 'test', '', '', 1),
(896, 'test', 'test-radiation', '', '', 1),
(903, 'Testingh', 'testingh', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `document_tree`
--

CREATE TABLE IF NOT EXISTS `document_tree` (
  `id` int(6) NOT NULL,
  `parent_id` int(6) NOT NULL DEFAULT '0',
  `lft` int(12) NOT NULL,
  `rgt` int(12) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=904 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_tree`
--

INSERT INTO `document_tree` (`id`, `parent_id`, `lft`, `rgt`) VALUES
(1, 0, 1, 36),
(892, 890, 26, 27),
(893, 888, 20, 21),
(899, 1, 2, 3),
(897, 1, 4, 7),
(889, 886, 17, 18),
(888, 886, 19, 24),
(890, 886, 25, 28),
(894, 1, 8, 13),
(895, 894, 9, 10),
(896, 894, 11, 12),
(898, 897, 5, 6),
(900, 886, 29, 30),
(887, 1, 14, 15),
(886, 1, 16, 31),
(871, 1, 32, 33),
(901, 888, 22, 23),
(903, 1, 34, 35);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `tid` int(3) NOT NULL,
  `expiry_period` int(2) NOT NULL DEFAULT '0',
  `credits` decimal(5,2) NOT NULL,
  `groups` varchar(100) NOT NULL,
  `mandatory` int(1) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `edu_type` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `name`, `tid`, `expiry_period`, `credits`, `groups`, `mandatory`, `text`, `edu_type`) VALUES
(4, 'Topaz demonstration', 32, 0, '2.00', '39', 1, '<p>\r\n	Overview of Topaz program</p>\r\n', 0),
(5, 'Wollongong Research Day', 41, 0, '0.00', '39;40', 0, '<p>\r\n	Overview of current research projects</p>\r\n', 0),
(6, 'Ortho QA ', 32, 0, '1.00', '', 1, '<p>\r\n	RT staff must learn how to perform QA prior to patient starting treatment</p>\r\n', 0),
(7, 'CPR', 32, 0, '2.00', '40', 1, '<p>\r\n	Staff to pass CPR</p>\r\n', 32),
(8, 'Topaz test', 41, 0, '0.00', '39;40', 0, '<p>\r\n	<br type="_moz" />\r\n	Test</p>\r\n', 0),
(9, 'asd', 32, 0, '1.00', '', 0, '<p>\r\n	asd</p>\r\n', 0),
(10, 'Pract', 32, 0, '123.00', '', 0, '', 0),
(11, 'Prac 2 ', 32, 0, '999.99', '40', 1, '', 0),
(12, 'demo prac', 32, 0, '21.00', '40', 0, '', 0),
(13, 'Test In-service', 32, 0, '1.00', '', 0, '<p>\r\n	Something here</p>\r\n', 0),
(14, 'ARIA Training', 32, 0, '1.00', '', 0, '<p>\r\n	Something about ARIA</p>\r\n', 33);

-- --------------------------------------------------------

--
-- Table structure for table `education_certificates`
--

CREATE TABLE IF NOT EXISTS `education_certificates` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `template` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_certificates`
--

INSERT INTO `education_certificates` (`id`, `name`, `template`, `active`) VALUES
(1, 'AIR appellation', '<style>\r\n.border { width: 100%; height: 100%; padding: 20px; text-align: center; border: 4px solid #666;\r\nbackground: linear-gradient(90deg, #CCC 10%, #FFF 90%) }\r\nh1 { color: #050D36; font-family: Baroque; font-size: 36pt; margin: 50px 0px 40px 0px; letter-spacing: 0.2pt; }\r\n.header-lt { display: block; width: 20%; text-align: left; float: left; margin-top: 20px; }\r\n.header-rt { display: block; width: 20%; text-align: right; float: right; margin-top: 20px; }\r\n.clear { clear: both; }\r\n.blue { color: #1CA1DA; font-style:italic; font-size: 16pt; margin: 30px 0px 10px 0px; }\r\n.highlight_name { color: #000; font-size: 32pt; margin: 0px; }\r\n.highlight { color: #000; font-size:16pt; margin: 10px 0px 30px 0px; }\r\n.signature { color: #000; font-size: 12pt; margin: 50px 0px 0px 0px; }\r\n.img_border { border: 2px solid #666; }\r\n</style>\r\n\r\n<body style="background: linear-gradient(90deg, #B8E3F5 20%, #1CA1DA 80%)">\r\n<div class="border">\r\n<div class="clear"></div>\r\n<h1>Certificate of Attendance</h1>\r\n<p class="blue">This certificate certifies that</p>\r\n<p class="highlight_name">{name}</p>\r\n<p class="blue">has attended</p>\r\n<p class="highlight">{event}</p>\r\n<p class="blue">on the</p>\r\n<p class="highlight">{date}</p>\r\n<p class="signature">Digitally signed by Innovative Informatics, Educator<br />Innovative Informatics</p>\r\n<div class="header-lt"><img src="../_images/_layout/site-logo.png" class="img_border"></div><div class="header-rt"><img src="../_uploads/images/air-appelation-2013.jpg" border="0" width="200"></div>\r\n</div>\r\n</body>', 1),
(2, 'General Certificate', '<style>\r\n.border { width: 100%; height: 100%; padding: 20px; text-align: center; border: 4px solid #666;\r\nbackground: linear-gradient(90deg, #CCC 10%, #FFF 90%) }\r\nh1 { color: #050D36; font-family: Baroque; font-size: 36pt; margin: 50px 0px 40px 0px; letter-spacing: 0.2pt; }\r\n.header-lt { display: block; width: 20%; text-align: left; float: left; margin-top: 20px; }\r\n.header-rt { display: block; width: 20%; text-align: right; float: right; margin-top: 20px; }\r\n.clear { clear: both; }\r\n.blue { color: #1CA1DA; font-style:italic; font-size: 16pt; margin: 30px 0px 10px 0px; }\r\n.highlight_name { color: #000; font-size: 32pt; margin: 0px; }\r\n.highlight { color: #000; font-size:16pt; margin: 10px 0px 30px 0px; }\r\n.signature { color: #000; font-size: 12pt; margin: 50px 0px 0px 0px; }\r\n.img_border { border: 2px solid #666; }\r\n</style>\r\n\r\n<body style="background: linear-gradient(90deg, #B8E3F5 20%, #1CA1DA 80%)">\r\n<div class="border">\r\n<div class="clear"></div>\r\n<h1>Certificate of Attendance</h1>\r\n<p class="blue">This certificate certifies that</p>\r\n<p class="highlight_name">{name}</p>\r\n<p class="blue">has attended</p>\r\n<p class="highlight">{event}</p>\r\n<p class="blue">on the</p>\r\n<p class="highlight">{date}</p>\r\n<p class="signature">Digitally signed by Innovative Informatics, Educator<br />Innovative Informatics</p>\r\n<div class="header-lt"><img src="../_images/_layout/site-logo.png" class="img_border"></div><div class="header-rt"></div>\r\n</div>\r\n</body>', 1),
(3, 'Demo Certificate', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `education_conf`
--

CREATE TABLE IF NOT EXISTS `education_conf` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `loc` varchar(300) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `attachment` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_conf`
--

INSERT INTO `education_conf` (`id`, `eid`, `loc`, `start`, `end`, `attachment`) VALUES
(2, 5, 'Illawarra Cancer Care Centre', '2019-07-16 09:00:00', '2019-07-12 16:00:00', ''),
(3, 8, 'Hawaii', '2019-08-01 09:25:00', '2019-08-01 15:40:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `education_ins`
--

CREATE TABLE IF NOT EXISTS `education_ins` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `pid` int(10) NOT NULL,
  `presenter` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_ins`
--

INSERT INTO `education_ins` (`id`, `eid`, `start`, `end`, `pid`, `presenter`) VALUES
(1, 4, '2019-07-15 13:30:00', '2019-07-12 14:00:00', 75, ''),
(2, 6, '2019-07-25 14:00:00', '2019-07-24 14:30:00', 75, ''),
(3, 7, '2019-07-31 13:00:00', '2019-07-31 14:00:00', 77, ''),
(4, 7, '2019-07-31 13:28:00', '2019-07-30 17:00:00', 76, ''),
(6, 9, '2019-08-29 04:14:00', '2019-08-31 10:26:00', 77, ''),
(7, 10, '2019-08-13 00:00:00', '2019-08-13 00:00:00', 75, ''),
(8, 11, '2019-08-13 13:59:00', '2019-08-13 10:23:00', 76, ''),
(9, 12, '2019-08-12 00:00:00', '2019-08-12 00:00:00', 75, ''),
(10, 7, '2020-05-12 09:30:00', '2020-05-12 10:30:00', 74, ''),
(11, 13, '2020-05-12 08:30:00', '2020-05-12 09:30:00', 74, ''),
(12, 7, '2020-05-12 00:00:00', '2020-05-12 00:00:00', 74, ''),
(13, 14, '2020-05-14 19:19:00', '2020-05-14 19:34:00', 74, '');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE IF NOT EXISTS `machines` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `manufacturer` varchar(200) NOT NULL,
  `serial_no` varchar(200) NOT NULL,
  `tid` int(3) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `name`, `manufacturer`, `serial_no`, `tid`, `active`) VALUES
(1, 'Gamma Knife', 'Gamma Knife', '', 42, 1),
(2, 'la1', 'asd', 'asd', 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine_qa_checklist`
--

CREATE TABLE IF NOT EXISTS `machine_qa_checklist` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `mid` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_qa_checklist`
--

INSERT INTO `machine_qa_checklist` (`id`, `name`, `mid`, `status`) VALUES
(1, 'Test QA List', 1, 1),
(2, 'asxd', 2, 0),
(3, 'asd', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `machine_qa_checklist_ext`
--

CREATE TABLE IF NOT EXISTS `machine_qa_checklist_ext` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_active` datetime NOT NULL,
  `date_retired` datetime NOT NULL,
  `version` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_qa_checklist_ext`
--

INSERT INTO `machine_qa_checklist_ext` (`id`, `cid`, `uid`, `date_created`, `date_active`, `date_retired`, `version`, `status`) VALUES
(1, 1, 1, '2019-01-28 20:29:54', '2019-01-28 20:30:09', '0000-00-00 00:00:00', 1, 1),
(2, 2, 75, '2019-08-15 12:41:55', '2019-08-15 12:42:41', '0000-00-00 00:00:00', 1, 1),
(3, 3, 75, '2019-08-15 12:43:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(4, 1, 1, '2020-05-12 11:29:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `machine_qa_checklist_q`
--

CREATE TABLE IF NOT EXISTS `machine_qa_checklist_q` (
  `id` int(11) NOT NULL,
  `ceid` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `type` varchar(6) NOT NULL,
  `range_lwr` varchar(10) NOT NULL,
  `range_upp` varchar(10) NOT NULL,
  `reqd` int(1) NOT NULL DEFAULT '1',
  `order` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_qa_checklist_q`
--

INSERT INTO `machine_qa_checklist_q` (`id`, `ceid`, `question`, `type`, `range_lwr`, `range_upp`, `reqd`, `order`) VALUES
(1, 1, 'Test', 'chkbox', '', '', 1, 1),
(2, 4, 'Test', 'chkbox', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine_qa_responses`
--

CREATE TABLE IF NOT EXISTS `machine_qa_responses` (
  `id` int(15) NOT NULL,
  `ceid` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `pass` int(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_qa_responses`
--

INSERT INTO `machine_qa_responses` (`id`, `ceid`, `uid`, `date`, `text`, `pass`) VALUES
(1, 1, 1, '2019-01-28 20:30:33', '', 100),
(2, 1, 75, '2019-07-04 10:54:30', '', 100),
(3, 1, 1, '2020-05-03 16:20:12', '<p>2020-05-03 16:20:12 sysadmin: \r\n	Test\r\n</p>', 100),
(4, 1, 1, '2020-05-03 16:22:44', '<p>2020-05-03 16:22:44 sysadmin: \r\n	test\r\n</p>', 100),
(5, 1, 1, '2020-05-03 16:34:04', '<p>2020-05-03 16:34:04 sysadmin: \r\n	test\r\n</p>', 100),
(6, 1, 1, '2020-05-03 16:35:03', '<p>2020-05-03 16:35:03 sysadmin: \r\n	test\r\n</p>', 100),
(7, 1, 1, '2020-05-03 17:19:57', '<p>2020-05-03 17:19:57 sysadmin: \r\n	Test\r\n</p>', 100),
(8, 1, 1, '2020-05-03 17:24:24', '<p>2020-05-03 17:24:24 sysadmin: \r\n	Test\r\n</p>', 100),
(9, 1, 1, '2020-05-03 17:25:02', '<p>2020-05-03 17:25:02 sysadmin: \r\n	Test\r\n</p>', 100),
(10, 1, 1, '2020-05-03 17:25:43', '<p>2020-05-03 17:25:43 sysadmin: \r\n	test\r\n</p>', 100),
(11, 1, 1, '2020-05-03 17:27:01', '<p>2020-05-03 17:27:01 sysadmin: \r\n	test\r\n</p>', 100),
(12, 1, 1, '2020-05-03 17:27:39', '<p>2020-05-03 17:27:39 sysadmin: \r\n	test\r\n</p>', 100),
(13, 1, 1, '2020-05-03 17:34:18', '<p>2020-05-03 17:34:18 sysadmin: \r\n	test\r\n</p>', 100),
(14, 1, 1, '2020-05-03 17:35:33', '<p>2020-05-03 17:35:33 sysadmin: \r\n	Test\r\n</p>', 100);

-- --------------------------------------------------------

--
-- Table structure for table `machine_qa_responses_ext`
--

CREATE TABLE IF NOT EXISTS `machine_qa_responses_ext` (
  `id` int(15) NOT NULL,
  `gid` int(15) NOT NULL,
  `cqid` int(15) NOT NULL,
  `response` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_qa_responses_ext`
--

INSERT INTO `machine_qa_responses_ext` (`id`, `gid`, `cqid`, `response`) VALUES
(1, 1, 1, '1'),
(2, 2, 1, '1'),
(3, 3, 1, '1'),
(4, 4, 1, '1'),
(5, 5, 1, '1'),
(6, 6, 1, '1'),
(7, 7, 1, '1'),
(8, 8, 1, '1'),
(9, 9, 1, '1'),
(10, 10, 1, '1'),
(11, 11, 1, '1'),
(12, 12, 1, '1'),
(13, 13, 1, '1'),
(14, 14, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `mail_queue`
--

CREATE TABLE IF NOT EXISTS `mail_queue` (
  `id` int(11) NOT NULL,
  `to` varchar(300) NOT NULL,
  `from` varchar(300) NOT NULL,
  `from_name` varchar(300) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `body` text NOT NULL,
  `mail_date` date NOT NULL,
  `authcode` varchar(50) NOT NULL,
  `ack` int(1) NOT NULL,
  `del` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_queue`
--

INSERT INTO `mail_queue` (`id`, `to`, `from`, `from_name`, `subject`, `body`, `mail_date`, `authcode`, `ack`, `del`) VALUES
(3, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Test QA Checklist', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">11-05-2020 07:13:44 Test QA Checklist</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Section 1:</strong> No response recorded</p><p><strong>Test question 1:</strong> Test</p><p><strong>Free text response:</strong> Test</p><p><strong>Type:</strong> 3</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=119&o=rapidlook&v=32">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-11', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(4, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">15-05-2020 12:17:50 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> today</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=122&o=rapidlook&v=33">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-15', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(5, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">15-05-2020 12:23:02 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> Test</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=122&o=rapidlook&v=34">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-15', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(6, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">16-05-2020 08:01:07 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> No response recorded</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=&o=rapidlook&v=35">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-16', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(7, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">16-05-2020 08:09:12 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> test</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=122&o=rapidlook&v=36">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-16', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(8, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Test QA Checklist', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">18-05-2020 11:09:23 Test QA Checklist</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Section 1:</strong> No response recorded</p><p><strong>Test question 1:</strong> Test</p><p><strong>Free text response:</strong> Test</p><p><strong>Type:</strong> 3</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=119&o=rapidlook&v=60">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-18', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(9, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Test QA Checklist', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">28-05-2020 08:22:09 Test QA Checklist</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Section 1:</strong> No response recorded</p><p><strong>Test question 1:</strong> Test</p><p><strong>Free text response:</strong> Test</p><p><strong>Type:</strong> 3</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=119&o=rapidlook&v=4">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-28', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(10, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">28-05-2020 11:05:55 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> Test Test</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=122&o=rapidlook&v=0">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-28', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(11, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">28-05-2020 11:06:46 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> Test</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=122&o=rapidlook&v=0">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-28', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(12, '', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'Machine Faults', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">28-05-2020 11:08:01 Machine Faults</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><p><strong>Submitted on:</strong> test a</p><p><strong>Fault status:</strong> Major</p></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;"><a href="http://localhost/topaz-build-1.8/?p=checklist-manager&t=122&o=rapidlook&v=5">Click here</a></p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-05-28', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1);
INSERT INTO `mail_queue` (`id`, `to`, `from`, `from_name`, `subject`, `body`, `mail_date`, `authcode`, `ack`, `del`) VALUES
(13, 'adam@imtservices.com.au', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'AS4187 Audit', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">2020-06-14 15:48:54 AS4187 Audit</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">Staff Competency: <span style="color:#CC0000;">sec</span><br />The person responsible for CSD has specific instrument reprocessing qualifications or experience: <span style="color:#66CC00;">Yes</span><br />There a copy of the current edition of AS/NZS 4187 available in CSD: <span style="color:#CC0000;">No response recorded</span><br />Collection and Cleaning: <span style="color:#CC0000;">sec</span><br />Reusable items are collected in leak proof, puncture resistant containers: <span style="color:#CC0000;">No response recorded</span><br />In the clean up area staff wear: <span style="color:#CC0000;">sec</span><br />Impervious apron or gown: <span style="color:#CC0000;">No response recorded</span><br />Eye protection: <span style="color:#CC0000;">No response recorded</span><br />Gloves: <span style="color:#CC0000;">No response recorded</span><br />All single use items are discarded: <span style="color:#CC0000;">No response recorded</span><br />The cleaning area has : <span style="color:#CC0000;">sec</span><br />Separate handwashing facilities: <span style="color:#CC0000;">No response recorded</span><br />Adequate bench space: <span style="color:#CC0000;">No response recorded</span><br />Non-porous work surfaces: <span style="color:#CC0000;">No response recorded</span><br />Smooth surfaces without cracks and/or crevices: <span style="color:#CC0000;">No response recorded</span><br />Good lighting: <span style="color:#CC0000;">No response recorded</span><br />Efficient ventilation in sterilizing area (minimum 10 air changes/hr): <span style="color:#CC0000;">No response recorded</span><br />Room temperature maintained between 18-22oC at all times: <span style="color:#CC0000;">No response recorded</span><br />Adequate storage space: <span style="color:#CC0000;">No response recorded</span><br />Non-slip floors: <span style="color:#CC0000;">No response recorded</span><br />Cleaning sink: <span style="color:#CC0000;">No response recorded</span><br />Range of non-abrasive brushes and pads: <span style="color:#CC0000;">No response recorded</span><br />Drying equipment or lint free towels for manual drying: <span style="color:#CC0000;">No response recorded</span><br />One way work flow from dirty to clean, with no cross over: <span style="color:#CC0000;">No response recorded</span><br />Manufacturerâ€™s manuals available for all equipment: <span style="color:#CC0000;">No response recorded</span><br />A documented cleaning schedule: <span style="color:#CC0000;">No response recorded</span><br />On receipt all items are checked for completeness & defects, insulated items, such as diathermy tips and leads, are checked to ensure that there is no short circuit: <span style="color:#CC0000;">No response recorded</span><br />Labels of manual and mechanical cleaning agents include : <span style="color:#CC0000;">sec</span><br />name of product: <span style="color:#CC0000;">No response recorded</span><br />name of manufacturer: <span style="color:#CC0000;">No response recorded</span><br />address of manufacturer: <span style="color:#CC0000;">No response recorded</span><br />description of product: <span style="color:#CC0000;">No response recorded</span><br />purpose of product: <span style="color:#CC0000;">No response recorded</span><br />directions for usage: <span style="color:#CC0000;">No response recorded</span><br />directions for dilution: <span style="color:#CC0000;">No response recorded</span><br />batch number: <span style="color:#CC0000;">No response recorded</span><br />expiry date: <span style="color:#CC0000;">No response recorded</span><br />first aid instructions: <span style="color:#CC0000;">No response recorded</span><br />safety instructions: <span style="color:#CC0000;">No response recorded</span><br />storage instructions: <span style="color:#CC0000;">No response recorded</span><br />Ultrasonic cleaning : <span style="color:#CC0000;">sec</span><br />manufacturer approved detergent used: <span style="color:#CC0000;">No response recorded</span><br />detergent added after tank is filled: <span style="color:#CC0000;">No response recorded</span><br />unit is degassed after tank is filled before processing instruments: <span style="color:#CC0000;">No response recorded</span><br />transducers are tested daily: <span style="color:#CC0000;">No response recorded</span><br />instruments are rinsed before immersion: <span style="color:#CC0000;">No response recorded</span><br />unit is cleaned and solution replaced at least daily when in use: <span style="color:#CC0000;">No response recorded</span><br />unit is fitted with a lid: <span style="color:#CC0000;">No response recorded</span><br />unit is always operated with lid closed: <span style="color:#CC0000;">No response recorded</span><br />Manual cleaning : <span style="color:#CC0000;">sec</span><br />cleaning equipment is non-abrasive: <span style="color:#CC0000;">No response recorded</span><br />cleaning equipment is in good condition: <span style="color:#CC0000;">No response recorded</span><br />cleaning equipment is disinfected/sterilized at end of each session: <span style="color:#CC0000;">No response recorded</span><br />cleaning equipment is stored clean & dry: <span style="color:#CC0000;">No response recorded</span><br />items are flushed with water 15-30oC to remove visible soiling: <span style="color:#CC0000;">No response recorded</span><br />items dismantled/opened prior to cleaning: <span style="color:#CC0000;">No response recorded</span><br />items submerged and cleaned in warm water with detergent : <span style="color:#CC0000;">No response recorded</span><br />Instrument Rinsing and Drying: <span style="color:#CC0000;">sec</span><br />items rinsed it warm/hot running water or in the automated instrument rinse machine: <span style="color:#CC0000;">No response recorded</span><br />items dried in drying cabinet or with lint free cloth: <span style="color:#CC0000;">No response recorded</span><br />Packaging and Wrapping : <span style="color:#CC0000;">sec</span><br />single use disposable wraps used â€“ checked for defects before use: <span style="color:#CC0000;">No response recorded</span><br />prepared labels or non-toxic felt pens are used to label packs: <span style="color:#CC0000;">No response recorded</span><br />multiple part instruments are packed in loosened or opened position: <span style="color:#CC0000;">No response recorded</span><br />trays for packaging are perforated: <span style="color:#CC0000;">No response recorded</span><br />indicator tape has manufacturer name, batch no & date on core: <span style="color:#CC0000;">No response recorded</span><br />indicator tape adheres well to all wraps used: <span style="color:#CC0000;">No response recorded</span><br />colour change of indicator tape after sterilizing is clear and distinct: <span style="color:#CC0000;">No response recorded</span><br />Sterilizing: <span style="color:#CC0000;">sec</span><br />Operating manuals are stored near both sterilizers at all times: <span style="color:#CC0000;">No response recorded</span><br />Steam sterilizers (benchtop) : <span style="color:#CC0000;">sec</span><br />Items are loaded within boundaries of loading trays (i.e. no overhang): <span style="color:#CC0000;">No response recorded</span><br />Trays are loaded with single layers of packs only: <span style="color:#CC0000;">No response recorded</span><br /></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">Comments</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">\r\n	Test\r\n</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				</td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-06-14', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1),
(14, 'adam@imtservices.com.au', 'no-reply@innovativeinformatics.com.au', 'Innovative Informatics Pty. Ltd.', 'AS4187 Audit', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">2020-06-14 15:49:04 AS4187 Audit</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">Staff Competency: <span style="color:#CC0000;">sec</span><br />The person responsible for CSD has specific instrument reprocessing qualifications or experience: <span style="color:#66CC00;">Yes</span><br />There a copy of the current edition of AS/NZS 4187 available in CSD: <span style="color:#CC0000;">No response recorded</span><br />Collection and Cleaning: <span style="color:#CC0000;">sec</span><br />Reusable items are collected in leak proof, puncture resistant containers: <span style="color:#CC0000;">No response recorded</span><br />In the clean up area staff wear: <span style="color:#CC0000;">sec</span><br />Impervious apron or gown: <span style="color:#CC0000;">No response recorded</span><br />Eye protection: <span style="color:#CC0000;">No response recorded</span><br />Gloves: <span style="color:#CC0000;">No response recorded</span><br />All single use items are discarded: <span style="color:#CC0000;">No response recorded</span><br />The cleaning area has : <span style="color:#CC0000;">sec</span><br />Separate handwashing facilities: <span style="color:#CC0000;">No response recorded</span><br />Adequate bench space: <span style="color:#CC0000;">No response recorded</span><br />Non-porous work surfaces: <span style="color:#CC0000;">No response recorded</span><br />Smooth surfaces without cracks and/or crevices: <span style="color:#CC0000;">No response recorded</span><br />Good lighting: <span style="color:#CC0000;">No response recorded</span><br />Efficient ventilation in sterilizing area (minimum 10 air changes/hr): <span style="color:#CC0000;">No response recorded</span><br />Room temperature maintained between 18-22oC at all times: <span style="color:#CC0000;">No response recorded</span><br />Adequate storage space: <span style="color:#CC0000;">No response recorded</span><br />Non-slip floors: <span style="color:#CC0000;">No response recorded</span><br />Cleaning sink: <span style="color:#CC0000;">No response recorded</span><br />Range of non-abrasive brushes and pads: <span style="color:#CC0000;">No response recorded</span><br />Drying equipment or lint free towels for manual drying: <span style="color:#CC0000;">No response recorded</span><br />One way work flow from dirty to clean, with no cross over: <span style="color:#CC0000;">No response recorded</span><br />Manufacturerâ€™s manuals available for all equipment: <span style="color:#CC0000;">No response recorded</span><br />A documented cleaning schedule: <span style="color:#CC0000;">No response recorded</span><br />On receipt all items are checked for completeness & defects, insulated items, such as diathermy tips and leads, are checked to ensure that there is no short circuit: <span style="color:#CC0000;">No response recorded</span><br />Labels of manual and mechanical cleaning agents include : <span style="color:#CC0000;">sec</span><br />name of product: <span style="color:#CC0000;">No response recorded</span><br />name of manufacturer: <span style="color:#CC0000;">No response recorded</span><br />address of manufacturer: <span style="color:#CC0000;">No response recorded</span><br />description of product: <span style="color:#CC0000;">No response recorded</span><br />purpose of product: <span style="color:#CC0000;">No response recorded</span><br />directions for usage: <span style="color:#CC0000;">No response recorded</span><br />directions for dilution: <span style="color:#CC0000;">No response recorded</span><br />batch number: <span style="color:#CC0000;">No response recorded</span><br />expiry date: <span style="color:#CC0000;">No response recorded</span><br />first aid instructions: <span style="color:#CC0000;">No response recorded</span><br />safety instructions: <span style="color:#CC0000;">No response recorded</span><br />storage instructions: <span style="color:#CC0000;">No response recorded</span><br />Ultrasonic cleaning : <span style="color:#CC0000;">sec</span><br />manufacturer approved detergent used: <span style="color:#CC0000;">No response recorded</span><br />detergent added after tank is filled: <span style="color:#CC0000;">No response recorded</span><br />unit is degassed after tank is filled before processing instruments: <span style="color:#CC0000;">No response recorded</span><br />transducers are tested daily: <span style="color:#CC0000;">No response recorded</span><br />instruments are rinsed before immersion: <span style="color:#CC0000;">No response recorded</span><br />unit is cleaned and solution replaced at least daily when in use: <span style="color:#CC0000;">No response recorded</span><br />unit is fitted with a lid: <span style="color:#CC0000;">No response recorded</span><br />unit is always operated with lid closed: <span style="color:#CC0000;">No response recorded</span><br />Manual cleaning : <span style="color:#CC0000;">sec</span><br />cleaning equipment is non-abrasive: <span style="color:#CC0000;">No response recorded</span><br />cleaning equipment is in good condition: <span style="color:#CC0000;">No response recorded</span><br />cleaning equipment is disinfected/sterilized at end of each session: <span style="color:#CC0000;">No response recorded</span><br />cleaning equipment is stored clean & dry: <span style="color:#CC0000;">No response recorded</span><br />items are flushed with water 15-30oC to remove visible soiling: <span style="color:#CC0000;">No response recorded</span><br />items dismantled/opened prior to cleaning: <span style="color:#CC0000;">No response recorded</span><br />items submerged and cleaned in warm water with detergent : <span style="color:#CC0000;">No response recorded</span><br />Instrument Rinsing and Drying: <span style="color:#CC0000;">sec</span><br />items rinsed it warm/hot running water or in the automated instrument rinse machine: <span style="color:#CC0000;">No response recorded</span><br />items dried in drying cabinet or with lint free cloth: <span style="color:#CC0000;">No response recorded</span><br />Packaging and Wrapping : <span style="color:#CC0000;">sec</span><br />single use disposable wraps used â€“ checked for defects before use: <span style="color:#CC0000;">No response recorded</span><br />prepared labels or non-toxic felt pens are used to label packs: <span style="color:#CC0000;">No response recorded</span><br />multiple part instruments are packed in loosened or opened position: <span style="color:#CC0000;">No response recorded</span><br />trays for packaging are perforated: <span style="color:#CC0000;">No response recorded</span><br />indicator tape has manufacturer name, batch no & date on core: <span style="color:#CC0000;">No response recorded</span><br />indicator tape adheres well to all wraps used: <span style="color:#CC0000;">No response recorded</span><br />colour change of indicator tape after sterilizing is clear and distinct: <span style="color:#CC0000;">No response recorded</span><br />Sterilizing: <span style="color:#CC0000;">sec</span><br />Operating manuals are stored near both sterilizers at all times: <span style="color:#CC0000;">No response recorded</span><br />Steam sterilizers (benchtop) : <span style="color:#CC0000;">sec</span><br />Items are loaded within boundaries of loading trays (i.e. no overhang): <span style="color:#CC0000;">No response recorded</span><br />Trays are loaded with single layers of packs only: <span style="color:#CC0000;">No response recorded</span><br /></p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">Comments</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">\r\n	Test\r\n</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				</td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the Innovative Informatics Pty. Ltd..<br />\r\n                          <br />\r\n                          Copyright &copy; 2020 Innovative Informatics Pty. Ltd..</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '2020-06-14', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qa_checklist`
--

CREATE TABLE IF NOT EXISTS `qa_checklist` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `locations` varchar(300) NOT NULL,
  `type_id` int(3) NOT NULL,
  `unit` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qa_checklist`
--

INSERT INTO `qa_checklist` (`id`, `name`, `locations`, `type_id`, `unit`, `status`) VALUES
(23, 'HS Inspection Checklist', '', 117, 0, 1),
(22, 'Medical Record Documentation Audit', '', 117, 0, 1),
(24, 'Administration and Management of Medication Audit', '', 118, 114, 1),
(25, 'Day Surgery Staff Shoe Suitability Audit', '', 117, 0, 1),
(26, 'Cleaners Schedule Audit', '', 117, 0, 1),
(27, 'Clinical Handover Audit', '', 117, 0, 1),
(28, 'National Inpatient medication Chart Audit', '', 117, 0, 0),
(29, 'Hand Hygiene 5 moments Observation Audit', '', 117, 0, 1),
(30, 'Infectional Control Compliance Audit: Clinical', '', 117, 0, 1),
(31, 'Patient falls audit', '', 117, 0, 1),
(32, 'Patient procedure and ID matching audit', '', 117, 0, 1),
(33, 'Staff Compentency Audit', '', 117, 0, 1),
(34, 'Fridge Checklist Audit', '', 117, 0, 1),
(35, 'Discharge Summary Audit', '', 117, 0, 1),
(36, 'Hand Hygiene Compliance audit', '', 117, 0, 1),
(37, 'Patient idetification wristband audit', '', 117, 0, 1),
(38, 'Patient transfer form audit', '', 117, 0, 1),
(39, 'Drug register audit', '', 117, 0, 1),
(40, 'Emergency and Nurse Call Button audit', '', 117, 0, 1),
(41, 'Emergency Trolley Audit', '', 117, 0, 1),
(42, 'Hazardous Chemical Audit', '', 117, 0, 1),
(43, 'Staff orientation audit', '', 118, 0, 1),
(44, 'Preventing and managing pressure injuries audit', '', 117, 0, 1),
(45, 'Observation, Monitoring and Escalation of care audit', '', 117, 0, 1),
(47, 'Workstation Ergonomic Assessment', '', 117, 0, 1),
(48, 'Schedule 8 Register Audit', '', 117, 0, 1),
(49, 'Medical Record Audit', '', 117, 0, 1),
(50, 'Medication Management Audit', '', 117, 0, 1),
(51, 'Clinical Care Audit', '', 117, 0, 1),
(52, 'Personal File Audit', '', 117, 0, 1),
(53, 'Document and Record Control', '', 117, 0, 1),
(54, 'Equipment Maintenance and Purchasing', '', 117, 0, 1),
(55, 'Human Resource Management', '', 117, 0, 1),
(56, 'Aseptic Non Touch Technique ', '', 117, 0, 1),
(57, 'AS4187 Audit', '', 117, 113, 1),
(61, 'Test', '', 117, 0, 0),
(62, 'Test', '', 118, 0, 0),
(63, 'test', '', 117, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_checklist_ext`
--

CREATE TABLE IF NOT EXISTS `qa_checklist_ext` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_active` datetime NOT NULL,
  `date_retired` datetime NOT NULL,
  `version` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `report_setting` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qa_checklist_ext`
--

INSERT INTO `qa_checklist_ext` (`id`, `cid`, `uid`, `date_created`, `date_active`, `date_retired`, `version`, `status`, `report_setting`) VALUES
(50, 24, 48, '2016-04-29 11:12:42', '2016-04-29 11:18:51', '2016-05-19 09:42:48', 1, 2, ''),
(49, 23, 48, '2016-04-29 11:03:17', '2016-04-29 11:10:26', '0000-00-00 00:00:00', 2, 1, ''),
(48, 23, 48, '2016-04-26 15:09:32', '2016-04-26 15:28:17', '2016-04-29 11:10:26', 1, 2, ''),
(45, 22, 48, '2016-04-22 10:04:40', '2016-04-22 10:51:14', '2016-04-22 11:16:02', 1, 2, ''),
(46, 22, 48, '2016-04-22 11:15:52', '2016-04-22 11:16:02', '2016-04-26 14:35:05', 2, 2, ''),
(47, 22, 1, '2016-04-22 20:44:14', '2016-04-26 14:35:05', '2016-05-03 14:20:36', 3, 2, ''),
(51, 25, 48, '2016-04-29 11:20:06', '2016-04-29 11:42:56', '0000-00-00 00:00:00', 1, 1, ''),
(52, 26, 48, '2016-04-29 11:43:21', '2016-04-29 11:48:04', '2016-08-01 15:27:39', 1, 2, ''),
(53, 27, 48, '2016-04-29 11:49:40', '2016-04-29 12:05:15', '2016-08-01 15:29:40', 1, 2, ''),
(54, 28, 48, '2016-04-29 12:06:16', '2016-04-29 12:11:13', '0000-00-00 00:00:00', 1, 1, ''),
(55, 29, 48, '2016-05-02 11:28:37', '2016-05-02 11:36:30', '2016-05-04 12:18:57', 1, 2, ''),
(56, 30, 48, '2016-05-03 08:05:20', '2016-05-03 08:48:48', '2016-05-03 08:53:39', 1, 2, ''),
(57, 30, 48, '2016-05-03 08:53:06', '2016-05-03 08:53:39', '2016-08-01 10:58:31', 2, 2, ''),
(58, 31, 48, '2016-05-03 08:58:46', '2016-05-03 09:05:46', '0000-00-00 00:00:00', 1, 1, ''),
(59, 32, 48, '2016-05-03 09:06:56', '2016-05-03 09:15:26', '0000-00-00 00:00:00', 1, 1, ''),
(60, 33, 48, '2016-05-03 09:18:43', '2016-05-03 09:21:52', '2016-08-01 15:48:30', 1, 2, ''),
(61, 34, 48, '2016-05-03 09:22:25', '2016-05-03 09:30:38', '2016-06-27 12:16:53', 1, 2, ''),
(62, 35, 48, '2016-05-03 09:31:09', '2016-05-03 09:35:40', '2016-08-01 15:31:15', 1, 2, ''),
(63, 36, 48, '2016-05-03 09:37:25', '2016-05-03 09:50:44', '2016-08-01 15:42:46', 1, 2, ''),
(64, 37, 48, '2016-05-03 09:51:37', '2016-05-03 09:57:36', '0000-00-00 00:00:00', 1, 1, ''),
(65, 38, 48, '2016-05-03 09:59:23', '2016-05-03 10:04:33', '0000-00-00 00:00:00', 1, 1, ''),
(66, 39, 48, '2016-05-03 12:54:55', '2016-05-03 13:01:47', '2016-08-01 15:33:09', 1, 2, ''),
(67, 40, 48, '2016-05-03 13:02:23', '2016-05-03 13:08:27', '2016-08-01 15:35:29', 1, 2, ''),
(68, 41, 48, '2016-05-03 13:42:35', '2016-05-03 13:49:33', '2016-08-01 15:37:31', 1, 2, ''),
(69, 42, 48, '2016-05-03 13:49:50', '2016-05-03 13:55:59', '0000-00-00 00:00:00', 1, 1, ''),
(70, 43, 48, '2016-05-03 13:56:54', '2016-05-03 14:01:54', '0000-00-00 00:00:00', 1, 1, ''),
(71, 44, 48, '2016-05-03 14:03:01', '2016-05-03 14:09:03', '0000-00-00 00:00:00', 1, 1, ''),
(72, 45, 48, '2016-05-03 14:10:05', '2016-05-03 14:14:39', '0000-00-00 00:00:00', 1, 1, ''),
(73, 22, 48, '2016-05-03 14:16:37', '2016-05-03 14:20:36', '2016-05-03 14:25:49', 4, 2, ''),
(74, 22, 48, '2016-05-03 14:20:54', '2016-05-03 14:25:49', '2016-08-01 15:46:08', 5, 2, ''),
(75, 29, 48, '2016-05-04 12:18:03', '2016-05-04 12:18:57', '2016-05-04 12:21:00', 2, 2, ''),
(76, 29, 48, '2016-05-04 12:19:25', '2016-05-04 12:21:00', '2016-08-01 15:39:12', 3, 2, ''),
(78, 24, 49, '2016-05-19 09:42:03', '2016-05-19 09:42:48', '2016-08-01 15:23:12', 2, 2, ''),
(80, 47, 51, '2016-06-27 11:41:47', '2016-06-27 12:12:20', '0000-00-00 00:00:00', 1, 1, ''),
(81, 34, 51, '2016-06-27 12:15:51', '2016-06-27 12:16:53', '2016-06-28 14:14:43', 2, 2, ''),
(82, 48, 51, '2016-06-27 15:42:31', '2016-06-27 15:53:48', '2016-06-27 16:01:47', 1, 2, ''),
(83, 48, 51, '2016-06-27 15:55:57', '2016-06-27 16:01:47', '0000-00-00 00:00:00', 2, 1, ''),
(84, 49, 51, '2016-06-27 16:04:08', '2016-06-27 16:18:15', '0000-00-00 00:00:00', 1, 1, ''),
(85, 50, 51, '2016-06-27 16:19:47', '2016-06-27 16:34:34', '0000-00-00 00:00:00', 1, 1, ''),
(86, 51, 51, '2016-06-27 16:36:43', '2016-06-27 16:49:00', '0000-00-00 00:00:00', 1, 1, ''),
(87, 34, 49, '2016-06-28 14:12:59', '2016-06-28 14:14:43', '0000-00-00 00:00:00', 3, 1, ''),
(88, 30, 51, '2016-08-01 10:34:06', '2016-08-01 10:58:31', '2016-08-01 11:10:19', 3, 2, ''),
(89, 30, 51, '2016-08-01 11:05:34', '2016-08-01 11:10:19', '2016-08-01 11:30:31', 4, 2, ''),
(90, 30, 51, '2016-08-01 11:17:50', '2016-08-01 11:30:31', '0000-00-00 00:00:00', 5, 1, ''),
(91, 52, 51, '2016-08-01 11:36:24', '2016-08-01 11:42:19', '0000-00-00 00:00:00', 1, 1, ''),
(92, 24, 51, '2016-08-01 15:22:40', '2016-08-01 15:23:12', '2018-05-22 17:13:15', 3, 2, ''),
(93, 26, 51, '2016-08-01 15:26:36', '2016-08-01 15:27:39', '0000-00-00 00:00:00', 2, 1, ''),
(94, 27, 51, '2016-08-01 15:28:03', '2016-08-01 15:29:40', '0000-00-00 00:00:00', 2, 1, ''),
(95, 35, 51, '2016-08-01 15:30:37', '2016-08-01 15:31:15', '0000-00-00 00:00:00', 2, 1, ''),
(96, 39, 51, '2016-08-01 15:32:07', '2016-08-01 15:33:09', '0000-00-00 00:00:00', 2, 1, ''),
(97, 40, 51, '2016-08-01 15:34:23', '2016-08-01 15:35:29', '0000-00-00 00:00:00', 2, 1, ''),
(98, 41, 51, '2016-08-01 15:35:49', '2016-08-01 15:37:31', '0000-00-00 00:00:00', 2, 1, ''),
(99, 29, 51, '2016-08-01 15:38:11', '2016-08-01 15:39:12', '0000-00-00 00:00:00', 4, 1, '1624;1625;1626;1627;1628;1629;1630'),
(100, 36, 51, '2016-08-01 15:39:39', '2016-08-01 15:42:46', '0000-00-00 00:00:00', 2, 1, ''),
(101, 22, 51, '2016-08-01 15:43:59', '2016-08-01 15:46:08', '0000-00-00 00:00:00', 6, 1, ''),
(102, 33, 51, '2016-08-01 15:48:05', '2016-08-01 15:48:30', '0000-00-00 00:00:00', 2, 1, ''),
(103, 53, 51, '2016-08-01 15:52:57', '2016-08-01 16:06:10', '0000-00-00 00:00:00', 1, 1, ''),
(104, 54, 51, '2016-08-01 16:08:30', '2016-08-01 16:14:12', '0000-00-00 00:00:00', 1, 1, ''),
(105, 55, 51, '2016-08-01 16:15:10', '2016-08-01 16:19:11', '0000-00-00 00:00:00', 1, 1, ''),
(106, 56, 51, '2016-08-01 16:20:46', '2016-08-01 16:22:27', '0000-00-00 00:00:00', 1, 1, ''),
(107, 57, 51, '2016-08-01 16:26:29', '2016-08-01 16:43:26', '0000-00-00 00:00:00', 1, 1, ''),
(108, 24, 1, '2018-05-22 17:12:44', '2018-05-22 17:13:15', '0000-00-00 00:00:00', 4, 1, ''),
(112, 61, 1, '2019-02-01 18:25:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(113, 62, 75, '2019-07-30 14:12:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(114, 63, 75, '2019-07-31 12:27:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `qa_checklist_q`
--

CREATE TABLE IF NOT EXISTS `qa_checklist_q` (
  `id` int(11) NOT NULL,
  `ceid` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `type` varchar(6) NOT NULL,
  `reqd` int(1) NOT NULL DEFAULT '1',
  `order` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1886 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qa_checklist_q`
--

INSERT INTO `qa_checklist_q` (`id`, `ceid`, `question`, `type`, `reqd`, `order`) VALUES
(451, 48, 'Fire instructions displayed and adequate directions given', 'yna', 1, 7),
(450, 48, 'Exit clear of obstructions', 'yna', 1, 6),
(449, 48, 'Exit doors clearly marked and easily opened from inside', 'yna', 1, 5),
(448, 48, 'Extinguisher recently serviced', 'yna', 1, 4),
(447, 48, 'Extinguishers in place clearly marked for type of fire', 'yna', 1, 3),
(446, 48, 'Extinguishers in place and easily accesable', 'yna', 1, 2),
(445, 48, 'Inspection Area', 'txt', 1, 1),
(283, 45, 'Patient Name', 'yna', 1, 1),
(284, 45, 'Date of Birth', 'yna', 1, 2),
(285, 45, 'Gender', 'yna', 1, 3),
(286, 45, 'Address', 'yna', 1, 4),
(287, 45, 'Contact Phone Number', 'yna', 1, 5),
(288, 45, 'Marital status', 'yna', 1, 6),
(289, 45, 'Medicare number', 'yna', 1, 7),
(290, 45, 'Details of main contact person', 'yna', 1, 8),
(291, 45, 'Next of kin', 'yna', 1, 9),
(292, 45, 'Cultural requirements', 'yna', 1, 10),
(293, 45, 'Indigenous status', 'yna', 1, 11),
(294, 45, 'Signed consent to treatment', 'yna', 1, 12),
(295, 45, 'Signed financial consent', 'yna', 1, 13),
(296, 45, 'Advanced care directive', 'yna', 1, 14),
(297, 45, 'Each page has patient identification label', 'yna', 1, 15),
(298, 45, 'Does the label have 3 patient identifiers', 'yna', 1, 16),
(299, 45, 'Does any time entry use the 24hour clock', 'yn', 1, 17),
(300, 45, 'Entries in black pen only', 'yn', 1, 18),
(301, 45, 'Any errors crossed out and initialled', 'yn', 1, 19),
(302, 45, 'Whiteout used', 'yn', 1, 20),
(303, 45, 'Is there evience of discharge information eg contact person for pickup', 'yn', 1, 21),
(304, 45, 'Documented pressure injury/fall risk assessment', 'yna', 1, 22),
(305, 45, 'Documented observation eg: BP, pulse, oxygen saturations', 'yn', 1, 23),
(306, 45, 'Documented mobility assessment', 'yna', 1, 24),
(307, 45, 'Alert status documented eg: Diabetic, allergy', 'yna', 1, 25),
(308, 45, 'Documented use of interpreter', 'yna', 1, 26),
(309, 45, 'Dietary needs documented', 'yna', 1, 27),
(310, 45, 'Fasting and dressing instructions documented', 'yna', 1, 28),
(311, 45, 'Rights and responsibilities explained', 'yna', 1, 29),
(312, 45, 'Transport and responsibility person addressed', 'yna', 1, 30),
(313, 45, 'Medication history documented', 'yna', 1, 31),
(314, 45, 'Medication, allergy, alert status documented', 'yna', 1, 32),
(315, 45, 'Medication error documented and signed by clinical staff', 'yna', 1, 33),
(316, 45, 'Does it include route, dose and frequency', 'yn', 1, 34),
(317, 45, 'Do we allow nurse initiated medications', 'yna', 1, 35),
(318, 45, 'Do we allow telephone medication orders', 'yn', 1, 36),
(319, 45, 'medication order counteredsigned by the prescriber within 24 hours', 'yn', 1, 37),
(320, 45, 'Is there a surgical safety checklist', 'yn', 1, 38),
(321, 45, 'Has it been complited and signed at every patient episode', 'yn', 1, 39),
(322, 45, 'Is there documentred evidence of the surgeon, anaesthetist and registered nurse signatures', 'yna', 1, 40),
(323, 45, 'Documented evidence of the operation performed', 'yn', 1, 41),
(324, 45, 'Date and signed by surgeon', 'yn', 1, 42),
(325, 45, 'Time out attended', 'yn', 1, 43),
(326, 45, 'Instrument count or no count recorded', 'yn', 1, 44),
(327, 45, 'Sterile tracking system included', '0', 1, 45),
(328, 45, 'ASA completed and documented', 'yn', 1, 46),
(329, 45, 'Date and signed by anaesthetist', 'yn', 1, 47),
(330, 45, 'Evidence of a pre-operative anaesthetic consultation', 'yna', 1, 48),
(331, 45, 'Anaesthetic type given eg sedation/general/local', 'yn', 1, 49),
(332, 45, 'Post-operative instructions given documented', 'yna', 1, 50),
(333, 45, 'Any post-operative medication given documented on post-operative instruction', 'yna', 1, 51),
(334, 45, 'Carer signature', 'yna', 1, 52),
(335, 45, 'Patient MRN', 'txt', 1, 53),
(336, 45, 'Comments', 'txt', 0, 54),
(337, 46, 'Patient Name', 'yna', 1, 1),
(338, 46, 'Date of Birth', 'yna', 1, 2),
(339, 46, 'Gender', 'yna', 1, 3),
(340, 46, 'Address', 'yna', 1, 4),
(341, 46, 'Contact Phone Number', 'yna', 1, 5),
(342, 46, 'Marital status', 'yna', 1, 6),
(343, 46, 'Medicare number', 'yna', 1, 7),
(344, 46, 'Details of main contact person', 'yna', 1, 8),
(345, 46, 'Next of kin', 'yna', 1, 9),
(346, 46, 'Cultural requirements', 'yna', 1, 10),
(347, 46, 'Indigenous status', 'yna', 1, 11),
(348, 46, 'Signed consent to treatment', 'yna', 1, 12),
(349, 46, 'Signed financial consent', 'yna', 1, 13),
(350, 46, 'Advanced care directive', 'yna', 1, 14),
(351, 46, 'Each page has patient identification label', 'yna', 1, 15),
(352, 46, 'Does the label have 3 patient identifiers', 'yna', 1, 16),
(353, 46, 'Does any time entry use the 24hour clock', 'yn', 1, 17),
(354, 46, 'Entries in black pen only', 'yn', 1, 18),
(355, 46, 'Any errors crossed out and initialled', 'yn', 1, 19),
(356, 46, 'Whiteout used', 'yn', 1, 20),
(357, 46, 'Is there evience of discharge information eg contact person for pickup', 'yn', 1, 21),
(358, 46, 'Documented pressure injury/fall risk assessment', 'yna', 1, 22),
(359, 46, 'Documented observation eg: BP, pulse, oxygen saturations', 'yn', 1, 23),
(360, 46, 'Documented mobility assessment', 'yna', 1, 24),
(361, 46, 'Alert status documented eg: Diabetic, allergy', 'yna', 1, 25),
(362, 46, 'Documented use of interpreter', 'yna', 1, 26),
(363, 46, 'Dietary needs documented', 'yna', 1, 27),
(364, 46, 'Fasting and dressing instructions documented', 'yna', 1, 28),
(365, 46, 'Rights and responsibilities explained', 'yna', 1, 29),
(366, 46, 'Transport and responsibility person addressed', 'yna', 1, 30),
(367, 46, 'Medication history documented', 'yna', 1, 31),
(368, 46, 'Medication, allergy, alert status documented', 'yna', 1, 32),
(369, 46, 'Medication error documented and signed by clinical staff', 'yna', 1, 33),
(370, 46, 'Does it include route, dose and frequency', 'yn', 1, 34),
(371, 46, 'Do we allow nurse initiated medications', 'yna', 1, 35),
(372, 46, 'Do we allow telephone medication orders', 'yn', 1, 36),
(373, 46, 'medication order counteredsigned by the prescriber within 24 hours', 'yn', 1, 37),
(374, 46, 'Is there a surgical safety checklist', 'yn', 1, 38),
(375, 46, 'Has it been complited and signed at every patient episode', 'yn', 1, 39),
(376, 46, 'Is there documentred evidence of the surgeon, anaesthetist and registered nurse signatures', 'yna', 1, 40),
(377, 46, 'Documented evidence of the operation performed', 'yn', 1, 41),
(378, 46, 'Date and signed by surgeon', 'yn', 1, 42),
(379, 46, 'Time out attended', 'yn', 1, 43),
(380, 46, 'Instrument count or no count recorded', 'yn', 1, 44),
(381, 46, 'Sterile tracking system included', '0', 1, 45),
(382, 46, 'ASA completed and documented', 'yn', 1, 46),
(383, 46, 'Date and signed by anaesthetist', 'yn', 1, 47),
(384, 46, 'Evidence of a pre-operative anaesthetic consultation', 'yna', 1, 48),
(385, 46, 'Anaesthetic type given eg sedation/general/local', 'yn', 1, 49),
(386, 46, 'Post-operative instructions given documented', 'yna', 1, 50),
(387, 46, 'Any post-operative medication given documented on post-operative instruction', 'yna', 1, 51),
(388, 46, 'Carer signature', 'yna', 1, 52),
(389, 46, 'Patient MRN', 'txt', 1, 53),
(390, 46, 'Comments', 'txt', 0, 54),
(391, 47, 'Patient Name', 'yna', 1, 1),
(392, 47, 'Date of Birth', 'yna', 1, 2),
(393, 47, 'Gender', 'yna', 1, 3),
(394, 47, 'Address', 'yna', 1, 4),
(395, 47, 'Contact Phone Number', 'yna', 1, 5),
(396, 47, 'Marital status', 'yna', 1, 6),
(397, 47, 'Medicare number', 'yna', 1, 7),
(398, 47, 'Details of main contact person', 'yna', 1, 8),
(399, 47, 'Next of kin', 'yna', 1, 9),
(400, 47, 'Cultural requirements', 'yna', 1, 10),
(401, 47, 'Indigenous status', 'yna', 1, 11),
(402, 47, 'Signed consent to treatment', 'yna', 1, 12),
(403, 47, 'Signed financial consent', 'yna', 1, 13),
(404, 47, 'Advanced care directive', 'yna', 1, 14),
(405, 47, 'Each page has patient identification label', 'yna', 1, 15),
(406, 47, 'Does the label have 3 patient identifiers', 'yna', 1, 16),
(407, 47, 'Does any time entry use the 24hour clock', 'yna', 1, 17),
(408, 47, 'Entries in black pen only', 'yna', 1, 18),
(409, 47, 'Any errors crossed out and initialled', 'yna', 1, 19),
(410, 47, 'Whiteout used', 'yna', 1, 20),
(411, 47, 'Is there evience of discharge information eg contact person for pickup', 'yna', 1, 21),
(412, 47, 'Documented pressure injury/fall risk assessment', 'yna', 1, 22),
(413, 47, 'Documented observation eg: BP, pulse, oxygen saturations', 'yna', 1, 23),
(414, 47, 'Documented mobility assessment', 'yna', 1, 24),
(415, 47, 'Alert status documented eg: Diabetic, allergy', 'yna', 1, 25),
(416, 47, 'Documented use of interpreter', 'yna', 1, 26),
(417, 47, 'Dietary needs documented', 'yna', 1, 27),
(418, 47, 'Fasting and dressing instructions documented', 'yna', 1, 28),
(419, 47, 'Rights and responsibilities explained', 'yna', 1, 29),
(420, 47, 'Transport and responsibility person addressed', 'yna', 1, 30),
(421, 47, 'Medication history documented', 'yna', 1, 31),
(422, 47, 'Medication, allergy, alert status documented', 'yna', 1, 32),
(423, 47, 'Medication error documented and signed by clinical staff', 'yna', 1, 33),
(424, 47, 'Does it include route, dose and frequency', 'yna', 1, 34),
(425, 47, 'Do we allow nurse initiated medications', 'yna', 1, 35),
(426, 47, 'Do we allow telephone medication orders', 'yna', 1, 36),
(427, 47, 'medication order counteredsigned by the prescriber within 24 hours', 'yna', 1, 37),
(428, 47, 'Is there a surgical safety checklist', 'yna', 1, 38),
(429, 47, 'Has it been complited and signed at every patient episode', 'yna', 1, 39),
(430, 47, 'Is there documentred evidence of the surgeon, anaesthetist and registered nurse signatures', 'yna', 1, 40),
(431, 47, 'Documented evidence of the operation performed', 'yna', 1, 41),
(432, 47, 'Date and signed by surgeon', 'yna', 1, 42),
(433, 47, 'Time out attended', 'yna', 1, 43),
(434, 47, 'Instrument count or no count recorded', 'yna', 1, 44),
(435, 47, 'Sterile tracking system included', 'yna', 1, 45),
(436, 47, 'ASA completed and documented', 'yna', 1, 46),
(437, 47, 'Date and signed by anaesthetist', 'yna', 1, 47),
(438, 47, 'Evidence of a pre-operative anaesthetic consultation', 'yna', 1, 48),
(439, 47, 'Anaesthetic type given eg sedation/general/local', 'yn', 1, 49),
(440, 47, 'Post-operative instructions given documented', 'yna', 1, 50),
(441, 47, 'Any post-operative medication given documented on post-operative instruction', 'yna', 1, 51),
(442, 47, 'Carer signature', 'yna', 1, 52),
(443, 47, 'Patient MRN', 'txt', 1, 53),
(452, 48, 'Emergency exit lights functioning', 'yna', 1, 8),
(453, 48, 'No broken plugs, sockets or switches', 'yna', 1, 9),
(454, 48, 'No frayed, strained or damaged leads', 'yna', 1, 10),
(455, 48, 'Leads tagged and up to date', 'yna', 1, 11),
(456, 48, 'Appropriate storage of electrical equipment', 'yna', 1, 12),
(457, 48, 'Accessibility of main switch/circuit', 'yna', 1, 13),
(458, 48, 'No temporary leads on floors or leads across walkways', 'yna', 1, 14),
(459, 48, 'Adequate lightings', 'yna', 1, 15),
(460, 49, 'Inspection Area', 'txt', 1, 1),
(461, 49, 'Extinguishers in place and easily accesable', 'yna', 1, 2),
(462, 49, 'Extinguishers in place clearly marked for type of fire', 'yna', 1, 3),
(463, 49, 'Extinguisher recently serviced', 'yna', 1, 4),
(464, 49, 'Exit doors clearly marked and easily opened from inside', 'yna', 1, 5),
(465, 49, 'Exit clear of obstructions', 'yna', 1, 6),
(466, 49, 'Fire instructions displayed and adequate directions given', 'yna', 1, 7),
(467, 49, 'Emergency exit lights functioning', 'yna', 1, 8),
(468, 49, 'No broken plugs, sockets or switches', 'yna', 1, 9),
(469, 49, 'No frayed, strained or damaged leads', 'yna', 1, 10),
(470, 49, 'Leads tagged and up to date', 'yna', 1, 11),
(471, 49, 'Appropriate storage of electrical equipment', 'yna', 1, 12),
(472, 49, 'Accessibility of main switch/circuit', 'yna', 1, 13),
(473, 49, 'No temporary leads on floors or leads across walkways', 'yna', 1, 14),
(474, 49, 'Adequate lightings', 'yna', 1, 15),
(475, 49, 'Light fittings clean and in good condition', 'yna', 1, 16),
(476, 49, 'No direct or reflected glare', 'yna', 1, 17),
(477, 49, 'Non skid surfaces', 'yna', 1, 18),
(478, 49, 'Floor clean and uncluttered', 'yna', 1, 19),
(479, 49, 'Walkways adequately lit and marked', 'yna', 1, 20),
(480, 49, 'Even floor surface, no cracks, holes, loose or worn threads', 'yna', 1, 21),
(481, 49, 'Entries/walkways clear of rubbish and other materials', 'yna', 1, 22),
(482, 49, 'Unobstructed vision at intersections, stairs and landings', 'yna', 1, 23),
(483, 49, 'First aid kit clearly labeled', 'yna', 1, 24),
(484, 49, 'First aid kit easily accessible', 'yna', 1, 25),
(485, 49, 'hand cleanser / towel supplied', 'yna', 1, 26),
(486, 49, 'Suitable bins provided and emptied regularly', 'yna', 1, 27),
(487, 49, 'Appropriate storage of materials', 'yna', 1, 28),
(488, 49, 'Appropriate storage of equipment', 'yna', 1, 29),
(489, 49, 'Adequate storage/accessibility', 'yna', 1, 30),
(490, 49, 'general condition of storage units', 'yna', 1, 31),
(491, 49, 'Suitable furniture', 'yna', 1, 32),
(492, 49, 'Suitable working height', 'yna', 1, 33),
(493, 49, 'Equipment/machinery easily accessible', 'yna', 1, 34),
(494, 49, 'Tidness of work area / clear of rubbish', 'yna', 1, 35),
(495, 49, 'Cupboard hinges secure, not loose', 'yna', 1, 36),
(496, 50, 'Staff member', 'txt', 0, 1),
(497, 50, 'Are the patients current medication ducomented in the file?', 'yna', 1, 2),
(498, 50, 'Is the allergy status specified?', 'yna', 1, 3),
(499, 50, 'If allergy present, is reaction specified?', 'yna', 1, 4),
(500, 50, 'If allergy present, is allergy noted in the patient file?', 'yna', 1, 5),
(501, 50, 'Is allergy status in computer system?', 'yna', 1, 6),
(502, 50, 'Is medication information provided to patients?', 'yna', 1, 7),
(503, 50, 'Is medication ordsr signed by treating doctor?', 'yna', 1, 8),
(504, 50, 'Are the five rights adhered by nurse?', 'yna', 1, 9),
(505, 50, 'Are two nurses present for administration when necessary?', 'yna', 1, 10),
(506, 50, 'Is medical record signed by both nurses?', 'yna', 1, 11),
(507, 50, 'Is drug book completed accurately?', 'yna', 1, 12),
(508, 50, 'Is a copy of MIMS available to staff?', 'yna', 1, 13),
(509, 50, 'Is medication stored in locked cupboard if necessary?', 'yna', 1, 14),
(510, 51, 'Staff member', 'txt', 0, 1),
(511, 51, 'Are shoes closed toe?', 'yn', 1, 2),
(512, 51, 'Are shoes closed back?', 'yn', 1, 3),
(513, 51, 'Are shoes water repellant?', 'yn', 1, 4),
(514, 51, 'Can shoes be cleaned on a regular basis?', 'yn', 1, 5),
(515, 51, 'Can shoes be cleaned immediately if visibly soiled?', 'yn', 1, 6),
(516, 51, 'Are shoes non-slip?', 'yn', 1, 7),
(517, 51, 'Are shoes low or no heeled?', 'yn', 1, 8),
(518, 52, 'Staff member', 'txt', 0, 1),
(519, 52, 'The nurse follow the cleaning scheule as specified', 'yn', 1, 2),
(520, 52, 'The cleaners follow the cleaning schedule as specified', 'yn', 1, 3),
(521, 52, 'Theatre attire is worn inside theatre while cleaning', 'yn', 1, 4),
(522, 52, 'Infection control standards are followed', 'yn', 1, 5),
(523, 52, 'The cleaner/nurses schedule adheres to the environmental cleaning policy PD2012_06', 'yn', 1, 6),
(524, 52, 'The appropriate resources are avilable to complete the schedule', 'yn', 1, 7),
(525, 52, 'The schedule is initialed with completion of each section', 'yn', 1, 8),
(526, 52, 'Is the DAy Surgery well maintained and clean?', 'yn', 1, 9),
(527, 52, 'Concerns are documented in the communication book. NUM fills in QIR if required', 'yn', 1, 10),
(528, 52, 'the cleaners are trained in cleaninhg health facilities', 'yn', 1, 11),
(529, 52, 'Job description available to the contract cleaners', 'yna', 1, 12),
(530, 53, 'Patient Name', 'txt', 0, 1),
(531, 53, 'Date of Audit', 'txt', 1, 2),
(532, 53, 'Patient MRN', 'txt', 1, 3),
(533, 53, 'Clinical handover given by the admission nurse to the anaesthetic nurse', 'yn', 1, 4),
(534, 53, 'Handover given at patient bed side in the anaesthetic bay', 'yn', 1, 5),
(535, 53, 'All clinical information given as per work instruction', 'yn', 1, 6),
(536, 53, 'Surgical Safety Checklist signed by both nurses', 'yn', 1, 7),
(537, 53, 'Patient transferred to theatre', 'yn', 1, 8),
(538, 53, 'Clinical handover given by anesthetic nurse/anaesthetist to surgical team', 'yn', 1, 9),
(539, 53, 'Time out attended as per work instruction', 'yn', 1, 10),
(540, 53, 'Surgical Safety Checklist signed by both anaesthetic nurse and scrub/scout nurse', 'yn', 1, 11),
(541, 53, 'Patient transferred to Recovery Bay', 'yn', 1, 12),
(542, 53, 'Clinical handover given by scrub/scout nurse to recovery nurse', 'yn', 1, 13),
(543, 53, 'All clinical information given as per work instruction', 'yn', 1, 14),
(544, 53, 'Surgical Safety Checklist signed by both nurses', 'yn', 1, 15),
(545, 53, 'Patient transferred to discharge room with escort present', 'yn', 1, 16),
(546, 53, 'Discharge summary given to patient escort', 'yn', 1, 17),
(547, 53, 'Post-operative instruction given to patient and escort', 'yn', 1, 18),
(548, 53, 'Medication instruction/information given to patient and escort', 'yn', 1, 19),
(549, 53, 'emergency phone numbers provided to patient and escort', 'yn', 1, 20),
(550, 53, 'Discussed falls prevention with patient and escort', 'yn', 1, 21),
(551, 53, 'Discussed pressure area management with patient and escort', 'yn', 1, 22),
(552, 53, 'If no escort present refer to procedure 010', 'yn', 1, 23),
(553, 53, 'The nurse and escort sign the Surgical Safety Checklist', 'yn', 1, 24),
(554, 53, 'Any deviation to the process is directed to the NUM and QIR is completed', 'yn', 1, 25),
(555, 54, 'Patient Name', 'txt', 0, 1),
(556, 54, 'Patient MRN', 'txt', 1, 2),
(557, 54, 'Patient ID complete', 'yn', 1, 3),
(558, 54, 'Adverse reaction filled in the ADR box', 'yn', 1, 4),
(559, 54, 'Drug name clearly written', 'yn', 1, 5),
(560, 54, 'Drug route clearly written', 'yn', 1, 6),
(561, 54, 'Frequency of drug administration clearly written', 'yn', 1, 7),
(562, 54, 'Correct drug dosage ordered', 'yn', 1, 8),
(563, 54, 'Drug prescriber sign the order', 'yn', 1, 9),
(564, 54, 'Two RNs to sign the order chart', 'yn', 1, 10),
(565, 54, 'The telephone order within 24 hours of order?', 'yn', 1, 11),
(566, 54, 'The telephone order checked by two RNs?', 'yn', 1, 12),
(567, 54, 'Medication chart filled in the patient medical records', 'yn', 1, 13),
(568, 55, 'Work area', 'txt', 1, 1),
(569, 55, 'Moment 1 - Before touching a patient', 'yn', 1, 2),
(570, 55, 'Moment 2 - Before a procedure', 'yn', 1, 3),
(571, 55, 'Staff Type : Nursing, Doctor, Anaesthetist and CSSD', 'txt', 1, 4),
(572, 55, 'Moment 3 - After a procedure or body fluid exposure risk', 'yn', 1, 5),
(573, 55, 'Moment 4 - After touching a patient', 'yn', 1, 6),
(574, 55, 'Moment 5 - After touching a potient&#39;s surroundings', 'yn', 1, 7),
(575, 55, 'What action - Alcohol Rub, Hand Wash or Missed', 'txt', 1, 8),
(576, 55, 'Glove off?', 'yn', 1, 9),
(577, 56, 'SECTION 1: WASTE MANAGEMENT', 'sec', 0, 1),
(578, 56, 'Body fluid - Incontience pads/nappies are not included in clinicl waste unless there is visible blood', 'yna', 1, 2),
(579, 56, 'Yellow bags/containers are availabe for clinical waste', 'yna', 1, 3),
(580, 56, 'Black/white bags are available for general waste', 'yna', 1, 4),
(581, 56, 'Purple bags/containers are available for cytotoxic waste', 'yna', 1, 5),
(582, 56, 'Sharps containers comply with AS4031(non reusable) or AS/NZS 4261(reusable)', 'yna', 1, 6),
(583, 56, 'SECTION 2: DRUG STORAGE', 'sec', 0, 7),
(584, 56, 'Drug refrigerators have temp recorded daily (sighted evidence for full compliance)', 'yna', 1, 8),
(585, 56, 'refrigerators have temperaature maintained between 2 and 8 degree C', 'yna', 1, 9),
(586, 56, 'There is no food kept in drug refrigerators', 'txt', 1, 10),
(587, 56, 'SECTION 3: ENVIRONMENTAL CLEANING', 'sec', 0, 11),
(588, 56, 'Floor surface is non-slip', 'yna', 1, 12),
(589, 56, 'Floor surface is easy to clean and in good repair', 'yna', 1, 13),
(590, 56, 'Floor surface in treatment area is non-carpeted', 'yna', 1, 14),
(591, 56, 'Wet mopping in clinical areas', 'yna', 1, 15),
(592, 56, 'Carpets vacummed in clinical areas', 'yna', 1, 16),
(593, 56, 'Vacumm cleaner fitted with a particulate retaining filter', 'yna', 1, 17),
(594, 56, 'Vacumm claner filters are changed in accordnace with the manufacturer&#39;s instructions', 'yna', 1, 18),
(595, 56, 'Vacuum exhaust is directed away from door', 'yna', 1, 19),
(596, 56, 'Dust retaining mops are not used in high risk area', 'yna', 1, 20),
(597, 56, 'Ordinary brooms are NOT used in patient/clinical areas', 'yna', 1, 21),
(598, 56, 'Buckets emptied after use, washed with detergent and warm water/stored dry', 'yna', 1, 22),
(599, 56, 'Mops laundered as per AS4146 (thermally or chemically disinfected/stored dry)', 'yna', 1, 23),
(600, 56, 'Walls/blinds/curtains are cleaned regularly', 'yna', 1, 24),
(601, 56, 'Walls/blinds/curtains are cleaned when visibly soiled', 'yna', 1, 25),
(602, 56, 'Toilets/sinks/bath/shower cubicles cleaned when required', 'yna', 1, 26),
(603, 56, 'Patient care areas cleaned and dried at least daily', 'yna', 1, 27),
(604, 56, 'Patient care areas cleaned and dried when visibly soiled', 'yna', 1, 28),
(605, 56, 'Patient trolley between patients cleaned regularly', 'yna', 1, 29),
(606, 56, 'Procedure trolley is cleaned after use', 'yna', 1, 30),
(607, 56, 'HEPA filter have been calibrated yearly', 'yna', 1, 31),
(608, 56, 'Air conditioner maintenance has been attended monthly', 'yna', 1, 32),
(609, 56, 'SECTION 4: BLOOD/BODY FLUIDE SPILLS', 'sec', 0, 33),
(610, 56, 'Contaminant is soaked up/removed before area is cleaned', 'yna', 1, 34),
(611, 56, 'Spill area is cleaned and dried as soon as practicable', 'yna', 1, 35),
(612, 56, 'Generation of aerosols is minimised through work practices', 'yna', 1, 36),
(613, 56, 'In web areas, eg showers carefully ashed off into sewerage system and area flushed with detergent and water', 'yna', 1, 37),
(614, 56, 'Safety goggles are available', 'yna', 1, 38),
(615, 56, 'Gloves are available', 'yna', 1, 39),
(616, 56, 'Impervious gowns are available', 'yna', 1, 40),
(617, 56, 'Sodium hypochlorite, when used, is in accordance with manufacturer&#39;s instruction and HS safety instructions', 'yna', 1, 41),
(618, 56, 'Mop/bucket thoroughly cleaned after use and stored dry. ', 'yna', 1, 42),
(619, 56, 'SECTION 6: HAND HYGIENE', 'sec', 0, 43),
(620, 56, 'Neutral soap handwashing solution is available at all hand basins', 'yna', 1, 44),
(621, 56, 'recommended antimicrobial Handwashing solutions are available at all clinical hand basins', 'yna', 1, 45),
(622, 56, 'There is recommended/compatiable hand moisturiser available', 'yna', 1, 46),
(623, 56, 'There is no evidence of bar soap or nail brushes on hand basins for staff use', 'yna', 1, 47),
(624, 56, 'Hand basins are easily accessible and free of obstacles', 'yna', 1, 48),
(625, 56, 'There is paper towel or a working towel disenser at all hand basins', 'yna', 1, 49),
(626, 56, 'Where paper towel is in use there s a waste bin available', 'yna', 1, 50),
(627, 56, 'Towels are single use only', 'yna', 1, 51),
(628, 56, 'Alcohol hand rubs are available within all patients&#39; environments across the facility', 'yna', 1, 52),
(629, 56, 'Staff do not wear rings when performing invasive procedures', 'yna', 1, 53),
(630, 56, 'SECTION 7: LINEN', 'sec', 0, 54),
(631, 56, 'Linen skips are clear and in good condition', 'yna', 1, 55),
(632, 56, 'Soiled linen bags are changed with 3/4 filled', 'yna', 1, 56),
(633, 56, 'Soiled linen bags are stored in a dedicated area until collected', 'yna', 1, 57),
(634, 56, 'Linen that is heavily soiled/wet is contained in suitable impermeable bags', 'yna', 1, 58),
(635, 56, 'Soiled linen is placed in linen ags at point of generation. eg bedside', 'yna', 1, 59),
(636, 56, 'Clean linen is stored to protect it from environmental contaminants such as dust, moisture', 'yna', 1, 60),
(637, 56, 'Clean linen is stored to protect it from excessive handling or traffic', 'yna', 1, 61),
(638, 56, 'Clean linen is not left in patient&#39;s environment', 'yna', 1, 62),
(639, 56, 'Clean and soiled linen is physically separated', 'yna', 1, 63),
(640, 56, 'SECTION 8: PERSONAL PROTECTIVE EQUIPMENT', 'sec', 0, 64),
(641, 56, 'Gloves are available in a range of sizes', 'yna', 1, 65),
(642, 56, 'Latex free alternative gloves are available', 'yna', 1, 66),
(643, 56, 'Storage system protect gloves from contaminants', 'yna', 1, 67),
(644, 56, 'General/Household gloves are issued as person specific', 'yna', 1, 68),
(645, 56, 'General/Household gloves are washed and stored dry after use', 'yna', 1, 69),
(646, 56, 'General/Household gloves storage systems protects from contaminants', 'yna', 1, 70),
(647, 56, 'Protective eyewear is available and readily accesible to staff when splash is a risk', 'yna', 1, 71),
(648, 56, 'protective eyewear is clean and in good condition', 'yna', 1, 72),
(649, 56, 'Surgical masks are available to staff', 'yna', 1, 73),
(650, 56, 'Masks are dispensed from the original container at point of use', 'yna', 1, 74),
(651, 56, 'Impermable gowns/aprons available to staff undertaking procedures likely to splash/contaminate their clothing', 'yna', 1, 75),
(652, 56, 'Long hair is tied back and beards coverd during aseptic proceures', 'yna', 1, 76),
(653, 56, 'SECTION 9: REPROCESSING OF RE-USABLE INSTRUMENTS AND EQUIPMENT', 'sec', 0, 77),
(654, 56, 'There is a dedicated cleaning area used for cleaning reusable items', 'yna', 1, 78),
(655, 56, 'Work flow direction in the area is from dirty to clean', 'yna', 1, 79),
(656, 56, 'There is dedicated staff hand basin, or hand rub is available at the entry/exit of the dirty utility room', 'yna', 1, 80),
(657, 56, 'PPE is available: disposable gloves, aprons, face proitection, eyewear and mask or face shield', 'yna', 1, 81),
(658, 56, 'Soiled or used items are transferred nto sterilising department in punctiure and leak resistant containers with lids', 'yna', 1, 82),
(659, 57, 'SECTION 1: WASTE MANAGEMENT', 'sec', 0, 1),
(660, 57, 'Body fluid - Incontience pads/nappies are not included in clinicl waste unless there is visible blood', 'yna', 1, 2),
(661, 57, 'Yellow bags/containers are availabe for clinical waste', 'yna', 1, 3),
(662, 57, 'Black/white bags are available for general waste', 'yna', 1, 4),
(663, 57, 'Purple bags/containers are available for cytotoxic waste', 'yna', 1, 5),
(664, 57, 'Sharps containers comply with AS4031(non reusable) or AS/NZS 4261(reusable)', 'yna', 1, 6),
(665, 57, 'SECTION 2: DRUG STORAGE', 'sec', 0, 7),
(666, 57, 'Drug refrigerators have temp recorded daily (sighted evidence for full compliance)', 'yna', 1, 8),
(667, 57, 'refrigerators have temperaature maintained between 2 and 8 degree C', 'yna', 1, 9),
(668, 57, 'There is no food kept in drug refrigerators', 'txt', 1, 10),
(669, 57, 'SECTION 3: ENVIRONMENTAL CLEANING', 'sec', 0, 11),
(670, 57, 'Floor surface is non-slip', 'yna', 1, 12),
(671, 57, 'Floor surface is easy to clean and in good repair', 'yna', 1, 13),
(672, 57, 'Floor surface in treatment area is non-carpeted', 'yna', 1, 14),
(673, 57, 'Wet mopping in clinical areas', 'yna', 1, 15),
(674, 57, 'Carpets vacummed in clinical areas', 'yna', 1, 16),
(675, 57, 'Vacumm cleaner fitted with a particulate retaining filter', 'yna', 1, 17),
(676, 57, 'Vacumm claner filters are changed in accordnace with the manufacturer&#39;s instructions', 'yna', 1, 18),
(677, 57, 'Vacuum exhaust is directed away from door', 'yna', 1, 19),
(678, 57, 'Dust retaining mops are not used in high risk area', 'yna', 1, 20),
(679, 57, 'Ordinary brooms are NOT used in patient/clinical areas', 'yna', 1, 21),
(680, 57, 'Buckets emptied after use, washed with detergent and warm water/stored dry', 'yna', 1, 22),
(681, 57, 'Mops laundered as per AS4146 (thermally or chemically disinfected/stored dry)', 'yna', 1, 23),
(682, 57, 'Walls/blinds/curtains are cleaned regularly', 'yna', 1, 24),
(683, 57, 'Walls/blinds/curtains are cleaned when visibly soiled', 'yna', 1, 25),
(684, 57, 'Toilets/sinks/bath/shower cubicles cleaned when required', 'yna', 1, 26),
(685, 57, 'Patient care areas cleaned and dried at least daily', 'yna', 1, 27),
(686, 57, 'Patient care areas cleaned and dried when visibly soiled', 'yna', 1, 28),
(687, 57, 'Patient trolley between patients cleaned regularly', 'yna', 1, 29),
(688, 57, 'Procedure trolley is cleaned after use', 'yna', 1, 30),
(689, 57, 'HEPA filter have been calibrated yearly', 'yna', 1, 31),
(690, 57, 'Air conditioner maintenance has been attended monthly', 'yna', 1, 32),
(691, 57, 'SECTION 4: BLOOD/BODY FLUIDE SPILLS', 'sec', 0, 33),
(692, 57, 'Contaminant is soaked up/removed before area is cleaned', 'yna', 1, 34),
(693, 57, 'Spill area is cleaned and dried as soon as practicable', 'yna', 1, 35),
(694, 57, 'Generation of aerosols is minimised through work practices', 'yna', 1, 36),
(695, 57, 'In web areas, eg showers carefully ashed off into sewerage system and area flushed with detergent and water', 'yna', 1, 37),
(696, 57, 'Safety goggles are available', 'yna', 1, 38),
(697, 57, 'Gloves are available', 'yna', 1, 39),
(698, 57, 'Impervious gowns are available', 'yna', 1, 40),
(699, 57, 'Sodium hypochlorite, when used, is in accordance with manufacturer&#39;s instruction and HS safety instructions', 'yna', 1, 41),
(700, 57, 'Mop/bucket thoroughly cleaned after use and stored dry. ', 'yna', 1, 42),
(701, 57, 'SECTION 6: HAND HYGIENE', 'sec', 0, 43),
(702, 57, 'Neutral soap handwashing solution is available at all hand basins', 'yna', 1, 44),
(703, 57, 'recommended antimicrobial Handwashing solutions are available at all clinical hand basins', 'yna', 1, 45),
(704, 57, 'There is recommended/compatiable hand moisturiser available', 'yna', 1, 46),
(705, 57, 'There is no evidence of bar soap or nail brushes on hand basins for staff use', 'yna', 1, 47),
(706, 57, 'Hand basins are easily accessible and free of obstacles', 'yna', 1, 48),
(707, 57, 'There is paper towel or a working towel disenser at all hand basins', 'yna', 1, 49),
(708, 57, 'Where paper towel is in use there s a waste bin available', 'yna', 1, 50),
(709, 57, 'Towels are single use only', 'yna', 1, 51),
(710, 57, 'Alcohol hand rubs are available within all patients&#39; environments across the facility', 'yna', 1, 52),
(711, 57, 'Staff do not wear rings when performing invasive procedures', 'yna', 1, 53),
(712, 57, 'SECTION 7: LINEN', 'sec', 0, 54),
(713, 57, 'Linen skips are clear and in good condition', 'yna', 1, 55),
(714, 57, 'Soiled linen bags are changed with 3/4 filled', 'yna', 1, 56),
(715, 57, 'Soiled linen bags are stored in a dedicated area until collected', 'yna', 1, 57),
(716, 57, 'Linen that is heavily soiled/wet is contained in suitable impermeable bags', 'yna', 1, 58),
(717, 57, 'Soiled linen is placed in linen ags at point of generation. eg bedside', 'yna', 1, 59),
(718, 57, 'Clean linen is stored to protect it from environmental contaminants such as dust, moisture', 'yna', 1, 60),
(719, 57, 'Clean linen is stored to protect it from excessive handling or traffic', 'yna', 1, 61),
(720, 57, 'Clean linen is not left in patient&#39;s environment', 'yna', 1, 62),
(721, 57, 'Clean and soiled linen is physically separated', 'yna', 1, 63),
(722, 57, 'SECTION 8: PERSONAL PROTECTIVE EQUIPMENT', 'sec', 0, 64),
(723, 57, 'Gloves are available in a range of sizes', 'yna', 1, 65),
(724, 57, 'Latex free alternative gloves are available', 'yna', 1, 66),
(725, 57, 'Storage system protect gloves from contaminants', 'yna', 1, 67),
(726, 57, 'General/Household gloves are issued as person specific', 'yna', 1, 68),
(727, 57, 'General/Household gloves are washed and stored dry after use', 'yna', 1, 69),
(728, 57, 'General/Household gloves storage systems protects from contaminants', 'yna', 1, 70),
(729, 57, 'Protective eyewear is available and readily accesible to staff when splash is a risk', 'yna', 1, 71),
(730, 57, 'protective eyewear is clean and in good condition', 'yna', 1, 72),
(731, 57, 'Surgical masks are available to staff', 'yna', 1, 73),
(732, 57, 'Masks are dispensed from the original container at point of use', 'yna', 1, 74),
(733, 57, 'Impermable gowns/aprons available to staff undertaking procedures likely to splash/contaminate their clothing', 'yna', 1, 75),
(734, 57, 'Long hair is tied back and beards coverd during aseptic proceures', 'yna', 1, 76),
(735, 57, 'SECTION 9: REPROCESSING OF RE-USABLE INSTRUMENTS AND EQUIPMENT', 'sec', 0, 77),
(736, 57, 'There is a dedicated cleaning area used for cleaning reusable items', 'yna', 1, 78),
(737, 57, 'Work flow direction in the area is from dirty to clean', 'yna', 1, 79),
(738, 57, 'There is dedicated staff hand basin, or hand rub is available at the entry/exit of the dirty utility room', 'yna', 1, 80),
(739, 57, 'PPE is available: disposable gloves, aprons, face proitection, eyewear and mask or face shield', 'yna', 1, 81),
(740, 57, 'Soiled or used items are transferred nto sterilising department in punctiure and leak resistant containers with lids', 'yna', 1, 82),
(741, 58, 'Staff Member', 'txt', 0, 1),
(742, 58, 'Was patient orientated to their surroundings?', 'yn', 1, 2),
(743, 58, 'Did the patient/carer receive education regarding falls?', 'yn', 1, 3),
(744, 58, 'Was the bed at the appropriate height?', 'yn', 1, 4),
(745, 58, 'Was the bed brakes on?', 'yn', 1, 5),
(746, 58, 'Was the bed area free from clutter and obstacles?', 'yn', 1, 6),
(747, 58, 'Was the use of a monbility aid used appropriately where necessary', 'yn', 1, 7),
(748, 58, 'Did the patient has appropriate non-slip footwear on?', 'yn', 1, 8),
(749, 58, 'Wrer the ned rails used appropriately (Both rails up during transport and unattended in bed)?', 'yn', 1, 9),
(750, 58, 'Is the patients mobility status accurately recorded on the mobility screening tool?', 'yn', 1, 10),
(751, 58, 'Are staff aware of availaable equipment to assist with mobility when necessary?', 'yn', 1, 11),
(752, 58, 'Are staff aware where the mobility equipment is located?', 'yn', 1, 12),
(753, 58, 'During clinical handover of the patient care, if patient scored 1 or more on the mobility screening tool, was this mentioned and were staff informed as to why?', 'yn', 1, 13),
(754, 59, 'Staff member', 'txt', 0, 1),
(755, 59, 'Is the patient name confirmed with the patient?', 'yn', 1, 2),
(756, 59, 'Is the date of birth confoirmed with patient?', 'yn', 1, 3),
(757, 59, 'Is thr procedure confoirmed with patient (oe carer if applicable) and correct on consent form?', 'yn', 1, 4),
(758, 59, 'Is operative site marked correctly (Two RNs present)?', 'yn', 1, 5),
(759, 59, 'Has the file been signed indicating check has been done?', 'yn', 1, 6),
(760, 59, 'Hs the correct allergy status of the patient been ideitified correctly? (Red/white wristband, red/white hat)?', 'yn', 1, 7),
(761, 59, 'Is the Doctor performing procedure confirmed with patient?', 'yn', 1, 8),
(762, 59, 'Does the coctors name match the consent form/medical record/patient label?', 'yn', 1, 9),
(763, 59, 'Is the signature on the consent form checked with the patient or carer if applicable?', 'yn', 1, 10),
(764, 59, 'Are the correct details in VIP software for the patient?', 'yn', 1, 11),
(765, 59, 'Are the correct details in Dox software for the patient?', 'yn', 1, 12),
(766, 60, 'Staff member', 'txt', 0, 1),
(767, 60, 'Compentencies are completed as a skill is learnt', 'yn', 1, 2),
(768, 60, 'Competencies are completed on a yearly basis by all staff', 'yn', 1, 3),
(769, 60, 'Compentencies are amde to be specific and meanful to each area', 'yn', 1, 4),
(770, 60, 'Staff complete question sheet revelant to each area eg recovery', 'yn', 1, 5),
(771, 60, 'Infection control questionnarie complete', 'yn', 1, 6),
(772, 60, 'Feedback provided to staff on questionnaries completed', 'yn', 1, 7),
(773, 60, 'Further training is provided if compentency is not achieved', 'yn', 1, 8),
(774, 61, 'Staff member', 'txt', 0, 1),
(775, 61, 'Is the temperature ontrol checked everyday for each fridge?', 'yn', 1, 2),
(776, 61, 'If temperature is outside the range, does a QIR ger filled in', 'yn', 1, 3),
(777, 61, 'Are the fridges free of ice', 'yn', 1, 4),
(778, 61, 'Is the refrigerated drug contents checked monthly for supplies', 'yn', 1, 5),
(779, 61, 'Is the checxklist signed every day', 'yn', 1, 6),
(780, 62, 'Has a discharge summary neem filled in', 'yn', 1, 1),
(781, 62, 'Has the discharge summary been scanned into the Dox medical record', 'yn', 1, 2),
(782, 62, 'Principle diagnosis and proceure written clearly', 'yn', 1, 3),
(783, 62, 'Patient ID', 'txt', 0, 4),
(784, 62, 'Surgeon/Anaesthetist/Assist filled', 'yn', 1, 5),
(785, 62, 'Any specific instruction specified', 'yn', 1, 6),
(786, 62, 'Post operative instructions given', 'yn', 1, 7),
(787, 62, 'Prescription given', 'yn', 1, 8),
(788, 62, 'Post-operative appointment made', 'yn', 1, 9),
(789, 62, 'Assessment for falls made', 'yn', 1, 10),
(790, 62, 'Escort present', 'yn', 1, 11),
(791, 62, 'Surgical Safety Checklist signed by nurse and escort', 'yn', 1, 12),
(792, 62, 'Was a QIR filled in if applicable', 'yn', 1, 13),
(793, 63, 'Area', 'txt', 0, 1),
(794, 63, 'Bar soap or nail bruches NOT evident on hand basins for staff use', 'yn', 1, 2),
(795, 63, 'Staff fingernails are clean and short', 'yn', 1, 3),
(796, 63, 'Artificial nails are not observed', 'yn', 1, 4),
(797, 63, 'Routin hand wash procedure-observed', 'sec', 0, 5),
(798, 63, 'Hands are wet first, then hand wash product is applied', 'yn', 1, 6),
(799, 63, 'Hands are rubbed together vigorously for at least 15 seconds', 'yn', 1, 7),
(800, 63, 'Hands are rinsed free of soap under running water', 'yn', 1, 8),
(801, 63, 'hands are dried thoroughly using paper towel or single use towel including under ring area', 'yn', 1, 9),
(802, 63, 'Alcohol hand rub procedure - Observe', 'sec', 0, 10),
(803, 63, 'Alcohol hand rubs are strategically placed in all patient care area', 'yn', 1, 11),
(804, 63, 'Solution is in contact with all surfaces of the hands', 'yn', 1, 12),
(805, 63, 'hands are rubbed togetjher vigorously until solutions has evaporated', 'yn', 1, 13),
(806, 63, 'hands that are visibly soiled are washed with soap and water', 'yn', 1, 14),
(807, 63, 'Hand Hygiene procedure', 'sec', 0, 15),
(808, 63, 'Staff performed hand hydiene immediately before direct patient contact', 'yn', 1, 16),
(809, 63, 'Staff performed hand hydiene after direct patient contact', 'yn', 1, 17),
(810, 63, 'Staff performed hand hygiene before a procedure', 'yn', 1, 18),
(811, 63, 'Staff performed hand hygiene after removal of gloves', 'yn', 1, 19),
(812, 63, 'Staff performed hand hygiene immediately after a procedure', 'yn', 1, 20),
(813, 63, 'Staff performed hand hygiene after touching patients belongings or equipment around them', 'yn', 1, 21),
(814, 63, 'Staff are observed washing hands with soap and water if contaminated with blood or bodily fluids', 'yn', 1, 22),
(815, 63, 'All hand washing facilities are equipped with soap, running water and had drying facilities', 'yn', 1, 23),
(816, 63, 'Hand moisturising cream is available for staff use', 'yn', 1, 24),
(817, 63, 'Staff are observed using hand moisturising cream', 'yn', 1, 25),
(818, 63, 'Hand washing technique is reinforced at the staff induction program', 'yn', 1, 26),
(819, 63, 'A poster depicting good hand washing technique is present at once clinical hand basin', 'yn', 1, 27),
(820, 63, 'Hand hygiene on-line education completed with certificate', 'yn', 1, 28),
(821, 64, 'Staff member', 'txt', 0, 1),
(822, 64, 'Is the identification wristband flexible', 'yn', 1, 2),
(823, 64, 'Is the ID wristband smooth', 'yn', 1, 3),
(824, 64, 'Can the ID wristband be cleaned', 'yn', 1, 4),
(825, 64, 'Is the ID wristband water proof', 'yn', 1, 5),
(826, 64, 'Is the ID wristband breathable and non-allergenic', 'yn', 1, 6),
(827, 64, 'Has an ID wristband applied to the patient', 'yn', 1, 7),
(828, 64, 'Was the ID wristband wasy to apply', 'yn', 1, 8),
(829, 64, 'Is the correct information on the Id wristband including three patient identifiers', 'yn', 1, 9),
(830, 64, 'Is the format of the information correct', 'yn', 1, 10),
(831, 64, 'Is the ID wristband the correct colour according to patients&#39; allergy status', 'yn', 1, 11),
(832, 64, 'Is the ID wristband lefible', 'yn', 1, 12),
(833, 64, 'Is the ID wristband secure and sealed (temper proof)', 'yn', 1, 13),
(834, 64, 'Does the ID wristband fot the patient (not too tight or too loose)', 'yn', 1, 14),
(835, 64, 'During clinical handover of the patient care, did it include correct patient, correct site and correct procedure', 'yn', 1, 15),
(836, 65, 'Patient ID', 'txt', 0, 1),
(837, 65, 'Does the transfer form have a patient label affixed', 'yn', 1, 2),
(838, 65, 'Procedure performed filled in', 'yn', 1, 3),
(839, 65, 'Reason for transfer filled in', 'yn', 1, 4),
(840, 65, 'Transferred to and time filled in', 'yn', 1, 5),
(841, 65, 'Nursing notes filled in', 'yn', 1, 6),
(842, 65, 'List of medications patient is on filled in or attached', 'yn', 1, 7),
(843, 65, 'Next of kin informed', 'yn', 1, 8),
(844, 65, 'Were the clinical alerts notified eg falls risk, diabetes, asthma, infectious disease', 'yn', 1, 9),
(845, 65, 'Allergy status known', 'yn', 1, 10),
(846, 65, 'Advance Care directive known', 'yn', 1, 11),
(847, 65, 'Was the transfer form photocopied and canned into Dox', 'yn', 1, 12),
(848, 65, 'Was there a letter from the Doctor attached to the trasnfer form', 'yn', 1, 13),
(849, 65, 'Was the letter from Doctor photocopied and scanned into Dox', 'yn', 1, 14),
(850, 65, 'Was a QIR filled in', 'yn', 1, 15),
(851, 66, 'Staff member', 'txt', 0, 1),
(852, 66, 'Quantity of S8 and S4 drugs supplied are entered with date and time by 2 RNs with red pen', 'yn', 1, 2),
(853, 66, 'Name of patient to whom the drug was administered was entered with date and time in black pen', 'yn', 1, 3),
(854, 66, 'name of anaesthetist who prescribed and administered the drug was entered with date and time in black pen', 'yn', 1, 4),
(855, 66, 'The amout of drug administered amd the amount discarded was entered and signed by the anaesthetist and the anaesthetic nurse with date and time in black pen', 'yn', 1, 5),
(856, 66, 'Balance of drug is correct', 'yn', 1, 6),
(857, 66, 'Any mistake made in the entry was corrected by making a marginal note or footnote by initialling and dating it', 'yn', 1, 7),
(858, 66, 'Inventory of drugs were checked by the end of each surgiucal day by 2 RNs, signed, date and time with red pen', 'yn', 1, 8),
(859, 66, 'Handwriting is ledible', 'yn', 1, 9),
(860, 66, 'Audit of Ward Drug Register was entered with green pen by NUM', 'yn', 1, 10),
(861, 66, 'Expired drugs were destroyed by a RN in the presence of NUM signed with date and time', 'yn', 1, 11),
(862, 66, '5 patient files were randomly selected to check if the amount administered corresponded to the amount recorded in the Ward Drug Register', '0', 1, 12),
(863, 67, 'Date (DD/MM/YYYY)', 'txt', 1, 1),
(864, 67, 'Emergency Call button', 'sec', 0, 2),
(865, 67, 'Operatiing Room 1 is functioning correctly', 'yn', 1, 3),
(866, 67, 'Operatiing Room 2 is functioning correctly', 'yn', 1, 4),
(867, 67, 'Corridor is functioning correctly', 'yn', 1, 5),
(868, 67, 'Nurse Call Button', 'sec', 0, 6),
(869, 67, 'Anaesthetic Bay 1 is functioning correctly', 'yn', 1, 7),
(870, 67, 'Anaesthetic Bay 2 is functioning correctly', 'yn', 1, 8),
(871, 67, 'Anaesthetic Bay 3 is functioning correctly', 'yn', 1, 9),
(872, 67, 'Anaesthetic Bay 4 is functioning correctly', 'yn', 1, 10),
(873, 67, 'Recovery Bay 1 is functioning correctly', 'yn', 1, 11),
(874, 67, 'Recovery Bay 2 is functioning correctly', 'yn', 1, 12),
(875, 67, 'Recovery Bay 3 is functioning correctly', 'yn', 1, 13),
(876, 67, 'Recovery Bay 4 is functioning correctly', 'yn', 1, 14),
(877, 67, 'Recovery Bay 5 is functioning correctly', 'yn', 1, 15),
(878, 67, 'Recovery Bay 6 is functioning correctly', 'yn', 1, 16),
(879, 67, 'DIsabled toilet is functioning correctly', 'yn', 1, 17),
(880, 67, 'Ambultory toilet is functioning correctly', 'yn', 1, 18),
(881, 67, 'Patient change room 1 is functioning correctly', 'yn', 1, 19),
(882, 67, 'Patient change room 2 is functioning correctly', 'yn', 1, 20),
(883, 68, 'Staff member', 'txt', 0, 1),
(884, 68, 'Checked daily, dated and signed', 'yn', 1, 2),
(885, 68, 'Defibrillator batteries working, checked daily and print out initialed and attached to record book', 'yn', 1, 3),
(886, 68, 'Oxygen cylinder and suction working', 'yn', 1, 4),
(887, 68, 'Sharps bin and clinical waste containers available, empty and visibly clean', 'yn', 1, 5),
(888, 68, 'Protective apparel available', 'yn', 1, 6),
(889, 68, 'Work instruction for use of defibrillator attached to side of trolley', 'yn', 1, 7),
(890, 68, 'Emergency drug available and expiry date correct', 'yn', 1, 8),
(891, 68, 'Emergency call bells checked monthly', 'yn', 1, 9),
(892, 68, 'Emergency equipment intact and expiry date correct', 'yn', 1, 10),
(893, 68, 'Cannula equipment available and expiry date correct', 'yn', 1, 11),
(894, 68, 'Endotracheal tube available', 'yn', 1, 12),
(895, 68, 'Laryngeal mask available in various sizes', 'yn', 1, 13),
(896, 68, 'Staff trained on Energency equipment location, correct usage and storage', 'yn', 1, 14),
(897, 68, 'IV fluids and given set available and expiry date correct', 'yn', 1, 15),
(898, 68, 'All required stock available on trolley', 'yn', 1, 16),
(899, 68, 'Work instructions for management of asthma, chest pain and basic life support available', 'yn', 1, 17),
(900, 69, 'Staff member', 'txt', 0, 1),
(901, 69, 'Hazardous chemical register up to date', 'yn', 1, 2),
(902, 69, 'Material Safety Data Sheet (MSDS) available for all chemicals used in the facility', 'yn', 1, 3),
(903, 69, 'Staff aware of the location of MSDS', 'yn', 1, 4),
(904, 69, 'Staff provided with suitable PPE', 'yn', 1, 5),
(905, 69, 'Staff use appropriate PPE', 'yn', 1, 6),
(906, 69, 'All hazardous substances stored in a safe place', 'yn', 1, 7),
(907, 69, 'All hazardous substances labeled correctly', 'yn', 1, 8),
(908, 69, 'All hazadous substances sealed correctly', 'yn', 1, 9),
(909, 69, 'Staff aware the action required if in contact with a hazardous checmical', 'yn', 1, 10),
(910, 69, 'Staff document correctly if any deviations eg QIR', 'yn', 1, 11),
(911, 69, 'The MSDS is assessed', 'yn', 1, 12),
(912, 69, 'Appropriate spill kit available', 'yn', 1, 13),
(913, 69, 'Gas cylinders stored and secured in a safe room', 'yn', 1, 14),
(914, 69, 'CO2 fire extinguisher readily available throughout the facility', 'yn', 1, 15),
(915, 70, 'Staff member', 'txt', 1, 1),
(916, 70, 'Fire and safety orientation checklist is complete', 'yn', 1, 2),
(917, 70, 'Health and Safety orientation checklist is complete', 'yn', 1, 3),
(918, 70, 'Orientation checklist is signed and complete by NUM', 'yn', 1, 4),
(919, 70, 'Orientation checklist is signed and complete by Area manager', 'yna', 1, 5),
(920, 70, 'Hand hygiene test online complete and ceetificate photocopied', 'yna', 1, 6),
(921, 70, 'Nursing registration is viewed and uploaded to EVODMS', 'yna', 1, 7),
(922, 70, 'Immunisation record complete', 'yna', 1, 8),
(923, 70, 'Quality system orientation with QM and signed', 'yn', 1, 9),
(924, 70, 'Staff member given computer access and password after 3 months', 'yna', 1, 10),
(925, 71, 'Staff member', 'txt', 0, 1),
(926, 71, 'Documented evidence of patient being asked about skin integrity and pressure injuries prior to admission', 'yna', 1, 2),
(927, 71, 'Patient completed the pressure ulcer question on their pre-op assessment', 'yna', 1, 3),
(928, 71, 'Skin integrity assessed and documented during admission', 'yna', 1, 4),
(929, 71, 'Surgical Safety Checklist includes pressure ulcers assessment', 'yna', 1, 5),
(930, 71, 'Surgical Safety Checklist been signed by both the admission and anaesthetic nurse', 'yna', 1, 6),
(931, 71, 'Mobility and skin intgrity assessment completed', 'yna', 1, 7),
(932, 71, 'Patient mobility score been documented during admission', 'yna', 1, 8),
(933, 71, 'Correct mobility score given to the patient', 'yna', 1, 9),
(934, 71, 'Patient lying on the theatre bed for less than 1 hour', 'yna', 1, 10),
(935, 71, 'Patient seated in recovery chair for less than 1 hour', 'yna', 1, 11),
(936, 72, 'Observation recorded included all core physiological observations', 'yn', 1, 1),
(937, 72, 'Any missing observation', 'yn', 1, 2),
(938, 72, 'If Yes, what was it (Temp/ HR /BP /RR /O2 sats /LOC)', 'txt', 1, 3),
(939, 72, 'Were the observation recorded correctly', 'yn', 1, 4),
(940, 72, 'Observation were measured to the minimum frequency as per procedure', 'yn', 1, 5),
(941, 72, 'Did the patoient meet any criteria for the escalation of care', 'yn', 1, 6),
(942, 72, 'Patient ID', 'txt', 0, 7),
(943, 72, 'If yes, was care escalated as per the escalation protocol', 'yn', 1, 8),
(944, 73, 'Patient Name', 'yna', 1, 1),
(945, 73, 'Date of Birth', 'yna', 1, 2),
(946, 73, 'Gender', 'yna', 1, 3),
(947, 73, 'Address', 'yna', 1, 4),
(948, 73, 'Contact Phone Number', 'yna', 1, 5),
(949, 73, 'Marital status', 'yna', 1, 6),
(950, 73, 'Medicare number', 'yna', 1, 7),
(951, 73, 'Details of main contact person', 'yna', 1, 8),
(952, 73, 'Next of kin', 'yna', 1, 9),
(953, 73, 'Cultural requirements', 'yna', 1, 10),
(954, 73, 'Indigenous status', 'yna', 1, 11),
(955, 73, 'Signed consent to treatment', 'yna', 1, 12),
(956, 73, 'Signed financial consent', 'yna', 1, 13),
(957, 73, 'Advanced care directive', 'yna', 1, 14),
(958, 73, 'Each page has patient identification label', 'yna', 1, 15),
(959, 73, 'Does the label have 3 patient identifiers', 'yna', 1, 16),
(960, 73, 'Does any time entry use the 24hour clock', 'yna', 1, 17),
(961, 73, 'Entries in black pen only', 'yna', 1, 18),
(962, 73, 'Any errors crossed out and initialled', 'yna', 1, 19),
(963, 73, 'Whiteout used', 'yna', 1, 20),
(964, 73, 'Is there evience of discharge information eg contact person for pickup', 'yna', 1, 21),
(965, 73, 'Documented pressure injury/fall risk assessment', 'yna', 1, 22),
(966, 73, 'Documented observation eg: BP, pulse, oxygen saturations', 'yna', 1, 23),
(967, 73, 'Documented mobility assessment', 'yna', 1, 24),
(968, 73, 'Alert status documented eg: Diabetic, allergy', 'yna', 1, 25),
(969, 73, 'Documented use of interpreter', 'yna', 1, 26),
(970, 73, 'Dietary needs documented', 'yna', 1, 27),
(971, 73, 'Fasting and dressing instructions documented', 'yna', 1, 28),
(972, 73, 'Rights and responsibilities explained', 'yna', 1, 29),
(973, 73, 'Transport and responsibility person addressed', 'yna', 1, 30),
(974, 73, 'Medication history documented', 'yna', 1, 31),
(975, 73, 'Medication, allergy, alert status documented', 'yna', 1, 32),
(976, 73, 'Medication error documented and signed by clinical staff', 'yna', 1, 33),
(977, 73, 'Does it include route, dose and frequency', 'yna', 1, 34),
(978, 73, 'Do we allow nurse initiated medications', 'yna', 1, 35),
(979, 73, 'Do we allow telephone medication orders', 'yna', 1, 36);
INSERT INTO `qa_checklist_q` (`id`, `ceid`, `question`, `type`, `reqd`, `order`) VALUES
(980, 73, 'medication order counteredsigned by the prescriber within 24 hours', 'yna', 1, 37),
(981, 73, 'Is there a surgical safety checklist', 'yna', 1, 38),
(982, 73, 'Has it been complited and signed at every patient episode', 'yna', 1, 39),
(983, 73, 'Is there documentred evidence of the surgeon, anaesthetist and registered nurse signatures', 'yna', 1, 40),
(984, 73, 'Documented evidence of the operation performed', 'yna', 1, 41),
(985, 73, 'Date and signed by surgeon', 'yna', 1, 42),
(986, 73, 'Time out attended', 'yna', 1, 43),
(987, 73, 'Instrument count or no count recorded', 'yna', 1, 44),
(988, 73, 'Sterile tracking system included', 'yna', 1, 45),
(989, 73, 'ASA completed and documented', 'yna', 1, 46),
(990, 73, 'Date and signed by anaesthetist', 'yna', 1, 47),
(991, 73, 'Evidence of a pre-operative anaesthetic consultation', 'yna', 1, 48),
(992, 73, 'Anaesthetic type given eg sedation/general/local', 'yn', 1, 49),
(993, 73, 'Post-operative instructions given documented', 'yna', 1, 50),
(994, 73, 'Any post-operative medication given documented on post-operative instruction', 'yna', 1, 51),
(995, 73, 'Carer signature', 'yna', 1, 52),
(996, 73, 'Patient MRN', 'txt', 1, 53),
(997, 74, 'Patient Name', 'yna', 1, 1),
(998, 74, 'Date of Birth', 'yna', 1, 2),
(999, 74, 'Gender', 'yna', 1, 3),
(1000, 74, 'Address', 'yna', 1, 4),
(1001, 74, 'Contact Phone Number', 'yna', 1, 5),
(1002, 74, 'Marital status', 'yna', 1, 6),
(1003, 74, 'Medicare number', 'yna', 1, 7),
(1004, 74, 'Details of main contact person', 'yna', 1, 8),
(1005, 74, 'Next of kin', 'yna', 1, 9),
(1006, 74, 'Cultural requirements', 'yna', 1, 10),
(1007, 74, 'Indigenous status', 'yna', 1, 11),
(1008, 74, 'Signed consent to treatment', 'yna', 1, 12),
(1009, 74, 'Signed financial consent', 'yna', 1, 13),
(1010, 74, 'Advanced care directive', 'yna', 1, 14),
(1011, 74, 'Each page has patient identification label', 'yna', 1, 15),
(1012, 74, 'Does the label have 3 patient identifiers', 'yna', 1, 16),
(1013, 74, 'Does any time entry use the 24hour clock', 'yna', 1, 17),
(1014, 74, 'Entries in black pen only', 'yna', 1, 18),
(1015, 74, 'Any errors crossed out and initialled', 'yna', 1, 19),
(1016, 74, 'Whiteout used', 'yna', 1, 20),
(1017, 74, 'Is there evience of discharge information eg contact person for pickup', 'yna', 1, 21),
(1018, 74, 'Documented pressure injury/fall risk assessment', 'yna', 1, 22),
(1019, 74, 'Documented observation eg: BP, pulse, oxygen saturations', 'yna', 1, 23),
(1020, 74, 'Documented mobility assessment', 'yna', 1, 24),
(1021, 74, 'Alert status documented eg: Diabetic, allergy', 'yna', 1, 25),
(1022, 74, 'Documented use of interpreter', 'yna', 1, 26),
(1023, 74, 'Dietary needs documented', 'yna', 1, 27),
(1024, 74, 'Fasting and dressing instructions documented', 'yna', 1, 28),
(1025, 74, 'Rights and responsibilities explained', 'yna', 1, 29),
(1026, 74, 'Transport and responsibility person addressed', 'yna', 1, 30),
(1027, 74, 'Medication history documented', 'yna', 1, 31),
(1028, 74, 'Medication, allergy, alert status documented', 'yna', 1, 32),
(1029, 74, 'Medication error documented and signed by clinical staff', 'yna', 1, 33),
(1030, 74, 'Does it include route, dose and frequency', 'yna', 1, 34),
(1031, 74, 'Do we allow nurse initiated medications', 'yna', 1, 35),
(1032, 74, 'Do we allow telephone medication orders', 'yna', 1, 36),
(1033, 74, 'medication order counteredsigned by the prescriber within 24 hours', 'yna', 1, 37),
(1034, 74, 'Is there a surgical safety checklist', 'yna', 1, 38),
(1035, 74, 'Has it been complited and signed at every patient episode', 'yna', 1, 39),
(1036, 74, 'Is there documentred evidence of the surgeon, anaesthetist and registered nurse signatures', 'yna', 1, 40),
(1037, 74, 'Documented evidence of the operation performed', 'yna', 1, 41),
(1038, 74, 'Date and signed by surgeon', 'yna', 1, 42),
(1039, 74, 'Time out attended', 'yna', 1, 43),
(1040, 74, 'Instrument count or no count recorded', 'yna', 1, 44),
(1041, 74, 'Sterile tracking system included', 'yna', 1, 45),
(1042, 74, 'ASA completed and documented', 'yna', 1, 46),
(1043, 74, 'Date and signed by anaesthetist', 'yna', 1, 47),
(1044, 74, 'Evidence of a pre-operative anaesthetic consultation', 'yna', 1, 48),
(1045, 74, 'Anaesthetic type given eg sedation/general/local', 'yn', 1, 49),
(1046, 74, 'Post-operative instructions given documented', 'yna', 1, 50),
(1047, 74, 'Any post-operative medication given documented on post-operative instruction', 'yna', 1, 51),
(1048, 74, 'Carer signature', 'yna', 1, 52),
(1049, 74, 'Patient MRN', 'txt', 1, 53),
(1050, 74, 'ADMISSION', 'sec', 1, 54),
(1051, 75, 'Work area', 'txt', 1, 1),
(1052, 75, 'Moment 1 - Before touching a patient', 'yn', 1, 2),
(1053, 75, 'Moment 2 - Before a procedure', 'yn', 1, 3),
(1054, 75, 'Staff Type : Nursing, Doctor, Anaesthetist and CSSD', 'txt', 1, 4),
(1055, 75, 'Moment 3 - After a procedure or body fluid exposure risk', 'yn', 1, 5),
(1056, 75, 'Moment 4 - After touching a patient', 'yn', 1, 6),
(1057, 75, 'Moment 5 - After touching a potient&#39;s surroundings', 'yn', 1, 7),
(1058, 75, 'What action - Alcohol Rub, Hand Wash or Missed', 'txt', 1, 8),
(1059, 75, 'Glove off?', 'yn', 1, 9),
(1060, 75, 'Total moments bserved', 'txt', 1, 10),
(1061, 75, 'Total correct moments', 'txt', 1, 11),
(1062, 76, 'Work area', 'txt', 1, 1),
(1063, 76, 'Staff Type: Nursing, Doctor, Anaesthetist', 'txt', 1, 2),
(1064, 76, 'Moment 1 - Before touching a patient', 'yn', 1, 3),
(1065, 76, 'Moment 2 - Before a procedure', 'yn', 1, 4),
(1066, 76, 'Moment 3 - After a procedure or body fluid exposure risk', 'yn', 1, 5),
(1067, 76, 'Moment 4 - After touching a patient', 'yn', 1, 6),
(1068, 76, 'Moment 5 - After touching a potient&#39;s surroundings', 'yn', 1, 7),
(1069, 76, 'What action - Alcohol Rub, Hand Wash or Missed', 'txt', 1, 8),
(1070, 76, 'Glove off?', 'yn', 1, 9),
(1071, 76, 'Total moments bserved', 'txt', 1, 10),
(1072, 76, 'Total correct moments', 'txt', 1, 11),
(1073, 77, 'are you ok?', 'yn', 1, 1),
(1074, 78, 'Staff member', 'txt', 0, 1),
(1075, 78, 'Are the patients current medication documented in the file?', 'yna', 1, 2),
(1076, 78, 'Is the allergy status specified?', 'yna', 1, 3),
(1077, 78, 'If allergy present, is reaction specified?', 'yna', 1, 4),
(1078, 78, 'If allergy present, is allergy noted in the patient file?', 'yna', 1, 5),
(1079, 78, 'Is allergy status in computer system?', 'yna', 1, 6),
(1080, 78, 'Is medication information provided to patients?', 'yna', 1, 7),
(1081, 78, 'Is medication order signed by treating doctor?', 'yna', 1, 8),
(1082, 78, 'Are the five rights adhered by nurse?', 'yna', 1, 9),
(1083, 78, 'Are two nurses present for administration when necessary?', 'yna', 1, 10),
(1084, 78, 'Is medical record signed by both nurses?', 'yna', 1, 11),
(1085, 78, 'Is drug book completed accurately?', 'yna', 1, 12),
(1086, 78, 'Is a copy of MIMS available to staff?', 'yna', 1, 13),
(1087, 78, 'Is medication stored in locked cupboard if necessary?', 'yna', 1, 14),
(1088, 79, 'are you ok?', 'yn', 1, 1),
(1089, 80, 'Desktop', 'sec', 0, 1),
(1090, 80, 'Are most frequently used items e.g. phone,manuals easy to reach', 'yna', 1, 2),
(1091, 80, 'Document holder are available for prolonged computer data entry', 'yna', 1, 3),
(1092, 80, 'Arms do not have to rest on any sharp or square or square edges', 'yna', 1, 4),
(1093, 80, 'A headset is worn by staff who spend a large % time on the phone', 'yna', 1, 5),
(1094, 80, 'Phone is placed on the side on the non-dominant hand', 'yna', 1, 6),
(1095, 80, 'Work surface is high enough underneath so that it does not contact the top of the users legs', 'yna', 1, 7),
(1096, 80, 'Work surface is large enough to hold all computer devices and other required items', 'yna', 1, 8),
(1097, 80, 'Work surface has a matt finish to minimize glare or reflection', 'yna', 1, 9),
(1098, 80, 'Keyboard', 'sec', 0, 10),
(1099, 80, 'Keyboard is positioned (i.e angled) so that stroking is performed with wrist, hands and fingers', 'yna', 1, 11),
(1100, 80, 'Mouse is at the same height as keyboard', 'yna', 1, 12),
(1101, 80, 'Mouse is positioned on a stable surface', 'yna', 1, 13),
(1102, 80, 'Lighting', 'sec', 0, 14),
(1103, 80, 'Is there adequate lighting on the desk area', 'yna', 1, 15),
(1104, 80, 'Is the monitor arranged to minimize the effect of glare from lights', 'yna', 1, 16),
(1105, 80, 'Source of light is out of the users line of sight', 'yna', 1, 17),
(1106, 80, 'Monitor/Screens', 'sec', 0, 18),
(1107, 80, 'The top of the screen is at or just below eye level', 'yna', 1, 19),
(1108, 80, 'Has adjustments for brightness', 'yna', 1, 20),
(1109, 80, 'Can be adjusted vertically & horizontally for optimum viewing angle', 'yna', 1, 21),
(1110, 80, 'Are the screen and document holder the same distance from the eye ', 'yna', 1, 22),
(1111, 80, 'Are the screen and document holder close together to avoid excessive neck movement', 'yna', 1, 23),
(1112, 80, 'The screen is arms length from the eyes ie 45-75cm', 'yna', 1, 24),
(1113, 80, 'The monitor screen is clean', 'yna', 1, 25),
(1114, 80, 'There screen is free of visible flickering', 'yna', 1, 26),
(1115, 80, 'Are monitors directed away from windows', 'yna', 1, 27),
(1116, 80, 'Seating', 'sec', 0, 28),
(1117, 80, 'Are the seat and back of the chair adjustable', 'yna', 1, 29),
(1118, 80, 'Seat can be easily adjusted by user without the use of tools', 'yna', 1, 30),
(1119, 80, 'Does the seat height allow the user to place soles of feet comfortably on the floor', 'yna', 1, 31),
(1120, 80, 'If soles of feet cannot rest on floor is a footrest avaliable', 'yna', 1, 32),
(1121, 80, 'Is area under desk uncluttered to allow the user to stretch their legs', 'yna', 1, 33),
(1122, 80, 'Does the seat allow the user to sit upright with thighs parallel to floor and lower leg perpendicular to floor', 'yna', 1, 34),
(1123, 80, 'Does the seat allow user to sit upright with torso approximately perpendicular to the floor', 'yna', 1, 35),
(1124, 80, 'Seat back width is at least 30cm', 'yna', 1, 36),
(1125, 80, 'Seat back provides ample support for the lower back', 'yna', 1, 37),
(1126, 80, 'If present, arm rest allows user to relax arms/shoulder close to body, ', 'yna', 1, 38),
(1127, 80, 'If present, arm rest allows user to operate a keyboard with forearms parallel to floor', 'yna', 1, 39),
(1128, 80, 'If present, arm rest allows user to move as close as desired to keyboard', 'yna', 1, 40),
(1129, 80, 'If present, arm rest allows user to reach primary work materials', 'yna', 1, 41),
(1130, 80, 'Seating is adjusted so that the forearms on desk are perpendicular to upper arms', 'yna', 1, 42),
(1131, 80, 'Work Habits', 'sec', 0, 43),
(1132, 80, 'Is the employee aware of rest and pause exercise', 'yna', 1, 44),
(1133, 81, 'Staff member', 'txt', 0, 1),
(1134, 81, 'Is the temperature control checked everyday for each fridge?', 'yn', 1, 2),
(1135, 81, 'If temperature is outside the range, does a QIR get filled in', 'yn', 1, 3),
(1136, 81, 'Are the fridges free of ice', 'yn', 1, 4),
(1137, 81, 'Is the refrigerated drug contents checked monthly for supplies and expiry', 'yn', 1, 5),
(1138, 81, 'Is the checklist signed every day', 'yn', 1, 6),
(1139, 82, 'Criteria', 'sec', 0, 1),
(1140, 83, 'Criteria', 'sec', 0, 1),
(1141, 83, 'Page labelled correctly', 'yn', 1, 2),
(1142, 83, 'Index for this page up to date', 'yn', 1, 3),
(1143, 83, 'Balance carried forward correctly', 'yn', 1, 4),
(1144, 83, 'Total number of entries (incl. checks)', 'txt', 1, 5),
(1145, 83, 'No. of entries with appropriate coloured pen', 'txt', 1, 6),
(1146, 83, 'No. of entries with date and time recorded', 'txt', 1, 7),
(1147, 83, 'No. of entries countersigned', 'txt', 1, 8),
(1148, 83, 'No. of daily checks required on section checked', 'txt', 1, 9),
(1149, 83, 'No. of daily checks carried out and countersigned', 'txt', 1, 10),
(1150, 83, 'Total number of dispensing entries (excl. checks)', 'txt', 1, 11),
(1151, 83, 'No. of dispensing entries with prescriber', 'txt', 1, 12),
(1152, 83, 'No. of entries with dose given/discarded recorded correctly', 'txt', 1, 13),
(1153, 83, 'Total errors/mistake on page', 'txt', 1, 14),
(1154, 83, 'Total error/mistakes recorded/corrected properly', 'txt', 1, 15),
(1155, 84, 'Criteria', 'sec', 0, 1),
(1156, 84, 'Is the admitting diagnosis included', 'yn', 1, 2),
(1157, 84, 'Does each page contain the patient&#39;s full identification detail', 'yn', 1, 3),
(1158, 84, 'Is the name and contact number recorded of the patient&#39;s ', 'yn', 1, 4),
(1159, 84, 'Procedure consent, procedure to be done recorded', 'yn', 1, 5),
(1160, 84, 'Procedure consent, signed by doctor', 'yn', 1, 6),
(1161, 84, 'Procedure consent, signed by patient', 'yn', 1, 7),
(1162, 84, 'Has the patient signed the financial consent', 'yn', 1, 8),
(1163, 84, 'Is the privacy consent signed', 'yn', 1, 9),
(1164, 84, 'Has the person to notify in an emergency been recorded', 'yn', 1, 10),
(1165, 84, 'Is the anaesthetic pre assessment recorded, as applicable', 'yn', 1, 11),
(1166, 84, 'Is &#34;Time Out&#34; per facility policy been recorded', 'yn', 1, 12),
(1167, 84, 'Is the operation report signed by the surgeon', 'yn', 1, 13),
(1168, 84, 'Is the report legible ( handwritten or typed)', 'yn', 1, 14),
(1169, 84, 'Is there a description of the findings', 'yn', 1, 15),
(1170, 84, 'Has the procedure perform been noted', 'yn', 1, 16),
(1171, 84, 'Does the operation report include the diagnosis', 'yn', 1, 17),
(1172, 84, 'Does the operation report include the post op instructions', 'yn', 1, 18),
(1173, 84, 'Is the surgical count recorded by the RN', 'yn', 1, 19),
(1174, 84, 'Is the surgical count signed by the RN', 'yn', 1, 20),
(1175, 84, 'Are the post op recovery details recorded ', 'yn', 1, 21),
(1176, 84, 'Are all clinical record entries dated', 'yn', 1, 22),
(1177, 84, 'Are all clinical record entries signed', 'yn', 1, 23),
(1178, 84, 'Are allergies recorded or &#34;not known&#34; noted', 'yn', 1, 24),
(1179, 84, 'Are discharge instruction completed', 'yn', 1, 25),
(1180, 84, 'Is the post discharge telephone call section completed', 'yn', 1, 26),
(1181, 84, 'Each sheet has a form title', 'yn', 1, 27),
(1182, 84, 'Each sheet has form number ', 'yn', 1, 28),
(1183, 84, 'Appropriate prescribing of antibiotics', 'yna', 1, 29),
(1184, 85, '4.2.4 Control Of Records and 7.5.1 Control of Production and Service Provision ', 'sec', 0, 1),
(1185, 85, 'Medications are all ordered by a medical practitioner ', 'yn', 1, 2),
(1186, 85, 'Medication orders are legible with dose and frequency recorded', 'yn', 1, 3),
(1187, 85, 'Appropriately qualified staff administer medication', 'yn', 1, 4),
(1188, 85, 'Administration is documented with signature, date and time', 'yn', 1, 5),
(1189, 85, 'Standing orders are clear and updated half yearly ', 'yn', 1, 6),
(1190, 85, 'Emergency telephone orders are authorised by the ordering practitioner within 24hrs', 'yna', 1, 7),
(1191, 85, '7.5.1 Preservation of Product (Schedule 8 Drugs)', 'sec', 0, 8),
(1192, 85, 'S8 drug keys are held by nurse in charge', 'yn', 1, 9),
(1193, 85, 'S8 drug keys are locked up when nurse off duty', 'yn', 1, 10),
(1194, 85, 'S8 drug register documentation meets regulatory requirements', 'yn', 1, 11),
(1195, 85, 'Balance checks are conducted whenever nurses are on duty', 'yn', 1, 12),
(1196, 85, '6 monthly inventory checks are conducted by DON/Medical Director', 'yn', 1, 13),
(1197, 85, 'Drug license is maintained by DON', 'yn', 1, 14),
(1198, 85, 'Process is in place to manage any loss/damage of drugs', 'yn', 1, 15),
(1199, 85, 'Process is in place for the disposal of unused and expired medication', 'yn', 1, 16),
(1200, 85, 'Process is in place for destruction of S8 drugs in line with regulatory requirements', 'yn', 1, 17),
(1201, 85, 'Drug Storage', 'sec', 0, 18),
(1202, 85, 'Drugs are stored at correct temperatures eg. shelf/refrigerated ', 'yn', 1, 19),
(1203, 85, 'Appropriate stock rotation in place to ensure medication is within use by dates', 'yn', 1, 20),
(1204, 85, 'Stock levels are maintained to meet requirements ', 'yn', 1, 21),
(1205, 85, 'All medication is stored in original packaging ', 'yn', 1, 22),
(1206, 85, 'Medication cupboards are locked when not in use', 'yn', 1, 23),
(1207, 85, 'Core Standards For Safety & Quality in Healthcare ( Adverse Reactions)', 'sec', 0, 24),
(1208, 85, 'Process is in place for reporting of ACSOM', 'yn', 1, 25),
(1209, 86, 'Preoperative assessment to determine suitability for treatment and exclusion criteria', 'yn', 1, 1),
(1210, 86, 'Clerical pre-admission Computer entry of patient details', 'yn', 1, 2),
(1211, 86, 'Clerical pre-admission, Patient added to theatre list', 'yn', 1, 3),
(1212, 86, 'Clerical pre-admission, Health fund check', 'yn', 1, 4),
(1213, 86, 'Clerical pre-admission, 3 days prior confirm theatre list with Drs rooms', 'yn', 1, 5),
(1214, 86, 'Clerical pre-admission, 1-2 days before prioritise theatre list', 'yn', 1, 6),
(1215, 86, 'Clerical pre-admission, 1-2 days prior call patients re. fasting and fees', 'yn', 1, 7),
(1216, 86, 'Clerical admission, Confirm patient details', 'yn', 1, 8),
(1217, 86, 'Clerical admission, Obtain carer contact details', 'yn', 1, 9),
(1218, 86, 'Clerical admission, Health fund claim form', 'yn', 1, 10),
(1219, 86, 'Clerical admission, Rights & Responsibilities', 'yn', 1, 11),
(1220, 86, 'Nursing admission, Check ID details with patient against ID labels', 'yn', 1, 12),
(1221, 86, 'Nursing admission, Confirm allergy, pacemakers and IDDM status ', 'yn', 1, 13),
(1222, 86, 'Nursing admission, ID label to band (red/white)', 'yn', 1, 14),
(1223, 86, 'Nursing admission, Nursing pre-op checklist (MR5)', 'yn', 1, 15),
(1224, 86, 'Nursing admission, Complete red alert forms', 'yn', 1, 16),
(1225, 86, 'Nursing admission, Consent', 'yn', 1, 17),
(1226, 86, 'Nursing admission, Mark operative eye', 'yn', 1, 18),
(1227, 86, 'Nursing admission, Pre-op eye drops', 'yn', 1, 19),
(1228, 86, 'Nursing admission, Patient given gown, hat, shoe covers', 'yn', 1, 20),
(1229, 86, 'Nursing admission, Clinical handover', 'yn', 1, 21),
(1230, 86, 'Staff trained in appropriate treatment for medical emergencies', 'yn', 1, 22),
(1231, 86, 'Post-Op Care, Recovery stay minimum 30 minutes', 'yn', 1, 23),
(1232, 86, 'Post-Op Care, 2 sets observations', 'yn', 1, 24),
(1233, 86, 'Post-Op Care, BSL taken for diabetics', 'yn', 1, 25),
(1234, 86, 'Post-Op Care, Refreshments', 'yn', 1, 26),
(1235, 86, 'Post-Op Care, Remove cannula when tolerated refreshments', 'yn', 1, 27),
(1236, 86, 'Post-Op Care, Complete Discharge Checklist & Record', 'yn', 1, 28),
(1237, 86, 'Post-Op Care, Discharge criteria', 'yn', 1, 29),
(1238, 86, 'Discharge instructions', 'yn', 1, 30),
(1239, 86, 'Follow up after discharge', 'yn', 1, 31),
(1240, 86, 'Patient feedback and satisfaction monitored', 'yn', 1, 32),
(1241, 86, 'Patient complaints handled appropriately', 'yn', 1, 33),
(1242, 86, 'Clinical pathway in record used to ensure consistency of care', 'yn', 1, 34),
(1243, 86, 'Clinical indicator collection and analysis', 'yn', 1, 35),
(1244, 86, 'Informed consent process', 'yn', 1, 36),
(1245, 86, 'Falls prevention', 'yn', 1, 37),
(1246, 86, 'Correct site surgery process', 'yn', 1, 38),
(1247, 86, 'Australian Charter of Healthcare Rights', 'yn', 1, 39),
(1248, 87, 'Staff member', 'txt', 0, 1),
(1249, 87, 'Is the temperature control checked when there is an patient  list for each fridge?', 'yn', 1, 2),
(1250, 87, 'If temperature is outside the range, does a QIR get filled in', 'yn', 1, 3),
(1251, 87, 'Are the fridges free of ice', 'yn', 1, 4),
(1252, 87, 'Is the refrigerated drug contents checked monthly for supplies and expiry', 'yn', 1, 5),
(1253, 87, 'Is the checklist signed at completion', 'yn', 1, 6),
(1254, 88, 'SECTION 1: WASTE MANAGEMENT', 'sec', 0, 1),
(1255, 88, 'Body fluid - Incontience pads/nappies are not included in clinicl waste unless there is visible blood', 'yna', 1, 2),
(1256, 88, 'Yellow bags/containers are availabe for clinical waste', 'yna', 1, 3),
(1257, 88, 'Black/white bags are available for general waste', 'yna', 1, 4),
(1258, 88, 'Purple bags/containers are available for cytotoxic waste', 'yna', 1, 5),
(1259, 88, 'Sharps containers comply with AS4031(non reusable) or AS/NZS 4261(reusable)', 'yna', 1, 6),
(1260, 88, 'SECTION 2: DRUG STORAGE', 'sec', 0, 7),
(1261, 88, 'Drug refrigerators have temp recorded daily (sighted evidence for full compliance)', 'yna', 1, 8),
(1262, 88, 'Refrigerators have temperaature maintained between 2 and 8 degree C', 'yna', 1, 9),
(1263, 88, 'There is no food kept in drug refrigerators', 'yna', 1, 10),
(1264, 88, 'SECTION 3: ENVIRONMENTAL CLEANING', 'sec', 0, 11),
(1265, 88, 'Floor surface is non-slip', 'yna', 1, 12),
(1266, 88, 'Floor surface is easy to clean and in good repair', 'yna', 1, 13),
(1267, 88, 'Floor surface in treatment area is non-carpeted', 'yna', 1, 14),
(1268, 88, 'Wet mopping in clinical areas', 'yna', 1, 15),
(1269, 88, 'Carpets vacummed in clinical areas', 'yna', 1, 16),
(1270, 88, 'Vacumm cleaner fitted with a particulate retaining filter', 'yna', 1, 17),
(1271, 88, 'Vacumm claner filters are changed in accordnace with the manufacturer&#39;s instructions', 'yna', 1, 18),
(1272, 88, 'Vacuum exhaust is directed away from door', 'yna', 1, 19),
(1273, 88, 'Dust retaining mops are not used in high risk area', 'yna', 1, 20),
(1274, 88, 'Ordinary brooms are NOT used in patient/clinical areas', 'yna', 1, 21),
(1275, 88, 'Buckets emptied after use, washed with detergent and warm water/stored dry', 'yna', 1, 22),
(1276, 88, 'Mops laundered as per AS4146 (thermally or chemically disinfected/stored dry)', 'yna', 1, 23),
(1277, 88, 'Walls/blinds/curtains are cleaned regularly', 'yna', 1, 24),
(1278, 88, 'Walls/blinds/curtains are cleaned when visibly soiled', 'yna', 1, 25),
(1279, 88, 'Toilets/sinks/bath/shower cubicles cleaned when required', 'yna', 1, 26),
(1280, 88, 'Patient care areas cleaned and dried at least daily', 'yna', 1, 27),
(1281, 88, 'Patient care areas cleaned and dried when visibly soiled', 'yna', 1, 28),
(1282, 88, 'Patient trolley between patients cleaned regularly', 'yna', 1, 29),
(1283, 88, 'Procedure trolley is cleaned after use', 'yna', 1, 30),
(1284, 88, 'HEPA filter have been calibrated yearly', 'yna', 1, 31),
(1285, 88, 'Air conditioner maintenance has been attended monthly', 'yna', 1, 32),
(1286, 88, 'SECTION 4: BLOOD/BODY FLUID SPILLS', 'sec', 0, 33),
(1287, 88, 'Contaminant is soaked up/removed before area is cleaned', 'yna', 1, 34),
(1288, 88, 'Spill area is cleaned and dried as soon as practicable', 'yna', 1, 35),
(1289, 88, 'Generation of aerosols is minimised through work practices', 'yna', 1, 36),
(1290, 88, 'In wet areas, eg showers carefully ashed off into sewerage system and area flushed with detergent and water', 'yna', 1, 37),
(1291, 88, 'Safety goggles are available', 'yna', 1, 38),
(1292, 88, 'Gloves are available', 'yna', 1, 39),
(1293, 88, 'Impervious gowns are available', 'yna', 1, 40),
(1294, 88, 'Sodium hypochlorite, when used, is in accordance with manufacturer&#39;s instruction and HS safety instructions', 'yna', 1, 41),
(1295, 88, 'Mop/bucket thoroughly cleaned after use and stored dry. ', 'yna', 1, 42),
(1296, 88, 'SECTION 6: HAND HYGIENE', 'sec', 0, 43),
(1297, 88, 'Neutral soap handwashing solution is available at all hand basins', 'yna', 1, 44),
(1298, 88, 'Recommended antimicrobial Handwashing solutions are available at all clinical hand basins', 'yna', 1, 45),
(1299, 88, 'There is recommended/compatible hand moisturiser available', 'yna', 1, 46),
(1300, 88, 'There is no evidence of bar soap or nail brushes on hand basins for staff use', 'yna', 1, 47),
(1301, 88, 'Hand basins are easily accessible and free of obstacles', 'yna', 1, 48),
(1302, 88, 'There is paper towel or a working towel disenser at all hand basins', 'yna', 1, 49),
(1303, 88, 'Where paper towel is in use there s a waste bin available', 'yna', 1, 50),
(1304, 88, 'Towels are single use only', 'yna', 1, 51),
(1305, 88, 'Alcohol handrubs are available within all patients&#39; environments across the facility', 'yna', 1, 52),
(1306, 88, 'Staff do not wear rings when performing invasive procedures', 'yna', 1, 53),
(1307, 88, 'SECTION 7: LINEN', 'sec', 0, 54),
(1308, 88, 'Linen skips are clear and in good condition', 'yna', 1, 55),
(1309, 88, 'Soiled linen bags are changed with 3/4 filled', 'yna', 1, 56),
(1310, 88, 'Soiled linen bags are stored in a dedicated area until collected', 'yna', 1, 57),
(1311, 88, 'Linen that is heavily soiled/wet is contained in suitable impermeable bags', 'yna', 1, 58),
(1312, 88, 'Soiled linen is placed in linen bags at point of generation. eg bedside', 'yna', 1, 59),
(1313, 88, 'Clean linen is stored to protect it from environmental contaminants such as dust, moisture', 'yna', 1, 60),
(1314, 88, 'Clean linen is stored to protect it from excessive handling or traffic', 'yna', 1, 61),
(1315, 88, 'Clean linen is not left in patient&#39;s environment', 'yna', 1, 62),
(1316, 88, 'Clean and soiled linen is physically separated', 'yna', 1, 63),
(1317, 88, 'SECTION 8: PERSONAL PROTECTIVE EQUIPMENT', 'sec', 0, 64),
(1318, 88, 'Gloves are available in a range of sizes', 'yna', 1, 65),
(1319, 88, 'Latex free alternative gloves are available', 'yna', 1, 66),
(1320, 88, 'Storage system protect gloves from contaminants', 'yna', 1, 67),
(1321, 88, 'General/Household gloves are issued as person specific', 'yna', 1, 68),
(1322, 88, 'General/Household gloves are washed and stored dry after use', 'yna', 1, 69),
(1323, 88, 'General/Household gloves storage systems protects from contaminants', 'yna', 1, 70),
(1324, 88, 'Protective eyewear is available and readily accesible to staff when splash is a risk', 'yna', 1, 71),
(1325, 88, 'Protective eyewear is clean and in good condition', 'yna', 1, 72),
(1326, 88, 'Surgical masks are available to staff', 'yna', 1, 73),
(1327, 88, 'Masks are dispensed from the original container at point of use', 'yna', 1, 74),
(1328, 88, 'Impermable gowns/aprons available to staff undertaking procedures likely to splash/contaminate their clothing', 'yna', 1, 75),
(1329, 88, 'Long hair is tied back and beards coverd during aseptic proceures', 'yna', 1, 76),
(1330, 88, 'SECTION 9: REPROCESSING OF RE-USABLE INSTRUMENTS AND EQUIPMENT', 'sec', 0, 77),
(1331, 88, 'There is a dedicated cleaning area used for cleaning reusable items', 'yna', 1, 78),
(1332, 88, 'Work flow direction in the area is from dirty to clean', 'yna', 1, 79),
(1333, 88, 'There is dedicated staff hand basin, or hand rub is available at the entry/exit of the dirty utility room', 'yna', 1, 80),
(1334, 88, 'PPE is available: disposable gloves, aprons, face proitection, eyewear and mask or face shield', 'yna', 1, 81),
(1335, 88, 'Soiled or used items are transferred into sterilising department in punctiure and leak resistant containers with lids', 'yna', 1, 82),
(1336, 89, 'SECTION 1: WASTE MANAGEMENT', 'sec', 0, 1),
(1337, 89, 'Body fluid - Incontience pads/nappies are not included in clinicl waste unless there is visible blood', 'yna', 1, 2),
(1338, 89, 'Yellow bags/containers are availabe for clinical waste', 'yna', 1, 3),
(1339, 89, 'Black/white bags are available for general waste', 'yna', 1, 4),
(1340, 89, 'Purple bags/containers are available for cytotoxic waste', 'yna', 1, 5),
(1341, 89, 'Sharps containers comply with AS4031(non reusable) or AS/NZS 4261(reusable)', 'yna', 1, 6),
(1342, 89, 'SECTION 2: DRUG STORAGE', 'sec', 0, 7),
(1343, 89, 'Drug refrigerators have temp recorded daily (sighted evidence for full compliance)', 'yna', 1, 8),
(1344, 89, 'Refrigerators have temperaature maintained between 2 and 8 degree C', 'yna', 1, 9),
(1345, 89, 'There is no food kept in drug refrigerators', 'yna', 1, 10),
(1346, 89, 'SECTION 3: ENVIRONMENTAL CLEANING', 'sec', 0, 11),
(1347, 89, 'Floor surface is non-slip', 'yna', 1, 12),
(1348, 89, 'Floor surface is easy to clean and in good repair', 'yna', 1, 13),
(1349, 89, 'Floor surface in treatment area is non-carpeted', 'yna', 1, 14),
(1350, 89, 'Wet mopping in clinical areas', 'yna', 1, 15),
(1351, 89, 'Carpets vacummed in clinical areas', 'yna', 1, 16),
(1352, 89, 'Vacumm cleaner fitted with a particulate retaining filter', 'yna', 1, 17),
(1353, 89, 'Vacumm claner filters are changed in accordnace with the manufacturer&#39;s instructions', 'yna', 1, 18),
(1354, 89, 'Vacuum exhaust is directed away from door', 'yna', 1, 19),
(1355, 89, 'Dust retaining mops are not used in high risk area', 'yna', 1, 20),
(1356, 89, 'Ordinary brooms are NOT used in patient/clinical areas', 'yna', 1, 21),
(1357, 89, 'Buckets emptied after use, washed with detergent and warm water/stored dry', 'yna', 1, 22),
(1358, 89, 'Mops laundered as per AS4146 (thermally or chemically disinfected/stored dry)', 'yna', 1, 23),
(1359, 89, 'Walls/blinds/curtains are cleaned regularly', 'yna', 1, 24),
(1360, 89, 'Walls/blinds/curtains are cleaned when visibly soiled', 'yna', 1, 25),
(1361, 89, 'Toilets/sinks/bath/shower cubicles cleaned when required', 'yna', 1, 26),
(1362, 89, 'Patient care areas cleaned and dried at least daily', 'yna', 1, 27),
(1363, 89, 'Patient care areas cleaned and dried when visibly soiled', 'yna', 1, 28),
(1364, 89, 'Patient trolley between patients cleaned regularly', 'yna', 1, 29),
(1365, 89, 'Procedure trolley is cleaned after use', 'yna', 1, 30),
(1366, 89, 'HEPA filter have been calibrated yearly', 'yna', 1, 31),
(1367, 89, 'Air conditioner maintenance has been attended monthly', 'yna', 1, 32),
(1368, 89, 'SECTION 4: BLOOD/BODY FLUID SPILLS', 'sec', 0, 33),
(1369, 89, 'Contaminant is soaked up/removed before area is cleaned', 'yna', 1, 34),
(1370, 89, 'Spill area is cleaned and dried as soon as practicable', 'yna', 1, 35),
(1371, 89, 'Generation of aerosols is minimised through work practices', 'yna', 1, 36),
(1372, 89, 'In wet areas, eg showers carefully ashed off into sewerage system and area flushed with detergent and water', 'yna', 1, 37),
(1373, 89, 'Safety goggles are available', 'yna', 1, 38),
(1374, 89, 'Gloves are available', 'yna', 1, 39),
(1375, 89, 'Impervious gowns are available', 'yna', 1, 40),
(1376, 89, 'Sodium hypochlorite, when used, is in accordance with manufacturer&#39;s instruction and HS safety instructions', 'yna', 1, 41),
(1377, 89, 'Mop/bucket thoroughly cleaned after use and stored dry. ', 'yna', 1, 42),
(1378, 89, 'SECTION 6: HAND HYGIENE', 'sec', 0, 43),
(1379, 89, 'Neutral soap handwashing solution is available at all hand basins', 'yna', 1, 44),
(1380, 89, 'Recommended antimicrobial Handwashing solutions are available at all clinical hand basins', 'yna', 1, 45),
(1381, 89, 'There is recommended/compatible hand moisturiser available', 'yna', 1, 46),
(1382, 89, 'There is no evidence of bar soap or nail brushes on hand basins for staff use', 'yna', 1, 47),
(1383, 89, 'Hand basins are easily accessible and free of obstacles', 'yna', 1, 48),
(1384, 89, 'There is paper towel or a working towel disenser at all hand basins', 'yna', 1, 49),
(1385, 89, 'Where paper towel is in use there s a waste bin available', 'yna', 1, 50),
(1386, 89, 'Towels are single use only', 'yna', 1, 51),
(1387, 89, 'Alcohol handrubs are available within all patients&#39; environments across the facility', 'yna', 1, 52),
(1388, 89, 'Staff do not wear rings when performing invasive procedures', 'yna', 1, 53),
(1389, 89, 'SECTION 7: LINEN', 'sec', 0, 54),
(1390, 89, 'Linen skips are clear and in good condition', 'yna', 1, 55),
(1391, 89, 'Soiled linen bags are changed with 3/4 filled', 'yna', 1, 56),
(1392, 89, 'Soiled linen bags are stored in a dedicated area until collected', 'yna', 1, 57),
(1393, 89, 'Linen that is heavily soiled/wet is contained in suitable impermeable bags', 'yna', 1, 58),
(1394, 89, 'Soiled linen is placed in linen bags at point of generation. eg bedside', 'yna', 1, 59),
(1395, 89, 'Clean linen is stored to protect it from environmental contaminants such as dust, moisture', 'yna', 1, 60),
(1396, 89, 'Clean linen is stored to protect it from excessive handling or traffic', 'yna', 1, 61),
(1397, 89, 'Clean linen is not left in patient&#39;s environment', 'yna', 1, 62),
(1398, 89, 'Clean and soiled linen is physically separated', 'yna', 1, 63),
(1399, 89, 'SECTION 8: PERSONAL PROTECTIVE EQUIPMENT', 'sec', 0, 64),
(1400, 89, 'Gloves are available in a range of sizes', 'yna', 1, 65),
(1401, 89, 'Latex free alternative gloves are available', 'yna', 1, 66),
(1402, 89, 'Storage system protect gloves from contaminants', 'yna', 1, 67),
(1403, 89, 'General/Household gloves are issued as person specific', 'yna', 1, 68),
(1404, 89, 'General/Household gloves are washed and stored dry after use', 'yna', 1, 69),
(1405, 89, 'General/Household gloves storage systems protects from contaminants', 'yna', 1, 70),
(1406, 89, 'Protective eyewear is available and readily accesible to staff when splash is a risk', 'yna', 1, 71),
(1407, 89, 'Protective eyewear is clean and in good condition', 'yna', 1, 72),
(1408, 89, 'Surgical masks are available to staff', 'yna', 1, 73),
(1409, 89, 'Masks are dispensed from the original container at point of use', 'yna', 1, 74),
(1410, 89, 'Impermable gowns/aprons available to staff undertaking procedures likely to splash/contaminate their clothing', 'yna', 1, 75),
(1411, 89, 'Long hair is tied back and beards coverd during aseptic proceures', 'yna', 1, 76),
(1412, 89, 'SECTION 9: REPROCESSING OF RE-USABLE INSTRUMENTS AND EQUIPMENT', 'sec', 0, 77),
(1413, 89, 'There is a dedicated cleaning area used for cleaning reusable items', 'yna', 1, 78),
(1414, 89, 'Work flow direction in the area is from dirty to clean', 'yna', 1, 79),
(1415, 89, 'There is dedicated staff hand basin, or hand rub is available at the entry/exit of the dirty utility room', 'yna', 1, 80),
(1416, 89, 'PPE is available: disposable gloves, aprons, face proitection, eyewear and mask or face shield', 'yna', 1, 81),
(1417, 89, 'Soiled or used items are transferred into sterilising department in punctiure and leak resistant containers with lids', 'yna', 1, 82),
(1418, 90, 'SECTION 1: WASTE MANAGEMENT', 'sec', 0, 1),
(1419, 90, 'Body fluid - Incontience pads/nappies are not included in clinicl waste unless there is visible blood', 'yna', 1, 2),
(1420, 90, 'Yellow bags/containers are availabe for clinical waste', 'yna', 1, 3),
(1421, 90, 'Black/white bags are available for general waste', 'yna', 1, 4),
(1422, 90, 'Purple bags/containers are available for cytotoxic waste', 'yna', 1, 5),
(1423, 90, 'Sharps containers comply with AS4031(non reusable) or AS/NZS 4261(reusable)', 'yna', 1, 6),
(1424, 90, 'SECTION 2: DRUG STORAGE', 'sec', 0, 7),
(1425, 90, 'Drug refrigerators have temp recorded daily (sighted evidence for full compliance)', 'yna', 1, 8),
(1426, 90, 'Refrigerators have temperaature maintained between 2 and 8 degree C', 'yna', 1, 9),
(1427, 90, 'There is no food kept in drug refrigerators', 'yna', 1, 10),
(1428, 90, 'SECTION 3: ENVIRONMENTAL CLEANING', 'sec', 0, 11),
(1429, 90, 'Floor surface is non-slip', 'yna', 1, 12),
(1430, 90, 'Floor surface is easy to clean and in good repair', 'yna', 1, 13),
(1431, 90, 'Floor surface in treatment area is non-carpeted', 'yna', 1, 14),
(1432, 90, 'Wet mopping in clinical areas', 'yna', 1, 15),
(1433, 90, 'Carpets vacummed in clinical areas', 'yna', 1, 16),
(1434, 90, 'Vacumm cleaner fitted with a particulate retaining filter', 'yna', 1, 17),
(1435, 90, 'Vacumm claner filters are changed in accordnace with the manufacturer&#39;s instructions', 'yna', 1, 18),
(1436, 90, 'Vacuum exhaust is directed away from door', 'yna', 1, 19),
(1437, 90, 'Dust retaining mops are not used in high risk area', 'yna', 1, 20),
(1438, 90, 'Ordinary brooms are NOT used in patient/clinical areas', 'yna', 1, 21),
(1439, 90, 'Buckets emptied after use, washed with detergent and warm water/stored dry', 'yna', 1, 22),
(1440, 90, 'Mops laundered as per AS4146 (thermally or chemically disinfected/stored dry)', 'yna', 1, 23),
(1441, 90, 'Walls/blinds/curtains are cleaned regularly', 'yna', 1, 24),
(1442, 90, 'Walls/blinds/curtains are cleaned when visibly soiled', 'yna', 1, 25),
(1443, 90, 'Toilets/sinks/bath/shower cubicles cleaned when required', 'yna', 1, 26),
(1444, 90, 'Patient care areas cleaned and dried at least daily', 'yna', 1, 27),
(1445, 90, 'Patient care areas cleaned and dried when visibly soiled', 'yna', 1, 28),
(1446, 90, 'Patient trolley between patients cleaned regularly', 'yna', 1, 29),
(1447, 90, 'Procedure trolley is cleaned after use', 'yna', 1, 30),
(1448, 90, 'HEPA filter have been calibrated yearly', 'yna', 1, 31),
(1449, 90, 'Air conditioner maintenance has been attended every 4 months', 'yna', 1, 32),
(1450, 90, 'SECTION 4: BLOOD/BODY FLUID SPILLS', 'sec', 0, 33),
(1451, 90, 'Contaminant is soaked up/removed before area is cleaned', 'yna', 1, 34),
(1452, 90, 'Spill area is cleaned and dried as soon as practicable', 'yna', 1, 35),
(1453, 90, 'Generation of aerosols is minimised through work practices', 'yna', 1, 36),
(1454, 90, 'In wet areas, eg showers carefully ashed off into sewerage system and area flushed with detergent and water', 'yna', 1, 37),
(1455, 90, 'Safety goggles are available', 'yna', 1, 38),
(1456, 90, 'Gloves are available', 'yna', 1, 39),
(1457, 90, 'Impervious gowns are available', 'yna', 1, 40),
(1458, 90, 'Sodium hypochlorite, when used, is in accordance with manufacturer&#39;s instruction and HS safety instructions', 'yna', 1, 41),
(1459, 90, 'Mop/bucket thoroughly cleaned after use and stored dry. ', 'yna', 1, 42),
(1460, 90, 'SECTION 6: HAND HYGIENE', 'sec', 0, 43),
(1461, 90, 'Neutral soap handwashing solution is available at all hand basins', 'yna', 1, 44),
(1462, 90, 'Recommended antimicrobial Handwashing solutions are available at all clinical hand basins', 'yna', 1, 45),
(1463, 90, 'There is recommended/compatible hand moisturiser available', 'yna', 1, 46),
(1464, 90, 'There is no evidence of bar soap or nail brushes on hand basins for staff use', 'yna', 1, 47),
(1465, 90, 'Hand basins are easily accessible and free of obstacles', 'yna', 1, 48),
(1466, 90, 'There is paper towel or a working towel disenser at all hand basins', 'yna', 1, 49),
(1467, 90, 'Where paper towel is in use there s a waste bin available', 'yna', 1, 50),
(1468, 90, 'Towels are single use only', 'yna', 1, 51),
(1469, 90, 'Alcohol handrubs are available within all patients&#39; environments across the facility', 'yna', 1, 52),
(1470, 90, 'Staff do not wear rings when performing invasive procedures', 'yna', 1, 53),
(1471, 90, 'SECTION 7: LINEN', 'sec', 0, 54),
(1472, 90, 'Linen skips are clear and in good condition', 'yna', 1, 55),
(1473, 90, 'Soiled linen bags are changed with 3/4 filled', 'yna', 1, 56),
(1474, 90, 'Soiled linen bags are stored in a dedicated area until collected', 'yna', 1, 57),
(1475, 90, 'Linen that is heavily soiled/wet is contained in suitable impermeable bags', 'yna', 1, 58),
(1476, 90, 'Soiled linen is placed in linen bags at point of generation. eg bedside', 'yna', 1, 59),
(1477, 90, 'Clean linen is stored to protect it from environmental contaminants such as dust, moisture', 'yna', 1, 60),
(1478, 90, 'Clean linen is stored to protect it from excessive handling or traffic', 'yna', 1, 61),
(1479, 90, 'Clean linen is not left in patient&#39;s environment', 'yna', 1, 62),
(1480, 90, 'Clean and soiled linen is physically separated', 'yna', 1, 63),
(1481, 90, 'SECTION 8: PERSONAL PROTECTIVE EQUIPMENT', 'sec', 0, 64),
(1482, 90, 'Gloves are available in a range of sizes', 'yna', 1, 65),
(1483, 90, 'Latex free alternative gloves are available', 'yna', 1, 66),
(1484, 90, 'Storage system protect gloves from contaminants', 'yna', 1, 67),
(1485, 90, 'General/Household gloves are issued as person specific', 'yna', 1, 68),
(1486, 90, 'General/Household gloves are washed and stored dry after use', 'yna', 1, 69),
(1487, 90, 'General/Household gloves storage systems protects from contaminants', 'yna', 1, 70),
(1488, 90, 'Protective eyewear is available and readily accesible to staff when splash is a risk', 'yna', 1, 71),
(1489, 90, 'Protective eyewear is clean and in good condition', 'yna', 1, 72),
(1490, 90, 'Surgical masks are available to staff', 'yna', 1, 73),
(1491, 90, 'Masks are dispensed from the original container at point of use', 'yna', 1, 74),
(1492, 90, 'Impermable gowns/aprons available to staff undertaking procedures likely to splash/contaminate their clothing', 'yna', 1, 75),
(1493, 90, 'Long hair is tied back and beards coverd during aseptic proceures', 'yna', 1, 76),
(1494, 90, 'SECTION 9: REPROCESSING OF RE-USABLE INSTRUMENTS AND EQUIPMENT', 'sec', 0, 77),
(1495, 90, 'There is a dedicated cleaning area used for cleaning reusable items', 'yna', 1, 78),
(1496, 90, 'Work flow direction in the area is from dirty to clean', 'yna', 1, 79),
(1497, 90, 'There is dedicated staff hand basin, or hand rub is available at the entry/exit of the dirty utility room', 'yna', 1, 80),
(1498, 90, 'PPE is available: disposable gloves, aprons, face proitection, eyewear and mask or face shield', 'yna', 1, 81),
(1499, 90, 'Soiled or used items are transferred into sterilising department in punctiure and leak resistant containers with lids', 'yna', 1, 82),
(1500, 91, 'If applicable are current registration details on file?', 'yn', 0, 1),
(1501, 91, 'Is there a signed position description in place?', 'yn', 0, 2),
(1502, 91, 'Has a letter of employment/contract been completed?', 'yn', 0, 3),
(1503, 91, 'Has an appraisal been conducted 3 months after employment?', 'yn', 0, 4),
(1504, 91, 'Has an appraisal been completed in the last 12 months?', 'yn', 0, 5),
(1505, 91, 'Has the employee signed the confidentiality form?', 'yn', 0, 6),
(1506, 91, 'Is the completed/signed orientation checklist in place?', 'yn', 0, 7),
(1507, 91, 'Has the employee attended orientation or compulsory education in the last 12 mths?', 'yn', 0, 8),
(1508, 91, 'Is there a staff vaccination history record on file?', 'yn', 0, 9),
(1509, 91, 'Has a Working With Children Check been conducted for clinical staff?', 'yn', 0, 10),
(1510, 91, 'Have clinical staff completed required annual competency assessments?', 'yn', 0, 11),
(1511, 92, 'Staff member', 'txt', 0, 1),
(1512, 92, 'Are the patients current medication documented in the file?', 'yna', 1, 2),
(1513, 92, 'Is the allergy status specified?', 'yna', 1, 3),
(1514, 92, 'If allergy present, is reaction specified?', 'yna', 1, 4),
(1515, 92, 'If allergy present, is allergy noted in the patient file?', 'yna', 1, 5),
(1525, 93, 'Staff member', 'txt', 0, 1),
(1517, 92, 'Is medication information provided to patients?', 'yna', 1, 7),
(1518, 92, 'Is medication order signed by treating doctor?', 'yna', 1, 8),
(1519, 92, 'Are the five rights adhered by nurse?', 'yna', 1, 9),
(1520, 92, 'Are two nurses present for administration when necessary?', 'yna', 1, 10),
(1521, 92, 'Is medical record signed by both nurses?', 'yna', 1, 11),
(1522, 92, 'Is drug book completed accurately?', 'yna', 1, 12),
(1523, 92, 'Is a copy of MIMS available to staff?', 'yna', 1, 13),
(1524, 92, 'Is medication stored in locked cupboard if necessary?', 'yna', 1, 14),
(1526, 93, 'The nurse follow the cleaning schedule as specified', 'yn', 1, 2),
(1527, 93, 'The cleaners follow the cleaning schedule as specified', 'yn', 1, 3),
(1528, 93, 'Theatre attire is worn inside theatre while cleaning', 'yn', 1, 4),
(1529, 93, 'Infection control standards are followed', 'yn', 1, 5),
(1530, 93, 'The cleaner/nurses schedule adheres to the environmental cleaning policy PD2012_06', 'yn', 1, 6),
(1531, 93, 'The appropriate resources are avilable to complete the schedule', 'yn', 1, 7),
(1532, 93, 'The schedule is initialed with completion of each section', 'yn', 1, 8),
(1533, 93, 'Is the Day Surgery well maintained and clean?', 'yn', 1, 9),
(1534, 93, 'Concerns are documented in the communication notes. NUM fills in QIR if required', 'yn', 1, 10),
(1535, 93, 'The cleaners are trained in cleaninhg health facilities', 'yn', 1, 11),
(1536, 93, 'Job description available to the contract cleaners', 'yna', 1, 12),
(1537, 94, 'Patient Name', 'txt', 0, 1),
(1538, 94, 'Date of Audit', 'txt', 1, 2),
(1539, 94, 'Patient MRN', 'txt', 1, 3),
(1540, 94, 'Clinical handover given by the admission nurse to the anaesthetic nurse', 'yn', 1, 4),
(1541, 94, 'Handover given at patient bed side in the anaesthetic bay', 'yn', 1, 5),
(1542, 94, 'All clinical information given as per work instruction', 'yn', 1, 6),
(1543, 94, 'Surgical Safety Checklist signed by both nurses', 'yn', 1, 7),
(1544, 94, 'Patient transferred to theatre', 'yn', 1, 8),
(1545, 94, 'Clinical handover given by anesthetic nurse/anaesthetist to surgical team', 'yn', 1, 9),
(1546, 94, 'Time out attended as per work instruction', 'yn', 1, 10),
(1547, 94, 'Surgical Safety Checklist signed by both anaesthetic nurse and scrub/scout nurse', 'yn', 1, 11),
(1548, 94, 'Patient transferred to Recovery Bay', 'yn', 1, 12),
(1549, 94, 'Clinical handover given by scrub/scout nurse to recovery nurse', 'yn', 1, 13),
(1550, 94, 'All clinical information given as per work instruction', 'yn', 1, 14),
(1551, 94, 'Surgical Safety Checklist signed by both nurses', 'yn', 1, 15),
(1552, 94, 'Patient transferred to discharge room with escort present', 'yn', 1, 16),
(1553, 94, 'Discharge summary given to patient escort', 'yn', 1, 17),
(1554, 94, 'Post-operative instruction given to patient and escort', 'yn', 1, 18),
(1555, 94, 'Medication instruction/information given to patient and escort', 'yn', 1, 19),
(1556, 94, 'emergency phone numbers provided to patient and escort', 'yn', 1, 20),
(1557, 94, 'Discussed falls prevention with patient and escort', 'yn', 1, 21),
(1558, 94, 'Discussed pressure area management with patient and escort', 'yn', 1, 22),
(1562, 95, 'Has a discharge summary been filled in', 'yn', 1, 1),
(1560, 94, 'The nurse and escort sign the Surgical Safety Checklist', 'yn', 1, 24),
(1561, 94, 'Any deviation to the process is directed to the NUM and QIR is completed', 'yn', 1, 25),
(1563, 95, 'Has the discharge summary been scanned into the Dox medical record', 'yn', 1, 2),
(1564, 95, 'Principle diagnosis and proceure written clearly', 'yn', 1, 3),
(1565, 95, 'Patient ID', 'txt', 0, 4),
(1566, 95, 'Surgeon/Anaesthetist/Assist filled', 'yn', 1, 5),
(1567, 95, 'Any specific instruction specified', 'yn', 1, 6),
(1568, 95, 'Post operative instructions given', 'yn', 1, 7),
(1569, 95, 'Prescription given', 'yn', 1, 8),
(1570, 95, 'Post-operative appointment made', 'yn', 1, 9),
(1571, 95, 'Assessment for falls made', 'yn', 1, 10),
(1572, 95, 'Escort present', 'yn', 1, 11),
(1573, 95, 'Surgical Safety Checklist signed by nurse and escort', 'yn', 1, 12),
(1574, 95, 'Was a QIR filled in if applicable', 'yn', 1, 13),
(1575, 96, 'Staff member', 'txt', 0, 1),
(1576, 96, 'Quantity of S8 and S4 drugs supplied are entered with date and time by 2 RNs with red pen', 'yn', 1, 2),
(1577, 96, 'Name of patient to whom the drug was administered was entered with date and time in black pen', 'yn', 1, 3),
(1578, 96, 'name of anaesthetist who prescribed and administered the drug was entered with date and time in black pen', 'yn', 1, 4),
(1579, 96, 'The amout of drug administered amd the amount discarded was entered and signed by the anaesthetist and the anaesthetic nurse with date and time in black pen', 'yn', 1, 5),
(1580, 96, 'Balance of drug is correct', 'yn', 1, 6),
(1581, 96, 'Any mistake made in the entry was corrected by making a marginal note or footnote by initialling and dating it', 'yn', 1, 7),
(1582, 96, 'Inventory of drugs were checked by the end of each surgiucal day by 2 RNs, signed, date and time with red pen', 'yn', 1, 8),
(1583, 96, 'Handwriting is legible', 'yn', 1, 9),
(1584, 96, 'Audit of Ward Drug Register was entered with green pen by NUM', 'yn', 1, 10),
(1587, 97, 'Date (DD/MM/YYYY)', 'txt', 1, 1),
(1588, 97, 'Emergency Call button', 'sec', 0, 2),
(1586, 96, '5 patient files were randomly selected to check if the amount administered corresponded to the amount recorded in the Ward Drug Register', '0', 1, 12),
(1589, 97, 'Operatiing Room 1 is functioning correctly', 'yn', 1, 3),
(1590, 97, 'Operatiing Room 2 is functioning correctly', 'yn', 1, 4),
(1591, 97, 'Corridor is functioning correctly', 'yn', 1, 5),
(1592, 97, 'Nurse Call Button', 'sec', 0, 6),
(1593, 97, 'Anaesthetic Bay 1 is functioning correctly', 'yn', 1, 7),
(1594, 97, 'Anaesthetic Bay 2 is functioning correctly', 'yn', 1, 8),
(1624, 99, 'Work Area', 'txt', 1, 1),
(1610, 98, 'Oxygen cylinder and suction working', 'yn', 1, 4),
(1597, 97, 'Recovery Bay 1 is functioning correctly', 'yn', 1, 11),
(1598, 97, 'Recovery Bay 2 is functioning correctly', 'yn', 1, 12),
(1599, 97, 'Recovery Bay 3 is functioning correctly', 'yn', 1, 13),
(1600, 97, 'Recovery Bay 4 is functioning correctly', 'yn', 1, 14),
(1609, 98, 'Defibrillator batteries working, checked when there is a list ', 'yn', 1, 3),
(1608, 98, 'Checked when there is a list, dated and signed', 'yn', 1, 2),
(1603, 97, 'DIsabled toilet is functioning correctly', 'yn', 1, 17),
(1607, 98, 'Staff member', 'txt', 0, 1),
(1605, 97, 'Patient change room 1 is functioning correctly', 'yn', 1, 19),
(1606, 97, 'Patient change room 2 is functioning correctly', 'yn', 1, 20),
(1611, 98, 'Sharps bin and clinical waste containers available, empty and visibly clean', 'yn', 1, 5),
(1612, 98, 'Protective apparel available', 'yn', 1, 6),
(1613, 98, 'Work instruction for use of defibrillator attached to side of trolley', 'yn', 1, 7),
(1614, 98, 'Emergency drug available and expiry date correct', 'yn', 1, 8),
(1615, 98, 'Emergency call bells checked monthly', 'yn', 1, 9),
(1616, 98, 'Emergency equipment intact and expiry date correct', 'yn', 1, 10),
(1617, 98, 'Cannula equipment available and expiry date correct', 'yn', 1, 11),
(1618, 98, 'Endotracheal tube available', 'yn', 1, 12),
(1619, 98, 'Laryngeal mask available in various sizes', 'yn', 1, 13),
(1620, 98, 'Staff trained on Energency equipment location, correct usage and storage', 'yn', 1, 14),
(1621, 98, 'IV fluids and giving set available and expiry date correct', 'yn', 1, 15),
(1622, 98, 'All required stock available on trolley', 'yn', 1, 16),
(1623, 98, 'Work instructions for management of asthma, chest pain and basic life support available', 'yn', 1, 17),
(1625, 99, 'Staff Type: Nursing, Doctor, Anaesthetist', 'txt', 1, 2),
(1626, 99, 'Moment 1 - Before touching a patient', 'yn', 1, 3),
(1627, 99, 'Moment 2 - Before a procedure', 'yn', 1, 4),
(1628, 99, 'Moment 3 - After a procedure or body fluid exposure risk', 'yn', 1, 5),
(1629, 99, 'Moment 4 - After touching a patient', 'yn', 1, 6),
(1630, 99, 'Moment 5 - After touching a patient&#39;s surroundings', 'yn', 1, 7),
(1631, 99, 'What action - Alcohol Rub, Hand Wash or Missed', 'txt', 1, 8),
(1632, 99, 'Glove off?', 'yn', 1, 9),
(1633, 99, 'Total moments observed', 'txt', 1, 10),
(1634, 99, 'Total correct moments', 'txt', 1, 11),
(1635, 100, 'Area', 'txt', 0, 1),
(1636, 100, 'Bar soap or nail brushes NOT evident on hand basins for staff use', 'yn', 1, 2);
INSERT INTO `qa_checklist_q` (`id`, `ceid`, `question`, `type`, `reqd`, `order`) VALUES
(1637, 100, 'Staff fingernails are clean and short', 'yn', 1, 3),
(1638, 100, 'Artificial nails are not observed', 'yn', 1, 4),
(1639, 100, 'Routine hand wash procedure-observed', 'sec', 0, 5),
(1640, 100, 'Hands are wet first, then hand wash product is applied', 'yn', 1, 6),
(1641, 100, 'Hands are rubbed together vigorously for at least 15 seconds', 'yn', 1, 7),
(1642, 100, 'Hands are rinsed free of soap under running water', 'yn', 1, 8),
(1643, 100, 'Hands are dried thoroughly using paper towel or single use towel including under ring area', 'yn', 1, 9),
(1644, 100, 'Alcohol hand rub procedure - Observe', 'sec', 0, 10),
(1645, 100, 'Alcohol hand rubs are strategically placed in all patient care area', 'yn', 1, 11),
(1646, 100, 'Solution is in contact with all surfaces of the hands', 'yn', 1, 12),
(1647, 100, 'Hands are rubbed together vigorously until solutions has evaporated', 'yn', 1, 13),
(1648, 100, 'Hands that are visibly soiled are washed with soap and water', 'yn', 1, 14),
(1649, 100, 'Hand Hygiene procedure', 'sec', 0, 15),
(1650, 100, 'Staff performed hand hygiene immediately before direct patient contact', 'yn', 1, 16),
(1651, 100, 'Staff performed hand hygiene after direct patient contact', 'yn', 1, 17),
(1652, 100, 'Staff performed hand hygiene before a procedure', 'yn', 1, 18),
(1653, 100, 'Staff performed hand hygiene after removal of gloves', 'yn', 1, 19),
(1654, 100, 'Staff performed hand hygiene immediately after a procedure', 'yn', 1, 20),
(1655, 100, 'Staff performed hand hygiene after touching patients belongings or equipment around them', 'yn', 1, 21),
(1656, 100, 'Staff are observed washing hands with soap and water if contaminated with blood or bodily fluids', 'yn', 1, 22),
(1657, 100, 'All hand washing facilities are equipped with soap, running water and had drying facilities', 'yn', 1, 23),
(1658, 100, 'Hand moisturising cream is available for staff use', 'yn', 1, 24),
(1659, 100, 'Staff are observed using hand moisturising cream', 'yn', 1, 25),
(1660, 100, 'Hand washing technique is reinforced at the staff induction program', 'yn', 1, 26),
(1661, 100, 'A poster depicting good hand washing technique is present at all clinical hand basin', 'yn', 1, 27),
(1662, 100, 'Hand hygiene on-line education completed with certificate', 'yn', 1, 28),
(1663, 101, 'Patient Name', 'yna', 1, 1),
(1664, 101, 'Date of Birth', 'yna', 1, 2),
(1665, 101, 'Gender', 'yna', 1, 3),
(1666, 101, 'Address', 'yna', 1, 4),
(1667, 101, 'Contact Phone Number', 'yna', 1, 5),
(1668, 101, 'Marital status', 'yna', 1, 6),
(1669, 101, 'Medicare number', 'yna', 1, 7),
(1670, 101, 'Details of main contact person', 'yna', 1, 8),
(1671, 101, 'Next of kin', 'yna', 1, 9),
(1672, 101, 'Cultural requirements', 'yna', 1, 10),
(1673, 101, 'Indigenous status', 'yna', 1, 11),
(1674, 101, 'Signed consent to treatment', 'yna', 1, 12),
(1675, 101, 'Signed financial consent', 'yna', 1, 13),
(1676, 101, 'Advanced care directive', 'yna', 1, 14),
(1677, 101, 'Each page has patient identification label', 'yna', 1, 15),
(1678, 101, 'Does the label have 3 patient identifiers', 'yna', 1, 16),
(1679, 101, 'Does any time entry use the 24 hour clock', 'yna', 1, 17),
(1680, 101, 'Entries in black pen only', 'yna', 1, 18),
(1681, 101, 'Any errors crossed out and initialled', 'yna', 1, 19),
(1682, 101, 'Whiteout used', 'yna', 1, 20),
(1683, 101, 'Is there evience of discharge information eg contact person for pickup', 'yna', 1, 21),
(1684, 101, 'Documented pressure injury/fall risk assessment', 'yna', 1, 22),
(1685, 101, 'Documented observation eg: BP, pulse, oxygen saturations', 'yna', 1, 23),
(1686, 101, 'Documented mobility assessment', 'yna', 1, 24),
(1687, 101, 'Alert status documented eg: Diabetic, allergy', 'yna', 1, 25),
(1688, 101, 'Documented use of interpreter', 'yna', 1, 26),
(1689, 101, 'Dietary needs documented', 'yna', 1, 27),
(1690, 101, 'Fasting and dressing instructions documented', 'yna', 1, 28),
(1691, 101, 'Rights and responsibilities explained', 'yna', 1, 29),
(1692, 101, 'Transport and responsibility person addressed', 'yna', 1, 30),
(1693, 101, 'Medication history documented', 'yna', 1, 31),
(1694, 101, 'Medication, allergy, alert status documented', 'yna', 1, 32),
(1695, 101, 'Medication error documented and signed by clinical staff', 'yna', 1, 33),
(1696, 101, 'Does it include route, dose and frequency', 'yna', 1, 34),
(1697, 101, 'Do we allow nurse initiated medications', 'yna', 1, 35),
(1698, 101, 'Do we allow telephone medication orders', 'yna', 1, 36),
(1699, 101, 'Medication order counteredsigned by the prescriber within 24 hours', 'yna', 1, 37),
(1700, 101, 'Is there a surgical safety checklist', 'yna', 1, 38),
(1701, 101, 'Has it been completed and signed at every patient episode', 'yna', 1, 39),
(1702, 101, 'Is there documentred evidence of the surgeon, anaesthetist and registered nurse signatures', 'yna', 1, 40),
(1703, 101, 'Documented evidence of the operation performed', 'yna', 1, 41),
(1704, 101, 'Date and signed by surgeon', 'yna', 1, 42),
(1705, 101, 'Time out attended', 'yna', 1, 43),
(1706, 101, 'Instrument count or no count recorded', 'yna', 1, 44),
(1707, 101, 'Sterile tracking system included', 'yna', 1, 45),
(1708, 101, 'ASA completed and documented', 'yna', 1, 46),
(1709, 101, 'Date and signed by anaesthetist', 'yna', 1, 47),
(1710, 101, 'Evidence of a pre-operative anaesthetic consultation', 'yna', 1, 48),
(1711, 101, 'Anaesthetic type given eg sedation/general/local', 'yn', 1, 49),
(1712, 101, 'Post-operative instructions given documented', 'yna', 1, 50),
(1713, 101, 'Any post-operative medication given documented on post-operative instruction', 'yna', 1, 51),
(1714, 101, 'Carer signature', 'yna', 1, 52),
(1715, 101, 'Patient MRN', 'txt', 1, 53),
(1717, 102, 'Staff member', 'txt', 0, 1),
(1718, 102, 'Compentencies are completed as a skill is learnt', 'yn', 1, 2),
(1719, 102, 'Competencies are completed on a yearly basis by all staff', 'yn', 1, 3),
(1720, 102, 'Compentencies are made to be specific and meanful to each area', 'yn', 1, 4),
(1721, 102, 'Staff complete question sheet revelant to each area eg recovery', 'yn', 1, 5),
(1722, 102, 'Infection control questionnarie complete', 'yn', 1, 6),
(1723, 102, 'Feedback provided to staff on questionnaries completed', 'yn', 1, 7),
(1724, 102, 'Further training is provided if compentency is not achieved', 'yn', 1, 8),
(1725, 103, 'Control of Documents', 'sec', 0, 1),
(1726, 103, 'Has a documented procedure been established to define controls for', 'txt', 0, 2),
(1727, 103, 'Approval of documents for adequacy prior to use', 'yna', 1, 3),
(1728, 103, 'Review, update as necessary and reapproval of documents', 'yna', 1, 4),
(1729, 103, 'Identification of revision status', 'yna', 1, 5),
(1730, 103, 'Protection of master version', 'yna', 1, 6),
(1731, 103, 'Ensuring relevant versions of applicable documents are available at point of use', 'yna', 1, 7),
(1732, 103, 'Maintaining document legibility and identification', 'yna', 1, 8),
(1733, 103, 'Identification and control of externally supplied documents', 'yna', 1, 9),
(1734, 103, 'Preventing unintended use of obsolete documents', 'yna', 1, 10),
(1735, 103, 'Maintenance of obsolete documents for legal/knowledge preservation purposes', 'yna', 1, 11),
(1736, 103, 'Are documents required for the quality management system controlled?  Audit a selection of documents (patient forms, quality forms, HR forms)', 'yna', 1, 12),
(1737, 103, 'Review staff knowledge of document control procedure', 'yna', 1, 13),
(1738, 103, 'Control of Records', 'sec', 0, 14),
(1739, 103, 'Has a documented procedure been established to define the following controls needed?', 'txt', 0, 15),
(1740, 103, 'Identification', 'yn', 1, 16),
(1741, 103, 'Storage', 'yn', 1, 17),
(1742, 103, 'Retrieval', 'yn', 1, 18),
(1743, 103, 'Protection', 'yn', 1, 19),
(1744, 103, 'Retention time', 'yn', 1, 20),
(1745, 103, 'Disposition', 'yn', 1, 21),
(1746, 103, 'Are records established and maintained to provide evidence of conformity to requirements? e.g. medical, HR, quality, financial', 'yn', 1, 22),
(1747, 103, 'Do records provide evidence of the effective operation of the QMS?', 'yn', 1, 23),
(1748, 103, 'Do records remain legible, readily identifiable and retrievable?', 'yn', 1, 24),
(1749, 104, 'Purchasing Control', 'sec', 0, 1),
(1750, 104, 'Are purchasing processes controlled to ensure purchased product/services conform to requirements?', 'yna', 1, 2),
(1751, 104, 'Are suppliers selected and evaluated based on their ability to supply product/services in line with requirements? E.g medical supplies, equipment, maintenance services, office supplies', 'yna', 1, 3),
(1752, 104, 'Are criteria established for selection, evaluation and reevaluation of suppliers?', 'yna', 1, 4),
(1753, 104, 'Are results of evaluations and any necessary actions maintained as records?', 'yna', 1, 5),
(1754, 104, 'Do purchasing records fully describe product to be purchased?  (and qualifications of personnel, if relevant)', 'yna', 1, 6),
(1755, 104, 'Is there a purchase order approval process in place? Confirmation of telephone orders in writing?', 'yna', 1, 7),
(1756, 104, 'Are purchased products inspected to ensure they meet requirements? Trial process for new products?', 'yna', 1, 8),
(1757, 104, 'Control of monitoring and measuring devices', 'sec', 0, 9),
(1758, 104, 'Is there a process to ensure routine calibration of relevant equipment?', 'yna', 1, 10),
(1759, 104, 'Is relevant equipment maintained and calibrated prior to use in line relevant standards/requirements?  E.g. autoclave, fridge/freezer, lasers', 'yna', 1, 11),
(1760, 104, 'Is there a system to ensure appropriate action if equipment is found to be outside the required calibration range?', 'yna', 1, 12),
(1761, 104, 'Are appropriate calibration records maintained?', 'yna', 1, 13),
(1762, 104, 'Monitoring and measurement of processes and products', 'sec', 0, 14),
(1763, 104, 'Is there a process in place to ensure that equipment is functioning correctly?', 'yna', 1, 15),
(1764, 104, 'Have inspections, tests and verifications been completed as required?', 'yna', 1, 16),
(1765, 104, 'Is documentation from testing and maintenance available and managed in line with 4.2.4 Control of Records', 'yna', 1, 17),
(1766, 104, 'Are physical resources available to meet staff and patient requirements?', 'yna', 1, 18),
(1767, 104, 'Control of Non-Conforming Product', 'sec', 0, 19),
(1768, 104, 'Are non-conformances with equipment/products dealt with appropriately with records maintained?', 'yna', 1, 20),
(1769, 104, 'Where nonconforming product is detected after delivery or after use has started is appropriate action taken to minimise any negative outcome?', 'yna', 1, 21),
(1770, 105, 'Are the appropriate qualifications/credentials identified for relevant staff positions?  ', 'yna', 1, 1),
(1771, 105, 'Is a process in place to confirm clinical staff registration/insurance is maintained?', 'yn', 1, 2),
(1772, 105, 'Is there an ongoing education process in place? Are training records maintained?', 'yna', 1, 3),
(1773, 105, 'Have staff received appropriate training on', 'txt', 0, 4),
(1774, 105, 'Orientation', 'yn', 1, 5),
(1775, 105, 'Fire safety', 'yn', 1, 6),
(1776, 105, 'CPR', 'yn', 1, 7),
(1777, 105, 'Manual Handling', 'yn', 1, 8),
(1778, 105, 'IFC', 'yn', 1, 9),
(1779, 105, 'Relevant technical processes', 'yn', 1, 10),
(1780, 105, 'Are staff given opportunities for ongoing skills development through', 'txt', 0, 11),
(1781, 105, 'External conferences/seminars', 'yna', 1, 12),
(1782, 105, 'Research/formal study', 'yna', 1, 13),
(1783, 105, 'Are appropriate personnel records maintained?', 'yna', 1, 14),
(1784, 105, 'Are staff provided with opportunities to give feedback on the HRM processes?', 'yna', 1, 15),
(1785, 105, 'Are annual performance appraisals conducted to ensure staff receive feedback on their performance and are given opportunities for ongoing development?', 'yna', 1, 16),
(1786, 106, 'Identifies key points/sites and determines field of ANTT?', 'yna', 1, 1),
(1787, 106, 'Environmental risks removed?', 'yna', 1, 2),
(1788, 106, 'Working areas/surfaces disinfected?', 'yna', 1, 3),
(1789, 106, 'Adheres to 5 moments of hand hygiene?', 'yna', 1, 4),
(1790, 106, 'Appropriate aseptic field achieved?', 'yna', 1, 5),
(1791, 106, 'Key points/sites protected?', 'yna', 1, 6),
(1792, 106, 'Non-touch technique used appropriately, eg. Use of sterile gloves?', 'yna', 1, 7),
(1793, 106, 'Demonstrates decontamination process?', 'yna', 1, 8),
(1794, 107, 'Staff Competency', 'sec', 0, 1),
(1795, 107, 'The person responsible for CSD has specific instrument reprocessing qualifications or experience', 'yna', 1, 2),
(1796, 107, 'There a copy of the current edition of AS/NZS 4187 available in CSD', 'yna', 1, 3),
(1797, 107, 'Collection and Cleaning', 'sec', 0, 4),
(1798, 107, 'Reusable items are collected in leak proof, puncture resistant containers', '0', 1, 5),
(1799, 107, 'In the clean up area staff wear', 'txt', 0, 6),
(1800, 107, 'Impervious apron or gown', 'yna', 1, 7),
(1801, 107, 'Eye protection', 'yna', 1, 8),
(1802, 107, 'Gloves', 'yna', 1, 9),
(1803, 107, 'All single use items are discarded', 'yna', 1, 10),
(1804, 107, 'The cleaning area has ', 'txt', 0, 11),
(1805, 107, 'Separate handwashing facilities', 'yna', 1, 12),
(1806, 107, 'Adequate bench space', 'yna', 1, 13),
(1807, 107, 'Non-porous work surfaces', 'yna', 1, 14),
(1808, 107, 'Smooth surfaces without cracks and/or crevices', 'yna', 1, 15),
(1809, 107, 'Good lighting', 'yna', 1, 16),
(1810, 107, 'Efficient ventilation in sterilizing area (minimum 10 air changes/hr)', 'yna', 1, 17),
(1811, 107, 'Room temperature maintained between 18-22oC at all times', 'yna', 1, 18),
(1812, 107, 'Adequate storage space', 'yna', 1, 19),
(1813, 107, 'Non-slip floors', 'yna', 1, 20),
(1814, 107, 'Cleaning sink', 'yna', 1, 21),
(1815, 107, 'Range of non-abrasive brushes and pads', 'yna', 1, 22),
(1816, 107, 'Drying equipment or lint free towels for manual drying', 'yna', 1, 23),
(1817, 107, 'One way work flow from dirty to clean, with no cross over', 'yna', 1, 24),
(1818, 107, 'Manufacturerâ€™s manuals available for all equipment', 'yna', 1, 25),
(1819, 107, 'A documented cleaning schedule', 'yna', 1, 26),
(1820, 107, 'On receipt all items are checked for completeness & defects, insulated items, such as diathermy tips and leads, are checked to ensure that there is no short circuit', 'yna', 1, 27),
(1821, 107, 'Labels of manual and mechanical cleaning agents include ', 'txt', 0, 28),
(1822, 107, 'name of product', 'yna', 1, 29),
(1823, 107, 'name of manufacturer', 'yna', 1, 30),
(1824, 107, 'address of manufacturer', 'yna', 1, 31),
(1825, 107, 'description of product', 'yna', 1, 32),
(1826, 107, 'purpose of product', 'yna', 1, 33),
(1827, 107, 'directions for usage', 'yna', 1, 34),
(1828, 107, 'directions for dilution', 'yna', 1, 35),
(1829, 107, 'batch number', 'yna', 1, 36),
(1830, 107, 'expiry date', 'yna', 1, 37),
(1831, 107, 'first aid instructions', 'yna', 1, 38),
(1832, 107, 'safety instructions', 'yna', 1, 39),
(1833, 107, 'storage instructions', 'yna', 1, 40),
(1834, 107, 'Ultrasonic cleaning ', 'txt', 0, 41),
(1835, 107, 'manufacturer approved detergent used', 'yna', 1, 42),
(1836, 107, 'detergent added after tank is filled', 'yna', 1, 43),
(1837, 107, 'unit is degassed after tank is filled before processing instruments', 'yna', 1, 44),
(1838, 107, 'transducers are tested daily', 'yna', 1, 45),
(1839, 107, 'instruments are rinsed before immersion', 'yna', 1, 46),
(1840, 107, 'unit is cleaned and solution replaced at least daily when in use', 'yna', 1, 47),
(1841, 107, 'unit is fitted with a lid', 'yna', 1, 48),
(1842, 107, 'unit is always operated with lid closed', 'yna', 1, 49),
(1843, 107, 'Manual cleaning ', 'txt', 0, 50),
(1844, 107, 'cleaning equipment is non-abrasive', 'yna', 1, 51),
(1845, 107, 'cleaning equipment is in good condition', 'yna', 1, 52),
(1846, 107, 'cleaning equipment is disinfected/sterilized at end of each session', 'yna', 1, 53),
(1847, 107, 'cleaning equipment is stored clean & dry', 'yna', 1, 54),
(1848, 107, 'items are flushed with water 15-30oC to remove visible soiling', 'yna', 1, 55),
(1849, 107, 'items dismantled/opened prior to cleaning', 'yna', 1, 56),
(1850, 107, 'items submerged and cleaned in warm water with detergent ', 'yna', 1, 57),
(1851, 107, 'Instrument Rinsing and Drying', 'txt', 0, 58),
(1852, 107, 'items rinsed it warm/hot running water or in the automated instrument rinse machine', 'yna', 1, 59),
(1853, 107, 'items dried in drying cabinet or with lint free cloth', 'yna', 1, 60),
(1854, 107, 'Packaging and Wrapping ', 'txt', 0, 61),
(1855, 107, 'single use disposable wraps used â€“ checked for defects before use', 'yna', 1, 62),
(1856, 107, 'prepared labels or non-toxic felt pens are used to label packs', 'yna', 1, 63),
(1857, 107, 'multiple part instruments are packed in loosened or opened position', 'yna', 1, 64),
(1858, 107, 'trays for packaging are perforated', 'yna', 1, 65),
(1859, 107, 'indicator tape has manufacturer name, batch no & date on core', 'yna', 1, 66),
(1860, 107, 'indicator tape adheres well to all wraps used', 'yna', 1, 67),
(1861, 107, 'colour change of indicator tape after sterilizing is clear and distinct', 'yna', 1, 68),
(1862, 107, 'Sterilizing', 'txt', 0, 69),
(1863, 107, 'Operating manuals are stored near both sterilizers at all times', 'yna', 1, 70),
(1864, 107, 'Steam sterilizers (benchtop) ', 'txt', 0, 71),
(1865, 107, 'Items are loaded within boundaries of loading trays (i.e. no overhang)', 'yna', 1, 72),
(1866, 107, 'Trays are loaded with single layers of packs only', 'yna', 1, 73),
(1867, 108, 'Staff member', 'txt', 0, 1),
(1868, 108, 'Are the patients current medication documented in the file?', 'yna', 1, 2),
(1869, 108, 'Is the allergy status specified?', 'yna', 1, 3),
(1870, 108, 'If allergy present, is reaction specified?', 'yna', 1, 4),
(1871, 108, 'If allergy present, is allergy noted in the patient file?', 'yna', 1, 5),
(1872, 108, 'Is medication information provided to patients?', 'yna', 1, 6),
(1873, 108, 'Is medication order signed by treating doctor?', 'yna', 1, 7),
(1874, 108, 'Are the five rights adhered by nurse?', 'yna', 1, 8),
(1875, 108, 'Are two nurses present for administration when necessary?', 'yna', 1, 9),
(1876, 108, 'Is medical record signed by both nurses?', 'yna', 1, 10),
(1877, 108, 'Is drug book completed accurately?', 'yna', 1, 11),
(1878, 108, 'Is a copy of MIMS available to staff?', 'yna', 1, 12),
(1879, 108, 'Is medication stored in locked cupboard if necessary?', 'yna', 1, 13),
(1880, 108, 'Is it true that we use NSQHS?', 'tf', 1, 14),
(1881, 112, 'Test 1', 'yn', 1, 1),
(1882, 112, 'Test 2', 'yna', 1, 0),
(1883, 113, 'Yes or No?', 'yn', 1, 1),
(1884, 113, '1 or 2?', 'tf', 1, 2),
(1885, 113, 'What is the average speed of an uladen swallow?', 'txt', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `qa_responses`
--

CREATE TABLE IF NOT EXISTS `qa_responses` (
  `id` int(15) NOT NULL,
  `ceid` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `location` int(5) NOT NULL,
  `unit` int(3) DEFAULT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qa_responses`
--

INSERT INTO `qa_responses` (`id`, `ceid`, `uid`, `date`, `location`, `unit`, `text`) VALUES
(1, 99, 1, '2019-04-07 18:58:29', 0, 114, '<p>07-04-2019 18:58:29 sysadmin: \r\n	Test\r\n</p>'),
(2, 99, 1, '2019-04-07 19:20:58', 0, 0, '<p>07-04-2019 19:20:58 sysadmin: \r\n	Test comments\r\n</p>'),
(3, 70, 75, '2019-07-10 09:41:06', 0, 114, '<p>10-07-2019 09:41:06 demoadmin: \r\n	needs items added\r\n</p>'),
(4, 106, 1, '2020-05-03 15:59:37', 0, 130, ''),
(5, 106, 1, '2020-05-03 16:00:43', 0, 130, '<p>03-05-2020 16:00:43 sysadmin: \r\n	Test\r\n</p>'),
(6, 106, 1, '2020-05-03 16:01:42', 0, 130, '<p>03-05-2020 16:01:42 sysadmin: \r\n	Test\r\n</p>'),
(7, 106, 1, '2020-05-03 16:02:02', 0, 130, '<p>03-05-2020 16:02:02 sysadmin: \r\n	Test\r\n</p>'),
(8, 106, 1, '2020-05-03 16:03:47', 0, 130, '<p>03-05-2020 16:03:47 sysadmin: \r\n	Test\r\n</p>'),
(9, 106, 1, '2020-05-03 16:04:57', 0, 130, '<p>03-05-2020 16:04:57 sysadmin: \r\n	Test\r\n</p>'),
(10, 106, 1, '2020-05-03 16:06:29', 0, 130, '<p>03-05-2020 16:06:29 sysadmin: \r\n	test\r\n</p>'),
(11, 106, 1, '2020-05-03 16:07:25', 0, 130, '<p>03-05-2020 16:07:25 sysadmin: \r\n	test\r\n</p>'),
(12, 106, 1, '2020-05-03 16:08:27', 0, 130, '<p>03-05-2020 16:08:27 sysadmin: \r\n	test\r\n</p>'),
(13, 106, 1, '2020-05-03 16:09:10', 0, 130, '<p>03-05-2020 16:09:10 sysadmin: \r\n	test\r\n</p>'),
(14, 107, 1, '2020-06-14 15:48:54', 0, 0, '<p>14-06-2020 15:48:54 sysadmin: \r\n	Test\r\n</p>'),
(15, 107, 1, '2020-06-14 15:49:04', 0, 0, '<p>14-06-2020 15:49:04 sysadmin: \r\n	Test\r\n</p>');

-- --------------------------------------------------------

--
-- Table structure for table `qa_responses_ext`
--

CREATE TABLE IF NOT EXISTS `qa_responses_ext` (
  `id` int(15) NOT NULL,
  `gid` int(15) NOT NULL,
  `cqid` int(15) NOT NULL,
  `response` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qa_responses_ext`
--

INSERT INTO `qa_responses_ext` (`id`, `gid`, `cqid`, `response`) VALUES
(1, 1, 1624, 'Some work area'),
(2, 1, 1625, ''),
(3, 1, 1626, 'n'),
(4, 1, 1627, ''),
(5, 1, 1628, 'y'),
(6, 1, 1629, ''),
(7, 1, 1630, ''),
(8, 1, 1631, ''),
(9, 1, 1632, 'y'),
(10, 1, 1633, ''),
(11, 1, 1634, ''),
(12, 2, 1624, ''),
(13, 2, 1625, 'Test 2'),
(14, 2, 1626, 'y'),
(15, 2, 1627, 'y'),
(16, 2, 1628, 'y'),
(17, 2, 1629, 'n'),
(18, 2, 1630, 'n'),
(19, 2, 1631, 'Test'),
(20, 2, 1632, 'y'),
(21, 2, 1633, 'Test 3'),
(22, 2, 1634, 'Test 4'),
(23, 3, 915, 'Jo Blogs'),
(24, 3, 916, 'y'),
(25, 3, 917, 'y'),
(26, 3, 918, 'y'),
(27, 3, 919, 'y'),
(28, 3, 920, ''),
(29, 3, 921, 'n'),
(30, 3, 922, 'y'),
(31, 3, 923, 'y'),
(32, 3, 924, 'y'),
(33, 4, 1786, 'y'),
(34, 4, 1787, 'y'),
(35, 4, 1788, 'y'),
(36, 4, 1789, 'y'),
(37, 4, 1790, 'y'),
(38, 4, 1791, 'y'),
(39, 4, 1792, 'y'),
(40, 4, 1793, 'y'),
(41, 5, 1786, 'y'),
(42, 5, 1787, ''),
(43, 5, 1788, ''),
(44, 5, 1789, ''),
(45, 5, 1790, ''),
(46, 5, 1791, ''),
(47, 5, 1792, ''),
(48, 5, 1793, ''),
(49, 6, 1786, 'y'),
(50, 6, 1787, ''),
(51, 6, 1788, ''),
(52, 6, 1789, ''),
(53, 6, 1790, ''),
(54, 6, 1791, ''),
(55, 6, 1792, ''),
(56, 6, 1793, ''),
(57, 7, 1786, 'y'),
(58, 7, 1787, ''),
(59, 7, 1788, ''),
(60, 7, 1789, ''),
(61, 7, 1790, ''),
(62, 7, 1791, ''),
(63, 7, 1792, ''),
(64, 7, 1793, ''),
(65, 8, 1786, 'y'),
(66, 8, 1787, 'y'),
(67, 8, 1788, ''),
(68, 8, 1789, ''),
(69, 8, 1790, ''),
(70, 8, 1791, ''),
(71, 8, 1792, ''),
(72, 8, 1793, ''),
(73, 9, 1786, 'y'),
(74, 9, 1787, ''),
(75, 9, 1788, ''),
(76, 9, 1789, ''),
(77, 9, 1790, ''),
(78, 9, 1791, ''),
(79, 9, 1792, ''),
(80, 9, 1793, ''),
(81, 10, 1786, 'y'),
(82, 10, 1787, ''),
(83, 10, 1788, ''),
(84, 10, 1789, ''),
(85, 10, 1790, ''),
(86, 10, 1791, ''),
(87, 10, 1792, ''),
(88, 10, 1793, ''),
(89, 11, 1786, 'y'),
(90, 11, 1787, ''),
(91, 11, 1788, ''),
(92, 11, 1789, ''),
(93, 11, 1790, ''),
(94, 11, 1791, ''),
(95, 11, 1792, ''),
(96, 11, 1793, ''),
(97, 12, 1786, 'y'),
(98, 12, 1787, ''),
(99, 12, 1788, ''),
(100, 12, 1789, ''),
(101, 12, 1790, ''),
(102, 12, 1791, ''),
(103, 12, 1792, ''),
(104, 12, 1793, ''),
(105, 13, 1786, 'y'),
(106, 13, 1787, ''),
(107, 13, 1788, ''),
(108, 13, 1789, ''),
(109, 13, 1790, ''),
(110, 13, 1791, ''),
(111, 13, 1792, ''),
(112, 13, 1793, ''),
(113, 14, 1794, 'sec'),
(114, 14, 1795, 'y'),
(115, 14, 1796, ''),
(116, 14, 1797, 'sec'),
(117, 14, 1798, ''),
(118, 14, 1799, ''),
(119, 14, 1800, ''),
(120, 14, 1801, ''),
(121, 14, 1802, ''),
(122, 14, 1803, ''),
(123, 14, 1804, ''),
(124, 14, 1805, ''),
(125, 14, 1806, ''),
(126, 14, 1807, ''),
(127, 14, 1808, ''),
(128, 14, 1809, ''),
(129, 14, 1810, ''),
(130, 14, 1811, ''),
(131, 14, 1812, ''),
(132, 14, 1813, ''),
(133, 14, 1814, ''),
(134, 14, 1815, ''),
(135, 14, 1816, ''),
(136, 14, 1817, ''),
(137, 14, 1818, ''),
(138, 14, 1819, ''),
(139, 14, 1820, ''),
(140, 14, 1821, ''),
(141, 14, 1822, ''),
(142, 14, 1823, ''),
(143, 14, 1824, ''),
(144, 14, 1825, ''),
(145, 14, 1826, ''),
(146, 14, 1827, ''),
(147, 14, 1828, ''),
(148, 14, 1829, ''),
(149, 14, 1830, ''),
(150, 14, 1831, ''),
(151, 14, 1832, ''),
(152, 14, 1833, ''),
(153, 14, 1834, ''),
(154, 14, 1835, ''),
(155, 14, 1836, ''),
(156, 14, 1837, ''),
(157, 14, 1838, ''),
(158, 14, 1839, ''),
(159, 14, 1840, ''),
(160, 14, 1841, ''),
(161, 14, 1842, ''),
(162, 14, 1843, ''),
(163, 14, 1844, ''),
(164, 14, 1845, ''),
(165, 14, 1846, ''),
(166, 14, 1847, ''),
(167, 14, 1848, ''),
(168, 14, 1849, ''),
(169, 14, 1850, ''),
(170, 14, 1851, ''),
(171, 14, 1852, ''),
(172, 14, 1853, ''),
(173, 14, 1854, ''),
(174, 14, 1855, ''),
(175, 14, 1856, ''),
(176, 14, 1857, ''),
(177, 14, 1858, ''),
(178, 14, 1859, ''),
(179, 14, 1860, ''),
(180, 14, 1861, ''),
(181, 14, 1862, ''),
(182, 14, 1863, ''),
(183, 14, 1864, ''),
(184, 14, 1865, ''),
(185, 14, 1866, ''),
(186, 15, 1794, 'sec'),
(187, 15, 1795, 'y'),
(188, 15, 1796, ''),
(189, 15, 1797, 'sec'),
(190, 15, 1798, ''),
(191, 15, 1799, ''),
(192, 15, 1800, ''),
(193, 15, 1801, ''),
(194, 15, 1802, ''),
(195, 15, 1803, ''),
(196, 15, 1804, ''),
(197, 15, 1805, ''),
(198, 15, 1806, ''),
(199, 15, 1807, ''),
(200, 15, 1808, ''),
(201, 15, 1809, ''),
(202, 15, 1810, ''),
(203, 15, 1811, ''),
(204, 15, 1812, ''),
(205, 15, 1813, ''),
(206, 15, 1814, ''),
(207, 15, 1815, ''),
(208, 15, 1816, ''),
(209, 15, 1817, ''),
(210, 15, 1818, ''),
(211, 15, 1819, ''),
(212, 15, 1820, ''),
(213, 15, 1821, ''),
(214, 15, 1822, ''),
(215, 15, 1823, ''),
(216, 15, 1824, ''),
(217, 15, 1825, ''),
(218, 15, 1826, ''),
(219, 15, 1827, ''),
(220, 15, 1828, ''),
(221, 15, 1829, ''),
(222, 15, 1830, ''),
(223, 15, 1831, ''),
(224, 15, 1832, ''),
(225, 15, 1833, ''),
(226, 15, 1834, ''),
(227, 15, 1835, ''),
(228, 15, 1836, ''),
(229, 15, 1837, ''),
(230, 15, 1838, ''),
(231, 15, 1839, ''),
(232, 15, 1840, ''),
(233, 15, 1841, ''),
(234, 15, 1842, ''),
(235, 15, 1843, ''),
(236, 15, 1844, ''),
(237, 15, 1845, ''),
(238, 15, 1846, ''),
(239, 15, 1847, ''),
(240, 15, 1848, ''),
(241, 15, 1849, ''),
(242, 15, 1850, ''),
(243, 15, 1851, ''),
(244, 15, 1852, ''),
(245, 15, 1853, ''),
(246, 15, 1854, ''),
(247, 15, 1855, ''),
(248, 15, 1856, ''),
(249, 15, 1857, ''),
(250, 15, 1858, ''),
(251, 15, 1859, ''),
(252, 15, 1860, ''),
(253, 15, 1861, ''),
(254, 15, 1862, ''),
(255, 15, 1863, ''),
(256, 15, 1864, ''),
(257, 15, 1865, ''),
(258, 15, 1866, '');

-- --------------------------------------------------------

--
-- Table structure for table `qi`
--

CREATE TABLE IF NOT EXISTS `qi` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mids` varchar(200) NOT NULL,
  `type_id` int(3) NOT NULL,
  `unit` int(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qi`
--

INSERT INTO `qi` (`id`, `name`, `mids`, `type_id`, `unit`, `status`) VALUES
(1, 'Machine Faults', '1;2', 122, 0, 1),
(2, 'Test Checklist', '', 121, 114, 1),
(3, 'Test QA Checklist', '', 119, 0, 1),
(4, 'Test add 2', '', 121, 0, 1),
(5, 'Test', '', 121, 0, 0),
(6, 'Files test', '', 121, 114, 1),
(7, 'incident Management Checklist', '', 120, 0, 1),
(8, 'Task list test', '', 119, 0, 0),
(9, 'LA1', '', 121, 0, 1),
(10, 'asd', '', 119, 0, 0),
(11, 'asdasd', '', 119, 0, 1),
(12, 'ASasdfr', '', 121, 0, 1),
(13, 'Feedback Profile 1', '', 131, 0, 1),
(14, 'Feedback Demo 1', '', 131, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qi_ext`
--

CREATE TABLE IF NOT EXISTS `qi_ext` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_active` datetime NOT NULL,
  `date_retired` datetime NOT NULL,
  `version` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  `report_setting` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qi_ext`
--

INSERT INTO `qi_ext` (`id`, `fid`, `uid`, `date_created`, `date_active`, `date_retired`, `version`, `status`, `report_setting`) VALUES
(1, 1, 1, '2019-01-11 06:59:35', '2019-01-11 07:00:05', '2020-05-11 07:47:13', 1, 2, ''),
(2, 2, 1, '2019-01-28 15:56:15', '2019-01-28 15:56:47', '0000-00-00 00:00:00', 1, 1, ''),
(3, 3, 1, '2019-01-28 16:00:02', '2019-07-02 21:12:50', '0000-00-00 00:00:00', 1, 1, ''),
(4, 4, 1, '2019-01-28 16:01:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(5, 5, 1, '2019-01-28 16:06:45', '2019-01-28 16:07:01', '0000-00-00 00:00:00', 1, 1, ''),
(6, 6, 1, '2019-02-01 18:40:14', '2019-02-01 18:40:48', '2019-02-03 22:24:24', 1, 2, ''),
(7, 6, 1, '2019-02-03 22:24:05', '2019-02-03 22:24:24', '0000-00-00 00:00:00', 2, 1, ''),
(8, 7, 1, '2019-04-16 17:11:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(9, 8, 75, '2019-07-12 07:53:35', '2019-07-12 07:53:59', '0000-00-00 00:00:00', 1, 1, ''),
(10, 9, 75, '2019-08-15 12:06:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(11, 10, 75, '2019-08-15 12:38:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(12, 11, 75, '2019-08-15 12:38:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(13, 12, 75, '2019-08-15 12:39:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, ''),
(14, 13, 1, '2019-10-12 14:03:44', '2019-10-12 18:33:52', '2020-05-02 16:00:44', 1, 2, ''),
(15, 13, 1, '2020-05-02 16:00:24', '2020-05-02 16:00:44', '0000-00-00 00:00:00', 2, 1, ''),
(16, 1, 1, '2020-05-08 12:24:08', '2020-05-11 07:47:13', '0000-00-00 00:00:00', 2, 1, ''),
(17, 14, 1, '2020-05-18 08:13:08', '2020-05-18 08:14:02', '0000-00-00 00:00:00', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `qi_q`
--

CREATE TABLE IF NOT EXISTS `qi_q` (
  `id` int(11) NOT NULL,
  `feid` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `type` varchar(14) NOT NULL,
  `order` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qi_q`
--

INSERT INTO `qi_q` (`id`, `feid`, `question`, `type`, `order`) VALUES
(1, 1, 'Submitted on', 'text', 1),
(2, 1, 'Fault status', 'checkbox', 2),
(3, 6, 'File upload', 'upload', 1),
(4, 6, 'Image upload', 'image', 2),
(7, 7, 'Test', 'text', 1),
(8, 3, 'Section 1', 'sectionbreak', 1),
(9, 3, 'Test question 1', 'text', 2),
(10, 3, 'Free text response', 'textarea', 3),
(11, 3, 'Type', 'radio', 4),
(46, 14, 'Smile 5a', 'smileys-5', 1),
(47, 14, 'Smile 3b', 'smileys-3', 2),
(48, 14, 'Numeric 5c', 'numeric-5', 3),
(49, 14, 'Numeric 3d', 'numeric-3', 4),
(50, 14, 'Yes Noe', 'yes-no', 5),
(51, 15, 'How satisfied were you with your check-in experience?', 'smileys-5', 1),
(52, 15, 'How would you rate your interaction with our staff today?', 'smileys-5', 2),
(53, 15, 'How likely would you be to recommend us to friends or family?', 'numeric-5', 4),
(54, 15, 'Did we meet your expectations during your visit today?', 'yes-no', 3),
(56, 16, 'Submitted on', 'text', 1),
(57, 16, 'Fault status', 'checkbox', 2),
(58, 17, 'This is a test question with smiley faces', 'smileys-5', 1),
(59, 17, 'This is a test question with numbers', 'numeric-5', 2),
(60, 17, 'What about this question?', 'smileys-5', 3);

-- --------------------------------------------------------

--
-- Table structure for table `qi_q_ext`
--

CREATE TABLE IF NOT EXISTS `qi_q_ext` (
  `id` int(11) NOT NULL,
  `feqid` int(11) NOT NULL,
  `option` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qi_q_ext`
--

INSERT INTO `qi_q_ext` (`id`, `feqid`, `option`) VALUES
(1, 2, 'Major'),
(2, 2, 'Minor'),
(3, 11, 'Type 1'),
(4, 11, 'Type 2'),
(5, 57, 'Major'),
(6, 57, 'Minor');

-- --------------------------------------------------------

--
-- Table structure for table `qi_resolution_q`
--

CREATE TABLE IF NOT EXISTS `qi_resolution_q` (
  `id` int(11) NOT NULL,
  `feid` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `type` varchar(14) NOT NULL,
  `order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qi_resolution_q_ext`
--

CREATE TABLE IF NOT EXISTS `qi_resolution_q_ext` (
  `id` int(11) NOT NULL,
  `feqid` int(11) NOT NULL,
  `option` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qi_responses`
--

CREATE TABLE IF NOT EXISTS `qi_responses` (
  `id` int(11) NOT NULL,
  `feid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `uid` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  `unit` int(3) DEFAULT NULL,
  `comments` text NOT NULL,
  `status` int(1) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `category` varchar(200) NOT NULL,
  `post_qa` int(1) NOT NULL,
  `engineer` varchar(200) NOT NULL,
  `released` varchar(200) NOT NULL,
  `released_to` varchar(200) NOT NULL,
  `files` text NOT NULL,
  `related_faults` varchar(400) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qi_responses`
--

INSERT INTO `qi_responses` (`id`, `feid`, `date`, `uid`, `mid`, `unit`, `comments`, `status`, `subject`, `category`, `post_qa`, `engineer`, `released`, `released_to`, `files`, `related_faults`) VALUES
(1, 15, '2020-05-18 16:17:48', 1, 0, 0, '', 100, 'Test', 'Test', 0, '', '', '', '', '5'),
(2, 15, '2020-05-18 16:30:32', 1, 0, 0, '', 100, 'This is a very large string and I think it should be truncated because it is way too long not to be', 'This is a  boring cateogry and should be ignored', 0, '', '', '', '', '5'),
(3, 17, '2020-05-26 11:58:40', 1, 0, 0, '', 100, '', '', 0, '', '', '', '', ''),
(4, 3, '2020-05-28 08:22:09', 1, 0, 0, '', 100, '', '', 0, '', '', '', '', '5'),
(5, 16, '2020-05-28 11:08:01', 1, 2, 0, '\n28-05-2020 12:28:58 Test\n28-05-2020 12:31:26 Test\n2020-05-28 12:35:01 Fault status updated to: Closed, Systems Administrator', 101, 'Test ts', 'Test c', 0, '', '', '', '', '4;1;2');

-- --------------------------------------------------------

--
-- Table structure for table `qi_responses_ext`
--

CREATE TABLE IF NOT EXISTS `qi_responses_ext` (
  `id` int(11) NOT NULL,
  `frid` int(11) NOT NULL,
  `fqid` int(11) NOT NULL,
  `answer` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qi_responses_ext`
--

INSERT INTO `qi_responses_ext` (`id`, `frid`, `fqid`, `answer`) VALUES
(1, 1, 51, 'smileys-4'),
(2, 1, 52, 'smileys-5'),
(3, 1, 54, 'yes'),
(4, 1, 53, 'numeric-4'),
(5, 2, 51, 'smileys-2'),
(6, 2, 52, 'smileys-5'),
(7, 2, 54, 'yes'),
(8, 2, 53, 'numeric-5'),
(9, 3, 58, 'smileys-1'),
(10, 3, 59, 'numeric-3'),
(11, 3, 60, 'smileys-4'),
(12, 4, 8, ''),
(13, 4, 9, 'Test'),
(14, 4, 10, 'Test'),
(15, 4, 11, '3'),
(16, 0, 56, 'Test Test'),
(17, 0, 57, '5'),
(18, 0, 56, 'Test'),
(19, 0, 57, '5'),
(20, 5, 56, 'test a'),
(21, 5, 57, '5');

-- --------------------------------------------------------

--
-- Table structure for table `radiation_manager`
--

CREATE TABLE IF NOT EXISTS `radiation_manager` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `dose` varchar(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiation_manager`
--

INSERT INTO `radiation_manager` (`id`, `uid`, `dose`, `date`) VALUES
(1, 74, '5.00', '2019-07-12'),
(2, 76, '2.00', '2019-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `link` varchar(300) NOT NULL,
  `configure` int(1) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `name`, `link`, `configure`, `active`) VALUES
(1, 'Document Manager Report', 'db-manager-export.php', 0, 1),
(3, 'Documents due for Renewal', 'documents-for-renewal-report.php', 1, 0),
(4, 'Document Read Compliance', 'document-read-compliance-report.php', 1, 0),
(5, 'Machine QA Report', 'machine-qa-report.php', 1, 1),
(6, 'Audit Reports', 'audit-report.php', 1, 1),
(7, 'Checklist Reports', 'checklist-report.php', 1, 1),
(8, 'Staff Credentials Report', 'staff-credentials-report.php', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports_ext`
--

CREATE TABLE IF NOT EXISTS `reports_ext` (
  `id` int(11) NOT NULL,
  `rid` int(3) NOT NULL,
  `uid` int(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports_ext`
--

INSERT INTO `reports_ext` (`id`, `rid`, `uid`, `date`) VALUES
(1, 1, 1, '2019-01-27 19:18:00'),
(2, 1, 1, '2019-01-27 19:18:10'),
(3, 1, 1, '2019-04-04 18:32:55'),
(4, 1, 1, '2019-04-07 14:08:27'),
(5, 1, 1, '2019-04-07 19:29:03'),
(6, 1, 1, '2019-04-07 19:58:02'),
(7, 1, 75, '2019-08-15 12:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE IF NOT EXISTS `standards` (
  `id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` int(3) NOT NULL DEFAULT '29'
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `name`, `type`) VALUES
(1, '1.1', 29),
(2, '1.2', 29),
(3, '1.3', 29),
(4, '1.4', 29),
(5, '1.5', 29),
(6, '1.6', 29),
(7, '1.7', 29),
(8, '1.8', 29),
(9, '1.9', 29),
(10, '1.10', 29),
(11, '1.11', 29),
(12, '1.12', 29),
(13, '1.13', 29),
(14, '1.14', 29),
(15, '1.15', 29),
(16, '1.16', 29),
(17, '1.17', 29),
(18, '1.18', 29),
(19, '1.19', 29),
(20, '1.20', 29),
(21, '2.1', 29),
(22, '2.2', 29),
(23, '2.3', 29),
(24, '2.4', 29),
(25, '2.5', 29),
(26, '2.6', 29),
(27, '2.7', 29),
(28, '2.8', 29),
(29, '2.9', 29),
(30, '3.1', 29),
(31, '3.2', 29),
(32, '3.3', 29),
(33, '3.4', 29),
(34, '3.5', 29),
(35, '3.6', 29),
(36, '3.7', 29),
(37, '3.8', 29),
(38, '3.9', 29),
(39, '3.10', 29),
(40, '3.11', 29),
(41, '3.12', 29),
(42, '3.13', 29),
(43, '3.14', 29),
(44, '3.15', 29),
(45, '3.16', 29),
(46, '3.17', 29),
(47, '3.18', 29),
(48, '3.19', 29),
(49, '4.1', 29),
(50, '4.2', 29),
(51, '4.3', 29),
(52, '4.4', 29),
(53, '4.5', 29),
(54, '4.6', 29),
(55, '4.7', 29),
(56, '4.8', 29),
(57, '4.9', 29),
(58, '4.10', 29),
(59, '4.11', 29),
(60, '4.12', 29),
(61, '4.13', 29),
(62, '4.14', 29),
(63, '4.15', 29),
(64, '5.1', 29),
(65, '5.2', 29),
(66, '5.3', 29),
(67, '5.4', 29),
(68, '5.5', 29),
(69, '6.1', 29),
(70, '6.2', 29),
(71, '6.3', 29),
(72, '6.4', 29),
(73, '6.5', 29),
(74, '7.1', 29),
(75, '7.2', 29),
(76, '7.3', 29),
(77, '7.4', 29),
(78, '7.5', 29),
(79, '7.6', 29),
(80, '7.7', 29),
(81, '7.8', 29),
(82, '7.9', 29),
(83, '7.10', 29),
(84, '7.11', 29),
(85, '8.1', 29),
(86, '8.2', 29),
(87, '8.3', 29),
(88, '8.4', 29),
(89, '8.5', 29),
(90, '8.6', 29),
(91, '8.7', 29),
(92, '8.8', 29),
(93, '8.9', 29),
(94, '8.10', 29),
(95, '9.1', 29),
(96, '9.2', 29),
(97, '9.3', 29),
(98, '9.4', 29),
(99, '9.5', 29),
(100, '9.6', 29),
(101, '9.7', 29),
(102, '9.8', 29),
(103, '9.9', 29),
(104, '10.1', 29),
(105, '10.2', 29),
(106, '10.3', 29),
(107, '10.4', 29),
(108, '10.5', 29),
(109, '10.6', 29),
(110, '10.7', 29),
(111, '10.8', 29),
(112, '10.9', 29),
(113, '10.10', 29);

-- --------------------------------------------------------

--
-- Table structure for table `system_modules`
--

CREATE TABLE IF NOT EXISTS `system_modules` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `tid` int(1) NOT NULL DEFAULT '6',
  `active` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_modules`
--

INSERT INTO `system_modules` (`id`, `name`, `link`, `tid`, `active`) VALUES
(1, 'Log In', 'login', 6, 1),
(2, 'Log Off', 'logoff', 6, 1),
(3, 'Secure Members Area', 'secure', 6, 1),
(4, 'Console Launch Pad', 'launch', 7, 1),
(5, 'User Manager', 'user-manager', 7, 1),
(6, 'User Control Login', 'login', 7, 1),
(7, 'User Control Logoff', 'logoff', 7, 1),
(8, 'Option Editor', 'option-editor', 7, 1),
(9, 'User Editor', 'user-editor', 7, 1),
(10, 'Media Manager', 'media-manager', 7, 1),
(12, 'Document Manager', 'document-manager', 7, 1),
(13, 'Document Editor', 'document-editor', 7, 1),
(17, 'Document Types', 'document-types', 6, 1),
(45, 'Checklist Manager', 'checklist-manager', 7, 1),
(21, 'Search', 'search', 6, 1),
(22, 'System Settings', 'system', 7, 1),
(23, 'QA Audits', 'qa-audits', 7, 1),
(24, 'QA Audit Checklists', 'qa-audits', 6, 1),
(25, 'Update Passwords', 'update-passwords', 6, 1),
(26, 'Bulletin Notices', 'bulletins', 6, 1),
(41, 'Quality Assurance', 'quality-assurance', 7, 1),
(28, 'Machine Faults', 'machine-faults', 6, 1),
(29, 'Faults Manager', 'faults', 7, 0),
(30, 'Staff Directory', 'directory', 6, 1),
(31, 'Reports', 'reports', 7, 1),
(32, 'Report Faults', 'report-faults', 6, 0),
(44, 'Checklist Manager', 'checklist-manager', 6, 1),
(43, 'Quality Improvement', 'quality-improvement', 6, 0),
(42, 'Quality Improvement', 'quality-improvement', 7, 0),
(39, 'Messages', 'messages', 6, 0),
(40, 'Forgot Password', 'forgot-password', 6, 1),
(46, 'Learning & Eduction', 'learning-and-education', 6, 1),
(47, 'Education Tracker', 'education-tracker', 7, 1),
(48, 'Radiation Manager', 'radiation-manager', 7, 1),
(49, 'Machine QA', 'machine-qa', 6, 1),
(50, 'Machine QA', 'machine-qa', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `group` varchar(100) NOT NULL,
  `value` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `group`, `value`) VALUES
(1, 'Site Active / Disabled', 'site', '1'),
(2, 'Accreditation Standards', 'site', '29'),
(3, 'Email address (All Users)', 'email', ''),
(9, 'Email address (Machine Faults)', 'email', '54'),
(7, 'Email address (Machine QA)', 'email', '54'),
(6, 'Default Manager', 'managers', '54'),
(8, 'Email address (QA Audits)', 'email', '54'),
(10, 'Email address (General Faults)', 'email', '54'),
(11, 'System generated document number', 'site', '1'),
(12, 'Force Log on', 'site', '0'),
(13, 'Display Rows', 'site', '15'),
(14, 'Display Rows (Launch)', 'site', '12'),
(15, 'Page Limit', 'site', '20'),
(16, 'Search Rows', 'site', '30'),
(17, 'Session Expiry (mins)', 'site', '60'),
(18, 'Allow Education event attendance (days)', 'site', '365'),
(19, 'Display file permitted extensions (;)', 'site', 'potx;dotx;pptx;xlsx;docx;'),
(20, 'Debug Mode', 'site', '0'),
(21, 'Debug Mode Forms', 'site', '0');

-- --------------------------------------------------------

--
-- Table structure for table `system_templates`
--

CREATE TABLE IF NOT EXISTS `system_templates` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `emailText` text NOT NULL,
  `tid` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_templates`
--

INSERT INTO `system_templates` (`id`, `name`, `link`, `text`, `emailText`, `tid`) VALUES
(1, 'Site Disabled Message', '', '<p>The Intranet is currently disabled for maintenance. Please check back soon!</p>', '', 3),
(2, 'Body', 'body', '<p>{text}</p>', '', 1),
(3, 'Document or Module Not Found', '', '<p>Oops...</p>\r\n<p>The page requested can not be found.</p>', '', 3),
(4, 'System ID not found', '', 'Requested action cannot be completed. System ID not found.', '', 3),
(5, 'User Login Error Message', '', 'The username and/or password do not match our records. Please try again.', '', 3),
(6, 'Input Validation Error (Standard)', '', 'The value you entered is not valid.', '', 3),
(7, 'Input String Length', '', 'You must enter a value', '', 3),
(8, 'Database Insert/Update/Delete Failure', '', 'There was a database error. Please contact your Systems Administrator. ', '', 3),
(9, 'Database Insert/Update Success', '', 'The values entered have been inserted/updated correctly.', '', 3),
(10, 'Database Delete Record', '', 'The selected record has been successfully removed.', '', 3),
(11, 'Module not Activated', '', 'The module reqeusted is not installed correctly. Please re-install the module and activate in Modules.', '', 3),
(12, 'Module Doesn''t Exits in DB', '', 'The requested page can not be found. The page does not exist or has not been configured correctly.', '', 3),
(13, 'Data was successfully deleted!', '', 'Data was deleted successful!', '', 3),
(14, 'Data was un-successfully deleted', '', 'The data could not be deleted. No matching data found.', '', 3),
(15, 'You are about to delete', '', 'Warning! You are about to delete some data.', '', 3),
(16, 'Status Update Successful', '', 'Status Update Successful!', '', 3),
(17, 'Not Authorised', '', 'You are not authorised to access this section.', '', 3),
(18, 'Not Authorised for Action', '', 'You are not authorised to perform this action.', '', 3),
(19, 'There are no records available.', '', 'There are no records available.', '', 3),
(20, 'Can not delete Document', '', 'There are sub-categories attached to this document. Can not delete document.', '', 3),
(21, 'Document Moved Successfully', '', 'The document has been moved successfully.', '', 3),
(22, 'Document Moved Un-successfully', '', 'The document failed to be move correctly.', '', 3),
(23, 'File type or extension is not correct', '', 'File type or extension is not correct', '', 3),
(24, 'PDF uploaded', '', 'PDF uploaded', '', 3),
(25, 'PDF moved to archive', '', 'PDF moved to archive', '', 3),
(26, 'Document uploaded', '', 'Document uploaded', '', 3),
(27, 'Document moved to archive', '', 'Document moved to archive', '', 3),
(28, 'Version number updated', '', 'Version number updated to: v', '', 3),
(29, 'Document', 'document', '<p>{name}</p>\r\n<p>{docno}</p>\r\n<p>{auth}</p>\r\n<p>{rev}</p>\r\n<p>{appr}</p>\r\n<p>{ver}</p>\r\n<p>{imp_date}</p>\r\n<p>{rev_date}</p>\r\n<p>{pdf}</p>', '', 1),
(30, 'File not found', '', 'File not found', '', 3),
(31, 'Change History (Free Text)', '', 'Change History Log', '', 3),
(32, 'Notification not sent', '', 'Notification not sent as change text was not specified.', '', 3),
(33, 'Email Notification Footer', '', 'This email was sent using automatic mailing software.', '', 3),
(34, 'Document Change Notification', '', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">\r\n	<tbody><tr>\r\n		<td align="center" bgcolor="#ececec">\r\n        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">\r\n            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>\r\n                \r\n            	<tr>\r\n                	<td class="w640" width="640">\r\n                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n    <tbody><tr>\r\n        <td class="w15" width="15"></td>\r\n        <td class="w325" width="350" valign="middle" align="left">\r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n            \r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w30" width="30"></td>\r\n        <td class="w255" width="255" valign="middle" align="right">\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n            <table cellpadding="0" cellspacing="0" border="0">\r\n    <tbody><tr>\r\n        \r\n        \r\n        \r\n    </tr>\r\n</tbody></table>\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w15" width="15"></td>\r\n    </tr>\r\n</tbody></table>\r\n                        \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                <td id="header" class="w640" width="640" align="center" bgcolor="#425470">\r\n    \r\n    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center" id="headline">\r\n                    <p>\r\n                        <strong><singleline label="Title">Document Change Notification</singleline></strong>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n    \r\n    \r\n</td>\r\n                </tr>\r\n                \r\n                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>\r\n                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">\r\n    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <repeater>\r\n                    \r\n                    <layout label="Text only">\r\n                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                            <tbody><tr>\r\n                                <td class="w580" width="580">\r\n                                    <p align="left" class="article-title"><singleline label="Title"><a href="{link}" style="color: #4b98d7; text-decoration: none;">{doc_name}</a></singleline></p>\r\n                                    <div align="left" class="article-content">\r\n                                        <multiline label="Description"><p>The document <a href="{link}">{doc_name}</a> has been updated due to the following changes:</p>\r\n										<p>{change}</p>\r\n										{read_request}\r\n										</multiline>\r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                            <tr><td class="w580" width="580" height="10"></td></tr>\r\n                        </tbody></table>\r\n                    </layout>\r\n                                        \r\n                    \r\n                    \r\n                </repeater>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n</td></tr>\r\n                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>\r\n                \r\n                <tr>\r\n                <td class="w640" width="640">\r\n				\r\n	\r\n<table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center">\r\n                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"><span>You are receiving this notification as you are a register user of the {company}.</span></p></span>\r\n                </div>\r\n				<br />\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>	\r\n\r\n</td>\r\n                </tr>\r\n                <tr><td class="w640" width="640" height="60"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n	</tr>\r\n</tbody></table></body></html>', '', 2),
(35, 'Credential Approval Notification', '', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">\r\n	<tbody><tr>\r\n		<td align="center" bgcolor="#ececec">\r\n        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">\r\n            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>\r\n                \r\n            	<tr>\r\n                	<td class="w640" width="640">\r\n                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n    <tbody><tr>\r\n        <td class="w15" width="15"></td>\r\n        <td class="w325" width="350" valign="middle" align="left">\r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n            \r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w30" width="30"></td>\r\n        <td class="w255" width="255" valign="middle" align="right">\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n            <table cellpadding="0" cellspacing="0" border="0">\r\n    <tbody><tr>\r\n        \r\n        \r\n        \r\n    </tr>\r\n</tbody></table>\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w15" width="15"></td>\r\n    </tr>\r\n</tbody></table>\r\n                        \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                <td id="header" class="w640" width="640" align="center" bgcolor="#425470">\r\n    \r\n    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center" id="headline">\r\n                    <p>\r\n                        <strong><singleline label="Title">Credential Approval Notification</singleline></strong>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n    \r\n    \r\n</td>\r\n                </tr>\r\n                \r\n                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>\r\n                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">\r\n    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <repeater>\r\n                    \r\n                    <layout label="Text only">\r\n                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                            <tbody><tr>\r\n                                <td class="w580" width="580">\r\n                                    <p align="left" class="article-title"><singleline label="Title">Credential has been approved</singleline></p>\r\n                                    <div align="left" class="article-content">\r\n                                        <multiline label="Description"><p>Your credential <span style="font-weight:bold;">{cred_name}</span> has been approved.</p>\r\n										</multiline>\r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                            <tr><td class="w580" width="580" height="10"></td></tr>\r\n                        </tbody></table>\r\n                    </layout>\r\n                                        \r\n                    \r\n                    \r\n                </repeater>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n</td></tr>\r\n                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>\r\n                \r\n                <tr>\r\n                <td class="w640" width="640">\r\n				\r\n	\r\n<table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center">\r\n                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"><span>You are receiving this notification as you are a register user of the {company}.</span></p></span>\r\n                </div>\r\n				<br />\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>	\r\n\r\n</td>\r\n                </tr>\r\n                <tr><td class="w640" width="640" height="60"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n	</tr>\r\n</tbody></table></body></html>', '', 2),
(36, 'Order has been updated successfully', '', 'Order has been updated successfully!', '', 3),
(37, 'You are about to unassign documents', '', 'Warning! You are about to un-assign a related document.', '', 3),
(38, 'Document locked for editing', '', 'Document locked for editing', '', 3),
(39, 'Document Unlocked', '', 'Document unlocked', '', 3),
(40, 'Document Locking Error', '', 'This document must be un-locked by ', '', 3),
(41, 'Folder', 'folder', '<p>{subtree}</p>', '', 1),
(42, 'Feedback Comment', '', 'Feedback Comment', '', 3),
(43, 'Feedback Submitted Successfully', '', 'Thank you. Your feedback has been submitted successfully.', '', 3),
(44, 'Details updated successfully', '', 'Details have been updated successfully!', '', 3),
(62, 'Document Add Notification', '', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">\r\n	<tbody><tr>\r\n		<td align="center" bgcolor="#ececec">\r\n        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">\r\n            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>\r\n                \r\n            	<tr>\r\n                	<td class="w640" width="640">\r\n                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n    <tbody><tr>\r\n        <td class="w15" width="15"></td>\r\n        <td class="w325" width="350" valign="middle" align="left">\r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n            \r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w30" width="30"></td>\r\n        <td class="w255" width="255" valign="middle" align="right">\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n            <table cellpadding="0" cellspacing="0" border="0">\r\n    <tbody><tr>\r\n        \r\n        \r\n        \r\n    </tr>\r\n</tbody></table>\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w15" width="15"></td>\r\n    </tr>\r\n</tbody></table>\r\n                        \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                <td id="header" class="w640" width="640" align="center" bgcolor="#425470">\r\n    \r\n    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center" id="headline">\r\n                    <p>\r\n                        <strong><singleline label="Title">New Document: {doc_name}</singleline></strong>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n    \r\n    \r\n</td>\r\n                </tr>\r\n                \r\n                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>\r\n                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">\r\n    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <repeater>\r\n                    \r\n                    <layout label="Text only">\r\n                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                            <tbody><tr>\r\n                                <td class="w580" width="580">\r\n                                    <p align="left" class="article-title"><singleline label="Title">{doc_name} released for use</singleline></p>\r\n                                    <div align="left" class="article-content">\r\n                                        <multiline label="Description">\r\n										<p>The document <a href="{link}">{doc_name}</a> has been added and is now available for use.</p>\r\n										{read_request}\r\n										</multiline>\r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                            <tr><td class="w580" width="580" height="10"></td></tr>\r\n                        </tbody></table>\r\n                    </layout>\r\n                                        \r\n                    \r\n                    \r\n                </repeater>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n</td></tr>\r\n                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>\r\n                \r\n                <tr>\r\n                <td class="w640" width="640">\r\n				\r\n	\r\n<table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center">\r\n                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"><span>You are receiving this notification as you are a register user of the {company}.</span></p></span>\r\n                </div>\r\n				<br />\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>	\r\n\r\n</td>\r\n                </tr>\r\n                <tr><td class="w640" width="640" height="60"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n	</tr>\r\n</tbody></table></body></html>', '', 2);
INSERT INTO `system_templates` (`id`, `name`, `link`, `text`, `emailText`, `tid`) VALUES
(65, 'Password Reset Notification', '', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">\r\n	<tbody><tr>\r\n		<td align="center" bgcolor="#ececec">\r\n        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">\r\n            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>\r\n                \r\n            	<tr>\r\n                	<td class="w640" width="640">\r\n                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n    <tbody><tr>\r\n        <td class="w15" width="15"></td>\r\n        <td class="w325" width="350" valign="middle" align="left">\r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n            \r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w30" width="30"></td>\r\n        <td class="w255" width="255" valign="middle" align="right">\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n            <table cellpadding="0" cellspacing="0" border="0">\r\n    <tbody><tr>\r\n        \r\n        \r\n        \r\n    </tr>\r\n</tbody></table>\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w15" width="15"></td>\r\n    </tr>\r\n</tbody></table>\r\n                        \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                <td id="header" class="w640" width="640" align="center" bgcolor="#425470">\r\n    \r\n    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center" id="headline">\r\n                    <p>\r\n                        <strong><singleline label="Title">Password reset notification</singleline></strong>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n    \r\n    \r\n</td>\r\n                </tr>\r\n                \r\n                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>\r\n                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">\r\n    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <repeater>\r\n                    \r\n                    <layout label="Text only">\r\n                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                            <tbody><tr>\r\n                                <td class="w580" width="580">\r\n                                    <p align="left" class="article-title"><singleline label="Title">Your password has been reset</singleline></p>\r\n                                    <div align="left" class="article-content">\r\n                                        <multiline label="Description">\r\n										<p>Please use the following login credentials to access the Intranet.</p>\r\n										<p>Please note it is highly recommended to change your password once logged in.</p>\r\n										<p>User name: <strong>{uname}</strong></p>\r\n										<p>Temporary password: <strong>{tpass}</strong></p>\r\n										<p>Go to the login page here:<a href="{link}">Login</a></p>\r\n										</multiline>\r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                            <tr><td class="w580" width="580" height="10"></td></tr>\r\n                        </tbody></table>\r\n                    </layout>\r\n                                        \r\n                    \r\n                    \r\n                </repeater>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n</td></tr>\r\n                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>\r\n                \r\n                <tr>\r\n                <td class="w640" width="640">\r\n				\r\n	\r\n<table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center">\r\n                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"><span>You are receiving this notification as you are a register user of the {company}.</span></p></span>\r\n                </div>\r\n				<br />\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>	\r\n\r\n</td>\r\n                </tr>\r\n                <tr><td class="w640" width="640" height="60"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n	</tr>\r\n</tbody></table></body></html>', '', 2),
(46, 'Bulletin Notice Mail Queue', '', 'Your bulletin notice has been successfully added to the mail queue.', '', 3),
(47, 'Credential Requires Approval', '', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">\r\n	<tbody><tr>\r\n		<td align="center" bgcolor="#ececec">\r\n        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">\r\n            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>\r\n                \r\n            	<tr>\r\n                	<td class="w640" width="640">\r\n                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n    <tbody><tr>\r\n        <td class="w15" width="15"></td>\r\n        <td class="w325" width="350" valign="middle" align="left">\r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n            \r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w30" width="30"></td>\r\n        <td class="w255" width="255" valign="middle" align="right">\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n            <table cellpadding="0" cellspacing="0" border="0">\r\n    <tbody><tr>\r\n        \r\n        \r\n        \r\n    </tr>\r\n</tbody></table>\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w15" width="15"></td>\r\n    </tr>\r\n</tbody></table>\r\n                        \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                <td id="header" class="w640" width="640" align="center" bgcolor="#425470">\r\n    \r\n    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center" id="headline">\r\n                    <p>\r\n                        <strong><singleline label="Title">Credential Approval Required</singleline></strong>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n    \r\n    \r\n</td>\r\n                </tr>\r\n                \r\n                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>\r\n                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">\r\n    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <repeater>\r\n                    \r\n                    <layout label="Text only">\r\n                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                            <tbody><tr>\r\n                                <td class="w580" width="580">\r\n                                    <div align="left" class="article-content">\r\n                                        <multiline label="Description">\r\n										<p>{user_name} has uploaded a new document(s) that require your approval.</p>\r\n										<div>\r\n<!--[if mso]>\r\n  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{link}" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="10%" stroke="f" fillcolor="#d62828">\r\n    <w:anchorlock/>\r\n    <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">\r\n      Button Text Here!\r\n    </center>\r\n  </v:roundrect>\r\n  <![endif]-->\r\n  <![if !mso]>\r\n  <table cellspacing="0" cellpadding="0"> <tr> \r\n  <td align="center" width="300" height="40" bgcolor="#d62828" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">\r\n    <a href="{link}" style="font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">\r\n    <span style="color: #ffffff;">\r\n      Approve Document(s)\r\n    </span>\r\n    </a>\r\n  </td> \r\n  </tr> </table> \r\n  <![endif]>\r\n</div>\r\n										</multiline>\r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                            <tr><td class="w580" width="580" height="10"></td></tr>\r\n                        </tbody></table>\r\n                    </layout>\r\n                                        \r\n                    \r\n                    \r\n                </repeater>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n</td></tr>\r\n                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>\r\n                \r\n                <tr>\r\n                <td class="w640" width="640">\r\n				\r\n	\r\n<table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center">\r\n                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"><span>You are receiving this notification as you are a register user of the {company}.</span></p></span>\r\n                </div>\r\n				<br />\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>	\r\n\r\n</td>\r\n                </tr>\r\n                <tr><td class="w640" width="640" height="60"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n	</tr>\r\n</tbody></table></body></html>', '', 2),
(48, 'Machine QA Successful', '', 'Thank you. You have successfully submitted the Machine QA.', '', 3),
(50, 'QA Audit Successful', '', 'Thank you. You have successfully submitted the QA Audit.', '', 3),
(51, 'QA Audit Submitted', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">{checklist_header}</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{results}</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">Comments</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{comments}</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				</td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the {company}.<br />\r\n                          <br />\r\n                          Copyright &copy; {year} {company}.</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '', 2),
(52, 'Terms and Conditions', '', '<h1>Terms &amp; Conditions of Use</h1>\r\n<h2>Introduction</h2>\r\n<p>The use of the Intranet service (the Intranet) is strictly bound by the terms and conditions as listed herein. All intranet users (users) are assumed to fully understand and accept the responsibilities of all terms and conditions on each occasion for which the user accesses the Intranet.</p>\r\n<p>By accessing the Intranet you agree and understand fully, all terms and conditions listed below. DO NOT proceed with accessing the Intranet should you disagree with any of the terms and conditions.</p>\r\n<h2>Access Rights</h2>\r\n<ol>\r\n  <li>Only staff under employment of the licence holder or her subsidiary companies (where licencing permits) may be granted access to the Intranet.</li>\r\n  <li>The Intranet administrator holds the final right to grant or deny access to the Intranet or portions of the Intranet to any staff without prior notice.</li>\r\n</ol>\r\n<h2>Intellectual Rights</h2>\r\n<ol>\r\n  <li>Unless otherwise specified in writing, the licence holder, holds the final intellectual rights to all materials contained within the Intranet.</li>\r\n  <li>Users may not use any material from the Intranet, either in part or in full, for purposes other than to carry out the user&rsquo;s job duties as specified in local policies.</li>\r\n  <li>When deemed appropriate, the licence holder may claim, from locations other than the Intranet, the intellectual rights to any information and/or materials originated either in part or in full from material(s) contained in the Intranet.</li>\r\n</ol>\r\n<h2>Information Securities</h2>\r\n<ol>\r\n  <li>The distributing, printing, capturing and sharing of any information from the Intranet with individual(s) other than authorised Intranet user(s) is strictly prohibited without prior approval.</li>\r\n  <li>Users are prohibited from the release of any user identification and password related to information about the Intranet to any individual other then the Intranet administrator.</li>\r\n  <li>All information and material contained within the Intranet is strictly bound for internal use only. Approval must be obtained prior to the release of any information to outside parties for the purpose of business or otherwise.</li>\r\n</ol>\r\n<h2>General Usage Regulations</h2>\r\n<ol>\r\n  <li>User should access and utilise the Intranet with common sense, goodwill and respect for others.</li>\r\n  <li>The use of any obscene, offensive, profane, sexism, racial and/or discriminating word(s) and/or phrase(s) are strictly prohibited. User(s) who commit such act(s) will face disciplinary action and possible criminal charges and/or termination of employment.</li>\r\n  <li>Users may not use the Intranet as a platform to spread, intended or otherwise, rumors and/or any unconfirmed information regarding any individual and/or any organisation and/or any government body.</li>\r\n</ol>\r\n<h2>Content Management</h2>\r\n<ol>\r\n  <li>The Intranet administrator holds the final decision to the posting or withdrawal of any content at any time without prior notice to the author/publisher.</li>\r\n  <li>When deemed necessary, the Intranet administrator may modify the content of any information and/or material within the Intranet, published or otherwise.</li>\r\n  <li>It is the user''s responsibility in ensuring the full content of submission are true, legal, and does not conflict with the local copyright or intellectual property law in any way.</li>\r\n</ol>', '', 3),
(53, 'Certificate Template AIR', '', '<style>\r\n.border { width: 100%; height: 100%; padding: 20px; text-align: center; border: 4px solid #1F497D; }\r\nh1 { color: #050D36; font-family: Baroque; font-size: 36pt; margin: 50px 0px 40px 0px; letter-spacing: 0.2pt; }\r\n.header-lt { display: block; width: 35%; text-align: left; float: left; }\r\n.header-rt { display: block; width: 35%; text-align: right; float: right; }\r\n.clear { clear: both; }\r\n.blue { color: #1CA1DA; font-style:italic; font-size: 16pt; margin: 30px 0px 10px 0px; }\r\n.highlight_name { color: #000; font-size: 16pt; margin: 0px; }\r\n.highlight { color: #000; font-size:16pt; margin: 10px 0px 30px 0px; }\r\n.signature { color: #000; font-size: 16pt; margin: 50px 0px 0px 0px; }\r\n.img_border { border: 2px solid #666; }\r\n\r\n.footer-rt { width: 229px; text-align: right; float: right; }\r\n\r\n</style>\r\n\r\n<body>\r\n<div class="border">\r\n<div class="clear"></div>\r\n<div class="header-lt"><img src="../_uploads/images/gosford-header-lt.png" border="0" width="435"></div><div class="header-rt"><img src="../_uploads/images/gosford-header-rt.png" border="0" width="326"></div>\r\n<div class="clear"></div>\r\n<img src="../_uploads/images/certificate-of-attendance.png" border="0" width="800">\r\n<div class="footer-rt"><img src="../_uploads/images/gosford-air-appellation.png" border="0" width="229"></div>\r\n<p class="blue">This certificate certifies that</p>\r\n<p class="highlight_name">{name}</p>\r\n<p class="blue">has attended</p>\r\n<p class="highlight">{event}</p>\r\n<p class="blue">on the</p>\r\n<p class="highlight">{date}</p>\r\n<p class="signature">Digitally signed by Kim Faulkner, RT Educator<br />Central Coast Cancer Centre, Gosford Hospital</p>\r\n</div>\r\n</body>', '', 44);
INSERT INTO `system_templates` (`id`, `name`, `link`, `text`, `emailText`, `tid`) VALUES
(54, 'Credential Approval Declined', '', '\r\n<p>\r\n	<meta content="width=320, target-densitydpi=device-dpi" name="viewport" />\r\n	<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }	</style>\r\n	<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></p>\r\n<table align="center" border="0" cellpadding="0" cellspacing="0" id="background-table" style="table-layout:fixed" width="100%">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" bgcolor="#ececec">\r\n				<table border="0" cellpadding="0" cellspacing="0" class="w640" style="margin:0 10px;" width="640">\r\n					<tbody>\r\n						<tr>\r\n							<td class="w640" height="20" width="640">\r\n								&nbsp;</td>\r\n						</tr>\r\n						<tr>\r\n							<td class="w640" width="640">\r\n								<table bgcolor="#425470" border="0" cellpadding="0" cellspacing="0" class="w640" id="top-bar" width="640">\r\n									<tbody>\r\n										<tr>\r\n											<td class="w15" width="15">\r\n												&nbsp;</td>\r\n											<td align="left" class="w325" valign="middle" width="350">\r\n												<table border="0" cellpadding="0" cellspacing="0" class="w325" width="350">\r\n													<tbody>\r\n														<tr>\r\n															<td class="w325" height="8" width="350">\r\n																&nbsp;</td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n												<table border="0" cellpadding="0" cellspacing="0" class="w325" width="350">\r\n													<tbody>\r\n														<tr>\r\n															<td class="w325" height="8" width="350">\r\n																&nbsp;</td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n											</td>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n											<td align="right" class="w255" valign="middle" width="255">\r\n												<table border="0" cellpadding="0" cellspacing="0" class="w255" width="255">\r\n													<tbody>\r\n														<tr>\r\n															<td class="w255" height="8" width="255">\r\n																&nbsp;</td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n												<table border="0" cellpadding="0" cellspacing="0">\r\n													<tbody>\r\n														<tr>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n												<table border="0" cellpadding="0" cellspacing="0" class="w255" width="255">\r\n													<tbody>\r\n														<tr>\r\n															<td class="w255" height="8" width="255">\r\n																&nbsp;</td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n											</td>\r\n											<td class="w15" width="15">\r\n												&nbsp;</td>\r\n										</tr>\r\n									</tbody>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align="center" bgcolor="#425470" class="w640" id="header" width="640">\r\n								<table border="0" cellpadding="0" cellspacing="0" class="w640" width="640">\r\n									<tbody>\r\n										<tr>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n											<td class="w580" height="30" width="580">\r\n												&nbsp;</td>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n										</tr>\r\n										<tr>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n											<td class="w580" width="580">\r\n												<div align="center" id="headline">\r\n													<p>\r\n														<strong><singleline label="Title">Credential has been declined</singleline></strong></p>\r\n												</div>\r\n											</td>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n										</tr>\r\n									</tbody>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#ffffff" class="w640" height="30" width="640">\r\n								&nbsp;</td>\r\n						</tr>\r\n						<tr id="simple-content-row">\r\n							<td bgcolor="#ffffff" class="w640" width="640">\r\n								<table align="left" border="0" cellpadding="0" cellspacing="0" class="w640" width="640">\r\n									<tbody>\r\n										<tr>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n											<td class="w580" width="580">\r\n												<repeater> <layout label="Text only">\r\n												<table border="0" cellpadding="0" cellspacing="0" class="w580" width="580">\r\n													<tbody>\r\n														<tr>\r\n															<td class="w580" width="580">\r\n																<p align="left" class="article-title">\r\n																	<singleline label="Title">{cred_name} declined for approval</singleline></p>\r\n																<div align="left" class="article-content">\r\n																	<multiline label="Description">\r\n																	<p>\r\n																		Dear {user},</p>\r\n																	<p>\r\n																		The credential {cred_name} submitted for approval has been declined. This is most likely due to either the wrong credential being added to the system or the date for the credential was entered incorrectly.</p>\r\n																	<p>\r\n																		Please check all details and resubmit and upload for approval.</p>\r\n																	</multiline></div>\r\n															</td>\r\n														</tr>\r\n														<tr>\r\n															<td class="w580" height="10" width="580">\r\n																&nbsp;</td>\r\n														</tr>\r\n													</tbody>\r\n												</table>\r\n												</layout> </repeater></td>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n										</tr>\r\n									</tbody>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td bgcolor="#ffffff" class="w640" height="15" width="640">\r\n								&nbsp;</td>\r\n						</tr>\r\n						<tr>\r\n							<td class="w640" width="640">\r\n								<table bgcolor="#425470" border="0" cellpadding="0" cellspacing="0" class="w640" id="footer" width="640">\r\n									<tbody>\r\n										<tr>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n											<td class="w580" height="30" width="580">\r\n												&nbsp;</td>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n										</tr>\r\n										<tr>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n											<td class="w580" width="580">\r\n												<div align="center">\r\n													<p align="left" class="footer-content-left" id="permission-reminder">\r\n														<span class="hide"><span>You are receiving this notification as you are a register user of the {company}.</span></span></p>\r\n												</div>\r\n											</td>\r\n											<td class="w30" width="30">\r\n												&nbsp;</td>\r\n										</tr>\r\n									</tbody>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class="w640" height="60" width="640">\r\n								&nbsp;</td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 2),
(55, 'Credential Approval Notice', '', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n/* Mobile-specific Styles */\r\n@media only screen and (max-width: 660px) { \r\ntable[class=w0], td[class=w0] { width: 0 !important; }\r\ntable[class=w10], td[class=w10], img[class=w10] { width:10px !important; }\r\ntable[class=w15], td[class=w15], img[class=w15] { width:5px !important; }\r\ntable[class=w30], td[class=w30], img[class=w30] { width:10px !important; }\r\ntable[class=w60], td[class=w60], img[class=w60] { width:10px !important; }\r\ntable[class=w125], td[class=w125], img[class=w125] { width:80px !important; }\r\ntable[class=w130], td[class=w130], img[class=w130] { width:55px !important; }\r\ntable[class=w140], td[class=w140], img[class=w140] { width:90px !important; }\r\ntable[class=w160], td[class=w160], img[class=w160] { width:180px !important; }\r\ntable[class=w170], td[class=w170], img[class=w170] { width:100px !important; }\r\ntable[class=w180], td[class=w180], img[class=w180] { width:80px !important; }\r\ntable[class=w195], td[class=w195], img[class=w195] { width:80px !important; }\r\ntable[class=w220], td[class=w220], img[class=w220] { width:80px !important; }\r\ntable[class=w240], td[class=w240], img[class=w240] { width:180px !important; }\r\ntable[class=w255], td[class=w255], img[class=w255] { width:185px !important; }\r\ntable[class=w275], td[class=w275], img[class=w275] { width:135px !important; }\r\ntable[class=w280], td[class=w280], img[class=w280] { width:135px !important; }\r\ntable[class=w300], td[class=w300], img[class=w300] { width:140px !important; }\r\ntable[class=w325], td[class=w325], img[class=w325] { width:95px !important; }\r\ntable[class=w360], td[class=w360], img[class=w360] { width:140px !important; }\r\ntable[class=w410], td[class=w410], img[class=w410] { width:180px !important; }\r\ntable[class=w470], td[class=w470], img[class=w470] { width:200px !important; }\r\ntable[class=w580], td[class=w580], img[class=w580] { width:280px !important; }\r\ntable[class=w640], td[class=w640], img[class=w640] { width:300px !important; }\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }\r\ntable[class=h0], td[class=h0] { height: 0 !important; }\r\np[class=footer-content-left] { text-align: center !important; }\r\n#headline p { font-size: 30px !important; }\r\n.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }\r\n.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}\r\nimg { height: auto; line-height: 100%;}\r\n } \r\n/* Client-specific Styles */\r\n#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */\r\nbody { width: 100% !important; }\r\n.ReadMsgBody { width: 100%; }\r\n.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */\r\n/* Reset Styles */\r\n/* Add 100px so mobile switch bar doesn''t cover street address. */\r\nbody { background-color: #ececec; margin: 0; padding: 0; }\r\nimg { outline: none; text-decoration: none; display: block;}\r\nbr, strong br, b br, em br, i br { line-height:100%; }\r\nh1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }\r\nh1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }\r\n/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */\r\nh1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }\r\n/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  \r\ntable td, table tr { border-collapse: collapse; }\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\ncolor: black; text-decoration: none !important; border-bottom: none !important; background: none !important;\r\n}	/* Body text color for the New Yahoo.  This example sets the font of Yahoo''s Shortcuts to black. */\r\n/* This most probably won''t work in all email clients. Don''t include code blocks in email. */\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table { background-color: #ececec; }\r\n/* Webkit Elements */\r\n#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #556c90; color: #d9fffd; }\r\n#top-bar a { font-weight: bold; color: #d9fffd; text-decoration: none;}\r\n#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }\r\n/* Fonts and Content */\r\nbody, td { font-family: HelveticaNeue, sans-serif; }\r\n.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }\r\n/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */\r\n.header-content { font-size: 12px; color: #d9fffd; }\r\n.header-content a { font-weight: bold; color: #d9fffd; text-decoration: none; }\r\n#headline p { color: #d9fffd; font-family: HelveticaNeue, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }\r\n#headline p a { color: #d9fffd; text-decoration: none; }\r\n.article-title { font-size: 18px; line-height:24px; color: #c25130; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-title a { color: #c25130; text-decoration: none; }\r\n.article-title.with-meta {margin-bottom: 0;}\r\n.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}\r\n.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: HelveticaNeue, sans-serif; }\r\n.article-content a { color: #3f6569; font-weight:bold; text-decoration:none; }\r\n.article-content img { max-width: 100% }\r\n.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }\r\n.article-content li { font-size: 13px; line-height: 18px; color: #444444; }\r\n.article-content li a { color: #3f6569; text-decoration:underline; }\r\n.article-content p {margin-bottom: 15px;}\r\n.footer-content-left { font-size: 12px; line-height: 15px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-left a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n.footer-content-right { font-size: 11px; line-height: 16px; color: #d9fffd; margin-top: 0px; margin-bottom: 15px; }\r\n.footer-content-right a { color: #d9fffd; font-weight: bold; text-decoration: none; }\r\n#footer { background-color: #425470; color: #d9fffd; }\r\n#footer a { color: #d9fffd; text-decoration: none; font-weight: bold; }\r\n#permission-reminder { white-space: normal; }\r\n#street-address { color: #d9fffd; white-space: normal; }\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="434" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px;\r\n   padding: 0;\r\n   list-style-position: inside;\r\n}\r\n</style>\r\n<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">\r\n	<tbody><tr>\r\n		<td align="center" bgcolor="#ececec">\r\n        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">\r\n            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>\r\n                \r\n            	<tr>\r\n                	<td class="w640" width="640">\r\n                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n    <tbody><tr>\r\n        <td class="w15" width="15"></td>\r\n        <td class="w325" width="350" valign="middle" align="left">\r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n            \r\n            <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w325" width="350" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w30" width="30"></td>\r\n        <td class="w255" width="255" valign="middle" align="right">\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n            <table cellpadding="0" cellspacing="0" border="0">\r\n    <tbody><tr>\r\n        \r\n        \r\n        \r\n    </tr>\r\n</tbody></table>\r\n            <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                <tbody><tr><td class="w255" width="255" height="8"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n        <td class="w15" width="15"></td>\r\n    </tr>\r\n</tbody></table>\r\n                        \r\n                    </td>\r\n                </tr>\r\n                <tr>\r\n                <td id="header" class="w640" width="640" align="center" bgcolor="#425470">\r\n    \r\n    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center" id="headline">\r\n                    <p>\r\n                        <strong><singleline label="Title">Credential  Approved</singleline></strong>\r\n                    </p>\r\n                </div>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n    \r\n    \r\n</td>\r\n                </tr>\r\n                \r\n                <tr><td class="w640" width="640" height="30" bgcolor="#ffffff"></td></tr>\r\n                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">\r\n    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n        <tbody><tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <repeater>\r\n                    \r\n                    <layout label="Text only">\r\n                        <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                            <tbody><tr>\r\n                                <td class="w580" width="580">\r\n                                    <p align="left" class="article-title"><singleline label="Title">{cred_name} Approved</singleline></p>\r\n                                    <div align="left" class="article-content">\r\n                                        <multiline label="Description">\r\n										<p>Dear {user}, </p>\r\n										<p>The credential {cred_name} has been successfully approved </p>.\r\n										</multiline>\r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                            <tr><td class="w580" width="580" height="10"></td></tr>\r\n                        </tbody></table>\r\n                    </layout>\r\n                                        \r\n                    \r\n                    \r\n                </repeater>\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>\r\n</td></tr>\r\n                <tr><td class="w640" width="640" height="15" bgcolor="#ffffff"></td></tr>\r\n                \r\n                <tr>\r\n                <td class="w640" width="640">\r\n				\r\n	\r\n<table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#425470">\r\n        <tbody><tr><td class="w30" width="30"></td><td class="w580" width="580" height="30"></td><td class="w30" width="30"></td></tr>\r\n        <tr>\r\n            <td class="w30" width="30"></td>\r\n            <td class="w580" width="580">\r\n                <div align="center">\r\n                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left"><span>You are receiving this notification as you are a register user of the {company}.</span></p></span>\r\n                </div>\r\n				<br />\r\n            </td>\r\n            <td class="w30" width="30"></td>\r\n        </tr>\r\n    </tbody></table>	\r\n\r\n</td>\r\n                </tr>\r\n                <tr><td class="w640" width="640" height="60"></td></tr>\r\n            </tbody></table>\r\n        </td>\r\n	</tr>\r\n</tbody></table></body></html>', '', 2),
(58, 'Related document assigned', '', 'Related document assigned: ', '', 3),
(59, 'Related document un-assigned', '', 'Related document un-assigned: ', '', 3),
(60, 'Read acknowledgement', '', 'Read acknowledgement submitted for: ', '', 3),
(61, 'Read request recorded', '', 'Your read acknowledgement has been recorded.', '', 3),
(56, 'General Fault Submitted', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">{checklist_header}</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{results}</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view th fault details please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{link}</p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the {company}.<br />\r\n                          <br />\r\n                          Copyright &copy; {year} {company}.</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '', 2),
(57, 'Lock Out Mode', '', 'Limitations have been applied to this software as Lockout mode has been activated.', '', 3),
(63, 'Document update notification', '', 'Document update notification sent to: ', '', 3),
(64, 'Notification not sent', '', 'Notification not sent as notification groups not specified.', '', 3),
(66, 'Document/Folder created', '', 'Document/Folder created', '', 3),
(67, 'Document Alterations', '', 'Alterations have been made to: ', '', 3),
(69, 'Document link added', '', 'Document link added: ', '', 3),
(70, 'Document link removed', '', 'Document link removed: ', '', 3),
(49, 'Machine QA Submitted', '', '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">\r\n<html>\r\n<head>\r\n<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />\r\n<title>Topaz Email Notification</title>\r\n<style type="text/css">\r\na:hover { color: #09F !important; text-decoration: underline !important; }\r\na:hover#vw { background-color: #CCC !important; text-decoration: none !important; color:#000 !important; }\r\na:hover#ff { background-color: #6CF !important; text-decoration: none !important; color:#FFF !important; }\r\n</style>\r\n</head>\r\n<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #FFFFFF;" bgcolor="#FFFFFF" leftmargin="0">\r\n<!--100% body table-->\r\n<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#FFFFFF">\r\n  <tr>\r\n    <td><!--email container-->\r\n      <table cellspacing="0" border="0" align="center" cellpadding="0" width="624">\r\n        <tr>\r\n          <td><!--header-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td valign="top" height="12"></td>\r\n              </tr>\r\n              <tr>\r\n                <td valign="top"><h1 style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;">{checklist_header}</h1></td>\r\n              </tr>\r\n            </table>\r\n            <!--header-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 1-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">The QA resulted in a <span style="font-weight:bold;">{pass}%</span> pass percentage of required fields.</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{results}</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">Comments</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{comments}</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">&nbsp;</p>\r\n				\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">To view the QA results please follow the link below:</p>\r\n				<p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">{link}</p></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 1-->\r\n            <!--line break-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td height="30" valign="middle" width="624"></td>\r\n              </tr>\r\n            </table>\r\n            <!--/line break-->\r\n            <!--section 3-->\r\n            <table cellspacing="0" border="0" cellpadding="0" width="624">\r\n              <tr>\r\n                <td><table cellspacing="0" border="0" cellpadding="0" width="624">\r\n                    <tr>\r\n                      <td valign="top"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, ''Times New Roman'', Times, serif; color: #333; margin: 0px;">You are receiving this notification as you are a register user of the {company} Intranet System, Topaz.<br />\r\n                          <br />\r\n                          Copyright &copy; {year} {company}.</p></td>\r\n                    </tr>\r\n                  </table></td>\r\n              </tr>\r\n            </table>\r\n            <!--/section 3-->\r\n          </td>\r\n        </tr>\r\n      </table>\r\n      <!--email container-->\r\n    </td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_templates_ext`
--

CREATE TABLE IF NOT EXISTS `system_templates_ext` (
  `id` int(3) NOT NULL,
  `stid` int(4) NOT NULL,
  `dtid` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_templates_ext`
--

INSERT INTO `system_templates_ext` (`id`, `stid`, `dtid`) VALUES
(18, 29, 107),
(17, 29, 106),
(6, 41, 37),
(9, 2, 15),
(19, 29, 104),
(16, 29, 105),
(20, 29, 112),
(21, 29, 115);

-- --------------------------------------------------------

--
-- Table structure for table `type_list`
--

CREATE TABLE IF NOT EXISTS `type_list` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `group` varchar(10) NOT NULL,
  `custom` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_list`
--

INSERT INTO `type_list` (`id`, `name`, `group`, `custom`) VALUES
(1, 'System Template', 'systemp', ''),
(2, 'Email Template', 'systemp', ''),
(3, 'System Message', 'systemp', ''),
(4, 'Rights', 'user_right', ''),
(5, 'Mail', 'user_right', ''),
(6, 'System Module', 'module', ''),
(7, 'Console Module', 'module', ''),
(111, 'Front Office', 'locations', ''),
(109, 'Theatre', 'locations', ''),
(15, 'Wiki Page', 'doc_type', ''),
(108, 'In-Progress', 'mach_stat', ''),
(17, 'EPA Licence', 'cred_type', 'no'),
(29, 'NSQHS', 'ref', ''),
(30, 'General Announcement', 'bulletin', ''),
(31, 'Urgent Notification', 'bulletin', ''),
(32, 'In-Service', 'edu_typ', 'C880FF'),
(33, 'Course/Training', 'edu_typ', '08B5FF'),
(45, 'Machine QA', 'mail_grp', ''),
(37, 'Folder', 'doc_type', ''),
(39, 'Slide', 'sld_typ', ''),
(40, 'Question Block', 'sld_typ', ''),
(41, 'Conference/Event', 'edu_typ', 'B3FF00'),
(42, 'Gamma Knife', 'mach_type', ''),
(43, 'CT', 'mach_type', ''),
(44, 'Certificate Template', 'systemp', ''),
(48, 'Other', 'mach_type', ''),
(130, 'Sydney', 'units', ''),
(104, 'Protocol', 'doc_type', ''),
(105, 'Procedure', 'doc_type', ''),
(106, 'Policy', 'doc_type', ''),
(107, 'Form', 'doc_type', ''),
(100, 'Open', 'mach_stat', ''),
(101, 'Closed', 'mach_stat', ''),
(102, 'Demonstration', 'edu_typ', 'FFC60A'),
(103, 'Ongoing', 'mach_stat', ''),
(112, 'MSDS', 'doc_type', ''),
(114, 'Perth', 'units', ''),
(115, 'Resource', 'doc_type', ''),
(117, 'QA Audits', 'qa_type', 'QA Audits'),
(118, 'RT QA Audit', 'qa_type', 'RT QA Audits'),
(119, 'Quality Improvement', 'chkl_type', 'Quality Improvement'),
(120, 'Incident Checklist', 'chkl_type', 'Incident Checklist'),
(121, 'General Faults', 'chkl_type', 'General Faults'),
(122, 'Machine Faults', 'chkl_type', 'Machine Faults'),
(124, 'AHPRA', 'cred_type', 'no'),
(131, 'Feedback', 'chkl_type', ''),
(132, 'View Active Audit', 'user_p', 'view-active-audit'),
(133, 'View Active Checklist', 'user_p', 'view-active-checklist'),
(134, 'View Active Documents', 'user_p', 'view-active-documents'),
(135, 'View Active Machine QA', 'user_p', 'view-active-machineqa'),
(136, 'View Active Machine List', 'user_p', 'view-active-machinelist'),
(137, 'View Active Users', 'user_p', 'view-active-users'),
(149, 'AHPRA', 'links', 'https://www.ahpra.gov.au/'),
(154, 'View Active Reports', 'user_p', 'view-active-reports');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` char(60) NOT NULL,
  `changepass` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `email`, `pass`, `changepass`, `active`) VALUES
(1, 'sysadmin', 'adam@imtservices.com.au', '$2a$09$c2iFbCaYMZwuOoMmg38FJ.qYPIJk8aZqjRdzp.GaqhG9NHi1g4gv6', 0, 1),
(74, 'imtservices', 'adam@imtservices.com.au', '$2a$09$2y5Qa/y38IiVRjIaFirtouVW5iVhFG8ztkhTv3Ia1yNkZMuYtvKcK', 1, 1),
(75, 'demoadmin', 'admin@demo.com', '$2a$09$W4sVAauL5080yEQccI90MetdAcJwuuadqbrBBtcKjNOldKLuXLNRu', 0, 1),
(76, 'westh', 'Harrison.west@health.nsw.gov.au', '$2a$09$tktBtHMLHo0lXA/UQ7iEaeonlwPqprUslik52t.P2LZIeRuG9vAxq', 0, 1),
(77, 'kellyt', 'toni.kelly@healh.nsw.gov.au', '$2a$09$co/KDDyjRPhY8lAxEcPPP.p.g.vzzyND9uXn5UUYv2ZWUXsWLtE8O', 0, 1),
(78, 'dixonj', 'justin.dixon@health.nsw.gov.au', '$2a$09$Q0sIfD91rvjn5itifeSLIOwyud5ngCM6HVm9ND9Tez8bTBEgbpxU2', 0, 1),
(79, 'Csmith', 'chelsea.smith@health.nsw.gov', '$2a$09$UsphjzVbN/wA8.GJZGJtKeYEGqP9o1IwE7Tc8LYUbV63NzFAEX73u', 0, 0),
(80, 'Kmurray', 'Kate.Murray@health.nsw.gov.au', '$2a$09$9a6EJTohadLrR1NVqFvJIOcYVXz2CEE24C61FO5QXmACkkD7ojSYG', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE IF NOT EXISTS `user_comments` (
  `id` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `cuid` int(10) NOT NULL,
  `comment` text NOT NULL,
  `resolution` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_comments`
--

INSERT INTO `user_comments` (`id`, `uid`, `date`, `cuid`, `comment`, `resolution`) VALUES
(1, 76, '2019-07-30 14:06:32', 75, '<p>\r\n	Best in the west</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE IF NOT EXISTS `user_credentials` (
  `id` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `tid` int(3) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `name` varchar(200) NOT NULL,
  `app` varchar(64) NOT NULL,
  `link` varchar(200) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0',
  `app_uid` int(10) NOT NULL,
  `app_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `uid`, `tid`, `date`, `name`, `app`, `link`, `archive`, `app_uid`, `app_date`) VALUES
(3, 76, 17, '2019-09-20', '', '', '2JFl4bslvD0u2TEo2sUKaF.pdf', 0, 75, '2019-08-15 12:36:31'),
(4, 76, 124, '2019-08-15', '', '0FW0aW2yCMwEV6zseRhp0j', 'eEIZNry7s18sWJoD35qZd.pdf', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_education`
--

CREATE TABLE IF NOT EXISTS `user_education` (
  `id` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `ins_date_id` int(11) NOT NULL,
  `conf_date_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_education`
--

INSERT INTO `user_education` (`id`, `uid`, `ins_date_id`, `conf_date_id`, `rating`, `feedback`) VALUES
(1, 75, 0, 0, 0, ''),
(2, 76, 0, 0, 0, ''),
(3, 76, 2, 0, 0, 'zxc'),
(4, 76, 7, 0, 0, 'asd'),
(5, 76, 9, 0, 2, 'youre bad'),
(6, 76, 0, 0, 0, ''),
(7, 1, 0, 0, 0, ''),
(8, 74, 2, 0, 0, ''),
(9, 75, 2, 0, 0, ''),
(10, 78, 10, 0, 0, ''),
(11, 74, 3, 0, 0, ''),
(12, 76, 13, 0, 0, ''),
(13, 78, 13, 0, 0, ''),
(14, 77, 13, 0, 0, ''),
(15, 80, 13, 0, 0, ''),
(16, 77, 3, 0, 0, ''),
(17, 76, 3, 0, 0, ''),
(18, 74, 0, 3, 0, ''),
(19, 76, 0, 3, 0, ''),
(20, 74, 4, 0, 0, ''),
(21, 74, 0, 2, 0, ''),
(22, 78, 0, 2, 0, ''),
(23, 74, 13, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_education_ext`
--

CREATE TABLE IF NOT EXISTS `user_education_ext` (
  `id` int(11) NOT NULL,
  `ueid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `credits` varchar(5) NOT NULL,
  `certificate` varchar(300) NOT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `q4` text NOT NULL,
  `q5` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_education_ext`
--

INSERT INTO `user_education_ext` (`id`, `ueid`, `name`, `date_start`, `date_end`, `credits`, `certificate`, `q1`, `q2`, `q3`, `q4`, `q5`) VALUES
(1, 1, 'Test01', '2019-07-15 11:56:00', '2019-07-15 11:56:00', '2', '', '', '', '', '', ''),
(2, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'asd', 'asd', 'asd', 'asd', ''),
(3, 3, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'zxc', 'zxc', 'zxc', 'zxc', ''),
(4, 4, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'asd', 'asdeasd', 'asd', 'asd', ''),
(5, 5, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'k', 'asd', 'asd', 'asd', ''),
(6, 6, 'I read article', '2019-08-31 12:03:00', '2019-08-31 13:03:00', '100', '', 'asd', 'asd', 'asd', 'asd', 'asdf '),
(7, 7, 'Test', '2020-05-12 07:28:00', '2020-05-12 07:28:00', '1', '', 'Test', 'test', 'Test', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `user_ext`
--

CREATE TABLE IF NOT EXISTS `user_ext` (
  `uid` varchar(10) NOT NULL,
  `tapandlearn` varchar(120) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `title` varchar(200) NOT NULL,
  `terms_accept` int(1) NOT NULL,
  `key` varchar(200) NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_ext`
--

INSERT INTO `user_ext` (`uid`, `tapandlearn`, `fname`, `lname`, `phone`, `mobile`, `title`, `terms_accept`, `key`, `unit`) VALUES
('1', '', 'Systems', 'Administrator', '', '', 'Systems Administrator', 1, '', '0'),
('74', '', 'Adam', 'Heaney', '', '', 'Support', 0, '', '0'),
('75', '', 'Demo', 'Admin', '', '', 'Demo Admin', 1, '', '0'),
('76', '', 'Harrison', 'West', '', '', 'Radiation therapist level 2', 1, '', '130'),
('77', '', 'Toni ', 'Kelly', '', '0412877913', 'RT Educator', 1, '', '130'),
('78', '', 'Justin', 'Dixon', '', '', 'Site Manager', 1, '', '0'),
('79', '', 'Chelsea', 'Smith', '', '', 'Radiation Therapist', 0, '', '0'),
('80', '', 'Kate', 'Murray', '', '', 'RT', 1, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `rid` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `uid`, `rid`) VALUES
(253, 1, 44),
(169, 74, 38),
(167, 74, 1),
(168, 74, 37),
(171, 75, 39),
(172, 75, 37),
(217, 79, 42),
(190, 77, 39),
(189, 77, 1),
(178, 78, 1),
(179, 78, 39),
(239, 76, 40),
(240, 76, 41),
(238, 76, 39),
(241, 76, 42),
(191, 77, 40),
(194, 77, 41),
(195, 77, 42),
(196, 77, 43),
(216, 79, 41),
(218, 79, 43),
(214, 79, 40),
(215, 79, 44),
(244, 80, 39),
(242, 76, 43),
(237, 76, 1),
(243, 76, 46),
(245, 80, 40),
(246, 80, 44),
(254, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_managers`
--

CREATE TABLE IF NOT EXISTS `user_managers` (
  `mid` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_managers`
--

INSERT INTO `user_managers` (`mid`, `uid`) VALUES
(78, 76);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE IF NOT EXISTS `user_notifications` (
  `id` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `tid` int(100) NOT NULL,
  `refid` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `uid`, `tid`, `refid`) VALUES
(20, 74, 42, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `tid` int(100) NOT NULL,
  `value` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_preferences`
--

INSERT INTO `user_preferences` (`id`, `uid`, `tid`, `value`) VALUES
(5, 1, 132, '0'),
(6, 1, 133, '0'),
(7, 1, 134, '0'),
(8, 1, 135, '0'),
(9, 1, 136, '1'),
(10, 1, 137, '1'),
(11, 1, 154, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE IF NOT EXISTS `user_rights` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tid` int(3) NOT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `sys_admin` int(1) NOT NULL DEFAULT '0',
  `gen_admin` int(1) NOT NULL DEFAULT '0',
  `delete` int(1) NOT NULL DEFAULT '0',
  `add_user` int(1) NOT NULL DEFAULT '0',
  `edit_user` int(1) NOT NULL DEFAULT '0',
  `add_group` int(1) NOT NULL DEFAULT '0',
  `edit_group` int(1) NOT NULL DEFAULT '0',
  `view_users` int(1) NOT NULL DEFAULT '0',
  `view_groups` int(1) NOT NULL DEFAULT '0',
  `view_rights` int(1) NOT NULL DEFAULT '0',
  `radiation` int(1) NOT NULL DEFAULT '0',
  `view_radiation` int(1) NOT NULL DEFAULT '0',
  `add_radiation` int(1) NOT NULL DEFAULT '0',
  `delete_radiation` int(1) NOT NULL DEFAULT '0',
  `view_credentials` int(1) NOT NULL DEFAULT '0',
  `add_credentials` int(1) NOT NULL DEFAULT '0',
  `approve_credentials` int(1) NOT NULL DEFAULT '0',
  `edit_documents` int(1) NOT NULL DEFAULT '0',
  `edit_document_privacy` int(1) NOT NULL DEFAULT '0',
  `collaborate` int(1) NOT NULL DEFAULT '0',
  `view_bulletins` int(1) NOT NULL DEFAULT '0',
  `add_bulletins` int(1) NOT NULL DEFAULT '0',
  `view_education` int(1) NOT NULL DEFAULT '0',
  `edit_education` int(1) NOT NULL DEFAULT '0',
  `add_education` int(1) NOT NULL DEFAULT '0',
  `view_machines` int(1) NOT NULL DEFAULT '0',
  `add_machines` int(1) NOT NULL DEFAULT '0',
  `edit_machines` int(1) NOT NULL DEFAULT '0',
  `view_machine_qa` int(1) NOT NULL DEFAULT '0',
  `add_machine_qa` int(1) NOT NULL DEFAULT '0',
  `edit_machine_qa` int(1) NOT NULL DEFAULT '0',
  `view_machine_qa_records` int(1) NOT NULL DEFAULT '0',
  `submit_machine_qa` int(1) NOT NULL DEFAULT '0',
  `add_qa_audit_records` int(1) NOT NULL DEFAULT '0',
  `edit_qa_audit_records` int(1) NOT NULL DEFAULT '0',
  `view_qa_audit_records` int(1) NOT NULL DEFAULT '0',
  `submit_qa_audits` int(1) NOT NULL DEFAULT '0',
  `add_faults` int(1) NOT NULL DEFAULT '0',
  `edit_faults` int(1) NOT NULL DEFAULT '0',
  `view_faults` int(1) NOT NULL DEFAULT '0',
  `submit_faults` int(1) NOT NULL DEFAULT '0',
  `close_faults` int(1) NOT NULL DEFAULT '0',
  `view_reports` int(1) NOT NULL DEFAULT '0',
  `add_rt_qa_audits` int(1) NOT NULL DEFAULT '0',
  `edit_rt_qa_audits` int(1) NOT NULL DEFAULT '0',
  `view_rt_qa_audits` int(1) NOT NULL DEFAULT '0',
  `submit_rt_qa_audits` int(1) NOT NULL DEFAULT '0',
  `add_qi` int(1) NOT NULL DEFAULT '0',
  `edit_qi` int(1) NOT NULL DEFAULT '0',
  `view_qi` int(1) NOT NULL DEFAULT '0',
  `submit_qi` int(1) NOT NULL DEFAULT '0',
  `close_qi` int(1) NOT NULL DEFAULT '0',
  `update_unit` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `name`, `tid`, `default`, `sys_admin`, `gen_admin`, `delete`, `add_user`, `edit_user`, `add_group`, `edit_group`, `view_users`, `view_groups`, `view_rights`, `radiation`, `view_radiation`, `add_radiation`, `delete_radiation`, `view_credentials`, `add_credentials`, `approve_credentials`, `edit_documents`, `edit_document_privacy`, `collaborate`, `view_bulletins`, `add_bulletins`, `view_education`, `edit_education`, `add_education`, `view_machines`, `add_machines`, `edit_machines`, `view_machine_qa`, `add_machine_qa`, `edit_machine_qa`, `view_machine_qa_records`, `submit_machine_qa`, `add_qa_audit_records`, `edit_qa_audit_records`, `view_qa_audit_records`, `submit_qa_audits`, `add_faults`, `edit_faults`, `view_faults`, `submit_faults`, `close_faults`, `view_reports`, `add_rt_qa_audits`, `edit_rt_qa_audits`, `view_rt_qa_audits`, `submit_rt_qa_audits`, `add_qi`, `edit_qi`, `view_qi`, `submit_qi`, `close_qi`, `update_unit`) VALUES
(1, 'Systems Administrator', 4, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(38, 'QA Audits', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(37, 'Machine Faults', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 'General Administrator', 4, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(40, 'General RT', 4, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(41, 'Prostate', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 'SRS', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 'New Equipment', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 'senior RT', 4, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 'All RT', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 'Senior RT', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 'RT Audits', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights_ext`
--

CREATE TABLE IF NOT EXISTS `user_rights_ext` (
  `id` int(11) NOT NULL,
  `rid` int(3) NOT NULL,
  `tid` int(3) NOT NULL,
  `reqd` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights_ext`
--

INSERT INTO `user_rights_ext` (`id`, `rid`, `tid`, `reqd`) VALUES
(35, 37, 45, 1),
(32, 48, 118, 1),
(16, 40, 17, 1),
(17, 40, 124, 1),
(38, 44, 124, 1),
(37, 44, 17, 1),
(31, 38, 117, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_rights_pages`
--

CREATE TABLE IF NOT EXISTS `user_rights_pages` (
  `id` int(11) NOT NULL,
  `urid` int(11) NOT NULL,
  `did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE IF NOT EXISTS `user_sessions` (
  `session_id` varchar(300) NOT NULL,
  `uid` int(10) NOT NULL,
  `session_exp` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`session_id`, `uid`, `session_exp`) VALUES
('4f7de7c191de5fe724b1c4225134eb4f', 74, '2020-05-12 07:38:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_events`
--
ALTER TABLE `audit_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `document_events`
--
ALTER TABLE `document_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `did` (`did`,`uid`,`eid`);

--
-- Indexes for table `document_links`
--
ALTER TABLE `document_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `document_properties`
--
ALTER TABLE `document_properties`
  ADD KEY `did` (`did`,`active`),
  ADD KEY `lock` (`lock`),
  ADD FULLTEXT KEY `Docsearch` (`name`,`link`);

--
-- Indexes for table `document_properties_ext`
--
ALTER TABLE `document_properties_ext`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `document_reads`
--
ALTER TABLE `document_reads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_search`
--
ALTER TABLE `document_search`
  ADD FULLTEXT KEY `document_search` (`keywords`,`gentext`);

--
-- Indexes for table `document_tree`
--
ALTER TABLE `document_tree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`,`rgt`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `education_certificates`
--
ALTER TABLE `education_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_conf`
--
ALTER TABLE `education_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_ins`
--
ALTER TABLE `education_ins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_qa_checklist`
--
ALTER TABLE `machine_qa_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `machine_qa_checklist_ext`
--
ALTER TABLE `machine_qa_checklist_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`,`uid`);

--
-- Indexes for table `machine_qa_checklist_q`
--
ALTER TABLE `machine_qa_checklist_q`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ceid` (`ceid`);

--
-- Indexes for table `machine_qa_responses`
--
ALTER TABLE `machine_qa_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ceid` (`ceid`,`uid`);

--
-- Indexes for table `machine_qa_responses_ext`
--
ALTER TABLE `machine_qa_responses_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`gid`),
  ADD KEY `cqid` (`cqid`);

--
-- Indexes for table `mail_queue`
--
ALTER TABLE `mail_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_checklist`
--
ALTER TABLE `qa_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_checklist_ext`
--
ALTER TABLE `qa_checklist_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`,`uid`);

--
-- Indexes for table `qa_checklist_q`
--
ALTER TABLE `qa_checklist_q`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ceid` (`ceid`);

--
-- Indexes for table `qa_responses`
--
ALTER TABLE `qa_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ceid` (`ceid`,`uid`);

--
-- Indexes for table `qa_responses_ext`
--
ALTER TABLE `qa_responses_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`gid`),
  ADD KEY `cqid` (`cqid`);

--
-- Indexes for table `qi`
--
ALTER TABLE `qi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `qi_ext`
--
ALTER TABLE `qi_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `qi_q`
--
ALTER TABLE `qi_q`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fid` (`feid`);

--
-- Indexes for table `qi_q_ext`
--
ALTER TABLE `qi_q_ext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qi_resolution_q`
--
ALTER TABLE `qi_resolution_q`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qi_resolution_q_ext`
--
ALTER TABLE `qi_resolution_q_ext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qi_responses`
--
ALTER TABLE `qi_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feid` (`feid`,`uid`),
  ADD FULLTEXT KEY `subject` (`subject`);
ALTER TABLE `qi_responses`
  ADD FULLTEXT KEY `comments` (`comments`);

--
-- Indexes for table `qi_responses_ext`
--
ALTER TABLE `qi_responses_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frid` (`frid`,`fqid`);

--
-- Indexes for table `radiation_manager`
--
ALTER TABLE `radiation_manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_ext`
--
ALTER TABLE `reports_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`,`uid`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `system_modules`
--
ALTER TABLE `system_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_templates`
--
ALTER TABLE `system_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_templates_ext`
--
ALTER TABLE `system_templates_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stid` (`stid`,`dtid`);

--
-- Indexes for table `type_list`
--
ALTER TABLE `type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`,`tid`);

--
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`,`ins_date_id`);

--
-- Indexes for table `user_education_ext`
--
ALTER TABLE `user_education_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `ueid` (`ueid`);

--
-- Indexes for table `user_ext`
--
ALTER TABLE `user_ext`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`,`rid`);

--
-- Indexes for table `user_managers`
--
ALTER TABLE `user_managers`
  ADD KEY `mid` (`mid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_preferences`
--
ALTER TABLE `user_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sys_admin` (`sys_admin`,`gen_admin`);

--
-- Indexes for table `user_rights_ext`
--
ALTER TABLE `user_rights_ext`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gid` (`rid`,`tid`,`reqd`);

--
-- Indexes for table `user_rights_pages`
--
ALTER TABLE `user_rights_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `urid` (`urid`),
  ADD KEY `did` (`did`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_events`
--
ALTER TABLE `audit_events`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=498;
--
-- AUTO_INCREMENT for table `document_events`
--
ALTER TABLE `document_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `document_links`
--
ALTER TABLE `document_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document_reads`
--
ALTER TABLE `document_reads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `document_tree`
--
ALTER TABLE `document_tree`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=904;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `education_certificates`
--
ALTER TABLE `education_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `education_conf`
--
ALTER TABLE `education_conf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `education_ins`
--
ALTER TABLE `education_ins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `machine_qa_checklist`
--
ALTER TABLE `machine_qa_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `machine_qa_checklist_ext`
--
ALTER TABLE `machine_qa_checklist_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `machine_qa_checklist_q`
--
ALTER TABLE `machine_qa_checklist_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `machine_qa_responses`
--
ALTER TABLE `machine_qa_responses`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `machine_qa_responses_ext`
--
ALTER TABLE `machine_qa_responses_ext`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `mail_queue`
--
ALTER TABLE `mail_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `qa_checklist`
--
ALTER TABLE `qa_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `qa_checklist_ext`
--
ALTER TABLE `qa_checklist_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `qa_checklist_q`
--
ALTER TABLE `qa_checklist_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1886;
--
-- AUTO_INCREMENT for table `qa_responses`
--
ALTER TABLE `qa_responses`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `qa_responses_ext`
--
ALTER TABLE `qa_responses_ext`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=259;
--
-- AUTO_INCREMENT for table `qi`
--
ALTER TABLE `qi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `qi_ext`
--
ALTER TABLE `qi_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `qi_q`
--
ALTER TABLE `qi_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `qi_q_ext`
--
ALTER TABLE `qi_q_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `qi_resolution_q`
--
ALTER TABLE `qi_resolution_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qi_resolution_q_ext`
--
ALTER TABLE `qi_resolution_q_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qi_responses`
--
ALTER TABLE `qi_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `qi_responses_ext`
--
ALTER TABLE `qi_responses_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `radiation_manager`
--
ALTER TABLE `radiation_manager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reports_ext`
--
ALTER TABLE `reports_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `system_modules`
--
ALTER TABLE `system_modules`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `system_templates`
--
ALTER TABLE `system_templates`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `system_templates_ext`
--
ALTER TABLE `system_templates_ext`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `type_list`
--
ALTER TABLE `type_list`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `user_comments`
--
ALTER TABLE `user_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_education`
--
ALTER TABLE `user_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user_education_ext`
--
ALTER TABLE `user_education_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user_preferences`
--
ALTER TABLE `user_preferences`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `user_rights_ext`
--
ALTER TABLE `user_rights_ext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user_rights_pages`
--
ALTER TABLE `user_rights_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
