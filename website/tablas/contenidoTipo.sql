-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2013 at 12:03 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vinosdegarza`
--

-- --------------------------------------------------------

--
-- Table structure for table `contenidoTipo`
--

CREATE TABLE IF NOT EXISTS `contenidoTipo` (
  `idContenidoTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipoContenido` varchar(45) NOT NULL,
  PRIMARY KEY (`idContenidoTipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contenidoTipo`
--

INSERT INTO `contenidoTipo` (`idContenidoTipo`, `tipoContenido`) VALUES
(1, 'noticia'),
(2, 'comunicado'),
(3, 'articulo');
