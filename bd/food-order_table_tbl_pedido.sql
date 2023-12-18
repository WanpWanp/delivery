
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
(1, 'Ovo 500 gr', '10.00', 3, '30.00', '2022-03-31 10:58:18', 'Encomendado', 'Axl Rose', '1961879272', 'kjzuo@gsx6.com', 'ZNZAzCAhPf'),
(2, 'Ovo 500 gr', '10.00', 5, '50.00', '2022-03-31 10:59:12', 'Encomendado', 'Axl Rose', '2564093138', '3t07b@6rd1.com', 'bmxUKNNNOZ'),
(3, 'Ovo 500 gr', '10.00', 1, '10.00', '2022-03-31 11:00:38', 'Encomendado', 'Axl Rose', '7330141639', 'cnrpi@3fme.com', 'YWfUoP0cdX'),
(4, 'Ovo 500 gr', '10.00', 1, '10.00', '2022-04-26 02:39:41', 'Encomendado', 'Axl Rose', '1737217178', 'ntmqx@j484.com', 'kgbJ3r8MVe');
