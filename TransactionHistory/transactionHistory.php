<?php
require_once __DIR__ . '/../Database/getConnection.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Transaction History </title>

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="transactionHistoryStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

</head>
<body>
    <?php
    include_once '../HeaderPackage/headerPage.php';
    if (empty($_SESSION['username'])) {
        header('location: ../LoginPage/loginPage.php');
        exit();
    }
    include_once '../HeaderPackage/navigationPage.php';
    ?>

    <div class="wrapper">
        <div id="title">
            <h1> Riwayat Transaksi </h1>
            <p> Setiap transaksi Anda adalah ukiran berharga dalam perjalanan toko kami </p>
        </div>
        <div id="container">
            <table>
                <thead>
                    <tr>
                        <th> No. </th>
                        <th colspan="2" style="text-align: left; width: 42%"> Product </th>
                        <th> harga </th>
                        <th> Jumlah </th>
                        <th> total </th>
                        <th> pembayaran </th>
                        <th style="width: 15%"> tanggal pembayaran </th>
                        <th> ulasan </th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $connection = getConnection();

                    $sql = 'SELECT id FROM users WHERE username = :username';
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(':username', $_SESSION['username']);
                    $statement->execute();

                    $userID = $statement->fetch(PDO::FETCH_ASSOC)['id'];

                    $sql = "SELECT td.id AS 'td_id' , t.id, t.payment_method, t.transaction_date, p.product_image, p.product_name, p.variant, p.price, p.product_description, td.quantity FROM transaction t 
                            JOIN transaction_details td ON t.id = td.transaction_id
                            JOIN product p ON td.product_id = p.id                                                                                           
                            WHERE t.id_user = :user_id AND td.testi_status = 0";
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(':user_id', $userID);
                    $statement->execute();

                    $numbering = 1;
                    if ($statement->rowCount() > 0) {
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                            <tr>
                                <td> <?php echo $numbering++ ?>. </td>
                                <td style="text-align: left"> <img src="<?php echo $row['product_image'] ?>" alt="productImage" class="productImage"> </td>
                                <td> <h1 class="productTitle"> <?php echo $row['product_name'] ?> </h1> </td>
                                <td> <p> Rp <?php echo $row['price'] ?> </p> </td>
                                <td> <?php echo $row['quantity'] ?> </td>
                                <td> Rp <?php echo $row['price'] * $row['quantity'] ?></td>
                                <td> <?php echo $row['payment_method'] ?> </td>
                                <td> <?php echo substr($row['transaction_date'],0, 19)  ?> </td>
                                <td>
                                    <form action="../UserReview/userReview.php" method="POST">
                                        <input type="hidden" name="transactionID" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="transactionDetailID" value="<?php echo $row['td_id']; ?>">
                                        <button type="submit" class="reviewBTN">Beri Ulasan</button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    $sql = "SELECT t.id, t.payment_method, t.transaction_date, p.product_image, p.product_name, p.variant, p.price, p.product_description, td.quantity FROM transaction t 
                            JOIN transaction_details td ON t.id = td.transaction_id
                            JOIN product p ON td.product_id = p.id                                                                                           
                            WHERE t.id_user = :user_id AND td.testi_status = 1;";
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(':user_id', $userID);
                    $statement->execute();

                    if ($statement->rowCount() > 0) {
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            ?>

                            <tr>
                                <td> <?php echo $numbering++ ?>. </td>
                                <td style="text-align: left"> <img src="<?php echo $row['product_image'] ?>" alt="productImage" class="productImage"> </td>
                                <td> <h1 class="productTitle"> <?php echo $row['product_name'] ?> </h1> </td>
                                <td> <p> Rp <?php echo $row['price'] ?> </p> </td>
                                <td> <?php echo $row['quantity'] ?> </td>
                                <td> Rp <?php echo $row['price'] * $row['quantity'] ?></td>
                                <td> <?php echo $row['payment_method'] ?> </td>
                                <td> <?php echo substr($row['transaction_date'],0, 19)  ?> </td>
                                <td>
                                    <span class="doneTestimony"> <ion-icon name="checkmark-done-outline"></ion-icon> </span>
                                </td>
                            </tr>

                            <?php
                        }
                    } if ($numbering === 1) {
                        ?>
                        <tr>
                            <td colspan="8" style="font-weight: 550;"> Anda belum melakukan transaksi </td>
                        </tr>
                        <?php
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include_once '../Footer/footerPage.php';
    ?>
</body>
</html>
