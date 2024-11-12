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
        include_once '../HeaderPackage/navigationPage.php';
    ?>

    <header id="profileHeader">

    </header>
    <div id="profilePicture"></div>
    <div id="wrapper">
        <div id="profileInformationContainer">
            <form action="">
                <table> 
                    <tr>
                        <td> <label for="UID"> User ID </label>  </td>
                        <td> : </td>
                        <td> <input type="number" id="UID" value="20241108001" required readonly>  </td>
                    </tr>
                    <tr>
                        <td> <label for="username"> Nama </label> </td>
                        <td> : </td>
                        <td> <input type="text" id="username" value="No Name Guest" required readonly> </td>
                    </tr>
                    <tr>
                        <td> <label for="gmail"> Gmail </label> </td>
                        <td> : </td>
                        <td> <input type="text" id="gmail" value="user001@gmail.com" required readonly> </td>
                    </tr>
                    <tr>
                        <td> <label for="address"> Alamat </label> </td>
                        <td> : </td>
                        <td> <input type="text" id="address" value="Jl. Bunga Bakung" required> </td>
                    </tr>
                    <tr>
                        <td> <label for="phoneNumber"> No. Telefon </label> </td>
                        <td> : </td>
                        <td> <input type="number" id="phoneNumber" value="082773212938" required> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td id="saveBTN"> <input type="submit" value="Simpan"> </td>
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