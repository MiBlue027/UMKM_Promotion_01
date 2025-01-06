<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$id = $_GET['id'];

$sql = "DELETE FROM product WHERE id = :id";
$statement = $connection->prepare($sql);
$statement->execute(['id' => $id]);

header("Location: dashboardProduk.php");
exit;
