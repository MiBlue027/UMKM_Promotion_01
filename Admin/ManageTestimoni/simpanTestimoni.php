<?php
require '../../Database/getConnection.php';
$connection = getConnection();

$id = $_POST['id'] ?? null;
$visibility = $_POST['visibility'] ?? 1;

// Check if the ID is provided for updating
if ($id) {
    // Update only the visibility field
    $statement = $connection->prepare("
        UPDATE testimony 
        SET visibility = :visibility 
        WHERE id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':visibility', $visibility, PDO::PARAM_INT);
    $statement->execute();

    // Optionally, you can add a success message
    echo "Visibility updated successfully.";
}

// Redirect to the dashboard after updating
header("Location: dashboardTestimoni.php");
exit;
