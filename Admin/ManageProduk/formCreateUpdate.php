<?php
require '../../Database/getConnection.php';

$connection = getConnection();
$id = isset($_GET['id']) ? $_GET['id'] : null;
$data = null;

if ($id) {
    // Query untuk mengambil data dari tabel product dan product_details
    $statement = $connection->prepare("
        SELECT product.*, product_details.stock, product_details.total_order 
        FROM product
        JOIN product_details ON product_details.product_id = product.id
        WHERE product.id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
}

// Jika tidak ada data yang ditemukan, berikan nilai default
$data = $data ?? [
    'id' => '',
    'product_name' => '',
    'variant' => '',
    'price' => '',
    'product_description' => '',
    'new' => '',
    'stock' => '',
    'total_order' => '',
    'product_image' => ''
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Create/Update Produk</title>
</head>

<body>
    <h1><?= $id ? "Update Produk" : "Tambah Produk" ?></h1>

    <form method="POST" action="simpanProduk.php" enctype="multipart/form-data">
        <!-- Field ID untuk update -->
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Nama Produk:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($data['product_name']) ?>" required>
        <br>

        <label>Varian Produk:</label>
        <input type="text" name="variant" value="<?= htmlspecialchars($data['variant']) ?>" required>
        <br>

        <label>Harga Produk:</label>
        <input type="number" name="price" value="<?= $data['price'] ?>" required>
        <br>

        <label>Deskripsi:</label>
        <textarea name="product_description" required><?= htmlspecialchars($data['product_description']) ?></textarea>
        <br>

        <label>New:</label>
        <?php if ($id): ?>
            <input type="checkbox" name="new" value="1" <?= $data['new'] ? 'checked' : '' ?>>
        <?php else: ?>
            <input type="hidden" name="new" value="1">
            <span>Produk baru (default)</span>
        <?php endif; ?>
        <br>

        <label>Stok:</label>
        <input type="number" name="stock" value="<?= $data['stock'] ?>" required>
        <br>

        <label>Total Order:</label>
        <input type="number" name="total_order" value="<?= $data['total_order'] ?>" readonly>
        <br>

        <label>Gambar Produk:</label>
        <input type="file" name="product_image" accept="image/*">
        <br>

        <button type="submit"><?= $id ? "Update" : "Simpan" ?></button>
    </form>
</body>

</html>