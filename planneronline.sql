-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/12/2023 às 22:47
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `planneronline`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `diario`
--

CREATE TABLE `diario` (
  `data` date NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `diario`
--

INSERT INTO `diario` (`data`, `descricao`, `email`) VALUES
('2023-11-27', 'segundaa', 'isabellybenedito2210@gmail.com'),
('2023-12-01', 'o natal está pertoo', 'giisaisa.16@gmail.com'),
('2023-12-08', 'sou lindaaaaa', 'giisaisa.16@gmail.com'),
('2023-12-13', 'yes, I can', 'isabellybenedito2210@gmail.com'),
('2023-12-14', 'fvgbn', 'isabellybenedito2210@gmail.com'),
('2023-12-25', 'natallllllllllllllll', 'isabellybenedito2210@gmail.com'),
('2024-01-06', 'newwwww year', 'isabellybenedito2210@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `data` date NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`data`, `nome`, `descricao`, `email`) VALUES
('2023-12-25', 'Natal em Família ', 'Será na fazenda da vovó, levar a sobremesa e estar lá 11h50 da manhã', 'isabellybenedito2210@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_lista`
--

CREATE TABLE `item_lista` (
  `nome_lista` varchar(20) DEFAULT NULL,
  `id_lista` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_planilha`
--

CREATE TABLE `item_planilha` (
  `nome_planilha` varchar(20) DEFAULT NULL,
  `id_planilha` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista`
--

CREATE TABLE `lista` (
  `nome` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `planilha`
--

CREATE TABLE `planilha` (
  `nome` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`email`, `nome`, `senha`) VALUES
('giisaisa.16@gmail.com', 'Gislaine Rabello', '$2y$10$AsoR6GHRTOwlySpxr1RWLeAZ0cSI9ziUMoZAKJ5ZQUkdFjd6ejKma'),
('isabellybenedito2210@gmail.com', 'Isabelly Benedito', '$2y$10$E7YQlebIxE4a0HgmvRE7WOu0UUYrZo4uf1/IXQVu7RhSwBL1xV0yW'),
('lucia@gmail.com', 'Lucia Rabello', '$2y$10$DHQcITtUKji.wQbh3mJX9uGvwC9R6j943WQX5UehmHUZU7pd5q3aW');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `diario`
--
ALTER TABLE `diario`
  ADD PRIMARY KEY (`data`),
  ADD KEY `email` (`email`);

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `email` (`email`);

--
-- Índices de tabela `item_lista`
--
ALTER TABLE `item_lista`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `nome_lista` (`nome_lista`);

--
-- Índices de tabela `item_planilha`
--
ALTER TABLE `item_planilha`
  ADD PRIMARY KEY (`id_planilha`),
  ADD KEY `nome_planilha` (`nome_planilha`);

--
-- Índices de tabela `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `email` (`email`);

--
-- Índices de tabela `planilha`
--
ALTER TABLE `planilha`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `email` (`email`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `diario`
--
ALTER TABLE `diario`
  ADD CONSTRAINT `diario_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);

--
-- Restrições para tabelas `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);

--
-- Restrições para tabelas `item_lista`
--
ALTER TABLE `item_lista`
  ADD CONSTRAINT `item_lista_ibfk_1` FOREIGN KEY (`nome_lista`) REFERENCES `lista` (`nome`);

--
-- Restrições para tabelas `item_planilha`
--
ALTER TABLE `item_planilha`
  ADD CONSTRAINT `item_planilha_ibfk_1` FOREIGN KEY (`nome_planilha`) REFERENCES `planilha` (`nome`);

--
-- Restrições para tabelas `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);

--
-- Restrições para tabelas `planilha`
--
ALTER TABLE `planilha`
  ADD CONSTRAINT `planilha_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
