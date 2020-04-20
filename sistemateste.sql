-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Abr-2020 às 23:13
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemateste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `CodFuncionario` int(11) NOT NULL,
  `Nome` varchar(400) NOT NULL,
  `DataNascimento` datetime NOT NULL,
  `Salario` double(18,2) NOT NULL,
  `Atividades` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`CodFuncionario`, `Nome`, `DataNascimento`, `Salario`, `Atividades`) VALUES
(1, 'Antonio G', '1970-04-16 16:47:04', 1000.00, 'teste'),
(2, 'Ricardo S', '1975-06-13 00:00:00', 3000.00, 'Engenheiro 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionariofilho`
--

CREATE TABLE `funcionariofilho` (
  `CodFuncionarioFilho` int(11) NOT NULL,
  `CodFuncionario` int(11) NOT NULL,
  `Nome` varchar(400) NOT NULL,
  `DataDeNascimento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionariofilho`
--

INSERT INTO `funcionariofilho` (`CodFuncionarioFilho`, `CodFuncionario`, `Nome`, `DataDeNascimento`) VALUES
(1, 1, 'Arthur B', '2010-06-14 22:46:48'),
(2, 2, 'Lara', '2020-04-14 22:46:48');
(3, 1, 'Matheus', '2020-04-15 18:20:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`CodFuncionario`);

--
-- Índices para tabela `funcionariofilho`
--
ALTER TABLE `funcionariofilho`
  ADD PRIMARY KEY (`CodFuncionarioFilho`),
  ADD KEY `FuncionarioFilho` (`CodFuncionario`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `CodFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `funcionariofilho`
--
ALTER TABLE `funcionariofilho`
  MODIFY `CodFuncionarioFilho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `funcionariofilho`
--
ALTER TABLE `funcionariofilho`
  ADD CONSTRAINT `FuncionarioFilhoFK` FOREIGN KEY (`CodFuncionario`) REFERENCES `funcionario` (`CodFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
