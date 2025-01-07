<?php
require_once __DIR__ . '/../../Database/getConnection.php';
session_start();
if (empty($_SESSION['username'])) {
    header('location: ../../LoginPage/loginPage.php');
    exit();
} else{
    $username = $_SESSION['username'];
    $userAvatar = $_SESSION['userAvatar'];
    session_destroy();
}

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

    <link rel="stylesheet" href="itemStyle.css">
    <link rel="stylesheet" href="../../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../../Footer/footerPageStyle.css">

    <title> Item </title>
</head>

<body>

    <?php
    include_once '../../HeaderPackage/headerPage.php';
    $_SESSION['username'] = $username;
    $_SESSION['userAvatar'] = $userAvatar;
    include_once '../../HeaderPackage/navigationPage.php';
    ?>

    <div id="container">
        <div id="mainInformation">
            <?php
            $connection = getConnection();

            $sql = 'SELECT * FROM product p
                    JOIN product_details pd ON p.id = pd.product_id
                    WHERE p.id = :productID';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':productID', $_GET['productID']);


            $statement = null;
            $connection = null;
            ?>
            <div id="itemImage">
                <img src="../../Asset/Products/pisang_durian.jpg" alt="">
            </div>
            <div id="itemInformation">
                <h1> Keripik Pisang Durian</h1>
                <p id="productDescription">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Ab, aliquam atque commodi consequuntur dolor et eum maxime odit perferendis quis.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, rerum.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi dicta quas veniam.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, quaerat!
                </p>
                <p id="price"> Rp 50.000 </p>
                <div id="action">
                    <div id="quantity">
                        <button> - </button>
                        1
                        <button> + </button>
                    </div>
                    <button id="addToCartBTN"> Masukan Keranjang </button>
                </div>
            </div>
        </div>
    </div>

    <div id="otherProductContainer">
        <div id="otherProductTitle">
            <div class="line"></div>
            <h1> Produk Lainnya </h1>
            <div class="line"></div>
        </div>

        <div id="allProductContainer">

            <div class="productCard" onclick="window.location.href = 'item.php'">
                <div class="aProductImage">
                    <img src="../../Asset/Products/mangga.jpg" alt="">
                </div>
                <div class="aProductTitle">
                    <h1> Keripik Mangga </h1>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                    <p class="aPrice"> Rp 50.000 </p>
                </div>
            </div>

            <div class="productCard" onclick="window.location.href = 'item.php'">
                <div class="aProductImage">
                    <img src="../../Asset/Products/nangka.jpg" alt="">
                </div>
                <div class="aProductTitle">
                    <h1> Keripik Nangka </h1>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                    <p class="aPrice"> Rp 50.000 </p>
                </div>
            </div>

            <div class="productCard" onclick="window.location.href = 'item.php'">
                <div class="aProductImage">
                    <img src="../../Asset/Products/sayur.jpg" alt="">
                </div>
                <div class="aProductTitle">
                    <h1> Keripik Sayur Mix</h1>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                    <p class="aPrice"> Rp 50.000 </p>
                </div>
            </div>

            <div class="productCard" onclick="window.location.href = 'item.php'">
                <div class="aProductImage">
                    <img src="../../Asset/Products/Melinjo.jpg" alt="">
                </div>
                <div class="aProductTitle">
                    <h1> Keripik Melinjo </h1>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                    <p class="aPrice"> Rp 50.000 </p>
                </div>
            </div>

        </div>

    </div>

    <?php
    include_once '../../Footer/footerPage.php';
    ?>

</body>

</html>