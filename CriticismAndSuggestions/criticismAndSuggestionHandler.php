<?php
require_once __DIR__ . '/../Database/getConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = getConnection();

    $sql = 'INSERT INTO criticism_suggestions (name, email, message) values (:name, :email, :message)';
    $statement = $connection->prepare($sql);
    $statement->bindValue(':name', $_POST["nameInput"]);
    $statement->bindValue(':email', $_POST["gmailInput"]);
    $statement->bindValue(':message', $_POST["messageTA"]);
    if ($statement->execute()){
        $statement = null;
        $connection = null;
        header('location: criticismAndSuggestions.php?success=1');
        exit();
    }

    $statement = null;
    $connection = null;
}