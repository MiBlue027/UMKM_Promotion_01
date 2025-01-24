<?php
require '../../Database/getConnection.php';
$connection = getConnection();
$id = $_GET['id'] ?? null;

if ($id) {
    // Fetch transaction details
    $statement = $connection->prepare("
        SELECT transaction_details.*, product.product_name, product.price 
        FROM transaction_details 
        JOIN product ON transaction_details.product_id = product.id 
        WHERE transaction_details.transaction_id = :id
    ");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $details = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Fetch transaction info
    $transactionStatement = $connection->prepare("SELECT * FROM transaction WHERE id = :id");
    $transactionStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $transactionStatement->execute();
    $transaction = $transactionStatement->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: dashboardTransaction.php?message=Invalid transaction ID");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: fit-content;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        header {
            width: 100%;
            height: 5em;
            background-color: #2f2f35;
            text-align: center;
            padding: 1em 0;
        }

        header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 2.5rem;
        }

        header a {
            display: inline-block;
            margin-top: 0.5rem;
            color: #ffffff;
            text-decoration: none;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        header a:hover {
            color: #86baff;
            text-shadow: 0 0 3px #ffffff;
        }

        .container {
            width: 90vmax;
            position: relative;
            margin: 0 auto;
        }

        .main_title {
            color: #529ce8;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
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
    </style>
</head>

<body>
    <header>
        <h1>Detail Transaksi</h1>
        <a href="dashboardTransaction.php">Kembali ke Transaksi</a>
    </header>
    <div class="container">
        <h1 class="main_title">Transaksi ID: <?php echo htmlspecialchars($transaction['id']); ?></h1>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($transaction['id_user']); ?></p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($transaction['payment_method']); ?></p>
        <p><strong>Transaction Date:</strong> <?php echo htmlspecialchars($transaction['transaction_date']); ?></p>

        <h2>Detail Produk</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Quantity</th>
                    <th>Status Testimoni</th>
                    <th>Total</th> <!-- New column for total price -->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($details as $detail) {
                    $totalPrice = $detail['quantity'] * $detail['price'];
                    $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($detail['testi_status']); ?></td>
                        <td><?php echo "Rp. " . $totalPriceFormatted; ?></td> <!-- Display total price -->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>