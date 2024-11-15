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
    <link rel="stylesheet" href="indexStyle.css">
    <link rel="stylesheet" href="HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="Footer/footerPageStyle.css">

    <title> Kriuk Berbuah </title>
</head>

<body>
    <?php
    include_once 'HeaderPackage/headerPage.php';
    include_once 'HeaderPackage/navigationPage.php';
    ?>


    <section id="landingPage">
        <div id="landingPageBG"></div>
        <div id="landingPageOverlay"></div>
        <main>
            <div id="mainContainer">
                <div id="mainLeft">
                    <div id="mainTitle">
                        <h1> Selamat Datang </h1>
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab asperiores delectus enim fugit iste itaque nobis non optio placeat, ratione. Dignissimos nulla optio quisquam sequi. </p>
                    </div>
                    <a href="Product/product.php" id="menuBTN"> Produk </a>
                </div>
                <!--                <div id="mainRight">-->
                <!--                    <div id="rightImage">-->
                <!--                        <img src="" alt="">-->
                <!--                    </div>-->
                <!--                </div>-->
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
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, perspiciatis </p>
        </div>
        <div id="bestProductContent">
            <div class="productContainer">
                <div class="productCard">
                    <img src="Asset/Products/pisang_durian.jpg" alt="">
                </div>
                <div class="productInformation">
                    <div class="productTitle">
                        <h1> Keripik Pisang Durian</h1>
                    </div>
                    <div class="productDescription">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti esse ipsum laboriosam nesciunt. Doloremque excepturi, fugiat laboriosam modi ratione saepe.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium amet consequuntur dignissimos distinctio harum id nisi quibusdam quisquam sapiente voluptatibus?
                        </p>
                    </div>
                    <div class="orderBTN">
                        <button> Pesan </button>
                    </div>
                </div>
            </div>
            <div class="productContainer">
                <div class="productInformation">
                    <div class="productTitle">
                        <h1> Keripik Mangga</h1>
                    </div>
                    <div class="productDescription">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti esse ipsum laboriosam nesciunt. Doloremque excepturi, fugiat laboriosam modi ratione saepe.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid culpa explicabo facere nesciunt, non porro?
                        </p>
                    </div>
                    <div class="orderBTN">
                        <button> Pesan </button>
                    </div>
                </div>
                <div class="productCard">
                    <img src="Asset/Products/mangga.jpg" alt="">
                </div>
            </div>
            <div class="productContainer">
                <div class="productCard">
                    <img src="Asset/Products/nangka.jpg" alt="">
                </div>
                <div class="productInformation">
                    <div class="productTitle">
                        <h1> Keripik Nangka</h1>
                    </div>
                    <div class="productDescription">
                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti esse ipsum laboriosam nesciunt. Doloremque excepturi, fugiat laboriosam modi ratione saepe.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae explicabo nostrum numquam pariatur qui reprehenderit. Architecto aspernatur consectetur illum impedit ipsa nobis provident quibusdam, rerum.
                        </p>
                    </div>
                    <div class="orderBTN">
                        <button> Pesan </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include_once 'Footer/footerPage.php';
    ?>
</body>

</html>