-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para daily
CREATE DATABASE IF NOT EXISTS `daily` /*!40100 DEFAULT CHARACTER SET utf32 COLLATE utf32_unicode_ci */;
USE `daily`;

-- Copiando estrutura para tabela daily.dailies
CREATE TABLE IF NOT EXISTS `dailies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `tarefa` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feito` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela daily.dailies: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `dailies` DISABLE KEYS */;
INSERT INTO `dailies` (`id`, `data`, `id_funcionario`, `id_projeto`, `tarefa`, `observacao`, `feito`, `created_at`, `updated_at`) VALUES
	(1, '2019-01-21', 1, 1, 'teste', 'teste', 0, '2019-01-21 22:58:32', '2020-01-21 22:58:34'),
	(2, '2019-12-31', 3, 0, 'teste0221', '<p>teste0221</p>', 0, '2019-01-23 04:21:52', '2019-01-23 04:21:52'),
	(3, '2019-12-31', 2, 0, 'Teste', '<p>Teste</p>', 0, '2019-01-23 19:17:20', '2019-01-23 19:17:20');
/*!40000 ALTER TABLE `dailies` ENABLE KEYS */;

-- Copiando estrutura para tabela daily.funcionarios
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela daily.funcionarios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` (`id`, `id_funcionario`, `nome`, `observacao`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'teste', 'teste', 0, NULL, NULL),
	(2, 2, 'Teste Tmontec', '<p>teste</p>', 0, '2019-01-23 03:43:45', '2019-01-23 03:43:45'),
	(3, 3, 'Teste Tmontec', '<p>teste</p>', 1, '2019-01-23 03:44:05', '2019-01-23 03:44:05'),
	(4, 0, 'Teste Tmontec', 'Teste Tmontec', 1, '2019-01-23 03:49:05', '2019-01-23 03:49:05'),
	(5, 0, 'Teste Tmontec 12', '<p>Teste Tmontec</p>', 1, '2019-01-23 03:49:54', '2019-01-23 03:49:54');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;

-- Copiando estrutura para tabela daily.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela daily.migrations: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(3, '2019_01_18_025956_create_products_table', 1),
	(8, '2014_10_12_000000_create_users_table', 2),
	(9, '2014_10_12_100000_create_password_resets_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela daily.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela daily.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela daily.projetos
CREATE TABLE IF NOT EXISTS `projetos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela daily.projetos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` (`id`, `nome`, `descricao`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'teste 0058', '<p>teste 0058</p>', 1, '2019-01-23 02:58:26', '2019-01-23 02:58:26'),
	(8, 'teste0119', '<p>teste0119</p>', 0, '2019-01-23 03:19:21', '2019-01-23 03:19:21'),
	(9, 'teste0119', '<p>teste0119</p>', 1, '2019-01-23 03:19:34', '2019-01-23 03:19:34'),
	(10, 'teste01121', '<p>teste0119</p>', 1, '2019-01-23 03:22:03', '2019-01-23 03:22:03'),
	(11, 'teste01144', '<p>teste0119</p>', 1, '2019-01-23 03:44:34', '2019-01-23 03:44:34');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;

-- Copiando estrutura para tabela daily.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela daily.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Andresa', 'andresa@tmontec.com.br', NULL, '$2y$10$2t6GHPwwS62r0w7S1k6t9OYM8uh.5X4N.ML4b.ACboFaJFkywEZBK', 'iKm1fAgf0QjmJi1pZ0pGnOs4cSDymCzCRGgtnorCX25jprM8jbsjzHX8EcxK', '2019-01-23 21:53:31', '2019-01-23 21:58:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
