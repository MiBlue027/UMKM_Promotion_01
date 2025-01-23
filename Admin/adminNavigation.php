<?php
session_start();
if (empty($_SESSION['admin'])) {
    header('location: ../adminLogin.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> nav </title>

    <style>
        * {
            font-family: "Poppins", Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: fit-content;
            overflow-x: hidden;
            box-sizing: border-box;
        }

        .navHeader {
            width: 100%;
            height: 5em;
            background-color: #2f2f35;
        }

        .adminNavContainer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2em;
        }

        .adminNav {
            display: flex;
            justify-content: space-evenly;
            width: 75em;
        }

        .adminNav a {
            font-size: 1.2em;
            color: #ffffff;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .adminNav a:hover {
            text-shadow: 0 0 3px #ffffff;
        }

        #adminName {
            color: #ffffff;
        }

        #adminLogout {
            padding: .8em 1.5em;
            font-weight: 550;
            background-color: #da2424;
            border: none;
            border-radius: 10px;
            color: #ffffff;
            transition: .3s;
            cursor: pointer;
        }

        #adminLogout:hover {
            background-color: #da3f3f;
            box-shadow: 0 0 8px #da3f3f;
        }
    </style>
</head>

<body>
    <header class="navHeader">
        <div class="adminNavContainer">
            <h1 id="adminName"> <?php echo $_SESSION['admin'] ?> </h1>
            <nav class="adminNav">
                <a href="..\ManageProduk\dashboardProduk.php">Produk</a>
                <a href="..\ManageGallery\dashboardGallery.php">Galery</a>
                <a href="..\ManageTestimoni\dashboardTestimoni.php">Testimoni</a>
                <a href="..\ManageUsers\dashboardUsers.php">User </a>
                <a href="..\ManageKritikSaran\dashboardKritikSaran.php">Kritik Saran </a>
                <a href="..\ManageTransaksi\dashboardTransaction.php">Transaksi </a>
            </nav>
            <button id="adminLogout" onclick="window.location.href = '../adminLogoutHandler.php' "> Logout </button>
        </div>

    </header>
</body>

</html>