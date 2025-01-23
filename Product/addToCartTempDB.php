<?php
require_once __DIR__.'/../Database/getConnection.php';
session_start();

$connection = getConnection();
$sql = 'SELECT id FROM users WHERE username = :username';
$statement = $connection->prepare($sql);
$statement->bindValue(':username', $_GET['username']);
$statement->execute();
$userID = $statement->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT product_id FROM cart_temp WHERE user_id = :userID AND product_id = :productID';
$statement = $connection->prepare($sql);
$statement->bindValue(':userID', $userID['id']);
$statement->bindValue(':productID', $_GET['productID']);
$statement->execute();
if ($statement->rowCount() > 0) {
    $sql = 'UPDATE cart_temp SET quantity = quantity + :quantity WHERE user_id = :userID AND product_id = :productID';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':quantity', $_GET['quantity']);
    $statement->bindValue(':userID', $userID['id']);
    $statement->bindValue(':productID', $_GET['productID']);
} else {
    $sql = 'INSERT INTO cart_temp (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':user_id', $userID['id']);
    $statement->bindValue(':product_id', $_GET['productID']);
    $statement->bindValue(':quantity', $_GET['quantity']);
}
if ($statement->execute()) {
    $sql = 'UPDATE product_details SET stock = stock - :quantity WHERE product_id = :product_id';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':quantity', (int)$_GET['quantity'], PDO::PARAM_INT);
    $statement->bindValue(':product_id', $_GET['productID']);

    if ($statement->execute()) {
        $statement = null;
        $connection = null;
        header("Location: product.php?variant=".$_SESSION['variant']."&success=1");
        exit();
    }
}

$statement = null;
$connection = null;