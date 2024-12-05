CREATE DATABASE `binsta`;
DROP DATABASE IF EXISTS `binsta`;

USE DATABASE `binsta`;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `posted_on` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `post_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_comment_user` (`user_id`),
  KEY `index_foreignkey_comment_post` (`post_id`),
  CONSTRAINT `c_fk_comment_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `c_fk_comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

DROP TABLE IF EXISTS `follower`;
CREATE TABLE `follower` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `follower_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_follower_user` (`user_id`),
  KEY `index_foreignkey_follower_follower` (`follower_id`),
  CONSTRAINT `c_fk_follower_follower_id` FOREIGN KEY (`follower_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `c_fk_follower_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

DROP TABLE IF EXISTS `fork`;
CREATE TABLE `fork` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `snippet_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_fork_snippet` (`snippet_id`),
  KEY `index_foreignkey_fork_user` (`user_id`),
  CONSTRAINT `c_fk_fork_snippet_id` FOREIGN KEY (`snippet_id`) REFERENCES `snippet` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `c_fk_fork_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

DROP TABLE IF EXISTS `like`;
CREATE TABLE `like` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `post_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_like_user` (`user_id`),
  KEY `index_foreignkey_like_post` (`post_id`),
  CONSTRAINT `c_fk_like_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `c_fk_like_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created_at` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_post_user` (`user_id`),
  CONSTRAINT `c_fk_post_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

DROP TABLE IF EXISTS `snippet`;
CREATE TABLE `snippet` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_snippet_user` (`user_id`),
  CONSTRAINT `c_fk_snippet_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `bio` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);