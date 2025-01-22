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

    <link rel="stylesheet" href="productStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Produk Kami </title>
</head>

<body>
    <?php
    include_once '../HeaderPackage/headerPage.php';
    if (empty($_SESSION['variant'])) $_SESSION['variant'] = "sayur";
    else $_SESSION['variant'] = $_GET['variant'];
    $_GET['variant'] = $_SESSION['variant'];
    include_once '../HeaderPackage/navigationPage.php';
    ?>
    <div id="wrapper">
        <div id="container">
            <div id="navProduct">
                <button class="navProductBTN" id="vegetableChips" onclick="window.location.href = 'product.php?variant=sayur'" data-index="0"> Keripik Sayur  </button>
                <button class="navProductBTN" id="fruitChips" onclick="window.location.href = 'product.php?variant=buah'" data-index="1"> Keripik Buah   </button>
            </div>

            <div id="bestSeller">
                <div id="bestSellerTitle">
                    <h1> Produk Best Seller </h1>
                    <p> <?php echo "Keripik ". $_GET['variant'] ?> </p>
                </div>
                <div class="bestSellerProduct">

                    <?php
                        $connection = getConnection();

                        $sql = 'SELECT p.id, p.product_image, p.product_name, p.product_description, p.price FROM product p
                                JOIN product_details pd ON p.id = pd.product_id
                                WHERE p.variant = :variant AND p.best_seller = 1 AND pd.stock > 0;';
                        $statement = $connection->prepare($sql);
                        $statement->bindValue(':variant', $_GET['variant']);
                        $statement->execute();

                        $dataIndex = 0;
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                                <div class="bestProductContainer" data-index="<?php echo $dataIndex++ ?>">
                                    <input type="hidden" id="productID" class="productID" value="<?php echo $row['id'] ?>">
                                    <div class="productImage">
                                        <img src="<?php echo $row['product_image'] ?>" alt="">
                                    </div>
                                    <div class="productInformation">
                                        <div class="productTitle">
                                            <h1> <?php echo $row['product_name'] ?> </h1>
                                            <p class="productDescription">  <?php echo $row['product_description'] ?> </p>
                                            <p class="priceInformation"> Rp  <?php echo $row['price'] ?> </p>
                                        </div>
                                    </div>
                                </div>
                    <?php
                        }

                    $sql = 'SELECT p.id, p.product_image, p.product_name, p.product_description, p.price FROM product p
                            JOIN product_details pd ON p.id = pd.product_id
                            WHERE p.variant = :variant AND p.best_seller = 1 AND pd.stock = 0;';
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(':variant', $_GET['variant']);
                    $statement->execute();

                    $dataIndex = 0;
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="bestProductContainer" data-index="<?php echo $dataIndex++ ?>">
                            <input type="hidden" id="productID" class="productID" value="<?php echo $row['id'] ?>">
                            <div class="productImage">
                                <img src="<?php echo $row['product_image'] ?>" alt="">
                            </div>
                            <div class="productInformation">
                                <div class="productTitle">
                                    <h1> <?php echo $row['product_name'] ?> </h1>
                                    <p class="productDescription">  <?php echo $row['product_description'] ?> </p>
                                    <p class="priceInformation"> Rp  <?php echo $row['price'] ?> </p>
                                    <p class="outOfStock"> Stok Habis </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }


                        $statement = null;
                        $connection = null;
                    ?>
                    <script>
                        let productID
                        function setProductID(){
                            let productID_Container = document.getElementsByClassName('active');
                            let productID = productID_Container.getElementById('productID');
                        }
                    </script>
                    <div class="productPagination">
                        <button id="prevButton" onclick="setProductID()"> <ion-icon name="arrow-back-outline"></ion-icon> </button>
                        <button onclick="window.location.href = 'Items/item.php?productID=' + productID.value"> Beli </button>
                        <button id="nextButton" onclick="setProductID()"> <ion-icon name="arrow-forward-outline"></ion-icon> </button>
                    </div>
                </div>
            </div>

<!--            Best Product Slider ----------------------------------------------------->
            <script>
                const products = document.querySelectorAll(".bestProductContainer");
                let currentIndex = 0;

                // Tombol navigasi
                const prevButton = document.getElementById("prevButton");
                const nextButton = document.getElementById("nextButton");

                // Fungsi untuk memperbarui produk yang terlihat
                function updateSlider(index) {
                    products.forEach((product, i) => {
                        if (i === index) {
                            product.classList.add("active"); // Menampilkan produk yang sesuai
                        } else {
                            product.classList.remove("active"); // Menyembunyikan produk lainnya
                        }
                    });
                }

                // Fungsi untuk mendapatkan product ID dari produk yang aktif
                function getActiveProductID() {
                    const activeProduct = document.querySelector(".bestProductContainer.active"); // Ambil produk dengan class 'active'
                    if (activeProduct) {
                        const productIDInput = activeProduct.querySelector(".productID"); // Ambil elemen input dengan class 'productID'
                        return productIDInput ? productIDInput.value : null;
                    }
                    return null;
                }

                // Event listener untuk tombol prev
                prevButton.addEventListener("click", () => {
                    currentIndex = (currentIndex - 1 + products.length) % products.length; // Loop ke akhir jika negatif
                    updateSlider(currentIndex);
                });

                // Event listener untuk tombol next
                nextButton.addEventListener("click", () => {
                    currentIndex = (currentIndex + 1) % products.length; // Loop kembali ke awal jika lebih dari panjang array
                    updateSlider(currentIndex);
                });

                // Event listener untuk tombol "Beli"
                document.querySelector(".productPagination button:nth-child(2)").addEventListener("click", () => {
                    const productID = getActiveProductID(); // Ambil ID produk yang aktif
                    if (productID) {
                        window.location.href = 'item.php?productID=' + productID; // Navigasi ke halaman pembelian
                    } else {
                        alert("Produk tidak ditemukan!");
                    }
                });

                // Inisialisasi produk pertama
                updateSlider(currentIndex);
            </script>




            <div id="allProduct">

                <div id="allProductTitle">
                    <h1> Semua Produk </h1>
                    <p> Silahkan cari produk yang anda suka </p>
                </div>

                <div id="allProductContainer">

                    <?php
                        $connection = getConnection();

                        $sql = 'SELECT p.id, p.product_image, p.product_name, p.product_description, p.price FROM product p
                                JOIN product_details pd ON p.id = pd.product_id
                                WHERE p.variant = :variant AND pd.stock > 0;';
                        $statement = $connection->prepare($sql);
                        $statement->bindValue(':variant', $_GET['variant']);
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
                                </div>
                            </div>

                    <?php
                        }

                    $sql = 'SELECT p.id, p.product_image, p.product_name, p.product_description, p.price FROM product p
                            JOIN product_details pd ON p.id = pd.product_id
                            WHERE p.variant = :variant AND pd.stock = 0;';
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(':variant', $_GET['variant']);
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