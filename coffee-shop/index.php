<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Coffee House - Premium Coffee & Equipment';

// Fetch active sliders
$slider_query = "SELECT * FROM sliders WHERE is_active = 1 ORDER BY display_order ASC";
$sliders = mysqli_query($conn, $slider_query);

// Fetch featured categories
$categories_query = "SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order ASC LIMIT 6";
$categories = mysqli_query($conn, $categories_query);

// Fetch featured products
$products_query = "SELECT p.*, c.name as category_name 
                   FROM products p 
                   JOIN categories c ON p.category_id = c.id 
                   WHERE p.is_featured = 1 AND p.is_active = 1 
                   LIMIT 6";
$featured_products = mysqli_query($conn, $products_query);

include 'includes/header.php';
?>

<!-- Slider Section -->
<section class="slider">
    <div class="slider-container">
        <?php 
        $slide_index = 0;
        while($slider = mysqli_fetch_assoc($sliders)): 
            $slide_index++;
            // Use placeholder if image doesn't exist
            $slider_img = 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=1920&h=500&fit=crop';
            if($slide_index == 2) $slider_img = 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=1920&h=500&fit=crop';
            if($slide_index == 3) $slider_img = 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1920&h=500&fit=crop';
        ?>
        <div class="slide <?php echo $slide_index === 1 ? 'active' : ''; ?>">
            <img src="<?php echo $slider_img; ?>" alt="<?php echo htmlspecialchars($slider['title']); ?>">
            <div class="slide-content">
                <h2><?php echo htmlspecialchars($slider['title']); ?></h2>
                <p><?php echo htmlspecialchars($slider['subtitle']); ?></p>
                <?php if($slider['link']): ?>
                <a href="<?php echo $slider['link']; ?>" class="btn">Explore Now</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
        
        <div class="slider-controls">
            <button class="slider-btn" onclick="changeSlide(-1)">&#10094;</button>
            <button class="slider-btn" onclick="changeSlide(1)">&#10095;</button>
        </div>
        
        <div class="slider-dots" id="sliderDots"></div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-shipping-fast"></i>
                <h3>Fast Delivery</h3>
                <p>Your orders arrive quickly and safely</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-award"></i>
                <h3>Premium Quality</h3>
                <p>The finest quality products</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Secure Shopping</h3>
                <p>Safe and secure online transactions</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-mobile-alt"></i>
                <h3>Mobile Ordering</h3>
                <p>Track your orders on the go</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Categories</h2>
            <p>Explore our wide range of premium coffee products</p>
        </div>
        
        <div class="categories-grid">
            <?php 
            $cat_index = 0;
            while($category = mysqli_fetch_assoc($categories)): 
                $cat_index++;
                // Placeholder images for categories
                $cat_images = [
                    'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=600&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=600&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=600&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=600&h=600&fit=crop'
                ];
                $cat_img = $cat_images[($cat_index - 1) % 6];
            ?>
            <div class="category-card">
                <img src="<?php echo $cat_img; ?>" alt="<?php echo htmlspecialchars($category['name']); ?>">
                <div class="category-info">
                    <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p><?php echo htmlspecialchars($category['description']); ?></p>
                    <a href="products.php?category=<?php echo $category['id']; ?>" class="btn">Explore</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="products-section">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
            <p>Discover our most popular coffee products</p>
        </div>
        
        <div class="products-grid">
            <?php 
            $prod_index = 0;
            while($product = mysqli_fetch_assoc($featured_products)): 
                $prod_index++;
                // Placeholder images for products
                $prod_images = [
                    'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=500&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=500&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=500&h=500&fit=crop'
                ];
                $prod_img = $prod_images[($prod_index - 1) % 6];
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
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="products.php" class="btn">View All Products</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>