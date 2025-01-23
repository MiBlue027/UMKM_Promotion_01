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
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">
    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #529ce8;
            margin-bottom: 1rem;
        }

        form {
            width: 90vmax;
            max-width: 600px;
            margin: 0 auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            width: 100%;
            padding: 0.5em;
            background-color: #529ce8;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #86baff;
        }

        .current-image {
            margin-bottom: 1rem;
            text-align: center;
        }

        .current-image img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1><?= $id ? "Update Produk" : "Tambah Produk" ?></h1>

    <form method="POST" action="simpanProduk.php" enctype="multipart/form-data">
        <!-- Field ID untuk update -->
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Nama Produk:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($data['product_name']) ?>" required>

        <label>Varian Produk:</label>
        <input type="text" name="variant" value="<?= htmlspecialchars($data['variant']) ?>" required>

        <label>Harga Produk:</label>
        <input type="number" name="price" value="<?= $data['price'] ?>" required>

        <label>Deskripsi:</label>
        <textarea name="product_description" required><?= htmlspecialchars($data['product_description']) ?></textarea>

        <label>New:</label>
        <?php if ($id): ?>
            <input type="checkbox" name="new" value="1" <?= $data['new'] ? 'checked' : '' ?>>
        <?php else: ?>
            <input type="hidden" name="new" value="1">
            <span>Produk baru (default)</span>
        <?php endif; ?>

        <label>Stok:</label>
        <input type="number" name="stock" value="<?= $data['stock'] ?>" required>

        <label>Total Order:</label>
        <input type="number" name="total_order" value="<?= $data['total_order'] ?>" readonly>

        <label>Gambar Produk:</label>
        <?php if ($data['product_image']): ?>
            <div class="current-image">
                <img src="../<?= htmlspecialchars($data['product_image']) ?>" alt="Current Image">
                <p>Gambar saat ini. Jika tidak ingin mengubah, biarkan kosong.</p>
            </div>
        <?php endif; ?>
        <input type="file" name="product_image" accept="image/*">

        <button type="submit"><?= $id ? "Update" : "Simpan" ?></button>
    </form>
</body>

</html>