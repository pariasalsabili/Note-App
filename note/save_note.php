<?php

require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';
require_once '../functions/check-login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note_id = $_POST['id'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $user_id = $_SESSION['id'];

    $sql = "UPDATE note_user SET title = ?, body = ?, updated_at = NOW() WHERE id = ? AND user_id = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$title, $body, $note_id, $user_id]);

    echo "Note updated";
}
