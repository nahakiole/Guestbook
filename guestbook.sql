-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Feb 2014 um 19:54
-- Server Version: 5.5.35-MariaDB-log
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `guestbook`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Entry`
--

CREATE TABLE IF NOT EXISTS `Entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  'date' datetime NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `page`
--

INSERT INTO `page` (`id`, `name`, `title`, `content`) VALUES
(1, 'About', 'About this', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa. \r\nCum sociis natoque penatibus et magnis dis parturient \r\nmontes, nascetur ridiculus mus. Donec quam felis, \r\nultricies nec, pellentesque eu, pretium quis, sem.</p>\r\n\r\n\r\n<ul>\r\n  <li>Lorem ipsum dolor sit amet consectetuer.</li>\r\n  <li>Aenean commodo ligula eget dolor.</li>\r\n  <li>Aenean massa cum sociis natoque penatibus.</li>\r\n</ul>\r\n\r\n\r\n<h2>Aenean commodo ligula eget dolor aenean massa</h2>\r\n\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing \r\nelit. Aenean commodo ligula eget dolor. Aenean massa \r\n<strong>strong</strong>. Cum sociis natoque penatibus \r\net magnis dis parturient montes, nascetur ridiculus \r\nmus. Donec quam felis, ultricies nec, pellentesque \r\neu, pretium quis, sem. Nulla consequat massa quis \r\nenim. Donec pede justo, fringilla vel, aliquet nec, \r\nvulputate eget, arcu. In enim justo, rhoncus ut, \r\nimperdiet a, venenatis vitae, justo. Nullam dictum \r\nfelis eu pede <a class="external ext" href="#">link</a> \r\nmollis pretium. Integer tincidunt. Cras dapibus. \r\nVivamus elementum semper nisi. Aenean vulputate \r\neleifend tellus. Aenean leo ligula, porttitor eu, \r\nconsequat vitae, eleifend ac, enim. Aliquam lorem ante, \r\ndapibus in, viverra quis, feugiat a, tellus. Phasellus \r\nviverra nulla ut metus varius laoreet. Quisque rutrum. \r\nAenean imperdiet. Etiam ultricies nisi vel augue. \r\nCurabitur ullamcorper ultricies nisi.</p>\r\n\r\n\r\n<blockquote>\r\nLorem ipsum dolor sit amet, consectetuer \r\nadipiscing elit. Aenean commodo ligula eget dolor. \r\nAenean massa <strong>strong</strong>. Cum sociis \r\nnatoque penatibus et magnis dis parturient montes, \r\nnascetur ridiculus mus. Donec quam felis, ultricies \r\nnec, pellentesque eu, pretium quis, sem. Nulla consequat \r\nmassa quis enim. Donec pede justo, fringilla vel, \r\naliquet nec, vulputate eget, arcu. In <em>em</em> \r\nenim justo, rhoncus ut, imperdiet a, venenatis vitae, \r\njusto. Nullam <a class="external ext" href="#">link</a>\r\ndictum felis eu pede mollis pretium.\r\n</blockquote>\r\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
