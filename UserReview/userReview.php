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
    <title> Review </title>

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="userReviewStyle.css">
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
if (empty($_POST['transactionID'])) {
    header('location: ../TransactionHistory/transactionHistory.php');
    exit();
}
include_once '../HeaderPackage/navigationPage.php';
?>

<div class="wrapper">
    <div class="productInformationContainer">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!empty($_POST['transactionID'])){
                    $connection = getConnection();

                    $sql = 'SELECT p.product_image, p.product_name, p.price, p.product_description, t.transaction_date FROM transaction t
                    JOIN transaction_details td ON td.transaction_id = t.id
                    JOIN users u ON u.id = t.id_user
                    JOIN product p ON p.id = td.product_id 
                    WHERE u.username = :username AND t.id = :transactionID';
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(':username', $_SESSION['username']);
                    $statement->bindValue(':transactionID', $_POST['transactionID']);
                    $statement->execute();
                    $data = $statement->fetch(PDO::FETCH_ASSOC);

        ?>
                    <span class="backIcon" onclick="window.location.href = '../TransactionHistory/transactionHistory.php'"> <ion-icon name="arrow-back-circle-outline"></ion-icon> </span>
                    <h1> <?php echo $data['product_name'] ?> </h1>
                    <img src="<?php echo $data['product_image'] ?>" alt="product image">
                    <p class="productDescription"> <?php echo $data['product_description'] ?> </p>
                    <p class="price"> Rp <?php echo $data['price'] ?> </p>
                    <p class="transactionDate"> tanggal pembelian: <?php echo substr($data['transaction_date'],0, 19) ?> </p>

        <?php
                    $connection = null;
                }
            }
        ?>
    </div>
    
    <div id="reviewForm">
        <form action="userReviewSubmit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="transactionIDHidden" id="transactionIDHidden" value="<?php echo $_POST['transactionID'] ?>">
            <input type="hidden" name="transactionDetailIDHidden" id="transactionDetailIDHidden" value="<?php echo $_POST['transactionDetailID'] ?>">
            <div class="ratingContainer">
                <h1> Rating </h1>
                <div class="ratingBox">
                    <span onclick="setRating(1)" id="star1"><ion-icon name="star-outline"></ion-icon></span>
                    <span onclick="setRating(2)" id="star2"><ion-icon name="star-outline"></ion-icon></span>
                    <span onclick="setRating(3)" id="star3"><ion-icon name="star-outline"></ion-icon></span>
                    <span onclick="setRating(4)" id="star4"><ion-icon name="star-outline"></ion-icon></span>
                    <span onclick="setRating(5)" id="star5"><ion-icon name="star-outline"></ion-icon></span>
                </div>
            </div>

                <script>
                    function setRating(rating) {
                        for (let i = 1; i <= 5; i++) {
                            const star = document.getElementById(`star${i}`);
                            const iconName = i <= rating ? 'star' : 'star-outline';
                            star.innerHTML = `<ion-icon name="${iconName}"></ion-icon>`;
                        }
                        let ratingInput = document.getElementById('rating');
                        ratingInput.value = rating;
                        ratingInput.dispatchEvent(new Event('change'));
                    }
                </script>


                <input type="hidden" name="rating" id="rating" value="0" required>
            <div class="inputBox">
                <label for="reviewTA"> Review anda </label>
                <textarea id="reviewTA" name="reviewTA" rows="5" cols="30" placeholder="Tulis review anda di sini..."></textarea>
            </div>

            <div class="imageInputContainer">
                <h1> Ingin menambahkan foto? </h1>
                <div class="imageReviewContainer">
                    <!-- Image 1 -->
                    <div class="image1Container">
                        <label for="imageInput1">Foto 1:</label>
                        <input type="file" name="imageInput1" id="imageInput1" accept="image/jpeg, image/png">
                        <img id="preview1" src="" alt="Image Preview" style="display:none;">
                        <div class="buttons" id="buttons1" style="display:none;">
                            <button type="button" onclick="cancelImage('imageInput1', 'preview1', 'buttons1')">Cancel</button>
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="image2Container">
                        <label for="imageInput2">Foto 2:</label>
                        <input type="file" name="imageInput2" id="imageInput2" accept="image/jpeg, image/png">
                        <img id="preview2" src="" alt="Image Preview" style="display:none;">
                        <div class="buttons" id="buttons2" style="display:none;">
                            <button type="button" onclick="cancelImage('imageInput2', 'preview2', 'buttons2')">Cancel</button>
                        </div>
                    </div>

                    <script>
                        function handleImageInput(inputId, previewId, buttonsId) {
                            const imageInput = document.getElementById(inputId);
                            const preview = document.getElementById(previewId);
                            const buttons = document.getElementById(buttonsId);

                            imageInput.addEventListener('change', function(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block';
                                        buttons.style.display = 'block';
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    preview.style.display = 'none';
                                    preview.src = '';
                                    buttons.style.display = 'none';
                                }
                            });
                        }

                        function cancelImage(inputId, previewId, buttonsId) {
                            const imageInput = document.getElementById(inputId);
                            const preview = document.getElementById(previewId);
                            const buttons = document.getElementById(buttonsId);

                            imageInput.value = '';
                            preview.style.display = 'none';
                            preview.src = '';
                            buttons.style.display = 'none';
                        }

                        handleImageInput('imageInput1', 'preview1', 'buttons1');
                        handleImageInput('imageInput2', 'preview2', 'buttons2');
                    </script>
                </div>
            </div>

            <div class="saveBTN">
                <script>
                    const ratingCheck = document.getElementById('rating');
                    const submitFormBTN = document.getElementById('submitFormBTN');
                    let ratingValue = parseInt(ratingCheck.value, 10);
                    console.log('run')

                    ratingCheck.addEventListener('change', function (){
                        const ratingValue = parseInt(ratingCheck.value, 10);
                        console.log(ratingValue)
                        if (ratingValue > 0 && ratingValue <= 5) {
                            const subBTN = document.getElementById('submitFormBTN')
                            subBTN.style.pointerEvents = 'all';
                            subBTN.classList.remove('submitFormBTNDisable')
                            subBTN.classList.add('submitFormBTNDActive')
                        }
                        else document.getElementById('submitFormBTN').style.pointerEvents = 'none';
                    })
                </script>

                <input type="submit" value="Simpan" id="submitFormBTN" class="submitFormBTNDisable"">
            </div>

        </form>
    </div>
    
</div>


<?php
include_once '../Footer/footerPage.php';
?>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
