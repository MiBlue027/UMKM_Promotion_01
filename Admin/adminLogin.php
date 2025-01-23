<?php
//session_start();
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

    <link rel="stylesheet" href="adminLoginStyle.css">

    <title> Login </title>
</head>
<body>

<!--    INFORMATION ACTION ---------------------------------------------------------------------------->
<?php
require_once '../informationAction.php';
if (!empty($_GET['success'])) {
    if ($_GET['success'] === '02') {
        ?>
        <script> showIA("Gagal", "admin atau password salah!") </script>
        <?php
    }
}
?>

<!--    Main Content --------------------------------------------------------------------------------------->

<div id="wrapper">
    <!--        Login -------------------------------------------------------------------------->
    <div id="loginContainer">
        <div class="formTitle">
            <h1> Admin </h1>
            <p> Login akses terbatas! </p>
        </div>
        <form action="adminLoginHandler.php" method="POST" class="formContainer">
            <div class="inputBox">
                <input type="text" name="loginUsername" id="loginUsername" required>
                <label for="loginUsername"> admin </label>
                <span class="inputIcon"> <ion-icon name="person-circle-outline"></ion-icon> </span>
            </div>
            <div class="inputBox">
                <input type="password" name="loginPassword" id="loginPassword" required>
                <label for="loginPassword"> password </label>
                <span class="inputIcon"> <ion-icon name="lock-closed-outline"></ion-icon> </span>
            </div>
            <input type="submit" id="loginSubmit" class="submitBTN" value="Masuk">
        </form>
    </div>

</div>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>