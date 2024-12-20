<?php
$host = "localhost";
$port = "3306";
$db_name = "umkm_promotion_01";
$db_user = "root";
$db_pass = "";

try {
    $connection = new PDO("mysql:host=$host:$port;dbname=$db_name", $db_user, $db_pass);
    if ($connection) echo "Connected successfully";


} catch (PDOException $e) {
    echo "Connection failed";
}