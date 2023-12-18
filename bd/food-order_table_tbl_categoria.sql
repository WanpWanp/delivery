
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
(33, 'Burguers', 'Prato_Categoria_atualizado_156.jpg', 'yes', 'yes'),
(35, 'Momo', 'Prato_Categoria_atualizado_90.jpg', 'yes', 'yes'),
(38, 'Pizza', 'Prato_Categoria_atualizado_606.jpg', 'yes', 'yes'),
(42, 'Água', 'Prato_Categoria_782.jpeg', 'yes', 'yes'),
(43, 'Burguer 2', 'Prato_Categoria_969.jpg', 'yes', 'yes'),
(44, 'Momo 2', 'Prato_Categoria_526.jpg', 'yes', 'yes');
