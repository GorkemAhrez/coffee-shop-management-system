<?php
if (file_exists(__DIR__ . "/auth.php")) {
    include(__DIR__ . "/auth.php");
}

include("../includes/config.php");

$id = intval($_GET['id']);

$product = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM products WHERE id=$id")
);

$categories = mysqli_query($conn, "SELECT * FROM categories WHERE is_active=1");

if ($_POST) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category_id'];
    $active = $_POST['is_active'];

    mysqli_query($conn, "
        UPDATE products SET
        name='$name',
        description='$desc',
        price='$price',
        category_id='$category',
        is_active='$active'
        WHERE id=$id
    ");

    header("Location: products.php");
    exit;
}
?>

<h2>Ürün Düzenle</h2>

<form method="post">
    <input type="text" name="name" value="<?= $product['name'] ?>"><br><br>

    <textarea name="description"><?= $product['description'] ?></textarea><br><br>

    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>"><br><br>

    <select name="category_id">
        <?php while($c = mysqli_fetch_assoc($categories)): ?>
            <option value="<?= $c['id'] ?>"
                <?= $c['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= $c['name'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <select name="is_active">
        <option value="1" <?= $product['is_active'] ? 'selected' : '' ?>>Aktif</option>
        <option value="0" <?= !$product['is_active'] ? 'selected' : '' ?>>Pasif</option>
    </select><br><br>

    <button type="submit">Güncelle</button>
</form>
