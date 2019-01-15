-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 21-Out-2018 às 17:33
-- Versão do servidor: 5.6.40-84.0-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialsi_verao_en`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado_civil`
--

CREATE TABLE `estado_civil` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estado_civil`
--

INSERT INTO `estado_civil` (`id_estado`, `estado`) VALUES
(1, 'Solteiro(a)'),
(2, 'Numa Relação'),
(3, 'Complicado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`id`, `id_user`, `foto`, `id_post`) VALUES
(1, 11, 'imagens/utilizadores//galeria/image_content_381482_20161207185716.jpg', 20),
(3, 12, 'imagens/utilizadores//galeria/adminicon.png', 30),
(6, 11, 'imagens/utilizadores//galeria/13428581_1082178015154462_4024636837005408618_n.jpg', 73),
(7, 11, 'imagens/utilizadores//galeria/51.jpg', 75),
(9, 11, 'imagens/utilizadores//galeria/gifi.gif', 144),
(12, 11, 'imagens/utilizadores//galeria/skr.gif', 152),
(14, 11, 'imagens/utilizadores//galeria/in1.png', 154),
(16, 39, 'imagens/utilizadores//galeria/small-memory-lp.jpg', 159);

-- --------------------------------------------------------

--
-- Estrutura da tabela `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL,
  `hobbie` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
(94, 3, 15),
(95, 6, 15),
(96, 7, 15),
(97, 9, 15),
(104, 1, 25),
(105, 2, 25),
(106, 3, 25),
(107, 6, 25),
(108, 7, 25),
(109, 8, 25),
(111, 3, 14),
(114, 2, 33),
(115, 3, 33),
(116, 10, 33),
(172, 3, 34),
(173, 4, 34),
(174, 6, 34),
(175, 7, 34),
(176, 8, 34),
(177, 3, 39),
(178, 5, 39),
(179, 6, 39),
(180, 7, 39),
(184, 5, 54),
(185, 9, 54),
(211, 1, 11),
(212, 2, 11),
(213, 3, 11),
(214, 6, 11),
(215, 7, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `id_post`) VALUES
(101, 12, 96),
(131, 25, 144),
(132, 14, 144),
(133, 14, 96),
(134, 11, 148),
(143, 11, 96),
(156, 25, 152),
(167, 35, 148),
(168, 35, 156),
(170, 11, 157),
(178, 11, 162),
(180, 11, 90),
(185, 12, 160),
(189, 12, 154),
(190, 12, 144),
(191, 12, 143),
(192, 12, 95),
(193, 12, 75),
(194, 12, 74),
(195, 12, 73),
(196, 12, 37),
(217, 11, 143),
(223, 11, 37),
(236, 11, 156),
(243, 11, 75),
(245, 11, 146),
(251, 11, 154),
(252, 11, 74),
(253, 11, 73),
(256, 11, 95);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `latitude` varchar(300) NOT NULL,
  `longitude` varchar(300) NOT NULL,
  `ip` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `locations`
--

