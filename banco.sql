CREATE DATABASE  IF NOT EXISTS `cursos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cursos`;
-- MySQL dump 10.13  Distrib 8.0.19, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: cursos
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `imagem_destaque` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (7,'Gerenciamento de Conta','<p>&Eacute; um fato conhecido de todos que um leitor se distrair&aacute; com o conte&uacute;do de texto leg&iacute;vel de uma p&aacute;gina quando estiver examinando sua diagrama&ccedil;&atilde;o. A vantagem de usar Lorem Ipsum &eacute; que ele tem uma distribui&ccedil;&atilde;o normal de letras, ao contr&aacute;rio de &quot;Conte&uacute;do aqui, conte&uacute;do aqui&quot;, fazendo com que ele tenha uma apar&ecirc;ncia similar a de um texto leg&iacute;vel. Muitos softwares de publica&ccedil;&atilde;o e editores de p&aacute;ginas na internet agora usam Lorem Ipsum como texto-modelo padr&atilde;o, e uma r&aacute;pida busca por &#39;lorem ipsum&#39; mostra v&aacute;rios websites ainda em sua fase de constru&ccedil;&atilde;o. V&aacute;rias vers&otilde;es novas surgiram ao longo dos anos, eventualmente por acidente, e &agrave;s vezes de prop&oacute;sito (injetando humor, e coisas do g&ecirc;nero).</p>\r\n','teste.jpg');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos_imagens`
--

DROP TABLE IF EXISTS `cursos_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos_imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_curso` int NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_c_i_id_curso_idx` (`id_curso`),
  CONSTRAINT `fk_c_i_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos_imagens`
--

LOCK TABLES `cursos_imagens` WRITE;
/*!40000 ALTER TABLE `cursos_imagens` DISABLE KEYS */;
INSERT INTO `cursos_imagens` VALUES (8,7,'teste_1.jpg'),(9,7,'teste_2.png'),(10,7,'teste_3.jpg');
/*!40000 ALTER TABLE `cursos_imagens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-24 12:16:36
