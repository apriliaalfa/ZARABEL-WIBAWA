-- Zarabel Database Dump
-- Ready for MySQL / phpMyAdmin / Hostinger

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Table users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `phone` varchar(50) DEFAULT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `address` text DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL UNIQUE,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Table categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Table products
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL UNIQUE,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount_price` decimal(12,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 10,
  `main_image` varchar(255) NOT NULL,
  `gallery_images` json DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `additional_information` longtext DEFAULT NULL,
  `sizes` json DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 5.00,
  `reviews_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Table orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(100) NOT NULL UNIQUE,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `shipping_address` text NOT NULL,
  `courier` varchar(100) DEFAULT NULL,
  `shipping_cost` decimal(12,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `status` enum('pending','paid','processing','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Table order_items
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `size` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Table payments
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `payment_channel` varchar(100) DEFAULT NULL,
  `account_number` varchar(100) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_status` enum('unpaid','waiting_verification','paid','expired','failed') NOT NULL DEFAULT 'unpaid',
  `paid_at` timestamp NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- DATA SEED INITIAL

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `password`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Zarabel', 'admin@zarabel.com', '081298765432', 'admin', '$2y$12$Z0y2m9/f6lYjBGBVb84mre7w8J1L6Wv7i.F4V5Zf3kL0z1i2h3j4k', NOW(), NOW(), NOW()),
(2, 'Sarah Amberi', 'sarah@zarabel.com', '081234567890', 'customer', '$2y$12$Z0y2m9/f6lYjBGBVb84mre7w8J1L6Wv7i.F4V5Zf3kL0z1i2h3j4k', NOW(), NOW(), NOW());

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hijab', 'hijab', 'assets/img/cat1.jpg', 'Koleksi hijab premium lembut dan elegan', NOW(), NOW()),
(2, 'Abayas', 'abayas', 'assets/img/cat2.jpg', 'Abaya kontemporer dengan potongan jatuh yang anggun', NOW(), NOW()),
(3, 'Dresses', 'dresses', 'assets/img/cat3.jpg', 'Gaun pesta dan busana formal bernuansa kemewahan', NOW(), NOW()),
(4, 'Outwears', 'outwears', 'assets/img/cat4.jpg', 'Outerwear dan cardigan berkelas untuk segala acara', NOW(), NOW()),
(5, 'Accessories', 'accessories', 'assets/img/cat5.jpg', 'Aksesoris pelengkap busana nusantara', NOW(), NOW());

INSERT INTO `products` (`id`, `code`, `name`, `slug`, `category_id`, `category_name`, `price`, `discount_price`, `stock`, `main_image`, `gallery_images`, `short_description`, `description`, `additional_information`, `sizes`, `rating`, `reviews_count`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ZRB-TOP-001', 'White casual t-shirt', 'white-casual-t-shirt', 4, 'Outwears', 100000.00, 200000.00, 9, 'assets/img/bg35.png', '["assets/img/bg35.png", "assets/img/bg36.png", "assets/img/bg37.png", "assets/img/bg38.png", "assets/img/bg39.png"]', 'The CELIA Shirt is made from premium cotton that is soft, lightweight, and exceptionally comfortable.', 'Celia Shirt - Premium Cotton Material\n\nBust: 120 cm\nUpper Arm: 50 cm\nLength: 68 cm', 'Care Instructions: Machine wash cold, iron medium.', '["xxs", "xs", "s", "m", "l", "xl"]', 4.95, 5, 1, NOW(), NOW()),
(2, 'ZRB-KBY-001', 'Zarabel Royal Kebaya Gold', 'zarabel-royal-kebaya-gold', 3, 'Dresses', 2450000.00, 2800000.00, 5, 'assets/img/d6b1e.png', '["assets/img/d6b1e.png"]', 'Sentuhan klasik warisan nusantara dengan detail bordir benang emas.', 'French Lace bordir tangan dengan taburan kristal Swarovski.', 'Dry Clean Only. Custom Fitting Available.', '["s", "m", "l", "xl"]', 5.00, 12, 1, NOW(), NOW()),
(3, 'ZRB-GWN-001', 'Emerald Grace Silk Gown', 'emerald-grace-silk-gown', 3, 'Dresses', 3100000.00, NULL, 4, 'assets/img/f33d5.png', '["assets/img/f33d5.png"]', 'Gaun malam sutra kontemporer bernuansa zamrud mewah.', '100% Sutra Dobi Makassar dengan kilau mewah alami.', 'Pure Dobi Silk. Khusus Dry Clean.', '["xs", "s", "m", "l"]', 4.90, 8, 1, NOW(), NOW()),
(4, 'ZRB-ABY-001', 'Zarabel Modest Abaya Beige', 'zarabel-modest-abaya-beige', 2, 'Abayas', 750000.00, 950000.00, 15, 'assets/img/88c06.png', '["assets/img/88c06.png"]', 'Abaya minimalis warna beige hangat dengan bahan crinkle premium.', 'Potongan longgar wudhu-friendly dengan kancing tersembunyi.', 'Material: Premium Crinkle Airflow. LD 120cm, PB 140cm.', '["s", "m", "l", "xl", "xxl"]', 4.88, 16, 1, NOW(), NOW()),
(5, 'ZRB-HJB-001', 'Elegant Floral Hijab Silk', 'elegant-floral-hijab-silk', 1, 'Hijab', 250000.00, 300000.00, 30, 'assets/img/4d82e.png', '["assets/img/4d82e.png"]', 'Hijab segi empat motif floral khas batik modern berbahan voal silk.', 'Tegak di dahi, tidak licin, lembut dan adem dipakai seharian.', 'Ukuran: 115 x 115 cm. Finishing Laser Cut.', '["All Size"]', 4.96, 24, 1, NOW(), NOW());

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `courier`, `shipping_cost`, `subtotal`, `discount`, `total_amount`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ZRB-202611-0001', 2, 'Sarah Amberi', 'sarah@zarabel.com', '081234567890', 'Jl. Kebaya Indah No. 18, Jakarta Selatan 12340', 'JNE Express (Reguler)', 20000.00, 200000.00, 50000.00, 170000.00, 'Tolong diperiksa kancing cadangan.', 'paid', NOW(), NOW());

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_code`, `product_name`, `product_image`, `price`, `quantity`, `size`, `notes`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ZRB-TOP-001', 'White casual t-shirt', 'assets/img/bg35.png', 100000.00, 2, 'M', 'Please recheck the size before send to me :)', 200000.00, NOW(), NOW());

INSERT INTO `payments` (`id`, `order_id`, `payment_method`, `payment_channel`, `account_number`, `amount`, `payment_status`, `paid_at`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'bank_transfer', 'BCA Virtual Account', '8271081234567890', 170000.00, 'paid', NOW(), NOW(), NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;

