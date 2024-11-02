<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';
require_once '../functions/check-login.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM note_user WHERE user_id = ? ORDER BY updated_at DESC";
$statement = $pdo->prepare($sql);
$statement->execute([$user_id]);
$notes = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notes);
