<?php
require_once __DIR__ . '/../../Database/getConnection.php';
$connection = getConnection();

// Total Transaksi
$totalTransactionStatement = $connection->prepare("SELECT COUNT(*) as total FROM transaction");
$totalTransactionStatement->execute();
$totalTransaction = $totalTransactionStatement->fetch(PDO::FETCH_ASSOC)['total'];

// Total Pendapatan
$totalRevenueStatement = $connection->prepare("SELECT SUM(total) as total FROM transaction");
$totalRevenueStatement->execute();
$totalRevenue = $totalRevenueStatement->fetch(PDO::FETCH_ASSOC)['total'];

// Barang Stok Habis
$outOfStockStatement = $connection->prepare("SELECT COUNT(*) as total FROM product_details WHERE stock = 0");
$outOfStockStatement->execute();
$outOfStock = $outOfStockStatement->fetch(PDO::FETCH_ASSOC)['total'];

// Bestseller
$bestsellerStatement = $connection->prepare("
    SELECT product.product_name, product_details.total_order, product_details.stock 
    FROM product_details 
    JOIN product ON product_details.product_id = product.id 
    ORDER BY product_details.total_order DESC 
    LIMIT 1
");
$bestsellerStatement->execute();
$bestseller = $bestsellerStatement->fetch(PDO::FETCH_ASSOC);

// Daftar Barang dan Stok
$productsStatement = $connection->prepare("
    SELECT product.product_name, product_details.stock, product.price 
    FROM product_details 
    JOIN product ON product_details.product_id = product.id
");
$productsStatement->execute();
$products = $productsStatement->fetchAll(PDO::FETCH_ASSOC);

// Transaksi Terkini
$recentTransactionsStatement = $connection->prepare("
    SELECT transaction.id, transaction.transaction_date, users.username, transaction.total 
    FROM transaction 
    JOIN users ON transaction.id_user = users.id 
    ORDER BY transaction.transaction_date DESC 
    LIMIT 5
");
$recentTransactionsStatement->execute();
$recentTransactions = $recentTransactionsStatement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Dashboard </title>

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="adminDashboardStyle.css">

</head>

<body>
    <?php require_once '../adminNavigation.php' ?>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="dashboard">
            <div class="card">
                <h2>Total Transaksi</h2>
                <p><?php echo $totalTransaction; ?></p>
            </div>
            <div class="card">
                <h2>Total Pendapatan</h2>
                <p>Rp <?php echo number_format($totalRevenue, 0, ',', '.'); ?></p>
            </div>
            <div class="card">
                <h2>Barang Stok Habis</h2>
                <p><?php echo $outOfStock; ?></p>
            </div>
            <div class="card">
                <h2>Bestseller</h2>
                <p><?php echo htmlspecialchars($bestseller['product_name']); ?></p>
                <p>Order: <?php echo $bestseller['total_order']; ?></p>
                <p>Stock: <?php echo $bestseller['stock']; ?></p>
            </div>
        </div>

        <div class="scrollable">
            <h2>Daftar Barang dan Stok</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="recent-transactions">
            <h2>Transaksi Terkini</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Username</th>
                        <th>Total Belanja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentTransactions as $transaction): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($transaction['id']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['transaction_date']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['username']); ?></td>
                            <td>Rp <?php echo number_format($transaction['total'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>