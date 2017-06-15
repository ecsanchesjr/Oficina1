-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jun-2017 às 19:10
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saci`
--
-- Este é o Banco de Dados em sua versão final.
-- Está carregado com os Dados base para o funcionamento, no caso:
--		Departamentos
--		Salas e Blocos
-- 	Inventario
-- 	Pessoas
-- 	Usuários

-- Dados de empréstimo e devolução não contidos.
-- --------------------------------------------------------

--
-- Estrutura da tabela `bloco`
--

CREATE TABLE `bloco` (
  `bloco_id` int(11) NOT NULL,
  `bloco_nome` varchar(100) DEFAULT 'Bloco sem nome.',
  `bloco_depto` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bloco`
--

INSERT INTO `bloco` (`bloco_id`, `bloco_nome`, `bloco_depto`) VALUES
(1, 'Bloco sem nome.', 'DACOMP'),
(2, 'Bloco sem nome.', 'DAELE'),
(3, 'Bloco sem nome.', 'DAMEC'),
(4, 'Bloco sem nome.', 'DIREC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `departamento_sigla` varchar(10) NOT NULL,
  `departamento_nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`departamento_sigla`, `departamento_nome`) VALUES
('DACOMP', 'Departamento de Engenharia da Computação.'),
('DAELE', 'Departamento de Engenharia Elétrica'),
('DAMEC', 'Departamento de Engenharia Mecânica'),
('DIREC', 'Departamento geral');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `emprestimo_id` int(11) NOT NULL,
  `emprestimo_inventario` int(11) NOT NULL,
  `emprestimo_pessoa` int(11) NOT NULL,
  `emprestimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `historico_id` int(11) NOT NULL,
  `historico_inventario` int(11) NOT NULL,
  `historico_pessoa` int(11) NOT NULL,
  `historico_pessoadevolucao` int(11) NOT NULL,
  `historico_dataemprestimo` datetime NOT NULL,
  `historico_datadevolucao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventario`
--

CREATE TABLE `inventario` (
  `inventario_id` int(11) NOT NULL,
  `inventario_nome` varchar(100) NOT NULL,
  `inventario_descricao` varchar(500) DEFAULT 'Nenhuma descrição.',
  `inventario_sala` int(11) NOT NULL,
  `inventario_salaorigem` int(11) NOT NULL,
  `inventario_key` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inventario`
--

INSERT INTO `inventario` (`inventario_id`, `inventario_nome`, `inventario_descricao`, `inventario_sala`, `inventario_salaorigem`, `inventario_key`) VALUES
(1, 'Martelo', 'Nenhuma descrição.', 4, 4, '2d1093ab'),
(2, 'Alicate', 'Nenhuma descrição.', 4, 4, 'c53f93ab'),
(3, 'Alicate de Crimpar', 'Nenhuma descrição.', 1, 1, 'ec593ab'),
(4, 'Martelo', 'Nenhuma descrição.', 3, 3, '8b5693ab'),
(5, 'Extensão Elétrica', 'Nenhuma descrição.', 2, 2, 'd4992ab'),
(6, 'Alicate', 'Nenhuma descrição.', 4, 4, '794093ab'),
(7, 'Teclado', 'Nenhuma descrição.', 1, 1, '6d5c93ab'),
(8, 'Alicate', 'Nenhuma descrição.', 4, 4, '37e592ab'),
(9, 'Teclado', 'Nenhuma descrição.', 1, 1, 'dc1a4b2b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pessoa_regescola` int(11) NOT NULL,
  `pessoa_nome` varchar(100) NOT NULL,
  `pessoa_cpf` varchar(20) NOT NULL,
  `pessoa_rg` varchar(20) NOT NULL,
  `pessoa_key` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`pessoa_regescola`, `pessoa_nome`, `pessoa_cpf`, `pessoa_rg`, `pessoa_key`) VALUES
(1436, 'César Diego Moura', '342.917.620-46', '47.436.832-4', '897192ab'),
(1598, 'Otávio Bryan Eduardo Barbosa', '300.972.823-91', '37.051.613-8', '451692ab'),
(1879, 'Thales Arthur Davi Barros', '043.279.522-73', '16.155.400-3', 'b249f155');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `sala_id` int(11) NOT NULL,
  `sala_bloco` int(11) NOT NULL,
  `sala_nome` varchar(100) DEFAULT 'Sala sem nome.',
  `sala_numero` int(11) NOT NULL,
  `sala_depto` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`sala_id`, `sala_bloco`, `sala_nome`, `sala_numero`, `sala_depto`) VALUES
