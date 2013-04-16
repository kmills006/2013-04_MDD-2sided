# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.25)
# Database: 2sided
# Generation Time: 2013-04-11 19:09:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table badges
# ------------------------------------------------------------

DROP TABLE IF EXISTS `badges`;

CREATE TABLE `badges` (
  `badge_id` varchar(13) NOT NULL DEFAULT '',
  `badge_name` varchar(100) DEFAULT NULL,
  `badge_descrip` text,
  `badge_img` varchar(100) DEFAULT NULL,
  `how_to_receive` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`badge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cards`;

CREATE TABLE `cards` (
  `deck_id` varchar(13) DEFAULT NULL,
  `card_id` varchar(13) NOT NULL DEFAULT '',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_edited` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `question` text,
  `answer` text,
  PRIMARY KEY (`card_id`),
  KEY `deck_id` (`deck_id`),
  CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`deck_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;

INSERT INTO `cards` (`deck_id`, `card_id`, `date_created`, `date_edited`, `question`, `answer`)
VALUES
	('50f8f0bd47567','50f8f0cf429ee','2013-01-18 01:50:55','0000-00-00 00:00:00','alliteration','the repetition of initial sounds'),
	('50f8f0bd47567','50f8f0db42936','2013-01-18 01:51:07','0000-00-00 00:00:00','allusion','a reference to a well-known person, place, thing, or idea'),
	('50f8f0bd47567','50f8f0e74c31f','2013-01-18 01:51:19','0000-00-00 00:00:00','analogy','a comparison of two or more similar objects'),
	('50f8f0bd47567','50f8f0f52b703','2013-01-18 01:51:33','0000-00-00 00:00:00','antagonist','a character that opposes the main character'),
	('50f8f0bd47567','50f8f100826fb','2013-01-18 01:51:44','0000-00-00 00:00:00','bibliography','a list of written sources of information'),
	('50f8f0bd47567','50f8f10abebb9','2013-01-18 01:51:54','0000-00-00 00:00:00','main character\n','the most important figure in a story'),
	('50f8f0bd47567','50f8f117267e2','2013-01-18 01:52:07','0000-00-00 00:00:00','minor characters','the \"support cast\" in a story'),
	('50f8f0bd47567','50f8f123b8db8','2013-01-18 01:52:19','0000-00-00 00:00:00','dynamic character','a character in the story that changes'),
	('50f8f0bd47567','50f8f12eb4ff5','2013-01-18 01:52:30','0000-00-00 00:00:00','static character','a character that does not change'),
	('50f8f0bd47567','50f8f13bbf05e','2013-01-18 01:52:43','0000-00-00 00:00:00','climax','the most important part of the story; the turning point'),
	('50f8f0bd47567','50f8f165b092f','2013-01-18 01:53:25','0000-00-00 00:00:00','conflict','a struggle between opposing forces'),
	('50f8f3e884ad4','50f8f3f06b230','2013-01-18 02:04:16','0000-00-00 00:00:00','Line','a line connects two points'),
	('50f8f3e884ad4','50f8f3fd65ebf','2013-01-18 02:04:29','0000-00-00 00:00:00','Contour Line\n','a continuous line that shows the inside and outside outline of an object\n'),
	('50f8f3e884ad4','50f8f40d542c7','2013-01-18 02:04:45','0000-00-00 00:00:00','Implied Lines\n','a line that is not actually draw but is there, ex. the horizon'),
	('50f8f3e884ad4','50f8f41a5229a','2013-01-18 02:04:58','0000-00-00 00:00:00','Shape\n','a set of enclosed lines'),
	('50f8f3e884ad4','50f8f425abb42','2013-01-18 02:05:09','0000-00-00 00:00:00','Organic shape','curvy or not able to to measured (usually found in nature)\n'),
	('50f8f3e884ad4','50f8f4316cf55','2013-01-18 02:05:21','0000-00-00 00:00:00','Geometric Shape\n','a shape able to be measured, ex. Circle, square\n'),
	('50f8f4b5720bc','50f8f4e12bddc','2013-01-18 02:08:17','0000-00-00 00:00:00','ostracize','to exclude from public or private favor'),
	('50f8f4b5720bc','50f8f4edb3542','2013-01-18 02:08:29','0000-00-00 00:00:00','palpable','perceptible by feeling or touch\n'),
	('50f8f4b5720bc','50f8f4f942a2f','2013-01-18 02:08:41','0000-00-00 00:00:00','peccadillo','a minor failing or unique negative trait'),
	('50f8f4b5720bc','50f8f5049658c','2013-01-18 02:08:52','0000-00-00 00:00:00','permeate','to spread or saturate (literally) or through rumor (figuratively)'),
	('50f8f4b5720bc','50f8f50fdcb7a','2013-01-18 02:09:03','0000-00-00 00:00:00','pernicious','tending to hurt or kill, malicious, insidious'),
	('50f8f4b5720bc','50f8f51ba76f0','2013-01-18 02:09:15','0000-00-00 00:00:00','pique','to excite a slight degree of anger in, arouse or irritate'),
	('50f8f55509f68','50f8f55d51a3e','2013-01-18 02:10:21','0000-00-00 00:00:00','0+1','1'),
	('50f8f55509f68','50f8f56122715','2013-01-18 02:10:25','0000-00-00 00:00:00','2+2','4'),
	('50f8f55509f68','50f8f5661ae19','2013-01-18 02:10:30','0000-00-00 00:00:00','1+3','4'),
	('50f8f55509f68','50f8f569a5638','2013-01-18 02:10:33','0000-00-00 00:00:00','1+1','2'),
	('50f8f55509f68','50f8f56deda08','2013-01-18 02:10:37','0000-00-00 00:00:00','4+3','7'),
	('50f8f55509f68','50f8f572f366f','2013-01-18 02:10:42','0000-00-00 00:00:00','9+2','11'),
	('50f8f55509f68','50f8f57d6e679','2013-01-18 02:10:53','0000-00-00 00:00:00','3+8','11'),
	('50f8f55509f68','50f8f5851311e','2013-01-18 02:11:01','0000-00-00 00:00:00','12+2','14'),
	('50f8f55509f68','50f8f58bc27ea','2013-01-18 02:11:07','0000-00-00 00:00:00','13+5','18'),
	('50f8f55509f68','50f8f59085d57','2013-01-18 02:11:12','0000-00-00 00:00:00','10+10','20'),
	('50f8f55509f68','50f8f59a3f908','2013-01-18 02:11:22','0000-00-00 00:00:00','15+15','30'),
	('50f8f607ba528','50f8f60c0c042','2013-01-18 02:13:16','0000-00-00 00:00:00','3-1','2'),
	('50f8f607ba528','50f8f6105fe03','2013-01-18 02:13:20','0000-00-00 00:00:00','4-2','2'),
	('50f8f607ba528','50f8f61d96749','2013-01-18 02:13:33','0000-00-00 00:00:00','9-4','5'),
	('50f8f607ba528','50f8f62255d91','2013-01-18 02:13:38','0000-00-00 00:00:00','8-3','5'),
	('50f8f607ba528','50f8f62c540ca','2013-01-18 02:13:48','0000-00-00 00:00:00','14-4','10'),
	('50f8f607ba528','50f8f64021074','2013-01-18 02:14:08','0000-00-00 00:00:00','20-2','18'),
	('50f8f607ba528','50f8f6468e500','2013-01-18 02:14:14','0000-00-00 00:00:00','21-20','1'),
	('50f8f607ba528','50f8f651347e0','2013-01-18 02:14:25','0000-00-00 00:00:00','13-9','4'),
	('50f8f6a6bd847','50f8f6b27875f','2013-01-18 02:16:02','0000-00-00 00:00:00','Thomas Jefferson\n','Principal author of the Declaration of Independence and the third President of the United States\n'),
	('50f8f6a6bd847','50f8f6c2980e2','2013-01-18 02:16:18','0000-00-00 00:00:00','Meriweather Lewis\n','Thomas Jefferson\'s friend and secretary who was commissioned by Jefferson in 1803 to explore the territory of the Louisiana Purchase\n'),
	('50f8f6a6bd847','50f8f6d47ddb9','2013-01-18 02:16:36','0000-00-00 00:00:00','William Clark\n','Co-captain of the expedition to explore the territory of the Louisiana Purchase'),
	('50f8f6a6bd847','50f8f6f81bec1','2013-01-18 02:17:12','0000-00-00 00:00:00','Sacajawea','Shoshone woman who translated for Lewis and Clark'),
	('50f8f88444eea','50f8f88aa7a27','2013-01-18 02:23:54','0000-00-00 00:00:00','2x2','4'),
	('50f8f88444eea','50f8f89101607','2013-01-18 02:24:01','0000-00-00 00:00:00','7x2','14'),
	('50f8f88444eea','50f8f8956703b','2013-01-18 02:24:05','0000-00-00 00:00:00','1x9','9'),
	('50f8f88444eea','50f8f89a99d86','2013-01-18 02:24:10','0000-00-00 00:00:00','2x6','12'),
	('50f8f88444eea','50f8f8a101789','2013-01-18 02:24:17','0000-00-00 00:00:00','3x7','21'),
	('50f8f88444eea','50f8f8a70c5c1','2013-01-18 02:24:23','0000-00-00 00:00:00','8x5','40'),
	('50f8f88444eea','50f8f8ab16e3d','2013-01-18 02:24:27','0000-00-00 00:00:00','4x3','12'),
	('50f8f88444eea','50f8f8b28056d','2013-01-18 02:24:34','0000-00-00 00:00:00','10x10','100'),
	('50f8f88444eea','50f8f8b93fe86','2013-01-18 02:24:41','0000-00-00 00:00:00','9x9','81'),
	('50f8f88444eea','50f8f8c310db2','2013-01-18 02:24:51','0000-00-00 00:00:00','1x1','1'),
	('50f8fc176dbda','50f8fc3b1af5d','2013-01-18 02:39:39','0000-00-00 00:00:00','1/2 + 1/2','2/2 or 1'),
	('50f8fc176dbda','50f8fc473b634','2013-01-18 02:39:51','0000-00-00 00:00:00','1/4+1/4','1/2'),
	('50f8fc176dbda','50f8fc7a71d3b','2013-01-18 02:40:42','0000-00-00 00:00:00','1/3+1/3','2/3'),
	('50f8fd5b7e9d3','50f8fd80d39f9','2013-01-18 02:45:04','0000-00-00 00:00:00','subtcesion','subsection'),
	('50f8fd5b7e9d3','50f8fd9748c9f','2013-01-18 02:45:27','0000-00-00 00:00:00','tratatropsnion','transportation'),
	('50f8fd5b7e9d3','50f8fdabbde3f','2013-01-18 02:45:47','0000-00-00 00:00:00','suputanreral','supernatural'),
	('50f8ff5f1640a','50f8ff6b239a7','2013-01-18 02:53:15','0000-00-00 00:00:00','arpeggio','Playing notes of a chord one at a time; a \"broken chord\"'),
	('50f8ff5f1640a','50f8ff77e1ff3','2013-01-18 02:53:27','0000-00-00 00:00:00','4/4\n','Common Time\n'),
	('50f8ff5f1640a','50f8ff84bfce3','2013-01-18 02:53:40','0000-00-00 00:00:00','Quarter Note\n','1 beat'),
	('50f8ff5f1640a','50f8ff8ebb3a1','2013-01-18 02:53:50','0000-00-00 00:00:00','Half Note\n','2 beats\n'),
	('50f90f279fac2','50f90f5eec2e1','2013-01-18 04:01:18','0000-00-00 00:00:00','Midnight In Montgomery','Alan Jackson'),
	('50f90f279fac2','50f90f832f568','2013-01-18 04:01:55','0000-00-00 00:00:00','Ol\' Red','Blake Shelton'),
	('50f90f279fac2','50f90f92bda87','2013-01-18 04:02:10','0000-00-00 00:00:00','Friends In Low Places','Garth Brooks'),
	('50f90f279fac2','50f90f9ef28eb','2013-01-18 04:02:22','0000-00-00 00:00:00','All My Ex\'s Live in Texas','George Strait'),
	('50f90f279fac2','50f90faa4bdbe','2013-01-18 04:02:34','0000-00-00 00:00:00','I\'m So Lonesome I Could Cry','Hank Williams'),
	('50f90f279fac2','50f90fbf24883','2013-01-18 04:02:55','0000-00-00 00:00:00','You Were Always On My Mind','Willie Nelson'),
	('50f916b9b15b8','50f916c0ec715','2013-01-18 04:32:48','0000-00-00 00:00:00','Zebra','Lion'),
	('50f916b9b15b8','50f916c6ee11c','2013-01-18 04:32:54','0000-00-00 00:00:00','Tigers','Bears'),
	('50f916b9b15b8','50f916d27c98c','2013-01-18 04:33:06','0000-00-00 00:00:00','Cup','Chair'),
	('50f916b9b15b8','50f916ef632f3','2013-01-18 04:33:35','0000-00-00 00:00:00','Cheese','Riddle'),
	('50f9185d06469','50f918634582d','2013-01-18 04:39:47','0000-00-00 00:00:00','Snake','Shake'),
	('50f9185d06469','50f9186ea0f44','2013-01-18 04:39:58','0000-00-00 00:00:00','Snore','Bore '),
	('50f9185d06469','50f91874685ce','2013-01-18 04:40:04','0000-00-00 00:00:00','Fake','Bake'),
	('50f9185d06469','50f9187fb2667','2013-01-18 04:40:15','0000-00-00 00:00:00','Pluck','Duck'),
	('50f9185d06469','50f9189a875f3','2013-01-18 04:40:42','0000-00-00 00:00:00','Dang','Bang'),
	('50f9185d06469','50f918a160351','2013-01-18 04:40:49','0000-00-00 00:00:00','Praying','Saying'),
	('50f934d16af4b','50f934ed8c522','2013-01-18 06:41:33','0000-00-00 00:00:00','Welcome to 2sided! ','More stuff!'),
	('50f8f3e884ad4','50f9483ae3dbb','2013-01-18 08:03:54','0000-00-00 00:00:00','fwwef','efwew'),
	('50f948b37e7b5','50f948beadf8c','2013-01-18 08:06:06','0000-00-00 00:00:00','Spiderman','Peter Parker'),
	('50f948b37e7b5','50f948dd4b24b','2013-01-18 08:06:37','0000-00-00 00:00:00','Superman','Clark Kent'),
	('50f948b37e7b5','50f948f16f9d3','2013-01-18 08:06:57','0000-00-00 00:00:00','Iron Man','Tony Stark'),
	('50f948b37e7b5','50f949047151d','2013-01-18 08:07:16','0000-00-00 00:00:00','The Hulk','Bruce Banner'),
	('50f948b37e7b5','50f949409c897','2013-01-18 08:08:16','0000-00-00 00:00:00','Wolverine','Logan'),
	('50f948b37e7b5','50f949619ae30','2013-01-18 08:08:49','0000-00-00 00:00:00','Captain America','Steve Rogers'),
	('50f94afe8cd87','50f94ca069af1','2013-01-18 12:47:45','2013-01-18 12:47:45','2sided is a social way to study using flashcards and friends.','Nice! You can also press the spacebar to flip cards. Press the left and right arrows to move to another card.'),
	('50f94afe8cd87','50f94d23c689e','2013-01-18 08:25:19','2013-01-18 08:25:19','Create an account by clicking sign up. By signing up you can create your own decks and share them with the world!','You can also create private decks that will only be seen by you.'),
	('50f94afe8cd87','50f94dabdcc75','2013-01-18 08:27:07','0000-00-00 00:00:00','Decks of cards can be voted on. This helps you find the best decks on 2sided.','The most popular decks will be shown in the browse section. '),
	('50f94afe8cd87','50f94dc89a0e9','2013-01-18 08:27:36','0000-00-00 00:00:00','Browse for free!','Just click browse in the navigation above you.');

/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `comment_id` varchar(13) NOT NULL DEFAULT '',
  `card_id` varchar(13) DEFAULT NULL,
  `user_id` varchar(13) DEFAULT NULL,
  `user_comment` text,
  `comment_date` date DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `card_id` (`card_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table decks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `decks`;

CREATE TABLE `decks` (
  `deck_id` varchar(13) NOT NULL DEFAULT '',
  `user_id` varchar(32) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_edited` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `privacy` int(1) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`deck_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `decks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `decks` WRITE;
/*!40000 ALTER TABLE `decks` DISABLE KEYS */;

INSERT INTO `decks` (`deck_id`, `user_id`, `date_created`, `date_edited`, `privacy`, `title`)
VALUES
	('50f8f0bd47567','50f8eff83a6a8','2013-01-18 01:50:37','0000-00-00 00:00:00',0,'Vocabulary Words'),
	('50f8f3e884ad4','50f8eff83a6a8','2013-01-18 02:04:08','0000-00-00 00:00:00',0,'Art Vocabulary'),
	('50f8f4b5720bc','50f8eff83a6a8','2013-01-18 02:07:33','0000-00-00 00:00:00',0,'English Vocabulary'),
	('50f8f55509f68','50f8eff83a6a8','2013-01-18 02:10:13','0000-00-00 00:00:00',0,'Basic Math'),
	('50f8f607ba528','50f8eff83a6a8','2013-01-18 02:13:11','0000-00-00 00:00:00',0,'Subtraction'),
	('50f8f6a6bd847','50f8f68398566','2013-01-18 02:15:50','0000-00-00 00:00:00',0,'American History'),
	('50f8f88444eea','50f8f68398566','2013-01-18 02:23:48','0000-00-00 00:00:00',0,'Math'),
	('50f8fc176dbda','50f8f68398566','2013-01-18 02:39:03','0000-00-00 00:00:00',0,'Fractions'),
	('50f8fd5b7e9d3','50f8fcc240a5e','2013-01-18 02:44:27','0000-00-00 00:00:00',0,'Scrambled Words'),
	('50f8ff5f1640a','50f8fcc240a5e','2013-01-18 02:53:03','0000-00-00 00:00:00',0,'Beginning Guitar'),
	('50f90f279fac2','50f8eff83a6a8','2013-01-18 04:00:23','0000-00-00 00:00:00',0,'Country Music'),
	('50f916b9b15b8','50f916462f2c3','2013-01-18 04:32:41','0000-00-00 00:00:00',0,'Random Words!'),
	('50f91813f3157','50f916462f2c3','2013-01-18 04:38:27','0000-00-00 00:00:00',0,'Multiples of 9'),
	('50f9185d06469','50f916462f2c3','2013-01-18 04:39:41','0000-00-00 00:00:00',0,'Rhyming Words'),
	('50f919166b79a','50f8eff83a6a8','2013-01-18 04:42:46','0000-00-00 00:00:00',1,'Advanced Physics '),
	('50f9192a944a9','50f8eff83a6a8','2013-01-18 04:43:06','0000-00-00 00:00:00',1,'Computer Science Words'),
	('50f9194d5e427','50f8eff83a6a8','2013-01-18 04:43:41','0000-00-00 00:00:00',0,'Advanced Computer Programming Vocabulary'),
	('50f934d16af4b','50f93316894ce','2013-01-18 06:41:05','0000-00-00 00:00:00',1,'THE DECK TO RULE THEM ALL'),
	('50f93c05bb25e','50f8fcc240a5e','2013-01-18 07:11:49','0000-00-00 00:00:00',0,'Test Please Ignore'),
	('50f93c2945779','50f8fcc240a5e','2013-01-18 07:12:25','0000-00-00 00:00:00',0,'test'),
	('50f948b37e7b5','50f948601d3ee','2013-01-18 08:05:55','0000-00-00 00:00:00',0,'Super hero real names'),
	('50f94afe8cd87','50f948601d3ee','2013-01-18 08:29:40','2013-01-18 08:29:40',1,'THE DECK TO RULE THEM ALL');

/*!40000 ALTER TABLE `decks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ratings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `deck_id` varchar(32) DEFAULT NULL,
  `rating_id` varchar(32) NOT NULL DEFAULT '',
  `user_id` varchar(32) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `date_rated` date DEFAULT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `deck_id` (`deck_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`deck_id`),
  CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;

INSERT INTO `ratings` (`deck_id`, `rating_id`, `user_id`, `rating`, `date_rated`)
VALUES
	('50f8f0bd47567','50f8f0bd5f0a9','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f3e884ad4','50f8f3e88edbe','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f4b5720bc','50f8f4b57e9d8','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f55509f68','50f8f5550a66e','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f607ba528','50f8f607c5d67','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f6a6bd847','50f8f6a6be0ab','50f8f68398566',1,'2013-01-18'),
	('50f8f88444eea','50f8f88445728','50f8f68398566',1,'2013-01-18'),
	('50f8f0bd47567','50f8f8c8cf6fa','50f8f68398566',1,'2013-01-18'),
	('50f8f55509f68','50f8f8cf7bb5d','50f8f68398566',1,'2013-01-18'),
	('50f8f4b5720bc','50f8f8d301794','50f8f68398566',1,'2013-01-18'),
	('50f8f3e884ad4','50f8f8d754824','50f8f68398566',1,'2013-01-18'),
	('50f8f607ba528','50f8f8db258d6','50f8f68398566',1,'2013-01-18'),
	('50f8fc176dbda','50f8fc176e4e5','50f8f68398566',1,'2013-01-18'),
	('50f8fd5b7e9d3','50f8fd5b83fac','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f6a6bd847','50f8fe66c25d5','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f88444eea','50f8fe6b80596','50f8fcc240a5e',1,'2013-01-18'),
	('50f8fc176dbda','50f8fe7615e2a','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f607ba528','50f8fe79ed916','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f3e884ad4','50f8fe7d7c9a2','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f0bd47567','50f8fe8345d92','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f55509f68','50f8fe89d0b39','50f8fcc240a5e',1,'2013-01-18'),
	('50f8f4b5720bc','50f8fe91cdc81','50f8fcc240a5e',1,'2013-01-18'),
	('50f8ff5f1640a','50f8ff5f1fe87','50f8fcc240a5e',1,'2013-01-18'),
	('50f90f279fac2','50f90f27b25bb','50f8eff83a6a8',1,'2013-01-18'),
	('50f8fc176dbda','50f90fccc2b85','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f6a6bd847','50f90fd0e8bb6','50f8eff83a6a8',1,'2013-01-18'),
	('50f8f88444eea','50f90fd58df1a','50f8eff83a6a8',1,'2013-01-18'),
	('50f8fd5b7e9d3','50f90fd9be449','50f8eff83a6a8',1,'2013-01-18'),
	('50f916b9b15b8','50f916b9b7970','50f916462f2c3',1,'2013-01-18'),
	('50f91813f3157','50f918140434a','50f916462f2c3',1,'2013-01-18'),
	('50f9185d06469','50f9185d22f90','50f916462f2c3',1,'2013-01-18'),
	('50f8f0bd47567','50f918ad1372e','50f916462f2c3',1,'2013-01-18'),
	('50f8f88444eea','50f918afe8524','50f916462f2c3',1,'2013-01-18'),
	('50f8f55509f68','50f918b2c0e87','50f916462f2c3',1,'2013-01-18'),
	('50f8f6a6bd847','50f918b5a98cb','50f916462f2c3',1,'2013-01-18'),
	('50f8f4b5720bc','50f918b824246','50f916462f2c3',1,'2013-01-18'),
	('50f8f3e884ad4','50f918ba9f4c0','50f916462f2c3',1,'2013-01-18'),
	('50f8fc176dbda','50f918be2c0ce','50f916462f2c3',1,'2013-01-18'),
	('50f8f607ba528','50f918c175189','50f916462f2c3',1,'2013-01-18'),
	('50f919166b79a','50f919167da7a','50f8eff83a6a8',1,'2013-01-18'),
	('50f9192a944a9','50f9192a99dbb','50f8eff83a6a8',1,'2013-01-18'),
	('50f9194d5e427','50f9194d61b0b','50f8eff83a6a8',1,'2013-01-18'),
	('50f934d16af4b','50f934d17e6e5','50f93316894ce',1,'2013-01-18'),
	('50f93c05bb25e','50f93c05cd9db','50f8fcc240a5e',1,'2013-01-18'),
	('50f93c2945779','50f93c294b9ea','50f8fcc240a5e',1,'2013-01-18'),
	('50f948b37e7b5','50f948b38daac','50f948601d3ee',1,'2013-01-18'),
	('50f94afe8cd87','50f94afea2118','50f948601d3ee',1,'2013-01-18'),
	('50f8ff5f1640a','50f94e4aa3a15','50f948601d3ee',1,'2013-01-18'),
	('50f9185d06469','50f94e4f0bc41','50f948601d3ee',1,'2013-01-18'),
	('50f90f279fac2','50f94e538cabb','50f948601d3ee',0,'2013-01-18'),
	('50f916b9b15b8','50f94e6425696','50f948601d3ee',1,'2013-01-18'),
	('50f8fd5b7e9d3','50f94e783dbe1','50f948601d3ee',1,'2013-01-18'),
	('50f8f0bd47567','50f94e7c78f8f','50f948601d3ee',1,'2013-01-18'),
	('50f948b37e7b5','50f95ac9e5074','50f8eff83a6a8',1,'2013-01-18');

/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `deck_id` varchar(32) DEFAULT NULL,
  `tag_id` varchar(32) NOT NULL DEFAULT '',
  `tagName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `deck_id` (`deck_id`),
  CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`deck_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`deck_id`, `tag_id`, `tagName`)
VALUES
	('50f8f0bd47567','50f8f0bd5e836','Spelling'),
	('50f8f0bd47567','50f8f0bd5e847','Vocabulary'),
	('50f8f0bd47567','50f8f0bd5e850','Words'),
	('50f8f0bd47567','50f8f0bd5e856','English'),
	('50f8f3e884ad4','50f8f3e88e98f','art'),
	('50f8f3e884ad4','50f8f3e88e997','Vocabulary'),
	('50f8f4b5720bc','50f8f4b5725cf','English'),
	('50f8f4b5720bc','50f8f4b5725d8','Vocabulary'),
	('50f8f4b5720bc','50f8f4b5725de','Spelling'),
	('50f8f55509f68','50f8f5550a249','Math'),
	('50f8f55509f68','50f8f5550a250','Addition'),
	('50f8f607ba528','50f8f607ba7e3','Math'),
	('50f8f607ba528','50f8f607ba7e8','Subtraction'),
	('50f8f6a6bd847','50f8f6a6bdd15','History'),
	('50f8f6a6bd847','50f8f6a6bdd1d','Vocabulary'),
	('50f8f88444eea','50f8f88445219','Math'),
	('50f8f88444eea','50f8f8844521f','Multiplication'),
	('50f8f88444eea','50f8f88445224','Division'),
	('50f8fc176dbda','50f8fc176de99','Fractions'),
	('50f8fc176dbda','50f8fc176dea1','Math'),
	('50f8fd5b7e9d3','50f8fd5b80946','Spelling'),
	('50f8fd5b7e9d3','50f8fd5b8094e','Scrambled'),
	('50f8ff5f1640a','50f8ff5f168eb','Music'),
	('50f8ff5f1640a','50f8ff5f168f1','Guitar'),
	('50f90f279fac2','50f90f27b21c1','Music'),
	('50f90f279fac2','50f90f27b21d4','Trivia'),
	('50f916b9b15b8','50f916b9b7538','Random'),
	('50f916b9b15b8','50f916b9b7541','Words'),
	('50f91813f3157','50f9181403dc5','Multiplication'),
	('50f91813f3157','50f9181403dcc','Math'),
	('50f9185d06469','50f9185d12fd1','Spelling'),
	('50f9185d06469','50f9185d12fe2','Spelling'),
	('50f9185d06469','50f9185d12fe6','English'),
	('50f9185d06469','50f9185d12feb','Rhyming'),
	('50f9185d06469','50f9185d12ff3','Words'),
	('50f919166b79a','50f919167d39a','Physics'),
	('50f919166b79a','50f919167d3a5','Math'),
	('50f9192a944a9','50f9192a996cf','Computer'),
	('50f9192a944a9','50f9192a996d6','Science'),
	('50f9192a944a9','50f9192a996db','Words'),
	('50f9194d5e427','50f9194d61436','Vocabulary'),
	('50f9194d5e427','50f9194d61446','Programming'),
	('50f9194d5e427','50f9194d6144b','Computer'),
	('50f934d16af4b','50f934d17e187','The White'),
	('50f934d16af4b','50f934d17e199','Wizards'),
	('50f93c05bb25e','50f93c05c6fcd','Test'),
	('50f93c05bb25e','50f93c05c6fde','Test'),
	('50f93c2945779','50f93c294b108','test'),
	('50f93c2945779','50f93c294b128','test'),
	('50f948b37e7b5','50f948b389f36','trivia'),
	('50f948b37e7b5','50f948b389f51','comicbook'),
	('50f94afe8cd87','50f94afea1493','MAGIC'),
	('50f94afe8cd87','50f94afea14dc','POWERS');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_friends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_friends`;

CREATE TABLE `user_friends` (
  `user_id` varchar(13) NOT NULL DEFAULT '',
  `friend_id` varchar(13) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`,`friend_id`),
  KEY `friend_id` (`friend_id`),
  CONSTRAINT `user_friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `user_friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_friends` WRITE;
/*!40000 ALTER TABLE `user_friends` DISABLE KEYS */;

INSERT INTO `user_friends` (`user_id`, `friend_id`)
VALUES
	('50f8eff83a6a8','50f8fcc240a5e'),
	('50f8eff83a6a8','50f93316894ce'),
	('50f916462f2c3','50f93316894ce');

/*!40000 ALTER TABLE `user_friends` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` varchar(32) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pword` varchar(32) DEFAULT NULL,
  `date_of_reg` date NOT NULL,
  `profile_img` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `email`, `username`, `pword`, `date_of_reg`, `profile_img`)
VALUES
	('50f8eff83a6a8','kolby@hotmail.com','Kolby','4b18abc8189e9e20b7ce629ecbb1ba52','2013-01-18','50f8eff83a6a8.jpg'),
	('50f8f68398566','redbull@hotmail.com','RedBull','776ad0ef27acc0602c337dc2736f3a97','2013-01-18',NULL),
	('50f8fcc240a5e','lebron@hotmail.com','LebronRocks6','021a304869b110c86d032f41fdcd05c7','2013-01-18','50f8fcc240a5e.jpg'),
	('50f916462f2c3','binder@bind.com','Binder','5ae3422f7941e37eeb6d23cef243c8cd','2013-01-18','50f916462f2c3.jpg'),
	('50f93316894ce','millerlite@gmail.com','millerlite','ae2b1fca515949e5d54fb22b8ed95575','2013-01-18',NULL),
	('50f948601d3ee','batman@bat.com','Batman','ec0e2603172c73a8b644bb9456c1ff6e','2013-01-18','50f948601d3ee.jpg');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
