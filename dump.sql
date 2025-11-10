-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/11/2025 às 12:21
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `secretaria_fiap`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nome`, `cpf`, `email`, `senha`, `criado_em`) VALUES
(1, 'Administrador Padr&atilde;o', '000.000.000', 'admin@fiap.com', '$2y$12$rAINyg1VgqAub5737GYVd.87sB94OB.OSaOQB363YgFtRg4iiiooa', '2025-11-09 15:53:22'),
(3, 'Jo&atilde;o Francisco Augusto da Costa', '933.660.754', 'joao.francisco.dacosta@tcotecnologia.com.br', '$2y$12$HZhJyZIOaQZHUUiarH6jyOt62abMx.4v5JMBGw1gnlK2a4XcVhyIa', '2025-11-10 07:39:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_aluno` bigint(20) NOT NULL,
  `nome_aluno` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf_aluno` varchar(255) NOT NULL,
  `email_aluno` varchar(255) NOT NULL,
  `senha_aluno` varchar(255) NOT NULL,
  `criado_em` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `nome_aluno`, `data_nascimento`, `cpf_aluno`, `email_aluno`, `senha_aluno`, `criado_em`) VALUES
(19, 'Aparecida Yasmin Melo', '2000-02-01', '230.729.374-43', 'aparecidayasminmelo@pmm.am.gov.br', '$2y$12$e0EK4Cmv0Wq3u5jkkamLReyGE0hpQn46wAr5YcQISlcCv/v/iacJa', '0000-00-00 00:00:00'),
(20, 'Noah Benício Martins', '2012-12-12', '611.957.217-14', 'noah-martins96@fabianocosta.com.br', '$2y$12$FD7RBI.XJUdEsbaZ8/PQ7Osk2tSLgPhh.GWcu5bK8jZlXBVs0FLq6', '0000-00-00 00:00:00'),
(22, 'Elaine Sophia Mariana Silva', '2000-12-12', '531.055.387-80', 'elaine_sophia_silva@isometro.com.br', '$2y$12$mWJ4.6YG/BbFgUfjntH.BuPT249CcblW43/IWe.qIp/ZTv58C0VW.', '0000-00-00 00:00:00'),
(23, 'Sandra Giovana Dias', '1998-05-01', '797.552.870-60', 'sandra.giovana.dias@abcautoservice.net', '$2y$12$yrMQKG29Fj64/56jfsBVUOR.AfYdPbASO5Fs56.GnEueNjjFJY9Ky', '0000-00-00 00:00:00'),
(24, 'Cristiane Elaine Andrea Assis', '2000-09-01', '472.242.054-86', 'cristianeelaineassis@signa.net.br', '$2y$12$Q8vf41RWBjzzYYZV70YggOsGqUGgtmgUYO/872NS4fxfZ0UOHa83G', '0000-00-00 00:00:00'),
(25, 'Raquel Eliane Silveira', '2003-02-10', '063.917.143-55', 'raquel.eliane.silveira@samsaraimoveis.com.br', '$2y$12$NeGKdTHOAPw6A4Ru55n96u9ujxnfNFshrs2qSpEes0N9p0lQZc2Je', '0000-00-00 00:00:00'),
(26, 'Anthony Yuri da Paz Teste', '2000-02-10', '333.975.898-00', 'anthony-dapaz74@6am.com.br', '$2y$12$V7a9qvMz1lZ9wKs9..I3SeH6cNeLB7M4OXf/4/NS8Ixwx1m/hMU4m', '0000-00-00 00:00:00'),
(27, 'Malu Valentina da Mata', '2000-02-10', '680.167.586-90', 'malu_damata@sinsesp.com.br', '$2y$12$g1TUAQ2hI2tuPSCpeOQUbe5/LanenTh2k9VbWA5FRJLgZziFD8pYe', '0000-00-00 00:00:00'),
(28, 'Gustavo Samuel Souza', '2000-02-10', '047.607.348-05', 'gustavo-souza71@yoma.com.br', '$2y$12$Khf4QR2oq48Ky8xKVnM41uq3RrbjvLRH.EpX2/DgL9p/DvPIp5sh6', '0000-00-00 00:00:00'),
(29, 'Vanessa Sueli Rocha', '1974-05-01', '878.646.118-42', 'vanessa_rocha@grupomegavale.com.br', '$2y$12$Br7DoSC/gBuxUgBoJNve3e3qssGcyRQfLwpdsHbeb72gXKAQKau8W', '0000-00-00 00:00:00'),
(30, 'Mariana Tereza Costa', '2000-03-02', '550.745.219-98', 'mariana-costa99@demasi.com.br', '$2y$12$A.cttjSseZUEGqBVRgZRiezW57PDqpQ3WfKwO9tH0vZ6ZtEf6hNGe', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(11) NOT NULL,
  `id_aluno` bigint(20) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `matriculas`
--

INSERT INTO `matriculas` (`id_matricula`, `id_aluno`, `id_turma`, `criado_em`) VALUES
(30, 19, 9, '2025-11-10 08:18:44'),
(31, 24, 9, '2025-11-10 08:18:44'),
(32, 28, 18, '2025-11-10 08:19:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `id_turma` int(11) NOT NULL,
  `nome_turma` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `nome_turma`, `descricao`, `criado_em`) VALUES
(9, 'Artes visuais', 'Artes visuais', '2025-11-10 08:00:11'),
(10, 'Geometria', 'Geometria', '2025-11-10 08:00:18'),
(11, 'Desenho técnico', 'Desenho técnico', '2025-11-10 08:00:25'),
(12, 'Física', 'Física', '2025-11-10 08:00:36'),
(13, 'Turma 5', 'Turma 5', '2025-11-10 08:00:43'),
(14, 'Turma 6', 'Turma 6', '2025-11-10 08:00:54'),
(15, 'turma 7', 'turma 7', '2025-11-10 08:01:05'),
(18, 'Cálculo', 'Cálculo', '2025-11-10 08:01:30'),
(19, 'História', 'História', '2025-11-10 08:03:30'),
(20, 'Historia da arte', 'Historia da arte', '2025-11-10 08:03:41'),
(21, 'Programação 1', 'Programação', '2025-11-10 08:08:57');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices de tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `fk_aluno` (`id_aluno`),
  ADD KEY `fk_turma` (`id_turma`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id_turma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `fk_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_turma` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
