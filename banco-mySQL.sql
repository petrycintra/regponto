-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para controleponto
CREATE DATABASE IF NOT EXISTS `controleponto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `controleponto`;

-- Copiando estrutura para tabela controleponto.ponto
CREATE TABLE IF NOT EXISTS `ponto` (
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entrada` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intervalo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fim_intervalo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fim_expediente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela controleponto.ponto: ~7 rows (aproximadamente)
DELETE FROM `ponto`;
INSERT INTO `ponto` (`login`, `dia`, `entrada`, `intervalo`, `fim_intervalo`, `fim_expediente`) VALUES
	('petry', '06/10/2023', ' 18:33', ' 18:33', ' 18:33', ' 18:33'),
	('petry', '06/10/2023', ' 18:35', ' 18:35', ' 18:35', ' 18:35'),
	('petry', '06/10/2023', ' 18:53', ' 18:54', ' 18:55', ' 18:57'),
	('julie', '06/10/2023', ' 18:57', ' 18:57', ' 18:57', ' 18:57'),
	('julie', '06/10/2023', ' 22:40', ' 22:40', ' 22:40', ' 22:40'),
	('arya', '06/10/2023', ' 22:42', ' 22:42', ' 22:42', ' 22:42'),
	('arya', '07/10/2023', ' 01:20', ' 01:20', ' 01:20', ' 01:20');

-- Copiando estrutura para tabela controleponto.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nivel` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ativo` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela controleponto.usuarios: 5 rows
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `nivel`, `ativo`) VALUES
	(1, 'Petry Cintra Amaral', 'petry', '202cb962ac59075b964b07152d234b70', 'adm', 1),
	(2, 'Julie Hevellyn de Oliveira', 'julie', '202cb962ac59075b964b07152d234b70', 'fun', 1),
	(3, 'Yngra Cintra Amaral', 'yngra', '202cb962ac59075b964b07152d234b70', 'fun', 1),
	(33, 'Arya', 'arya', '202cb962ac59075b964b07152d234b70', 'fun', 1),
	(4, 'Neblino', 'neb', '202cb962ac59075b964b07152d234b70', 'fun', 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
