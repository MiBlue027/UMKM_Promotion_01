<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT transaction.*, users.username 
        FROM transaction 
        JOIN users ON transaction.id_user = users.id";
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
    <title>Admin Transaksi</title>

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
            border-collapse: collapse;
        }

        th,
        tr,
        td {
            padding: 0.5rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            font-size: 1.2rem;
            background-color: #f2f2f2;
        }

        td {
            font-size: 1rem;
        }

        .view-detail {
            background-color: #529ce8;
            color: white;
            padding: 0.5em 1em;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .view-detail:hover {
            background-color: #86baff;
        }
    </style>
</head>

<body>
    <header>
        <h1>Dashboard Admin</h1>
        <br>
        <a href="dashboardProduk.php">Produk</a>
        <a href="dashboardGallery.php">Galery</a>
        <a href="dashboardTestimoni.php">Testimoni</a>
        <a href="dashboardUser .php">User </a>
        <a href="dashboardCriticismSuggestions.php">Kritik dan Saran</a>
        <a href="dashboardTransaction.php">Transaksi</a>
    </header>
    <div class="container">
        <h1 class="main_title">List Transaksi</h1>
        <div class="transactions">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Payment Method</th>
                        <th>Transaction Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['payment_method']); ?></td>
                            <td><?php echo htmlspecialchars($data['transaction_date']); ?></td>
                            <td>
                                <a href="detailTransaction.php?id=<?php echo $data['id']; ?>" class="view-detail">Lihat Detail</a>
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