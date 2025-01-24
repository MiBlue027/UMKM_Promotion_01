<?php
function getConnection(): PDO
{
    $host = "localhost";
    $port = "3306";
    $db_name = "umkm_promotion_01";
    $db_user = "root";
    $db_pass = "";

    return new PDO("mysql:host=$host:$port;dbname=$db_name", $db_user, $db_pass);
}
