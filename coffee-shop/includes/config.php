<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Default phpMyAdmin username
define('DB_PASS', '');      // Default phpMyAdmin password (empty)
define('DB_NAME', 'coffee_shop');

// Site Configuration
define('SITE_URL', 'http://localhost/coffee-shop');
define('ITEMS_PER_PAGE', 9);

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>