<?php
if (file_exists(__DIR__ . "/auth.php")) {
    include(__DIR__ . "/auth.php");
}

include("../includes/config.php");

$categories = mysqli_query($conn, "SELECT * FROM categories WHERE is_active=1");

if ($_POST) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category_id'];
    $active = $_POST['is_active'];

    mysqli_query($conn, "
        INSERT INTO products (name, description, price, category_id, is_active, created_at)
        VALUES ('$name', '$desc', '$price', '$category', '$active', NOW())
    ");

    header("Location: products.php");
    exit;
}
?>

<h2>Yeni Ürün Ekle</h2>

<form method="post">
    <input type="text" name="name" placeholder="Ürün adı" required><br><br>

    <textarea name="description" placeholder="Açıklama" required></textarea><br><br>

    <input type="number" step="0.01" name="price" placeholder="Fiyat" required><br><br>

    <select name="category_id" required>
        <?php while($c = mysqli_fetch_assoc($categories)): ?>
            <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <select name="is_active">
        <option value="1">Aktif</option>
        <option value="0">Pasif</option>
    </select><br><br>

    <button type="submit">Kaydet</button>
</form>
