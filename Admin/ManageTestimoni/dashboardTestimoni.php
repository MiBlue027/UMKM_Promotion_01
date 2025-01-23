<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$sql = "SELECT testimony.*, users.username, transaction.id AS transaction_id 
        FROM testimony 
        JOIN users ON testimony.user_id = users.id 
        JOIN transaction_details ON testimony.transaction_details_id = transaction_details.id 
        JOIN transaction ON transaction_details.transaction_id = transaction.id";
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
    <title>Admin Testimoni</title>
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
        <a href="dashboardProduk.php">Produk</a>
        <a href="dashboardGallery.php">Galery</a>
        <a href="dashboardTestimoni.php">Testimoni</a>
        <a href="dashboardUser .php">User </a>
    </header>
    <div class="container">
        <h1 class="main_title">List Testimoni</h1>
        <div class="testimoni">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Transaction ID</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Visibility</th>
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
                            <td><?php echo htmlspecialchars($data['transaction_id']); ?></td>
                            <td><?php echo htmlspecialchars($data['rating']); ?></td>
                            <td><?php echo htmlspecialchars($data['review']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($data['image1']); ?>" alt="Image 1" width="50"></td>
                            <td><img src="<?php echo htmlspecialchars($data['image2']); ?>" alt="Image 2" width="50"></td>
                            <td><?php echo $data['visibility'] ? 'Visible' : 'Hidden'; ?></td>
                            <td>
                                <a href="formCreateUpdateTestimoni.php?id=<?php echo $data['id']; ?>">Edit</a>
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