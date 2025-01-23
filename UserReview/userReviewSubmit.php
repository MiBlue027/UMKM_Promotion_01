<?php
require_once __DIR__ . '/../Database/getConnection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Tentukan folder tempat menyimpan file
    $targetDirectory = "../Asset/Testi/UserAdd/";

    // Periksa apakah folder sudah ada, jika tidak, buat folder
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Inisialisasi variabel untuk file path
    $targetFilePath1 = null;
    $targetFilePath2 = null;

    // Periksa dan proses file imageInput1
    if (isset($_FILES['imageInput1']) && $_FILES['imageInput1']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['imageInput1'];

        // Periksa ukuran file (dalam byte)
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
        if ($file['size'] > $maxFileSize) {
            echo "Ukuran file melebihi batas maksimum 2 MB.";
            exit;
        }

        // Ambil informasi file
        $fileName = uniqid('img1_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFilePath1 = $targetDirectory . $fileName;
        $fileType = mime_content_type($file['tmp_name']); // Dapatkan tipe MIME file

        // Periksa apakah file adalah gambar
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($fileType, $allowedTypes)) {
            // Pindahkan file ke folder tujuan
            if (!move_uploaded_file($file['tmp_name'], $targetFilePath1)) {
                echo "Terjadi kesalahan saat mengunggah gambar 1.";
                $targetFilePath1 = null; // Reset path jika gagal
            }
        } else {
            echo "File yang diunggah bukan gambar untuk imageInput1.";
            $targetFilePath1 = null; // Reset path jika bukan gambar
        }
    }

    // Periksa dan proses file imageInput2
    if (isset($_FILES['imageInput2']) && $_FILES['imageInput2']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['imageInput2'];

        // Periksa ukuran file (dalam byte)
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
        if ($file['size'] > $maxFileSize) {
            echo "Ukuran file melebihi batas maksimum 2 MB.";
            exit;
        }

        // Ambil informasi file
        $fileName = uniqid('img2_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFilePath2 = $targetDirectory . $fileName;
        $fileType = mime_content_type($file['tmp_name']); // Dapatkan tipe MIME file

        // Periksa apakah file adalah gambar
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($fileType, $allowedTypes)) {
            // Pindahkan file ke folder tujuan
            if (!move_uploaded_file($file['tmp_name'], $targetFilePath2)) {
                echo "Terjadi kesalahan saat mengunggah gambar 2.";
                $targetFilePath2 = null; // Reset path jika gagal
            }
        } else {
            echo "File yang diunggah bukan gambar untuk imageInput2.";
            $targetFilePath2 = null; // Reset path jika bukan gambar
        }
    }

    $connection = getConnection();

    // Ambil ID pengguna
    $sql = 'SELECT id FROM users WHERE username = :username';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':username', $_SESSION['username']);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $userID = $user['id'];

    // Masukkan data ke tabel testimony
    $sql = 'INSERT INTO testimony (transaction_details_id, user_id, rating, review, image1, image2) VALUES (:transaction_details_id, :user_id, :rating, :review, :image1, :image2)';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':transaction_details_id', $_POST['transactionDetailIDHidden']);
    $statement->bindValue(':user_id', $userID);
    $statement->bindValue(':rating', $_POST['rating']);
    $statement->bindValue(':review', $_POST['reviewTA']);
    $statement->bindValue(':image1', $targetFilePath1);
    $statement->bindValue(':image2', $targetFilePath2);
    if ($statement->execute()){

        $sql = 'UPDATE transaction_details SET testi_status = 1 WHERE id = :transaction_id';
        $statement = $connection->prepare($sql);
        $statement->bindValue(':transaction_id', $_POST['transactionDetailIDHidden']);
        if ($statement->execute()){
            $statement = null;
            $connection = null;
            header('location: ../TransactionHistory/transactionHistory.php?success=1');
            exit();
        }
    }

    $statement = null;
    $connection = null;
}
?>
