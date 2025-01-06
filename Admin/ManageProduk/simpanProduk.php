<?php
require '../../Database/getConnection.php';

$connection = getConnection();
$id = $_POST['id'] ?? null;
$product_name = $_POST['product_name'] ?? '';
$variant = $_POST['variant'] ?? '';
$price = $_POST['price'] ?? 0;
$product_description = $_POST['product_description'] ?? '';
$new = isset($_POST['new']) ? 1 : ($id ? 0 : 1);
$stock = $_POST['stock'] ?? 0;

// Path untuk upload gambar
$uploadDir = __DIR__ . '/../../Asset/Products/uploads/';
$productImage = '';

if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    // Membuat folder jika belum ada
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        // Membuat folder jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = uniqid() . '-' . basename($_FILES['product_image']['name']);
        $productImage = $uploadDir . $fileName; // Lokasi penyimpanan di server
        $relativePath = 'Asset/Products/uploads/' . $fileName; // Path relatif untuk disimpan di database

        // Cek apakah file berhasil dipindahkan
        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $productImage)) {
            die('Gagal memindahkan file. Pastikan folder memiliki izin tulis.');
        }
    } else {
        $relativePath = null; // Tidak ada gambar yang diunggah
    }
}

if ($id) {
    // Update data jika ID tersedia
    $statement = $connection->prepare("
        UPDATE product 
        SET product_name = :product_name, variant = :variant, price = :price, product_description = :product_description, new = :new, product_image = COALESCE(:product_image, product_image)
        WHERE id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':variant', $variant);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_description', $product_description);
    $statement->bindValue(':new', $new, PDO::PARAM_INT);
    $statement->bindValue(':product_image', $relativePath ?: null);
    $statement->execute();

    $statement = $connection->prepare("
        UPDATE product_details
        SET stock = :stock
        WHERE product_id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':stock', $stock);
    $statement->execute();
} else {
    // Insert data baru jika ID tidak tersedia
    $statement = $connection->prepare("
        INSERT INTO product (product_name, variant, price, product_description, new, product_image) 
        VALUES (:product_name, :variant, :price, :product_description, :new, :product_image)
    ");
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':variant', $variant);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_description', $product_description);
    $statement->bindValue(':new', $new, PDO::PARAM_INT);
    $statement->bindValue(':product_image', $relativePath ?: null);
    $statement->execute();

    $newProductId = $connection->lastInsertId();

    $statement = $connection->prepare("
        INSERT INTO product_details (product_id, stock, total_order)
        VALUES (:product_id, :stock, 0)
    ");
    $statement->bindValue(':product_id', $newProductId, PDO::PARAM_INT);
    $statement->bindValue(':stock', $stock);
    $statement->execute();
}

// Redirect ke halaman dashboard produk setelah selesai
header('Location: ../ManageProduk/dashboardProduk.php');
exit;
