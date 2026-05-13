<?php
if (file_exists(__DIR__ . "/auth.php")) {
    include(__DIR__ . "/auth.php");
}

include("../includes/config.php");

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: products.php");
exit;
