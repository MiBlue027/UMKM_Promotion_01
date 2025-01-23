<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$id = $_GET['id'];

$sql = "DELETE FROM gallery WHERE id = :id";
$statement = $connection->prepare($sql);
$statement->execute(['id' => $id]);

header("Location: dashboardGallery.php");
exit;
