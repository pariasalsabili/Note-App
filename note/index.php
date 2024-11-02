<?php
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';
require_once '../functions/check-login.php';


if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}


$user_name = $_SESSION['user'];
$user_email = $_SESSION['email'];
$user_id = $_SESSION['id'];
$user_phone = $_SESSION['phone'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    
    $sql = "UPDATE users SET username = ?, email = ?, phone = ? WHERE id = ?";
    $statement = $pdo->prepare($sql);

    if ($statement->execute([$username, $email, $phone, $user_id])) {
       
        $_SESSION['user'] = $username;
        $_SESSION['email'] = $email;
        
       
        header('Location: index.php?success=1');
        exit;
    } else {
        echo 'Failed to execute query: ' . implode(", ", $statement->errorInfo());
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="notes" id="app">
        <div class="notes__sidebar">
            <div class="notes__profile">
                <img src="user.jpg" alt="Profile Picture" class="notes__profile-picture">
                <div class="notes__profile-info">
                    <h3><?= htmlspecialchars($user_name) ?></h3>
                    <p><?= htmlspecialchars($user_email) ?></p>
                    <?php
                        if (isset($_SESSION['user'])) { ?>
                            <button class="notes__logout" id="logoutBtn"><a href="<?= url('auth/logout.php') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></button>
                    <?php } ?>
                    
                </div>
            </div>
            <button class="notes__add" id="addNoteBtn">Add A New Note</button>
            <div id="notesList" class="notes__list"></div>

            
        </div>
        <div class="notes__preview">
            <input class="notes__title" id="noteTitle" type="text" placeholder="Note Title...">
            <textarea class="notes__body" id="noteBody" placeholder="Note Body..."></textarea>
            <button class="notes__delete" id="saveNoteBtn" style="display:none;">Save Note</button>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>