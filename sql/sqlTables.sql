
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2014 at 05:10 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a8154344_imd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblComments`
--

CREATE TABLE `tblComments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE latin1_general_ci NOT NULL,
  `firstName` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastName` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `postSubject` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `postMention` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tblComments`
--

INSERT INTO `tblComments` VALUES(1, 'Dit is een test of comments werken', 'Cedric', 'Bloem', 'Rich Media Applications', 'klacht');
INSERT INTO `tblComments` VALUES(3, 'Klopt, bah, ze stinken!!', 'Cedric', 'Bloem', 'De wc''s van de kruidtuin', 'klacht');
INSERT INTO `tblComments` VALUES(4, 'nog een test', 'Cedric', 'Bloem', 'Rich Media Applications', 'klacht');
INSERT INTO `tblComments` VALUES(5, 'Comment nummer 3', 'Cedric', 'Bloem', 'Rich Media Applications', 'klacht');
INSERT INTO `tblComments` VALUES(6, 'Dat vind ik ook.', 'Lars', 'Peeters', 'Rich Media Applications', 'klacht');
INSERT INTO `tblComments` VALUES(14, 'Commentje', 'Lars', 'Peeters', 'Rich Media Applications', 'klacht');
INSERT INTO `tblComments` VALUES(13, 'Ik vind dit niet verantwoordelijk!', 'Cedric', 'Bloem', 'Onduidelijk gebruik van media', 'klacht');
INSERT INTO `tblComments` VALUES(15, 'Hello world', 'Lars', 'Peeters', 'Design het uiterlijk', 'verbetering');
INSERT INTO `tblComments` VALUES(16, 'Lorem ipsum', 'Lars', 'Peeters', 'Rich Media Applications', 'klacht');
INSERT INTO `tblComments` VALUES(17, 'Lorem Ipsum', 'Lars', 'Peeters', 'Lorem Ipsum', 'verbetering');
INSERT INTO `tblComments` VALUES(18, 'Test op comments', 'Cedric', 'Bloem', 'De wc\\\\\\''s van de kruidtuin', 'klacht');
INSERT INTO `tblComments` VALUES(19, 'Lorem Ispum', 'Lars', 'Peeters', 'Onduidelijk gebruik van media', 'klacht');
INSERT INTO `tblComments` VALUES(20, 'test op comment', 'Cedric', 'Bloem', 'Test', 'verbetering');
INSERT INTO `tblComments` VALUES(21, 'veel tekst  veel tekst  veel tekst  veel tekst  veel tekst  veel tekst  veel tekst  veel tekst  veel tekst  veel tekst  veel tekst ', 'Cedric', 'Bloem', 'De wc\\\\\\''s van de kruidtuin', 'klacht');
INSERT INTO `tblComments` VALUES(22, 'Hopelijk word hier snel iets aangedaan.', 'Cedric', 'Bloem', 'De wcs  van de Kruidtuin', 'klacht');

-- --------------------------------------------------------

--
-- Table structure for table `tblPost`
--

CREATE TABLE `tblPost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mention` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `text` text COLLATE latin1_general_ci NOT NULL,
  `user_Id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Id_User_id_fk` (`user_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tblPost`
--

INSERT INTO `tblPost` VALUES(26, 'Eigen werk als decoratie', 'verbetering', 'Het zou fijn zijn moest er in onze gangen van de Kruidtuin wat meer decoratie zijn van de IMD. Dit zouden dan werken zijn die de studenten gemaakt hebben.', 9);
INSERT INTO `tblPost` VALUES(27, 'Rich Media Applications', 'klacht', 'Er word veel te weinig uitleg gegeven tijdens dit vak. We krijgen wat basis, en daar moeten we verder mee kunnen. Zelfstudie is met dit vak is heel moeilijk aangezien we amper informatie over Flex vinden op het internet.', 9);
INSERT INTO `tblPost` VALUES(28, 'Onduidelijk gebruik van media', 'klacht', 'Samen met verschillende leerlingen merken we dat het communicatie kanaal tussen ons en de docent niet geheel duidelijk is. Soms moeten we op Facebook kijken, dan weer op Toledo, dan weer op mail. En omdat we het zo gewoon zijn om op Facebook te kijken, vergeten we om naar Toledo te kijken, waardoor we deadlines missen. Maar omgekeerd ook! Wanneer ik een paar dagen niet op Facebook ben, omdat ik mezelf eens wil los laten van deze sociale media, mis ik deadlines omdat deze dan op Facebook staan, en niet op Toledo. Dit kan toch niet?', 9);
INSERT INTO `tblPost` VALUES(25, 'De wcs  van de Kruidtuin', 'klacht', 'Persoonlijk vind ik dat de mannen-wcs in de Kruidtuin altijd stinken of vuil zijn. Ik weet niet of dit te maken heeft met de kuisploeg of met andere leerlingen, maar kan hier iets aan gedaan worden?', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers`
--

CREATE TABLE `tblUsers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `avatar` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `hash` varchar(32) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tblUsers`
--

INSERT INTO `tblUsers` VALUES(5, 'test', 'test', '729d4756c1ead81b000cc97f85e530de', 'rteststs@student.thomasmore.be', '', 0, 0, '');
INSERT INTO `tblUsers` VALUES(16, 'Lars', 'Peeters', '4168eb041382aff71d958037a26492b8', 'r0339395@student.thomasmore.be', 'icon.jpg', 1, 1, '51d92be1c60d1db1d2e5e7a07da55b26');
INSERT INTO `tblUsers` VALUES(9, 'Cedric', 'Bloem', '24a82946e07bf990bd8dcaabe11e1d94', 'r0333245@student.thomasmore.be', '', 0, 1, '839ab46820b524afda05122893c2fe8e');
INSERT INTO `tblUsers` VALUES(17, 'ellen', 'van den bossche', 'adf543df05be8182c21ec3e23934f704', 'r0333110@student.thomasmore.be', '', 0, 1, 'f7177163c833dff4b38fc8d2872f1ec6');
