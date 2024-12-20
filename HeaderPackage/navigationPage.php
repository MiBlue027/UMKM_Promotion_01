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

    <link rel="stylesheet" href="headerStyle.css">

    <title>Navigation</title>
</head>
<body>
    <div id="navContainer">
        <div id="userInformation">
            <div id="userProfile" onclick="window.location.href = '/UMKM_Promotion_01/Profile/profile.php'"></div>
            <div id="userLoginLogout">
                <h1>
                    <?php
                        if (!empty($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        }
                    ?>
                </h1>
                <a href="/UMKM_Promotion_01/LoginPage/loginPage.php"> Login </a>
            </div>
        </div>
        <nav>
            <a href="/UMKM_Promotion_01/index.php" class="navA"> Beranda </a>
            <a href="/UMKM_Promotion_01/AboutUs/aboutUs.php" class="navA"> Tentang Kami </a>
            <a href="/UMKM_Promotion_01/Product/product.php" class="navA"> Produk </a>
            <a href="/UMKM_Promotion_01/Toko/toko.php" class="navA"> Toko </a>
            <a href="/UMKM_Promotion_01/Gallery/gallery.php" class="navA"> Galeri </a>
            <a href="/UMKM_Promotion_01/FAQ/faq.php" class="navA"> FAQ </a>
        </nav>
        <div id="addToCart">
            <a href="/UMKM_Promotion_01/CartView/cart.php"> Keranjang <span> <i class='bx bx-cart'></i> </span> </a>
        </div>
    </div>
</body>
</html>