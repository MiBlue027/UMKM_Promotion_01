<?php
require_once __DIR__ . '/../Database/getConnection.php';

$adminUsername = 'admin1'; // Username admin
$adminPassword = '1234'; // Password admin
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

$connection = getConnection();

// Periksa apakah username sudah ada
$sqlCheck = "SELECT COUNT(*) FROM admin WHERE admin = :admin";
$stmtCheck = $connection->prepare($sqlCheck);
$stmtCheck->bindParam(':admin', $adminUsername);
$stmtCheck->execute();
$count = $stmtCheck->fetchColumn();

if ($count > 0) {
    echo "Username sudah digunakan. Silakan pilih username lain.";
} else {
    // Lanjutkan dengan proses penyisipan data
    $sql = "INSERT INTO admin (admin, password) VALUES (:admin, :password)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':admin', $adminUsername);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo "Data admin berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data admin.";
    }
}
?>
