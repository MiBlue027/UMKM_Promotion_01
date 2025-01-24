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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
        <h1 class="main_title">List Transaksi</h1>
        <div class="transactions">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Payment Method</th>
                        <th>Transaction Date</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $data) {
                        // Calculate total for each transaction
                        $transactionId = $data['id'];
                        $totalStatement = $connection->prepare("
                            SELECT SUM(td.quantity * p.price) as total 
                            FROM transaction_details td 
                            JOIN product p ON td.product_id = p.id 
                            WHERE td.transaction_id = :transaction_id
                        ");
                        $totalStatement->bindValue(':transaction_id', $transactionId, PDO::PARAM_INT);
                        $totalStatement->execute();
                        $total = $totalStatement->fetch(PDO::FETCH_ASSOC)['total'];
                        $total_format = number_format($total, 0, ',', '.');
                    ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['payment_method']); ?></td>
                            <td><?php echo htmlspecialchars($data['transaction_date']); ?></td>
                            <td><?php echo "Rp. " . $total_format; ?></td>
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