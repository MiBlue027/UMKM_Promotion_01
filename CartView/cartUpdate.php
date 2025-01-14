<?php
require_once __DIR__.'/../Database/getConnection.php';

$connection = getConnection();

$sql = 'UPDATE cart_temp SET quantity = :quantity WHERE id = :cartID';
$statement = $connection->prepare($sql);
$statement->bindValue(':quantity', $_GET['quantity']);
$statement->bindValue(':cartID', $_GET['cartID']);
if ($statement->execute()) {
    $newQuantity = $_GET['quantity'] - $_GET['oldQuantity'];
    $sql = 'UPDATE product_details SET stock = stock - :quantity WHERE product_id = :product_id';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':quantity', (int) $newQuantity, PDO::PARAM_INT);
    $statement->bindValue(':product_id', $_GET['productID']);

    if ($statement->execute()) {
        $statement = null;
        $connection = null;
        header("Location: cart.php");
        exit();
    }
}
$statement = null;
$connection = null;