-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Maio-2018 às 00:39
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_veiculos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `descricao`) VALUES
(38, 'SW MÃ‰DIO'),
(39, 'SW GRANDE'),
(40, 'MONOCAB'),
(41, 'GRANDCAB'),
(42, 'SPORTS'),
(43, 'PICK-UPS PEQUENAS'),
(44, 'PICK-UPS GRANDES'),
(45, 'FURGÃ•ES');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cnh` varchar(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf`, `cnh`, `telefone`, `email`, `endereco`, `data_nasc`) VALUES
(7, 'Leonardo Soletti', '998.985.464-56', '34334545756', '(51)99999-9999', 'soletti@ulbra.com', 'Rua Flores da cunha, 150 - Centro - Tapes/RS', '1989-12-22'),
(14, 'Rafael Cavallin Oliveira', '121.232.342-34', '23434646453', '(51)34534-5345', 'rafael.cavallin89@gmail.com', 'Rua Flores da cunha, 150 - Centro - Tapes/RS', '1989-12-22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cores`
--

CREATE TABLE `cores` (
  `id_cor` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cores`
--

INSERT INTO `cores` (`id_cor`, `descricao`) VALUES
(1, 'Preto'),
(2, 'Verde'),
(4, 'Prata'),
(17, 'Pink');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filiais`
--

CREATE TABLE `filiais` (
  `id_filial` int(11) UNSIGNED NOT NULL,
  `nome_fantasia` varchar(50) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `endereco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filiais`
--

INSERT INTO `filiais` (`id_filial`, `nome_fantasia`, `cnpj`, `endereco`) VALUES
(4, 'Space Auto', '33.333.333/3333-33', 'Rua blÃ¡ blÃ¡ blÃ¡'),
(5, 'Perfor Auto', '23.242.342/3423-42', 'Sei lÃ¡ onde fica, 44 - Porto Alegre/RS'),
(9, 'Seila num sei ', '23.456.554/3245-67', 'nunca nem vi'),
(11, 'Pelotas Car', '34.354.424/5432-43', 'Bem longe, 233 - Pelotas/RS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_usuario`, `nome`, `login`, `email`, `senha`, `data_nasc`) VALUES
(2, 'Julia cavallin', 'JuliaC', 'juliacavallin9@hotmail.com', '223445', '2000-11-10'),
(3, 'Camila Oliveira', 'Oliveira', 'camilacavallin@hotmail.com', '34567', '2000-10-11'),
(5, 'Helena Oliveira', 'HOliveira', 'helena@carros.com', '3456778', '1977-08-30'),
(11, 'Marcos', 'mama', 'mam@mama.com', '234567', '2000-04-04'),
(12, 'julieta', 'juju', 'juju@hotmail.com', '333444555', '1989-12-22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacoes`
--

CREATE TABLE `locacoes` (
  `id_locacao` int(11) UNSIGNED NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_retirada` date NOT NULL,
  `data_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `locacoes`
--

INSERT INTO `locacoes` (`id_locacao`, `id_cliente`, `id_veiculo`, `id_funcionario`, `data_retirada`, `data_entrega`) VALUES
(1, 3, 2, 5, '2018-04-13', '2018-04-25'),
(6, 7, 4, 5, '2018-05-23', '2018-05-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) UNSIGNED NOT NULL,
  `descricao_marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`id_marca`, `descricao_marca`) VALUES
(1, 'Fiat'),
(2, 'Audi'),
(3, 'Wolksvagem'),
(4, 'BMW'),
(5, 'Chevrolet');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos`
--

CREATE TABLE `modelos` (
  `id_modelo` int(11) UNSIGNED NOT NULL,
  `id_marca` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modelos`
--

INSERT INTO `modelos` (`id_modelo`, `id_marca`, `descricao`) VALUES
(2, 5, 'Corsa'),
(4, 3, 'Gol G5'),
(5, 4, 'X6'),
(6, 1, 'Uno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id_veiculo` int(11) UNSIGNED NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_modelo` int(11) DEFAULT NULL,
  `id_cor` int(11) DEFAULT NULL,
  `placa` varchar(7) DEFAULT NULL,
  `ano` int(4) NOT NULL,
  `id_filial` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id_veiculo`, `id_marca`, `id_modelo`, `id_cor`, `placa`, `ano`, `id_filial`, `id_categoria`) VALUES
(14, 3, 4, 4, 'IUU-332', 2017, 11, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `cnh` (`cnh`);

--
-- Indexes for table `cores`
--
ALTER TABLE `cores`
  ADD PRIMARY KEY (`id_cor`);

--
-- Indexes for table `filiais`
--
ALTER TABLE `filiais`
  ADD PRIMARY KEY (`id_filial`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `locacoes`
--
ALTER TABLE `locacoes`
  ADD PRIMARY KEY (`id_locacao`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id_modelo`);

--
-- Indexes for table `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id_veiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cores`
--
ALTER TABLE `cores`
  MODIFY `id_cor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `filiais`
--
ALTER TABLE `filiais`
  MODIFY `id_filial` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `locacoes`
--
ALTER TABLE `locacoes`
  MODIFY `id_locacao` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id_modelo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
