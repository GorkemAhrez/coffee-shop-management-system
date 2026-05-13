<!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Coffee House</h3>
                    <p><?php echo get_setting('about_text'); ?></p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo SITE_URL; ?>/index.php">Home</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/products.php">Products</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/about.php">About Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Contact Info</h4>
                    <ul class="contact-list">
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo get_setting('site_address'); ?></li>
                        <li><i class="fas fa-phone"></i> <?php echo get_setting('site_phone'); ?></li>
                        <li><i class="fas fa-envelope"></i> <?php echo get_setting('site_email'); ?></li>
                        <li><i class="fas fa-clock"></i> <?php echo get_setting('working_hours'); ?></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Created by Görkem Ahrez. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="<?php echo SITE_URL; ?>/assets/js/script.js"></script>
</body>
</html>