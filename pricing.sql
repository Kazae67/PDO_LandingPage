-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour pricing
CREATE DATABASE IF NOT EXISTS `pricing` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pricing`;

-- Listage de la structure de table pricing. pricing_db
CREATE TABLE IF NOT EXISTS `pricing_db` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formule` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `prix` varchar(50) DEFAULT NULL,
  `mois` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `reduction` decimal(5,0) DEFAULT NULL,
  `afficher_reduction` tinyint(1) DEFAULT '0',
  `bandwidth` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `onlinespace` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `support` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `domain` varchar(50) NOT NULL DEFAULT '',
  `hidden_fees` tinyint(1) DEFAULT NULL,
  `commande` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table pricing.pricing_db : ~3 rows (environ)
INSERT INTO `pricing_db` (`id`, `formule`, `prix`, `mois`, `reduction`, `afficher_reduction`, `bandwidth`, `onlinespace`, `support`, `domain`, `hidden_fees`, `commande`) VALUES
	(1, 'Starter', '1001', 'month', 30, 0, '5000', '5000', '0', '1', 0, 0),
	(2, 'Advanced', '520', 'month', 10, 1, '1000', '1000', '0', '1', 0, 1),
	(3, 'Professional', '2001', 'month', 10, 1, '1000', '1000', '0', '1', 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
