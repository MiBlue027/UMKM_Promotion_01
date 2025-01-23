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

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icon Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #529ce8;
            margin-bottom: 1rem;
        }

        form {
            width: 90vmax;
            max-width: 600px;
            margin: 0 auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            width: 100%;
            padding: 0.5em;
            background-color: #529ce8;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #86baff;
        }

        .current-image {
            margin-bottom: 1rem;
            text-align: center;
        }

        .current-image img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Edit Testimoni</h1>
    <form action="simpanTestimoni.php" method="POST" enctype="multipart/form-data">
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
        <div class="current-image">
            <img src="../<?php echo $testimonial['image1'] ?? ''; ?>" alt="Image 1">
        </div>

        <label for="image2">Image 2:</label>
        <div class="current-image">
            <img src="../<?php echo $testimonial['image2'] ?? ''; ?>" alt="Image 2">
        </div>

        <label for="visibility">Visibility:</label>
        <select name="visibility">
            <option value="1" <?php echo ($testimonial['visibility'] ?? 1) == 1 ? 'selected' : ''; ?>>Visible</option>
            <option value="0" <?php echo ($testimonial['visibility'] ?? 0) == 0 ? 'selected' : ''; ?>>Hidden</option>
        </select>

        <button type="submit">Update Visibility</button>
    </form>

</body>

</html>