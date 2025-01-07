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

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--    Icon Link ---------------------------------------------------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--    CSS -->
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">

    <title>Admin Kriuk Berbuah </title>
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
    <header>
        <h1>Dashboard Admin</h1>
        <br>
        <a href="">Produk</a>
        <a href="">Galery</a>
        <a href="">Testimoni</a>
        <a href="">User</a>

    </header>
    <div class="container">
        <h1 class="main_title">List Produk</h1>
        <div class="tambah">
            <a href="formCreateUpdate.php" class="tambah">Tambah Produk</a>
        </div>
        <div class="produk">
            <table border="1">
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
                <?php
                foreach ($result as $data) {
                ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td><?php echo $data['variant']; ?></td>
                        <td><?php echo $data['price']; ?></td>
                        <td><?php echo $data['product_description']; ?></td>
                        <td><?php echo $data['best_seller']; ?></td>
                        <td><?php echo $data['new']; ?></td>
                        <td><?php echo $data['stock']; ?></td>
                        <td><?php echo $data['total_order']; ?></td>
                        <td><img src="../<?php echo $data['product_image'] ?>" alt="gambar"></td>
                        <td>
                            <a href="formCreateUpdate.php?id=<?= $data['id'] ?>"><i class='bx bxs-edit-alt bx-md'></i></a>
                            <a href="deleteProduk.php?id=<?= $data['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class='bx bxs-trash bx-md'></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>