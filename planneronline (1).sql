-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2023 às 20:21
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
  `descricao` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `diario`
--

INSERT INTO `diario` (`data`, `descricao`, `email`) VALUES
('2023-12-14', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'maria@gmail.com');

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
('2023-12-22', 'Formatura', 'Formatura no INN, chegar 17h.', 'maria@gmail.com'),
('2023-12-25', 'Natal em Família ', 'Será na fazenda da vovó, levar a sobremesa e estar lá 11h50 da manhã', 'isabellybenedito2210@gmail.com');

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
  `nome` varchar(100) NOT NULL,
  `itens` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lista`
--

INSERT INTO `lista` (`nome`, `itens`, `email`) VALUES
('Filmes', 'fbrey, ujfhgd, hghj', 'isadora@gmail.com');

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
('isabellybenedito2210@gmail.com', 'Isabelly Benedito', '$2y$10$E7YQlebIxE4a0HgmvRE7WOu0UUYrZo4uf1/IXQVu7RhSwBL1xV0yW'),
('isadora@gmail.com', 'Isadora Benedito', '$2y$10$5lM41k2NPbR2BvbSqEDqxe76T.qo4ldmFO7goWx8en3nd8UrNTY12'),
('maria@gmail.com', 'Maria Eloiza', '$2y$10$CCctysbjVMsWTPdg.DeAx.jBoWuK0SZbtsDJHjL.2IZ1EZt8oL0Fe');

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
