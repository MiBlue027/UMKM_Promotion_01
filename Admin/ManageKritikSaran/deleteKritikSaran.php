<?php
require '../../Database/getConnection.php';
$connection = getConnection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM criticism_suggestions WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
        header("Location: dashboardKritikSaran.php?message=Deleted successfully");
        exit();
    } else {
        header("Location: dashboardKritikSaran.php?message=Error deleting record");
        exit();
    }
} else {
    header("Location: dashboardKritikSaran.php?message=Invalid request");
    exit();
}
