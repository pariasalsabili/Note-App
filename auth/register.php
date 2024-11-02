<?php
    require_once '../functions/helpers.php';
    require_once '../functions/pdo_connection.php';



    $error = '';
    if(
    isset($_POST['username']) && $_POST['username'] !== '' 
    && isset($_POST['email']) && $_POST['email'] !== '' 
    &&  isset($_POST['phone']) && $_POST['phone'] !== ''
    &&  isset($_POST['password']) && $_POST['password'] !== '' 
    &&  isset($_POST['confirm']) && $_POST['confirm'] !== '' )
    {
        global $pdo;
        if($_POST['password'] === $_POST['confirm'])
        {
            if(strlen($_POST['password']) > 5)
            {
                $query = 'SELECT * FROM noteapp.users WHERE username = ?';
                $statement = $pdo->prepare($query);
                $statement->execute([$_POST['username']]);
                $user = $statement->fetch();
                if($user === false)
                {
                    $query = 'INSERT INTO noteapp.users SET username = ?, email = ?, phone = ?, password = ?, created_at = NOW() ;';
                    $statement = $pdo->prepare($query);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement->execute([$_POST['username'], $_POST['email'], $_POST['phone'], $password]);
                    redirect('auth/login.php');
                }
                else
                {
                    $error = 'ایمیل وارد شده تکراری میباشد';
                }
            }
            else
            {
                $error = 'کلمه ی عبور باید حداقل ۵ کاراکتر باشد';
            }
        }
        else
        {
            $error = 'کلمه ی عبور با تاییدیه کلمه ی عبور مطابقت ندارد';
        }
    }
    else
    {
        if(!empty($_POST))
        $error = 'همه فیلد ها اجباری هستند';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Program</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    
    <form id="registerationForm" action="<?= url('auth/register.php') ?>" method="post">
        <h1>Sign Up</h1>
        <section class="bg-light my-0 px-2">
                    <small class="text-danger">
                        <?php if($error !== '') echo $error; ?>
                    </small>
                </section>
        
        <input type="text" id="username" name="username" placeholder="username" required>
        <input type="email" id="email" name="email" placeholder="email address" required>
        <input type="text" id="phonenumber" name="phone" placeholder="phone number" pattern="[0-9]{10}" required>       
        <input type="password" id="password" name="password" placeholder="password" required>
        <input type="password" id="confirm" name="confirm" placeholder="confirm password" required >
        <input type="submit" class="button" value="Register">
        <span>Do you already have an account? </span>
                <button type="button" id="switchToLogin"><a href="login.php">Login</a></button>

                
        
            
    </form>
    <script src="main.js"></script>
</body>
</html>