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

    <link rel="stylesheet" href="loginPageStyle.css">
    <link rel="stylesheet" href="../HeaderPackage/headerStyle.css">

    <title> Login </title>
</head>
<body>
<div id="wrapper">
<!--        Login -------------------------------------------------------------------------->
        <div id="loginContainer">
            <span class="backIcon" onclick="goToLandingPage()"> <ion-icon name="chevron-back-circle-outline"></ion-icon> </span>
            <div class="formTitle">
                <h1> Masuk </h1>
                <p> Selamat datang kembali! </p>
            </div>
            <form action="" class="formContainer">
                <div class="inputBox">
                    <input type="text" name="loginUsername" id="loginUsername" required>
                    <label for="loginUsername"> Nama Pengguna </label>
                    <span class="inputIcon"> <ion-icon name="person-circle-outline"></ion-icon> </span>
                </div>
                <div class="inputBox">
                    <input type="password" name="loginPassword" id="loginPassword" required>
                    <label for="loginPassword"> password </label>
                    <span class="inputIcon"> <ion-icon name="lock-closed-outline"></ion-icon> </span>
                </div>
                <input type="submit" id="loginSubmit" class="submitBTN" value="Masuk">
            </form>
            <p class="loginOrRegister"> Belum memiliki akun? <span> <a href="#" onclick="openRegisterForm()"> Daftar </a> </span> </p>
        </div>

<!--        Register ----------------------------------------------------------------------------->

        <div id="registerContainer">
            <span class="backIcon" onclick="goToLandingPage()"> <ion-icon name="chevron-back-circle-outline"></ion-icon> </span>
            <div class="formTitle">
                <h1> Daftar </h1>
                <p> Halo! Selamat datang! </p>
            </div>
            <form action="" class="formContainer">
                <div class="inputBox">
                    <input type="text" name="registerUsername" id="registerUsername" required>
                    <label for="registerUsername"> Nama Pengguna </label>
                    <span class="inputIcon"> <ion-icon name="person-circle-outline"></ion-icon> </span>
                </div>
                <div class="inputBox">
                    <input type="password" name="registerPassword" id="registerPassword" required>
                    <label for="registerPassword"> password </label>
                    <span class="inputIcon"> <ion-icon name="lock-closed-outline"></ion-icon> </span>
                </div>
                <div class="inputBox">
                    <input type="text" name="registerGmail" id="registerGmail" required>
                    <label for="registerGmail"> Gmail </label>
                    <span class="inputIcon"> <ion-icon name="mail-outline"></ion-icon> </span>
                </div>
                <input type="submit" id="registerSubmit" class="submitBTN" value="Daftar">
            </form>
            <p class="loginOrRegister"> Sudah memiliki akun? <span> <a href="#" onclick="openLoginForm()"> Masuk </a> </span> </p>
        </div>

    </div>

<!--    Register Or Login Link -------------------------------------------------------->
    <script>
        const registerForm = document.getElementById('registerContainer');
        const  loginForm = document.getElementById('loginContainer');
        function openRegisterForm() {
            loginForm.style.opacity = '0';
            setTimeout(function (){
                loginForm.style.display = 'none';
                registerForm.style.display = 'flex';
                setTimeout(function (){
                    registerForm.style.opacity = '80%';
                }, 200);
            },300);

        }

        function openLoginForm(){
            registerForm.style.opacity = '0';
            setTimeout(function (){
                registerForm.style.display = 'none';
                loginForm.style.display = 'flex';
                setTimeout(function (){
                    loginForm.style.opacity = '80%';
                }, 200);
            },300);
        }
    </script>

<!--    Back to LandingPage Script ---------------------------------------------------->
    <script>
        function goToLandingPage(){
            window.location.href = "../index.php";
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>