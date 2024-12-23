<?php
require_once __DIR__ . '/../Database/getConnection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address  = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];

    $connection = getConnection();
    $sql = 'UPDATE users SET address = :address, phone_number = :phoneNumber WHERE username = :username';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':username', $_SESSION['username']);
    $result = $statement->execute();

    if ($result){
        header('Location: profile.php');
        exit();
    }

    $statement = null;
    $connection = null;
}
?>
