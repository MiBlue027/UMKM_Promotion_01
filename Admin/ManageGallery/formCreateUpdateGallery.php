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
</head>

<body>
    <h1><?= $id ? "Update Gambar" : "Tambah Gambar" ?></h1>

    <form method="POST" action="simpanGallery.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Judul:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required>
        <br>

        <label>Artikel:</label>
        <textarea name="article" required><?= htmlspecialchars($data['article']) ?></textarea>
        <br>

        <label>Gambar:</label>
        <input type="file" name="image" accept="image/*" required>
        <br>

        <label>Trending:</label>
        <input type="checkbox" name="trending" value="1" <?= $data['trending'] ? 'checked' : '' ?>>
        <br>

        <button type="submit"><?= $id ? "Update" : "Simpan" ?></button>
    </form>
</body>

</html>