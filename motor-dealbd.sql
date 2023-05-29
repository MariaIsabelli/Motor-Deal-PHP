-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.5.25 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para software_web_db
CREATE DATABASE IF NOT EXISTS `software_web_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `software_web_db`;

-- Copiando estrutura para tabela software_web_db.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `genero` char(1) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE KEY` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Tabela que irá armazenar os dados dos clientes.';

-- Copiando dados para a tabela software_web_db.cliente: ~1 rows (aproximadamente)
INSERT IGNORE INTO `cliente` (`id`, `nome`, `cpf`, `data_nascimento`, `telefone`, `genero`, `endereco`, `ativo`) VALUES
	(1, 'isa', '47816621884', '2002-11-23', '14998766744', 'F', 'Botuca', 1);

-- Copiando estrutura para tabela software_web_db.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `genero` char(1) DEFAULT NULL,
  `cep` varchar(8) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero_residencia` varchar(10) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `codigo_area` varchar(5) NOT NULL,
  `numero_celular` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id_key` (`id`),
  UNIQUE KEY `unique_cpf_key` (`cpf`),
  UNIQUE KEY `unique_email_key` (`email`),
  KEY `index_cpf_key` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Tabela que armazenará os dados de cadastro de usuário.';

-- Copiando dados para a tabela software_web_db.usuario: ~1 rows (aproximadamente)
INSERT IGNORE INTO `usuario` (`id`, `nome`, `cpf`, `data_nascimento`, `genero`, `cep`, `logradouro`, `numero_residencia`, `complemento`, `bairro`, `cidade`, `estado`, `codigo_area`, `numero_celular`, `email`, `senha`, `ativo`) VALUES
	(6, 'Administrador do Software', '10020030040', '1990-10-02', 'M', '18600000', 'Rua das AcÃ¡cias', '500', 'Casa', 'Jardim das Rosas', 'Floreira', 'SP', '+55', '14996067878', 'administrador@email.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1);

-- Copiando estrutura para tabela software_web_db.veiculo
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `ano` year(4) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `cor` varchar(25) DEFAULT NULL,
  `valor` double NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE KEY` (`placa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela que armazenará os dados dos veículos que serão vendidos.';

-- Copiando dados para a tabela software_web_db.veiculo: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela software_web_db.venda
CREATE TABLE IF NOT EXISTS `venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_venda` date NOT NULL,
  `data_entrega` date NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FOREIGN KEY USUARIO` (`id_usuario`),
  KEY `FOREIGN KEY CLIENTE` (`id_cliente`),
  KEY `FOREIGN KEY VEICULO` (`id_veiculo`),
  CONSTRAINT `FOREIGN KEY CLIENTE` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FOREIGN KEY USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FOREIGN KEY VEICULO` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela que registrará as vendas de veículos.';

-- Copiando dados para a tabela software_web_db.venda: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
