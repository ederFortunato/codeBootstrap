-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 12/04/2012 às 18h48min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `projectbase`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acl_groups`
--

CREATE TABLE IF NOT EXISTS `acl_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleName` (`groupName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `acl_groups`
--

INSERT INTO `acl_groups` (`id`, `groupName`) VALUES
(1, 'Group root'),
(2, 'Group default');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acl_group_permission`
--

CREATE TABLE IF NOT EXISTS `acl_group_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `groupID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleID_2` (`groupID`,`permID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=166 ;

--
-- Extraindo dados da tabela `acl_group_permission`
--

INSERT INTO `acl_group_permission` (`id`, `groupID`, `permID`, `value`, `addDate`) VALUES
(168, 1, 65, 1, '2012-04-12 12:35:12'),
(167, 1, 64, 1, '2012-04-12 12:35:12'),
(166, 1, 63, 1, '2012-04-12 12:35:12'),
(165, 1, 62, 1, '2012-04-12 12:35:12'),
(164, 1, 59, 1, '2012-04-12 12:35:12'),
(163, 1, 58, 1, '2012-04-12 12:35:12'),
(162, 1, 57, 1, '2012-04-12 12:35:12'),
(161, 1, 56, 1, '2012-04-12 12:35:12'),
(160, 1, 55, 1, '2012-04-12 12:35:12'),
(159, 1, 54, 1, '2012-04-12 12:35:12'),
(158, 1, 53, 1, '2012-04-12 12:35:12'),
(157, 1, 52, 1, '2012-04-12 12:35:12'),
(156, 1, 51, 1, '2012-04-12 12:35:12'),
(155, 1, 50, 1, '2012-04-12 12:35:12'),
(154, 1, 49, 1, '2012-04-12 12:35:12'),
(153, 1, 48, 1, '2012-04-12 12:35:12'),
(152, 1, 47, 1, '2012-04-12 12:35:12'),
(151, 1, 46, 1, '2012-04-12 12:35:12'),
(150, 1, 45, 1, '2012-04-12 12:35:12'),
(149, 1, 44, 1, '2012-04-12 12:35:12'),
(148, 1, 39, 1, '2012-04-12 12:35:12'),
(148, 1, 66, 1, '2012-04-12 12:35:12'),
(148, 2, 66, 1, '2012-04-12 12:35:12'),
(148, 2, 65, 1, '2012-04-12 12:35:12'),
(148, 2, 64, 1, '2012-04-12 12:35:12'),
(148, 2, 63, 1, '2012-04-12 12:35:12'),
(148, 2, 62, 1, '2012-04-12 12:35:12'),
(148, 2, 39, 1, '2012-04-12 12:35:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acl_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parentID` bigint(20) NOT NULL,
  `permKey` varchar(30) NOT NULL,
  `permName` varchar(30) NOT NULL,
  `isMenu` tinyint(1) NOT NULL,
  `order` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permKey` (`permKey`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Extraindo dados da tabela `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `parentID`, `permKey`, `permName`, `isMenu`, `order`) VALUES
(39, 62, 'admin', 'Index do Admin', 1, 0),
(44, 0, 'acl', 'Access control', 1, 5),
(45, 44, 'acl/UsersProfile/add', 'Add User', 0, 0),
(46, 44, 'acl/UsersProfile/edit', 'Edit User', 0, 0),
(47, 44, 'acl/UsersProfile/remove', 'Remove User', 0, 0),
(48, 44, 'acl/UsersProfile/save', 'internal function', 0, 0),
(49, 44, 'acl/usersProfile', 'Users', 1, 0),
(50, 44, 'acl/permissions', 'Permissions', 1, 0),
(51, 44, 'acl/permissions/add', 'Add permission', 0, 0),
(52, 44, 'acl/permissions/edit', 'Edit permission', 0, 0),
(53, 44, 'acl/permissions/remove', 'Remove permission', 0, 0),
(54, 44, 'acl/permissions/save', 'internal function', 0, 0),
(55, 44, 'acl/groups', 'Groups', 1, 0),
(56, 44, 'acl/groups/add', 'Add group', 0, 0),
(57, 44, 'acl/groups/edit', 'Edit group', 0, 0),
(58, 44, 'acl/groups/remove', 'Remove group', 0, 0),
(59, 44, 'acl/groups/save', 'internal function', 0, 0),
(62, 0, 'home', 'home', 1, 0),
(63, 0, 'auth/change_email', 'Change Email', 0, 0),
(64, 0, 'auth/change_password', 'Change Password', 0, 0),
(65, 0, 'auth/unregister', 'Unregister', 0, 0),
(66, 0, 'auth/denial', 'Access Denial', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acl_user_group`
--

CREATE TABLE IF NOT EXISTS `acl_user_group` (
  `userID` bigint(20) NOT NULL,
  `groupID` bigint(20) NOT NULL,
  `addDate` datetime NOT NULL,
  UNIQUE KEY `userID` (`userID`,`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `acl_user_group`
--

INSERT INTO `acl_user_group` (`userID`, `groupID`, `addDate`) VALUES
(1, 1, '2012-04-12 10:26:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_login_attempts`
--

CREATE TABLE IF NOT EXISTS `auth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_users`
--

CREATE TABLE IF NOT EXISTS `auth_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `Username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `auth_users`
--

INSERT INTO `auth_users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, '', '$P$BBXYGFcDzmv5USWEYkgTH13r8OqbI..', 'root@root.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2012-04-12 11:57:02', '2012-03-28 15:50:08', '2012-04-12 14:57:02');
-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_user_autologin`
--

CREATE TABLE IF NOT EXISTS `auth_user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Estrutura da tabela `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `idade` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `auth_id`, `nome`, `idade`) VALUES
(1, 1, 'Root User', 18);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
