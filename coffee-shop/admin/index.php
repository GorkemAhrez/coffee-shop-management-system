<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
require_admin_login();

// Fetch statistics
$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
$total_categories = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM categories"))['count'];
$total_messages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0"))['count'];
$featured_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products WHERE is_featured = 1"))['count'];

// Fetch recent messages
$recent_messages_query = "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5";
$recent_messages = mysqli_query($conn, $recent_messages_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dialogue Coffee</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>Dialogue Coffee</h2>
            <ul class="admin-menu">
                <li><a href="index.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="products.php"><i class="fas fa-box"></i> Products</a></li>
                <li><a href="categories.php"><i class="fas fa-list"></i> Categories</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages 
                    <?php if($total_messages > 0): ?>
                    <span class="badge badge-unread"><?php echo $total_messages; ?></span>
                    <?php endif; ?>
                </a></li>
                <li><a href="../index.php"><i class="fas fa-globe"></i> View Website</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="admin-content">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div>
                    <strong>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></strong>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-box"></i>
                    <h3>Total Products</h3>
                    <div class="stat-value"><?php echo $total_products; ?></div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-list"></i>
                    <h3>Categories</h3>
                    <div class="stat-value"><?php echo $total_categories; ?></div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-star"></i>
                    <h3>Featured Products</h3>
                    <div class="stat-value"><?php echo $featured_products; ?></div>
                </div>
                
                <div class="stat-card">
                    <i class="fas fa-envelope"></i>
                    <h3>Unread Messages</h3>
                    <div class="stat-value"><?php echo $total_messages; ?></div>
                </div>
            </div>
            
            <div class="admin-table">
                <h3>Recent Contact Messages</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($msg = mysqli_fetch_assoc($recent_messages)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($msg['name']); ?></td>
                            <td><?php echo htmlspecialchars($msg['email']); ?></td>
                            <td><?php echo htmlspecialchars($msg['subject']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($msg['created_at'])); ?></td>
                            <td>
                                <span class="badge <?php echo $msg['is_read'] ? 'badge-read' : 'badge-unread'; ?>">
                                    <?php echo $msg['is_read'] ? 'Read' : 'Unread'; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="messages.php" class="btn">View All Messages</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>