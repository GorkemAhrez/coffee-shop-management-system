<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = 'Contact Us - Coffee House';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $phone = clean_input($_POST['phone']);
    $subject = clean_input($_POST['subject']);
    $message = clean_input($_POST['message']);
    
    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        $query = "INSERT INTO contact_messages (name, email, phone, subject, message) 
                  VALUES ('$name', '$email', '$phone', '$subject', '$message')";
        
        if (mysqli_query($conn, $query)) {
            $success_message = 'Thank you for contacting us! We will get back to you soon.';
            // Clear form
            $_POST = [];
        } else {
            $error_message = 'Sorry, there was an error sending your message. Please try again.';
        }
    }
}

$breadcrumbs = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Contact', 'url' => 'contact.php']
];

include 'includes/header.php';
?>

<?php echo get_breadcrumbs($breadcrumbs); ?>

<section class="contact-section">
    <div class="container">
        <div class="section-title">
            <h2>Get In Touch</h2>
            <p>We'd love to hear from you</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                
                <?php if ($success_message): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                <div class="alert alert-error"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="contact.php">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" 
                                  name="message" 
                                  required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info-box">
                <h3>Contact Information</h3>
                
                <div class="contact-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Address</strong><br>
                        <?php echo get_setting('site_address'); ?>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Phone</strong><br>
                        <a href="tel:<?php echo get_setting('site_phone'); ?>">
                            <?php echo get_setting('site_phone'); ?>
                        </a>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong><br>
                        <a href="mailto:<?php echo get_setting('site_email'); ?>">
                            <?php echo get_setting('site_email'); ?>
                        </a>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Working Hours</strong><br>
                        <?php echo get_setting('working_hours'); ?>
                    </div>
                </div>
                
                <div style="margin-top: 30px;">
                    <h4 style="margin-bottom: 15px;">Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>