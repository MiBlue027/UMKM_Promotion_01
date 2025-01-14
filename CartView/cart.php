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

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="cartStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Cart </title>
</head>

<body>
    <?php
    include_once '../HeaderPackage/headerPage.php';
    if (empty($_SESSION['username'])) {
        header('location: ../LoginPage/loginPage.php');
        exit();
    }
    include_once '../HeaderPackage/navigationPage.php';

    $connection = getConnection();

    $sql = 'SELECT id FROM users WHERE username = :username';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':username', $_SESSION['username']);
    $statement->execute();
    $userID = $statement->fetch(PDO::FETCH_ASSOC);

    $sql = 'SELECT ct.id AS "cartID", p.id, p.product_image, p.product_name, p.product_description, p.price, ct.quantity FROM cart_temp ct 
            JOIN product p ON ct.product_id = p.id
            WHERE ct.user_id = :user_id;';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':user_id', $userID['id']);
    $statement->execute();

    $totalItems = $statement->rowCount();

    $subTotal = 0;

    ?>
    <div id="wrapper">
        <div id="cartContainer">
            <div id="listBoxContainer">
                <div id="listBoxTitle">
                    <h1> Keranjang Pembelian </h1>
                    <p> <span> <b> <?php echo $totalItems ?> Barang </b> </span> dalam keranjang anda</p>
                </div>
                <div id="listBox">
                    <table>
                        <thead>
                            <tr>
                                <th class="productImageCOL" style="text-align: left"> Produk </th>
                                <th class="productTitleCOL"></th>
                                <th class="priceProductCOL"> Harga </th>
                                <th class="quantityCOL"> Jumlah </th>
                                <th class="totalProductCOL"> Total </th>
                                <th class="cancelCOL"> </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($totalItems !== 0){
                                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                    ?>

                                    <tr>
                                        <td style="cursor: pointer;" onclick="gotoCartItemDetail(<?php echo $row['cartID'] ?>)">
                                            <div class="productImage">
                                                <img src="<?php echo $row['product_image'] ?>" alt="productImage">
                                            </div>
                                        </td>
                                        <td style="text-align: left; cursor: pointer;" onclick="gotoCartItemDetail(<?php echo $row['cartID'] ?>)">
                                            <div class="productInformation">
                                                <h1 style="margin: 50px 0"> <?php echo $row['product_name'] ?> </h1>
<!--                                                <p> --><?php //echo substr($row['product_description'], 0,80) . '...' ?><!-- </p>-->
                                            </div>
                                        </td>
                                        <td style="cursor: pointer;" onclick="gotoCartItemDetail(<?php echo $row['cartID'] ?>)">
                                            <p> Rp <?php echo $row['price'] ?> </p>
                                        </td>
                                        <td style="cursor: pointer;" onclick="gotoCartItemDetail(<?php echo $row['cartID'] ?>)">
                                            <?php echo $row['quantity'] ?>
                                        </td>
                                        <td style="cursor: pointer;" onclick="gotoCartItemDetail(<?php echo $row['cartID'] ?>)">
                                            <p> Rp <?php echo $row['price'] * $row['quantity']; $subTotal += $row['price'] * $row['quantity'] ?> </p>
                                        </td>
                                        <td>
                                            <div class="cancelIcon" onclick="window.location.href = 'cartDelete.php?cartID=<?php echo $row['cartID'] ?>'"> <ion-icon name="close-circle-outline"></ion-icon> </div>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" style="padding: 1.5em 0; font-weight: 500;"> Tidak ada produk dalam keranjang</td>
                                </tr>
                            <?php
                            }
                            ?>

                            <script>
                                function gotoCartItemDetail(cartID) {
                                    window.location.href = 'cartItemDetail.php?cartID=' + cartID;
                                }
                            </script>

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="totalPrice">
                <div id="totalPriceTitle">
                    <h1> Total Harga </h1>
                </div>
                <div id="totalPriceContent">
                    <table>
                        <tr>
                            <td class="totalCOL"> Subtotal </td>
                            <td class="doubleDot"> : </td>
                            <td class="priceCOL"> Rp <?php echo $subTotal ?> </td>
                        </tr>
                        <tr>
                            <td class="totalCOL"> Ongkir </td>
                            <td class="doubleDot"> : </td>
                            <td class="priceCOL"> Rp <?php if ($totalItems > 0) echo 50000; else echo 0?> </td>
                        </tr>
                        <tr>
                            <td class="totalCOL"> Total </td>
                            <td class="doubleDot"> : </td>
                            <td class="priceCOL"> Rp <?php echo ($totalItems > 0) ? $subTotal + 50000 : 0 ?> </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left; padding-top: 20px; font-weight: 550;"> Metode Pembayaran </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px; width: 35%">
                                <label>
                                    <input type="radio" name="paymentMethod" id="bcaMethod" value="BCA">
                                    BCA
                                </label>
                            </td>
                            <td style="padding-top: 10px">
                                <label>
                                    <input type="radio" name="paymentMethod" id="mandiriMethod" value="Mandiri">
                                    Mandiri
                                </label>
                            </td>
                            <td style="padding-top: 10px; position: relative; right: -1.2em">
                                <label>
                                    <input type="radio" name="paymentMethod" id="paypalMethod" value="Paypal">
                                    Paypal
                                </label>
                            </td>
                        </tr>

                    </table>
                    <button id="payBTN" class="paymentBTNDisabled"> Bayar </button>
                    <?php if ($totalItems > 0) { ?>
                        <script>
                            const payBTN = document.getElementById('payBTN');
                            const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');

                            // Tambahkan event listener pada setiap radio button
                            paymentMethods.forEach((radio) => {
                                radio.addEventListener('change', () => {
                                    if (radio.checked) {
                                        payBTN.classList.remove('paymentBTNDisabled');
                                        payBTN.classList.add('paymentBTNActive');
                                    }
                                });
                            });

                            payBTN.addEventListener('click', function () {
                                // Ambil metode pembayaran yang dipilih
                                const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
                                // Redirect ke URL dengan parameter
                                window.location.href = `cartPayment.php?username=<?php echo $_SESSION['username'] ?>&paymentMethod=${selectedMethod}`;
                            });
                        </script>
                    <?php } ?>
                    <div id="transactionHistoryContainer">
                        <a href="../TransactionHistory/transactionHistory.php"> Lihat Riwayat Transaksi </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    include_once '../Footer/footerPage.php';
    ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>