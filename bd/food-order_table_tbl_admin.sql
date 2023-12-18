
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
(9, 'Willian Axl', 'Willian A N', '13e8138d7314d299857f15071bf81319'),
(13, 'Theo Caires', 'Theo C N', '55c57ff7d1e6cfe238ebe153be419047'),
(14, 'Ana Carolina Caires ', 'Ana C C', '55c57ff7d1e6cfe238ebe153be419047'),
(46, 'Eu', 'admin10', '4fbd41a36dac3cd79aa1041c9648ab89'),
(47, 'Marinês', 'admin100', '5136b96817648b5b81008f6a984284a7'),
(48, 'Maria ', 'admin1000', 'fc65c210f52af118328cd6e1617be32b'),
(49, 'GURU-GURU', 'GURU-GURU', '64a1a80baee10c3d1c7ef1da0a178f1c'),
(50, 'GURU-GURU10', 'GURU-GURU10', 'a2cf9ed9aad4a9ab62cb15a2f035e8b5');
