<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT product.*, product_details.stock, product_details.total_order 
        FROM product
        JOIN product_details ON product_details.product_id = product.id";
$statement = $connection->query($sql);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icon Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS -->
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">

    <title>Admin Kriuk Berbuah</title>
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

        .main_title {
            color: #529ce8;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .container {
            width: 90vmax;
            margin: 0 auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 1.2rem;
        }

        td {
            font-size: 1rem;
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .tambah {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .tambah a {
            padding: 0.5em 1em;
            background-color: #529ce8;
            border-radius: 5px;
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .tambah a:hover {
            background-color: #86baff;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-buttons a {
            color: #529ce8;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .action-buttons a:hover {
            color: #86baff;
        }

        header {
            background-color: #529ce8;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        header a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
            font-weight: 500;
        }

        header a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php require_once '../adminNavigation.php' ?>
    <div class="container">
        <h1 class="main_title">List Produk</h1>
        <div class="tambah">
            <a href="formCreateUpdateProduk.php">Tambah Produk</a>
        </div>
        <div class="produk">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Varian</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Bestseller</th>
                        <th>New</th>
                        <th>Stok</th>
                        <th>Total Order</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?php echo $data['variant']; ?></td>
                            <td><?php echo number_format($data['price'], 2, ',', '.'); ?></td>
                            <td style="text-align:justify;"><?php echo $data['product_description']; ?></td>
                            <td><?php echo $data['best_seller'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $data['new'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $data['stock']; ?></td>
                            <td><?php echo $data['total_order']; ?></td>
                            <td><img src="../<?php echo $data['product_image'] ?>" alt="gambar"></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="formCreateUpdateProduk.php?id=<?= $data['id'] ?>"><i class='bx bxs-edit-alt bx-md'></i></a>
                                    <a href="deleteProduk.php?id=<?= $data['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class='bx bxs-trash bx-md'></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>