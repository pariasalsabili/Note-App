<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';
require_once '../functions/check-login.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'];

    $sql = "INSERT INTO note_user (user_id, title, body, created_at, updated_at) VALUES (?, '', '', NOW(), NOW())";
    $statement = $pdo->prepare($sql);
    $statement->execute([$user_id]);

    echo $pdo->lastInsertId();
}

