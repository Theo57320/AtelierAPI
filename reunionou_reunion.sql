-- Adminer 4.8.1 MySQL 5.5.5-10.6.5-MariaDB-1:10.6.5+maria~focal dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `commenter`;
CREATE TABLE `commenter` (
  `id_rdv` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `libelle` varchar(256) NOT NULL,
  KEY `id_rdv` (`id_rdv`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id`),
  CONSTRAINT `commenter_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `participer`;
CREATE TABLE `participer` (
  `id_rdv` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  KEY `id_rdv` (`id_rdv`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id`),
  CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `rdv`;
CREATE TABLE `rdv` (
  `id` varchar(100) NOT NULL,
  `lat` decimal(8,2) NOT NULL,
  `long` decimal(8,2) NOT NULL,
  `libelle_event` varchar(128) NOT NULL,
  `libelle_lieu` varchar(128) NOT NULL,
  `horraire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `rdv` (`id`, `lat`, `long`, `libelle_event`, `libelle_lieu`, `horraire`, `date`) VALUES
('Ararara',	48.86,	2.35,	'Boom',	'Paris',	'2022-03-21 13:51:52',	'0000-00-00'),
('gysgygs',	48.69,	6.18,	'Reunion',	'Nancy',	'2022-03-21 13:51:52',	'0000-00-00');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `password` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`id`, `nom`, `prenom`, `mail`, `sexe`, `password`, `token`) VALUES
('24fc6110-26ab-4f1d-8448-21dd72d58fb3',	'jean mi',	'test',	'jm@gmal.com',	'M',	'$2y$10$Rep7woXeZJFv8pU788Zvluobh4oK4nRiWKVIiGtXrrI.FUf.eDkti',	'2a17020d2ec1739c843daa114ce928accc74f86192b3d604560026a2a6d62c37'),
('925bd29d-00e1-45da-afa5-d5b74354bfc0',	'jean mi',	'test',	'jm@gmal.com',	'M',	'test',	'c282030f168796d74f57237251a0f1770fd8f32d5c1b6c0da62b653e0bd49493'),
('oui',	'Georg',	'Hugo',	'hugo.georg@mail.com',	'M',	'test',	''),
('Oui2',	'Antolini',	'Theo',	'theo.antolini@mail.com',	'M',	'test',	''),
('oui3',	'Bardet',	'Valentin',	'valentin.bardet@mail.com',	'M',	'test',	''),
('oui4',	'Amagat',	'Thibault',	'thibault.amagat@mail.com',	'M',	'test',	''),
('oui5',	'Yoda',	'Maitre',	'maitre.yoda@mail.com',	'M',	'test',	'');

-- 2022-03-22 09:11:01
