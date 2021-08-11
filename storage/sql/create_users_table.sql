CREATE TABLE `users` (
     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
     `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
     `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
     `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
     `opt_in` tinyint(1) NOT NULL DEFAULT '0',
     `created_at` timestamp NULL DEFAULT NULL,
     `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
