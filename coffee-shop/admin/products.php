<?php
if (file_exists(__DIR__ . "/auth.php")) {
    include(__DIR__ . "/auth.php");
}

include("../includes/config.php");

$query = "
SELECT p.*, c.name AS category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.id
ORDER BY p.created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<h2>Ürün Yönetimi</h2>

<a href="product_add.php" style="display:inline-block;margin-bottom:15px;">
➕ Yeni Ürün Ekle
</a>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
<tr>
    <th>ID</th>
    <th>Ürün</th>
    <th>Kategori</th>
    <th>Fiyat</th>
    <th>Aktif</th>
    <th>İşlem</th>
</tr>

<?php while($p = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= htmlspecialchars($p['name']) ?></td>
    <td><?= htmlspecialchars($p['category_name']) ?></td>
    <td><?= $p['price'] ?> ₺</td>
    <td><?= $p['is_active'] ? '✔' : '✖' ?></td>
    <td>
        <a href="product_edit.php?id=<?= $p['id'] ?>">✏ Düzenle</a> |
        <a href="product_delete.php?id=<?= $p['id'] ?>"
           onclick="return confirm('Silmek istediğine emin misin?')">
           ❌ Sil
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>
