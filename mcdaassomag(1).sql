-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 10 Mars 2014 à 09:08
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mcdaassomag`
--
CREATE DATABASE IF NOT EXISTS `mcdaassomag` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mcdaassomag`;

-- --------------------------------------------------------

--
-- Structure de la table `adminsite`
--

DROP TABLE IF EXISTS `adminsite`;
CREATE TABLE IF NOT EXISTS `adminsite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  `login` varchar(45) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(70) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersonne` (`idPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `adminsite`
--

INSERT INTO `adminsite` (`id`, `idPersonne`, `login`, `pwd`) VALUES
(1, 1, 'tryphon', 'tournesol'),
(2, 1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `agit`
--

DROP TABLE IF EXISTS `agit`;
CREATE TABLE IF NOT EXISTS `agit` (
  `idPartenaire` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  PRIMARY KEY (`idPartenaire`,`idProjet`),
  KEY `fk_agit_partenaire_idx` (`idPartenaire`),
  KEY `fk_agit_projet_idx` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

DROP TABLE IF EXISTS `contenus`;
CREATE TABLE IF NOT EXISTS `contenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `texte` text CHARACTER SET utf8 NOT NULL,
  `idPosteur` int(11) NOT NULL,
  `img` varchar(250) CHARACTER SET utf8 NOT NULL,
  `extension` varchar(4) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contenu_posteur_idx` (`idPosteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `contenus`
--

INSERT INTO `contenus` (`id`, `titre`, `texte`, `idPosteur`, `img`, `extension`) VALUES
(1, 'Co-développement en Alsace', '\r\n\r\nIdeoque fertur neminem aliquando ob haec vel similia poenae addictum oblato de more elogio revocari iussisse, quod inexorabiles quoque principes factitarunt. et exitiale hoc vitium, quod in aliis non numquam intepescit, in illo aetatis progressu effervescebat, obstinatum eius propositum accendente adulatorum cohorte.\r\n\r\nQuod cum ita sit, paucae domus studiorum seriis cultibus antea celebratae nunc ludibriis ignaviae torpentis exundant, vocali sonu, perflabili tinnitu fidium resultantes. denique pro philosopho cantor et in locum oratoris doctor artium ludicrarum accitur et bybliothecis sepulcrorum ritu in perpetuum clausis organa fabricantur hydraulica, et lyrae ad speciem carpentorum ingentes tibiaeque et histrionici gestus instrumenta non levia.\r\n\r\nHaec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.\r\n \r\n \r\n \r\n \r\n \r\n \r\n \r\n', 1, 'media/photo2', 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

DROP TABLE IF EXISTS `partenaires`;
CREATE TABLE IF NOT EXISTS `partenaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `siteInternet` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `sygle` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `logo` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `partenaires`
--

INSERT INTO `partenaires` (`id`, `nom`, `siteInternet`, `sygle`, `logo`) VALUES
(1, 'Association B', 'www.asso-b.com', 'BB', 'vtx3gh510t0714.jpg'),
(2, 'test', 'test', 'test', ''),
(4, 'test', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

DROP TABLE IF EXISTS `personnes`;
CREATE TABLE IF NOT EXISTS `personnes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `prenom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `mail` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `idRole` int(11) NOT NULL,
  `metier` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personnes_roles_idx` (`idRole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `personnes`
--

INSERT INTO `personnes` (`id`, `nom`, `prenom`, `mail`, `idRole`, `metier`) VALUES
(1, ' Larzillière', 'Yves', 'yvon@lecole.com', 1, 'Ingénieur'),
(2, 'M''Barek', 'Wahid', 'wahid@lesso.com', 5, 'électricien'),
(5, 'Zimmer', 'Claude', 'Claude@Zimmer.fr', 3, 'Directeur de centre social'),
(6, 'Trop Long', 'Ludo', 'info@koupix', 7, 'Concepteur');

-- --------------------------------------------------------

--
-- Structure de la table `presses`
--

DROP TABLE IF EXISTS `presses`;
CREATE TABLE IF NOT EXISTS `presses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(250) NOT NULL,
  `source` varchar(250) NOT NULL,
  `auteur` varchar(250) NOT NULL,
  `lien` varchar(250) NOT NULL,
  `pdf` varchar(250) NOT NULL,
  `dateParution` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `presses`
--

INSERT INTO `presses` (`id`, `titre`, `source`, `auteur`, `lien`, `pdf`, `dateParution`) VALUES
(1, 'Solidarité nord-sud', 'L''Alsace 32222', 'Thibaut Lemoine121212', 'Rixheim.pdf', '', '2014-03-18'),
(8, 'azza', 'DNA', 'moi', '3.1 UML-geolocalisation.pdf', 'lepdf.pdf', '2014-03-02'),
(9, 'titre', 'source', 'auteur', 'http://lien.fr', '3.1 UML-geolocalisation.pdf', '2014-03-09');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `objectifs` text CHARACTER SET utf8,
  `etatActuel` text CHARACTER SET utf8,
  `date_debut` datetime DEFAULT NULL,
  `photo_proj1` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `photo_proj2` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `nom`, `objectifs`, `etatActuel`, `date_debut`, `photo_proj1`, `photo_proj2`) VALUES
(1, 'projet1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tincidunt ut massa at ultrices. Donec dignissim, lacus varius congue vehicula, justo purus volutpat nisi, sit amet aliquam justo tellus non quam. Praesent non sollicitudin turpis, at sodales elit. Aenean rutrum hendrerit consectetur. Morbi nec fringilla nisl. Donec bibendum quam ac elit aliquet, non porta neque euismod. Aenean ac sapien sed dolor ultricies hendrerit. Morbi nunc purus, sollicitudin a lobortis id, lobortis non lacus. Mauris placerat diam lacinia sem luctus, id accumsan odio rhoncus. Maecenas luctus justo auctor mi rutrum convallis. Phasellus rutrum semper justo sit amet viverra. Curabitur fermentum egestas nisl vitae tempor. Etiam nec faucibus elit. ', ' Morbi laoreet aliquam turpis ut pretium. Aliquam convallis dictum massa, a sodales quam elementum eget. In a purus nisi. Sed ac vulputate enim. Quisque sed nisl sem. In in sagittis odio. In hendrerit varius libero sed vulputate. Curabitur ac lobortis ligula. Aliquam erat volutpat.\r\n\r\nProin et egestas diam. In hac habitasse platea dictumst. Sed consectetur nunc et faucibus dictum. Curabitur rutrum magna volutpat, posuere felis pretium, pretium lacus. Pellentesque eu lacus eget enim rhoncus semper et non nisl. Maecenas eu lectus vel sapien facilisis accumsan. Nam bibendum semper accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut fringilla varius nulla non molestie. ', '2014-02-17 00:00:00', 'media/projet1.jpg', 'media/projet2.jpg'),
(2, 'projet2', ' Phasellus porttitor ullamcorper metus in molestie. Praesent tortor augue, faucibus nec neque nec, ultrices scelerisque sapien. Ut cursus rhoncus urna, a semper arcu dapibus non. Ut vel malesuada eros. Curabitur blandit tempor ipsum non pharetra. Donec imperdiet in nulla vel accumsan. Etiam sodales vestibulum magna eu aliquet.\r\n\r\nIn pharetra ultrices quam, ut elementum ipsum bibendum ac. Donec cursus, erat vitae aliquam congue, justo nulla pharetra orci, et mattis nisl ligula nec odio. Morbi facilisis dolor at porttitor vestibulum. Nam id augue nec enim vehicula consequat ut congue lectus. Sed volutpat lacus id tortor adipiscing imperdiet. Suspendisse pulvinar tellus id massa tincidunt viverra. Morbi vel cursus odio. Nulla gravida dolor vitae nunc viverra, sed vestibulum turpis adipiscing. Sed vestibulum ligula eu urna congue fringilla. Maecenas malesuada felis sed neque tincidunt, at ullamcorper mi ultricies. Curabitur convallis mauris quis volutpat fermentum. Donec tempor neque at euismod adipiscing. Aenean pretium augue sodales, facilisis lectus ut, pretium nisi. Etiam ornare nunc leo, at luctus elit gravida ullamcorper. Donec fermentum id nulla eu lobortis. ', ' Morbi laoreet aliquam turpis ut pretium. Aliquam convallis dictum massa, a sodales quam elementum eget. In a purus nisi. Sed ac vulputate enim. Quisque sed nisl sem. In in sagittis odio. In hendrerit varius libero sed vulputate. Curabitur ac lobortis ligula. Aliquam erat volutpat.\r\n\r\nProin et egestas diam. In hac habitasse platea dictumst. Sed consectetur nunc et faucibus dictum. Curabitur rutrum magna volutpat, posuere felis pretium, pretium lacus. Pellentesque eu lacus eget enim rhoncus semper et non nisl. Maecenas eu lectus vel sapien facilisis accumsan. Nam bibendum semper accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut fringilla varius nulla non molestie. ', '2014-02-16 00:00:00', 'media/projet3.jpg', 'media/projet4.jpg'),
(7, 'Projet 001', 'Objectif : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-03 00:00:00', 'photo2.jpg', 'photo2.jpg'),
(8, 'Projet 002', 'Objectif : Projet 002 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-04 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(9, 'Projet 003', 'Objectif : Projet 003 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-05 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(10, 'Projet 004', 'Objectif : Projet 004 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-06 00:00:00', 'media/slide2.jpg', 'media/slide1.png'),
(11, 'Projet 005', 'Objectif : Projet 005 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-07 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(12, 'Projet 006', 'Objectif : Projet 006 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-08 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(13, 'Projet 007', 'Objectif : Projet 007 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-09 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(14, 'Projet 008', 'Objectif : Projet 008 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-10 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(15, 'Projet 009', 'Objectif : Projet 009 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-11 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(16, 'Projet 010', 'Objectif : Projet 010 - Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Etat : Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-02-12 00:00:00', 'photo2.jpg', 'photo3.jpg'),
(17, 'projet 014', 'test', 'test', '2014-03-03 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `nomRole`) VALUES
(1, 'Président'),
(2, 'Vice Président'),
(3, 'Secrétaire'),
(4, 'Secrétaire Adjoint'),
(5, 'Trésorier'),
(6, 'Vice Trésorier'),
(7, 'Salarié'),
(8, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `travaille`
--

DROP TABLE IF EXISTS `travaille`;
CREATE TABLE IF NOT EXISTS `travaille` (
  `idPersonne` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `dateDeb` date NOT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`idPersonne`,`idProjet`),
  KEY `fk_travaille_personne_idx` (`idPersonne`),
  KEY `fk_travaille_projet_idx` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adminsite`
--
ALTER TABLE `adminsite`
  ADD CONSTRAINT `fk_adminSite_personne` FOREIGN KEY (`idPersonne`) REFERENCES `personnes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `agit`
--
ALTER TABLE `agit`
  ADD CONSTRAINT `fk_agit_partenaire` FOREIGN KEY (`idPartenaire`) REFERENCES `partenaires` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agit_projet` FOREIGN KEY (`idProjet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `fk_contenu_posteur` FOREIGN KEY (`idPosteur`) REFERENCES `adminsite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD CONSTRAINT `fk_personne_role` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `travaille`
--
ALTER TABLE `travaille`
  ADD CONSTRAINT `fk_travaille_personne` FOREIGN KEY (`idPersonne`) REFERENCES `personnes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_travaille_projet` FOREIGN KEY (`idProjet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
