<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Get product ID
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    header('Location: products.php');
    exit();
}

// Fetch product details
$query = "SELECT p.*, c.name as category_name, c.id as category_id 
          FROM products p 
          JOIN categories c ON p.category_id = c.id 
          WHERE p.id = $product_id AND p.is_active = 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: products.php');
    exit();
}

$product = mysqli_fetch_assoc($result);
$page_title = $product['name'] . ' - Coffee House';

// Fetch related products
$related_query = "SELECT p.* FROM products p 
                  WHERE p.category_id = {$product['category_id']} 
                  AND p.id != $product_id 
                  AND p.is_active = 1 
                  LIMIT 3";
$related_products = mysqli_query($conn, $related_query);

// Placeholder images
$prod_images = [
    'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=800&h=800&fit=crop',
    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&h=800&fit=crop',
    'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=800&h=800&fit=crop',
    'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=800&h=800&fit=crop',
    'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800&h=800&fit=crop',
    'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800&h=800&fit=crop'
];

$main_img = $prod_images[($product_id - 1) % count($prod_images)];

// Build breadcrumbs
$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Products', 'url' => 'products.php'],
    ['title' => $product['name'], 'url' => '#']
];

include 'includes/header.php';
?>

<?php echo get_breadcrumbs($breadcrumbs); ?>

<section class="products-section">
    <div class="container">
        <div class="about-content">
            <div class="product-image">
                <img src="<?php echo $main_img; ?>" 
                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                     style="width: 100%; border-radius: 10px;">
            </div>
            
            <div class="about-text">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p style="color: var(--primary-color); font-size: 14px; margin-bottom: 15px;">
                    Category: <?php echo htmlspecialchars($product['category_name']); ?>
                </p>
                <div class="product-price" style="font-size: 32px; margin-bottom: 20px;">
                    <?php echo format_price($product['price']); ?>
                </div>
                <p style="line-height: 1.8; margin-bottom: 20px;">
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                </p>
                <p style="color: var(--text-light); margin-bottom: 30px;">
                    <strong>Stock:</strong> <?php echo $product['stock']; ?> units available
                </p>
                <a href="products.php?category=<?php echo $product['category_id']; ?>" class="btn">
                    View More in This Category
                </a>
            </div>
        </div>
        
        <?php if(mysqli_num_rows($related_products) > 0): ?>
        <div style="margin-top: 80px;">
            <div class="section-title">
                <h2>Related Products</h2>
                <p>You might also like these products</p>
            </div>
            
            <div class="products-grid">
                <?php 
                $rel_index = 0;
                while($related = mysqli_fetch_assoc($related_products)): 
                    $rel_img = $prod_images[$rel_index % count($prod_images)];
                    $rel_index++;
                ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo $rel_img; ?>" 
                             alt="<?php echo htmlspecialchars($related['name']); ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($related['name']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($related['description'], 0, 100)) . '...'; ?></p>
                        <div class="product-price"><?php echo format_price($related['price']); ?></div>
                        <a href="product-detail.php?id=<?php echo $related['id']; ?>" class="btn">View Details</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>