<?php
require_once __DIR__ . '/../Database/getConnection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    Register Handler ---------------------------------------------------------------------------
    if (!empty($_POST['registerUsername']) || !empty($_POST['registerEmail']) || !empty($_POST['registerPassword'])) {
        $connection = getConnection();

        $sql = 'SELECT * FROM users WHERE username = :username OR email = :email';
        $statement = $connection->prepare($sql);
        $statement->bindValue(':username', $_POST['registerUsername']);
        $statement->bindValue(':email', $_POST['registerGmail']);
        $result = $statement->execute();

        if ($statement->rowCount() === 0) {
//            ID generator -------------------------------
            $date = date('Y-m-d');
            $formattedDate = str_replace("-", "", $date);

            $sql = 'SELECT * FROM users';
            $statement = $connection->prepare($sql);
            $statement->execute();
            $totalUser = $statement->rowCount();

            $userID = $formattedDate * 1000 + $totalUser + 1;

            $password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users (id, username, password, email) VALUES (:id, :username, :password, :email)';
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $userID);
            $statement->bindValue(':username', $_POST['registerUsername']);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $_POST['registerGmail']);
            $result = $statement->execute();

            if ($result){
                $_SESSION['username'] = $_POST['registerUsername'];
            }
        }

        $statement = null;
        $connection = null;
    }
//    Login Handler ------------------------------------------------------------------------
    else if(!empty($_POST['loginUsername']) || !empty($_POST['loginPassword'])) {
        $connection = getConnection();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $statement = $connection->prepare($sql);
        $statement->bindValue(':username', $_POST['loginUsername']);
        $statement->execute();
        if ($statement->rowCount() === 1) {
            $user = $statement->fetch();
            if(password_verify($_POST['loginPassword'], $user['password'])){
                $_SESSION['username'] = $_POST['loginUsername'];
            }
        }

        $statement = null;
        $connection = null;

    }
}

if(empty($_SESSION['username'])){
    header('Location: ../LoginPage/loginPage.php');
    exit();
} else {
    $username = $_SESSION['username'];
}

session_destroy();

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

    <link rel="stylesheet" href="profileStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Profile </title>
</head>
<body>

    <?php
        include_once '../HeaderPackage/headerPage.php';
        $_SESSION['username'] = $username;
        require_once '../HeaderPackage/navigationPage.php';

        $connection = getConnection();

        $sql = 'SELECT * FROM users WHERE username = :username';
        $statement = $connection->prepare($sql);
        $statement->bindValue(':username', $username);
        $result = $statement->execute();

        $userInfo = $statement->fetch();
        $userID = $userInfo['id'];
        $userName = $userInfo['username'];
        $userEmail = $userInfo['email'];
        $userAddress = $userInfo['address'];
        $userNumber = $userInfo['phone_number'];

        $statement = null;
        $connection = null;

    ?>

    <header id="profileHeader">
        <div id="headerImage"></div>
    </header>
    <div id="profilePicture"></div>
    <div id="wrapper">
        <div id="profileInformationContainer">
            <form action="profileInfoHandler.php" method="POST">
                <table> 
                    <tr>
                        <td> <label for="UID"> User ID </label>  </td>
                        <td> : </td>
                        <td> <input type="number" id="UID" value="<?php echo $userID ?>" required readonly>  </td>
                    </tr>
                    <tr>
                        <td> <label for="username"> Nama </label> </td>
                        <td> : </td>
                        <td> <input type="text" id="username" value="<?php echo $username ?>" required readonly> </td>
                    </tr>
                    <tr>
                        <td> <label for="gmail"> Gmail </label> </td>
                        <td> : </td>
                        <td> <input type="text" id="gmail" value="<?php echo $userEmail ?>" required readonly> </td>
                    </tr>
                    <tr>
                        <td> <label for="address"> Alamat </label> </td>
                        <td> : </td>
                        <td> <input type="text" id="address" name="address" value="<?php echo $userAddress ?>" required> </td>
                    </tr>
                    <tr>
                        <td> <label for="phoneNumber"> No. Telefon </label> </td>
                        <td> : </td>
                        <td> <input type="number" id="phoneNumber" name="phoneNumber" value="<?php echo $userNumber ?>" required> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td id="saveBTN"> <input type="submit" id="saveBTN-IN" value="Simpan"> </td>
                        <script>
                            const saveBTN = document.getElementById('saveBTN-IN');
                            const address = document.getElementById('address');
                            const number = document.getElementById('phoneNumber');
                            const originalAddress = address.value;
                            const originalNumber = number.value;

                            function checkChanges() {
                                if (address.value !== originalAddress || number.value !== originalNumber) {
                                    saveBTN.style.pointerEvents = 'all';
                                    saveBTN.style.cursor = 'pointer';
                                    saveBTN.style.backgroundColor = '#31e43f';
                                } else {
                                    saveBTN.style.pointerEvents = 'none';
                                    saveBTN.style.cursor = 'not-allowed';
                                    saveBTN.style.backgroundColor = '#949994';
                                }
                            }

                            address.addEventListener('input', checkChanges);
                            number.addEventListener('input', checkChanges);

                            saveBTN.style.pointerEvents = 'none';
                            saveBTN.style.cursor = 'not-allowed';
                        </script>

                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
        include_once '../Footer/footerPage.php';
    ?>
</body>
</html>