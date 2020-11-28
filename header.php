<html lang="en">
    <head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <div class="header">
        <div class="header-left">
            <a href="../index.php" class="header-text">My website</a>
        </div>
        <div class="header-right">
        <?php
            if(empty($_SESSION['username']))
            {
                echo '<a href="../Account/loginf.php" class="header-text">Login</a>
                <a href="../Account/register.php" class="header-text">Register</a>';
            }
            else
            {
                echo '<a href="../Posts/myposts.php" class="header-text">My posts</a>
                <a href="../Posts/create.php" class="header-text">Create post</a>
                <a class="header-text">Welcome, '.$_SESSION["username"].'</a>
                <a href="../Account/logout.php" class="header-text">Logout</a>';
            }
        ?>
        </div>
    </div>
</html>
