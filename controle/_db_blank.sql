SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `crlimpezas` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci ;
USE `crlimpezas` ;

-- -----------------------------------------------------
-- Table `admin_clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `admin_clientes` ;

CREATE  TABLE IF NOT EXISTS `admin_clientes` (
  `id_clientes` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(200) NOT NULL ,
  `email` VARCHAR(200) NULL ,
  `endereco` VARCHAR(200) NULL ,
  `bairro` VARCHAR(100) NULL ,
  `telefone` VARCHAR(200) NULL ,
  `data_cadastro` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_clientes`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_pedidos` ;

CREATE  TABLE IF NOT EXISTS `site_pedidos` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `nome_cliente` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  `email_cliente` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `telefone_cliente` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `servicos_cliente` VARCHAR(200) NULL ,
  `formulario` TEXT CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  `analytics` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `origem` VARCHAR(45) NULL DEFAULT 'ONLINE' ,
  `data_envio` DATETIME NULL ,
  `data_atualizacao` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  `foi_negado` TINYINT(1) NULL DEFAULT 0 ,
  `clientes_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_site_pedidos_1` (`clientes_id` ASC) ,
  CONSTRAINT `fk_site_pedidos_1`
    FOREIGN KEY (`clientes_id` )
    REFERENCES `admin_clientes` (`id_clientes` )
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 103
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `admin_pagamentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `admin_pagamentos` ;

CREATE  TABLE IF NOT EXISTS `admin_pagamentos` (
  `id_pagamentos` INT NOT NULL AUTO_INCREMENT ,
  `valor` DECIMAL(8,2) NOT NULL ,
  `tipo_pagamento` VARCHAR(45) NULL ,
  `data_pagamento` DATETIME NOT NULL ,
  `pedidos_id` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id_pagamentos`) ,
  INDEX `fk_admin_pagamentos_1` (`pedidos_id` ASC) ,
  CONSTRAINT `fk_admin_pagamentos_1`
    FOREIGN KEY (`pedidos_id` )
    REFERENCES `site_pedidos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `admin_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `admin_usuarios` ;

CREATE  TABLE IF NOT EXISTS `admin_usuarios` (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NOT NULL ,
  `usuario` VARCHAR(45) NOT NULL ,
  `senha` VARCHAR(100) NOT NULL ,
  `data_atualizacao` DATETIME NULL ,
  PRIMARY KEY (`id_usuarios`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `admin_pedidos_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `admin_pedidos_status` ;

CREATE  TABLE IF NOT EXISTS `admin_pedidos_status` (
  `id_pedidos_status` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `status` VARCHAR(45) NOT NULL ,
  `comentario` TEXT NULL ,
  `data_atualizacao` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  `pedidos_id` BIGINT(20) NOT NULL ,
  PRIMARY KEY (`id_pedidos_status`) ,
  INDEX `fk_admin_pedidos_status_1` (`pedidos_id` ASC) ,
  CONSTRAINT `fk_admin_pedidos_status_1`
    FOREIGN KEY (`pedidos_id` )
    REFERENCES `site_pedidos` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `admin_usuarios` (`nome`,`usuario`,`senha`,`data_atualizacao`) 
VALUES ('Thiago Pio','thiago','$6$KuY8LsqY$6Aiu2XF9jeeeMbAOpsPbcz.pMn073y6pcoOV.zjH.xgHnJpID/BmKpXIfmGEuulvQNf4l6j52MZucXDg6eNjC.','2013-02-13 00:00:00')
,('Nei Girão','nei','$6$KuY8LsqY$6Aiu2XF9jeeeMbAOpsPbcz.pMn073y6pcoOV.zjH.xgHnJpID/BmKpXIfmGEuulvQNf4l6j52MZucXDg6eNjC.','2013-02-13 00:00:00')
,('Caio Rios','caio','$6$KuY8LsqY$6Aiu2XF9jeeeMbAOpsPbcz.pMn073y6pcoOV.zjH.xgHnJpID/BmKpXIfmGEuulvQNf4l6j52MZucXDg6eNjC.','2013-02-13 00:00:00'); 

---------------------------------
-- ADICIONAR INSERT DE ORÇAMENTOS
---------------------------------

INSERT INTO admin_clientes (nome, email, telefone,data_cadastro) 
SELECT nome_cliente, email_cliente, telefone_cliente, data_envio FROM site_pedidos GROUP BY nome_cliente, telefone_cliente HAVING count(email_cliente) = 1;

