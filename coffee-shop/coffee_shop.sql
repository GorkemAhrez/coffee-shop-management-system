-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Ara 2025, 19:22:35
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `coffee_shop`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$10$aVf81eZIQgjmBCeWzMjoOOX/hmG0DslO6KLDwCiS4ICIoQWtBldz.', 'admin@coffeeshop.com', 'Admin User', '2025-12-28 17:38:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `display_order`, `is_active`, `created_at`) VALUES
(1, 'Coffee Beans', 'coffee-beans', 'Premium quality coffee beans from around the world', NULL, 1, 1, '2025-12-28 17:38:51'),
(2, 'Mugs', 'mugs', 'Beautiful and durable coffee mugs', NULL, 2, 1, '2025-12-28 17:38:51'),
(3, 'Thermoses', 'thermoses', 'Keep your coffee hot for hours', NULL, 3, 1, '2025-12-28 17:38:51'),
(4, 'Brewing Equipment', 'brewing-equipment', 'Professional brewing equipment', NULL, 4, 1, '2025-12-28 17:38:51'),
(5, 'Camping Setups', 'camping-setups', 'Perfect coffee setups for camping', NULL, 5, 1, '2025-12-28 17:38:51'),
(6, 'Double Wall Glasses', 'double-wall-glasses', 'Elegant double wall glasses', NULL, 6, 1, '2025-12-28 17:38:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `image`, `is_featured`, `is_active`, `created_at`) VALUES
(1, 1, 'Ethiopian Yirgacheffe', 'ethiopian-yirgacheffe', 'Premium Ethiopian coffee with floral and citrus notes. Light roast that brings out the natural sweetness and complexity of the beans.', 145.00, 50, NULL, 1, 1, '2025-12-28 17:38:51'),
(2, 1, 'Colombian Supremo', 'colombian-supremo', 'Rich and balanced Colombian coffee with notes of caramel and nuts. Medium roast perfect for all brewing methods.', 135.00, 45, NULL, 1, 1, '2025-12-28 17:38:51'),
(3, 1, 'Brazilian Santos', 'brazilian-santos', 'Smooth Brazilian coffee with chocolate undertones. Perfect for espresso and dark roast lovers.', 125.00, 60, NULL, 0, 1, '2025-12-28 17:38:51'),
(4, 2, 'Ceramic Coffee Mug 350ml', 'ceramic-mug-350ml', 'Elegant ceramic mug perfect for your morning coffee. Dishwasher and microwave safe.', 85.00, 100, NULL, 1, 1, '2025-12-28 17:38:51'),
(5, 2, 'Glass Coffee Mug 400ml', 'glass-mug-400ml', 'Beautiful borosilicate glass mug with handle. Heat resistant and stylish.', 95.00, 80, NULL, 0, 1, '2025-12-28 17:38:51'),
(6, 3, 'Stainless Steel Thermos 500ml', 'thermos-500ml', 'Keeps beverages hot for 12 hours or cold for 24 hours. Leak-proof design perfect for travel.', 250.00, 30, NULL, 1, 1, '2025-12-28 17:38:51'),
(7, 3, 'Vacuum Thermos 750ml', 'thermos-750ml', 'Large capacity thermos with double wall vacuum insulation. Perfect for long trips.', 320.00, 25, NULL, 0, 1, '2025-12-28 17:38:51'),
(8, 4, 'French Press 1000ml', 'french-press-1000ml', 'Classic French press brewing method. Makes 8 cups of rich, full-bodied coffee.', 320.00, 25, NULL, 0, 1, '2025-12-28 17:38:51'),
(9, 4, 'Pour Over Set', 'pour-over-set', 'Complete pour over coffee set including dripper, filters, and server. Professional results at home.', 280.00, 35, NULL, 1, 1, '2025-12-28 17:38:51'),
(10, 5, 'Portable Camping Coffee Set', 'camping-coffee-set', 'Complete coffee setup for outdoor adventures. Includes grinder, dripper, and compact carrying case.', 450.00, 15, NULL, 1, 1, '2025-12-28 17:38:51'),
(11, 6, 'Double Wall Latte Glass', 'double-wall-latte-glass', 'Beautiful double wall glass that keeps drinks hot while staying cool to touch. 350ml capacity.', 120.00, 70, NULL, 0, 1, '2025-12-28 17:38:51'),
(12, 1, 'americano', '', 'coffe', 70.00, 0, NULL, 0, 1, '2025-12-28 18:21:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `site_settings`
--

INSERT INTO `site_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'site_name', 'Dialogue Coffee', '2025-12-28 17:38:51'),
(2, 'site_email', 'info@coffeehouse.com', '2025-12-28 17:38:51'),
(3, 'site_phone', '+90 538 662 15 95', '2025-12-28 17:38:51'),
(4, 'site_address', 'Atatürk, Nazım Hikmet Ran Cd. No:11, 31800 Samandağ/Hatay', '2025-12-28 17:38:51'),
(5, 'working_hours', 'Monday - Sunday 09:00 - 24:00', '2025-12-28 17:38:51'),
(6, 'about_text', 'We are passionate about delivering the finest coffee experience to our customers. Our journey is built on quality, sustainability, and a love for great coffee.', '2025-12-28 17:38:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `image`, `link`, `display_order`, `is_active`, `created_at`) VALUES
(1, 'Premium Coffee Experience', 'Discover the finest coffee beans from around the world', 'slider1.jpg', NULL, 1, 1, '2025-12-28 17:38:51'),
(2, 'Quality Equipment', 'Professional brewing equipment for perfect coffee every time', 'slider2.jpg', NULL, 2, 1, '2025-12-28 17:38:51'),
(3, 'Sustainable & Fair Trade', 'Supporting farmers and sustainable practices globally', 'slider3.jpg', NULL, 3, 1, '2025-12-28 17:38:51');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Tablo için indeksler `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`);

--
-- Tablo için indeksler `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Tablo için indeksler `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