(3, 3, 'Sala de equipamentos mecânicos', 12, 'DAMEC'),
(2, 2, 'Sala de componentes eletrônicos', 35, 'DAELE'),
(1, 1, 'Sala de equipamentos de TI', 38, 'DACOMP'),
(4, 4, 'Sala de ferramentas', 66, 'DIREC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_regescola` int(11) NOT NULL,
  `usuario_nick` varchar(20) NOT NULL,
  `usuario_passwd` varchar(20) NOT NULL,
  `usuario_permissao` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_regescola`, `usuario_nick`, `usuario_passwd`, `usuario_permissao`) VALUES
(1436, 'user1', '123', 0),
(1598, 'user2', '123', 0),
(1879, 'useradmin', '123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloco`
--
ALTER TABLE `bloco`
  ADD PRIMARY KEY (`bloco_id`,`bloco_depto`),
  ADD KEY `bloco_depto_idx` (`bloco_depto`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`departamento_sigla`);

--
-- Indexes for table `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`emprestimo_id`,`emprestimo_inventario`,`emprestimo_pessoa`),
  ADD KEY `emprestimo_pessoa_idx` (`emprestimo_pessoa`),
  ADD KEY `emprestimo_inventario_idx` (`emprestimo_inventario`);

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`historico_id`,`historico_inventario`,`historico_pessoa`),
  ADD KEY `historico_inventario_idx` (`historico_inventario`),
  ADD KEY `historico_pessoa_idx` (`historico_pessoa`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`inventario_id`,`inventario_sala`),
  ADD UNIQUE KEY `inventario_key_UNIQUE` (`inventario_key`),
  ADD KEY `inventario_sala_idx` (`inventario_sala`),
  ADD KEY `inventario_salaorigem_idx` (`inventario_salaorigem`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pessoa_regescola`),
  ADD UNIQUE KEY `pessoa_cpf_UNIQUE` (`pessoa_cpf`),
  ADD UNIQUE KEY `pessoa_key_UNIQUE` (`pessoa_key`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`sala_numero`,`sala_bloco`,`sala_depto`),
  ADD UNIQUE KEY `sala_id_UNIQUE` (`sala_id`),
  ADD KEY `sala_bloco_idx` (`sala_bloco`),
  ADD KEY `sala_depto_idx` (`sala_depto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_regescola`),
  ADD UNIQUE KEY `usuario_nick_UNIQUE` (`usuario_nick`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `emprestimo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `historico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `inventario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `sala_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `bloco`
--
ALTER TABLE `bloco`
  ADD CONSTRAINT `bloco_depto` FOREIGN KEY (`bloco_depto`) REFERENCES `departamento` (`departamento_sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_inventario` FOREIGN KEY (`emprestimo_inventario`) REFERENCES `inventario` (`inventario_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `emprestimo_pessoa` FOREIGN KEY (`emprestimo_pessoa`) REFERENCES `pessoa` (`pessoa_regescola`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_inventario` FOREIGN KEY (`historico_inventario`) REFERENCES `inventario` (`inventario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historico_pessoa` FOREIGN KEY (`historico_pessoa`) REFERENCES `pessoa` (`pessoa_regescola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `FK_sala` FOREIGN KEY (`inventario_sala`) REFERENCES `sala` (`sala_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_salaOrigem` FOREIGN KEY (`inventario_salaorigem`) REFERENCES `sala` (`sala_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_bloco_FK` FOREIGN KEY (`sala_bloco`) REFERENCES `bloco` (`bloco_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sala_depto_FK` FOREIGN KEY (`sala_depto`) REFERENCES `departamento` (`departamento_sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_pessoa` FOREIGN KEY (`usuario_regescola`) REFERENCES `pessoa` (`pessoa_regescola`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
