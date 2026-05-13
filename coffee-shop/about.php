<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'About Us - Coffee House';

$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'About Us', 'url' => 'about.php']
];

include 'includes/header.php';
?>

<?php echo get_breadcrumbs($breadcrumbs); ?>

<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>About Coffee House</h2>
                <p>
                    Welcome to Coffee House, where passion meets perfection in every cup. Since our inception, 
                    we have been dedicated to bringing you the finest coffee experience, from bean to brew.
                </p>
                <p>
                    Our journey began with a simple mission: to source the world's best coffee beans and make 
                    them accessible to coffee enthusiasts everywhere. We work directly with farmers, ensuring 
                    fair trade practices and sustainable cultivation methods that benefit both the environment 
                    and the communities we partner with.
                </p>
                <p>
                    At Coffee House, we believe that great coffee is more than just a beverage—it's an experience. 
                    That's why we carefully curate our selection of beans, equipment, and accessories to help you 
                    create the perfect cup, whether you're at home, in the office, or on an outdoor adventure.
                </p>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&h=600&fit=crop" alt="About Coffee House">
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p>What makes Coffee House special</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-leaf"></i>
                <h3>Sustainable Sourcing</h3>
                <p>We partner with farmers who practice sustainable and ethical cultivation methods</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-certificate"></i>
                <h3>Premium Quality</h3>
                <p>Every product is carefully selected and tested to meet our high standards</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Expert Knowledge</h3>
                <p>Our team of coffee enthusiasts is here to guide you on your coffee journey</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-heart"></i>
                <h3>Customer Focused</h3>
                <p>Your satisfaction is our priority, and we're committed to exceptional service</p>
            </div>
        </div>
    </div>
</section>

<section class="about-section" style="background-color: var(--cream);">
    <div class="container">
        <div class="section-title">
            <h2>Our Values</h2>
            <p>The principles that guide everything we do</p>
        </div>
        <div class="about-content">
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=800&h=600&fit=crop" alt="Our Values">
            </div>
            <div class="about-text">
                <h3 style="color: var(--primary-color); margin-bottom: 15px;">Quality First</h3>
                <p>
                    We never compromise on quality. From sourcing the finest beans to ensuring proper 
                    roasting and packaging, every step is carefully monitored to deliver excellence.
                </p>
                
                <h3 style="color: var(--primary-color); margin-bottom: 15px; margin-top: 25px;">Fair Trade</h3>
                <p>
                    We believe in fair compensation for farmers and sustainable practices that protect 
                    our planet for future generations.
                </p>
                
                <h3 style="color: var(--primary-color); margin-bottom: 15px; margin-top: 25px;">Community</h3>
                <p>
                    Coffee brings people together. We're proud to be part of a global community of 
                    coffee lovers, farmers, and artisans who share our passion.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>