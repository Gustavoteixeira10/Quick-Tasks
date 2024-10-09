CREATE DATABASE quicktasks;
use quicktasks;


DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_user` int(100) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `qnt_estrela` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_nota` (`id_user`),
  KEY `id_servico` (`id_servico`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comentador` int(11) NOT NULL,
  `secao` int(100) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comentador` (`id_comentador`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `contratados`;
CREATE TABLE IF NOT EXISTS `contratados` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_servico` int(100) NOT NULL,
  `id_cliente` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente` (`id_cliente`),
  KEY `fk_servico` (`id_servico`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(100) NOT NULL,
  `id_servico` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario` (`id_usuario`),
  KEY `fk_id_servico` (`id_servico`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `foto_perfil` varchar(200) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `profissional`;
CREATE TABLE IF NOT EXISTS `profissional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(100) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `area` varchar(255) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `faixa_preco` varchar(255) NOT NULL,
  `fotos` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfil` (`id_perfil`)
) ENGINE=InnoDB;


ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `id_servico` FOREIGN KEY (`id_servico`) REFERENCES `profissional` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_nota` FOREIGN KEY (`id_user`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentador` FOREIGN KEY (`id_comentador`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `contratados`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_servico` FOREIGN KEY (`id_servico`) REFERENCES `profissional` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `favoritos`
  ADD CONSTRAINT `fk_id_servico` FOREIGN KEY (`id_servico`) REFERENCES `profissional` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `profissional`
  ADD CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
