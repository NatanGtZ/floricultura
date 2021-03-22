-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Mar-2021 às 02:25
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `floriculturashelli`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `cod_cidade` int(10) NOT NULL COMMENT 'ID da cidade',
  `nome_cidade` varchar(50) NOT NULL,
  `cod_estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(10) NOT NULL COMMENT 'ID do cliente',
  `nome_cliente` varchar(100) NOT NULL COMMENT 'Nome do cliente',
  `endereco` varchar(100) NOT NULL COMMENT 'Endereço do cliente',
  `cod_cidade` int(10) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL COMMENT 'Contato do cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `nome_cliente`, `endereco`, `cod_cidade`, `telefone`) VALUES
(3, 'Natan', 'rua 5', NULL, '123456789');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `cod_estado` int(10) NOT NULL COMMENT 'ID do estado',
  `uf` varchar(2) NOT NULL COMMENT 'Sigla do estado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `cod_pedido` int(10) NOT NULL COMMENT 'ID do pedido',
  `cod_cliente` int(10) NOT NULL,
  `cod_produto` int(10) NOT NULL,
  `quantidade` int(10) NOT NULL COMMENT 'Quantidade do pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`cod_pedido`, `cod_cliente`, `cod_produto`, `quantidade`) VALUES
(12, 3, 11, 78486485);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `cod_produto` int(10) NOT NULL COMMENT 'ID do produto',
  `descricao_produto` varchar(255) NOT NULL COMMENT 'Descrição do produto',
  `valor_produto` double NOT NULL COMMENT 'Valor em R$ do produto',
  `imagem_produto` blob DEFAULT NULL COMMENT 'Imagem do produto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cod_produto`, `descricao_produto`, `valor_produto`, `imagem_produto`) VALUES
(11, 'teste', 123, NULL),
(13, 'sei la oque', 1200000000, NULL),
(14, 'não sei', 10, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cod_cidade`),
  ADD KEY `FKCidade826481` (`cod_estado`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`),
  ADD KEY `FKCliente958707` (`cod_cidade`);

--
-- Índices para tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`cod_estado`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `FKPedido611724` (`cod_produto`),
  ADD KEY `FKPedido574956` (`cod_cliente`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod_produto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `cod_cidade` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID da cidade';

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID do cliente', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `cod_estado` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID do estado';

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `cod_pedido` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID do pedido', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod_produto` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID do produto', AUTO_INCREMENT=15;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `FKCidade826481` FOREIGN KEY (`cod_estado`) REFERENCES `estado` (`cod_estado`);

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FKCliente958707` FOREIGN KEY (`cod_cidade`) REFERENCES `cidade` (`cod_cidade`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FKPedido574956` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`),
  ADD CONSTRAINT `FKPedido611724` FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
