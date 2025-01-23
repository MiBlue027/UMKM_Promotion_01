<?php
require '../../Database/getConnection.php';

$connection = getConnection();
$id = isset($_GET['id']) ? $_GET['id'] : null;
$data = null;

if ($id) {
    $statement = $connection->prepare("SELECT * FROM gallery WHERE id = :id");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
}

$data = $data ?? [
    'id' => '',
    'title' => '',
    'article' => '',
    'image' => '',
    'trending' => 0
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Create/Update Gallery</title>
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">
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

        input[type="text"],
        textarea,
        input[type="file"] {
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
    <h1><?= $id ? "Update Gambar" : "Tambah Gambar" ?></h1>

    <form method="POST" action="simpanGallery.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Judul:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required>

        <label>Artikel:</label>
        <textarea name="article" required><?= htmlspecialchars($data['article']) ?></textarea>

        <label>Gambar:</label>
        <?php if ($data['image']): ?>
            <div class="current-image">
                <img src="../<?= htmlspecialchars($data['image']) ?>" alt="Current Image">
                <p>Gambar saat ini. Jika tidak ingin mengubah, biarkan kosong.</p>
            </div>
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">

        <label>Trending:</label>
        <input type="checkbox" name="trending" value="1" <?= $data['trending'] ? 'checked' : '' ?>>

        <button type="submit"><?= $id ? "Update" : "Simpan" ?></button>
    </form>
</body>

</html>