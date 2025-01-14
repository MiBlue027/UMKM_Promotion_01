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

    <link rel="stylesheet" href="itemStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Item </title>
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

    <div id="container">
        <div id="mainInformation">
            <?php
            $connection = getConnection();

            $sql = 'SELECT * FROM product p
                    JOIN product_details pd ON p.id = pd.product_id
                    WHERE p.id = :productID';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':productID', $_GET['productID']);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);

            ?>

            <div id="itemImage">
                <img src="<?php echo $data['product_image'] ?>" alt="Product Image">
            </div>
            <div id="itemInformation">
                <h1> <?php echo $data['product_name'] ?> <span id="productStock"> Stock <?php
                        if ($data['stock'] > 0) echo ": " . $data['stock'];
                        else echo "habis";
                        ?> </span>
                </h1>
                <input type="hidden" id="stockQuantityHidden" value="<?php echo $data['stock'] ?>">
                <p id="productDescription">
                    <?php echo $data['product_description'] ?>
                </p>
                <p id="price"> Rp<?php echo $data['price'] ?> </p>
                <div id="action">
                    <div id="quantity">
                        <button id="minQuantityBTN"> - </button>
                        <label for="buyQuantityIPT">
                            <input type="number" id="buyQuantityIPT" min="1" value="<?php echo $data['stock'] > 0 ? 1 : 0 ?>" required>
                        </label>
                        <button id="plusQuantityBTN"> + </button>
                    </div>

                    <button id="addToCartBTN"
                        <?php if ($data['stock'] <= 0) { ?> disabled style="background-color: #6c8294; pointer-events: none" <?php } ?>
                    onclick="addToCartScript()"> Masukan Keranjang </button>
<!--Add to cart Script ------------------------------------------>
                    <script>
                        function addToCartScript(){
                            let quantity = document.getElementById('buyQuantityIPT').value;
                            window.location.href = 'addToCartTempDB.php?username=<?php echo $_SESSION["username"] ?>&productID=<?php echo $_GET['productID'] ?>&quantity='+quantity;
                        }
                    </script>

                </div>
            </div>


<!--            Plus Min Buy Quantity Handler --------------------------------------------------------->
            <script>
                const buyQuantityIPT = document.getElementById('buyQuantityIPT');
                const minQuantityBTN = document.getElementById('minQuantityBTN');
                const plusQuantityBTN = document.getElementById('plusQuantityBTN');
                const stockQuantityHidden = document.getElementById('stockQuantityHidden');

                // Min Button ---------------------
                minQuantityBTN.addEventListener('click', function () {
                    const currentValue = parseInt(buyQuantityIPT.value, 10);
                    const minValue = parseInt(buyQuantityIPT.min, 10) || 1;
                    if (currentValue > minValue) {
                        buyQuantityIPT.value = currentValue - 1;
                    }
                });

                // Plus Button ---------------------------------
                plusQuantityBTN.addEventListener('click', function () {
                    const currentValue = parseInt(buyQuantityIPT.value, 10);
                    buyQuantityIPT.value = (currentValue + 1 <= stockQuantityHidden.value) ? currentValue + 1 : currentValue;
                });

                buyQuantityIPT.addEventListener('change', function (){
                    if (parseInt(stockQuantityHidden.value) <= 0) {
                        buyQuantityIPT.value = 0;
                    }
                    else if (parseInt(buyQuantityIPT.value) <= 0 ){
                        buyQuantityIPT.value = 1;
                    }

                    if (buyQuantityIPT.value > stockQuantityHidden.value) buyQuantityIPT.value = stockQuantityHidden.value;
                })
            </script>

        </div>
    </div>

    <div id="otherProductContainer">
        <div id="otherProductTitle">
            <div class="line"></div>
            <h1> Produk Lainnya </h1>
            <div class="line"></div>
        </div>

        <div id="allProductContainer">

            <?php

            $sql = 'SELECT p.id, p.product_image, p.product_name, p.product_description, p.price FROM product p
                                JOIN product_details pd ON p.id = pd.product_id
                                WHERE p.variant = :variant AND p.best_seller = 1 AND pd.stock > 0 AND p.id != :productID;';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':variant', $data['variant']);
            $statement->bindValue(':productID', $_GET['productID']);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="productCard" onclick="window.location.href = 'item.php?productID=' + <?php echo $row['id'] ?>">
                    <div class="aProductImage">
                        <img src="<?php echo $row['product_image'] ?>" alt="">
                    </div>
                    <div class="aProductTitle">
                        <h1> <?php echo $row['product_name'] ?> </h1>

                        <p class="aPrice"> Rp <?php echo $row['price'] ?> </p>
                    </div>
                </div>

                <?php
            }

            $sql = 'SELECT p.id, p.product_image, p.product_name, p.product_description, p.price FROM product p
                            JOIN product_details pd ON p.id = pd.product_id
                            WHERE p.variant = :variant AND p.best_seller = 1 AND pd.stock = 0 AND p.id != :productID;';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':variant', $data['variant']);
            $statement->bindValue(':productID', $_GET['productID']);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="productCard" onclick="window.location.href = 'item.php?productID=' + <?php echo $row['id'] ?>">
                    <div class="aProductImage">
                        <img src="<?php echo $row['product_image'] ?>" alt="">
                    </div>
                    <div class="aProductTitle">
                        <h1> <?php echo $row['product_name'] ?> </h1>
                        <!--                                    <p> --><?php //echo substr($row['product_description'], 0,80) . '...' ?><!-- </p>-->
                        <p class="aPrice"> Rp <?php echo $row['price'] ?> </p>
                        <p class="outOfStock"> Stok Habis </p>
                    </div>
                </div>

                <?php
            }

            $statement = null;
            $connection = null;
            ?>

        </div>

        <div id="backToProductContainer">
            <button id="backToProduct" onclick="window.location.href = 'product.php?variant=sayur'"> Lihat Produk Lainnya </button>
        </div>

    </div>

    <?php
    include_once '../Footer/footerPage.php';
    ?>

</body>

</html>