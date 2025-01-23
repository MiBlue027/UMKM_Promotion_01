<?php
require_once __DIR__ . '/../Database/getConnection.php';

$connection = getConnection();

// Get user ID
$sql = "SELECT id FROM users WHERE username = :username";
$userStmt = $connection->prepare($sql);
$userStmt->bindParam(':username', $_GET['username']);
$userStmt->execute();
$userID = $userStmt->fetch(PDO::FETCH_ASSOC)['id'];

$sql = 'SELECT * FROM transaction';
$transStmt = $connection->prepare($sql);
$transStmt->execute();
$transactionID = $transStmt->rowCount() + 1;

// Create new transaction
$sql = "INSERT INTO transaction (id, id_user, payment_method) VALUES (:transactionID, :userID, :paymentMethod)";
$insertTransStmt = $connection->prepare($sql);
$insertTransStmt->bindParam(':transactionID', $transactionID);
$insertTransStmt->bindParam(':userID', $userID);
$insertTransStmt->bindParam(':paymentMethod', $_GET['paymentMethod']);

if ($insertTransStmt->execute()) {
    // Get cart items
    $sql = 'SELECT * FROM cart_temp WHERE user_id = :userID';
    $cartStmt = $connection->prepare($sql);
    $cartStmt->bindParam(':userID', $userID);
    $cartStmt->execute();

    // Prepare statement for inserting transaction details (outside the loop)
    $sql = 'INSERT INTO transaction_details (transaction_id, product_id, quantity) VALUES (:transaction_id, :product_id, :quantity)';
    $detailStmt = $connection->prepare($sql);
    while ($row = $cartStmt->fetch(PDO::FETCH_ASSOC)) {
        $detailStmt->bindParam(':transaction_id', $transactionID);
        $detailStmt->bindParam(':product_id', $row['product_id']);
        $detailStmt->bindParam(':quantity', $row['quantity']);
        $detailStmt->execute();

        $sql = 'UPDATE product_details SET total_order = total_order + :quantity WHERE id = :product_id';
        $updateDetailStmt = $connection->prepare($sql);
        $updateDetailStmt->bindParam(':quantity', $row['quantity']);
        $updateDetailStmt->bindParam(':product_id', $row['product_id']);
        $updateDetailStmt->execute();
    }

    // Clear the cart
    $sql = 'DELETE FROM cart_temp WHERE user_id = :userID';
    $deleteCartStmt = $connection->prepare($sql);
    $deleteCartStmt->bindParam(':userID', $userID);
    if($deleteCartStmt->execute()) {
        header('Location: cart.php?success=1');
        exit();
    }
}