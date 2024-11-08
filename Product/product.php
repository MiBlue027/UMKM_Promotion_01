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

    <link rel="stylesheet" href="productStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Produk Kami </title>
</head>
<body>
    <?php
        include_once '../HeaderPackage/headerPage.php';
        include_once '../HeaderPackage/navigationPage.php';
    ?>
    <header>

    </header>
    <div id="wrapper">
        <div id="container">
            <div id="navProduct">
                <button id="vegetableChips"> Keripik Sayur </button>
                <button id="fruitChips"> Keripik Buah </button>
            </div>

            <div id="bestSeller">
                <div id="bestSellerTitle">
                    <h1> Produk Best Seller </h1>
                    <p> Enak tiada duanya </p>
                </div>
                <div class="bestSellerProduct">
                    <div class="productImage"></div>
                    <div class="productInformation">
                        <div class="productTitle">
                            <h1> Produk 1 </h1>
                            <p class="productDescription"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. At dolore doloremque ex facilis ipsum odit quis quisquam repellat, suscipit voluptates.</p>
                            <p class="priceInformation"> Rp 30.000 </p>
                        </div>
                        <div class="productPagination">
                            <button> <ion-icon name="arrow-back-outline"></ion-icon> </button>
                            <button> Beli </button>
                            <button> <ion-icon name="arrow-forward-outline"></ion-icon> </button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="allProduct">

                <div id="allProductTitle">
                    <h1> Semua Produk </h1>
                    <p> Silahkan cari produk yang anda suka </p>
                </div>

                <div id="allProductContainer">

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                           <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                            <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                            <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                            <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                            <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                            <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>

                    <div class="productCard">
                        <div class="aProductImage"></div>
                        <div class="aProductTitle">
                            <h1> Produk </h1>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing. </p>
                            <p class="aPrice"> Rp 50.000 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include_once '../Footer/footerPage.php';
    ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script></body>
</html>