INSERT INTO `locations` (`id`, `latitude`, `longitude`, `ip`) VALUES
(11, '40.8621384', '-8.6325718', '89.152.150.9'),
(12, '40.7127', '-74.0059', '66.102.8.149'),
(13, '34.05', '-118.25', '66.102.8.151'),
(14, '40.9124552', '-8.4986512', '188.82.133.180'),
(15, '40.89813', '-8.4885339', '87.196.72.58'),
(16, '41.0917047', '-8.5896048', '87.196.72.47'),
(17, '41.2366474', '-8.670358', '213.58.148.170'),
(18, '41.3574336', '-8.7450978', '94.61.163.23'),
(19, '41.1582355', '-8.6341075', '188.250.7.88'),
(20, '40.8604302', '-8.6299629', '83.223.251.7'),
(21, '40.8604302', '-8.6299629', '83.223.235.159'),
(22, '40.8604302', '-8.6299629', '87.196.80.90'),
(23, '40.8604302', '-8.6299629', '87.196.80.40'),
(24, '40.8604302', '-8.6299629', '87.196.81.120'),
(25, '40.9733074', '-8.6320456', '87.196.80.112'),
(26, '40.8557733', '-8.6177093', '84.91.4.131'),
(27, '41.608165685729126', '-8.633083948535004', '87.196.81.26'),
(28, '37.1466188', '-8.5499365', '95.95.115.140'),
(29, '41.60817389518729', '-8.633161043916195', '89.180.244.31'),
(30, '46.56276480791626', '6.630129511869059', '213.55.176.169'),
(31, '37.1465792', '-8.5498661', '87.196.73.72'),
(32, '41.0842506', '-8.610581', '144.64.90.95'),
(33, '37.1263195', '-8.596043', '87.196.72.207'),
(34, '40.8051019', '-8.5787147', '213.30.118.100'),
(35, '40.5376608', '-7.255889', '109.51.131.222'),
(36, '40.8557584', '-8.6177472', '213.30.118.101'),
(37, '41.25613938089577', '-8.651439026006173', '83.223.251.164'),
(38, '37.1331265', '-8.5475125', '95.69.73.231'),
(39, '38.6520774', '-8.2067778', '83.223.243.226'),
(40, '37.1465837', '-8.5498573', '87.196.72.56'),
(41, '37.091990374806784', '-8.121770077637215', '176.78.87.59'),
(42, '49.251513527440856', '-123.02596814287463', '50.98.120.128'),
(43, '53.2305658', '6.5410302', '145.97.172.201'),
(44, '40.193418120203155', '-8.411736226489094', '193.137.79.175'),
(45, '38.81494250000001', '-9.3369742', '148.69.88.195'),
(46, '38.5636797', '-7.9192122000000005', '85.243.190.193'),
(47, '41.8369', '-87.6847', '66.102.8.67'),
(48, '37.1251992', '-8.5887575', '87.196.73.64'),
(49, '37.1363809', '-8.5443892', '87.196.72.21'),
(50, '37.1470812', '-8.5449723', '87.196.73.23'),
(51, '37.1188791', '-8.5440628', '188.140.84.109'),
(52, '2.1879225', '102.2490808', '14.192.215.88');

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id_mess` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id_mess`, `user_from`, `user_to`, `message`, `data`) VALUES
(39, 11, 12, 'teste1', '2018-09-26 00:55:11'),
(40, 12, 11, 'teste2', '2018-09-26 00:55:16'),
(41, 11, 14, 'ya', '2018-09-26 01:44:03'),
(42, 11, 12, 'a', '2018-09-26 02:00:06'),
(45, 11, 12, 'mandei sms', '2018-09-26 02:02:39'),
(47, 11, 11, 't', '2018-09-26 02:34:02'),
(48, 11, 12, 'test', '2018-09-26 05:24:59'),
(50, 12, 11, 'tao caralho', '2018-09-26 05:41:00'),
(51, 12, 11, 'porra wi', '2018-09-26 05:41:02'),
(52, 11, 12, 'che foda', '2018-09-26 05:41:13'),
(53, 11, 12, 'ta a abusar', '2018-09-26 05:41:19'),
(54, 11, 12, 'a', '2018-09-26 05:54:32'),
(58, 12, 11, 'a', '2018-09-26 06:02:06'),
(59, 11, 12, 'ya', '2018-09-26 15:09:00'),
(60, 12, 11, 'y', '2018-09-26 15:10:04'),
(61, 12, 11, 'y', '2018-09-26 15:10:04'),
(62, 12, 11, 'y', '2018-09-26 15:10:04'),
(63, 12, 11, 'y\n', '2018-09-26 15:10:04'),
(64, 12, 11, '', '2018-09-26 15:10:05'),
(65, 12, 11, 'y', '2018-09-26 15:10:05'),
(66, 12, 14, 'ya', '2018-09-26 15:11:11'),
(67, 12, 11, 'ya', '2018-09-26 15:11:21'),
(68, 11, 12, '', '2018-09-26 15:11:39'),
(69, 11, 12, '', '2018-09-26 15:11:40'),
(70, 12, 11, '&lt;h5&gt;teste&lt;/h5&gt;', '2018-09-26 15:12:34'),
(71, 12, 11, '\'', '2018-09-26 15:12:43'),
(72, 12, 11, '\'; --', '2018-09-26 15:12:50'),
(73, 11, 12, '!&quot;#$%&amp;/()', '2018-09-26 15:14:41'),
(74, 11, 12, '\'; DROP TABLE; --', '2018-09-26 15:14:48'),
(75, 11, 12, 'l', '2018-09-26 15:59:22'),
(76, 11, 11, 'a', '2018-09-26 19:56:02'),
(77, 11, 12, 'coco', '2018-09-26 20:47:19'),
(78, 11, 24, 'boo', '2018-09-27 09:01:40'),
(79, 25, 11, 'Hey Maluco xD', '2018-09-27 09:49:05'),
(80, 25, 11, 'Já vi que acabaste o site', '2018-09-27 09:49:12'),
(81, 25, 11, 'Hard Work pays for it', '2018-09-27 09:49:19'),
(82, 11, 25, 'che boy', '2018-09-27 10:39:59'),
(83, 11, 25, 'ainda faltam muitas cenas', '2018-09-27 10:52:24'),
(84, 11, 25, 'https://github.com/bakill3/social_network', '2018-09-27 11:00:21'),
(85, 11, 11, 'a', '2018-09-27 11:02:10'),
(86, 25, 11, 'mas não tá nada mau tho', '2018-09-27 14:07:58'),
(87, 25, 11, 'tá bem fixe até', '2018-09-27 14:08:04'),
(88, 11, 12, 'c', '2018-09-27 17:25:49'),
(89, 11, 12, 'cona', '2018-09-28 06:28:08'),
(90, 11, 32, 'cona é que é bom SKRR', '2018-09-28 19:54:03'),
(91, 11, 32, 'skr pop pop', '2018-09-28 19:56:28'),
(92, 11, 32, 't', '2018-09-28 20:44:48'),
(93, 11, 11, 'oi', '2018-09-30 09:50:37'),
(94, 34, 34, 'Hi there!', '2018-09-30 17:19:35'),
(95, 34, 34, 'Hi there!', '2018-09-30 17:20:06'),
(96, 34, 34, 'Hi there!\n', '2018-09-30 17:20:09'),
(97, 11, 34, ':D', '2018-10-01 17:09:30'),
(98, 33, 11, 'Boas, tudo bem?', '2018-10-06 15:20:27'),
(99, 33, 11, 'Foste tu que programaste o site ou utiliza-te o wordpress?', '2018-10-06 15:20:59'),
(100, 11, 33, 'boas, programei o site ', '2018-10-06 15:22:55'),
(101, 11, 33, 'https://github.com/bakill3/social_network', '2018-10-06 15:30:20'),
(102, 33, 11, 'Está bastante bem feito, estás de parabéns. Se precisares de ajuda, a nível de design (que é a minha área) diz que eu tento-te ajudar no que puder', '2018-10-06 15:30:46'),
(103, 11, 33, 'Obrigado, atualmente estou a usar bootstrap (estou a focar-me mais na programação).', '2018-10-06 15:32:16'),
(104, 33, 11, 'Ok, continua que está a ficar porreiro', '2018-10-06 15:33:15'),
(105, 33, 11, 'Estás a usar o bootstrap para adaptar a diferentes tipos de ecrã certo?', '2018-10-06 15:33:53'),
(106, 11, 33, 'sim, atualmente está maior parte responsive ', '2018-10-06 15:34:33'),
(107, 33, 11, 'Desculpa a pergunta, mas tu ainda estuda certo?', '2018-10-06 15:36:22'),
(108, 33, 11, 'Estás a estudar informática?', '2018-10-06 15:36:41'),
(109, 33, 11, 'Ou és um curioso como eu?', '2018-10-06 15:37:11'),
(110, 11, 33, 'Estou a acabar módulos atrasados (Gestão e programação de sistemas informáticos), mas para o ano planeio ir para a universidade.', '2018-10-06 15:38:09'),
(111, 11, 33, 'Mas sempre fui curioso por programação 😁', '2018-10-06 15:38:36'),
(112, 33, 11, 'Fazes bem ir, tens jeito pra coisa', '2018-10-06 15:39:20'),
(113, 11, 33, 'Obrigado! ', '2018-10-06 15:40:01'),
(114, 11, 12, 'yo', '2018-10-08 10:27:39'),
(115, 11, 12, 'teste', '2018-10-08 10:33:06'),
(116, 12, 11, 'O QUE É CARALHO', '2018-10-08 10:33:26'),
(117, 12, 11, 'l', '2018-10-08 11:36:56'),
(118, 12, 11, 'a', '2018-10-08 11:42:11'),
(119, 11, 11, 'nice', '2018-10-08 11:42:23'),
(120, 11, 12, 'nice', '2018-10-08 11:42:30'),
(121, 12, 11, 'o', '2018-10-08 11:42:37'),
(122, 11, 25, 'GRELO YEH', '2018-10-09 11:46:41'),
(123, 51, 11, 'heyy', '2018-10-10 13:33:56'),
(124, 51, 11, 'q merda é esta ?', '2018-10-10 13:34:00'),
(125, 11, 51, 'tenho o teu ip ', '2018-10-10 13:52:37'),
(126, 11, 51, 'latitude', '2018-10-10 13:52:40'),
(127, 11, 51, 'e ', '2018-10-10 13:52:42'),
(128, 11, 51, 'longitude', '2018-10-10 13:52:47'),
(129, 11, 51, 'para nao começares com cenas', '2018-10-10 13:52:58'),
(130, 11, 11, 'ssad', '2018-10-10 20:30:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id_notificacao` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `vista` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id_notificacao`, `sender`, `receiver`, `tipo`, `vista`) VALUES
(135, 12, 11, 'like', 1),
(138, 12, 14, 'seguir', 1),
(156, 12, 11, 'mensagem', 1),
(157, 12, 11, 'mensagem', 1),
(158, 12, 11, 'mensagem', 1),
(159, 12, 11, 'mensagem', 1),
(160, 12, 11, 'mensagem', 1),
(161, 12, 11, 'mensagem', 1),
(162, 12, 14, 'mensagem', 1),
(163, 12, 11, 'mensagem', 1),
(166, 12, 11, 'mensagem', 1),
(167, 12, 11, 'mensagem', 1),
(168, 12, 11, 'mensagem', 1),
(173, 11, 15, 'seguir', 0),
(180, 11, 24, 'mensagem', 0),
(181, 25, 11, 'like', 1),
(182, 25, 11, 'mensagem', 1),
(183, 25, 11, 'mensagem', 1),
(184, 25, 11, 'mensagem', 1),
(185, 25, 25, 'post', 1),
(186, 25, 25, 'post', 1),
(187, 25, 11, 'like', 1),
(188, 14, 11, 'like', 1),
(189, 14, 11, 'like', 1),
(190, 14, 14, 'post', 1),
(206, 25, 11, 'mensagem', 1),
(207, 25, 11, 'mensagem', 1),
(226, 32, 11, 'seguir', 1),
(234, 33, 11, 'seguir', 1),
(235, 34, 34, 'mensagem', 1),
(236, 34, 34, 'mensagem', 1),
(237, 34, 34, 'mensagem', 1),
(238, 11, 32, 'seguir', 0),
(239, 11, 14, 'seguir', 0),
(240, 11, 34, 'mensagem', 1),
(241, 11, 34, 'seguir', 1),
(245, 25, 11, 'like', 1),
(246, 25, 11, 'seguir', 1),
(247, 33, 11, 'mensagem', 1),
(248, 33, 11, 'mensagem', 1),
(249, 11, 33, 'mensagem', 1),
(250, 11, 33, 'mensagem', 1),
(251, 33, 11, 'mensagem', 1),
(252, 11, 33, 'mensagem', 1),
(253, 33, 11, 'mensagem', 1),
(254, 33, 11, 'mensagem', 1),
(255, 11, 33, 'mensagem', 1),
(257, 33, 11, 'mensagem', 1),
(259, 33, 11, 'mensagem', 1),
(261, 33, 11, 'mensagem', 1),
(262, 11, 33, 'mensagem', 1),
(263, 11, 33, 'mensagem', 1),
(264, 33, 11, 'mensagem', 1),
(265, 11, 33, 'mensagem', 1),
(266, 11, 33, 'seguir', 1),
(273, 12, 11, 'mensagem', 1),
(274, 12, 11, 'mensagem', 1),
(277, 12, 11, 'mensagem', 1),
(280, 12, 11, 'mensagem', 1),
(287, 35, 14, 'like', 0),
(288, 35, 35, 'post', 1),
(289, 35, 35, 'like', 1),
(290, 35, 35, 'post', 1),
(294, 39, 39, 'post', 1),
(296, 11, 40, 'seguir', 0),
(297, 39, 39, 'post', 1),
(308, 11, 45, 'seguir', 0),
(309, 11, 46, 'seguir', 0),
(314, 12, 43, 'like', 0),
(316, 12, 11, 'like', 1),
(317, 12, 11, 'like', 1),
(318, 12, 11, 'like', 1),
(319, 12, 11, 'like', 1),
(320, 12, 11, 'like', 1),
(321, 12, 11, 'like', 1),
(322, 12, 11, 'like', 1),
(323, 12, 11, 'like', 1),
(324, 12, 11, 'like', 1),
(326, 51, 11, 'mensagem', 1),
(327, 51, 11, 'mensagem', 1),
(328, 11, 51, 'mensagem', 0),
(329, 11, 51, 'mensagem', 0),
(330, 11, 51, 'mensagem', 0),
(331, 11, 51, 'mensagem', 0),
(332, 11, 51, 'mensagem', 0),
(333, 55, 55, 'post', 1),
(334, 54, 54, 'post', 1),
(335, 54, 54, 'post', 1),
(336, 54, 54, 'post', 1),
(337, 54, 54, 'post', 1),
(338, 54, 54, 'post', 1),
(339, 54, 54, 'post', 1),
(340, 54, 54, 'post', 1),
(343, 54, 54, 'post', 1),
(344, 57, 55, 'post', 1),
(345, 11, 51, 'post', 0),
(346, 11, 51, 'post', 0),
(352, 54, 14, 'seguir', 0),
(391, 11, 35, 'like', 0),
(406, 11, 25, 'like', 0),
(412, 11, 12, 'seguir', 0),
(432, 11, 11, 'like', 1),
(433, 11, 11, 'post', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user_postou` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `post` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `data` datetime NOT NULL,
  `notificado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user_postou`, `id_perfil`, `post`, `data`, `notificado`) VALUES
(20, 11, 11, 'Marial leal 4 the win', '2018-08-01 18:12:01', 0),
(30, 12, 12, 'yup', '2018-08-03 01:50:42', 0),
(37, 12, 11, 'teste', '2018-08-06 21:05:41', 0),
(73, 11, 11, 'asdasd', '2018-08-17 19:53:10', 0),
(74, 11, 11, 'xD', '2018-08-17 19:53:31', 0),
(75, 11, 11, 'Marisco', '2018-08-22 20:26:04', 0),
(90, 12, 12, '<div class=\"text-center embed-responsive embed-responsive-21by9\"><iframe class=\"embed-responsive-item\" width=\"425\" height=\"344\" \r\ntitle=\"Video\" src=\"https://www.youtube.com/embed/52R-znOwjkk\" frameborder=\"0\" allowfullscreen></iframe></div></a>', '2018-09-22 20:41:21', 0),
(95, 11, 11, '<div class=\"text-center embed-responsive embed-responsive-21by9\"><iframe class=\"embed-responsive-item\" width=\"425\" height=\"344\"  title=\"Video\" src=\"https://www.youtube.com/embed/M97vR2V4vTs\" frameborder=\"0\" allowfullscreen></iframe></div></a>', '2018-09-22 20:50:30', 0),
(96, 11, 11, '<div class=\"text-center embed-responsive embed-responsive-21by9\"><iframe class=\"embed-responsive-item\" width=\"425\" height=\"344\" \r\n title=\"Video\" src=\"https://www.youtube.com/embed/iVlbZXz7l8c\" frameborder=\"0\" allowfullscreen></iframe></div></a>', '2018-09-22 20:51:43', 0),
(143, 11, 11, 'I am going to 📧 this ✈ company!!! 😡 Teste #01010', '2018-09-24 04:51:44', 0),
(144, 11, 11, 'Aqui está um gif 😎👌👍', '2018-09-24 17:58:24', 0),
(146, 25, 25, 'Damn já tenho 245 views! Fama é assim 🤑', '2018-09-27 09:52:38', 0),
(147, 25, 25, 'Btw, curti do Skrrrt quando se posta cenas 😁🤣', '2018-09-27 09:53:08', 0),
(148, 14, 14, 'Fui obrigada a criar uma conra ! :)))', '2018-09-27 10:07:31', 0),
(152, 11, 25, 'SKR POP POP 😂', '2018-09-27 10:47:32', 0),
(154, 11, 11, 'Mobile results 22/9/18', '2018-10-06 15:36:33', 0),
(156, 35, 35, 'Tudo á vontade Chavallls', '2018-10-08 16:58:58', 0),
(157, 35, 35, 'o ricardo e o joao sao gays ', '2018-10-08 20:04:21', 0),
(158, 39, 39, 'hello?', '2018-10-09 15:01:56', 0),
(159, 39, 39, '🏝', '2018-10-09 17:48:03', 0),
(160, 43, 43, 'Primeiro post', '2018-10-10 04:18:12', 0),
(161, 42, 42, 'bum bum?', '2018-10-10 06:18:00', 0),
(162, 42, 42, 'sigam-me no tt', '2018-10-10 06:00:00', 0),
(166, 54, 54, 'Ora, a serpente era mais astuta que todas as alimárias do campo que o SENHOR Deus tinha feito. E esta disse à mulher: É assim que Deus disse: Não comereis de toda a árvore do jardim?rnrnGênesis 3:1', '2018-10-10 16:46:54', 0),
(167, 54, 54, 'E disse a mulher à serpente: Do fruto das árvores do jardim comeremos,rnrnGênesis 3:2', '2018-10-10 16:47:07', 0),
(168, 54, 54, 'Mas do fruto da árvore que está no meio do jardim, disse Deus: Não comereis dele, nem nele tocareis para que não morrais.rnrnGênesis 3:3', '2018-10-10 16:47:17', 0),
(169, 54, 54, 'Então a serpente disse à mulher: Certamente não morrereis.rnrnGênesis 3:4', '2018-10-10 16:47:32', 0),
(170, 54, 54, 'Porque Deus sabe que no dia em que dele comerdes se abrirão os vossos olhos, e sereis como Deus, sabendo o bem e o mal.rnrnGênesis 3:5', '2018-10-10 16:47:42', 0),
(194, 11, 11, 'Novo Homepage 😀😁', '2018-10-12 20:52:55', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

CREATE TABLE `seguidores` (
  `id_seg` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_seguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `seguidores`
--

INSERT INTO `seguidores` (`id_seg`, `id_user`, `id_seguidor`) VALUES
(19, 12, 13),
(82, 13, 11),
(83, 11, 12),
(84, 11, 13),
(85, 11, 11),
(126, 14, 12),
(138, 15, 11),
(141, 25, 11),
(147, 11, 32),
(149, 11, 33),
(150, 32, 11),
(151, 14, 11),
(152, 34, 11),
(153, 11, 25),
(154, 33, 11),
(156, 35, 11),
(157, 40, 11),
(158, 45, 11),
(159, 46, 11),
(161, 14, 54),
(164, 12, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_nome` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `l_nome` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `idade` int(11) NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `sobre` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Este utilizador ainda não alterou o Sobre.',
  `foto` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'imagens/avatar.png',
  `ativado` int(11) NOT NULL DEFAULT '0',
  `token` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `facebook` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `twitter` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `f_nome`, `l_nome`, `idade`, `email`, `username`, `password`, `sobre`, `foto`, `ativado`, `token`, `ip`, `facebook`, `instagram`, `twitter`, `id_estado`) VALUES
(11, 'Gabriel', 'Brandão 😎', 18, 'deostulti2@gmail.com', 'bakill3', '$2y$10$wfc3OiVBSZPjgEZiBPMvSuTRawSJrS/QjFwhmln5hHVdE5/D8FaGm', 'I am the owner of the website. New Emojis 😄😜👌', 'imagens/utilizadores/11/13887140_1110308685674728_7610077163472250184_n.jpg', 1, '41709378', '', 'https://www.facebook.com/gabriel.brandao.1610', 'https://www.instagram.com/gabriel.brandao2000/', 'https://www.twitter.com/bakill3', 1),
(12, 'Admin', 'Website', 18, 'admin@gmail.com', 'admin', '$2y$10$C6adJ.MaPc34AXBs1dqEqeP9bSup.npaDQiii8IdQpiliyTVzdGq6', 'Admin of the Website', 'imagens/utilizadores/12/anonymous-512.png', 1, '28498090', '', '', '', '', 1),
(13, 'Alexandre', 'Rosado', 18, 'alexandreluisrosado1@gmail.com', 'Chupa-me lo coño', '$2y$10$Xk9F43u3wY..b7c1KUNcXe7hWNmZBDJezwPiBgaT5j1S/.jDq2Nju', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '16950194', '', '', '', '', 1),
(14, 'Eurídice', 'Brandão', 15, 'inesleite.2003@hotmail.com', 'Eurídice_17', '$2y$10$v2CBSznYv60jlkv.Q4jcluF2UIFjTSalJKzxn/2KcxyLvvQy2KeWu', 'Fui obrigada a ter uma conta nesta “rede social”', 'imagens/utilizadores/14/D969C83B-BE3D-4E49-880F-502C671EE857.jpeg', 1, '47384078', '', '', '', '', 1),
(15, 'Joaquim', 'Kulatra', 70, 'convidado@gmail.com', 'joaquim_kulatra', '$2y$10$AeuoxtWobPiiQ1OmSauJzeISEXC5Z.63rLSjRaOVY.zhpOatKroVO', 'Este utilizador ainda não alterou o Sobre.', 'imagens/utilizadores/15/14671567_VNf48.jpg', 1, '59694617', '', '', '', '', 1),
(24, 'Teste1', 'Teste2', 21, 'programming.gabriel.2000@gmail.com', 'testezinho', '$2y$10$TsPrvoCCb5/tQtKAl7Y9/.C/hfq.fqox4rIao5ldcZX7k34QlvQL.', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '53126899', '', '', '', '', 1),
(25, 'Pedro', 'Rodrigues', 17, 'pedro.frod23@gmail.com', 'pedrocaspt00', '$2y$10$ldHAC3OTrlCrietDJOeZSu8rpWq0D/kO9uP2uIchjAlka5llsPg6C', 'Sou o Sub Desenvolvedor deste site... Jk não fiz nada 😅', 'imagens/utilizadores/25/depositphotos_134331264-stock-photo-portrait-of-fabulous-long-nosed.jpg', 1, '87207879', '', '', '', '', 1),
(29, 'Porfirio', 'Brandão', 18, 'porfiriobrandao-1023p@adv.oa.pt', 'porfiriobrandao-1023p@adv.oa.p', '$2y$10$g6Ir4aCVWckRxJA/7bM0ducoAUA8GCp4tBpCy.4eUeR26QUX9UIs.', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '90217593', '2.83.91.54', '', '', '', 1),
(30, 'soomething', 'soomone', 20, 'Smat1951@teleworm.us', 'uranus', '$2y$10$mRGp6a4t6Wbu1L/3FjBzq.23ONySDWebnbOOJ/5pGEvLKJxITuaWa', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 0, '27201312', '95.93.160.225', '', '', '', 1),
(31, 'Camacho', 'Camacho', 15, 'teste@gmail.com', 'Teste', '$2y$10$Jqhxm1iECw7XedIfhz.DbuOTkhLruoVqmgGZ6kcEDmrCEX8qingde', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 0, '37569112', '82.154.38.217', '', '', '', 1),
(32, 'dejo', 'dejo', 20, 'dejo@mymail90.com', 'dejo', '$2y$10$WyyCzGlQx8K7zxNVum/yJeLpaxKmAhjOc0vivHQesr8JkU/1eC3qG', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '89395805', '95.93.160.225', '', '', '', 1),
(33, 'Gabriel', 'Vicente', 20, 'gabrielvicent98@gmail.com', 'gabrielvi98', '$2y$10$L9ESCkDSVoAqKoIhbuQUseY9JldOaH5V7LVFboviyzG8osWttTrE.', 'Este utilizador ainda não alterou o Sobre.', 'imagens/utilizadores/33/IMG_4016.png', 1, '40835087', '109.48.22.56', '', '', '', 1),
(34, 'J', 'Braga', 38, 'joanabragaid@gmail.com', 'Joana Braga', '$2y$10$2obRVtvnthom/StX/KUCkuj9V4GTo/g8eYZP/DLTtxI/2E3AKdocu', 'Este utilizador ainda não alterou o Sobre.', 'imagens/utilizadores/34/FB_IMG_1538941035274.jpg', 1, '12203853', '94.61.163.23', '', '', '', 1),
(35, 'Joao', 'Andrade', 20, 'palito123456@hotmail.com', 'Palito124', '$2y$10$os364TZreG9sVTxDwfGVSOJimKbP.JkcJl40ZEEAkhdFX582wRaz.', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '86015203', '84.91.4.131', '', '', '', 1),
(38, 'Diana ', 'Santos ', 16, 'didiraquelfernandessantos@gmail.com', 'didiraquel', '$2y$10$hZ2AYijyQMsMOYWQll9Q9OmWaK4AbJ2gporv7Ns0YlxilUyjysqh2', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 0, '41711998', '213.190.218.132', '', '', '', 1),
(39, 'Ricardo', 'Silva', 23, 'ricardo_silvinha@gmail.com', 'ricardinho', '$2y$10$IZz0HcjRjF2.CeF9hYUZhOJfCy6oj5K1rLfQ2P6DoPIcIbKB./cmm', '23y. 😎', 'imagens/utilizadores/39/ProfilePage_GuyRyan.jpg', 1, '77070765', '95.69.73.231', '', '', '', 1),
(40, 'Soraia', 'Caldeira', 22, 'soraiacaldeira96@gmail.com', 'Soraiacaldeira', '$2y$10$0T82c72MmE2wWHeqZJx8rewByEv/YSNfp.3oGu74ORZQY3h1/VUE2', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '29545813', '83.223.243.226', '', '', '', 1),
(42, 'Jorge', 'Lima', 21, '0', 'Jorge Lima', '0', 'Este utilizador ainda não alterou o Sobre.', 'random/male/2.jpg', 0, '', '', '', '', '', 1),
(43, 'Paulo', 'Henriques', 21, '0', 'Paulo Henriques', '0', 'Este utilizador ainda não alterou o Sobre.', 'random/male/3.jpg', 0, '', '', '', '', '', 1),
(45, 'Ana', 'Meneses', 18, 'ana.meneses9@gmail.com', 'Annafilipa000', '$2y$10$CxxPS16YFVIgMHHeLm3oSOxYOsUAni1k9be/g/KOYaEkj4soqR7CS', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 0, '56802316', '82.155.213.3', '', '', '', 1),
(46, 'Ricardo', 'Carneiro', 24, 'ricardocunhacarneiro@hotmail.com', 'Ricardo', '$2y$10$rWond6UK3t1wgJ3z7FADBuOp54sy9MFuwjKGug3b1A/iTDHIv.5KO', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '15819497', '89.152.159.217', '', '', '', 1),
(47, 'Carlos ', 'Gavela', 44, 'carlos.a.gavela@gmail.com', 'cgavela', '$2y$10$bfj7L935b5rSZ6aXwW7uW.ZKM0ojQJOsQJHGX15Dx3d2PisA4JNxG', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '26961709', '148.69.88.195', '', '', '', 1),
(48, 'Ricardo ', 'Machado ', 25, 'ricardoomachadoo1@gmail.com', 'Ricardoptpt', '$2y$10$rPh4CHxB5iqAY6LGyrHMbu8Hgw5j46qyV9F48x9RGNHt6sLvUkOr6', 'Este utilizador ainda não alterou o Sobre.', 'imagens/utilizadores/48/IMG_20171208_132352.jpg', 1, '71373150', '94.132.172.116', '', '', '', 1),
(49, 'Iuri Miguel Branquinho', 'Branquinho', 24, 'iuri.miguel.branquinho@gmail.com', 'IM.Branquinho', '$2y$10$sZsqTrl41P5zKjHwJFmQae8pdkeLTA8STJngRd7.V2fAdhLZPOcLe', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '50939352', '85.243.190.193', '', '', '', 1),
(50, 'José', 'Alberto', 40, 'f6263805@nwytg.net', 'JoséAlberto40', '$2y$10$04MFMEfgxqSKPKxd29wL/OxkimR50L5N1JdzHL60E6B5w5I1mYcUu', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 0, '53673326', '82.155.107.86', '', '', '', 1),
(51, 'Sou', 'Gayzão', 22, 'gabrielgayzao@mailinator.com', 'gabrielgayzao', '$2y$10$Cr0e5okSPphLrR5zesldkeguq/iWQbOZOiamlRCY7zrVuHsHKMs4e', 'Aqui têm o meu ip -> 85.244.252.100 força nisso.', 'imagens/avatar.png', 1, '13428498', '85.244.252.100', '', '', '', 1),
(52, 'José', 'Alberto', 40, 'JoseAlbertoFodase@outlook.com', 'JoseAlberto69', '$2y$10$MUbP6UQ3huxW3KAdNynLiuAFS8ZilrhRIsKWdvzI1VWmc6eyyappO', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '32485109', '82.155.107.86', '', '', '', 1),
(53, 'Orlando', 'Carlos', 69, 'estesite@merda.pt', 'Pipas', '$2y$10$Ikd78J2vCQnn4iuPHY2WAOiUlk0JdtBXaO7vJifjQIHRsS5y7TDv2', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 0, '64284798', '94.132.60.2', '', '', '', 1),
(54, 'Francisco', 'Torrinha', 139, 'f6350695@nwytg.net', 'FranciscoTorrinha', '$2y$10$LmbW0HhOnVwunHF0Dp9B/eT6MHDIOu0/Jojt2IZ6ys4K.CzBgp/Bu', 'Mais um pra Fortnite? Falta 1 pra quads', 'imagens/utilizadores/54/gzbedbuqq9k11.jpg', 1, '14667892', '188.82.141.183', '', '', '', 3),
(55, 'Andre', 'Andre', 15, 'f6350582@nwytg.net', 'hehehe', '$2y$10$lR3Oq51Ti3UT8Q0VrMsAFeyVvjauuI1sgO4pPhWPPISZoa94J3j3.', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '52737618', '94.132.60.2', '', '', '', 3),
(56, 'Pipas_', '', 123, 'f6360202@nwytg.net', 'SanitizeInputs', '$2y$10$NTYjpFdCEPkhkOq2Z9p9VuLeJhhifoGeTDkTLv7GpEjek/IctMw22', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '88171391', '94.132.60.2', '', '', '', 1),
(57, 'Pipas_', '', 123, 'jda23320@nbzmr.com', 'SanitizeYourInputs', '$2y$10$78.RwL7OiIu8XTQ/gteqR.uU1ctSFbcMlwXkytcu.dmnKH5uqNgsW', 'Este utilizador ainda não alterou o Sobre.', 'imagens/avatar.png', 1, '44374124', '94.132.60.2', '', '', '', 1),
(58, 'Asdruval', 'Esteves', 30, 'f6363758@nwytg.net', 'Asdruval', '$2y$10$PfAjFRGcxkNokoEmgVcfTuIBgAyAHqOD0lnORIPMtfBa81ORaFBuK', 'Sou um gajo cool', 'imagens/avatar.png', 1, '43390710', '79.169.166.241', '', '', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`id_estado`);

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
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_mess`),
  ADD KEY `user_from` (`user_from`),
  ADD KEY `user_to` (`user_to`) USING BTREE;

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
-- Indexes for table `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id_seg`),
  ADD KEY `id__user` (`id_user`),
  ADD KEY `id_seguidor` (`id_seguidor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `hobbie_user`
--
ALTER TABLE `hobbie_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id_seg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
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
-- Limitadores para a tabela `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_to`) REFERENCES `users` (`id`);

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

--
-- Limitadores para a tabela `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `seguidores_ibfk_2` FOREIGN KEY (`id_seguidor`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_civil` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
