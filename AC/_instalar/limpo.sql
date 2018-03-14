-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 29-Jun-2017 às 16:16
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `sat`
--
CREATE DATABASE IF NOT EXISTS `slimpdv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `slimpdv`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_nome` varchar(100) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_nome` varchar(200) DEFAULT NULL,
  `cliente_razao` varchar(20) DEFAULT NULL,
  `cliente_cnpj` varchar(20) DEFAULT NULL,
  `cliente_ie` varchar(20) DEFAULT NULL,
  `cliente_cpf` varchar(20) DEFAULT NULL,
  `cliente_rg` varchar(45) DEFAULT NULL,
  `cliente_endereco` varchar(200) DEFAULT NULL,
  `cliente_numero` varchar(45) DEFAULT NULL,
  `cliente_complemento` varchar(45) DEFAULT NULL,
  `cliente_bairro` varchar(200) DEFAULT NULL,
  `cliente_municipio` varchar(200) DEFAULT NULL,
  `cliente_uf` varchar(2) DEFAULT NULL,
  `cliente_cep` varchar(9) DEFAULT NULL,
  `cliente_telefone` varchar(20) DEFAULT NULL,
  `cliente_telefone_comercial` varchar(20) DEFAULT NULL,
  `cliente_celular` varchar(20) DEFAULT NULL,
  `cliente_outros` varchar(20) DEFAULT NULL,
  `cliente_email` varchar(200) DEFAULT NULL,
  `cliente_site` varchar(200) DEFAULT NULL,
  `cliente_contato` varchar(100) DEFAULT NULL,
  `cliente_contato_email` varchar(200) DEFAULT NULL,
  `cliente_data_cadastro` datetime DEFAULT NULL,
  `cliente_data_atualizado` datetime DEFAULT NULL,
  `cliente_status` varchar(45) DEFAULT NULL,
  `cliente_obs` text,
  `cliente_senha` varchar(50) DEFAULT NULL,
  `cliente_professor` varchar(3) NOT NULL,
  PRIMARY KEY (`cliente_id`),
  UNIQUE KEY `cliente_id_UNIQUE` (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE IF NOT EXISTS `cupom` (
  `cupom_id` int(11) NOT NULL AUTO_INCREMENT,
  `cupom_CFe` varchar(75) NOT NULL,
  `cupom_data` datetime NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `cupom_xml` longtext NOT NULL,
  `cupom_retorno` longtext NOT NULL,
  `cupom_status` varchar(75) NOT NULL,
  `numeroSessao` int(9) DEFAULT NULL,
  `EEEEE` int(10) DEFAULT NULL,
  `CCCC` int(10) DEFAULT NULL,
  `mensagem` text,
  `cod` int(11) DEFAULT NULL,
  `mensagemSEFAZ` text,
  `chaveConsulta` varchar(50) DEFAULT NULL,
  `valorTotalCFe` int(11) DEFAULT NULL,
  `assinaturaQRCODE` text,
  PRIMARY KEY (`cupom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `empresa_id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_nome` varchar(200) DEFAULT NULL,
  `empresa_razao` varchar(20) DEFAULT NULL,
  `empresa_cnpj` varchar(20) DEFAULT NULL,
  `empresa_ie` varchar(20) DEFAULT NULL,
  `empresa_im` varchar(20) DEFAULT NULL,
  `empresa_RegTribISSQN` int(1) DEFAULT NULL,
  `empresa_indRatISSQN` varchar(1) DEFAULT NULL,
  `empresa_email_contabilidade` varchar(200) DEFAULT NULL,
  `empresa_endereco` varchar(200) DEFAULT NULL,
  `empresa_numero` varchar(45) DEFAULT NULL,
  `empresa_complemento` varchar(45) DEFAULT NULL,
  `empresa_bairro` varchar(200) DEFAULT NULL,
  `empresa_municipio` varchar(200) DEFAULT NULL,
  `empresa_uf` varchar(2) DEFAULT NULL,
  `empresa_cep` varchar(9) DEFAULT NULL,
  `empresa_telefone` varchar(20) DEFAULT NULL,
  `empresa_telefone_outro` varchar(20) DEFAULT NULL,
  `empresa_email` varchar(200) DEFAULT NULL,
  `empresa_data_cadastro` datetime DEFAULT NULL,
  `empresa_data_atualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`empresa_id`),
  UNIQUE KEY `empresa_id_UNIQUE` (`empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lei12741`
--

CREATE TABLE IF NOT EXISTS `lei12741` (
  `codigo` int(20) NOT NULL,
  `ex` int(2) NOT NULL,
  `tipo` int(2) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `nacionalfederal` decimal(4,2) NOT NULL,
  `importadofederal` decimal(4,2) NOT NULL,
  `estadual` decimal(4,2) NOT NULL,
  `municipal` decimal(4,2) NOT NULL,
  `vigenciainicio` varchar(12) NOT NULL,
  `vigenciafim` varchar(12) NOT NULL,
  `chave` varchar(12) NOT NULL,
  `versao` varchar(12) NOT NULL,
  `fonte` varchar(15) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_nome` varchar(100) NOT NULL,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `pedido_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `pedido_cpf` varchar(25) NOT NULL,
  `pedido_data` datetime NOT NULL,
  `pedido_data_atualizacao` datetime NOT NULL,
  `pedido_valor` decimal(10,2) NOT NULL,
  `pedido_desconto` decimal(10,2) NOT NULL,
  `pedido_acrescimo` decimal(10,2) NOT NULL,
  `pedido_dinheiro` decimal(10,2) NOT NULL,
  `pedido_debito` decimal(10,2) NOT NULL,
  `pedido_credito` decimal(10,2) NOT NULL,
  `pedido_troco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produto`
--

CREATE TABLE IF NOT EXISTS `pedido_produto` (
  `pedido_produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `produto_quantidade` int(11) NOT NULL,
  `produto_custo` decimal(10,2) NOT NULL,
  `produto_preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`pedido_produto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_nome` varchar(200) DEFAULT NULL,
  `produto_codBarras` int(25) NOT NULL,
  `produto_categoria` int(11) DEFAULT NULL,
  `produto_marca` int(11) NOT NULL,
  `produto_custo` decimal(10,2) DEFAULT NULL,
  `produto_preco` decimal(10,2) DEFAULT NULL,
  `produto_estoque` int(11) NOT NULL,
  `produto_estoque_min` int(11) NOT NULL,
  `produto_data_cadastro` datetime DEFAULT NULL,
  `produto_data_atualizado` datetime DEFAULT NULL,
  `produto_unidade` varchar(10) DEFAULT NULL,
  `produto_cfop` int(11) DEFAULT NULL,
  `produto_ncm` int(8) DEFAULT NULL,
  `produto_cst` int(3) DEFAULT NULL,
  `produto_cest` int(20) DEFAULT NULL,
  PRIMARY KEY (`produto_id`),
  UNIQUE KEY `produto_id_UNIQUE` (`produto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1320 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_estoque`
--

CREATE TABLE IF NOT EXISTS `produto_estoque` (
  `produto_estoque_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `produto_cor` varchar(45) NOT NULL,
  `produto_tam` varchar(45) NOT NULL,
  `produto_estoque_min` int(11) NOT NULL,
  `produto_estoque` int(11) NOT NULL,
  PRIMARY KEY (`produto_estoque_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=422 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sat`
--

CREATE TABLE IF NOT EXISTS `sat` (
  `sat_id` int(11) NOT NULL AUTO_INCREMENT,
  `sat_nSerie` int(10) NOT NULL,
  `sat_cod_ativacao` int(10) NOT NULL,
  `sat_signAC` varchar(334) NOT NULL,
  PRIMARY KEY (`sat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(100) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_senha` varchar(45) NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO usuario (usuario_nome, usuario_senha) VALUES ('Usuário', 'c4ca4238a0b923820dcc509a6f75849b');