
-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_comida_2`
--

CREATE TABLE `tbl_comida_2` (
  `id` int(10) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_comida_2`
--

INSERT INTO `tbl_comida_2` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Gratiss', ' Gratis                         ', '1.02', 'Nome_Prato_atualizado_217', 35, 'yes', 'yes'),
(2, 'teste 1', 'sssss', '5.00', 'Food-Name-9753.jpg', 33, 'Yes', 'Yes');
