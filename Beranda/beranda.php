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

    <!--    Icon Link ---------------------------------------------------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--    CSS -->
    <link rel="stylesheet" href="berandaStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Kriuk Berbuah </title>
</head>

<body>
<?php
include_once '../HeaderPackage/headerPage.php';
include_once '../HeaderPackage/navigationPage.php';
?>


<section id="landingPage">
    <div id="landingPageBG"></div>
    <div id="landingPageOverlay"></div>
    <main>
        <div id="mainContainer">
            <div id="mainLeft">
                <div id="mainTitle">
                    <h1> Selamat Datang </h1>
                    <p> Selamat datang di website Kriuk Berbuah! Nikmati perpaduan sempurna antara kerenyahan camilan kriuk dan kesegaran buah pilihan yang siap memanjakan lidah Anda. Temukan berbagai pilihan rasa favorit hanya di sini! </p>
                </div>
                <a href="../Product/product.php?variant=<?php echo (!empty($_SESSION['variant'])) ? $_SESSION['variant'] : 'sayur';  ?>" id="menuBTN"> Produk </a>
            </div>
        </div>
    </main>
</section>

<script>
    function goToSecondPage() {
        document.getElementById('bestProduct').scrollIntoView({
            behavior: "smooth"
        });
    }
</script>

<section id="bestProduct">
    <div id="bestProductTitle">
        <h1> Produk Baru Kami </h1>
        <p> Semua produk baru anda jumpai di sini </p>
    </div>
    <div id="bestProductContent">

        <table class="bestProductTable" >

            <?php
                $connection = getConnection();

                $sql = 'SELECT * FROM product WHERE new = 1';
                $statement = $connection->prepare($sql);
                $statement->execute();

                $counter = 1;
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if ($counter++ % 2 != 0) {
                        ?>

                        <tr>
                            <td>
                                <div class="productCard">
                                    <img src="<?php echo $row['product_image'] ?>" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="productInformation">
                                    <div class="productTitle">
                                        <h1> <?php echo $row['product_name'] ?> </h1>
                                    </div>
                                    <div class="productDescription">
                                        <p> <?php echo $row['product_description'] ?> </p>
                                    </div>
                                    <div class="orderBTN">
                                        <button onclick="window.location.href = '../Product/item.php?productID=<?php echo $row['id']; ?>'"> Pesan </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <?php
                    } else {
                        ?>
                            <tr>
                                <td>
                                    <div class="productInformationL">
                                        <div class="productTitle">
                                            <h1><?php echo $row['product_name'] ?> </h1>
                                        </div>
                                        <div class="productDescription">
                                            <p> <?php echo $row['product_description'] ?> </p>
                                        </div>
                                        <div class="orderBTN">
                                            <button onclick="window.location.href = '../Product/item.php?productID=<?php echo $row['id']; ?>'" > Pesan </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="productCardL">
                                        <img src="<?php echo $row['product_image'] ?>" alt="">
                                    </div>
                                </td>
                            </tr>
                        <?php
                    }
                }

                $statement = null;
                $connection = null;

            ?>

        </table>

    </div>
</section>

<?php
include_once '../Footer/footerPage.php';
?>
</body>

</html>