<?php
// Sanitize input
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

// Generate slug from string
function generate_slug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

// Format price
function format_price($price) {
    return number_format($price, 2, ',', '.') . ' TL';
}

// Get pagination HTML
function get_pagination($total_items, $items_per_page, $current_page, $url_pattern) {
    $total_pages = ceil($total_items / $items_per_page);
    
    if ($total_pages <= 1) return '';
    
    $html = '<div class="pagination">';
    
    // Previous button
    if ($current_page > 1) {
        $html .= '<a href="' . str_replace('{page}', $current_page - 1, $url_pattern) . '" class="page-link">&laquo; Prev</a>';
    }
    
    // Page numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $html .= '<span class="page-link active">' . $i . '</span>';
        } else {
            $html .= '<a href="' . str_replace('{page}', $i, $url_pattern) . '" class="page-link">' . $i . '</a>';
        }
    }
    
    // Next button
    if ($current_page < $total_pages) {
        $html .= '<a href="' . str_replace('{page}', $current_page + 1, $url_pattern) . '" class="page-link">Next &raquo;</a>';
    }
    
    $html .= '</div>';
    return $html;
}

// Get breadcrumbs
function get_breadcrumbs($items) {
    $html = '<div class="breadcrumb-container">';
    $html .= '<div class="container">';
    $html .= '<nav class="breadcrumb">';
    
    foreach ($items as $index => $item) {
        if ($index < count($items) - 1) {
            $html .= '<a href="' . $item['url'] . '">' . $item['title'] . '</a>';
            $html .= '<span class="separator">/</span>';
        } else {
            $html .= '<span class="current">' . $item['title'] . '</span>';
        }
    }
    
    $html .= '</nav>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}

// Check if admin is logged in
function is_admin_logged_in() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

// Redirect to login if not authenticated
function require_admin_login() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit();
    }
}

// Get site setting
function get_setting($key) {
    global $conn;
    $key = clean_input($key);
    $query = "SELECT setting_value FROM site_settings WHERE setting_key = '$key'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['setting_value'];
    }
    return '';
}
?>