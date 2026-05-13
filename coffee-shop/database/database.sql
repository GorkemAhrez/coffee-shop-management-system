-- Create Database
CREATE DATABASE IF NOT EXISTS coffee_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE coffee_shop;

-- Admin Users Table
CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    image VARCHAR(255),
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    image VARCHAR(255),
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Sliders Table
CREATE TABLE sliders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200),
    subtitle TEXT,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255),
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact Messages Table
CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Site Settings Table
CREATE TABLE site_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(50) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Default Admin (password: admin123)
INSERT INTO admins (username, password, email, full_name) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@coffeeshop.com', 'Admin User');

-- Insert Sample Categories
INSERT INTO categories (name, slug, description, display_order) VALUES
('Coffee Beans', 'coffee-beans', 'Premium quality coffee beans from around the world', 1),
('Mugs', 'mugs', 'Beautiful and durable coffee mugs', 2),
('Thermoses', 'thermoses', 'Keep your coffee hot for hours', 3),
('Brewing Equipment', 'brewing-equipment', 'Professional brewing equipment', 4),
('Camping Setups', 'camping-setups', 'Perfect coffee setups for camping', 5),
('Double Wall Glasses', 'double-wall-glasses', 'Elegant double wall glasses', 6);

-- Insert Sample Products
INSERT INTO products (category_id, name, slug, description, price, stock, is_featured) VALUES
(1, 'Ethiopian Yirgacheffe', 'ethiopian-yirgacheffe', 'Premium Ethiopian coffee with floral and citrus notes. Light roast that brings out the natural sweetness and complexity of the beans.', 145.00, 50, 1),
(1, 'Colombian Supremo', 'colombian-supremo', 'Rich and balanced Colombian coffee with notes of caramel and nuts. Medium roast perfect for all brewing methods.', 135.00, 45, 1),
(1, 'Brazilian Santos', 'brazilian-santos', 'Smooth Brazilian coffee with chocolate undertones. Perfect for espresso and dark roast lovers.', 125.00, 60, 0),
(2, 'Ceramic Coffee Mug 350ml', 'ceramic-mug-350ml', 'Elegant ceramic mug perfect for your morning coffee. Dishwasher and microwave safe.', 85.00, 100, 1),
(2, 'Glass Coffee Mug 400ml', 'glass-mug-400ml', 'Beautiful borosilicate glass mug with handle. Heat resistant and stylish.', 95.00, 80, 0),
(3, 'Stainless Steel Thermos 500ml', 'thermos-500ml', 'Keeps beverages hot for 12 hours or cold for 24 hours. Leak-proof design perfect for travel.', 250.00, 30, 1),
(3, 'Vacuum Thermos 750ml', 'thermos-750ml', 'Large capacity thermos with double wall vacuum insulation. Perfect for long trips.', 320.00, 25, 0),
(4, 'French Press 1000ml', 'french-press-1000ml', 'Classic French press brewing method. Makes 8 cups of rich, full-bodied coffee.', 320.00, 25, 0),
(4, 'Pour Over Set', 'pour-over-set', 'Complete pour over coffee set including dripper, filters, and server. Professional results at home.', 280.00, 35, 1),
(5, 'Portable Camping Coffee Set', 'camping-coffee-set', 'Complete coffee setup for outdoor adventures. Includes grinder, dripper, and compact carrying case.', 450.00, 15, 1),
(6, 'Double Wall Latte Glass', 'double-wall-latte-glass', 'Beautiful double wall glass that keeps drinks hot while staying cool to touch. 350ml capacity.', 120.00, 70, 0);

-- Insert Sample Sliders
INSERT INTO sliders (title, subtitle, image, display_order) VALUES
('Premium Coffee Experience', 'Discover the finest coffee beans from around the world', 'slider1.jpg', 1),
('Quality Equipment', 'Professional brewing equipment for perfect coffee every time', 'slider2.jpg', 2),
('Sustainable & Fair Trade', 'Supporting farmers and sustainable practices globally', 'slider3.jpg', 3);

-- Insert Site Settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_name', 'Dialogue Coffee'),
('site_email', 'info@coffeehouse.com'),
('site_phone', '+90 538 662 15 95'),
('site_address', 'Atatürk, Nazım Hikmet Ran Cd. No:11, 31800 Samandağ/Hatay'),
('working_hours', 'Monday - Sunday 09:00 - 24:00'),
('about_text', 'We are passionate about delivering the finest coffee experience to our customers. Our journey is built on quality, sustainability, and a love for great coffee.');