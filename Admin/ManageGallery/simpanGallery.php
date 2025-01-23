<?php
require '../../Database/getConnection.php';

$connection = getConnection();
$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$article = $_POST['article'] ?? '';
$imagePath = '';
$trending = isset($_POST['trending']) ? 1 : 0;

// Tentukan folder tempat menyimpan file
$targetDirectory = __DIR__ . '/../../Asset/Gallery/uploads/';

// Periksa apakah folder sudah ada, jika tidak, buat folder
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true);
}

// Periksa apakah ada file yang diunggah
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $targetFilePath = $targetDirectory . $fileName; // Full path for saving the image
    $relativePath = '../Asset/Gallery/uploads/' . $fileName; // Relative path for database
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
    die("Tidak ada file yang diunggah.");
}

// Store the relative path in the database
if ($id) {
    // Update existing record
    $statement = $connection->prepare("UPDATE gallery SET title = :title, article = :article, image = COALESCE(:image, image), trending = :trending WHERE id = :id");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':article', $article);
    $statement->bindValue(':image', $relativePath); // Use relative path
    $statement->bindValue(':trending', $trending, PDO::PARAM_INT);
    $statement->execute();
    echo "Data berhasil diperbarui.";
} else {
    // Insert new record
    $statement = $connection->prepare("INSERT INTO gallery (title, article, image, trending) VALUES (:title, :article, :image, :trending)");
    $statement->bindValue(':title', $title);
    $statement->bindValue(':article', $article);
    $statement->bindValue(':image', $relativePath); // Use relative path
    $statement->bindValue(':trending', $trending, PDO::PARAM_INT);
    $statement->execute();
    echo "Data berhasil disimpan.";
}

// Redirect or display success message
header("Location: dashboardGallery.php");
exit;
