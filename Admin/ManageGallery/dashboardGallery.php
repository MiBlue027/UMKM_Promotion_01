<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT * FROM gallery";
$statement = $connection->query($sql);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">
    <title>Admin Gallery</title>
    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--    Icon Link ---------------------------------------------------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        .main_title {
            color: #529ce8;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 0;
        }

        .container {
            width: 90vmax;
            position: relative;
            margin: 0 auto;
        }

        table {
            width: 100%;
        }

        th,
        tr,
        td {
            padding: 0.5rem;
            text-align: center;
        }

        th {
            font-size: 1.2rem;
        }

        td {
            font-size: 1rem;
        }

        .tambah {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .tambah a {
            width: 10em;
            height: 3em;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #529ce8;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: 550;
            text-decoration: none;
            color: #ffffff;
            transition: 0.4s;
        }

        .tambah a:hover {
            background-color: #86baff;
        }
    </style>
</head>

<body>
    <?php require_once '../adminNavigation.php' ?>
    <div class="container">
        <h1 class="main_title">List Gallery</h1>
        <div class="tambah">
            <a href="formCreateUpdateGallery.php">Tambah Gambar</a>
        </div>
        <div class="gallery">
            <table border="1">
                <th>Id</th>
                <th>Judul</th>
                <th>Artikel</th>
                <th>Gambar</th>
                <th>Trending</th>
                <th>Action</th>
                <?php
                foreach ($result as $data) {
                ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo htmlspecialchars($data['title']); ?></td>
                        <td><?php echo htmlspecialchars($data['article']); ?></td>
                        <td><img src="../<?php echo $data['image']; ?>" alt="gambar" style="width: 100px; height: auto;"></td>
                        <td><?php echo $data['trending'] ? 'Ya' : 'Tidak'; ?></td>
                        <td>
                            <a href="formCreateUpdateGallery.php?id=<?= $data['id'] ?>"><i class='bx bxs-edit-alt bx-md'></i></a>
                            <a href="deleteGallery.php?id=<?= $data['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class='bx bxs-trash bx-md'></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table </div>
        </div>
</body>

</html>