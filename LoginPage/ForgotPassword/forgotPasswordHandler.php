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

    <link rel="stylesheet" href="forgotPasswordStyle.css">

    <title> Forgot Password </title>
</head>
<body>
<?php
require_once __DIR__ . '/../../Database/getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connection = getConnection();

    $sql = 'SELECT * FROM users WHERE email = :email';
    $statement = $connection->prepare($sql);
    $statement->bindParam(':email', $_POST['email']);
    $statement->execute();

    if ($statement->rowCount() !== 1) {
        header('Location: forgotPassword.php?success=00');
        exit();
    }

    $statement = null;
    $connection = null;
}

?>
<div id="wrapper">
    <div id="forgotPasswordContainer">
        <span class="backIcon" onclick="window.location.href = '../loginPage.php'"> <ion-icon name="chevron-back-circle-outline"></ion-icon> </span>
        <div id="formTitle">
            <h1> Reset Password </h1>
            <p> Masukan password baru anda </p>
        </div>
        <form action="resetPasswordHandler.php" method="POST" class="formContainer">
            <div class="inputBox">
                <input type="hidden" name="emailUser" value="<?php echo $_POST['email'] ?>">
                <input type="password" name="newPassword" id="registerGmail" required>
                <label for="registerGmail"> password </label>
                <span class="inputIcon"> <ion-icon name="lock-closed-outline"></ion-icon> </span>
            </div>
            <input type="submit" id="forgotPasswordBTN" value="Reset">
        </form>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
