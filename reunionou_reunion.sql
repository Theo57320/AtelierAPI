-- Adminer 4.8.1 MySQL 5.5.5-10.6.5-MariaDB-1:10.6.5+maria~focal dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `commenter`;
CREATE TABLE `commenter` (
  `id_rdv` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `message` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  KEY `id_rdv` (`id_rdv`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id`),
  CONSTRAINT `commenter_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `commenter` (`id_rdv`, `id_user`, `message`, `created_at`, `updated_at`) VALUES
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'Je ne viens pas',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'test',	'2022-03-23 16:15:10',	'2022-03-23 16:15:10'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'test',	'2022-03-23 16:15:12',	'2022-03-23 16:15:12'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'test',	'2022-03-23 16:15:13',	'2022-03-23 16:15:13'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'test',	'2022-03-23 16:15:13',	'2022-03-23 16:15:13');

DROP TABLE IF EXISTS `participer`;
CREATE TABLE `participer` (
  `id_rdv` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `statut` varchar(100) NOT NULL,
  KEY `id_rdv` (`id_rdv`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id`),
  CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `participer` (`id_rdv`, `id_user`, `statut`) VALUES
('0eca0bd0-b3ef-4009-81f6-fd887f255c0d',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'oui'),
('0eca0bd0-b3ef-4009-81f6-fd887f255c0d',	'oui',	'non'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'non');

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE `rdv` (
  `id` varchar(100) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `long` varchar(20) NOT NULL,
  `libelle_event` varchar(128) NOT NULL,
  `libelle_lieu` varchar(128) NOT NULL,
  `horaire` time NOT NULL,
  `date` date NOT NULL,
  `createur_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `rdv` (`id`, `lat`, `long`, `libelle_event`, `libelle_lieu`, `horaire`, `date`, `createur_id`) VALUES
('0eca0bd0-b3ef-4009-81f6-fd887f255c0d',	'46.702246',	'7.703246',	'Cinema',	'Nancy',	'21:30:00',	'2022-04-02',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'48.703246',	'48.703246',	'Soiree de ouf',	'lieu',	'17:20:00',	'2022-05-23',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3'),
('Ararara',	'48.703246',	'6.157385',	'Boom',	'Paris',	'13:51:52',	'0000-00-00',	''),
('gysgygs',	'48.69',	'6.18',	'Reunion',	'Nancy',	'13:51:52',	'0000-00-00',	'');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `password` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `dateConnexion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`id`, `nom`, `prenom`, `mail`, `sexe`, `password`, `token`, `dateConnexion`) VALUES
('24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'oui',	'test@test.com',	'test@oui.az',	'M',	'$2y$10$/HXHPMNpICrpZdtaZ89VxeP/mxiHEOEmkCA4hHYMRqyMiktbXNWEy',	'4c252d21a886af0c69ca6180f5dcb7994d297a39d70c8b9940879b3a45b3257a',	'2022-03-23'),
('9d6eb3c3-7bf6-4b7d-aa76-1422b112aa9d',	'jean mi',	'test',	'jm@g.com',	'M',	'$2y$10$UXkjnjahPNhxfP8sT5H6bOp1jGcE3Ha8FGWxpaBR/sTPSyNFE8Ioq',	'5c96aaadc86a534f118fb38227e6e6ad210dbc7d057d250e52f1fbec40e1d4ee',	'2022-03-23'),
('oui',	'Georg',	'Hugo',	'hugo.georg@mail.com',	'M',	'test',	'',	'0000-00-00'),
('Oui2',	'Antolini',	'Theo',	'theo.antolini@mail.com',	'M',	'test',	'',	'0000-00-00'),
('oui3',	'Bardet',	'Valentin',	'valentin.bardet@mail.com',	'M',	'test',	'',	'0000-00-00'),
('oui4',	'Amagat',	'Thibault',	'thibault.amagat@mail.com',	'M',	'test',	'',	'0000-00-00'),
('oui5',	'Yoda',	'Maitre',	'maitre.yoda@mail.com',	'M',	'test',	'',	'0000-00-00');

-- 2022-03-23 16:30:03
