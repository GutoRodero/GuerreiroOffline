-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/08/2024 às 18:49
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `guerreirooffline`
--
CREATE DATABASE IF NOT EXISTS `guerreirooffline` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `guerreirooffline`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itemvenda`
--

CREATE TABLE `itemvenda` (
  `idItemVenda` int(11) NOT NULL,
  `idVenda` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valorUnitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itemvenda`
--

INSERT INTO `itemvenda` (`idItemVenda`, `idVenda`, `idProduto`, `quantidade`, `valorUnitario`) VALUES
(6, 12, 19, 3, 1.11),
(7, 12, 1, 3, 2.00),
(8, 20, 1, 1, 2.00),
(9, 10, 17, 12, 10.00),
(10, 10, 19, 1, 1.11),
(11, 21, 17, 13, 10.00),
(15, 23, 21, 1, 20.00),
(16, 24, 1, 1, 2.00),
(17, 25, 21, 1, 20.00),
(18, 26, 19, 5, 1.11),
(19, 26, 20, 5, 1.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idPessoa` int(11) NOT NULL,
  `nomePessoa` varchar(100) DEFAULT NULL,
  `apelidoPessoa` varchar(100) DEFAULT NULL,
  `sexoPessoa` int(11) DEFAULT NULL COMMENT '1:Masculino\r\n2:Feminino\r\n3:Outros'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`idPessoa`, `nomePessoa`, `apelidoPessoa`, `sexoPessoa`) VALUES
(1, 'Carlos', 'Carlão', 1),
(12, 'Dorivaldo', 'Dori', 1),
(14, 'Renan', 'Renan', 1),
(15, 'Cristiane', 'Cris', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `nomeProduto` varchar(100) NOT NULL,
  `valorProduto` decimal(10,2) DEFAULT NULL,
  `statusProduto` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `nomeProduto`, `valorProduto`, `statusProduto`) VALUES
(1, 'Água Mineral', 2.00, 1),
(17, 'Feijão Tropeiro', 10.00, 1),
(19, 'Arroz', 1.11, 1),
(20, 'Pão', 1.00, 1),
(21, 'Cachorro quente', 20.00, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `idVenda` int(11) NOT NULL,
  `dataVenda` timestamp NOT NULL DEFAULT current_timestamp(),
  `obsVenda` text DEFAULT NULL,
  `idPessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`idVenda`, `dataVenda`, `obsVenda`, `idPessoa`) VALUES
(10, '2024-08-06 10:43:20', 'aa', 12),
(12, '2024-08-08 12:28:43', '', 1),
(20, '2024-08-08 12:30:04', '', 1),
(21, '2024-08-08 12:30:42', '', 12),
(23, '2024-08-14 19:47:47', '', 1),
(24, '2024-08-14 19:48:08', '', 12),
(25, '2024-08-14 19:48:43', 'Caprichar, porque é pro Renan', 14),
(26, '2024-08-16 12:50:41', 'Caprichar, porque é pro Renan', 14);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `itemvenda`
--
ALTER TABLE `itemvenda`
  ADD PRIMARY KEY (`idItemVenda`),
  ADD KEY `idVenda` (`idVenda`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idPessoa`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `fk_idPessoa` (`idPessoa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itemvenda`
--
ALTER TABLE `itemvenda`
  MODIFY `idItemVenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idPessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `idVenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itemvenda`
--
ALTER TABLE `itemvenda`
  ADD CONSTRAINT `itemvenda_ibfk_1` FOREIGN KEY (`idVenda`) REFERENCES `venda` (`idVenda`),
  ADD CONSTRAINT `itemvenda_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_idPessoa` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`idPessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
