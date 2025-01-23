<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$id = $_GET['id'] ?? null;
$testimonial = null;

if ($id) {
    $statement = $connection->prepare("SELECT * FROM testimony WHERE id = :id");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $testimonial = $statement->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect if no ID is provided
    header("Location: dashboardTestimoni.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Testimoni</title>
</head>

<body>
    <h1>Edit Testimoni</h1>
    <form action="saveTestimoni.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $testimonial['id'] ?? ''; ?>">

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $testimonial['user_id'] ?? ''; ?>" readonly>

        <label for="transaction_details_id">Transaction Details ID:</label>
        <input type="number" name="transaction_details_id" value="<?php echo $testimonial['transaction_details_id'] ?? ''; ?>" readonly>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo $testimonial['rating'] ?? ''; ?>" min="1" max="5" readonly>

        <label for="review">Review:</label>
        <textarea name="review" readonly><?php echo $testimonial['review'] ?? ''; ?></textarea>

        <label for="image1">Image 1:</label>
        <img src="../<?php echo $testimonial['image1'] ?? ''; ?>" alt="Image 1" style="width: 100px; height: auto;">

        <label for="image2">Image 2:</label>
        <img src="../<?php echo $testimonial['image2'] ?? ''; ?>" alt="Image 2" style="width: 100px; height: auto;">

        <label for="visibility">Visibility:</label>
        <select name="visibility">
            <option value="1" <?php echo ($testimonial['visibility'] ?? 1) == 1 ? 'selected' : ''; ?>>Visible</option>
            <option value="0" <?php echo ($testimonial['visibility'] ?? 0) == 0 ? 'selected' : ''; ?>>Hidden</option>
        </select>

        <button type="submit">Update Visibility</button>
    </form>
</body>

</html>