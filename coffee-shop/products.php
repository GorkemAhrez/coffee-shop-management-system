<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Products - Coffee House';

// Get search and filter parameters
$search = isset($_GET['search']) ? clean_input($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Build query
$where_conditions = ["p.is_active = 1"];
if ($search) {
    $where_conditions[] = "(p.name LIKE '%$search%' OR p.description LIKE '%$search%')";
}
if ($category_filter > 0) {
    $where_conditions[] = "p.category_id = $category_filter";
}

$where_clause = implode(' AND ', $where_conditions);

// Count total products
$count_query = "SELECT COUNT(*) as total FROM products p WHERE $where_clause";
$count_result = mysqli_query($conn, $count_query);
$total_products = mysqli_fetch_assoc($count_result)['total'];

// Calculate pagination
$offset = ($current_page - 1) * ITEMS_PER_PAGE;

// Fetch products
$products_query = "SELECT p.*, c.name as category_name 
                   FROM products p 
                   JOIN categories c ON p.category_id = c.id 
                   WHERE $where_clause 
                   ORDER BY p.created_at DESC 
                   LIMIT " . ITEMS_PER_PAGE . " OFFSET $offset";
$products = mysqli_query($conn, $products_query);

// Fetch categories for filter
$categories_query = "SELECT * FROM categories WHERE is_active = 1 ORDER BY name ASC";
$categories = mysqli_query($conn, $categories_query);

// Build breadcrumbs
$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Products', 'url' => 'products.php']
];

include 'includes/header.php';
?>

<?php echo get_breadcrumbs($breadcrumbs); ?>

<section class="products-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Products</h2>
            <p>Explore our premium coffee collection</p>
        </div>
        
        <!-- Search and Filter Bar -->
        <div class="search-filter-bar">
            <div class="search-box">
                <form method="GET" action="products.php">
                    <input type="text" 
                           name="search" 
                           placeholder="Search products..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                    <?php if($category_filter): ?>
                    <input type="hidden" name="category" value="<?php echo $category_filter; ?>">
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="filter-box">
                <form method="GET" action="products.php" id="categoryFilter">
                    <select name="category" onchange="this.form.submit()">
                        <option value="0">All Categories</option>
                        <?php while($cat = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo $cat['id']; ?>" 
                                <?php echo $category_filter == $cat['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                    <?php if($search): ?>
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                    <?php endif; ?>
                </form>
            </div>
        </div>
        
        <!-- Products Grid -->
        <?php if(mysqli_num_rows($products) > 0): ?>
        <div class="products-grid">
            <?php 
            $prod_index = 0;
            // Placeholder images array
            $prod_images = [
                'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1511920170033-f8396924c348?w=500&h=500&fit=crop',
                'https://images.unsplash.com/photo-1459755486867-b55449bb39ff?w=500&h=500&fit=crop'
            ];
            
            while($product = mysqli_fetch_assoc($products)): 
                $prod_img = $prod_images[$prod_index % count($prod_images)];
                $prod_index++;
            ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $prod_img; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                    <div class="product-price"><?php echo format_price($product['price']); ?></div>
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <!-- Pagination -->
        <?php 
        $url_pattern = 'products.php?';
        if ($search) $url_pattern .= 'search=' . urlencode($search) . '&';
        if ($category_filter) $url_pattern .= 'category=' . $category_filter . '&';
        $url_pattern .= 'page={page}';
        
        echo get_pagination($total_products, ITEMS_PER_PAGE, $current_page, $url_pattern);
        ?>
        
        <?php else: ?>
        <div style="text-align: center; padding: 60px 0;">
            <p style="font-size: 18px; color: var(--text-light);">No products found matching your criteria.</p>
            <a href="products.php" class="btn" style="margin-top: 20px;">View All Products</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>