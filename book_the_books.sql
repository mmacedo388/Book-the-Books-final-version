-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Abr-2023 às 17:40
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `book_the_books`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `price`, `description`, `img`, `quantity`, `category`, `sub_category`) VALUES
(1, 'O Buraco da Agulha', '19.90', 'Ken Follett', 'book_1.jpg', '100', 'Literatura', 'Policial e Thriller'),
(2, 'Ao Cair da Noite', '17.90', 'Judith McNaught', 'book_2.jpg', '50', 'Literatura', 'Romance'),
(3, 'A Última Odisseia', '18.90', 'James Rollins', 'book_3.jpg', '25', 'Literatura', 'Policial e Thriller'),
(4, 'Paranoia', '16.90', 'Lisa Jackson', 'book_4.jpg', '15', 'Literatura', 'Policial e Thriller'),
(5, 'Sol da Meia-Noite', '26.90', 'Stephenie Meyer', 'book_5.jpg', '30', 'Literatura', 'Jovem Adulto'),
(6, 'D. Filipa de Lencastre', '14.90', 'Isabel Stilwell', 'book_6.jpg', '45', 'Infantil (até 6 anos)', 'Ficção');

-- --------------------------------------------------------

--
-- Estrutura da tabela `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `form`
--

INSERT INTO `form` (`id`, `name`, `email`, `gender`, `age`, `message`, `registration_date`) VALUES
(1, 'Miguel Macedo', 'mmacedo388@hotmail.com', 'M', '0-29', 'Hi!', '2023-01-14 18:17:24'),
(3, 'Miguel Macedo', 'mmacedo388@hotmail.com', 'M', '0-29', 'Hi!\r\n', '2023-02-04 17:42:44'),
(4, 'Miguel Macedo', 'mmacedo388@hotmail.com', 'M', '0-29', 'Hi!\r\n', '2023-02-04 17:42:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `user`, `email`, `password`, `admin`) VALUES
(1, 'Miguel de Portugal', 'mmacedo388@hotmail.com', '$2y$10$e8Ia.CvUWo6J6cZCmfmoTOhJmlyxyUIrRu3hOPw0JyvXubcC4PF3i', 1), -- password == 123
(2, 'Ninguém', 'nayron@gmail.com', '$2y$10$0NyRoQCucA7ofTjIkpuSxe5.yaj3yFHsyu.Bm2WW63mWp6f3i.1/a', 0); -- password == 123


--
-- Estrutura da tabela `order`
--

CREATE TABLE `order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_zip` char(8) DEFAULT NULL,
  `lines` json DEFAULT NULL,
  `payment_method` enum('at_delivery','mbway') DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
