<?php
require_once __DIR__ . '/../../Database/getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailUser = $_POST["emailUser"];
    $newPassword = $_POST["newPassword"];
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

    $connection = getConnection();

    $sql = 'UPDATE users SET password = :newPassword WHERE email = :emailUser ';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':emailUser', $emailUser);
    $statement->bindValue(':newPassword', $newPasswordHash);
    if ($statement->execute()) {
        $statement = null;
        $connection = null;
//        echo $emailUser;
//        echo $newPassword;
//        echo $newPasswordHash;
        header('Location: ../loginPage.php?success=2');
        exit();
    }

    $statement = null;
    $connection = null;
}