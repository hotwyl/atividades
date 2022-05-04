-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql743.umbler.com:3306
-- Tempo de geração: 04-Maio-2022 às 21:41
-- Versão do servidor: 5.6.50
-- versão do PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dataarqmm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `database_send`
--

CREATE TABLE `database_send` (
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_nome` varchar(35) NOT NULL,
  `dummy_one` varchar(2) NOT NULL,
  `dummy_two` varchar(2) NOT NULL,
  `dummy_three` varchar(2) NOT NULL,
  `dummy_four` varchar(2) NOT NULL,
  `dummy_five` varchar(2) NOT NULL,
  `dummy_six` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `database_send`
--

INSERT INTO `database_send` (`register_time`, `email_nome`, `dummy_one`, `dummy_two`, `dummy_three`, `dummy_four`, `dummy_five`, `dummy_six`) VALUES
('2021-10-07 13:55:04', 'pedrogcs0104@gmail.com', '0', '0', '0', '0', '0', '0'),
('2021-10-07 19:33:30', 'tetracoach@hotmail.com', '24', '27', '19', '24', '27', '25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
