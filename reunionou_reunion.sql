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
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'test',	'2022-03-23 16:15:13',	'2022-03-23 16:15:13'),
('b4c17c3b-fe8d-4eb9-9391-f41157b607f6',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'Je viens',	'2022-03-28 08:30:01',	'2022-03-28 08:30:01');

DROP TABLE IF EXISTS `participer`;
CREATE TABLE `participer` (
  `id_rdv` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `statut` varchar(100) NOT NULL,
  KEY `id_rdv` (`id_rdv`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `participer_ibfk_4` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `participer_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `participer` (`id_rdv`, `id_user`, `statut`) VALUES
('0eca0bd0-b3ef-4009-81f6-fd887f255c0d',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'oui'),
('0eca0bd0-b3ef-4009-81f6-fd887f255c0d',	'oui',	'non'),
('2650ff90-6659-49f8-b729-f45dd49864c0',	'24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'non'),
('78d99ee8-b677-4500-9604-8cc9143f89b4',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'oui'),
('3f7875ef-1743-48e4-b758-c317a1903b2b',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'oui'),
('49e75fae-81be-4a0c-b3eb-d11e8fcc6e16',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'oui'),
('c6fbe464-9d56-406e-9f04-d6b9897c617e',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'oui'),
('7632501f-eb55-49d2-bea1-549f791cc00a',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'oui'),
('b4c17c3b-fe8d-4eb9-9391-f41157b607f6',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'oui');

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
('3f7875ef-1743-48e4-b758-c317a1903b2b',	'48.68360540466226',	'6.161578211705086',	'Test',	'Test',	'17:26:00',	'2022-03-30',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8'),
('49e75fae-81be-4a0c-b3eb-d11e8fcc6e16',	'46.702246',	'7.703246',	'nouveau test',	'Nancy',	'15:31:00',	'2022-03-30',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8'),
('7632501f-eb55-49d2-bea1-549f791cc00a',	'46.702246',	'7.703246',	'nouvel event',	'Paris',	'10:31:00',	'2022-03-24',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8'),
('78d99ee8-b677-4500-9604-8cc9143f89b4',	'46.702246',	'7.703246',	's',	's',	'15:08:00',	'2022-03-31',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8'),
('b4c17c3b-fe8d-4eb9-9391-f41157b607f6',	'46.702246',	'7.703246',	'c\'est le dernier',	'oui',	'14:29:00',	'2022-03-21',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8'),
('c6fbe464-9d56-406e-9f04-d6b9897c617e',	'46.702246',	'7.703246',	'OUI',	'Nancy',	'11:16:00',	'2022-03-17',	'7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8'),
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
('5ac4f638-7d09-4276-a9e9-ea5f49ca63e3',	'test',	'null',	'valentin@teyyst.fr',	'F',	'$2y$10$hcKyLMRV/jTUa8kEE7FXFOXxon.eWlYw5XFYxdPr3IxFbg5gkOuBu',	'975e6337db579fe46a2d63f69a10712d53a69bf53c73951d9a580388e597428d',	'2022-03-27'),
('7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8',	'test',	'null',	'valentin@test.fr',	'F',	'$2y$10$pUZfSOmVsb74q/TI1ip30uDgulN7v657V3f8F5WYWJDAxduios72i',	'8d5a1f01eff8afc024503cd5dc62395405034b842c66a60bf3a98ca9687ee7ae',	'2022-03-28'),
('oui',	'Georg',	'Hugo',	'hugo.georg@mail.com',	'M',	'test',	'',	'0000-00-00'),
('Oui2',	'Antolini',	'Theo',	'theo.antolini@mail.com',	'M',	'test',	'',	'0000-00-00'),
('oui3',	'Bardet',	'Valentin',	'valentin.bardet@mail.com',	'M',	'test',	'',	'0000-00-00'),
('oui4',	'Amagat',	'Thibault',	'thibault.amagat@mail.com',	'M',	'test',	'',	'0000-00-00'),
('oui5',	'Yoda',	'Maitre',	'maitre.yoda@mail.com',	'M',	'test',	'',	'0000-00-00');

DROP TABLE IF EXISTS `user_admin`;
CREATE TABLE `user_admin` (
  `id` varchar(75) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `token` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user_admin` (`id`, `email`, `password`, `token`) VALUES
('99d11d79-e450-447d-bd06-0837ca6162ac',	'admin@mail.fr',	'$2y$10$nJlVARn7ej7g8p2B6E.QmuHgqLUd5UfFRbGwElvO5xLsylZDyZZIW',	'09a86e37cbec91929da47d83b68018c9b1d83ae32e5c3f6baddad9b618be4779'),
('30a73c12-4954-47bf-95cc-23c052f0e0fa',	'theoanto@mail.fr',	'$2y$10$LQ3UjRRhsl82jR3DldJBzOo4YYKXveHeye.HRo2a1IPau8ivbEos6',	'20c6a8d030dcd188700ca57bff16a73d97b7096e4750aecd93de8cb92160d476');

-- 2022-03-29 09:19:09
