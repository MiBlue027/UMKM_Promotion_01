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

// Tentukan folder tempat menyimpan file
$targetDirectory = __DIR__ . '/../../Asset/Products/uploads/';

// Periksa apakah folder sudah ada, jika tidak, buat folder
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true);
}

// Inisialisasi variabel untuk menyimpan path gambar
$relativePath = null;

// Ambil gambar produk yang ada dari database jika ada
if ($id) {
    $statement = $connection->prepare("SELECT product_image FROM product WHERE id = :id");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $existingImage = $statement->fetchColumn();
}

// Periksa apakah ada file yang diunggah
if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['product_image'];
    $fileName = uniqid() . '-' . basename($file['name']);
    $targetFilePath = $targetDirectory . $fileName; // Full path for saving the image
    $relativePath = '../Asset/Products/uploads/' . $fileName; // Relative path for database
    $fileType = mime_content_type($file['tmp_name']); // Dapatkan tipe MIME file

    // Periksa apakah file adalah gambar
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Add more types if needed
    if (in_array($fileType, $allowedTypes)) {
        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            echo "Gambar berhasil diunggah!<br>";
            echo "Path file: " . $targetFilePath;
        } else {
            die("Terjadi kesalahan saat mengunggah gambar.");
        }
    } else {
        die("File yang diunggah bukan gambar. Harap unggah file gambar.");
    }
} else {
    // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
    $relativePath = $existingImage;
}

// Store the relative path in the database
if ($id) {
    // Update existing record
    $statement = $connection->prepare("
        UPDATE product 
        SET product_name = :product_name, variant = :variant, price = :price, product_description = :product_description, new = :new, product_image = :product_image
        WHERE id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':variant', $variant);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_description', $product_description);
    $statement->bindValue(':new', $new, PDO::PARAM_INT);
    $statement->bindValue(':product_image', $relativePath); // Menggunakan path relatif
    $statement->execute();

    $statement = $connection->prepare("
        UPDATE product_details
        SET stock = :stock
        WHERE product_id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':stock', $stock);
    $statement->execute();
    echo "Data berhasil diperbarui.";
} else {
    // Insert new record
    $statement = $connection->prepare("
        INSERT INTO product (product_name, variant, price, product_description, new, product_image) 
        VALUES (:product_name, :variant, :price, :product_description, :new, :product_image)
    ");
    $statement->bindValue(':product_name', $product_name);
    $statement->bindValue(':variant', $variant);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_description', $product_description);
    $statement->bindValue(':new', $new, PDO::PARAM_INT);
    $statement->bindValue(': product_image', $relativePath); // Menggunakan path relatif
    $statement->execute();
    echo "Data berhasil disimpan.";

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
header("Location: ../ManageProduk/dashboardProduk.php");
exit;
