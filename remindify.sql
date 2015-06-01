-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 12 apr 2015 om 22:04
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `remindify`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `emotion` tinyint(1) NOT NULL,
  `song_id` varchar(50) NOT NULL,
  `path` varchar(300) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=137 ;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `text`, `emotion`, `song_id`, `path`) VALUES
(121, 22, 'met kalle', 1, '5b88tNINg4Q4nrRbrCXUmg', 'Uploads/WIN_20150410_172424.JPG'),
(122, 22, 'zomervakantie', 1, '6YUTL4dYpB9xZO5qExPf05', 'Uploads/1966325_379305035583474_8738396327014267256_o.jpg'),
(134, 22, 'Basketbal kampioenen!', 1, '6u5M4jPpYkoRV4vVHDQvkd', 'Uploads/Ben2kampioengr.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `socialmedia`
--

CREATE TABLE IF NOT EXISTS `socialmedia` (
`id` int(11) NOT NULL,
  `naam` varchar(65) NOT NULL,
  `code` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `picture` text,
  `spotify_Id` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `picture`, `spotify_Id`) VALUES
(1, 'testName', 'test@test.nl', 'test.png', '0'),
(22, 'Menno van den Ende', 'mentosmenno@hotmail.com', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/p200x200/11082641_1552023891727453_1407133131445436689_n.jpg?oh=5d4fb2fbc21377094b1c0c8a6c8fcce8&oe=55B873F5&__gda__=1435997687_776945cfb92d01d9cdc7181c2b8fb095', '11143134707'),
(24, 'Hiemstra Sport', 'john@hiemstrasport.nl', 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/s200x200/1013824_400415130098007_7776189834833444928_n.jpg?oh=30a5f0cee37ea457a7534b42943614d8&oe=559D830C&__gda__=1437454742_fe79014ed07d1187036a72369fe9686a', '11183863816');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `id` (`post_id`), ADD KEY `imagePost_id` (`path`);

--
-- Indexen voor tabel `socialmedia`
--
ALTER TABLE `socialmedia`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT voor een tabel `socialmedia`
--
ALTER TABLE `socialmedia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
