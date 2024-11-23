-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           11.5.2-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para login
CREATE DATABASE IF NOT EXISTS `login` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `login`;

-- Copiando estrutura para tabela login.contatos
CREATE TABLE IF NOT EXISTS `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela login.contatos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela login.mensagens
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_remetente` int(11) NOT NULL,
  `id_destinatario` int(10) unsigned zerofill NOT NULL,
  `mensagem` text NOT NULL,
  `data_enviada` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_remetente` (`id_remetente`),
  KEY `id_destinatario` (`id_destinatario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela login.mensagens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela login.projetos
CREATE TABLE IF NOT EXISTS `projetos` (
  `projeto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `usuario_email` varchar(255) DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT current_timestamp(),
  `valor` decimal(10,2) DEFAULT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`projeto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela login.projetos: ~1 rows (aproximadamente)
INSERT INTO `projetos` (`projeto_id`, `nome_produto`, `descricao`, `usuario_email`, `data_criacao`, `valor`, `foto`) VALUES
	(1, 'Banana', 'banana', 'annachristina0500@gmail.com', '2024-11-23 23:18:24', 1000000.00, '../perfil/uploads/bananaazul.jpeg');

-- Copiando estrutura para tabela login.senhaa
CREATE TABLE IF NOT EXISTS `senhaa` (
  `senha_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`senha_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela login.senhaa: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela login.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `foto_perfil` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `data_criacao` timestamp NULL DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `tipo_usuario` enum('cliente','freelancer') NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `redes_sociais` varchar(255) DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela login.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`usuario_id`, `nome`, `email`, `senha`, `foto_perfil`, `data_criacao`, `datanascimento`, `tipo_usuario`, `data_nascimento`, `redes_sociais`, `portfolio`, `telefone`, `instagram`, `linkedin`, `facebook`, `github`) VALUES
	(1, 'Rafael Lopes', 'rafadumbinho@gmail.com', '111111', 'default.jpg', NULL, NULL, 'freelancer', '2005-05-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Anna Christina', 'annachristina0500@gmail.com', '222222', 'uploads/fotos_perfil/673b8ed4914ea.jpeg', NULL, NULL, 'freelancer', '2005-02-05', NULL, '', '21982048850', '', '', '', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
