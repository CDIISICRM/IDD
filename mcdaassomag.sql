CREATE DATABASE IF NOT EXISTS `mcdaassomag` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
DROP TABLE  `travaille`,`agit`,`contenus`,`adminsite`, `projets`,`partenaires`, `personnes`, `roles`;
use mcdaassomag;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `personnes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `idRole` int(11) NOT NULL,
  `metier` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personnes_roles_idx` (`idRole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `personnes`
  ADD CONSTRAINT `fk_personne_role` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


  CREATE TABLE IF NOT EXISTS `adminSite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `pwd` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersonne` (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `adminSite`
  ADD CONSTRAINT `fk_adminSite_personne` FOREIGN KEY (`idPersonne`) REFERENCES `personnes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE; 
  
CREATE TABLE IF NOT EXISTS `contenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45)  NOT NULL,
  `texte` text  NOT NULL,
  `idPosteur` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `extension` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contenu_posteur_idx` (`idPosteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  ALTER TABLE `contenus`
  ADD CONSTRAINT `fk_contenu_posteur` FOREIGN KEY (`idPosteur`) REFERENCES `adminSite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  
CREATE TABLE IF NOT EXISTS `partenaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `siteIntenet` varchar(90) DEFAULT NULL,
  `sygle` varchar(45) DEFAULT NULL,
  `logo` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `objectifs` text,
  `etatActuel` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `agit` (
  `idPartenaire` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  PRIMARY KEY (`idPartenaire`,`idProjet`),
  KEY `fk_agit_partenaire_idx` (`idPartenaire`),
  KEY `fk_agit_projet_idx` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `agit`
  ADD CONSTRAINT `fk_agit_partenaire` FOREIGN KEY (`idPartenaire`) REFERENCES `partenaires` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agit_projet` FOREIGN KEY (`idProjet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE TABLE IF NOT EXISTS `travaille` (
  `idPersonne` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `dateDeb` date NOT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`idPersonne`,`idProjet`),
  KEY `fk_travaille_personne_idx` (`idPersonne`),
  KEY `fk_travaille_projet_idx` (`idProjet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `travaille`
  ADD CONSTRAINT `fk_travaille_personne` FOREIGN KEY (`idPersonne`) REFERENCES `personnes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_travaille_projet` FOREIGN KEY (`idProjet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

INSERT INTO `roles` (`id`, `nomRole`) VALUES(1, 'Président'),(2, 'Vice Président'),(3, 'Secrétaire'),(4, 'Secrétaire Adjoint'),(5, 'Trésorier'),(6, 'Vice Trésorier'),(7, 'Salarié'),(8, 'Membre');
  
INSERT INTO `personnes` (`id`, `nom`, `prenom`, `mail`, `idRole`, `metier`) VALUES(1, ' Larzillière', 'Yves', 'yvon@lecole.com', 1, 'Ingénieur'),(2, 'M''Barek', 'Wahid', 'wahid@lesso.com', 5, 'électricien'),(5, 'Zimmer', 'Claude', 'Claude@Zimmer.fr', 3, 'Directeur de centre social');
  
INSERT INTO `adminSite` (`id`, `idPersonne`, `login`, `pwd`) VALUES (1, 1, 'tryphon', 'tournesol');

INSERT INTO `contenus` (`id`, `idPosteur`, `titre`, `texte`, `img`, `extension`) VALUES(1, 1, 'Migrations et Co-développement Alsace', 'Regrouper en France ou hors de France, toute personne physique ou morale intéressée pour organiser ou participer à des actions de développement dans les zones d''origine de l''immigration, permettant d''enrayer l''exode à l''immigration et de mettre en valeur la dynamique de l''immigration comme force de développement entre les deux rives de la Méditerranée. Recourir à tous les moyens légaux utiles, entre autres la formation et les échanges, l''éducation au développement et la mise en œuvre d''une démarche participative au travers d''actions individuelles ou collectives, pour atteindre l''objectif fixé.', 'media/photo', 'jpg');




  