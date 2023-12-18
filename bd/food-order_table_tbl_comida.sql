
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
(19, 'Gratiss', ' Gratis                         ', '1.02', 'Nome_Prato_atualizado_217.jpg', 35, 'yes', 'yes'),
(20, 'Ovo 500 gr', ' Chocolate com morango ', '10.00', 'Nome_prato_8080.jpg', 38, 'yes', 'yes'),
(21, 'WnxL3nh6N1', '   f0r79Yu2VH   ', '974986.00', 'Nome_Prato_atualizado_8644.jpg', 35, 'yes', 'yes'),
(22, 'OnMt5Mq1u3', ' 2A1dJzKnKv ', '289753.00', 'Nome_Prato_atualizado_4442.jpg', 35, 'yes', 'yes'),
(23, 'tz54n3NxRb', '3lrOAMzoBF', '89172.00', 'Nome_prato_3148.jpg', 44, 'yes', 'yes'),
(24, '0xvNw1KQAO', '   4EFKDSLZhV   ', '306422.00', 'Nome_Prato_atualizado_788.jpg', 44, 'yes', 'yes'),
(25, 'zYPNyMcvBU', 'l0GocsfYrI', '708650.00', 'Nome_prato_7896.jpg', 42, 'yes', 'yes');
