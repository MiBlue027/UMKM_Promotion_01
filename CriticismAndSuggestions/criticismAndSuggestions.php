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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="criticismAndSuggestionsStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">
    <link rel="stylesheet" href="../Footer/footerPageStyle.css">

    <title> Kritik dan Saran </title>
</head>
<body>

<?php
include_once '../HeaderPackage/headerPage.php';
include_once '../HeaderPackage/navigationPage.php';
?>

<!--    INFORMATION ACTION ---------------------------------------------------------------------------->
<?php
require_once '../informationAction.php';
if (!empty($_GET['success'])) {
    if ($_GET['success'] === '1') {
        ?>
        <script> showIA("Berhasil", "Terima kasih atas kritik dan sarannya") </script>
        <?php
    }
}
?>

<!--    Main Content --------------------------------------------------------------------------------------->
<div class="wrapper">
    <div id="formContainer">
        <div id="formTitle">
            <h1> Kritik dan Saran </h1>
            <p> Silahkan masukan kritik dan saran anda </p>
        </div>
        <form action="criticismAndSuggestionHandler.php" method="POST" id="formInput">
            <table>
                <tr>
                    <td>
                        <div class="inputBox">
                            <input type="text" id="nameInput" name="nameInput" required>
                            <label for="nameInput"> Nama </label>
                        </div>
                    </td>
                    <td>
                        <div class="inputBox">
                            <input type="text" id="gmailInput" name="gmailInput" required
                                   pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                   title="Masukkan alamat Gmail yang valid, misalnya user@gmail.com">
                            <label for="gmailInput"> Gmail </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="messageTAInputBox">
                            <textarea name="messageTA" id="messageTA" cols="30" rows="10" required></textarea>
                            <label for="messageTA"> Kritik dan Saran </label>
                        </div>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Kirim" id="formSubmit">
        </form>
    </div>
</div>

<?php
include "../Footer/footerPage.php";
?>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!-- Validasi JavaScript -->
<script>
    const form = document.getElementById('formInput');
    const gmailInput = document.getElementById('gmailInput');

    form.addEventListener('submit', function (event) {
        const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

        if (!gmailRegex.test(gmailInput.value)) {
            event.preventDefault(); // Mencegah form dikirim
            alert("Masukkan alamat Gmail yang valid, misalnya user@gmail.com");
        }
    });
</script>
</body>
</html>
