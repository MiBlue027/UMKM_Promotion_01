<?php
require_once __DIR__ . '/../Database/getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connection = getConnection();

    $sql = 'SELECT * FROM admin WHERE admin = :admin';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':admin', $_POST['loginUsername']);
    $statement->execute();
    if ($statement->rowCount() === 1) {
        $admin = $statement->fetch();
        if(password_verify($_POST['loginPassword'], $admin['password'])){
            session_start();
            $_SESSION['admin'] = $_POST['loginUsername'];
            header('Location: AdminDashboard/adminDashboard.php');
        } else{
            header('Location: adminLogin.php?success=02');
            exit();
        }
    } else{
        header('Location: adminLogin.php?success=02');
        exit();
    }

    $statement = null;
    $connection = null;
} else{
    header('Location: adminLogin.php');
    exit();
}
