-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Ago-2018 às 17:34
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verao`
--
CREATE DATABASE IF NOT EXISTS `verao` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `verao`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`id`, `id_user`, `foto`, `id_post`) VALUES
(1, 11, 'imagens/utilizadores//galeria/image_content_381482_20161207185716.jpg', 20),
(3, 12, 'imagens/utilizadores//galeria/adminicon.png', 30),
(6, 11, 'imagens/utilizadores//galeria/13428581_1082178015154462_4024636837005408618_n.jpg', 73);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL,
  `hobbie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `hobbies`
--

INSERT INTO `hobbies` (`id`, `hobbie`) VALUES
(1, 'Jogar Jogos'),
(2, 'Programar'),
(3, 'Música'),
(4, 'Praia'),
(5, 'Ir ás Compras'),
(6, 'Chill'),
(7, 'Viajar'),
(8, 'Comer'),
(9, 'Fumar'),
(10, 'Cantar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hobbie_user`
--

CREATE TABLE `hobbie_user` (
  `id` int(11) NOT NULL,
  `id_hobbie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `hobbie_user`
--

INSERT INTO `hobbie_user` (`id`, `id_hobbie`, `id_user`) VALUES
(15, 2, 12),
(21, 1, 13),
(22, 3, 13),
(23, 4, 13),
(24, 5, 13),
(25, 6, 13),
(26, 7, 13),
(27, 8, 13),
(28, 9, 13),
(31, 9, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id_notificacao` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `vista` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user_postou` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `post` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `notificado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user_postou`, `id_perfil`, `post`, `data`, `notificado`) VALUES
(20, 11, 11, 'Marial leal 4 the win', '2018-08-01 18:12:01', 0),
(30, 12, 12, 'yup', '2018-08-03 01:50:42', 0),
(33, 12, 12, '<div class=\"text-center\"><iframe  width=\"425\" height=\"344\" src=\"https://www.youtube.com/embed/52R-znOwjkk\" frameborder=\"0\" allowfullscreen></iframe></div></a>', '2018-08-03 01:51:49', 0),
(37, 12, 11, 'teste', '2018-08-06 21:05:41', 0),
(45, 12, 11, 'prrrr', '2018-08-08 19:48:20', 0),
(73, 11, 11, 'asdasd', '2018-08-17 19:53:10', 0),
(74, 11, 11, 'xD', '2018-08-17 19:53:31', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_nome` text NOT NULL,
  `l_nome` text NOT NULL,
  `idade` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sobre` varchar(255) NOT NULL DEFAULT 'Este utilizador ainda não alterou o Sobre.',
  `foto` varchar(255) NOT NULL DEFAULT 'imagens/avatar.png',
  `ativado` int(11) NOT NULL DEFAULT '0',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `f_nome`, `l_nome`, `idade`, `email`, `username`, `password`, `sobre`, `foto`, `ativado`, `token`) VALUES
(11, 'Gabriel', 'Brandão', 18, 'deostulti2@gmail.com', 'bakill3', '$2y$10$wfc3OiVBSZPjgEZiBPMvSuTRawSJrS/QjFwhmln5hHVdE5/D8FaGm', 'I am the owner of the website skr pop pop', 'imagens/utilizadores/11/13887140_1110308685674728_7610077163472250184_n.jpg', 1, '41709378'),
(12, 'Admin', 'Website', 18, 'admin@gmail.com', 'admin', '$2y$10$C6adJ.MaPc34AXBs1dqEqeP9bSup.npaDQiii8IdQpiliyTVzdGq6', 'Admin of the Website', 'imagens/utilizadores/12/anonymous-512.png', 1, '28498090'),
(13, 'Alexandre', 'Rosado', 18, 'alexandreluisrosado1@gmail.com', 'Chupa-me lo coño', '$2y$10$Xk9F43u3wY..b7c1KUNcXe7hWNmZBDJezwPiBgaT5j1S/.jDq2Nju', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '16950194');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`) USING BTREE;

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobbie_user`
--
ALTER TABLE `hobbie_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hobbie` (`id_hobbie`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id__user` (`id_user`),
  ADD KEY `id_postt` (`id_post`);

--
-- Indexes for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id_notificacao`),
  ADD KEY `id_user_sender` (`sender`),
  ADD KEY `id_user_receiver` (`receiver`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user_postou`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hobbie_user`
--
ALTER TABLE `hobbie_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `galeria_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `hobbie_user`
--
ALTER TABLE `hobbie_user`
  ADD CONSTRAINT `hobbie_user_ibfk_1` FOREIGN KEY (`id_hobbie`) REFERENCES `hobbies` (`id`),
  ADD CONSTRAINT `hobbie_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacoes_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user_postou`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
