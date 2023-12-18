-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Abr-2022 às 16:25
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `food-order`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_completo` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `nome_completo`, `nome_usuario`, `senha`) VALUES
(9, 'Willian Axl n', 'Willian A N', '13e8138d7314d299857f15071bf81319'),
(13, 'Theo Caires', 'Theo C N', '55c57ff7d1e6cfe238ebe153be419047'),
(14, 'Ana Carolina Caires ', 'Ana C C', '55c57ff7d1e6cfe238ebe153be419047'),
(47, 'Marinês', 'admin100', '5136b96817648b5b81008f6a984284a7'),
(48, 'Maria ', 'admin1000', 'fc65c210f52af118328cd6e1617be32b'),
(49, 'GURU-GURU', 'GURU-GURU', '64a1a80baee10c3d1c7ef1da0a178f1c'),
(50, 'GURU-GURU10', 'GURU-GURU10', 'a2cf9ed9aad4a9ab62cb15a2f035e8b5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `destaque` varchar(10) NOT NULL,
  `ativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id`, `titulo`, `nome_imagem`, `destaque`, `ativo`) VALUES
(44, 'Momo 2', 'Prato_Categoria_526.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_comida`
--

CREATE TABLE `tbl_comida` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `destaque` varchar(10) NOT NULL,
  `ativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_comida`
--

INSERT INTO `tbl_comida` (`id`, `titulo`, `descricao`, `preco`, `nome_imagem`, `categoria_id`, `destaque`, `ativo`) VALUES
(20, 'Ovo 500 gr', '       Chocolate com morango       ', '10.00', 'Nome_prato_8080.jpg', 38, 'yes', 'yes'),
(21, 'WnxL3nh6N1', '   f0r79Yu2VH   ', '974986.00', 'Nome_Prato_atualizado_8644.jpg', 35, 'yes', 'yes'),
(23, 'tz54n3NxRb', '3lrOAMzoBF', '89172.00', 'Nome_prato_3148.jpg', 44, 'yes', 'yes'),
(25, 'zYPNyMcvBU', ' l0GocsfYrI ', '70.00', 'Nome_prato_7896.jpg', 42, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `prato` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `data_pedido` datetime NOT NULL,
  `atual_status` varchar(50) NOT NULL,
  `nome_cliente` varchar(150) NOT NULL,
  `contato_cliente` varchar(20) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `endereco_cliente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id`, `prato`, `preco`, `qtd`, `total`, `data_pedido`, `atual_status`, `nome_cliente`, `contato_cliente`, `email_cliente`, `endereco_cliente`) VALUES
(2, 'Ovo 500 gr', '10.00', 5, '50.00', '2022-03-31 10:59:12', 'Em entrega', 'Axl Rose', '2564093138', '3t07b@6rd1.com', 'bmxUKNNNOZ'),
(3, 'Ovo 500 gr', '10.00', 1, '10.00', '2022-03-31 11:00:38', 'Entregue', 'Axl Rose', '7330141639', 'cnrpi@3fme.com', 'YWfUoP0cdX'),
(4, 'Ovo 500 gr', '10.00', 1, '10.00', '2022-04-26 02:39:41', 'Encomendado', 'Axl Rose', '1737217178', 'ntmqx@j484.com', 'kgbJ3r8MVe'),
(5, 'Gratiss', '1.02', 1, '1.02', '2022-04-26 02:55:21', 'Encomendado', 'Axl Rose', '+55 () 9 ', 'hmyp0@bf2e.com', 'J5OLdhSYbf'),
(6, 'Ovo 500 gr', '10.00', 1, '10.00', '2022-04-26 02:59:05', 'Encomendado', 'Axl Rose', '+55 (31) 9 ', 'kvbgb@vfbr.com', '6B3CUixeQs'),
(7, 'Gratiss', '1.02', 1, '1.02', '2022-04-26 03:01:07', 'Encomendado', 'Axl Rose', '+55 (31) 9 ', 'efigs@2v5r.com', 'mL2qKpsGZf');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_comida`
--
ALTER TABLE `tbl_comida`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `tbl_comida`
--
ALTER TABLE `tbl_comida`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
