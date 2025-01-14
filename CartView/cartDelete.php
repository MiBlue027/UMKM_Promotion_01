<?php
require_once __DIR__ . '/../Database/getConnection.php';

$connection = getConnection();

$sql = 'SELECT * FROM cart_temp WHERE id = :cartID';
$statement = $connection->prepare($sql);
$statement->bindParam(':cartID', $_GET['cartID']);
$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);
$productID = $result['product_id'];
$quantity = $result['quantity'];

$sql = 'UPDATE product_details SET stock = stock + :quantity WHERE product_id = :productID';
$statement = $connection->prepare($sql);
$statement->bindParam(':quantity', $quantity);
$statement->bindParam(':productID', $productID);
if ($statement->execute()){
    $sql = "DELETE FROM cart_temp WHERE id = :cardID";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':cardID', $_GET['cartID']);
    if ($statement->execute()){
        $statement = null;
        $connection = null;
        header('location: cart.php');
        exit();
    }
}

$statement = null;
$connection = null;