-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 04 Mai 2017 à 14:28
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_img` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `comment_username` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `id_img`, `id_user`, `comment`, `comment_username`) VALUES
(1, 40, 6, 'erer', NULL),
(2, 41, 6, 'ma bite !', NULL),
(3, 40, 6, 'erer', NULL),
(4, 42, 6, 't moche', NULL),
(5, 42, 6, 't moche', NULL),
(6, 42, 6, 't moche', NULL),
(7, 42, 6, 't moche', NULL),
(8, 42, 6, 't moche', NULL),
(9, 42, 6, 't moche', NULL),
(10, 42, 6, 't moche', NULL),
(11, 42, 6, 't moche', NULL),
(12, 42, 6, 't moche', NULL),
(13, 42, 6, 't moche', NULL),
(14, 42, 6, 't moche', NULL),
(15, 42, 6, 't moche', NULL),
(16, 42, 6, 't moche', NULL),
(17, 42, 6, 't moche', NULL),
(18, 42, 6, 't moche', NULL),
(19, 42, 6, 't moche', NULL),
(20, 42, 6, 't moche', NULL),
(21, 42, 6, 't mochett', NULL),
(22, 42, 6, 't mochett', NULL),
(23, 41, 6, 'werhwe', NULL),
(24, 40, 6, 'wrgerg', NULL),
(25, 40, 6, 'blabla', NULL),
(26, 40, 6, 'test', NULL),
(27, 40, 6, 'test', NULL),
(28, 40, 6, 'test', NULL),
(29, 40, 6, 'new', NULL),
(30, 40, 6, 'newnew', NULL),
(31, 40, 6, 'newnewnew', NULL),
(32, 40, 6, 'newnewnew3', NULL),
(33, 40, 6, 'test4', NULL),
(34, 41, 6, 'test', NULL),
(35, 43, 6, '1', NULL),
(36, 43, 6, '2', NULL),
(37, 43, 6, '3', NULL),
(38, 42, 6, '1', NULL),
(39, 41, 9, 'test mail', NULL),
(40, 41, 9, 'test a mail', NULL),
(41, 44, 9, 'moi', 'testtest'),
(42, 41, 9, 'ergqerg', 'testtest'),
(43, 42, 6, 'je test un commentaire de longeur moyenne !! :)', 'afillion'),
(44, 45, 6, 'ma biitttee', 'afillion'),
(45, 45, 6, 'test', 'afillion'),
(46, 45, 6, 'er', 'afillion'),
(47, 43, 6, 'D', 'afillion'),
(48, 43, 6, 'D', 'afillion'),
(49, 43, 6, 'D', 'afillion'),
(50, 43, 6, 'F', 'afillion'),
(51, 44, 6, '    ', 'afillion'),
(52, 44, 6, '        ', 'afillion'),
(53, 44, 6, '             ', 'afillion'),
(54, 44, 6, '       E      ', 'afillion'),
(55, 44, 6, '                                                                                    ', 'afillion'),
(56, 44, 6, '                                                                                                  ', 'afillion'),
(57, 44, 6, '                                                                D                                  ', 'afillion'),
(58, 52, 6, 'lol', 'afillion'),
(59, 52, 6, 'lollol', 'afillion'),
(60, 50, 6, '1', 'afillion'),
(61, 50, 6, '12', 'afillion'),
(62, 50, 6, '123', 'afillion'),
(63, 50, 6, '1234', 'afillion'),
(64, 50, 6, '12345', 'afillion'),
(65, 50, 6, '123456', 'afillion'),
(66, 50, 6, '1234567', 'afillion'),
(67, 50, 6, '123456788', 'afillion'),
(68, 50, 6, '1234567889', 'afillion'),
(69, 50, 6, '12345678890', 'afillion'),
(70, 48, 6, 'test', 'afillion'),
(71, 48, 6, '&quot;\'&quot;&quot;', 'afillion'),
(72, 48, 6, '&lt;?php echo $_SESSION[\'auth\'] ?&gt;', 'afillion'),
(73, 42, 6, '&quot;je', 'afillion'),
(74, 42, 6, '&quot;je test un commentaire de longeur moyenne !! :)&quot;&quot;je test un commentaire de longeur moyenne !! :)&quot;', 'afillion'),
(75, 48, 9, 'blob', 'testtest');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `path` varchar(250) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `id_user`, `path`, `likes`, `dislikes`) VALUES
(40, 6, 'montages/28-Apr-20171493391372afillion.png', 257, 76),
(41, 6, 'montages/28-Apr-20171493391376afillion.png', 1455, 209),
(42, 6, 'montages/28-Apr-20171493391380afillion.png', 62, 216),
(43, 6, 'montages/03-May-20171493797414afillion.png', 2, 0),
(44, 9, 'montages/03-May-20171493799511testtest.png', 1, 1),
(45, 9, 'montages/03-May-20171493808517testtest.png', 1, NULL),
(46, 9, 'montages/03-May-20171493808525testtest.png', 1, NULL),
(47, 6, 'montages/03-May-20171493816225afillion.png', 1, NULL),
(48, 6, 'montages/03-May-20171493817385afillion.png', 1, NULL),
(50, 6, 'montages/03-May-20171493818445afillion.png', 1, NULL),
(51, 6, 'montages/03-May-20171493818483afillion.png', 1, NULL),
(52, 6, 'montages/03-May-20171493818631afillion.png', 1, 0),
(53, 6, 'montages/03-May-20171493818977afillion.png', 1, NULL),
(54, 6, 'montages/03-May-20171493819002afillion.png', 1, 0),
(55, 6, 'montages/03-May-20171493819212afillion.png', 1, NULL),
(60, 6, 'montages/28-Apr-20171493391372afillion.png', 257, 76),
(61, 6, 'montages/28-Apr-20171493391380afillion.png', 62, 216),
(62, 6, 'montages/28-Apr-20171493391372afillion.png', 257, 76),
(63, 6, 'montages/28-Apr-20171493391376afillion.png', 1455, 209),
(64, 6, 'montages/28-Apr-20171493391380afillion.png', 62, 216),
(65, 6, 'montages/03-May-20171493797414afillion.png', 2, 0),
(66, 9, 'montages/03-May-20171493799511testtest.png', 1, 1),
(67, 9, 'montages/03-May-20171493808517testtest.png', 1, NULL),
(68, 9, 'montages/03-May-20171493808525testtest.png', 1, NULL),
(69, 6, 'montages/03-May-20171493816225afillion.png', 1, NULL),
(70, 6, 'montages/03-May-20171493830338afillion.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `usermail` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `usermail`, `userpassword`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`, `remember_token`) VALUES
(6, 'afillion', 'fillion.alexis@gmail.com', '$2y$10$tFFvStjh1xRIQPSEn1HlBOqWBIDVgwtC1H.FpPJoDxdV.YmZPECY6', NULL, '2017-04-08 18:43:07', NULL, NULL, 'nKXCqUaLnxKwp7fhLISCUZDSRARmaoayIVs9N2APlhoO7dmsmPGlXe39fIwv'),
(7, 'trouduc', 'trouduc13451651651515156561561616151616@gmail.com', '$2y$10$bHHMjdjmhQC6b6BiuEYJFOBLTN1XSRXJ7QiuvJBeFcXww1R9qibiK', 'wksFFFXVGt5BZEKglw6AC4D8f2SbgzGcuXpDcPfSMqlZLdQF5x5ZoFmk7SXW', NULL, NULL, NULL, NULL),
(8, 'test', 'gamethe@live.fr', '$2y$10$bHHMjdjmhQC6b6BiuEYJFOBLTN1XSRXJ7QiuvJBeFcXww1R9qibiK', NULL, '2017-04-08 19:53:57', NULL, NULL, NULL),
(9, 'testtest', 'afillion@student.42.fr', '$2y$10$kNoy/DmS8syA47/3Oqs.XuFNWvlfIlGe8EpNwephrbuEqp7od18p.', NULL, '2017-04-27 14:08:05', NULL, NULL, NULL),
(10, 'fnejlfejr', 'jfeorjfrenjghrjkbhgjrgknrjblrt@gmail.com', '$2y$10$Z64Lph24P9CyzfNbQlTHiehL67S3BCMNGDckcEZ18orFBImYrTDYy', 'qKjAs04uQ3uFUw2rt2B1B2lhUKUnrR95e1FnZGSpgHI6WmymJ6q9u3Amov2O', NULL, NULL, NULL, NULL),
(11, 'plop', 'ghrtuhgrtuohgeoghfluhgrelghehglrhglrt@gmafheior.com', '$2y$10$lscG54pV7RXas2rrodRUEOCOt6Rd5Iu0KQGKBiLspmmzwER784XZa', 'CgUC862JI3jODwiftUW9WhMlOZ9iBjogvQMuh0pPwgp67GJRGxVqS8z5K6xt', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_img` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `id_user`, `id_img`, `type`) VALUES
(29, 6, 40, 1),
(30, 6, 41, -1),
(31, 6, 42, -1),
(32, 9, 40, 1),
(33, 9, 41, -1),
(34, 9, 42, -1),
(35, 6, 43, 1),
(36, 9, 43, 1),
(37, 9, 44, -1),
(38, 9, 46, 1),
(39, 6, 54, 1),
(40, 6, 48, 100),
(41, 6, 51, 1),
(42, 6, 52, 1),
(43, 6, 50, 1),
(44, 6, 45, 1),
(45, 6, 44, 1),
(46, 6, 47, 1),
(47, 6, 49, -1),
(48, 6, 53, 1),
(49, 6, 55, 1),
(50, 6, 56, -1),
(51, 6, 57, -1),
(52, 6, 58, -1),
(53, 6, 59, -1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
