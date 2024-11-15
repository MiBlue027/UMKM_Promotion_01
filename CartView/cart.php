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
        include_once '../HeaderPackage/navigationPage.php';
    ?>
    <div id="wrapper">
        <div id="cartContainer">
            <div id="listBoxContainer">
                <div id="listBoxTitle">
                    <h1> Keranjang Pembelian </h1>
                    <p> <span> <b> 2 Barang </b> </span> dalam keranjang anda</p>
                </div>
                <div id="listBox">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2"> Produk </th>
                                <th> Harga </th>
                                <th> Jumlah </th>
                                <th> Total </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="productImage"></div>
                                </td>
                                <td>
                                    <div class="productInformation">
                                        <h1> Produk 1 </h1>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum iusto ullam velit. </p>
                                    </div>
                                </td>
                                <td>
                                    <p> Rp 40.000 </p>
                                </td>
                                <td>
                                    <div class="quantityTD">
                                        <button> - </button>
                                        2
                                        <button> + </button>
                                    </div>
                                </td>
                                <td>
                                    <p> Rp 80.000 </p>
                                </td>
                                <td>
                                    <div class="cancelIcon"> <ion-icon name="close-circle-outline"></ion-icon> </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="productImage"></div>
                                </td>
                                <td>
                                    <div class="productInformation">
                                        <h1> Produk 2 </h1>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum iusto ullam velit. </p>
                                    </div>
                                </td>
                                <td>
                                    <p> Rp 30.000 </p>
                                </td>
                                <td>
                                    <div class="quantityTD">
                                        <button> - </button>
                                        3
                                        <button> + </button>
                                    </div>
                                </td>
                                <td>
                                    <p> Rp 90.000 </p>
                                </td>
                                <td>
                                    <div class="cancelIcon"> <ion-icon name="close-circle-outline"></ion-icon> </div>
                                </td>
                            </tr>
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
                            <td class="totalCOL" > Subtotal </td>
                            <td class="doubleDot"> : </td>
                            <td class="priceCOL"> Rp 170.000 </td>
                        </tr>
                        <tr>
                            <td class="totalCOL"> Ongkir </td>
                            <td class="doubleDot"> : </td>
                            <td class="priceCOL"> Rp 50.000 </td>
                        </tr>
                        <tr>
                            <td class="totalCOL"> Total </td>
                            <td class="doubleDot"> : </td>
                            <td class="priceCOL"> Rp 230.000 </td>
                        </tr>
                    </table>
                    <button> Bayar </button>
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