<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';
require_once '../functions/check-login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $note_id = $data['id']; // Get note ID from the request

    if (!isset($_SESSION['id'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit;
    }

    try {
        // Prepare the SQL statement
        $sql = "DELETE FROM note_user WHERE id = ? AND user_id = ?";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([$note_id, $_SESSION['id']]);

        echo json_encode(['success' => $result]);
    } catch (PDOException $e) {
        // Return error message as JSON
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
