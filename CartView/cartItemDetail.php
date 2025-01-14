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
    <title> Item Detail </title>

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="cartItemDetailStyle.css">
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

    <div id="container">
        <div id="mainInformation">
            <?php
            $connection = getConnection();

            $sql = 'SELECT u.id AS "userID", ct.id AS "cartID", p.id AS "productID", p.product_image, p.product_name, p.product_description, p.price, pd.stock, ct.quantity FROM cart_temp ct
                    JOIN users u ON ct.user_id = u.id
                    JOIN product p ON ct.product_id = p.id
                    JOIN product_details pd ON p.id = pd.product_id
                    WHERE ct.id = :cartID AND u.username = :username';
            $statement = $connection->prepare($sql);
            $statement->bindParam(':cartID', $_GET['cartID']);
            $statement->bindParam(':username', $_SESSION['username']);
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
                <input type="hidden" id="stockQuantityHidden" value="<?php echo $data['stock'] + $data['quantity'] ?>">
                <p id="productDescription">
                    <?php echo $data['product_description'] ?>
                </p>
                <p id="price"> Rp<?php echo $data['price'] ?> </p>
                <div id="action">
                    <div id="quantity">
                        <button id="minQuantityBTN"> - </button>
                        <label for="buyQuantityIPT">
                            <input type="number" id="buyQuantityIPT" min="1" value="<?php echo $data['quantity']?>" required>
                        </label>
                        <button id="plusQuantityBTN"> + </button>
                    </div>

                    <button id="addToCartBTN"
                        <?php if ($data['stock'] <= 0) { ?> disabled style="background-color: #6c8294; pointer-events: none" <?php } ?>
                            onclick="updateCart()"> Update Keranjang </button>
                    <!--Update cart Script ------------------------------------------>
                    <script>
                        function updateCart(){
                            let quantity = document.getElementById('buyQuantityIPT').value;
                            window.location.href = 'cartUpdate.php?userID=<?php echo $data["userID"] ?>&productID=<?php echo $data["productID"] ?>&cartID=<?php echo $data["cartID"] ?>&oldQuantity=<?php echo $data["quantity"] ?>&quantity='+quantity;
                        }
                    </script>

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
        </div>
    </div>

<?php
include_once '../Footer/footerPage.php';
?>

</body>
</html>
