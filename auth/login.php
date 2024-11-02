<?php
    session_start();
    require_once '../functions/helpers.php';
    require_once '../functions/pdo_connection.php';

    if(isset($_SESSION['user']))
    {
        unset($_SESSION['user']);
    }

    $error = '';
    $success = '';

    if(
        isset($_POST['username']) && $_POST['username'] !== '' 
        && isset($_POST['password']) && $_POST['password'] !== '' )
        {
            global $pdo;
            $query = 'SELECT * FROM noteapp.users WHERE username = ?';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['username']]);
            $user = $statement->fetch();
            if($user !== false)
            {
                if(password_verify($_POST['password'], $user->password))
                {
                    $_SESSION['user'] = $user->username;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['id'] = $user->id;
                    $_SESSION['phone'] = $user->phone;
                    header('Location: ../note');
                    exit;
                }
                else
                {
                    $error = 'Incorrect password';
                }
            }
            else
            {
                $error = 'The entered username is incorrect';
            }
        }
        else
        {
            if(!empty($_POST))
            $error = 'All fields are required';
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Program</title>
    <link rel="stylesheet" href="style.css">
    <script src="form.js"></script>
</head>
<body>


    <form id="loginform" method="post" >
        
        <h1>Login</h1>
        <section class="bg-light my-0 px-2">
            <small class="text-danger">
                <?php if($error !== '') echo $error; ?>
            </small>
        </section>
        <section class="bg-light my-0 px-2">
            <small class="text-success">
                <?php if($success !== '') echo $success; ?>
            </small>
        </section>
        <input type="text" id="loginusername" placeholder="Username" name="username" required>
        <input type="password" id="loginpassword" placeholder="Password" name="password" required>
        <input type="submit" class="button" name="login" value="login">
        <span>Don't have an account? </span>
                <button type="button" id="switchToRegister">
                    <a href="register.php">Register</a>
                </button>
       
        

    </form>
    <script src="main.js"></script>
</body>
</html>