<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
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

    <link rel="stylesheet" href="headerStyle.css">

    <title>Navigation</title>
</head>
<body>
    <div id="navContainer">
        <div id="userInformation">
            <div id="userProfile" style="background-image: url(<?php echo !empty($_SESSION['userAvatar']) ? $_SESSION['userAvatar'] : '../Asset/guestUser.png'; ?>)" onclick="window.location.href = '/UMKM_Promotion_01/Profile/profile.php'"></div>
            <div id="userLoginLogout">
                <h1>
                    <?php
                        if (!empty($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        } else echo "Pengunjung";
                    ?>
                </h1>
                <?php
                    if (!empty($_SESSION['username'])) {
                ?>
                <a href="/UMKM_Promotion_01/LoginPage/logoutHandler.php" style="color: #df3a3a"> Logout </a>
                <?php } else { ?>
                <a href="/UMKM_Promotion_01/LoginPage/loginPage.php" style="color: #4184d1"> Login </a>
                <?php } ?>
            </div>
        </div>
        <nav>
            <a href="/UMKM_Promotion_01/index.php" <?php if ($currentPage === 'beranda.php') echo "class='navAActive'"; else echo "class='navA'" ?> > Beranda </a>
            <a href="/UMKM_Promotion_01/AboutUs/aboutUs.php" <?php if ($currentPage === 'aboutUs.php') echo "class='navAActive'"; else echo "class='navA'" ?> > Tentang Kami </a>
            <a href="/UMKM_Promotion_01/Product/product.php?variant=<?php echo $_SESSION['variant'] ?? 'sayur';?>" <?php if ($currentPage === 'product.php') echo "class='navAActive'"; else echo "class='navA'" ?> > Produk </a>
            <a href="/UMKM_Promotion_01/Toko/toko.php" <?php if ($currentPage === 'toko.php') echo "class='navAActive'"; else echo "class='navA'" ?> > Toko </a>
            <a href="/UMKM_Promotion_01/Gallery/gallery.php" <?php if ($currentPage === 'gallery.php') echo "class='navAActive'"; else echo "class='navA'" ?> > Galeri </a>
            <a href="/UMKM_Promotion_01/FAQ/faq.php" <?php if ($currentPage === 'faq.php') echo "class='navAActive'"; else echo "class='navA'" ?> > FAQ </a>
        </nav>
        <div class="addToCartActive" <?php if ($currentPage === 'cart.php') echo "class='addToCartActive'"; else echo "id='addToCart'" ?> >
            <a href="/UMKM_Promotion_01/CartView/cart.php"> Keranjang <span> <i class='bx bx-cart'></i> </span> </a>
        </div>
    </div>
</body>
</html>